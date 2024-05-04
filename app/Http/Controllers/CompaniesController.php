<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use DataTables;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::select('companies.*')
                    ->latest()
                    ->get();
  
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('website', function($row){
                $web = '<a href="'.$row->website.'">'.$row->website.'</a>';
                return $web;
            })
            ->addColumn('company_logo', function($row){
                $imageUrl = asset('storage/Company/'.$row->company_logo.'');
                $img = '<img class="mr-3 img-fluid" width="75" src="'.$imageUrl.'" alt="pro-img">';
                return $img;
            })
            ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-primary btn-sm viewCompany">View</a>&nbsp;';

                    $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-primary btn-sm editCompany">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCompany">Delete</a>';

                    return $btn;
            })
            ->rawColumns(['action','company_logo','website'])
            ->make(true);
        }
        return view('admin.companies');
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
            'company_name' => 'required',
            'email' => 'required',
            'website' => 'required',
            'company_logo' => 'dimensions:min_width=100,min_height=100'
        ]);
        try {
            $data = [
                'company_name' => $request->company_name,
                'email' => $request->email,
                'website' => $request->website
            ];

            if ($request->hasFile('company_logo')) {
                $oldFile =  $request->old_company_logo;
                if ($oldFile) {
                    $oldFilePath = storage_path('app/public/Company') . '/' . $oldFile;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $fileName = time().'.'.$request->company_logo->extension();  
                $request->company_logo->move(storage_path('app/public/Company'), $fileName);
                $data['company_logo'] = $fileName;
            }
            Company::updateOrCreate(['id' => $request->company_id], $data);

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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $company = Company::find($id);
        return response()->json($company);
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
        Company::find($id)->delete();
        return response()->json(['success'=>'Company Detail deleted successfully.']);
    }
}
