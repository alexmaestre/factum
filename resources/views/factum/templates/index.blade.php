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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		@yield('head')
	</head>

	<body>
		@yield('content')
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
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
				@foreach ($errors->all() as $error)
					swal_error('{{ $error }}');
				@endforeach					
			});
		</script>

		@yield('footer')

	</body>
</html>