<?php
namespace Factum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use VivaCMS\Models\User;
use Factum\Models\Company;
use Factum\Models\Invoice;

class Customers extends Controller{

    /**
     * Customer index view
     *
     * @return Response
     */
    public function index()
    {
		$c = Company::where('user_id',\Auth::user()->id)->first();
		return view('factum::factum.customers')->with('customers',$c->customers);
    }
	
    /**
     * Customer create view
     *
     * @return Response
     */
    public function create()
    {
		return view('factum::factum.customer_create')->with('customer',new Company());
    }	
	
    /**
     * Customer view
     *
     * @return Response
     */
    public function show($id)
    {
		return view('factum::factum.customer')->with('customer',Company::where('id',$id)->first());
    }		
	
    /**
     * Customer store operation
     *
     * @return Response
     */
    public function store(Request $request)
    {
		$c = new CompanyController();
		$create = $c->createObject($c->model,$request->get('company'));
		if($create === false){ 
			return back()->withErrors($c->error)->withInput();
		};	
		$userCompany = Company::where('user_id',\Auth::user()->id)->first();
		$userCompany->customers()->attach($create->id);
		return redirect(layer_url().'clientes');	
    }		
	
	
}