<?php

namespace App\Http\Controllers;

use App\Departement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class DepartementController extends Controller
{
    public function index()
    {
        return view('pages.departement.index');
    }

    public function detail(Request $request)
    {
        $data = Departement::where('id', $request->id)->first();

        return $data;
    }

    public function submit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        DB::beginTransaction();
        try {

            Departement::create([
                'name'       =>  $request->name,
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
            'detail_name' => 'required',
            'detail_status' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        $departement = Departement::where('id', $request->id)->first();

        if (!$departement) {
            return json_encode(['status' => false, 'message' => $this->single_message("Data Not Found")]);
        }

        DB::beginTransaction();
        try {
            $departement->name         = $request->detail_name;
            $departement->status       = $request->detail_status;
            $departement->updated_by   = Auth::user()->id;
            $departement->updated_at   = Carbon::now();
            $departement->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return json_encode(['status' => false, 'message' => $this->single_message($th->getMessage())]);
        }

        return $this->success(static::HTTP_OK, static::UPDATE_OK);
    }

    public function datatable()
    {
        return DataTables::of(DB::table('departement')
            ->where('departement.status', '!=', 'deleted')
            ->leftjoin('employee', 'departement.id',  'employee.departement_id')
            ->select(
                'departement.id',
                'departement.name',
                'departement.status',
                DB::raw("date(departement.created_at) as created_at"),
                DB::raw('COUNT(employee.id) as employee_count'),
            )
            ->groupBy('departement.id')
            ->orderBy('id', 'asc')
            ->get())->addIndexColumn()->make(true);
    }
}
