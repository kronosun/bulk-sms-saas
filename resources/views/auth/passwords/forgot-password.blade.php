@extends('layouts.auth.app')

@section('content')
<div class="login-menu">
                <ul>
                    <li><a href="javascript::void(0)">Forgot Password</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('dashboard/vendors/images/password-img.png') }}" alt="Illustration of forgot password">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center">Password Reset</h2>
                            <p class="text-left pt-3"><i class="fa fa-info-circle pr-2" title="please use a registered email"></i>please enter the  email you want us to send your password reset link to.</p>
                        </div>
                        <div class="alert-msg text-center">
   
                        </div>                       

                        <form method="post" action="{{ route('send-password-reset-link') }}">
                            @csrf                           
                             <div class="input-group custom">
                                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
                                </div>
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button class="btn auth-btn btn-lg btn-block">Resend</button>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
