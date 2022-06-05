@extends('layouts.auth.app')

@section('content')
<div class="login-menu">
                <ul>
                    <li><a href="javascript::void(0)">Create New Password</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('dashboard/vendors/images/password-img.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center">Create New Password</h2>
                        </div>
                        <div class="alert-msg text-center">
   
                        </div>                        
                        <form method="post" action="{{ route('change-password') }}">
                            @csrf
                            <span><i class=" fa fa-info-circle pr-2" title="please use a password you can remember, but not easy to guess eg. @Dan1w$"></i>Hint</span>     
                            <br><span class="text-danger" id="passwordMessage"></span>                     
                            <div class="input-group custom">
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="New password" min="8" id="new-pass" required oninput="inputValidation()">
                                <div class="input-group-append custom">
                                      <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                             </div>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                             @enderror
                             <span class="text-danger" id="confirmPasswordMessage"></span>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="Confirm password" name="password_confirmation" min="8" id="new-pass-1" oninput="inputValidation()" required>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
                                            use code for form submit
                                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                        -->
                                        <button class="btn auth-btn btn-lg btn-block">Change Password</button>
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
