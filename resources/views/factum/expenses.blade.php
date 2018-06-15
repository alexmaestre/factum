@extends('factum::factum/templates/index')

@section('head')
@csss(
	plugins/DataTables/datatables.min.css,
	plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css
)
@stop

@section('content')

	<div class="row mb-5">
		<div class="col-12">
			<h2 class="float-left">Gastos</h2>
			<a href="{{ layer_url() }}gastos/nuevo" class="float-left"><button class="btn btn-lg btn-primary ml-3"><i class="fa fa-plus"></i></button></a>
		</div>
	</div>
	
	@if($expenses->count() > 0)
	<div class="row">		
		<div class="col-12">
			<table class="table table-striped table-bordered table-hover table-checkable" data-datatable="true" data-datatable-plural="proveedores" data-datatable-length="500" style="width:100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Proveedor</th>
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
					@foreach ($expenses as $expense)
						<tr data-href="{{ layer_url() }}gasto/{{ $expense->id }}">
							<td>{{ $expense->id }}</td>
							<td>{{ $expense->company->reference }}</td>
							<td>{{ $expense->name }}</td>
							<td>{{ $expense->items->count() }}</td>
							<td>{{ $expense->date->format(config('layer')->language->date_format) }}</td>
							<td>{{ number_format($expense->base,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td>{{ number_format($expense->taxes,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td>{{ number_format($expense->total,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
							<td data-no-href="true">
							@if($expense->items->isEmpty()) 
								<button class="btn btn-xs btn-primary pull-center deleteButton" 
								data-type="error" 
								data-title="¿Estás seguro de querer eliminarlo?" 
								data-message="El gasto será eliminado y todos sus datos desaparecerán"
								data-model="invoices"
								data-id="{{$expense->id}}"
								><i class="fa fa-trash"></i></button>
							@else
								<button class="btn btn-xs btn-danger pull-center disabledDeleteButton" 
								data-title="Acción no permitida"
								data-message="Este gasto no puede borrarse porque tiene items asociados">
								<i class="fa fa-trash"></i></button>
							@endif
							</td>	
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@else
		Su empresa no tiene gastos registrados
	@endif
	
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