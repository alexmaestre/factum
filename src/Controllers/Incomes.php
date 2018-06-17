<?php
namespace Factum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use VivaCMS\Models\User;
use Factum\Models\Company;
use Factum\Models\Invoice;
use Factum\Models\InvoiceItem;

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
		$c = Company::where('user_id',\Auth::user()->id)->with(['customers' => function($query){ $query->orderBy('reference', 'asc'); }])->first();
		return view('factum::factum.income_create')->with(['income'=>new Invoice(),'company'=>$c]);
    }	
	
    /**
     * Income view
     *
     * @return Response
     */
    public function show($id)
    {
		$c = Company::where('user_id',\Auth::user()->id)->with(['customers' => function($query){ $query->orderBy('reference', 'asc'); }])->first();
		return view('factum::factum.income')->with(['income'=>Invoice::where('id',$id)->first(),'company'=>$c]);
    }	
	
    /**
     * Share invoice view
     *
     * @return Response
     */
    public function shareInvoice($code,$id)
    {
		$invoice = Invoice::find($id);
		if(empty($invoice) || md5($invoice->receiver->code.$invoice->receiver->created_at) != $code){ return redirect(layer_url())->withErrors('La factura indicada no existe'); };
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML(view('factum::factum.invoice_pdf')->with(['income'=>Invoice::where('id',$id)->first()]));
		return $pdf->stream();
    }		
	
    /**
     * Income post operations (delete and create item)
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
			return redirect();
		}
		if($request->get('_action') == 'delete-item'){
			$i = InvoiceItem::find($request->get('item'));
			$i->delete();
			return redirect();
		}
    }		
	
    /**
     * Provider store operation
     *
     * @return Response
     */
    public function store(Request $request)
    {
		$i = new InvoiceController();
		$c = Company::where('user_id',\Auth::user()->id)->first();
		$m = array_merge($request->get('invoice'),["company_id" => $c->id]);
		$create = $i->createObject($i->model,$m);
		if($create === false){ 
			return back()->withErrors($i->error)->withInput();
		};	
		return redirect(layer_url().'ingreso/'.$create->id);
    }		
	
	
}