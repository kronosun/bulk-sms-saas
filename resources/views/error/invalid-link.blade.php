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
                                <div class="card-header text-center" style="background-color: rgba(0,0,0,.03);">Invalid Resource</span></div>

                                <div class="card-body">
                                    {{-- @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif --}}
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/logo/logo.png') }}"  width="100" alt="logo">
                                    </div>
                                    
                                    <div class="text-center">
                                        <p>Looks like the link you clicked is invalid or expired </p>
                                        <p>return <a href="{{ url('/') }}">Home</a></p>
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
