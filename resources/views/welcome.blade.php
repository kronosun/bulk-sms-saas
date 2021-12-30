@extends('layouts.front')
@section('title', env('APP_NAME'))
@section('content')
    
    <!-- Slider Area Start-->
        <div class="slider-area">
            <div class="slider-active">
                <div class="single-slider slider-height slider-padding sky-blue d-flex align-items-center slider-1">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-6 hero-row">
                                <div class="hero__caption">
                                   
                                    <h1 data-animation="fadeInUp" data-delay=".6s">Swift Bulk SMS Dispatch<br>With Skezzole</h1>
                                    <p data-animation="fadeInUp" data-delay=".8s">Solved! 99.9% SMS delivery rate</p>
                                    <!-- Slider btn -->
                                   <div class="slider-btns">
                                        <!-- Hero-btn -->
                                        <a data-animation="fadeInLeft" data-delay="1.0s" href="{{ route('login') }}" class="btn radius-btn">Get started</a>
                                        <!-- Video Btn -->
                                        {{-- <a data-animation="fadeInRight" data-delay="1.0s" class="popup-video video-btn ani-btn" href="https://www.youtube.com/watch?v=1aP-TXUpNoU"><i class="fas fa-play"></i></a> --}}
                                   </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pr-md-5">
                                <div class="hero__img d-none d-sm-block f-right pr-md-5" id="hero-right" data-animation="fadeInRight" data-delay="1s">
                                    <img src="assets/img/hero/hero_right.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                {{-- <div class="single-slider slider-height slider-padding sky-blue d-flex align-items-center">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-6 col-md-9 ">
                                <div class="hero__caption">
                                    <span data-animation="fadeInUp" data-delay=".4s">App Landing Page</span>
                                    <h1 data-animation="fadeInUp" data-delay=".6s">Get things done<br>with Appco</h1>
                                    <p data-animation="fadeInUp" data-delay=".8s">Dorem ipsum dolor sitamet, consectetur adipiscing elit, sed do eiusm tempor incididunt ulabore et dolore magna aliqua.</p>
                                    <!-- Slider btn -->
                                   <div class="slider-btns">
                                        <!-- Hero-btn -->
                                        <a data-animation="fadeInLeft" data-delay="1.0s" href="industries.html" class="btn radius-btn">Download</a>
                                        <!-- Video Btn -->
                                        <a data-animation="fadeInRight" data-delay="1.0s" class="popup-video video-btn ani-btn" href="https://www.youtube.com/watch?v=1aP-TXUpNoU"><i class="fas fa-play"></i></a>
                                   </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="hero__img d-none d-lg-block f-right" data-animation="fadeInRight" data-delay="1s">
                                    <img src="assets/img/hero/hero_right.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  --}}
            </div>
        </div>
        <!-- Slider Area End -->
        <!-- Best Features Start -->
        <section class="best-features-area section-padd4">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-8 col-lg-10">
                        <!-- Section Tittle -->
                        <div class="row">
                            <div class="col-lg-10 col-md-10">
                                <div class="section-tittle">
                                    <h2 class="text-center">What to find here!</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Section caption -->
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-paper-plane"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>High Delivery Rate</h3>
                                        <p>Our SMS is reliable and quick.</p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-thumbs-up"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>Affordable Cost</h3>
                                        <p>You can send SMS as low as 99.9Kobo/sms</p>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-headphones"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>Customer Support</h3>
                                        <p>We offer 24/7 customer support. Our livechat and email channels are always open.</p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-undo"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>Refund Policy</h3>
                                        <p>We have a customer friendly refund policy. See more <a href="#" class="text-primary">here</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shpe -->
            <div class="features-shpae d-none d-lg-block">
                <img src="assets/img/hero/slide_1.png" alt="" height="400" class="rounded-circle" style="object-fit: cover;">
            </div>
        </section>
        <!-- Best Features End -->
        <!-- Services Area Start -->
        <section class="service-area sky-blue">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-tittle text-center">
                            <h2>Upcoming Features!</h2>
                        </div>
                    </div>
                </div>
                <!-- Section caption -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption text-center mb-30">
                            <div class="service-icon">
                                <span><i class="fa fa-link"></i></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">SMS API</a></h4>
                                <p>Easily integrate our sms api to your application.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption active text-center mb-30">
                            <div class="service-icon">
                                <span> <i class="fa fa-user"></i></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">SMS personalization</a></h4>
                                <p>You can personalize your sms to specify names of recipients.</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption text-center mb-30">
                            <div class="service-icon">
                                 <span> <i class="fa fa-users"></i></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">Referral Programs</a></h4>
                                <p>You can earn as much as you can by referring friends.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Area End -->
        <!-- Applic App Start -->
       {{--  <div class="applic-apps section-padding2">
            <div class="container-fluid">
                <div class="row">
                    <!-- slider Heading -->
                    <div class="col-xl-4 col-lg-4 col-md-8">
                        <div class="single-cases-info mb-30">
                            <h3>Testimonials from <br>our beta users</h3>
                            <p>Just few moments of testing the waters, see what we ve got as reviews. </p>
                        </div>
                    </div>
                    <!-- OwL -->
                    <div class="col-xl-8 col-lg-8 col-md-col-md-7">
                        <div class="app-active owl-carousel"> 
                            <div class="single-cases-img">
                                <img src="assets/img/gallery/App1.png" alt="">
                            </div>
                            <div class="single-cases-img">
                                <img src="assets/img/gallery/App2.png" alt="">
                            </div>
                            <div class="single-cases-img">
                                <img src="assets/img/gallery/App3.png" alt="">
                            </div>
                            <div class="single-cases-img">
                                <img src="assets/img/gallery/App2.png" alt="">
                            </div>
                            <div class="single-cases-img">
                                <img src="assets/img/gallery/App1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Applic App End -->
        <!-- Best Pricing Start -->
        <section class="best-pricing pricing-padding" data-background="assets/img/gallery/best_pricingbg.jpg">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="section-tittle section-tittle2 text-center">
                            <h2>Choose Your Suitable Plan.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Best Pricing End -->
        <!-- Pricing Card Start -->
        <div class="pricing-card-area">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-card text-center mb-30">
                            <div class="card-top">
                                <span>Bronze</span>
                                <h4>&#8358;3 <span>/ unit</span></h4>
                            </div>
                            <div class="card-bottom">
                                <ul>
                                    <li>1,000 to 5,000 units</li>
                                    <li>E-mail support</li>
                                    <li>10 Free Optimization</li>
                                    <li>Work hours support  window</li>
                                </ul>
                                <a href="services.html" class="btn card-btn1">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-card  text-center mb-30">
                            <div class="card-top">
                                <span>Silver</span>
                                <h4>&#8358;2.5 <span>/ Unit</span></h4>
                            </div>
                            <div class="card-bottom">
                                <ul>
                                    <li>5,001 t0 10,000 units</li>
                                    <li>E-mail support</li>
                                    <li>10 Free Optimization</li>
                                    <li>24/7 support</li>
                                </ul>
                                <a href="services.html" class="btn card-btn1">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-card text-center mb-30">
                            <div class="card-top">
                                <span>Gold</span>
                                <h4>&#8358;2 <span>/ Unit</span></h4>
                            </div>
                            <div class="card-bottom">
                                <ul>
                                    <li>Above 10,000 units</li>
                                    <li>E-mail support</li>
                                    <li>10 Free Optimization</li>
                                    <li>24/7  support</li>
                                </ul>
                                <a href="services.html" class="btn card-btn1">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pricing Card End -->
        <!-- Our Customer Start -->
        <div class="our-customer section-padd-top30">
            <div class="container-fluid">
            <div class="our-customer-wrapper">
                    <!-- Section Tittle -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-8">
                            <div class="section-tittle text-center">
                                <h2>Testimonials from <br>our beta users</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="customar-active dot-style d-flex dot-style">
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="assets/img/shape/man1.png" alt="">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="#">Skezzole has been an awesome</a></h4>
                                        <p>Messaging my team has been so easy and efficient</p>
                                    </div>
                                </div>
                            
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="assets/img/shape/man2.png" alt="">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="#">Great user experience</a></h4>
                                        <p>The user experience is quite simple and easy. No complexity; just smooth.</p>
                                    </div>
                                </div>
                            
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="assets/img/shape/man3.png" alt="">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="#">Prompt customer support</a></h4>
                                        <p>The livechat and email outlet responds almost immediately.</p>
                                    </div>
                                </div>
                            
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="assets/img/shape/man2.png" alt="">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="#">Cheap and affordable</a></h4>
                                        <p>The pricing is quite good for small organisations.</p>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
            </div>
            </div>
        </div>           
        <!-- Our Customer End -->
        <!-- Available App  Start-->
        <div class="available-app-area">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-6">
                        <div class="app-caption">
                            <div class="section-tittle section-tittle3">
                                <h2>Skezzole Mobile <br>coming soon</h2>
                                {{-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore fug.</p> --}}
                                <div class="app-btn">
                                    <a href="#" class="app-btn1"><img src="assets/img/shape/app_btn1.png" alt=""></a>
                                    <a href="#" class="app-btn2"><img src="assets/img/shape/app_btn2.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="app-img">
                            <img src="assets/img/shape/available-app.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shape -->
            <div class="app-shape">
                <img src="assets/img/shape/app-shape-top.png" alt="" class="app-shape-top heartbeat d-none d-lg-block">
                <img src="assets/img/shape/app-shape-left.png" alt="" class="app-shape-left d-none d-xl-block">
                <!-- <img src="assets/img/shape/app-shape-right.png" alt="" class="app-shape-right bounce-animate "> -->
            </div>
        </div>
        <!-- Available App End-->
        <!-- Say Something Start -->
        <div class="say-something-aera pt-90 pb-90 fix">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="offset-xl-1 offset-lg-1 col-xl-5 col-lg-5">
                        <div class="say-something-cap">
                            <h2>We are  always reachable.</h2>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3">
                        <div class="say-btn">
                            <a href="#" class="btn radius-btn">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- shape -->
            <div class="say-shape">
                <img src="assets/img/shape/say-shape-left.png" alt="" class="say-shape1 rotateme d-none d-xl-block">
                {{-- <img src="assets/img/shape/say-shape-right.png" alt="" class="say-shape2 d-none d-lg-block"> --}}
            </div>
        </div>
        <!-- Say Something End -->

@endsection