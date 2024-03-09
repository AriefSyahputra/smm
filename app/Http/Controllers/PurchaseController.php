<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use App\PurchaseDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use DB;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('pages.purchase.index');
    }

    public function add()
    {
        return view('pages.purchase._add');
    }

    public function detail(Request $request)
    {
        $data = Purchase::where('purchase_no', $request->purchase_no)
            ->select('id', 'purchase_no', DB::raw("date(purchase_date) AS purchase_date"), 'suplier', 'status')
            ->first();

        if (!$data) {
            abort(404);
        }

        return view('pages.purchase._detail', ['data' => $data]);
    }

    public function submit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'purchase_number'  => ['required', 'unique:purchase,purchase_no'],
            'purchase_date'    => ['required'],
            'purchase_suplier' => ['required'],
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        DB::beginTransaction();
        try {
            $purchase = Purchase::create([
                'purchase_no'   => $request->purchase_number,
                'purchase_date' => $request->purchase_date,
                'suplier'       => $request->purchase_suplier,
                'status'        => 'done',
                'created_by'    => Auth::user()->id,
                'created_at'    => Carbon::now()
            ]);

            $detail = json_decode($request->detail);

            if (!$detail) {
                throw new \Exception('Product field is required');
            }

            foreach ($detail as $key => $value) {
                PurchaseDetail::insert([
                    'purchase_id' => $purchase->id,
                    'product_id'  => $value->product_id,
                    'quantity'    => $value->quantity,
                ]);

                $product = Product::where([['id', $value->product_id], ['sku', $value->sku]])->first();
                $product->stock       = $product->stock + $value->quantity;
                $product->updated_by  = Auth::user()->id;
                $product->updated_at  = date('Y-m-d H:i:s');
                if (!$product->save()) {
                    throw new \Exception('Insert Data Purchase Error');
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return json_encode(['status' => false, 'message' => $this->single_message($th->getMessage())]);
        }

        return $this->success(static::HTTP_OK, static::SUBMIT_OK);
    }

    public function datatable()
    {
        return DataTables::of(DB::table('purchase')
            ->where('status', '!=', 'deleted')
            ->select('purchase_no', DB::raw("date(purchase_date) AS purchase_date"), 'suplier', 'status')
            ->get())->addIndexColumn()->make(true);
    }

    public function datatableDetailProduct(Request $request)
    {
        return DataTables::of(DB::table('purchase')
            ->where('purchase_no', $request->purchase_no)
            ->leftjoin('purchase_detail', 'purchase.id', 'purchase_detail.purchase_id')
            ->leftjoin('product', 'purchase_detail.product_id', 'product.id')
            ->select('sku', 'product.name', 'lokasi', 'purchase_detail.quantity')
            ->get())->addIndexColumn()->make(true);
    }
}
