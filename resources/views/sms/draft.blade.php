@extends('layouts.dashboard.app')
@section('title', 'Create Contact')
@section('content')

<div class="main-container">
	
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Sent Messages</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item"><a href="index.html">Messages</a></li>
									<li class="breadcrumb-item active" aria-current="page">drafts</li>
								</ol>
							</nav>
						</div>
						{{-- <div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									January 2018
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Export List</a>
									<a class="dropdown-item" href="#">Policies</a>
									<a class="dropdown-item" href="#">View Assets</a>
								</div>
							</div>
						</div> --}}
					</div>
				</div>
				 @include('layouts.shared.alert')
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Sent messages</h4>
{{-- 						<p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> --}}
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">S/N</th>
									<th>Title</th>
									<th>Content</th>
									<th>Composed on</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($messages as $message)
									@php $count ++; @endphp
									<tr id="row-{{ $message->slug }}">
										<td class="table-plus">1</td>
										<td>{{ substr($message->title, 0, 20) }} {{ strlen($message->title)>20?'...':'' }}</td>
										<td>{{ substr($message->content, 0, 20) }} {{ strlen($message->content)>20?'...':'' }}</td>
										<td>{{ date('d.m.Y', strtotime($message->created_at)) }}</td>
										<td><span class="badge badge-{{ $message->messageStatus->color }}">{{ $message->messageStatus->statement }}</span></td>
										<td>
											<a href="javascript::void(0)" class="btn btn-secondary btn-sm"  data-toggle="modal" data-target="#view-{{ $message->slug }}">View <i class="fa fa-eye"></i></a>
											<a href="{{ route('edit-message', $message->slug) }}" class="btn btn-primary btn-sm">Edit <i class="fa fa-edit"></i></a>
											{{-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-{{ $count }}">Edit <i class="fa fa-edit"></i></button> --}}
											<button class="btn btn-danger btn-sm" type="button" id="delete-btn-{{ $message->slug }}" slug="{{ $message->slug }}">Delete <i class="fa fa-trash"></i></button>
										</td> 
									</tr>

									<!--Edit Modal -->
									<div class="modal fade" id="view-{{ $message->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									    	
											<div class="modal-header pt-3 row pr-1">
												<div class="col-11">
													<h6 class="text-center modal-title">{{ $message->title }}</h6>
												</div>
												<div class="col-1 text-left">
											  		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											      		<span aria-hidden="true">&times;</span>
											    	</button>
												</div>



											</div>
											<div class="modal-body text-left">
												<div style="white-space: pre-wrap;">{{ $message->content }}</div>
												<hr>
												<div class="row">
													<div class="col-6 text-left">
														<small>Composed {{ date('d.m.Y', strtotime($message->created_at)) }}</small>
													</div>
													<div class="col-6 text-right">
														<small>Status: <span class="badge badge-{{ $message->messageStatus->color }}">{{ $message->messageStatus->statement }}</span></small>
													</div>
													
													
												</div>
											</div>
											<div class="modal-footer text-center py-3">
												<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Go back</button>
											</div>
									    </div>
									  </div>
									</div>

									<!--Delete Modal -->

									<script>
										//A title with a text under
								        $('#delete-btn-{{ $message->slug }}').click(function () {
								           let $this = $(this);
											let oldHtml = $this.html();
											let targetNumber= $this.attr('slug')
								            swal({
								                title: 'Delete {{ $message->title }}?',
								                text: "You won't be able to revert this!",
								                icon: 'warning',
								                buttons: true,
								                // confirmButtonClass: 'btn btn-success',
								                // cancelButtonClass: 'btn btn-danger',
								                // confirmButtonText: 'Yes, delete it!',

								            }).then((proceed)=>{
								            	if (proceed) {
								            		$.ajax({
														type: 'POST',
														url: "{{ route('delete-message') }}",
														data: {
															message_slug:"{{ $message->slug }}",
															_token: universal_token
														},
														success:function(response){
															$this.prop('disabled', false);
															$this.html(oldHtml);
															$('#delete-'+targetNumber).modal('hide');
															let feedback = JSON.parse(response);
															if (feedback.status=='success') {
																
																$('#row-'+targetNumber).remove();												
															}
															 swal({
													                title: feedback.status,
													                text: feedback.msg,
													                icon: feedback.alert,
													                
													                // confirmButtonClass: 'btn btn-success',
													                // cancelButtonClass: 'btn btn-danger',
													                // confirmButtonText: 'Yes, delete it!',

													            })
															// flashMessage(feedback.alert, feedback.msg)
															// alert('Contact Updated');
														},
														error:function(param1, param2, param3){
															alert(param3);
														}
													});
								            	}
								            })
								            	
								            	
								            	
								            	
								            	// $(document).find('.swal2-confirm').on('click', function(){
								            	// 	alert('confimred')
								            	// })
								            	
								                // swal(
								                //     'Deleted!',
								                //     'Your file has been deleted.',
								                //     'success'
								                // )
								            })
									        
								        // });
									</script>
									{{-- <div class="modal fade" id="delete-{{ $message->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									    	<form method="post" id="form-{{ $message->slug }}">
									    		@csrf
											      <div class="modal-heade pt-3 row pr-1">
											      	<div class="col-11">
											      		<h6 class="text-center modal-title">Confirm action</h6>
											      	</div>
											      	<div class="col-1 text-left">
												      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												          <span aria-hidden="true">&times;</span>
												        </button>
											      	</div>
											        

											        
											      </div>
											      <hr>
											      <div class="modal-bod text-center">
											      	Delete {{ $message->title }}?
											        	<input type="hidden" name="message_slug" value="{{ $message->slug }}">
											        	
											      </div>
											      <hr>
											      <div class="modal-foote text-center py-3">
											        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Go back</button>
											        <button type="button" class="btn btn-primary delete-msg-btn" slug="{{ $message->slug }}">Proceed >></button>
											      </div>
									      	</form>
									    </div>
									  </div>
									</div> --}}
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
				<!-- Simple Datatable End -->

					

					<script>

						$('.delete-msg-btn').on('click', function(){
							let $this = $(this);
							let oldHtml = $this.html();
							let targetNumber= $this.attr('slug')
							console.log(targetNumber)
							let formData = $('#form-'+targetNumber).serialize();

							$this.html('<i class="fa fa-spin fa-spinner"></i>');
							
							$this.prop('disabled', true);
							$.ajax({
								type: 'POST',
								url: "{{ route('delete-message') }}",
								data: formData,
								success:function(response){
									$this.prop('disabled', false);
									$this.html(oldHtml);
									$('#delete-'+targetNumber).modal('hide');
									let feedback = JSON.parse(response);
									if (feedback.status=='success') {
										$('#row-'+targetNumber).remove();												
									}
									flashMessage(feedback.alert, feedback.msg)
									// alert('Contact Updated');
								},
								error:function(param1, param2, param3){
									alert(param3);
								}
							});


						});


					</script>
				
@endsection