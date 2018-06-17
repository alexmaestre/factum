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
			<h2 class="float-left">Datos del ingreso</h2>
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
			<table class="table table-bordered table-hover table-checkable">
				<thead>
					<tr>
						<th>Base imponible</td>
						<th>Tasa impositiva</td>
						<th>Impuestos</td>
						<th>Total</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ number_format($income->base,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
						<td>{{ $income->company->vat->translation->name }}</td>
						<td>{{ number_format($income->taxes,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
						<td>{{ number_format($income->total,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>	
	
	<div class="row mt-3 mb-1">
		<div class="col-12">
			<h2 class="float-left">Conceptos</h2>
			<button class="btn btn-lg btn-primary ml-3" data-toggle="modal" data-target="#addItem"><i class="fa fa-plus"></i></button>
		</div>
	</div>	
	
	<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Añadir concepto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" class="data-validation">
				<div class="modal-body mx-3">
					<div class="md-form mb-2">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">	
						<input type="hidden" name="_action" value="create-item">							
						<input type="text" class="form-control" id="item[name]" name="item[name]" placeholder="Nombre" data-rule-required="true" maxlength="32" data-rule-maxlength="32" data-label="Nombre del concepto">
						<input type="text" class="form-control input-mask-money" id="item[base]" name="item[base]" placeholder="Base imponible" data-rule-required="true" maxlength="12"  data-rule-maxlength="12" data-label="Base imponible del concepto">
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-center">
					<button class="btn btn-lg btn-primary w100">Añadir concepto</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row mt-1">			
		<div class="col-12">
			<table class="table table-striped table-bordered table-hover table-checkable" data-datatable="true" data-datatable-filter="false" data-datatable-plural="conceptos" style="width:100%">
				<thead>
					<tr>
						<th>Concepto</th>
						<th>Base</th>
						<th>Impuestos</th>
						<th>Total</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($income->items as $item)
						<tr>
							<td>{{ $item->name }}</td>
							<td>{{ number_format($item->base,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td>{{ number_format($item->taxes,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td>{{ number_format($item->total,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td>
								<form method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">	
									<input type="hidden" name="_action" value="delete-item">									
									<input type="hidden" name="item" value="{{ $item->id }}">
									<button type="button" class="btn btn-xs btn-primary pull-center deleteButton" 
									data-type="error" 
									data-title="¿Estás seguro de querer eliminarlo?" 
									data-message="El concepto será eliminado"
									data-no-ajax="true"
									><i class="fa fa-trash"></i></button>
								</form>
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