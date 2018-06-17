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

			Route::get('/home','My@myAccount');	
			Route::get('/mi-cuenta','My@myAccount');
			Route::get('/mi-empresa','My@myCompany');		
			Route::get('/clientes','Customers@index');			
			Route::get('/cliente/{id}','Customers@show')->where('id','[0-9]+');
			Route::get('/clientes/nuevo','Customers@create');			
			Route::post('/clientes/nuevo','Customers@store');		
			Route::get('/proveedores','Providers@index');	
			Route::get('/proveedor/{id}','Providers@show')->where('id','[0-9]+');
			Route::get('/proveedores/nuevo','Providers@create');			
			Route::post('/proveedores/nuevo','Providers@store');		
			Route::get('/ingresos','Incomes@index');	
			Route::get('/ingreso/{id}','Incomes@show')->where('id','[0-9]+');	
			Route::post('/ingreso/{id}','Incomes@post')->where('id','[0-9]+');	
			Route::get('/ingresos/nuevo','Incomes@create');			
			Route::post('/ingresos/nuevo','Incomes@store');	
			Route::get('/gastos','Expenses@index');	
			Route::get('/gasto/{id}','Expenses@show')->where('id','[0-9]+');
			Route::post('/gasto/{id}','Expenses@post')->where('id','[0-9]+');
			Route::get('/gastos/nuevo','Expenses@create');			
			Route::post('/gastos/nuevo','Expenses@store');				
			Route::get('/balances','Balances@balances');			
			Route::get('/balance/{year}/{trim}','Balances@balance')->where(['year'=>'[0-9]+','trim'=>'[1-4]']);
		});
		
		//Logout
		Route::get('/logout','AuthFactum@getLogout');
		
	});	
	
	/* Guests */
	Route::group(['middleware' => ['guest']], function () {	
		Route::get('/registro','SignIn@form');
		Route::match(["get","post"],'/recuperar-clave',function(Request $request){ return view('factum::factum.recovery'); });
		Route::post('/registro','SignIn@signup');
		Route::post('/','AuthFactum@getLogin');
	});
	
	/* Common */ 
	Route::get('/factura/{code}/{id}','Incomes@shareInvoice')->where(['id'=>'[0-9]+']);	
	Route::get('/404',function(Request $request){  
		if(!Auth::check()){
			return redirect(layer_url())->withErrors('Has accedido a una ruta incorrecta. Te hemos redirigido a la home.'); 
		}else{
			return redirect(layer_url().'home')->withErrors('Has accedido a una ruta incorrecta. Te hemos redirigido a la home.'); 
		}
	});	
	Route::get('/',function(Request $request){  
		if(!Auth::check()){
			return view('factum::factum.login'); 
		}else{
			return redirect(layer_url().'home');  
		}
	});

});