@extends('factum::factum/templates/index')

@section('head')
	<title>Mi empresa</title>
	@csss(
		../admin/plugins/select2/css/select2.min.css,
		../admin/plugins/select2/css/select2-bootstrap.min.css
	)
@stop

@section('content')
	<div class="row mb-3">
		<div class="col-12">
			<h2 class="float-left">{{ $customer->reference }}</h2>
			<a href="{{ layer_url() }}clientes" class="float-left"><button class="btn btn-lg btn-primary ml-3"><i class="fa fa-arrow-left"></i></button></a>
		</div>
	</div>
	
	<div class="row">		
		<div class="col-12">
			<form class="data-validation editObjectForm" method="post" onSubmit="return false;">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">		
				{!!	$customer->setInputTemplate('factum::factum/forms'); !!}
				{!!	$customer->getInput(['param'=>'reference','placeholder'=>'Nombre de referencia']) !!}
				{!!	$customer->getInput(['param'=>'email','placeholder'=>'Email']) !!}
				{!!	$customer->getInput(['param'=>'telephone','placeholder'=>'Teléfono']) !!}	
				{!!	$customer->getInput(['param'=>'name','placeholder'=>'Nombre fiscal']) !!}	
				{!!	$customer->getInput(['param'=>'code','placeholder'=>'NIF']) !!}
				{!!	$customer->getInput(['param'=>'address','placeholder'=>'Direccón fiscal']) !!}	
				{!!	$customer->getInput(['param'=>'city_id','placeholder'=>'Seleccionar ciudad']) !!}
				{!!	$customer->getInput(['param'=>'postal_code_id','placeholder'=>'Seleccionar código postal']) !!}
				{!!	$customer->getInput(['param'=>'vat_id','placeholder'=>'Tasa impositiva']) !!}	
			</form>
		</div>
	</div>
@stop

@section('footer')
	@scripts(
		../admin/plugins/select2/js/select2.full.min.js,
		../admin/plugins/select2/js/i18n/[[language]].js,
		../admin/plugins/jquery-validation/jquery.validate.min.js,
		../admin/plugins/jquery-validation/localization/messages_[[language]].js,
		../admin/scripts/auto-jquery-validation.js,
		../admin/plugins/jquery-alphanum/jquery.alphanum.min.js,
		../admin/scripts/auto-alphanum.js,
		../admin/scripts/api-calls.js,
		../admin/scripts/auto-load-selects.js,
		../admin/scripts/auto-edit-form.js
	)
@stop