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
     * Expense post operations (delete and create item)
     *
     * @return Response
     */
    public function post($id,Request $request)
    {
		if($request->get('_action') == 'create-item'){
			$i = new InvoiceItemController();
			$m = array_merge($request->get('item'),["invoice_id" => $id]);
			$create = $i->createObject($i->model,$m);
			if($create === false){ 
				return back()->withErrors($i->error)->withInput();
			};
			return redirect(layer_url().'gasto/'.$id);
		}
		if($request->get('_action') == 'delete-item'){
			echo 'delete-item';
		}
    }	
	
    /**
     * Expense store operation
     *
     * @return Response
     */
    public function store(Request $request)
    {
		$i = new InvoiceController();
		$c = Company::where('user_id',\Auth::user()->id)->first();
		$m = array_merge($request->get('invoice'),["receiver_company_id" => $c->id]);
		$create = $i->createObject($i->model,$m);
		if($create === false){ 
			return back()->withErrors($i->error)->withInput();
		};	
		return redirect(layer_url().'gasto/'.$create->id);
    }		
	
	
}