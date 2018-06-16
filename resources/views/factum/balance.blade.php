@extends('factum::factum/templates/index')

@section('head')
	<title>Balance Trimestre {{$trim}} de {{$year}}</title>
	@csss(
		css/balances.css
	)
@stop

@section('content')
	<div class="row mb-3">
		<div class="col-12">
			<h2 class="float-left">Balance Trimestre {{$trim}} de {{$year}}</h2>
			<a href="{{ layer_url() }}balances" class="float-left"><button class="btn btn-lg btn-primary ml-3"><i class="fa fa-arrow-left"></i></button></a>
		</div>
	</div>
	
	@php
		$c = rand(1,20);
		$p = rand(1,20);
		$sa = rand(40,100);
		$pu = rand(50,220);
		$i = rand(11000,25000);
		$e = rand(8000,12000);
	@endphp
	
	<div class="row text-center mb-5">
		<div class="indicator steelblue col-sm-6 col-12">
			<i class="fa fa-users"></i>
			{{$c}} Nuevos clientes ({{$sa}} ventas)
		</div>	
		<div class="indicator steelblue col-sm-6 col-12">
			<i class="fa fa-truck"></i>
			{{$p}} Nuevos proveedores ({{$pu}} Compras)
		</div>	
		<div class="indicator mediumaquamarine col-lg-3 col-sm-6 col-12">
			<i class="fa fa-file-alt"></i>
			{{$i}}€ Ingresos
		</div>
		<div class="indicator tomato col-lg-3 col-sm-6 col-12">
			<i class="fa fa-shopping-basket"></i>
			{{$e}}€ Gastos
		</div>
		<div class="indicator mediumaquamarine col-lg-3 col-sm-6 col-12">
			<i class="fa fa-money-bill-alt"></i>
			{{$i-$e}}€ Beneficios
		</div>		
		<div class="indicator tomato col-lg-3 col-sm-6 col-12">
			<i class="fa fa-university"></i>
			{{($i-$e)*0.21}}€ IVA
		</div>
	</div>	
	
	<div class="row">
		<div class="col-sm-6 col-12"><canvas id="incomes_expenses"></canvas></div>
		<div class="col-sm-6 col-12"><canvas id="sales_purchases"></canvas></div>
	</div>	
	
@stop

@section('footer')
	@scripts(
		plugins/Chart/Chart.js
	)
	<script>
	function random(){ return Math.floor(Math.random()*30) };
	var canvas1 = document.getElementById("incomes_expenses").getContext('2d');
	var canvas2 = document.getElementById("sales_purchases").getContext('2d');
	new Chart(canvas1, {
		type: 'line',
		data: {
			labels: ['SEM1','SEM2','SEM3','SEM4','SEM5','SEM6','SEM7','SEM8','SEM9','SEM10','SEM11','SEM12'],
			datasets: [{
				label: 'Ventas',
				backgroundColor: '#4682B4',
				borderColor: '#4682B4',
				data: [ random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random() ],
				fill: false,
			}, {
				label: 'Compras',
				fill: false,
				backgroundColor: '#86CAEE',
				borderColor: '#86CAEE',
				data: [ random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random() ],
			}]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Ventas / Compras'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Mes'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Operaciones'
					}
				}]
			}
		}
	});
	new Chart(canvas2, {
		type: 'line',
		data: {
			labels: ['SEM1','SEM2','SEM3','SEM4','SEM5','SEM6','SEM7','SEM8','SEM9','SEM10','SEM11','SEM12'],
			datasets: [{
				label: 'Ingresos',
				backgroundColor: '#66CDAA',
				borderColor: '#66CDAA',
				data: [ random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random() ],
				fill: false,
			}, {
				label: 'Gastos',
				fill: false,
				backgroundColor: '#FF6347',
				borderColor: '#FF6347',
				data: [ random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random(), random() ],
			}]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Ingresos / Gastos'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Mes'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Operaciones'
					}
				}]
			}
		}
	});	
	</script>
@stop