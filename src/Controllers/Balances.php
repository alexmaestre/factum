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
    public function show()
    {
		return view('factum::factum.balances');
    }	
	
}