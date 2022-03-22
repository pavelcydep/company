<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use DataTables;

class CompanyController extends Controller
{




    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    if (Gate::check('admin-protected')) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>';

                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>';




                        return $btn;
                    }
                })
                ->rawColumns(['action'])

                ->make(true);
        }

        return view('company');
    }



    public function store(Request $request)
    {
        Company::updateOrCreate(

            $validated = $request->validate([
                'company' => 'required',
                'email'=>'required',
                'email'=>'required',
                'addres'=>'required',

            ]),


            ['id' => $request->book_id],
            [
                'company' => $request->company,
                'email' => $request->email,
                'logo' => $request->logo,
                'addres' => $request->addres,
            ]
        );

        return response()->json(['success' => 'Book saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */



    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id)->delete();

        return response()->json($company);
    }


    public function edit($id)
    {
        $company = Company::find($id);
        return response()->json($company);
    }

    public  function map()
    {
        $company = Company::all();
        $users = User::all();
        return view('map', ['users' => $users, 'company' => $company,]);
    }
}
