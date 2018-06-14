<?php
namespace Factum\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use VivaCMS\Controllers\UserController;
use VivaCMS\Models\User;
use VivaCMS\Exceptions\ModelControllerException;
use Factum\Models\Company;
use Factum\Controllers\CompanyController;

class SignIn extends Controller{

    /**
     * Render form view
     *
     * @return Response
     */
    public function form()
    {
		return view('factum::factum.registro')->with(['user'=>new User(),'company'=>new Company()]);
    }
	
    /**
     * Register user
     *
     * @return Response
     */
    public function register(Request $request)
    {
		$c = new UserController();
		$create = $c->createObject($c->model,$request->get('user'));
		if($create === false){ 
			return back()->withErrors($c->error)->withInput();
		};
		$c = new CompanyController();
		$m = array_merge($request->get('company'),["user_id" => $create->id,"tax_id" => 2]);
		$create = $c->createObject($c->model,$m);
		if($create === false){ 
			return back()->withErrors($c->error)->withInput();
		};		
		return redirect(layer_url())->with('success','Registro realizado');
    }	
	
}