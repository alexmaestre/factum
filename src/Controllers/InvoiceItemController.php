<?php

namespace Factum\Controllers;

use VivaCMS\Controllers\BaseController;

class InvoiceItemController extends BaseController
{
	
    /**
     * Construct
     *
     * @param  \Model|string  $model
     * @return void
     */	
	public function __construct(){
		parent::__construct('\Factum\Models\InvoiceItem');
	}	
	
}