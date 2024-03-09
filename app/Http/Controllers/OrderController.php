<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('pages.order.index');
    }

    public function add()
    {
        return view('pages.order._add');
    }

    public function detail(Request $request)
    {
        $data = Order::where('order_no', $request->order_no)
            ->leftjoin('employee', 'order.employee_id', 'employee.id')
            ->leftjoin('departement', 'employee.departement_id', 'departement.id')
            ->select('nik', 'order_no', 'employee.name as employee', 'departement.name as departement')
            ->selectRaw('date(order_date) as order_date')
            ->first();

        if (!$data) {
            abort(404);
        }

        return view('pages.order._detail', ['data' => $data]);
    }

    public function submit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'order_date'    => ['required'],
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'employee_id'   => $request->employee_id,
                'order_no'      => 'TRX-' . date('YmdHis') . Auth::user()->id,
                'order_date'    => $request->order_date,
                'status'        => 'done',
                'created_by'    => Auth::user()->id,
                'created_at'    => Carbon::now()
            ]);

            $detail = json_decode($request->detail);

            if (!$detail) {
                throw new \Exception('Product field is required');
            }

            foreach ($detail as $key => $value) {
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id'  => $value->product_id,
                    'quantity'    => $value->quantity,
                ]);

                $product = Product::where([['id', $value->product_id], ['sku', $value->sku]])->first();
                if ($value->quantity > $product->stock) {
                    throw new \Exception('The product is out of stock!');
                }

                $product->stock       = $product->stock - $value->quantity;
                $product->updated_by  = Auth::user()->ids;
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
        return DataTables::of(DB::table('order')
            ->leftjoin('employee', 'order.employee_id', 'employee.id')
            ->where('order.status', '!=', 'deleted')
            ->select('order_no', 'employee.name as employee', 'order.status')
            ->selectRaw('date(order_date) as order_date')
            ->get())->addIndexColumn()->make(true);
    }

    public function searchNik(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Employee::leftjoin('departement', 'employee.departement_id', 'departement.id')
                ->select('employee.id as employee_id', 'nik', 'employee.name as employee_name', 'departement.name as departement')
                ->whereNotIn('employee.status', ['inactive', 'deleted'])
                ->where('nik', 'ilike', "%$search%")
                ->get();
        }

        return response()->json($data);
    }

    public function datatableDetailProduct(Request $request)
    {
        return DataTables::of(DB::table('order')
            ->where('order_no', $request->order_no)
            ->leftjoin('order_detail', 'order.id', 'order_detail.order_id')
            ->leftjoin('product', 'order_detail.product_id', 'product.id')
            ->select('sku', 'product.name', 'lokasi', 'order_detail.quantity')
            ->get())->addIndexColumn()->make(true);
    }
}
