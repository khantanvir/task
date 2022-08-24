<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>

@yield('userpanel')

<script>
	@if(Session::has('success'))
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true,
		"timeOut": "10000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
	}
			toastr.success("{{ session('success') }}");
	@endif
  
	@if(Session::has('error'))
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true,
		"timeOut": "10000",
		"positionClass": "toast-top-right",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
	}
			toastr.error("{{ session('error') }}");
	@endif
  
	@if(Session::has('info'))
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true,
		"timeOut": "10000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
	}
			toastr.info("{{ session('info') }}");
	@endif
  
	@if(Session::has('warning'))
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true,
		"timeOut": "10000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
	}
			toastr.warning("{{ session('warning') }}");
	@endif
  </script> 
  <script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	</script>
	
	<script>
		function getVal(x){
			var priority = $("#priority"+x).val();
			var task_id = $("#task_id"+x).val();
			
			$.post('{{ URL::to('task-status-change') }}',
			{
				priority: priority,
				task_id: task_id
			},
			function(data, status){
				if(data['result']['key'] == "200"){
					console.log(data);
					window.location.href = data['result']['url'];
				}
				//alert("Data: " + data + "\nStatus: " + status);
			});
		}
	</script>
</body>

</html>
