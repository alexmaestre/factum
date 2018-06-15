<?php
namespace Factum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use VivaCMS\Models\User;
use Factum\Models\Company;
use Factum\Models\Invoice;

class Providers extends Controller{

    /**
     * Provider index view
     *
     * @return Response
     */
    public function index()
    {
		$c = Company::where('user_id',\Auth::user()->id)->first();
		return view('factum::factum.providers')->with('providers',$c->providers);
    }
	
    /**
     * Provider create view
     *
     * @return Response
     */
    public function create()
    {
		return view('factum::factum.provider_create')->with('provider',new Company());
    }	
	
    /**
     * Provider view
     *
     * @return Response
     */
    public function show($id)
    {
		return view('factum::factum.provider')->with('provider',Company::where('id',$id)->first());
    }	
	
    /**
     * Provider store operation
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
		$userCompany->providers()->attach($create->id);
		return redirect(layer_url().'proveedores');	
    }		
	
	
}