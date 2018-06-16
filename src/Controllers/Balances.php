<?php
namespace Factum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use VivaCMS\Models\User;

class Balances extends Controller{
	
	
    /**
     * Balances view
     *
     * @return Response
     */
    public function balances()
    {
		return view('factum::factum.balances');
    }

    /**
     * Balance view
     *
     * @return Response
     */
    public function balance($year,$trim)
    {
		return view('factum::factum.balance')->with(['year'=>$year,'trim'=>$trim]);
    }	
	
}