<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	{{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/vendors/images/apple-touch-icon.png')}}"> --}}
	
 <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo/fav-icon.png') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/jquery-steps/jquery.steps.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/style.css')}}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	<style>
		.auth-btn{
			font-weight: 600; background-color: #1d2840; color: white; padding: 7px 12px; border: 1px solid transparent; border-radius: 5px;
		}
		.auth-btn:hover{
			background-color: transparent; border: 1px solid #1d2840; color: #1d2840;
		}
		.text-skezzole{
			color: #628c23;
		}
	</style>
</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="{{ url('/') }}">
					<img src="{{ asset('dashboard/vendors/images/logo.png')}}" alt="">
				</a>
			</div>

			@yield('content')


<!-- success Popup html End -->
	<!-- js -->
	<script src="{{ asset('dashboard/vendors/scripts/core.js')}}"></script>
	<script src="{{ asset('dashboard/vendors/scripts/script.min.js')}}"></script>
	<script src="{{ asset('dashboard/vendors/scripts/process.js')}}"></script>
	<script src="{{ asset('dashboard/vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/jquery-steps/jquery.steps.js')}}"></script>
	<script src="{{ asset('dashboard/vendors/scripts/steps-setting.js')}}"></script>

	
</body>

</html>