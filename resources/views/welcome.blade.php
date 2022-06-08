@extends('layouts.front')
@section('title', env('APP_NAME'))
@section('content')
   
    <main>

        <style>
        

        .hero__caption h2{
            font-size: 25px;
            margin-top: -10px;
        }
        @media(max-width: 1000px) {
            .hero__caption h2{
           display: none;
        }

        }

        @media(min-width: 1200px){
            .what-to-find-title{
                margin-top: -100px!important
            }

        
        }

        /* @media(max-width: 768px){
            .hero-title{
                font-size:10px!important;
            }
        } */
    </style>
    <!-- Slider Area Start-->
        <div class="slider-area">
            <div class="slider-active">
                <div class="single-slider slider-height slider-padding sky-blue d-flex align-items-center slider-1">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-6 hero-row">
                                <div class="hero__caption">
                                   <h1 class="hero-title">Simple And <br> Affordable Bulk SMS  <br> For Marketing</h1>
                                    <h2 data-animation="fadeInUp" data-delay=".6s">Send Bulk SMS In 6 Simple Steps</h2>
                                    
                                    <!-- Slider btn -->
                                   <div class="slider-btns">
                                        <!-- Hero-btn -->
                                        <a data-animation="fadeInLeft" data-delay="1.0s" href="register.html" class="btn radius-btn">Get started</a>
                                        <!-- Video Btn -->
                                        
                                   </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pr-md-5">
                                <div class="hero__img d-none d-sm-block f-right pr-md-5" id="hero-right" data-animation="fadeInRight" data-delay="1s">
                                    <img src="{{ asset('assets/img/hero/hero_right.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
            </div>
        </div>
        <!-- Slider Area End -->
        <!-- Best Features Start -->
        <section class="best-features-area section-padd4" id="features">
            <div class="container">
                <div class="row justify-content-end" >
                    <div class="col-xl-8 col-lg-10">
                        <!-- Section Tittle -->
                        <div class="row" >
                            <div class="col-lg-10 col-md-10">
                                <div class="section-tittle">
                                    <h2 class="text-center what-to-find-title">What to find here!</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Section caption -->
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-calendar-plus"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>SMS scheduling</h3>
                                        <p>Skezzole offers you a stress-free feature that enables you to compose and send your bulk SMS automatically at your specified time. </p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-history"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>Detailed SMS History</h3>
                                        <p>As a part of our transparency policy, Skezzole provides you with a comprehensive archive of SMS sent and units purchased over a period of time.</p>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-user-plus"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>Flexible Contact Input</h3>
                                        <p>Skezzole has a built-in feature that enables you to either save or group a contact afore hand. Just click on them as existing contacts or alternatively, upload a CSV file containing your contacts.</p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="single-features mb-70">
                                    <div class="features-icon">
                                        <span><i class="fa fa-calculator"></i></span>
                                    </div>
                                    <div class="features-caption">
                                        <h3>Unit-Price Calculator</h3>
                                        <p>Our two-way unit-price calculator gives you the ease of computing a desirables number of units and having the corresponding cost in NGN automatically calculated and displayed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shpe -->
            <div class="features-shpae d-none d-lg-block" style="padding-top: 150px!important">
                
                <img src="{{ asset('assets/img/hero/slide_1.png')}}" alt="" height="400" class="rounded-circle" style="object-fit: cover;">
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
                                <p>Easily integrate our SMS API into your application.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption active text-center mb-30">
                            <div class="service-icon">
                                <span> <i class="fa fa-user"></i></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">SMS Personalization</a></h4>
                                <p>Uniquely address your recipients by their names.</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption text-center mb-30">
                            <div class="service-icon">
                                 <span> <i class="fa fa-file"></i></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">SMS Template</a></h4>
                                <p>Varieties of customisable sms templates for you.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- UNIT PRICE CALCULATOR-->
        <div class="row py-5" style="background-image: url({{ asset('assets/img/gallery/best_pricingbg.jpg')}}); min-height: 450px; position: relative;">
            <div class="pricing-overlay" style="position:absolute; height: 100%; top: 0; left: 0; right:0; bottom: 0; background-color: #375c8c; z-index: 2; opacity: 0.9;" id="pricing"></div>
            <div class="container" style="height: 100%; z-index:3;">
                <div id="unit_price_calc" class="wrapper">
                   <div class="one"><p>unit-price converter</p></div>
                   <div class="two">
                       <label><p><i class="fa fa-balance-scale"></i> unit</p></label>
                       <input type="text" placeholder="Number of unit">
                   </div>
                   <div class="three">
                       <div id="arrows">
                           <div class="arrow-right"><i class="fa fa-arrow-right" ></i> </div>
                            <div class="arrow-left"><i class="fa fa-arrow-left" ></i></div>
                       </div>
                   </div>
                   <div class="four">
                    <label><p><i>&#8358</i> Price</p></label>
                     <input type="text" placeholder="Price of unit">
                   </div>
                   <div class="five"> 
                       <p>units are availiable for your pocket size.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="our-customer section-padd-top30">
            <div class="container-fluid">
            <div class="our-customer-wrapper">
                    <!-- Section Tittle -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-8">
                            <div class="section-tittle text-center">
                                <h2>See what our customers <br> are saying about us </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="customar-active dot-style d-flex dot-style">
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="{{ asset('assets/img/shape/man1.png')}}" alt="">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="#">Skezzole has been an awesome</a></h4>
                                        <p>Messaging my team has been so easy and efficient</p>
                                    </div>
                                </div>
                            
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="{{ asset('assets/img/shape/man2.png')}}" alt="">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="#">Great user experience</a></h4>
                                        <p>The user experience is quite simple and easy. No complexity; just smooth.</p>
                                    </div>
                                </div>
                            
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="{{ asset('assets/img/shape/man3.png')}}" alt="">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="#">Prompt customer support</a></h4>
                                        <p>The livechat and email outlet responds almost immediately.</p>
                                    </div>
                                </div>
                            
                                <div class="single-customer mb-100">
                                    <div class="what-img">
                                        <img src="{{ asset('assets/img/shape/man2.png')}}" alt="">
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


        <!-- contact us start-->
        <div class="available-app-area" id="contact-us" >
            <div class="container">
                <h1 class="text-center">Talk to us here</h1>
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        
                        <!-- contact us form  -->
                        <div class="contact-us" >
                            <div class="section-title" >
                                
                                <form>
                                    <label for="email" class="form-label">Email address:</label>
                                        <div class="mb-4 input-group">
                                            <span class="input-group-text">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control " id="email" placeholder="eg.mario@example.com">
                                            <!-- tooltip -->
                                            <span class="input-group-text">
                                                <span class="tt" data-bs-placement="bottom" title="enter an email adress we can reply to.">
                                                    <i class="fa fa-info-circle "></i>
                                                </span>
                                                
                                            </span>
            
                                        </div>
                                    <label for="name" class="form-label">Name:</label>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control " id="name" placeholder="eg.Mario"s>
                                        <!-- tooltip -->
                                        <span class="input-group-text">
                                            <span class="tt" data-bs-placement="bottom" title="we prefer you username">
                                                <i class="fa fa-info-circle "></i>
                                            </span>
                                            
                                        </span>
                                    </div>
                                    
            
                                    <label for="query"> what do you want to tell us....</label>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="query" rows="5" placeholder="share your thoughts with us here..."></textarea>
                                       
                                    </div>
            
                                    <!-- <div class="mb-4 text-center">
                                        <button type="submit" class=" btn btn-secondary">submit</button>
                                    </div> -->
                                    <span class="contact-btn">
                                    <a href="#" class="btn " style="border-radius: 50px; padding: 15px; width: 100%; font-size: 25px"><i class="fa fa-paper-plane pr-2"></i>Send</a>
                                </span>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 col-xs-12">
                        <div class="app-img">
                            <img src="{{ asset('assets/img/shape/available-app.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slets ta -->
            <div class="app-shape">
                <img src="{{ asset('assets/img/shape/app-shape-top.png')}}" alt="" class="app-shape-top heartbeat d-none d-lg-block">
                <img src="{{ asset('assets/img/shape/app-shape-left.png')}}" alt="" class="app-shape-left d-none d-xl-block">
                <!-- <img src="{{ asset('assets/img/shape/app-shape-right.png')}}" alt="" class="app-shape-right bounce-animate "> -->
            </div>
        </div>



        <!-- Available App End-->
        <!-- Say Something Start -->
        <div class="say-something-aera pt-90 pb-90 fix" id="user-guide">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="offset-xl-1 offset-lg-1 col-xl-9 col-lg-9 col-md-12 col-sm-12">
                        <div class="say-something-cap text-left ml-100" >
                            <p spellcheck="true">Skezzole is simple to use</p>
                             <p>But we have provided a detailed and simplified user guide for you.</p>
                             <p></p>

                              <div class="say-btn">
                                <a href="{{ url('user-guide.pdf') }}" class="btn radius-btn mb-3" download>Download User Guide</a>
                            
                        </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- shape -->
            <div class="say-shape">
                <img src="{{ asset('assets/img/shape/say-shape-left.png')}}" alt="" class="say-shape1 rotateme d-none d-xl-block">
                
            </div>
        </div>
        <!-- Say Something End -->




    </main>
@endsection