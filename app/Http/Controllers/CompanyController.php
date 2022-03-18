<?php
namespace App\Http\Controllers;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use App\Models\Company;
use DataTables;

class CompanyController extends Controller
{
    
   

  

    public function index(Request $request)
    {
        
        $company = Company::all();
        
        if ($request->ajax()) {
            $data = Company::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('company');
    }
}

