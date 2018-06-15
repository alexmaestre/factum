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
		../admin/plugins/bootstrap-sweetalert/sweetalert.css,
		../admin/css/fontawesome-pro-core.css,
		../admin/css/fontawesome-pro-solid.css,
		../admin/plugins/select2/css/select2.min.css,
		../admin/plugins/select2/css/select2-bootstrap.min.css,
		css/login.css
		)					
	</head>

	<body>		
		
		<div class="jumbotron h-100 d-flex align-items-center">
		
			@yield('content')
			
		</div>
				
		@scripts(
		js/jquery-3.3.1.min.js,
		js/bootstrap.min.js,
		../admin/plugins/bootstrap-sweetalert/sweetalert.min.js,
		js/swal_error.js,
		../admin/plugins/toastr/toastr.min.js,
		../admin/plugins/jquery-validation/jquery.validate.min.js,
		../admin/plugins/jquery-validation/additional-methods.min.js,
		../admin/plugins/jquery-alphanum/jquery.alphanum.min.js,
		../admin/scripts/auto-alphanum.js,
		../admin/plugins/jquery-validation/jquery.validate.min.js,
		../admin/plugins/jquery-validation/localization/messages_[[language]].js,
		../admin/scripts/auto-jquery-validation.js,
		../admin/scripts/api-calls.js,
		../admin/plugins/select2/js/select2.full.min.js,
		../admin/plugins/select2/js/i18n/[[language]].js,
		../admin/scripts/auto-load-selects.js
		)			
		
		<script language="javascript">
			var layer = {language : <?php echo json_encode(config('layer')->language, JSON_UNESCAPED_UNICODE); ?>};
			var api_url = '{{ url("/") }}/api/';
			var token = "{{ csrf_token() }}";		
			jQuery(document).ready(function() {
				$("#open-sign-in").click(function(e) {
					e.preventDefault();
					$("#login").toggleClass("d-none");
					$("#sign-in").toggleClass("d-none");
				});					
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

	</body>
</html>		