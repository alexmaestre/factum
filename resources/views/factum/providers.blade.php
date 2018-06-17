@extends('factum::factum/templates/index')

@section('head')
<title>Proveedores</title>
@csss(
	plugins/DataTables/datatables.min.css,
	plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css
)
@stop

@section('content')

	<div class="row mb-5">
		<div class="col-12">
			<h2 class="float-left">Proveedores</h2>
			<a href="{{ layer_url() }}proveedores/nuevo" class="float-left"><button class="btn btn-lg btn-primary ml-3"><i class="fa fa-plus"></i></button></a>
		</div>
	</div>
	
	@if($providers->count() > 0)
	<div class="row">		
		<div class="col-12">
			<table class="table table-striped table-bordered table-hover table-checkable" data-datatable="true" data-datatable-plural="proveedores" data-datatable-length="500" style="width:100%">
				<thead>
					<tr>
						<th>Nombre de referencia</th>
						<th>NIF</th>
						<th>Nombre fiscal</th>						
						<th>Ciudad</th>
						<th>CP</th>
						<th>Teléfono</th>
						<th>Tasa aplicable</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($providers as $provider)
						<tr data-href="{{ layer_url() }}proveedor/{{ $provider->id }}">
							<td>{{ $provider->reference }}</td>
							<td>{{ $provider->code }}</td>							
							<td>{{ $provider->name }}</td>
							<td>{{ @$provider->city->translation->name }}</td>
							<td>{{ @$provider->postal_code->code }}</td>
							<td>{{ @$provider->telephone }}</td>							
							<td>{{ $provider->vat->translation->name }}</td>	
							<td data-no-href="true">
							@if($provider->incomes->isEmpty() && $provider->expenses->isEmpty()) 
								<button class="btn btn-xs btn-primary pull-center deleteButton" 
								data-type="error" 
								data-title="¿Estás seguro de querer eliminarlo?" 
								data-message="El proveedor será eliminado y todos sus datos desaparecerán"
								data-model="companies"
								data-id="{{$provider->id}}"
								><i class="fa fa-trash"></i></button>
							@else
								<button class="btn btn-xs btn-danger pull-center disabledDeleteButton" 
								data-title="Acción no permitida"
								data-message="Este proveedor no puede borrarse porque tiene facturas asociadas">
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
		Su empresa no tiene proveedores registrados
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