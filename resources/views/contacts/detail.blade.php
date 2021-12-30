@extends('layouts.dashboard.app')
@section('title', 'Create Contact')
@section('content')

<div class="main-container">
	@include('layouts.shared.alert')
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Contact List</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item"><a href="{{ route('contacts') }}">Contacts</a></li>
									<li class="breadcrumb-item active" aria-current="page">{{ $contact->title }}</li>
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
	<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20 row">
						<div class="col-md-2">
							<h4 class="text-blue h4">{{ $contact->title }}</h4>
						</div>
						
						<div class="text-right col-md-10">
							<button class="btn btn-sm" data-toggle="modal" data-target="#rename-modal">Rename <i class="fa fa-edit"></i></button>
							<button class="btn btn-sm" data-toggle="modal" data-target="#add-numbers">Add numbers <i class="fa fa-plus"></i></button>
						</div>
						
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap table-hover">
							<thead>
								<tr>
									{{-- <th class="table-plus datatable-nosort">Name</th> --}}
									<th>S/N</th>
									@isset($names)
										<th>Name</th>
									@endisset
									<th>Phone</th>
									{{-- <th>Address</th>--}}
									
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($numbers as $key=> $number)
								@php $count ++ @endphp
								<tr id="row-{{ $count }}">
									
									{{-- <td class="table-plus">Gloria F. Mead</td> --}}
									<td>{{ $count }}</td>
									@isset($names)
										<th id="name-{{ $count }}">{{ $names[$key] }}</th>
									@endisset
									<td id="number-{{ $count }}">{{ $number }}</td>
									<th>
										<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-{{ $count }}">Edit <i class="fa fa-edit"></i></button>
										<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{ $count }}">Delete <i class="fa fa-trash"></i></button>
									</th> 
								</tr>
								<!--Edit Modal -->
									<div class="modal fade" id="edit-{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									    	<form class="form-control" action="{{ route('edit-number') }}" method="post" id="form-{{ $count }}">
									    		@csrf
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLongTitle">Edit Contact</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">
											        	<input type="hidden" name="contact_id" value="{{ $contact->id }}">
											        	<div class="form-group">
											        		<input type="text" name="number" class="form-control" value="{{ $number }}">
											        		<input type="hidden" name="old_number" value="{{ $number }}">
											        	</div>
											        	@isset($names)
											        	<div class="form-group">
											        		<input type="text" name="name" class="form-control" value="{{ $names[$key] }}">
											        		<input type="hidden" name="old_name" value="{{ $names[$key] }}">
											        	</div>
											        	@endisset
											        	

											        
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											        <button type="button" class="btn btn-primary edit-contact-btn" number="{{ $count }}">Save changes</button>
											      </div>
									      	</form>
									    </div>
									  </div>
									</div>





									<!--Edit Modal -->
									<div class="modal fade" id="delete-{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									    	<form  action="{{ route('delete-number') }}" method="post">
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
											      	Delete {{ $number }}?
											        	<input type="hidden" name="contact_id" value="{{ $contact->id }}">
											        	<input type="hidden" name="number" class="form-control" value="{{ $number }}">
											        	
											      </div>
											      <hr>
											      <div class="modal-foote text-center py-3">
											        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Go back</button>
											        <button type="" class="btn btn-sm btn-primary">Proceed >></button>
											      </div>
									      	</form>
									    </div>
									  </div>
									</div>




								@endforeach
							</tbody>
						</table>

						
					</div>
				</div>
				<!-- Export Datatable End -->


				<!--Rename Modal -->
				<div class="modal fade" id="rename-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				    	<form action="{{ route('rename-contact') }}" method="post">
				    		@csrf
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">Rename Contact</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        	<input type="hidden" name="contact_slug" value="{{ $contact->slug }}">
						        	<input type="text" name="title" class="form-control" value="{{ $contact->title }}">
						        
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="" class="btn btn-primary">Save changes</button>
						      </div>
				      	</form>
				    </div>
				  </div>

				</div>


				<!--Add Numbers Modal -->
				<div class="modal fade" id="add-numbers" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				    	<form action="{{ route('add-numbers-to-contact') }}" method="post">
				    		@csrf
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">Add Numbers</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        	<input type="hidden" name="contact_slug" value="{{ $contact->slug }}">
						        	<div class="form-group">
										<label class="col-form-label">Phone numbers</label>
										<small>(separate each phone number with a comma)</small>
										<input type="text" name="numbers" id="contact-input" class="form-control w-100" data-role="tagsinput">
										@error('numbers')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
						        
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="" class="btn btn-primary">Save changes</button>
						      </div>
				      	</form>
				    </div>
				  </div>


				</div>

				<script>
					$('.edit-contact-btn').on('click', function(){
						let $this = $(this);
						let oldHtml = $this.html();
						let targetNumber= $this.attr('number')
						console.log(targetNumber)
						let formData = $('#form-'+targetNumber).serialize();

						$this.html('<i class="fa fa-spin fa-spinner"></i>');
						
						$this.prop('disabled', true);
						$.ajax({
							type: 'POST',
							url: "{{ route('edit-number') }}",
							data: formData,
							success:function(response){
								$this.prop('disabled', false);
								$this.html(oldHtml);
								$('#edit-'+targetNumber).modal('hide');
								let feedback = JSON.parse(response);
								if (feedback.status=='success') {
									$('#name-'+targetNumber).text(feedback.name);
									$('#number-'+targetNumber).text(feedback.number);
								}
								flashMessage('success', 'Contact Updated')
								// alert('Contact Updated');
							},
							error:function(param1, param2, param3){
								alert(param3);
							}
						});


					});
				</script>
@endsection