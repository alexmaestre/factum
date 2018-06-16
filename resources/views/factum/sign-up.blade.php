@extends('factum::factum/templates/login')

@section('head')
<title>Registro de usuario</title>
@stop

@section('content')
<div class="container">
	<form class="form-signin data-validation" method="post">
		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">				
		<h1 class="h3 mb-3 font-weight-normal"><i class="fa fa-chart-bar"></i> <b>Factum</b></h1>
		
		<h5>Datos personales</h5>
		{!!	$user->setInputTemplate('factum::factum/forms'); !!}
		{!!	$user->getInput(['param'=>'name','placeholder'=>'Nombre','label']) !!}
		{!!	$user->getInput(['param'=>'surname','placeholder'=>'Apellidos']) !!}
		{!!	$user->getInput(['param'=>'email','placeholder'=>'Email']) !!}
		{!!	$user->getInput(['param'=>'password','placeholder'=>'Clave']) !!}
		<h5>Datos de la empresa</h5>
		{!!	$company->setInputTemplate('factum::factum/forms'); !!}
		{!!	$company->getInput(['param'=>'reference','placeholder'=>'Nombre de referencia']) !!}
		{!!	$company->getInput(['param'=>'name','placeholder'=>'Nombre fiscal']) !!}	
		{!!	$company->getInput(['param'=>'code','placeholder'=>'NIF']) !!}	
		{!!	$company->getInput(['param'=>'address','placeholder'=>'Direccón fiscal']) !!}	
		{!!	$company->getInput(['param'=>'city_id','placeholder'=>'Ciudad']) !!}	
		{!!	$company->getInput(['param'=>'postal_code_id','placeholder'=>'Código postal']) !!}	
		{!!	$company->getInput(['param'=>'vat_id','placeholder'=>'Tasa impositiva']) !!}	
	
		<button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>
		
		<a class="btn btn-lg btn-block" href="{{layer_url()}}">Ya tengo una cuenta</a>
	</form>
</div>
@stop