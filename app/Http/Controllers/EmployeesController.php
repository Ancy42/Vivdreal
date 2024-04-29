<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use DataTables;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $company =Company::get();

        if ($request->ajax()) {
            $data = Employee::select('employees.*','companies.id as eid','companies.company_name')
                ->join('companies', 'companies.id', '=', 'employees.company_id')
                ->latest()
                ->get();
  
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('employee_name', function($row){
                $edate = '<span>'.$row->first_name.' '.$row->last_name.'</span>';
                 return $edate;
            })
            ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-primary btn-sm editEmployee">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployee">Delete</a>';

                    return $btn;
            })
            ->rawColumns(['action','employee_name'])
            ->make(true);
        }
        return view('admin.employees', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required',
            'email_id' => 'required',
            'phone' => 'required',
        ]);
        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_id' => $request->company_id,
                'email_id' => $request->email_id,
                'phone' => $request->phone
            ];

            Employee::updateOrCreate(['id' => $request->emp_id], $data);

        return response()->json(['success'=>'successfully Created.']);
        }catch (\Exception $e) {
                    
            return back()->with('error','somethingwrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::find($id)->delete();
        return response()->json(['success'=>'Employee Detail deleted successfully.']);
    }
}
