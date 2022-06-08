<!doctype html>
<html class="no-js" lang="zxx" style="scroll-behavior: smooth;">
    

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Skezzole</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="manifest" href="site.html"> --}}
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo/fav-icon.png') }}">

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <style>
            .logo img{
                height: 30px;
            }
            #hero-right img{
                width: 500px;
                border-radius: 10px;
            }
            .single-slider{
                margin-top: -150px!important;
            }
            .slider-1{
                background-image: -moz-linear-gradient(0deg, white 0%, #628C23 100%)!important;
                background-image: -webkit-linear-gradient(0deg, white 0%, #628C23 100%)!important;
                background-image: -ms-linear-gradient(0deg, white 0%, #628C23 100%)!important;
                
            }

            .my-btn{
                background-color: #375c8c;
                color: white!important;
                border-radius: 25px;
                padding: 15px 35px!important;
                border: 2px solid #375c8c;
            }

            .my-btn:hover{
                background-color: white;
                color: #375c8c!important;
                /*border-radius: 25px;*/
                /*padding: 15px 35px!important;*/
                border: 2px solid #375c8c;
            }

            #unit_price_calc {
                width: 100%;
                display: grid;
                grid-template-columns: 2fr 1fr 2fr;
                grid-template-rows: repeat(3, minmax(100px,auto));
                grid-gap:5px;
                margin:80px auto;
                text-align: center;
                
            }

            #unit_price_calc div {
                background: #283349;
                padding: 10px;
                
                
            }
            #unit_price_calc div:nth-child(even) {
                background: #1a200b3b;
               
                
                
            }
            .one {
                grid-column:1/4;
                border-radius: 10px 10px 0 0;

            }
            .one p{
                text-transform: capitalize;
                font-size: 40px;
                font-family: 'Courier New', Courier, monospace;
                font-weight: bolder;
                color: white;
                margin-top: 20px;
               
            }
            .two {
                margin-left: 20px;
                border-radius: 10px 0 0 10px;
            }
            .two input{
                font-size: 25px;
                color: #fff;
                width: 100%;
                height: 80px;
                text-align: center;
                margin-top: -10px;
                background-color: transparent;
                border:2px solid #fff;
                border-radius: 10px 0 0 10px;
                
            }
            
            .two label p{
               font-size: 30px;
               font-family: 'Courier New', Courier, monospace;
               font-weight: 600;
               color: #fff;
               text-transform: capitalize;
            }

            .three #arrows {
                margin-top: 15px;
                width: 100%;
            }

            .three #arrows .arrow-right{
                background-color: transparent;
                margin: 0 auto;
                width: 100%;
                
                
            }
            .three #arrows .arrow-right i{
                font-size: 45px;
                color: #A8B6BF;
                
                
            }
            .three #arrows .arrow-left{
                background-color: transparent;
                margin: 0 auto;
                width: 100%;
                
            }
            .three #arrows .arrow-left i{
               font-size: 45px;
               color: #A8B6BF;
                
            }

            .four {
                margin-right: 20px;
                border-radius: 0 10px 10px 0;
            }
            .four input{
                font-size: 25px;
                color: #fff;
                width: 100%;
                height: 80px;
                text-align: center;
                margin-top: -10px;
                background-color: transparent;
                border: 2px solid #fff;
                border-radius: 0 10px 10px 0;

            }

            .four label p{
                font-family: 'Courier New', Courier, monospace;
                font-weight: 600;
                font-size: 30px;
                color: #fff;
                text-transform: capitalize;

            }
            
            .five {
                grid-column: 1/4;
                border-radius: 0 0 10px 10px;
            }
            .five p {
                text-align: center;
                font-family: 'Courier New', Courier, monospace;
                font-size: 20px;
                margin-top: 20px;
                color: white;
            }

            .available-app-area h1 {
                margin-top: -100px !important;
                text-transform: capitalize;
                font-size: 50px;
                font-weight: 600;
                color: #fff;
            }
           .contact-us form .input-group-text {
                border: 2px solid #628C23;
            }
            .contact-us form input {
                height: 60px;
                border: 2px solid #628C238c;
            }
            .contact-us form textarea {
                border: 2px solid #628C238c;
            }
            .contact-us form input:focus {
               border-color: #628C23 !important;
               
            }
            .contact-us form label {
                color: #fff;
                font-size: 20px;
                text-transform: capitalize;
            }
            .contact-us form i {
                color: #628C23;
                
            }

            .footer-tittle span i {
                font-size: 30px;
                padding-left: 15px;
                color: #628C23;
                margin-left: -6px;
                transition: all 0.7s ease-in-out;
                -webkit-transition: all 0.7s ease-in-out;
                -moz-transition: all 0.7s ease-in-out;
                -o-transition: all 0.7s ease-in-out;


            }
            .footer-tittle span i:hover {
                font-size: 45px;

                transform: rotate(45deg);


            }
            .footer-logo a img {

                transition: all  0.5s ease;
                -webkit-transition: all  0.5s ease;
                -moz-transition: all  0.5s ease;
                -o-transition: all  0.5s ease;

            }
            .footer-logo a img:hover {
                transform: rotate3d(10, -10, 1, 45deg);
                width: 50%;
            }

            
          

            @media(max-width: 991px){
                /*.mobile-auth{
                    margin-left: 30px;
                }*/
                .header-area .slicknav_btn {
                    top: -30px;
                }
                
                .header-area{
                    background-color: #fff!important;
                }

                .slider-area{
                    margin-top: 50px;
                     
                }

                .hero-row{
                    margin-top: 100px!important;
                }

                /* .hero__caption h1{
                    font-size: 35px!important;
                } */

                .hero__img img{
                    width: 400px!important;
                    margin-right: 20px;
                }
                .section-tittle h2{
                    font-size: 45px;
                    margin-bottom: 45px!important;
                }

                .mb-70{
                    margin-bottom: 40px!important;
                }
            }

             @media(max-width: 768px){
                .logo img{
                    height: 25px;
                }
                .hero__img img{
                    width: 300px!important;
                    margin-right: 20px;
                }

                .section-tittle h2{
                    font-size: 30px;
                    margin-bottom: 45px!important;
                }
                .available-app-area h1 {
                margin-top: -80px !important;
                text-transform: capitalize;
                font-size: 30px;
                font-weight: 600;
                color: #fff;
            }
            .two input{
                height: 60px;

            }
            .four input{
                height: 60px;
            }

            .two input::placeholder{
                font-size: 20px;
            }
            .four input::placeholder{
                font-size: 20px;
            }
            .one p{
               font-size: 30px;
               
            }




                /* .hero__caption h1{
                    font-size: 25px!important;
                    font-weight: 600!important;
                } */
             }

             @media (min-width: 768px )  and (max-width: 991px) {
                #contact-us .contact-us form {
                    margin-left: 30% !important;
                    width: 150%;
                }
             }

        </style>
   </head>

   <body>
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('assets/img/logo/logo.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
       <div class="header-area header-transparrent">
            <div class="main-header header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-10 form-inline">
                            <div class="logo">
                                <a href="index.html"><img src="{{ asset('assets/img/logo/logo.png')}}" alt=""></a>
                            </div>
                            <div class="d-block d-lg-none mobile-auth ml-auto">
                                
                                <!-- <a href="#" class="mr-2"  >Login</a> -->
                                <a href="#" class="text-dark" style="padding: 8px 13px; background-color: #375c8c; color: white !important; border-radius: 5px; ">Register</a>
                            </div>
                            
                        </div>
                        <div class="col-xl-10 col-lg-10 col-2">

                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">    
                                        <li class="active"><a href="{{ url('/') }}"> Home</a></li>
                                        <li><a href="#features">Features</a></li>
                                        <li><a href="#pricing">Pricing</a></li>
                                        <li><a href="#contact-us" >Contact Us</a></li>
                                        
                                        <li><a href="{{ route('login') }}" class="my-btn" id="nav-btn">Login</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <!-- Header End -->
    </header>

	@yield('content')



	</main>
   <footer>

       <!-- Footer Start-->
      <div class="footer-main">
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row  justify-content-between">
                    <div class="col-lg-3 col-md-4 col-sm-8">
                         <div class="single-footer-caption mb-30">
                              <!-- logo -->
                             <div class="footer-logo">
                                 <a href="index.html"><img src="assets/img/logo/logo.png" alt="" width="100"></a>
                             </div>
                             <div class="footer-tittle">
                                 <div class="footer-pera">
                                     <p class="info1">Send bulk SMS to your wide range of Contacts, no cutting just speedy delivery. </p>
                                </div>
                             </div>
                         </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="#contact-us">Contact us</a></li>
                                    <li><a href="#features">Features</a></li>
                                    <li><a href="#pricing">Pricing</a></li>
                                    <li><a href="#user-guide">User Guide</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Support</h4>
                                <ul>
                                    <!-- <li><a href="#">Report a bug</a></li> -->
                                    <li><a href="Legal-page.html">Privacy Policy</a></li>
                                    <li><a href="Legal-page.html">Terms & Conditions</a></li>
                                    <li><a href="#">Sitemap</a></li>
                                    <li><a href="#">FAQs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Social Media</h4>
                                <div class="footer-pera footer-pera2">
                                     <span><a href="#"><i class="fab fa-facebook "></i></a><span><br><br>
                                     <span><a href="#"><i class="fab fa-whatsapp"></i></a><span><br><br>
                                     <span><a href="#"><i class="fab fa-linkedin"></i></a><span>
                                </div>
                             <!-- Form -->
                             <!-- <div class="footer-form">
                                 <div id="mc_embed_signup">
                                     <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part" novalidate="true">
                                         <input type="email" name="EMAIL" id="newsletter-form-email" placeholder=" Email Address " class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                                         <div class="form-icon">
                                             <button type="submit" name="submit" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm"><img src="assets/img/shape/form_icon.png" alt=""></button>
                                         </div>
                                         <div class="mt-10 info"></div>
                                     </form>
                                 </div>
                             </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Copy-Right -->
                <div class="row align-items-center">
                    <div class="col-xl-12 ">
                        <div class="footer-copy-right">
                           <p>
                               <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | powered by <a href="#" target="_blank"><img src="assets/img/logo/logo.png" alt="" width="80"></a>  template by <a href="https://colorlib.com/" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
       <!-- Footer End-->

   </footer>
   
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
		
		<!-- Jquery, Popper, Bootstrap -->
		<script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <!-- Date Picker -->
        <script src="{{ asset('assets/js/gijgo.min.js') }}"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
		<script src="{{ asset('assets/js/animated.headline.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
        
        <!-- contact js -->
        <script src="{{ asset('assets/js/contact.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/js/mail-script.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        
    </body>
</html>