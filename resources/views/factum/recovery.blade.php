@extends('factum::factum/templates/login')

@section('head')
<title>Factum - Recuperar clave</title>
@stop

@section('content')
<div class="container">
	<form class="form-signin" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">				
		<h1 class="h3 mb-3 font-weight-normal"><i class="fa fa-chart-bar"></i> <b>Factum</b></h1>	
		@if(\Request::isMethod('post'))
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<i class="fa fa-success"></i> 
				<span id="error">Te hemos enviado las instrucciones para restablecer tu cuenta</span>
			</div>				
		@else
			<label for="loginEmail" class="sr-only">Email</label>
			<input type="email" id="loginEmail" class="form-control" placeholder="Email" name="loginEmail" data-rule-required="true" data-msg-required="Debe introducir un email" data-rule-email="true" data-msg-email="Debe introducir un email correcto" required autofocus>
			
			<button class="btn btn-lg btn-primary btn-block" type="submit">Recuperar</button>			
		@endif		
		<a class="btn btn-lg btn-block" href="{{layer_url()}}">Volver</a>
	</form>
</div>
@stop