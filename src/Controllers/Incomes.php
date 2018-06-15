<?php
namespace Factum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use VivaCMS\Models\User;
use Factum\Models\Company;
use Factum\Models\Invoice;

class Incomes extends Controller{

    /**
     * Income index view
     *
     * @return Response
     */
    public function index()
    {
		$c = Company::where('user_id',\Auth::user()->id)->first();
		return view('factum::factum.incomes')->with('incomes',$c->incomes);
    }
	
    /**
     * Income create view
     *
     * @return Response
     */
    public function create()
    {
		return view('factum::factum.income_create')->with('income',new Invoice());
    }	
	
    /**
     * Income view
     *
     * @return Response
     */
    public function show($id)
    {
		return view('factum::factum.income')->with('income',Invoice::where('id',$id)->first());
    }	
	
    /**
     * Provider store operation
     *
     * @return Response
     */
    public function store(Request $request)
    {
		/*
		$c = new CompanyController();
		$create = $c->createObject($c->model,$request->get('company'));
		if($create === false){ 
			return back()->withErrors($c->error)->withInput();
		};	
		$userCompany = Company::where('user_id',\Auth::user()->id)->first();
		$userCompany->providers()->attach($create->id);
		return redirect(layer_url().'proveedores');	
		*/
    }		
	
	
}