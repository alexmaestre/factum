@extends('factum::factum/templates/index')

@section('head')
	<title>Ingresos</title>
	@csss(
		plugins/DataTables/datatables.min.css,
		plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css
	)
@stop

@section('content')

	<div class="row mb-5">
		<div class="col-12">
			<h2 class="float-left">Ingresos</h2>
			<a href="{{ layer_url() }}ingresos/nuevo" class="float-left"><button class="btn btn-lg btn-primary ml-3"><i class="fa fa-plus"></i></button></a>
		</div>
	</div>
	
	<div class="row">		
		<div class="col-12">
			<table class="table table-striped table-bordered table-hover table-checkable" data-datatable="true" data-datatable-plural="ingresos" data-datatable-length="50" data-datatable-order='[4,"desc"]'>
				<thead>
					<tr>
						<th>Factura</th>
						<th>Cliente</th>
						<th>Nombre</th>
						<th>Conceptos</th>
						<th>Fecha</th>
						<th>Base imponible</th>
						<th>Impuestos</th>
						<th>Total</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($incomes as $income)
						<tr data-href="{{ layer_url() }}ingreso/{{ $income->id }}">
							<td>{{ $income->code }}</td>
							<td>{{ $income->receiver->reference }}</td>
							<td>{{ $income->name }}</td>
							<td>{{ $income->items->count() }}</td>
							<td data-order="{{ strtotime($income->date) }}">{{ $income->date->format(config('layer')->language->date_format) }}</td>
							<td>{{ number_format($income->base,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td>{{ number_format($income->taxes,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td>{{ number_format($income->total,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td data-no-href="true">
							<a href="{{layer_url()}}factura/{{md5($income->receiver->code.$income->receiver->created_at)}}/{{$income->id}}" target="blank">
								<button class="btn btn-xs btn-primary pull-center ml-2"><i class="fa fa-file-pdf"></i></button>
							</a>
							<button class="btn btn-xs btn-primary pull-center deleteButton" 
							data-type="error" 
							data-title="¿Estás seguro de querer eliminarlo?" 
							data-message="El ingreso será eliminado y todos sus datos desaparecerán"
							data-model="invoices"
							data-id="{{$income->id}}"
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
	@scripts(
		plugins/DataTables/datatables.min.js,
		plugins/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js,
		../admin/scripts/auto-datatables.js,
		../admin/scripts/api-calls.js,
		../admin/scripts/auto-delete-buttons.js		
	)
@stop