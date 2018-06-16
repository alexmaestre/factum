<?php
namespace Factum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use VivaCMS\Models\User;
use Factum\Models\Company;
use Factum\Models\Invoice;

class Expenses extends Controller{

    /**
     * Expense index view
     *
     * @return Response
     */
    public function index()
    {
		$c = Company::where('user_id',\Auth::user()->id)->first();
		return view('factum::factum.expenses')->with('expenses',$c->expenses);
    }
	
    /**
     * Expense create view
     *
     * @return Response
     */
    public function create()
    {
		$c = Company::where('user_id',\Auth::user()->id)->with(['providers' => function($query){ $query->orderBy('reference', 'asc'); }])->first();
		return view('factum::factum.expense_create')->with(['expense'=>new Invoice(),'company'=>$c]);
    }	
	
    /**
     * Expense view
     *
     * @return Response
     */
    public function show($id)
    {
		$c = Company::where('user_id',\Auth::user()->id)->with(['providers' => function($query){ $query->orderBy('reference', 'asc'); }])->first();
		return view('factum::factum.expense')->with(['expense'=>Invoice::where('id',$id)->first(),'company'=>$c]);
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