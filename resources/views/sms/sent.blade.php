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
								<h4>Sent Messages</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item"><a href="index.html">Messages</a></li>
									<li class="breadcrumb-item active" aria-current="page">Sent</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Sent messages</h4>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">S/N</th>
									<th>Title</th>
									<th>Content</th>
									<th>Sent to</th>
									<th>Sent on</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($messages as $message)

									@php $contactArr = []; 
										// dd($message->messageStatus->color);
									@endphp

										@php
											foreach ($message->contacts as $key => $contact) {
												
												array_push($contactArr, $contact->title);
											}
										@endphp
										
									<tr>
										<td class="table-plus">1</td>
										<td>{{ substr($message->title, 0, 20) }}</td>
										<td>{{ substr($message->content, 0, 20) }}</td>
										<td> <small>{{ substr(implode(',', $contactArr), 0, 40) }}</small></td>
										<td>{{ date('d.m.Y', strtotime($message->created_at)) }}</td>
										<td><span class="badge badge-{{ $message->messageStatus->color }}">{{ $message->messageStatus->statement }}</span></td>
										<td>
											<a href="javascript::void(0)" class="btn btn-secondary btn-sm"  data-toggle="modal" data-target="#view-{{ $message->slug }}">View <i class="fa fa-eye"></i></a>
											{{-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-{{ $count }}">Edit <i class="fa fa-edit"></i></button> --}}
											{{-- <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{ $message->slug }}">Delete <i class="fa fa-trash"></i></button> --}}
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
														<small>Sent {{ date('d.m.Y', $message->sent_at) }}</small>
													</div>
													<div class="col-6 text-right">
														<small>Status: <span class="badge badge-{{ $message->messageStatus->color }}">{{ $message->messageStatus->statement }}</span></small>
													</div>
													
													<div class="col-12">
														<hr>
														<h6>Contacts</h6>
														<hr>
														@foreach($contactArr as $contact)
															<span class="badge badge-secondary mr-1">{{ $contact }}</span>
														@endforeach
													</div>
												</div>
											</div>
											<div class="modal-footer text-center py-3">
												<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Go back</button>
											</div>
									    </div>
									  </div>
									</div>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->

						
				
@endsection