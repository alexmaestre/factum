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
		return view('factum::factum.sign-up')->with(['user'=>new User(),'company'=>new Company()]);
    }
	
    /**
     * Sign Up user
     *
     * @return Response
     */
    public function signup(Request $request)
    {
		$c = new UserController();
		$m = array_merge($request->get('user'),["status_id" => 1]);
		$create = $c->createObject($c->model,$m);
		if($create === false){ 
			return back()->withErrors($c->error)->withInput();
		};
		$c = new CompanyController();
		$m = array_merge($request->get('company'),["user_id" => $create->id]);
		$create = $c->createObject($c->model,$m);
		if($create === false){ 
			return back()->withErrors($c->error)->withInput();
		};		
		return redirect(layer_url())->with('success','Registro realizado');
    }	
	
}