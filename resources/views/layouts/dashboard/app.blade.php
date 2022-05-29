<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title')</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/vendors/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/vendors/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/vendors/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/icon-font.min.css')}}">

	
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}">
	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/switchery/switchery.min.css')}}">
	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
	<!-- bootstrap-touchspin css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}">

	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/styles/theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/sweetalert2/sweetalert2.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
	<script src="{{ asset('dashboard/src/scripts/jquery.min.js')}}"></script>
	
	{{-- dashboard css --}}
	<script src="{{ asset('dashboard/src/plugins/jQuery-Knob-master/jquery.knob.min.js')}}"></script>
	{{-- <script src="{{ asset('dashboard/src/plugins/highcharts-6.0.7/code/highcharts.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/highcharts-6.0.7/code/highcharts-more.js')}}"></script> --}}
	<script src="{{ asset('dashboard/src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	{{-- <script src="{{ asset('dashboard/vendors/scripts/dashboard.js')}}"></script> --}}
	{{-- <script src="{{ asset('dashboard/vendors/scripts/dashboard2.js')}}"></script> --}}
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	{{-- <script src="{{ asset('dashboard/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script> --}}
	{{-- <script src="{{ asset('dashboard/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script> --}}
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	<script>
    	var url = "{{ url('/') }}";
    	var universal_token = "{{ csrf_token() }}"
    </script>
</head>
<body>

@include('layouts.dashboard.header')
@include('layouts.dashboard.leftbar')
@include('layouts.dashboard.sidebar')



<div class="mobile-menu-overlay"></div>
@yield('content')

@include('layouts.dashboard.footer')



<!-- js -->
	<script src="{{ asset('dashboard/vendors/scripts/core.js')}}"></script>
	{{-- <script src="{{ asset('dashboard/vendors/scripts/script.js')}}"></script> --}}
	<script src="{{ asset('dashboard/vendors/scripts/script.min.js')}}"></script>
	<script src="{{ asset('dashboard/vendors/scripts/process.js')}}"></script>
	<script src="{{ asset('dashboard/vendors/scripts/layout-settings.js')}}"></script>
	<!-- switchery js -->
	<script src="{{ asset('dashboard/src/plugins/switchery/switchery.min.js')}}"></script>
	<!-- bootstrap-tagsinput js -->
	<script src="{{ asset('dashboard/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
	<!-- bootstrap-touchspin js -->
	<script src="{{ asset('dashboard/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
	<script src="{{ asset('dashboard/vendors/scripts/advanced-components.js')}}"></script>


	<script src="{{ asset('dashboard/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{ asset('dashboard/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{ asset('dashboard/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
	<!-- Datatable Setting js -->
	<script src="{{ asset('dashboard/vendors/scripts/datatable-setting.js')}}"></script>
	<!-- add sweet alert js & css in footer -->
	

	<script>

		$('.options').hide();
		// Character & Page counter
		$('#message-content').on('keydown', function(e){

			var titleVal = $('#title').val();
			if (titleVal.length==0) {
				alert('enter message title first')
				$('#title').css('border-color', '#dd4c4c')
				return false;
			}else{

				$('#message-content').on('input', function(e){
					$('#title').css('border-color', '#d4d4d4')
					countChar();
				})
			}
			
		})
		var pcount = 0;

		// countChar();

		function countChar(){
			let charCount = $('#message-content').val().length;

			let countFactor = parseFloat(charCount/150)
			let countFactorStr = countFactor.toString();
			let countSplit = countFactorStr.split('.')
			
			let wholeNo = countSplit[0];
			let fraction = countSplit[1];

			let fractionToNo = parseInt(fraction)
			console.log(fractionToNo);
			if (isNaN(fractionToNo)) {
				addFactor = 0
			}else{
				addFactor = 1
			}

			let pageCount = parseInt(wholeNo) + parseInt(addFactor);

			pcount= pageCount;
			
			// alert(wholeNo)
			$('#char-count').html(charCount)
			$('#page-count').html(pageCount)
		}
		$('#send-option').on('change', function(){
			let $this = $(this);
			let option = $this.val();
			$('.options').hide();
			$('#'+option).show();
		})

		// Prevent whitespace from contacts field

		// prevent white space from being inputted in teanant url field
	    // var field = document.querySelector('[id="contact-input"]');
	    // field.addEventListener('keypress', function ( event ) {  
	    //    var key = event.keyCode;
	    //     if (key === 32) {
	    //       event.preventDefault();
	    //     }
	    // });

	   // $('#contact-input').on('input', function(){
	   // 		alert('hey')
	   // })

	   $(document).ready(function(){
		  $('.bootstrap-tagsinput').css('width', '100%')

		  $('.bootstrap-tagsinput').find('input').on('input', function() {
		  	let $this = $(this);
			$this.val($this.val().replace(/ /g, "").replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
		  })

		  setTimeout(function(){ 
	    	$('.alert-msg').empty();
	     }, 10000);

		});

	   
	</script>
</body>
</html>