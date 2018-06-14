<?php
/*
|--------------------------------------------------------------------------
| Factum Routes
|--------------------------------------------------------------------------
|
| Fromtend layer routes
|
*/

Route::group(['middleware' => ['web']], function () {
	
	/* Authenticated users */
	
	Route::group(['middleware' => ['user']], function () {
			
		Route::group(['middleware' => ['hasCompany'],'namespace' => 'Factum\Controllers'], function () {

			Route::get('/home',function(Request $request){ return view('factum::factum.mi-empresa');   });	
			Route::get('/mi-empresa',function(Request $request){ return view('factum::factum.mi-empresa');   });	
			Route::get('/mi-cuenta',function(Request $request){ return view('factum::factum.mi-cuenta'); });	
			Route::get('/clientes','InvoiceController@index');		
			Route::get('/proveedores',function(Request $request){ return view('factum::factum.proveedores'); });		
			Route::get('/ingresos',function(Request $request){ return view('factum::factum.ingresos'); });		
			Route::get('/gastos',function(Request $request){ return view('factum::factum.gastos'); });		
			Route::get('/facturas',function(Request $request){ return view('factum::factum.facturas'); });					
			Route::get('/balances',function(Request $request){ return view('factum::factum.balances'); });		
			
		});
		
		//Logout
		Route::get('/logout','VivaCMS\Controllers\Auth\AuthAdmin@getLogout');
		
	});	
	
	/* Guests */
	Route::group(['middleware' => ['guest']], function () {	
		Route::get('/registro','Factum\Controllers\SignIn@form');
		Route::post('/registro','Factum\Controllers\SignIn@register');
		Route::post('/','VivaCMS\Controllers\Auth\AuthAdmin@getLogin');
	});
	
	/* Common */ 
	Route::get('/',function(Request $request){  
		if(!Auth::check()){
			return view('factum::factum.login'); 
		}else{
			return redirect(layer_url().'home');  
		}
	});

});