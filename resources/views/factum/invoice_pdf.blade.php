<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<title>Factura {{ $income->code }}</title>	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style>
			body{ font-size:13px;  }
			th{ background-color:#228AE6; color:white; }
			th,td{ padding:0.4rem !important; line-height:18px !important; border:solid 1px #228AE6 !important }
			.bc{background-color:#eaf3fb}
			.total{background-color:#A5D1F8}
		</style>
	</head>

	<body>
	
		<div class="container-fluid">
			
			<div class="row mt-2">
				<div class="col-12">
					<table class="table table-bordered table-hover table-checkable">
						<thead>
							<tr>
								<th>Facturado de</th>
								<th>Facturado a</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="bc">{{ $income->company->name }}</td>
								<td>{{ $income->receiver->name }}</td>
							</tr>
							<tr>
								<td class="bc">{{ $income->company->code }}</td>
								<td>{{ $income->receiver->code }}</td>
							</tr>
							<tr>
								<td class="bc">{{ $income->company->address }}</td>
								<td>{{ $income->receiver->address }}</td>
							</tr>
							<tr>
								<td class="bc">-{{ @$income->company->postal_code->code }}- {{ @$income->company->city->translation->name }}</td>
								<td>-{{ @$income->company->postal_code->code }}- {{ @$income->receiver->city->translation->name }}</td>
							</tr>							
							<tr>
								<td class="bc">{{ @$income->company->telephone }}</td>
								<td>{{ @$income->receiver->telephone }}</td>
							</tr>
							<tr>
								<td class="bc">{{ @$income->company->email }}</td>
								<td>{{ @$income->receiver->email }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			

			<div class="row mt-2">			
				<div class="col-12">
					<table class="table table-bordered table-hover table-checkable">
						<thead>
							<tr>
								<th>Factura</th>
								<th>Fecha</th>
								<th>Tipo de IVA</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $income->code }}</td>
								<td>{{ $income->date->format(config('layer')->language->date_format) }}</td>
								<td>{{ $income->company->vat->translation->name }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>					

			<div class="row mt-2">			
				<div class="col-12">
					<table class="table table-bordered table-hover table-checkable">
						<thead>
							<tr>
								<th>Concepto</th>
								<th>Base imponible</th>
								<th>Impuestos</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($income->items as $item)
								<tr>
									<td>{{ $item->name }}</td>
									<td>{{ number_format($item->base,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
									<td>{{ number_format($item->taxes,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
									<td>{{ number_format($item->total,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
								</tr>
							@endforeach
							<tr class="total">
								<td><b>TOTAL</b></td>
								<td>{{ number_format($income->base,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
								<td>{{ number_format($income->taxes,2,",",".") }}{{ config('layer')->currency->symbol }}</td>
								<td><b>{{ number_format($income->total,2,",",".") }}{{ config('layer')->currency->symbol }}</b></td>
							</tr>							
						</tbody>
					</table>
				</div>
			</div>	
			
			
		</div>
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	

	</body>
</html>