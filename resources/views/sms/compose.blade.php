@extends('layouts.dashboard.app')
@section('title', 'Compose SMS')
@section('content')
	
	<div class="main-container">
		 @include('layouts.shared.alert')
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							{{-- <div class="title">
								<h4>Form</h4>
							</div> --}}
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>	
									<li class="breadcrumb-item active" aria-current="page">Compose Message</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Write your message</h4>
							<p class="mb-30">Your message is saved automaticaly as you type</p>
						</div>
					
					</div>
					<form>
						<div class="form-group">
							<label class="col-form-label">Message Title</label>
								<input class="form-control compulsory-field" id="title" type="text" placeholder="Message title" required>
								<p class="text-danger" style="display: none;">This Field is Required</p>
						</div>
						<div class="form-group">
							<label class=" col-form-label">Message Content</label>
							<textarea class="form-control compulsory-field" name="message" id="message-content" placeholder="start typing..."></textarea>
							<p class="text-danger" style="display: none;">This Field is Required</p>
							<input type="hidden" id="message-slug" value="">
						</div>
						<div class="text-right">
							<small class="form-text text-muted"><span id="char-count">30</span> characters (<span id="page-count">1</span> page).</small>
						</div>
						<div class="row">
							<div class="form-group col-6">
								<label class="col-form-label">Send option</label>
								<select class="form-control" id="send-option">
									<option selected disabled value="">Select One</option>
									<option value="existing">Existing contacts</option>
									<option value="upload">Upload new contacts</option>
									<option value="manual_input">Manualy input contacts</option>
								</select>
								<p class="text-danger" style="display: none;">This Field is Required</p>
							</div>

							<div class="col-6 form-group options" id="existing">
								<label class="col-form-label">Select Contacts Group</label>
								<select class="custom-select2 form-control existing" multiple="multiple" style="width: 100%;">
										
									<optgroup label="Contact Groups">
										@foreach(Auth::user()->contacts as $contact)
										<option value="{{ $contact->id }}">{{ $contact->title }}</option>
										@endforeach
									</optgroup>
								</select>
								<p class="text-danger" style="display: none;">This Field is Required</p>
							</div>

							<div class="col-6 form-group options" id="upload">
								<label class="col-form-label">Upload new contact</label>
								<small>CSV files only</small>
								<input type="file" name="contact_upload" class="form-control compulsory-field">
								<p class="text-danger" style="display: none;">This Field is Required</p>
							</div>

							<div class="col-6 form-group options" id="manual_input">
								<label class="col-form-label">Input Contacts</label>
								<small>separate each contact with a comma or space</small>
								<input type="text" name="contact_input" id="contact-input" class="form-control w-100 compulsory-field manual_input" data-role="tagsinput">
								<p class="text-danger" style="display: none;">This Field is Required</p>
							</div> 
							<div class="col-12 text-right">
								<a href="#" class="btn">Send later <i class="fa fa-calendar"></i></a>
								<button class="btn" type="button" id="send-now">Send now<i class="fa fa-paper-plane"></i></button>
							</div>
						</div>
					</form>
						
						
				</div>
			</div>
		</div>
				<!-- Input Validation End -->

	</div>


	<script>
		
		$(document).ready(function(){
			var typeCount = 0
			$('#message-content').on('input', function(){
				// alert('yes')
				let $this = $(this)
				typeCount = typeCount+1;
				if (typeCount==1) {
					setInterval(function(){
						let msgSlug = $('#message-slug').val();

						let content = $this.val();
						let title = $('#title').val();

						$.ajax({
							type: 'POST',
							url: "{{ route('save-message') }}",
							data: {
								title: title,
								content: content,
								slug: msgSlug,
								_token: universal_token
							},
							success:function(response){
								console.log(response);
								 $('#message-slug').val(response);
							}
						});
					}, 5000);
				}
				
			
			
		})

		$('#send-now').on('click', function(){

			let option = $('#send-option').val();
			
			if (option==null) {
				validate('#send-option');
				return;
				
			}else{

				let target = $('.'+option);
				// console.log(target.className);
				if (target.val()=='') {
					// console.log()
					validate('.'+option);
					return
				}else{

					let msgSlug = $('#message-slug').val();
					// if sending to manually inputted contact
					if (option=='manual_input') {
						let numbers = $('#contact-input').val()
						$.ajax({

							type: 'POST',
							url: "{{ route('send-composed-message') }}",
							data: {
								slug: msgSlug,
								numbers: numbers,
								_token: universal_token
							},
							success:function(response){
								let feedback = JSON.parse(response);
								if (feedback.status == 'success') {
									console.log(response);
									return;

								}else{
									console.log(response);
									return;
								}
								
								 // $('#message-slug').val(response);
							}
						});
					}
					// if sending to manually existing contatcs
					if (option=='existing') {
						let contacts = $('.existing').val()
						$.ajax({

							type: 'POST',
							url: "{{ route('send-composed-message') }}",
							data: {
								slug: msgSlug,
								contacts: contacts,
								_token: universal_token
							},
							success:function(response){
								let feedback = JSON.parse(response);
								if (feedback.status == 'success') {
									window.location.replace("{{ route('sent-sms') }}");
								}
								console.log(response);
								 // $('#message-slug').val(response);
							}
						});
					}
					
				}
			}
			 
		})

		$('.custom-select2').next().find('.select2-selection__rendered').click(function(){
			alert('hey');
		});



		// $('.custom-select2').next().on('click', function(){
		// 	alert('hey')
		// 	// validate('.select2');
		// })

			function validate(element){

				if($(element).hasClass('custom-select2')){
					$(element).next().css('border', '1px solid red');
					$(element).next().next().show();
				}else{
					if ($(element).attr('data-role')=='tagsinput') {
						$(element).prev().css('border', '1px solid red');
						$(element).next().show();
					}else{
						$(element).css('border', '1px solid red');
						$(element).next().show();
					}
					
				}
				
			}

			function unvalidate(element){
				if($(element).hasClass('custom-select2')){
					$(element).next().css('border', '1px solid #d4d4d4');
					$(element).next().next().hide();
				}else{
					if ($(element).attr('data-role')=='tagsinput') {
						$(element).prev().css('border', '1px solid #d4d4d4');
						$(element).next().hide();
					}else{
						$(element).css('border', '1px solid #d4d4d4');
						$(element).next().hide();
					}
					
				}
				
			}

		})
		


	</script>
@endsection