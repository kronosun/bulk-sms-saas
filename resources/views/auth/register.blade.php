@extends('layouts.auth.app')

@section('content')
<div class="login-menu">
                <ul>
                    <li><a href="javascript::void(0)">Sign up</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 d-none d-lg-block">
                    <img src="{{ asset('dashboard/vendors/images/register-page-img.png')}}" alt="">
                </div>
                <div class="col-lg-5">
                    <div class="register-box bg-white box-shadow border-radius-10">
                        <div class="wizard-content">
                            <form class="tab-wizard2 wizard-circle wizard px-5 py-5" action="{{ route('register') }}" method="post">
                                @csrf
                                <h4 class="text-center mb-3">Sign up </h4><hr>
                                <section>
                                    <div class="">
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Email Address*</label>
                                            <div class="col-lg-12">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                            </div>
                                            <div>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Username*</label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                            </div>
                                            <div>
                                                @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Password*</label>
                                            <div class="col-lg-12">
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            <div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Confirm Password*</label>
                                            <div class="col-lg-12">
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                            <div>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            Already have an account? <a href="{{ route('login') }}" class="text-skezzole">Login</a><br><br>
                                            <button class="auth-btn">Submit</button>
                                            
                                        </div>
                                        
                                    </div>
                                </section>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html Start -->
    <button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">Launch modal</button>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-width-400" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center"><img {{ asset('dashboard/src="vendors/images/success.png')}}"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="login.html" class="btn btn-primary">Done</a>
                </div>
            </div>
        </div>
    </div>
@endsection
