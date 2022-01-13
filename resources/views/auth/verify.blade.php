@extends('layouts.app')

@section('content')
<style>
    .card{
        border: 1px solid rgba(0,0,0,.125);
    }
    /*.card-header{
        border-bottom: 1px solid rgba(0,0,0,.125);
    }*/
</style>
<!-- Page Content -->
<div class="content" style="min-height:67px;">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @include('layouts.shared.alert')
                            <div class="card">
                                <div class="card-header text-center" style="background-color: rgba(0,0,0,.03);">{{ __('Verify Your Email Address') }}<span class="text-dark" style="font-weight: bold;"> ( {{ session('email') }} ) </span></div>

                                <div class="card-body">
                                    
                                    <div class="text-center">
                                        {{-- <img src="{{ asset('assets/img/logo/logo.png') }}"  style="width: 180px; margin-top: 20px;"> --}}
                                        <img src="{{ asset('assets/img/logo/logo.png') }}" width="150" alt="">
                                    </div>
                                    
                                    <div class="text-center mt-3">
                                        <p>Kindly check your email for a verification link.</p>
                                        <p>If it's not in your inbox, kindly check your spam folder. </p>

                                        <form class="d-inline" method="POST" action="{{ route('resend-verification') }}">
                                        @csrf
                                        Email not received? 
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                    </form>
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
