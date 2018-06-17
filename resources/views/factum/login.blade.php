@extends('factum::factum/templates/login')

@section('head')
<title>Factum - Plataforma de facturación</title>
@stop

@section('content')
<div class="container">
	<form class="form-signin" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">				
		<h1 class="h3 mb-3 font-weight-normal"><i class="fa fa-chart-bar"></i> <b>Factum</b></h1>	
		<div class="alert alert-danger alert-dismissable @if(!session('error')) d-none @endif">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			<i class="fa fa-warning"></i> 
			<strong>¡Error!</strong> <span id="error"> @if(session('error')) {{session('error')}} @endif</span>
		</div>	
		<div class="alert alert-success alert-dismissable @if(!session('success')) d-none @endif">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			<i class="fa fa-success"></i> 
			<strong></strong> <span id="error"> @if(session('success')) {{session('success')}} @endif</span>
		</div>				
		<label for="loginEmail" class="sr-only">Email</label>
		<input type="email" id="loginEmail" class="form-control" placeholder="Email" name="loginEmail" data-rule-required="true" data-msg-required="Debe introducir un email" data-rule-email="true" data-msg-email="Debe introducir un email correcto" required autofocus>
		
		<label for="loginPassword" class="sr-only">Password</label>
		<input type="password" id="loginPassword" class="form-control" autocomplete="off" placeholder="Clave" name="loginPassword" data-rule-required="true" data-msg-required="Debe introducir su clave" required>
		
		<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
		
		<a class="btn btn-lg btn-block" href="{{layer_url()}}registro">Crear cuenta</a> 
		
		<a class="btn btn-lg btn-block" href="{{layer_url()}}recuperar-clave">Recuperar clave</a>
	</form>
</div>
@stop