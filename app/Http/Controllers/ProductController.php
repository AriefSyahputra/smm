<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.product.index');
    }

    public function detail(Request $request)
    {
        $data = Product::where('sku', $request->sku)
            ->select('slug', 'sku', 'name', 'lokasi', 'satuan', 'stock', 'status')
            ->first();

        if (!$data) {
            abort(404);
        }

        return view('pages.product._detail', ['data' => $data]);
    }

    public function submit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'sku'     => ['required', 'string', 'unique:product'],
            'name'    => ['required', 'string'],
            'lokasi'  => ['required', 'string', 'max:255'],
            'satuan'  => ['required', 'string'],
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        DB::beginTransaction();
        try {
            Product::create([
                'sku'        =>  $request->sku,
                'name'       =>  $request->name,
                'slug'       =>  Str::slug($request->sku),
                'lokasi'     =>  $request->lokasi,
                'satuan'     =>  $request->satuan,
                'status'     => 'active',
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return json_encode(['status' => false, 'message' => $this->single_message($th->getMessage())]);
        }


        return $this->success(static::HTTP_OK, static::SUBMIT_OK);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => ['required', 'string'],
            'lokasi'  => ['required', 'string', 'max:255'],
            'satuan'  => ['required', 'string'],
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }
        $product = Product::where('sku', $request->sku)->first();

        if (!$product) {
            return json_encode(['status' => false, 'message' => $this->single_message("Data Not Found")]);
        }

        DB::beginTransaction();
        try {
            $product->name       = $request->name;
            $product->lokasi     = $request->lokasi;
            $product->satuan     = $request->satuan;
            $product->status     = $request->status;
            $product->updated_by = Auth::user()->id;
            $product->updated_at = Carbon::now();
            $product->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return json_encode(['status' => false, 'message' => $this->single_message($th->getMessage())]);
        }

        return $this->success(static::HTTP_OK, static::UPDATE_OK);
    }

    public function datatable()
    {
        return DataTables::of(DB::table('product')
            ->where('product.status', '!=', 'deleted')
            ->select('sku', 'name', 'lokasi', 'stock', 'status')
            ->get())->addIndexColumn()->make(true);
    }

    public function datatableHistoryPurchase(Request $request)
    {
        // DB::raw("date(departement.created_at) as created_at"),
        return DataTables::of(DB::table('purchase')
            ->leftjoin('purchase_detail', 'purchase.id', 'purchase_detail.purchase_id')
            ->leftjoin('product', function ($join) {
                $join->on('product.id', 'purchase_detail.product_id');
            })
            ->where('product.sku', $request->sku)
            ->select('purchase_no', DB::raw("date(purchase_date) AS purchase_date"), 'suplier', 'quantity')
            ->orderBy('purchase_date', 'desc')
            ->get())->addIndexColumn()->make(true);
    }

    public function datatableHistoryOrder(Request $request)
    {
        return DataTables::of(DB::table('order')
            ->leftjoin('order_detail', 'order.id', 'order_detail.order_id')
            ->leftjoin('employee', 'order.employee_id', 'employee.id')
            ->leftjoin('product', function ($join) {
                $join->on('product.id', 'order_detail.product_id');
            })
            ->where('product.sku', $request->sku)
            ->select('order_no', 'order.created_at AS order_date', 'employee.name as employee', 'quantity')
            ->get())->addIndexColumn()->make(true);
    }

    public function search(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::select('id as product_id', 'sku', 'name', 'lokasi', 'stock', 'satuan')
                ->whereNotIn('status', ['inactive', 'deleted'])
                ->where('sku', 'ilike', "%$search%")
                ->orWhere('name', 'ilike', "%$search%")
                ->orderBy('id', 'asc')
                ->get();
        }

        return response()->json($data);
    }
}
