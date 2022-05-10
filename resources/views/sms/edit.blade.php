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
									<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Messages</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Edit message</h4>
							<p class="mb-30">Your message is saved automatically as you type</p>
						</div>
					
					</div>
					<form>
						<div class="form-group">
							<label class="col-form-label">Message Title</label>
								<input class="form-control compulsory-field" id="title" type="text" placeholder="Message title" value="{{ $message->title }}" required>
								<p class="text-danger" style="display: none;">This Field is Required</p>
						</div>
						<div class="form-group">
							<label class=" col-form-label">Message Content</label>
							<textarea class="form-control compulsory-field" name="message" id="message-content" placeholder="start typing...">{{ $message->content }}</textarea>
							<p class="text-danger" style="display: none;">This Field is Required</p>
							<input type="hidden" id="message-slug" value="{{ $message->slug }}">
						</div>
						<div class="text-right">
							<small class="form-text text-muted"><span id="char-count">0</span> characters (<span id="page-count">1</span> page).</small>
						</div>
						<div class="row">
							<div class="form-group col-6">
								<label class="col-form-label">Send option</label>
								<select class="form-control" id="send-option">
									<option selected disabled value="">Select One</option>
									<option value="existing" >Existing contacts</option>
									{{-- <option value="upload">Upload new contacts</option> --}}
									<option value="manual_input">Manualy input contacts</option>
								</select>
								<p class="text-danger" style="display: none;">This Field is Required</p>
							</div>

							<div class="col-6 form-group options" id="existing">
								<label class="col-form-label">Select Contacts Group</label>
								<select class="custom-select2 form-control existing" multiple="multiple" style="width: 100%;">
										
									<optgroup label="Contact Groups">
										@foreach(Auth::user()->contacts as $contact)
										@php
											$contactArr[$contact->id] = count(explode(',', $contact->numbers))
										@endphp
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
								<a href="javascript:void(0)" id="send-later" class="btn">Send later <i class="fa fa-calendar"></i></a>
								<button class="btn" type="button" id="send-now">Send now<i class="fa fa-paper-plane"></i></button>
							</div>

							
						</div>
					</form>
						
						
				</div>
			</div>
		</div>
				<!-- Input Validation End -->

	</div>

	<!-- Modal -->
	<div class="modal fade" id="calendar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Select Date & Time</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="col-12 text-center">
				<div class="mb-20">
					{{-- <label>Datedpicker Inline</label> --}}
					<div class="datepicker-here" data-timepicker="true" data-language='en'></div>
				</div>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="save-schedule">Save Schedule</button>
	      </div>
	    </div>
	  </div>
	</div>
{{-- 	{{ dd($contactArr) }} --}}
	<script>
		
		$(document).ready(function(){
			var contactArr = <?= json_encode($contactArr) ?>;
			

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
			// when the send no button is clicked

			$('#send-now').on('click', function(){
				let oldHtml = $(this).html();
				let $this = $(this);
				$this.html('<i class="fa fa-spin fa-spinner"></i>')
				let option = $('#send-option').val();
				let msgContent = $('#message-content').val();
				let msgTitle = $('#title').val();
				if(msgTitle==''){
					validate('#title');
					$this.html(oldHtml)
					return;
				}
				if(msgContent==''){
					validate('#message-content');
					$this.html(oldHtml)
					return;
				}
				
				if (option==null) {
					validate('#send-option');
					$this.html(oldHtml)
					return;
					
				}
				let target = $('.'+option);
				// console.log(target.className);
				if (target.val()=='') {
					// console.log()
					validate('.'+option);
					$this.html(oldHtml)
					return
				}else{

					let msgSlug = $('#message-slug').val();
					// if sending to manually inputted contact
					if (option=='manual_input') {
						let numbers = $('#contact-input').val();
						let numSplit = numbers.split(',');

						let availableUnits = parseFloat("{{ Auth::user()->units->sum('available_units') }}")
						let requiredUnits = parseFloat(numSplit.length) * parseFloat(pcount);
						let capacity = availableUnits/parseFloat(pcount);
						if (requiredUnits > availableUnits) {
							alert('hey')
							swal({
				                title: 'Insufficient Units?',
				                text: "You only have "+availableUnits+" units but your message requires at least "+requiredUnits+" units to deliver to all numbers. If you want to continue, click proceed and we shall send your message to first "+Math.trunc(capacity)+" numbers only",
				                icon: 'warning',
				                buttons: true,
				                // confirmButtonClass: 'btn btn-success',
				                // cancelButtonClass: 'btn btn-danger',
				                // confirmButtonText: 'Yes, delete it!',

				            }).then((proceed)=>{
				            	if (proceed) {
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
												console.log(feedback);
												$this.html(oldHtml)
												return;

											}else{
												swal({
									                title: feedback.status,
									                text: feedback.msg,
									                icon: feedback.alert,

									            })
												console.log(response);
												$this.html(oldHtml)
												return;
											}
										}
									});
				            	}
				            })
				            $this.html(oldHtml)
						}else{

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
										console.log(feedback);
										$this.html(oldHtml)
										return;

									}else{
										$this.html(oldHtml)
										swal({
							                title: feedback.status,
							                text: feedback.msg,
							                icon: feedback.alert,

							            })
							            $this.html(oldHtml)
										console.log(response);
										return;
									}
								}
							});
						}
						
						
					}
					// if sending to existing contatcs
					if (option=='existing') {
						let cc = $('.existing').val();
						
						let contactSplit = cc.toString().split(',');
						let numberCount = 0;
						$.each(contactSplit, function(index, value){
							numberCount = numberCount + parseInt(contactArr[value])
				            // alert();
				        });

						let availableUnits = parseFloat("{{ Auth::user()->units->sum('available_units') }}")
						let requiredUnits = parseFloat(numberCount) * parseFloat(pcount);
						let capacity = availableUnits/parseFloat(pcount);
						if (requiredUnits > availableUnits) {

							swal({
				                title: 'Insufficient Units?',
				                text: "You only have "+availableUnits+" units but your message requires at least "+requiredUnits+" units to deliver to all numbers. If you want to continue, click proceed and we shall send your message to first "+Math.trunc(capacity)+" numbers only",
				                icon: 'warning',
				                buttons: true,
				                // confirmButtonClass: 'btn btn-success',
				                // cancelButtonClass: 'btn btn-danger',
				                // confirmButtonText: 'Yes, delete it!',

				            }).then((proceed)=>{
				            	if (proceed) {
									$.ajax({

										type: 'POST',
										url: "{{ route('send-composed-message') }}",
										data: {
											slug: msgSlug,
											contacts: cc,
											_token: universal_token
										},
										success:function(response){
											let feedback = JSON.parse(response);
											if (feedback.status == 'success') {
												window.location.replace("{{ route('sent-sms') }}");

											}else{
												alert('Something went wrong');
											}
											console.log(response);
											 // $('#message-slug').val(response);
										}
									});
								}
								$this.html(oldHtml)
							})
						}else{
							// return;
							$.ajax({

								type: 'POST',
								url: "{{ route('send-composed-message') }}",
								data: {
									slug: msgSlug,
									contacts: cc,
									_token: universal_token
								},
								success:function(response){
									$this.html(oldHtml)
									let feedback = JSON.parse(response);
									if (feedback.status == 'success') {
										window.location.replace("{{ route('sent-sms') }}");

									}
									console.log(response);
									$this.html(oldHtml)
									 // $('#message-slug').val(response);
								},
								error:function(par1, par2, par3){
									alert(par3)
									$this.html(oldHtml)
								}
							});
						}
					
					}
				
				 
				}
			});



			// When the send later button is clicked
			$('#send-later').on('click', function(){

				var option = $('#send-option').val();
				let msgContent = $('#message-content').val();
				let msgTitle = $('#title').val();
				
				if(msgTitle==''){
					validate('#title');
					return;
				}
				if(msgContent==''){
					validate('#message-content');
					return;
				}
				if (option==null) {
					validate('#send-option');
					return;
					
				}
				let target = $('.'+option);
				// console.log(target.className);
				if (target.val()=='') {
					// console.log()
					validate('.'+option);
					return
				}else{

					let msgSlug = $('#message-slug').val();
					$('#calendar-modal').modal('show');	
				}
				 
			})

			$('#save-schedule').on('click', function(){
				saveSchedule();
			})



			$('.custom-select2').next().find('.select2-selection__rendered').click(function(){
				// alert('hey');
			});

			function saveSchedule(option){
				let date = $('.-selected-').attr('data-date');
				let month = parseInt($('.-selected-').attr('data-month'))+1;
				let year = $('.-selected-').attr('data-year');
				let hour = $('.datepicker--time-current-hours').text()
				let minute = $('.datepicker--time-current-minutes').text()
				let ampm = $('.datepicker--time-current-ampm').text()
				let fulldate = date+'-'+month+'-'+year+' '+hour+':'+minute+' '+ampm;

				let recipientption = $('#send-option').val();
				console.log(recipientption)
				// let msgContent = $('#message-content').val();
				// let msgTitle = $('#title').val();
				if (recipientption=='existing') {
					let msgSlug = $('#message-slug').val();
					let Receivingcontacts = $('.existing').val()
					console.log(Receivingcontacts)
					$.ajax({

						type: 'POST',
						url: "{{ route('shedule-message') }}",
						data: {
							slug: msgSlug,
							contacts: Receivingcontacts,
							fulldate: fulldate,
							@isset($action)
							@if($action=='modify_schedule')
							action: "{{ $action }}",
							msgId: "{{ $message->id }}",
							@endif
							@endisset
							_token: universal_token
						},
						success:function(response){
							let feedback = JSON.parse(response);
							if (feedback.status=='success') {
								window.location.replace("{{ route('scheduled-sms') }}");
							}
							
						}
					});
				}
				if (recipientption=='manual_input') {
					let msgSlug = $('#message-slug').val();
					let Receivingcontacts = $('.existing').val();
					let ReceivingNumbers = $('#contact-input').val();
					console.log(Receivingcontacts)
					$.ajax({

						type: 'POST',
						url: "{{ route('shedule-message') }}",
						data: {
							slug: msgSlug,
							numbers: ReceivingNumbers,
							fulldate: fulldate,
							@isset($action)
							@if($action=='modify_schedule')
							action: "{{ $action }}",
							msgId: "{{ $message->id }}",
							@endif
							@endisset
							_token: universal_token
						},
						success:function(response){
							let feedback = JSON.parse(response);
							if (feedback.status=='success') {
								window.location.replace("{{ route('scheduled-sms') }}");
							}
							
						}
					});
				}
				
			}

			function validate(element){

				if($(element).hasClass('custom-select2')){
					$(element).next().css('border', '1px solid red');
					$(element).next().next().show();
				}else{

					if($(element).attr('data-role')=='tagsinput') {
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
		
		// $('#title').blur(function(event) {
		// 	    event.target.checkValidity();
		// 	}).bind('invalid', function(event) {
		// 	    setTimeout(function() { $(event.target).css('border', '1px solid red');}, 50);
		// 	});
		


	</script>
@endsection