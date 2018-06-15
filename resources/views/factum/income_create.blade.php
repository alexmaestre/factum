@extends('factum::factum/templates/index')

@section('head')
		@csss(
		../admin/plugins/select2/css/select2.min.css,
		../admin/plugins/select2/css/select2-bootstrap.min.css,
		../admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css
		)		
@stop

@section('content')

	<div class="row mb-3">
		<div class="col-12">
			<h2 class="float-left">Nuevo ingreso</h2>
			<a href="{{ layer_url() }}ingresos" class="float-left"><button class="btn btn-lg btn-primary ml-3"><i class="fa fa-arrow-left"></i></button></a>
		</div>
	</div>
	
	<div class="row">		
		<div class="col-12">
			<form class="data-validation" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">	
				<input type="hidden" name="_add_callback_url" value="ingresos">				
				{!!	$income->setInputTemplate('factum::factum/forms'); !!}
				{!!	$income->getInput(['param'=>'name','placeholder'=>'Nombre']) !!}
				{!!	$income->getInput(['param'=>'company_id','placeholder'=>'Proveedor',"options"=>[""=>"Seleccionar empresa receptora"]]) !!}
				{!!	$income->getInput(['param'=>'date','placeholder'=>'Fecha']) !!}	
				<button class="btn btn-lg btn-primary btn-block" type="submit">Añadir ingreso</button>
			</form>		
		</div>
	</div>
	
@stop

@section('footer')
		@js(../admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js)
		@js(../admin/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.{{config('layer')->language->iso}}.min.js)
		@scripts(
		../admin/plugins/jquery-validation/jquery.validate.min.js,
		../admin/plugins/jquery-validation/additional-methods.min.js,
		../admin/plugins/jquery-alphanum/jquery.alphanum.min.js,
		../admin/scripts/auto-alphanum.js,
		../admin/plugins/jquery-validation/jquery.validate.min.js,
		../admin/plugins/jquery-validation/localization/messages_[[language]].js,
		../admin/scripts/auto-jquery-validation.js,
		../admin/scripts/api-calls.js,
		../admin/plugins/select2/js/select2.full.min.js,
		../admin/plugins/select2/js/i18n/[[language]].js,
		../admin/scripts/auto-load-selects.js,
		../admin/scripts/auto-datepicker.js
		)	
@stop