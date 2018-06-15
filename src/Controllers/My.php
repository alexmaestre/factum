<?php
namespace Factum\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use VivaCMS\Controllers\UserController;
use VivaCMS\Models\User;
use VivaCMS\Exceptions\ModelControllerException;
use Factum\Models\Company;
use Factum\Controllers\CompanyController;

class My extends Controller{

    /**
     * My Account view
     *
     * @return Response
     */
    public function myAccount()
    {
		return view('factum::factum.my-account')->with('user',\Auth::user());
    }
	
    /**
     * My Company view
     *
     * @return Response
     */
    public function myCompany()
    {
		return view('factum::factum.my-company')->with('company',Company::where('user_id',\Auth::user()->id)->first());
    }	
	
	
}