<?php
use Illuminate\Http\Request;
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
		

			
		});
		
		//Logout
		Route::get('/logout','Auth\AuthAdmin@getLogout');			
		
	});	
	
	/* Guests */
	Route::group(['middleware' => ['guest']], function () {	
		Route::post('/','Auth\AuthAdmin@getLogin');
	});
	
	/* Common */ 
	Route::get('/',function(Request $request){  
		if(!Auth::check()){
			return view('factum::factum.login'); 
		}else{
			return view('factum::factum.home');  
		}
	});

});