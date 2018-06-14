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
		css/login.css,
		)					
	</head>

	<body>		
		<div class="container">
			<body class="text-center">
			<div class="alert alert-danger alert-dismissable @if(!session('error')) d-none @endif">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<i class="fa fa-warning"></i> 
				<strong>¡Error!</strong> <span id="error"> @if(session('error')) {{session('error')}} @endif</span>
			</div>
			<form class="form-signin" method="post">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">				
			  <h1 class="h3 mb-3 font-weight-normal"><i class="fa fa-chart-bar"></i> <b>Factum</b></h1>
			  <label for="loginEmail" class="sr-only">Email</label>
			  <input type="email" id="loginEmail" class="form-control" placeholder="Email" name="loginEmail" data-rule-required="true" data-msg-required="Debe introducir un email" data-rule-email="true" data-msg-email="Debe introducir un email correcto" required autofocus>
			  <label for="loginPassword" class="sr-only">Password</label>
			  <input type="password" id="loginPassword" class="form-control" autocomplete="off" placeholder="Clave" name="loginPassword" data-rule-required="true" data-msg-required="Debe introducir su clave" required>
			  <div class="checkbox mb-3">
				<label>
				  <input type="checkbox" value="remember-me"> Remember me
				</label>
			  </div>
			  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
			</form>
			</body>
		</div>
				
		@scripts(
		js/jquery-3.3.1.min.js,
		js/bootstrap.min.js,
		../admin/plugins/toastr/toastr.min.js,
		../admin/plugins/jquery-validation/jquery.validate.min.js,
		../admin/plugins/jquery-validation/additional-methods.min.js
		)								
		
		<script language="javascript">
			var layer = {language : <?php echo json_encode(config('layer')->language, JSON_UNESCAPED_UNICODE); ?>};
			var api_url = '{{ url("/") }}/api/';
			var token = "{{ csrf_token() }}";		
			jQuery(document).ready(function() {
				@if(session('notifications'))
					@foreach(session('notifications') as $notification)
						toastr['{{ $notification['type'] }}']('{{ $notification['message'] }}','{{ $notification['title'] }}');
					@endforeach
					{{ Session::forget('notifications') }}
				@endif				
			});
		</script>

	</body>
</html>		