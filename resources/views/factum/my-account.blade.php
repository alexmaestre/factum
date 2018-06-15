@extends('factum::factum/templates/index')

@section('head')
	<title>Mi cuenta</title>
	@csss(
		../admin/plugins/select2/css/select2.min.css,
		../admin/plugins/select2/css/select2-bootstrap.min.css
	)
@stop

@section('content')
<h2>Mi cuenta</h2>
<div class="row">
	<form class="data-validation editObjectForm" method="post" onSubmit="return false;">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">		
		{!!	$user->setInputTemplate('factum::factum/forms'); !!}
		{!!	$user->getInput(['param'=>'name','placeholder'=>'Nombre','label']) !!}
		{!!	$user->getInput(['param'=>'surname','placeholder'=>'Apellidos']) !!}
		{!!	$user->getInput(['param'=>'email','placeholder'=>'Email']) !!}
		{!!	$user->getInput(['param'=>'password','placeholder'=>'Clave']) !!}
		{!!	$user->getInput(['param'=>'city_id','placeholder'=>'Ciudad']) !!}
		{!!	$user->getInput(['param'=>'postal_code_id','placeholder'=>'Código postal']) !!}
	</form>
</div>
@stop

@section('footer')
	@scripts(
		../admin/plugins/select2/js/select2.full.min.js,
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