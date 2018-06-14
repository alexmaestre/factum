<?php
/*
|--------------------------------------------------------------------------
| Factum Routes
|--------------------------------------------------------------------------
|
| Fromtend layer routes
|
*/

Route::group(['middleware' => ['web'],'namespace' => 'Factum\Controllers'], function () {
	
	/* Authenticated users */
	
	Route::group(['middleware' => ['user']], function () {
			
		Route::group(['middleware' => ['hasCompany']], function () {

			Route::get('/home',function(Request $request){ return view('factum::factum.mi-empresa');   });	
			Route::get('/mi-empresa',function(Request $request){ return view('factum::factum.my-company');   });	
			Route::get('/mi-cuenta',function(Request $request){ return view('factum::factum.my-account'); });	
			Route::get('/clientes',function(Request $request){ return view('factum::factum.customers'); });	
			Route::get('/proveedores',function(Request $request){ return view('factum::factum.providers'); });		
			Route::get('/ingresos',function(Request $request){ return view('factum::factum.incomes'); });		
			Route::get('/gastos',function(Request $request){ return view('factum::factum.expenses'); });					
			Route::get('/balances',function(Request $request){ return view('factum::factum.balances'); });		
			
		});
		
		//Logout
		Route::get('/logout','AuthFactum@getLogout');
		
	});	
	
	/* Guests */
	Route::group(['middleware' => ['guest']], function () {	
		Route::get('/registro','SignIn@form');
		Route::post('/registro','SignIn@signup');
		Route::post('/','AuthFactum@getLogin');
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