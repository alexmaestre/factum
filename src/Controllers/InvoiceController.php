<?php

namespace Factum\Controllers;

use VivaCMS\Controllers\BaseController;

class InvoiceController extends BaseController
{
	
    /**
     * Construct
     *
     * @param  \Model|string  $model
     * @return void
     */	
	public function __construct(){
		parent::__construct('\Factum\Models\Invoice');
	}	
	
}