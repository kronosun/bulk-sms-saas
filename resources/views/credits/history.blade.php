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
								<h4>Unit Purchase</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">unit purchase</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- Checkbox select Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20 form-inline">
						<h4 class="text-blue h4 mr-3">My Purchase History </h4> <span class="badge badge-secondary"> {{ $sum->sum('quantity') }} Units</span> <span class="badge bg-sk ml-3"> {{ number_format( $sum->get()->sum('payments.amount'), 2)}} NGN</span>
					</div>
					<div class="pb-20">
						<table class="checkbox-datatable table nowrap">
							<thead>

								<tr>
									<th><div class="dt-checkbox">
											<input type="checkbox" name="select_all" value="1" id="example-select-all">
											<span class="dt-checkbox-label"></span>
										</div>
									</th>
									<th>S/N</th>
									<th>Quantity</th>
									<th>Cost</th>
									<th>Date</th> 
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($history as $purchase)
								@php $count ++ @endphp
								<tr>
									<td></td>
									<td>{{ $count }}</td>
									<td>{{ $purchase->quantity }}</td>
									<td>{{number_format($purchase->payments->amount, 2)}} {{ $purchase->payments->currency }} </td>
									<td>{{ date('d.m.Y', strtotime($purchase->created_at)) }}</td>
									 
								</tr>

								
								@endforeach
								
							</tbody>
						</table>
						{{ $history->links() }}
					</div>
				</div>

				
@endsection