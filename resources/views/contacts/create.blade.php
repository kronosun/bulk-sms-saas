@extends('layouts.dashboard.app')
@section('title', 'Create Contact')
@section('content')
	<script>
		
	   $(document).ready(function(){
		  
		  $('.bootstrap-tagsinput').find('input').on('input', function() {
		  	let $this = $(this);
			$this.val($this.val().replace(/ /g, ""));
		  })

		});
	</script>
	<div class="main-container">
		@include('layouts.shared.alert')
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Create Contact</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 mb-30">
						<div class="pd-20 card-box">
							<h5 class="h4 text-blue mb-20">Add Contact by Preference</h5>
							<div class="tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active text-blue" data-toggle="tab" href="#home" role="tab" aria-selected="true">Manual Input <i class="fa fa-pencil"></i></a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-blue" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Upload CSV <i class="fa fa-file"></i></a>
									</li>
									{{-- <li class="nav-item">
										<a class="nav-link text-blue" data-toggle="tab" href="#contact" role="tab" aria-selected="false">Import From phone (Android only)</a>
									</li> --}}
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="home" role="tabpanel">
										<div class="pd-20">
											
											<form method="post" action="{{ route('save-contact') }}">
												@csrf
												<div class="col-6 form-group">
													<label class="col-form-label">Contact Title</label>
													
													<input type="text" name="title" class="form-control" placeholder="e.g Family and Friends" value="{{ old('title') }}">
													@error('title')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div> 
												<div class="col-6 form-group">
													<label class="col-form-label">Phone numbers</label>
													<small>(separate each phone number with a comma)</small>
													<input type="text" name="numbers" id="contact-input" class="form-control w-100" data-role="tagsinput" value="{{ old('numbers') }}">
													@error('numbers')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-6 form-group text-right">
													<button class="btn">Save</button>
												</div> 

											</form>
										</div>
									</div>
									<div class="tab-pane fade" id="profile" role="tabpanel">
										<div class="pd-20">
											<form method="post" action="{{ route('upload-contact') }}" enctype="multipart/form-data">
												@csrf
												<div class="col-6 form-group">
													<label class="col-form-label">Contact Title</label>
													
													<input type="text" name="title" class="form-control" placeholder="e.g Family and Friends" value="{{ old('title') }}">
													@error('title')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div> 
												<div class="col-6 form-group">
													<label class="col-form-label">Upload contact <small class="text-danger">csv only</small></label>
													<input type="file" name="contact" class="form-control" id="contact-upload">
													@error('contact')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-6 form-group text-right">
													<button class="btn">Upload <i class="fa fa-upload"></i></button>
												</div>
											</form>
										</div>
									</div>
									{{-- <div class="tab-pane fade" id="contact" role="tabpanel">
										<div class="pd-20">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										</div>
									</div> --}}
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>

	<script>
		    $('#contact-upload').on('change', function(){

		        $('.target-under').empty();
		        $('.upload-text').empty();
		            var file_count=0;
		          for (var i = 0; i < this.files.length; i++) {
		                file_count++;
		                var fr = new FileReader();
		                /*fr.onload = function(e) {
		                  $('.target-under').append('<div class="row mb-3 px-5" style="background-color: #f4f4f4; margin-bottom: 20px;"><div class="col-xs-8" style="color: navy;">jdjjfjfjkfjfjfjfjf.pdf</div> <div class="col-xs-2">30kb</div> <div  class="col-xs-2"><i class="fa fa-close" id="'+file_count+'" style="color: red;"  data-toggle="tooltip" title="remove"></i></div></div>')
		                }*/

		                 var filename= this.files[i].name;
		                 var size = this.files[i].size;
		                 // convert size in bytes to kilobytes
		                 var sizeInKB = parseFloat(size)/1000;
		                 if (sizeInKB>10240) {
		                 	alert('File(s) selected is greater than the allowed file size (10mb)');
		                 	$('#contact-upload').val('');
		                    $('.upload-text').empty();
		                 	break;
		                 }
		                 
		                 // filename

		                // var file_split=filename.split('.');

		                var extension =filename.replace(/^.*\./, '');

		                if (extension == filename) {
		                    extension = '';
		                } else {
		                    // if there is an extension, we convert to lower case
		                    // (N.B. this conversion will not effect the value of the extension
		                    // on the file upload.)
		                    extension = extension.toLowerCase();


		                }

		                var ext_list=['csv'];
		               if(jQuery.inArray(extension, ext_list) == -1) {

		                    var file_validity='bad';
		                    
		                }else{
		                    var file_validity='good';
		                }
		                if (file_validity=='bad') {
		                    alert('Invalid file format selected (only csv file format allowed)');
		                    $('#contact-upload').val('');
		                    $('.upload-text').empty();
		                }else{
		                    fr.onload = function(e) {
		                        if (e.target.result) {}
		                            if (extension=='png'||extension=='jpg'||extension=='jpeg') {
		                                $('.target-under').append('<img src="' + e.target.result + '" width="50px" height="50px">');
		                            }
		                      
		                    }
		                    fr.readAsDataURL(this.files[i]);
		                }
		            
		          }

		          $('.upload-text').append(this.files.length+' files selected');


		    })
		</script>
@endsection