<?php

namespace App\Http\Controllers;

use App\Departement;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('pages.employee.index');
    }

    public function detail(Request $request)
    {
        $data = Employee::leftjoin('departement', 'employee.departement_id', 'departement.id')
            ->where('employee.id', $request->id)
            ->select(
                'employee.id',
                'employee.nik',
                'employee.name',
                'gender',
                'phone',
                'employee.status',
                'departement.id as departement_id',
                'departement.name as departement_name'
            )
            ->first();

        return $data;
    }

    public function dataDepartement(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Departement::select("id", "name")
                ->whereNotIn('status', ['inactive', 'deleted'])
                ->where('name', 'ilike', "%$search%")->get();
        }

        return response()->json($data);
    }

    public function submit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'departement' => ['required', 'integer'],
            'nik'         => ['required', 'numeric',  'digits:16'],
            'name'        => ['required', 'string', 'max:255'],
            'gender'      => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'phone'       => ['required', 'numeric'],
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        DB::beginTransaction();
        try {

            Employee::create([
                'departement_id' =>  intval($request->departement),
                'nik'            =>  $request->nik,
                'name'           =>  $request->name,
                'gender'         =>  $request->gender,
                'phone'          =>  $request->phone,
                'status'         => 'active',
                'created_by'     => Auth::user()->id,
                'created_at'     => Carbon::now()
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
            'detail_departement' => 'required',
            'detail_nik' => 'required',
            'detail_name' => 'required',
            'detail_gender' => 'required',
            'detail_phone' => 'required',
            'detail_status' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        $employee = Employee::where('id', $request->id)->first();

        if (!$employee) {
            return json_encode(['status' => false, 'message' => $this->single_message("Data Not Found")]);
        }

        DB::beginTransaction();
        try {
            $employee->departement_id = $request->detail_departement;
            $employee->nik            = $request->detail_nik;
            $employee->name           = $request->detail_name;
            $employee->gender         = $request->detail_gender;
            $employee->phone          = $request->detail_phone;
            $employee->status         = $request->detail_status;
            $employee->updated_by     = Auth::user()->id;
            $employee->updated_at     = Carbon::now();
            $employee->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return json_encode(['status' => false, 'message' => $this->single_message($th->getMessage())]);
        }

        return $this->success(static::HTTP_OK, static::UPDATE_OK);
    }

    public function datatable()
    {
        return DataTables::of(DB::table('employee')
            ->where('employee.status', '!=', 'deleted')
            ->leftjoin('departement', 'employee.departement_id',  'departement.id')
            ->select(
                'employee.id',
                'employee.nik',
                'employee.name',
                'departement.name as departement_name',
                'employee.gender',
                'employee.phone',
                'employee.status',
            )
            ->orderBy('id', 'desc')
            ->get())->addIndexColumn()->make(true);
    }
}
