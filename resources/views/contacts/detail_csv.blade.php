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
						<div class="col-12" id="alert-msg"></div>
						
					</div>
					<div class="pb-20 table-responsive">
						<table class="table hover multiple-select-row data-table-export nowrap table-hover">
							<thead>
								<tr>
									<th>S/N</th>
									@foreach($headRow as $index => $head)
									@if(in_array(str_replace(' ','_',strtolower($head)), ['phone', 'phone_no', 'phone_number', 'phone_no.']))
										@php $phoneField = $head @endphp
										
									@endif

									@if(in_array(str_replace(' ','_',strtolower($head)), ['name', 'firstname', 'fullname', 'full_name', 'first_name']))
										@php $nameField = $head @endphp
										
									@endif
									<th> 
										@if(session('old_phone_column'))
											@if(session('old_phone_column')==$head)
												Phone
											@else
												{{ $head }}
											@endif
										@else
											{{ $head }}
										@endif
										@if(!session('old_phone_column'))
											@if(!isset($phoneField)) 
										 		<a href="javascript::void(0)"  data-toggle="modal" data-target="#rename-index-{{ $index }}"><i class="fa fa-pencil"></i> </a> 
											@endif
										@else
											@if(!isset($nameField))
												@if(session('old_phone_column')!=$head)
												
										 			<a href="javascript::void(0)"  data-toggle="modal" data-target="#point-name-index-{{ $index }}"><i class="fa fa-pencil"></i> </a> 
										 		@endif
											@endif

										@endif
									</th>

									@endforeach
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($bodyRow as $key => $row)
									@php $count ++ @endphp
								
									<tr>
										<td>{{ $count }}</td>
										@foreach($bodyRow[$key] as $data)
											<td>{{ $data }}</td>
										@endforeach
										<th>
											<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-{{ $count }}">Edit <i class="fa fa-edit"></i></button>
											<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{ $count }}">Delete <i class="fa fa-trash"></i></button>
										</th> 
									</tr>
									<!--Edit Modal -->
									<div class="modal fade" id="edit-{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									    	<form class="form-control" action="{{ route('edit-number') }}" method="post">
									    		@csrf
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLongTitle">Edit Contact</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">
											        	<input type="hidden" name="contact_id" value="{{ $key }}">
											        	<input type="text" name="number" class="form-control" value="">
											        	<input type="hidden" name="old_number" value="">
											        
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											        <button type="" class="btn btn-primary">Save changes</button>
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
											      	Delete ?
											        	<input type="hidden" name="contact_id" value="{{ $contact->id }}">
											        	<input type="hidden" name="number" class="form-control" value="">
											        	
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
				@if(!session('old_phone_column'))
					@if(!isset($phoneField))
						<script>
								$('#alert-msg').html('<div class="alert text-center alert-warning alert-dismissible fade show mt-3" role="alert" style="font-size: 14px;">No Column labelled as "Phone", "Phone Number", or "Phone no"  Please specify the phone number column by renaming it. </div>');
							</script>
					@endif
				@else
					@if(!isset($nameField))
						<script>
								$('#alert-msg').html('<div class="alert text-center alert-warning alert-dismissible fade show mt-3" role="alert" style="font-size: 14px;">No Column labelled as "Name", "Fullname", or "Firstname"  Please specify the name column by renaming it. <a href="{{ route('skip-name-column', $contact->slug) }}" class="text-primary">Skip this</a></div>');
							</script>
					@endif
				@endif

				@foreach($headRow as $index=> $head)

					<!--Rename column modal -->
					<div class="modal fade" id="rename-index-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					    	<form action="{{ route('rename-contact-column') }}" method="post">
					    		@csrf
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Rename Column to "phone"</h5>
							        {{-- <small>Accepted name (Phone, Phone numbe)</small> --}}
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<p>Column will be renamed from "{{ $head }}" to "Phone"</p>
							        	<input type="hidden" name="contact_slug" value="{{ $contact->slug }}">
							        	<input type="hidden" name="old_name" value="{{ $head }}">
							        	<input type="hidden" name="index" value="{{ $index }}">
							        
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							        <button type="" class="btn btn-primary">Proceed >></button>
							      </div>
					      	</form>
					    </div>
					  </div>
					</div>


					<!--Indicate name column modal -->
					<div class="modal fade" id="point-name-index-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					    	<form action="{{ route('rename-name-column') }}" method="post">
					    		@csrf
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Rename Column to "Name"</h5>
							        {{-- <small>Accepted name (Phone, Phone numbe)</small> --}}
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<p>Column will be renamed from "{{ $head }}" to "Name"</p>
							        	<input type="hidden" name="contact_slug" value="{{ $contact->slug }}">
							        	<input type="hidden" name="old_name" value="{{ $head }}">
							        	<input type="hidden" name="index" value="{{ $index }}">
							        
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							        <button type="" class="btn btn-primary">Proceed >></button>
							      </div>
					      	</form>
					    </div>
					  </div>
					</div>
				@endforeach
@endsection