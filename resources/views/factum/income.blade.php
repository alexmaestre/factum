@extends('factum::factum/templates/index')

@section('head')
	<title>Factura {{ $income->code }}</title>
	@csss(
		../admin/plugins/select2/css/select2.min.css,
		../admin/plugins/select2/css/select2-bootstrap.min.css,
		../admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css,
		plugins/DataTables/datatables.min.css,
		plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css
	)
@stop

@section('content')
	<div class="row mb-3">
		<div class="col-12">
			<h2 class="float-left">Datos de la factura {{ $income->code }}</h2>
			<a href="{{ layer_url() }}ingresos" class="float-left"><button class="btn btn-lg btn-primary ml-3"><i class="fa fa-arrow-left"></i></button></a>
		</div>
	</div>
	
	<div class="row">		
		<div class="col-12">
			<form class="data-validation editObjectForm" method="post" onSubmit="return false;">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">		
				{!!	$income->setInputTemplate('factum::factum/forms'); !!}
				{!!	$income->getInput(['param'=>'name','placeholder'=>'Nombre']) !!}
				{!!	$income->getInput(['param'=>'code','placeholder'=>'Código o numeración']) !!}
				<div class="input-icon input-group right mb-2">
					<label for="invoice[company_id]" class="sr-only">Cliente</label>
					<span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span>
					<select class="form-control select2" data-api="invoices" data-object-id="{{$income->id}}" id="invoice[company_id]" name="invoice[company_id]">
						@foreach($company->customers as $customer)
							<option value="{{$customer->id}}" @if($customer->id == $income->receiver_company_id) selected @endif>{{$customer->reference}}</option>
						@endforeach
					</select>
				</div>
				{!!	$income->getInput(['param'=>'date','placeholder'=>'Fecha']) !!}	
			</form>
		</div>
	</div>
	
	<div class="row mt-3 mb-1">
		<div class="col-12">
			<h2 class="float-left">Conceptos</h2>
		</div>
	</div>	
	
	<div class="row mt-1">			
		<div class="col-12">
			<table class="table table-striped table-bordered table-hover table-checkable" data-datatable="true" data-datatable-filter="false" data-datatable-plural="conceptos" style="width:100%">
				<thead>
					<tr>
						<th>Concepto</th>
						<th>Base</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($income->items as $item)
						<tr>
							<td>{{ $item->name }}</td>
							<td>{{ number_format($item->base,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td data-no-href="true">
								<button class="btn btn-xs btn-primary pull-center deleteButton" 
								data-type="error" 
								data-title="¿Estás seguro de querer eliminarlo?" 
								data-message="El concepto será eliminado"
								data-model="invoice_item"
								data-id="{{$item->id}}"
								><i class="fa fa-trash"></i></button>
							</td>	
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>	
	
@stop

@section('footer')
	@js(../admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js)
	@js(../admin/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.{{config('layer')->language->iso}}.min.js)	
	@scripts(
		plugins/DataTables/datatables.min.js,
		plugins/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js,
		../admin/scripts/auto-datatables.js,
		../admin/scripts/api-calls.js,
		../admin/plugins/select2/js/select2.full.min.js,
		../admin/plugins/select2/js/i18n/[[language]].js,
		../admin/plugins/jquery-validation/jquery.validate.min.js,
		../admin/plugins/jquery-validation/localization/messages_[[language]].js,
		../admin/scripts/auto-jquery-validation.js,
		../admin/plugins/jquery-alphanum/jquery.alphanum.min.js,
		../admin/scripts/auto-alphanum.js,
		../admin/scripts/api-calls.js,
		../admin/scripts/auto-load-selects.js,
		../admin/scripts/auto-edit-form.js,
		../admin/scripts/auto-delete-buttons.js	
	)
@stop