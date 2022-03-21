<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $company = Company::all();
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Изменить</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete">Удалить</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('user',['company'=>$company]);
    }
    public function store(Request $request)
    {
        User::updateOrCreate(['id' => $request->user_id],
                ['name' => $request->name, 
                'email' => $request->email,
                'company_id' => $request->company_id,
               
               
            ]);        

        return response()->json(['success'=>'Book saved successfully.']);
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
        $user= User::find($id)->delete();

        return response()->json($user);
    }


    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }



}



