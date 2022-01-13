@extends('layouts.front')

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
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header text-center" style="background-color: rgba(0,0,0,.03);">{{ __('Verify Your Email Address') }}<span class="text-dark" style="font-weight: bold;"> ( {{ session('email') }} ) </span></div>

                                <div class="card-body">
                                    {{-- @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif --}}
                                    <div class="text-center">
                                        <img src="{{ asset('front_assets/images/rotate.png') }}" width="100" alt="">
                                    </div>
                                    
                                    <div class="text-center">
                                        <p>Kindly check your email for a verification link.</p>
                                        <p>If it's not in your inbox, kindly check your spam folder. </p>

                                        <form class="d-inline" method="POST" action="{{ url('resend-verification') }}">
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
