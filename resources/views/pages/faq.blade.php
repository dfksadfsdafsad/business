<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ __('messages.page_titles.faq') }} | {{ config('business.name') }}</title>
    <meta content="Inotek - IT Solutions HTML5 Template" name="description">
    <meta content="Inotek - IT Solutions HTML5 Template" name="keywords">
    <meta content="INDEX,FOLLOW" name="robots">

    <!-- Mobile Specific Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link href="/assets/images/favicons/favicon.png" rel="icon" sizes="32x32" type="image/png">
    <meta content="#ffffff" name="msapplication-TileColor">
    <meta content="#ffffff" name="theme-color">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="/assets/css/flaticon.min.css" rel="stylesheet">
    <link href="/assets/css/fancybox.min.css" rel="stylesheet">
    <link href="/assets/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/css/animate.min.css" rel="stylesheet">
    <link href="/assets/css/select2.min.css" rel="stylesheet">
    <link href="/assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="/assets/css/odometer.css" rel="stylesheet">
    <!-- Theme Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">

</head>

<body id="body">

    <div class="page-wrapper bg-light">

        <!--=============================
        Preloader
        ==============================-->
        <div class="loading-screen" id="loading-screen">
            <span class="loader"></span>
        </div>


        <!--=============================
        Header Area
        ==============================-->
        @include('partials.header')

        <!--==============================
        Mobile Menu
        ============================== -->
        <div class="mobile-menu-wrapper">
            <div class="mobile-menu-area">
                <button class="menu-toggle"><i class="fas fa-times"></i></button>
                <div class="mobile-logo">
                    <a href="{{ url(app()->getLocale()) }}"><img loading="lazy" decoding="async" alt="Pureflow" src="/assets/images/logo/logo-2.png"></a>
                </div>
                <div class="mobile-menu">
                    <ul class="navigation clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </ul>
                </div>
                <ul class="contact-list-one">
                    <li>

                        <div class="contact-info-box">
                            <span class="icon fa-solid fa-phone"></span>
                            <span class="title">Call Us Anytime</span>
                            <a href="tel:{{ config('business.phone.raw') }}">{{ config('business.phone.display') }}</a>
                        </div>
                    </li>
                    <li>

                        <div class="contact-info-box">
                            <span class="icon fa-light fa-envelope"></span>
                            <span class="title">Email Us</span>
                            <a href="mailto:{{ config('business.email.primary') }}">{{ config('business.email.primary') }}</a>
                        </div>
                    </li>
                    <li>

                        <div class="contact-info-box">
                            <span class="icon fa-light fa-alarm-clock"></span>
                            <span class="title">Opening Hour</span>
                            {{ config('business.hours') }}
                        </div>
                    </li>
                </ul>
                <ul class="social-links">
                    <li><a href="{{ config('business.social.x_twitter', '#') }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{ config('business.social.facebook', '#') }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ config('business.social.pinterest', '#') }}"><i class="fab fa-pinterest"></i></a></li>
                    <li><a href="{{ config('business.social.instagram', '#') }}"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>

        <!--==============================
        Sticky Header
        ============================== -->
        <div class="sticky-header">
            <div class="container">
                <!-- Main Menu Area -->
                <div class="menu-area">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto logo">
                            <div class="header-logo">
                                <a href="{{ url(app()->getLocale()) }}">
                                    <img loading="lazy" decoding="async" alt="logo" src="/assets/images/logo/logo.png">
                                    <img loading="lazy" decoding="async" alt="logo" src="/assets/images/logo/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-auto nav-menu">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul class="navigation clearfix">
                                    <!--Keep This Empty / Menu will come through Javascript-->
                                </ul>
                            </nav>
                            <div class="navbar-right d-inline-flex d-lg-none">
                                <button class="menu-toggle sidebar-btn" type="button">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Area -->

        <!-- Header Search -->
        <div class="search-popup">
            <button class="close-search style-1"><i class="fa fa-times"></i></button>
            <button class="close-search"><i class="fas fa-arrow-up"></i></button>
            <form method="post" action="#">
                <div class="form-group">
                    <input id="search1" type="search" name="search-field" value="" placeholder="Search..." required="">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <!-- End Header Search -->

        <!--========  Start Sidebar Area ========-->
        <div id="sidebar-area" class="sidebar">
            <div class="sidebar-overlay"></div>
            <div class="sidebar-wrapper">
                <button class="sidebar-close-btn">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="12.7px" viewBox="0 0 16 12.7" style="enable-background:new 0 0 16 12.7" xml:space="preserve">
                        <g>
                            <rect x="0" y="5.4" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.1569 7.5208)" width="16" height="2"></rect>
                            <rect x="0" y="5.4" transform="matrix(0.7071 0.7071 -0.7071 0.7071 6.8431 -3.7929)" width="16" height="2"></rect>
                        </g>
                    </svg>
                </button>
                <div class="sidebar-content">
                    <div class="sidebar-logo">
                        <a class="dark-logo" href="{{ url(app()->getLocale()) }}"><img loading="lazy" decoding="async" src="/assets/images/logo/logo.png" alt="logo"></a>
                    </div>
                    <div class="sidebar-menu-wrap"></div>
                    <div class="sidebar-about">
                        <h6>Explore the world</h6>
                        <div class="sidebar-header">
                            <h3>World's leading Business agency</h3>
                        </div>
                    </div>
                    <!-- Instagram Feed Section -->
                    <div class="instafeed-wrapper">
                    <div class="insta-item">
                        <a href="https://www.instagram.com" target="_blank">
                        <img loading="lazy" decoding="async" src="/assets/images/sidebar/sidebar1.jpeg" alt="">
                        <span class="overlay"><i class="fa-brands fa-instagram"></i></span>
                        </a>
                    </div>
                    <div class="insta-item">
                        <a href="https://www.instagram.com" target="_blank">
                        <img loading="lazy" decoding="async" src="/assets/images/sidebar/sidebar-2.jpg" alt="">
                        <span class="overlay"><i class="fa-brands fa-instagram"></i></span>
                        </a>
                    </div>
                    <div class="insta-item">
                        <a href="https://www.instagram.com" target="_blank">
                        <img loading="lazy" decoding="async" src="/assets/images/sidebar/sidebar-3.jpg" alt="">
                        <span class="overlay"><i class="fa-brands fa-instagram"></i></span>
                        </a>
                    </div>
                    <div class="insta-item">
                        <a href="https://www.instagram.com" target="_blank">
                        <img loading="lazy" decoding="async" src="/assets/images/sidebar/sidebar-4.jpg" alt="">
                        <span class="overlay"><i class="fa-brands fa-instagram"></i></span>
                        </a>
                    </div>
                    <div class="insta-item">
                        <a href="https://www.instagram.com" target="_blank">
                        <img loading="lazy" decoding="async" src="/assets/images/sidebar/sidebar-5.jpg" alt="">
                        <span class="overlay"><i class="fa-brands fa-instagram"></i></span>
                        </a>
                    </div>
                    <div class="insta-item">
                        <a href="https://www.instagram.com" target="_blank">
                        <img loading="lazy" decoding="async" src="/assets/images/sidebar/sidebar-6.jpg" alt="">
                        <span class="overlay"><i class="fa-brands fa-instagram"></i></span>
                        </a>
                    </div>
                    </div>
                    <!-- mail submit -->
                    <p class="text-center mt-40">Get latest update for our trusted applications</p>
                    <form class="newsletter-form" action="https://formspree.io/f/mzbnjrnb" method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="email" value="" placeholder="Enter Your Email" autocomplete="on" required="">
                            <button type="submit">
                                <i class="far fa-paper-plane"></i>
                                <span class="btn-title"></span>
                            </button>
                        </div>
                    </form>

                    <ul class="sidebar-social">
                        <li class="facebook"><a href="{{ config('business.social.facebook', '#') }}"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="instagram"><a href="{{ config('business.social.instagram', '#') }}"><i class="fab fa-instagram"></i></a></li>
                        <li class="twitter"><a href="{{ config('business.social.x_twitter', '#') }}"><i class="fab fa-twitter"></i></a></li>
                        <li class="g-plus"><a href="{{ config('business.social.google_plus', '#') }}"><i class="fab fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--======== / Sidebar Area ========-->


        <!-- Start Breadcrumb Section -->
        <!-- ========================================== -->
        <section class="tv-breadcrumb-section">
            <div class="tv-breadcrumb-inner mx-30 ml-mx-0 position-relative overflow-hidden br-30 ml-br-0">
                <div class="bg image"><img loading="lazy" decoding="async" src="/assets/images/bg-img/breadcrumb.webp" alt=""></div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="title-outer">
                                <div class="page-title">
                                    <h2 class="title">Faq</h2>
                                    <ul class="page-breadcrumb">
                                        <li><a href="{{ url(app()->getLocale()) }}"><i class="fa-solid fa-house-chimney"></i>Home</a></li>
                                        <li><span>/</span> Faq</li>
                                    </ul>
                                </div>
                                <div class="image-box md-d-none">
                                    <div class="shapes">
                                        <div class="shape shape-1"><img loading="lazy" decoding="async" src="/assets/images/shapes/circle.webp" alt=""></div>
                                        <div class="shape shape-2 spin2"><img loading="lazy" decoding="async" src="/assets/images/shapes/star.webp" alt=""></div>
                                        <div class="shape shape-3 "><img loading="lazy" decoding="async" src="/assets/images/shapes/snake.webp" alt=""></div>
                                        <div class="shape shape-4 jump3"><img loading="lazy" decoding="async" src="/assets/images/shapes/doot.webp" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <!--==============================
        Faq Section Two
        ==============================-->
        <section class="tv-faq-section style-2 space bg-light">
            <div class="shape-mockup sm-d-none" data-top="12%" data-left="13%"><img loading="lazy" decoding="async" src="/assets/images/faq/circle-shape.webp" alt="shape"></div>
            <div class="shape-mockup sm-d-none" data-top="12%" data-right="15%"><img loading="lazy" decoding="async" src="/assets/images/faq/question-shape.webp" alt="shape"></div>
            <div class="container">
                    <div class="title-wrap text-center three">
                        <div class="sub-title-2  text-theme"><i class="fa-solid fa-circle-check"></i>FAQ</div>
                        <h2 class="sec-title">Freequently Asked Question</h2>
                        <p>Collaboratively supply bricks-and-clicks metrics for maintainable users <br> reinvent unique value for just in time consult.</p>
                    </div>
                <div class="row justify-content-center">
                    <div class="faq-column col-lg-8">
                        <div class="inner-column mt-15 md-mt-0">
                            <ul class="accordion-box">
                                    <li class="accordion active-block">
                                        <div class="acc-btn bg-white active">01. How to install marketing extension?
                                            <div class="icon"></div>
                                        </div>
                                        <div class="acc-content active">
                                            <div class="content bg-white">
                                                <div class="text">Professionally reintermediate technically sound supply chains it extensive
                                                Credibly pontificate turnkey inprocesses whereas marketplace compelling
                                                relationships rather parallel communities</div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="accordion">
                                        <div class="acc-btn bg-white">02. Do you support any online payments?
                                            <div class="icon fa fa-angle-right"></div>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content bg-white">
                                                <div class="text">Collaboratively disintermediate one to one main functionalities and long term best
                                                    term impact niche compellingly granular consultation commerce and client-centered
                                                    impact goal oriented partnerships and relationship</div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="accordion">
                                        <div class="acc-btn bg-white">03. What kinds of payment method do you support?
                                            <div class="icon fa fa-angle-right"></div>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content bg-white">
                                                <div class="text">Collaboratively disintermediate one to one main functionalities and long term best
                                                    term impact niche compellingly granular consultation commerce and client-centered
                                                    impact goal oriented partnerships and relationship</div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="accordion">
                                        <div class="acc-btn bg-white">03. What kinds of payment method do you support?
                                            <div class="icon fa fa-angle-right"></div>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content bg-white">
                                                <div class="text">Collaboratively disintermediate one to one main functionalities and long term best
                                                    term impact niche compellingly granular consultation commerce and client-centered
                                                    impact goal oriented partnerships and relationship</div>
                                            </div>
                                        </div>
                                    </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <!--==============================
        Faq Section One
        ==============================-->
        <section class="tv-faq-section overflow-hidden mb--75  bg-light">
            <div class="tv-faq-inner space position-relative overflow-hidden br-30 ml-br-0 bg-light2 mx-30 ml-mx-0">
                <div class="container pb-80">
                    <div class="row gy-30  align-items-center">
                        <div class="col-lg-6">
                            <div class="faq-image-wrapper faq-inner mr-60 lg-mr-30 md-mr-0">
                                <div class="faq-image overlay-anim4 img-anim-left wow fadeInLeft">
                                    <img loading="lazy" decoding="async" src="/assets/images/cta/cta2-img.webp" alt="People discussing IT solutions">
                                </div>
                                <div class="faq-single-card">
                                    <div class="faq-car-inner">
                                        <div class="bg image"><img loading="lazy" decoding="async" src="/assets/images/testimonial/hm2-bg02.webp" alt=""></div>
                                        <div class="p-top-right wow slideInRight" style="visibility: visible; animation-name: slideInRight;"><img loading="lazy" decoding="async" src="/assets/images/faq/hm3-shape.webp" alt="Shape"></div>
                                        <div class="count"><span class="count-number odometer" data-count="10">0</span>K<span class="plus">+</span></div>
                                        <h4 class="title">Trusted Happy Customers</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                             <!-- Section Title -->
                            <div class="title-wrap" data-wow-duration="1.5s" data-wow-delay=".4s">
                                <div class="sub-title-2 text-theme"><i class="fa-solid fa-circle-check"></i>Get In Touch</div>
                                <h2 class="sec-title">Transform Your Business <br> Smart IT Solutions—Get in <br> Touch Today</h2>
                                <p>Professionally embrace tactical catalysts for change and revolutionary <br>create cutting-edge networks with leveraged functionalities mostly <br> visualize revolutionary bandwidth and</p>
                            </div>
                            <a href="blog.html" class="theme-btn br-30">
                                <span class="link-effect">
                                    <span class="effect-1">Contact with Us</span>
                                    <span class="effect-1">Contact with Us</span>
                                </span>
                                <span class="arrow-all">
                                    <i>
                                        <svg width="16" height="19" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 6H10M10 6L6 2M10 6L6 10" stroke="#1053f3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg width="16" height="19" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 6H10M10 6L6 2M10 6L6 10" stroke="#1053f3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        








        <!--==============================
        Newsletter Section
        ==============================-->
        <section class="newsletter-section mb--75">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="newsletter">
                            <div class="arrow-shape md-d-none"><img loading="lazy" decoding="async" src="/assets/images/newsletter/arrow-shape.webp" alt=""></div>
                            <div class="bg image"><img loading="lazy" decoding="async" class="br-30" src="/assets/images/newsletter/hm1-bg01.webp" alt=""></div>
                            <div class="thumb d-none d-xl-block">
                                <img loading="lazy" decoding="async" src="/assets/images/newsletter/img01.webp" alt="thumb">
                             </div>
                             <div class="image-text">
                                <img loading="lazy" decoding="async" src="/assets/images/icons/check-circle2.png" alt="">
                                <h3 class="title title-anim" data-animation="bounce-in">Subscribe Our Newsletter <br> For Latest Updates</h3>
                             </div>
                                <form class="newsletter-form" action="https://formspree.io/f/mzbnjrnb" method="post">
                                    <div class="form-group">
                                        <input type="email" name="email" class="email" value="" placeholder="Email Address" autocomplete="on" required="">
                                        <button type="submit">
                                            <i class="far fa-paper-plane"></i>
                                            <span class="btn-title"></span>
                                        </button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--==============================
        Footer Section
        ==============================-->
        @include('partials.footer')
    </div>
    <!-- End Page Wrapper -->


    <!-- Scroll To Top -->
	<div class="scrollToTop">
        <div class="arrowUp">
            <i class="fa-light fa-arrow-up"></i>
        </div>
        <div class="water" style="transform: translate(0px, 40%);">
            <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                <use xlink:href="#wave"></use>
            </svg>
            <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                <use xlink:href="#wave"></use>
            </svg>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 560 20" style="display: none;">
                <symbol id="wave">
                    <path d="M420,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C514,6.5,518,4.7,528.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H420z" fill="#" style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 301.839, 301.839; stroke-dashoffset: 119.488px;"></path>
                    <path d="M420,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C326,6.5,322,4.7,311.5,2.7C304.3,1.4,293.6-0.1,280,0c0,0,0,0,0,0v20H420z" fill="#"></path>
                    <path d="M140,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C234,6.5,238,4.7,248.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H140z" fill="#"></path>
                    <path d="M140,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C46,6.5,42,4.7,31.5,2.7C24.3,1.4,13.6-0.1,0,0c0,0,0,0,0,0l0,20H140z" fill="#"></path>
                </symbol>
            </svg>

        </div>
    </div>


    <!-- Jquery -->
    <script defer src="/assets/js/vendor/jquery-3.7.1.min.js"></script>
    <script defer src="/assets/js/bootstrap.min.js"></script>

    <!-- gsap js  -->
    <script defer src="/assets/js/gsap.min.js"></script>
    <script defer src="/assets/js/ScrollSmoother.js"></script>
    <script defer src="/assets/js/gsap-scroll-to-plugin.min.js"></script>
    <script defer src="/assets/js/ScrollTrigger.min.js"></script>
    

    <script defer src="/assets/js/hover-effect.umd.js"></script>
    <script defer src="/assets/js/swiper-bundle.min.js"></script>
    <script defer src="/assets/js/marquee.min.js"></script>
    <script defer src="/assets/js/jquery.fancybox.js"></script>
    <script defer src="/assets/js/select2.min.js"></script>
    <script defer src="/assets/js/jquery-ui.min.js"></script>
    <script defer src="/assets/js/jquery.validate.min.js"></script>
    <script defer src="/assets/js/jquery.appear.js"></script>
    <script defer src="/assets/js//jquery.odometer.min.js"></script>
    <script defer src="/assets/js/wow.min.js"></script>
    <script defer src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <script defer src="/assets/js/isotope.pkgd.min.js"></script>
     <script defer src="/assets/js/lenis.min.js"></script>
    <script defer src="/assets/js/splite-type.min.js"></script>
    <script defer src="/assets/js/vanilla-tilt.min.js"></script>

    <!-- Main Js File -->
    <script defer src="/assets/js/main.js"></script>

</body>


</html>