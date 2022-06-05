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
<div class="content" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 position-relative">
                            <div class="card" style="margin-top: 20%;">
                                <div class="card-header text-center" style="background-color: rgba(0,0,0,.03);">Password Reset Initiated </span></div>

                                <div class="card-body">
                                    {{-- @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif --}}
                                    <div class="text-center">
                                        <img src="{{ asset('dashboard/vendors/images/logo.png')}}"  width="100" alt="logo">
                                    </div>
                                    
                                    <div class="text-center">
                                        <p>Kindly check your email for a password reset instruction.</p>
                                        <p>If it's not in your inbox, kindly check your spam folder. </p>
                                        <p>If the mail is not resgistred with {{ env('APP_NAME') }}, no mail will be sent. Email not received? <a href="{{route('forgot-password') }}" class="text-dark"><strong>Try again.</strong></a></p>   
                                        
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
