@extends('layouts.dashboard.app')
@section('title', 'dashboard')
@section('content')
    <div class="main-container">
        @include('layouts.shared.alert')
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('dashboard/vendors/images/banner-img.png') }}" alt="">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-7 welcome-note">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize mt-3 mt-md-0">
                            Welcome back <span class="weight-600 font-30 text-blue">{{ Auth::user()->username }}!</span>
                        </h4>
                        <p class="font-18 max-width-600">Please protect your login details and feel free to customise your dashboard to suit you.</p>
                        <p>Always remember to check your unit balance (available units) before sending a message. Insufficient balance? <a href="{{ route('buy-unit') }}"><strong>buy here</strong></a></p>
                    </div>
                </div>
            </div>
            <div class="row mb-3"> 
                <div class="col-xl-3 col-sm-6 col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-brand-2">
                                    <i class="fa fa-users"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 class="text-brand-2">{{ Auth::user()->contacts->count() }}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                
                                <h6 class="text-muted">Contact Groups</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-brand-2 w-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-brand-1 border-brand-1">
                                    <i class="fa fa-list"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 class="text-brand-1">{{ Auth::user()->units->sum('available_units') }}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Available Units</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-brand-1 w-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-brand-4 border-brand-4">
                                    <i class="fa fa-paper-plane"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 class="text-brand-4">{{ Auth::user()->messages()->where('status', '1')->count() }}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                
                                <h6 class="text-muted">Total Sent messages</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-brand-4 w-100   "></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-brand-3 border-brand-3">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 class="text-brand-3">0</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                
                                <h6 class="text-muted">Pending Schedules</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-brand-3 w-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xl-8 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h2 class="h4 mb-20">Activity</h2>
                        <div id="chart5"></div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h2 class="h4 mb-20">Lead Target</h2>
                        <div id="chart6"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                    <div class="card-box pd-30 pt-10 height-100-p">
                        <h2 class="mb-30 h4">Browser Visit</h2>
                        <div class="browser-visits">
                            <ul>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img src="{{ asset('dashboard/vendors/images/chrome.png')}}" alt=""></div>
                                    <div class="browser-name">Google Chrome</div>
                                    <div class="visit"><span class="badge badge-pill badge-primary">50%</span></div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img src="{{ asset('dashboard/vendors/images/firefox.png')}}" alt=""></div>
                                    <div class="browser-name">Mozilla Firefox</div>
                                    <div class="visit"><span class="badge badge-pill badge-secondary">40%</span></div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img src="{{ asset('dashboard/vendors/images/safari.png')}}" alt=""></div>
                                    <div class="browser-name">Safari</div>
                                    <div class="visit"><span class="badge badge-pill badge-success">40%</span></div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img src="{{ asset('dashboard/vendors/images/edge.png')}}" alt=""></div>
                                    <div class="browser-name">Microsoft Edge</div>
                                    <div class="visit"><span class="badge badge-pill badge-warning">20%</span></div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img src="{{ asset('dashboard/vendors/images/opera.png')}}" alt=""></div>
                                    <div class="browser-name">Opera Mini</div>
                                    <div class="visit"><span class="badge badge-pill badge-info">20%</span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 mb-30">
                    <div class="card-box pd-30 pt-10 height-100-p">
                        <h2 class="mb-30 h4">World Map</h2>
                        <div id="browservisit" style="width:100%!important; height:380px"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 mb-30">
                    <div class="card-box pd-30 height-100-p">
                        <h4 class="mb-30 h4">Compliance Trend</h4>
                        <div id="compliance-trend" class="compliance-trend"></div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 mb-30">
                    <div class="card-box pd-30 height-100-p">
                        <h4 class="mb-30 h4">Records</h4>
                        <div id="chart" class="chart"></div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <script>
        $(".dial1").knob();
            $({animatedVal: 0}).animate({animatedVal: 80}, {
                duration: 3000,
                easing: "swing",
                step: function() {
                    $(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
                }
            });

            $(".dial2").knob();
            $({animatedVal: 0}).animate({animatedVal: 70}, {
                duration: 3000,
                easing: "swing",
                step: function() {
                    $(".dial2").val(Math.ceil(this.animatedVal)).trigger("change");
                }
            });

            $(".dial3").knob();
            $({animatedVal: 0}).animate({animatedVal: 90}, {
                duration: 3000,
                easing: "swing",
                step: function() {
                    $(".dial3").val(Math.ceil(this.animatedVal)).trigger("change");
                }
            });

            $(".dial4").knob();
            $({animatedVal: 0}).animate({animatedVal: 65}, {
                duration: 3000,
                easing: "swing",
                step: function() {
                    $(".dial4").val(Math.ceil(this.animatedVal)).trigger("change");
                }
            });

    </script>

    <style>

        .bg-brand-1{
            background-color: #1d2840;
        }
        .text-brand-1{
            color: #1d2840;
        }
        .border-brand-1{
            border-color: #1d2840;
        }

        .bg-brand-2{
            background-color: #375c8c;
        }
        .text-brand-2{
            color: #375c8c;
        }
        .border-brand-2{
            border-color: #375c8c;
        }

        .bg-brand-3{
            background-color: #266f8c;
        }
        .text-brand-3{
            color: #266f8c;
        }
        
        .border-brand-3{
            border-color: #266f8c;
        }
        .border-brand-4{
            border-color: #628c23;
        } 
         .bg-brand-4{
            background-color: #628c23;
        }
        .text-brand-4{
            color: #628c23;
        }
       
        .dash-widget-icon {
            align-items: center;
            display: inline-flex;
            font-size: 1.875rem;
            height: 50px;
            justify-content: center;
            line-height: 48px;
            text-align: center;
            width: 50px;
            border: 3px solid;
            border-radius: 50px;
            padding: 28px;
        }
        .dash-count {
            font-size: 18px;
            margin-left: auto;
        }
        .dash-widget-info h3 {
            margin-bottom: 10px;
        }
        .dash-widget-header {
            align-items: center;
            display: flex;
            margin-bottom: 15px;
        }
        .card-chart .card-body {
            padding: 8px;
        }
        .progress{
            margin-top: 5px;
        }

        
    </style>
@endsection
