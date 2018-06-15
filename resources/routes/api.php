<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Factum API layer routes
| 
*/
use \VivaCMS\Services\Installation\InstallationManager;

Route::group(['namespace' => 'Factum\Controllers', 'prefix' => 'api','middleware' => ['web','cors']], function () {

	Route::group(['middleware' => ['user']], function () {		
		
		Route::apiResources([
			'companies' => 'CompanyController',
			'invoices' => 'InvoiceController',
			'invoice_items'=>'InvoiceItemController'
		]);
		
	});	
	
});