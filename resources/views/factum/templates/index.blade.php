<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->
	<head>
		<meta charset="utf-8"/>
		<title>Factum</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>	
		@csss(
		css/bootstrap.min.css,
		css/font-awesome.min.css,
		../admin/plugins/toastr/toastr.min.css,
		../admin/css/fontawesome-pro-core.css,
		../admin/css/fontawesome-pro-solid.css,
		css/index.css
		)
		@yield('head')
	</head>

	<body>
			
		<div id="wrapper" @if(!isset($_COOKIE['menu']) || $_COOKIE['menu']==1) class="toggled" @endif>

			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li class="sidebar-brand">
						<a href="{{ layer_url() }}"><b>Factum</b></a><i class="fa fa-bars" id="menu-toggle"></i>
					</li>
					<li><a href="{{ layer_url() }}mi-cuenta"><i class="fa fa-fw fa-user"></i> Mi cuenta</a></li>
					<li><a href="{{ layer_url() }}mi-empresa"><i class="fa fa-fw fa-industry"></i> Mi empresa</a></li>
					<li><a href="{{ layer_url() }}clientes"><i class="fa fa-fw fa-users"></i> Clientes</a></li>
					<li><a href="{{ layer_url() }}proveedores"><i class="fa fa-fw fa-truck"></i> Proveedores</a></li>
					<li><a href="{{ layer_url() }}ingresos"><i class="fa fa-fw fa-file-alt"></i> Ingresos</a></li>
					<li><a href="{{ layer_url() }}gastos"><i class="fa fa-fw fa-shopping-basket"></i> Gastos</a></li>
					<li><a href="{{ layer_url() }}balances"><i class="fa fa-fw fa-chart-area"></i> Balances</a></li>
					<li><a href="{{ layer_url() }}logout"><i class="fa fa-fw fa-sign-out-alt"></i> Salir</a></li>
					
				</ul>
			</div>
			<!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="container-fluid">
					@yield('content')
				</div>
			</div>
		</div>		
		
		@scripts(
		js/jquery-3.3.1.min.js,
		js/bootstrap.min.js,
		js/js.cookie.js
		)			

		<script language="javascript">
			var layer = {language : <?php echo json_encode(config('layer')->language, JSON_UNESCAPED_UNICODE); ?>};
			var api_url = '{{ url("/") }}/api/';
			var token = "{{ csrf_token() }}";	
			
			if(Cookies.get('menu') == undefined){ Cookies.set('menu',1); };
			
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
				if($("#wrapper").hasClass("toggled")){ Cookies.set('menu',1); }else{ Cookies.set('menu',0); };
				console.log(Cookies.get('menu'));
			});			
			
			$(document).ready(function() {	
				@if(session('notifications'))
					@foreach(session('notifications') as $notification)
						toastr['{{ $notification['type'] }}']('{{ $notification['message'] }}','{{ $notification['title'] }}');
					@endforeach
					{{ Session::forget('notifications') }}
				@endif
				@foreach ($errors->all() as $error)
					swal_error('{{ $error }}');
				@endforeach					
			});
		</script>

		@yield('footer')

	</body>
</html>