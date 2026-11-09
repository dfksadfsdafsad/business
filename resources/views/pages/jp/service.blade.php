<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ __('messages.page_titles.service') }} | {{ config('business.name') }}</title>
    <meta content="Inotek - ITソリューション HTML5 テンプレート" name="description">
    <meta content="Inotek - ITソリューション HTML5 テンプレート" name="keywords">
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
                            <span class="title">いつでもお電話ください</span>
                            <a href="tel:{{ config('business.phone.raw') }}">{{ config('business.phone.display') }}</a>
                        </div>
                    </li>
                    <li>

                        <div class="contact-info-box">
                            <span class="icon fa-light fa-envelope"></span>
                            <span class="title">メールでお問い合わせ</span>
                            <a href="mailto:{{ config('business.email.primary') }}">{{ config('business.email.primary') }}</a>
                        </div>
                    </li>
                    <li>

                        <div class="contact-info-box">
                            <span class="icon fa-light fa-alarm-clock"></span>
                            <span class="title">営業時間</span>
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

        <!-- Header 検索 -->
        <div class="search-popup">
            <button class="close-search style-1"><i class="fa fa-times"></i></button>
            <button class="close-search"><i class="fas fa-arrow-up"></i></button>
            <form method="post" action="#">
                <div class="form-group">
                    <input id="search1" type="search" name="search-field" value="" placeholder="検索..." required="">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <!-- End Header 検索 -->

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
                            <input type="email" name="email" class="email" value="" placeholder="Enter Your メールアドレス" autocomplete="on" required="">
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
                                    <h2 class="title">サービス</h2>
                                    <ul class="page-breadcrumb">
                                        <li><a href="{{ url(app()->getLocale()) }}"><i class="fa-solid fa-house-chimney"></i>ホーム</a></li>
                                        <li><span>/</span> サービス</li>
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
        Freature Section One
        ==============================-->
        <section class="tv-feature-section bg-light space">
            <div class="container">
                <div class="row gy-30">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="tv-feature-item wow fadeInLeft" data-wow-delay=".5s">
                            <div class="client-social-proof">
                                <div class="social">
                                    <img loading="lazy" decoding="async" src="/assets/images/social/social-img01.webp" alt="Client 01">
                                    <img loading="lazy" decoding="async" src="/assets/images/social/social-img02.webp" alt="Client 02">
                                    <img loading="lazy" decoding="async" src="/assets/images/social/social-img03.webp" alt="Client 03">
                                    <h4>+3K</h4>
                                </div>
                                <div class="count-box mt-30"><span class="count-number odometer" data-count="3,600"></span></div>
                                <div class="rating-viewers">アクティブ顧客</div>
                                <a href="contact.html" class="theme-btn style2 mt-20 br-30">
                                    <span class="link-effect">
                                        <span class="effect-1">詳細を見る</span>
                                        <span class="effect-1">詳細を見る</span>
                                    </span>
                                    <span class="arrow-all-2">
                                        <i>
                                            <svg width="11" height="12" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                            </svg>
                                            <svg width="11" height="12" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                            </svg>
                                        </i>
                                    </span>
                                </a>
                                <div class="scribble-shape1 moving">
                                    <img loading="lazy" decoding="async" src="/assets/images/feature/scribble.webp" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="tv-feature-box wow fadeInLeft" data-wow-delay=".7s">
                            <div class="icon-top">
                                <div class="icon">
                                    <i>
                                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                        </svg>
                                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                        </svg>
                                    </i>
                                </div>
                            </div>
                            <div class="logo mb-40"><img loading="lazy" decoding="async" src="/assets/images/feature/hm1-icon01.webp" alt=""></div>
                            <h2>IT Consultancy and <br>Management</h2>
                            <p>Reintermediate technically sound to processes whereas market</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="tv-feature-box bg-theme3 wow fadeInLeft" data-wow-delay=".9s">
                        <div class="icon-top">
                            <div class="icon style2 bg-dark">
                                <i>
                                    <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                    </svg>
                                    <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                    </svg>
                                </i>
                            </div>
                        </div>
                        <div class="logo mb-40"><img loading="lazy" decoding="async" src="/assets/images/feature/hm1-icon02.webp" alt=""></div>
                        <h2>Digital Transformation <br>And Automation</h2>
                        <p>Reintermediate technically sound to processes whereas market</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        
        <!--==============================
        Service Section Two
        ==============================-->
        <section class="tv-service-section space-bottom inner style-2 bg-light">
            <div class="tv-service-inner position-relative overflow-hidden mx-30 ml-mx-0">
                <div class="container">
                    <!-- Section Title -->
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="title-wrap two white" data-wow-duration="2s" data-wow-delay=".0s">
                                <div class="sub-title-2"><i class="fa-solid fa-circle-check"></i>サービス</div>
                                <h2 class="sec-title text-dark">Empowering Companies with Reliable <br>and Scalable IT サービス</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-30">
                        <!-- service box -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="tv-service-single-box wow fadeInUp" data-wow-delay=".2s">
                                <div class="inner-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/service/hm1-icon01.webp" alt=""></div>
                                    <h4 class="title">Content Marketing <br>Optimization</h4>
                                    <div class="border2 mt-20 mb-20"></div>
                                    <p class="text">Professionally reintermediate technic turnkey processes whereas discovery technology maintaince</p>
                                    <a href="project.html" class="theme-btn w-100 mt-40">
                                        <span class="link-effect">
                                            <span class="effect-1">EXPLORE MORE</span>
                                            <span class="effect-1">EXPLORE MORE</span>
                                        </span>
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="tv-service-single-box wow fadeInUp" data-wow-delay=".2s">
                                <div class="inner-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/service/hm1-icon02.webp" alt=""></div>
                                    <h4 class="title">Influencer and Affiliate <br>Marketing</h4>
                                    <div class="border2 mt-20 mb-20"></div>
                                    <p class="text">Professionally reintermediate technic turnkey processes whereas discovery technology maintaince</p>
                                    <a href="project.html" class="theme-btn w-100 mt-40">
                                        <span class="link-effect">
                                            <span class="effect-1">EXPLORE MORE</span>
                                            <span class="effect-1">EXPLORE MORE</span>
                                        </span>
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="tv-service-single-box wow fadeInUp" data-wow-delay=".2s">
                                <div class="inner-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/service/hm1-icon03.webp" alt=""></div>
                                    <h4 class="title">Social Media Marketing <br>Management</h4>
                                    <div class="border2 mt-20 mb-20"></div>
                                    <p class="text">Professionally reintermediate technic turnkey processes whereas discovery technology maintaince</p>
                                    <a href="project.html" class="theme-btn w-100 mt-40">
                                        <span class="link-effect">
                                            <span class="effect-1">EXPLORE MORE</span>
                                            <span class="effect-1">EXPLORE MORE</span>
                                        </span>
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="tv-service-single-box wow fadeInUp" data-wow-delay=".2s">
                                <div class="inner-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/service/details-icon01.webp" alt=""></div>
                                    <h4 class="title">Website and Mobile Apps <br> Development</h4>
                                    <div class="border2 mt-20 mb-20"></div>
                                    <p class="text">Professionally reintermediate technic turnkey processes whereas discovery technology maintaince</p>
                                    <a href="project.html" class="theme-btn w-100 mt-40">
                                        <span class="link-effect">
                                            <span class="effect-1">EXPLORE MORE</span>
                                            <span class="effect-1">EXPLORE MORE</span>
                                        </span>
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="tv-service-single-box wow fadeInUp" data-wow-delay=".2s">
                                <div class="inner-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/service/details-icon02.webp" alt=""></div>
                                    <h4 class="title">Web and Mobile UI/UX <br> Designing</h4>
                                    <div class="border2 mt-20 mb-20"></div>
                                    <p class="text">Professionally reintermediate technic turnkey processes whereas discovery technology maintaince</p>
                                    <a href="project.html" class="theme-btn w-100 mt-40">
                                        <span class="link-effect">
                                            <span class="effect-1">EXPLORE MORE</span>
                                            <span class="effect-1">EXPLORE MORE</span>
                                        </span>
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="tv-service-single-box wow fadeInUp" data-wow-delay=".2s">
                                <div class="inner-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/service/details-icon03.webp" alt=""></div>
                                    <h4 class="title">Video Editing and <br> 3D Animation</h4>
                                    <div class="border2 mt-20 mb-20"></div>
                                    <p class="text">Professionally reintermediate technic turnkey processes whereas discovery technology maintaince</p>
                                    <a href="project.html" class="theme-btn w-100 mt-40">
                                        <span class="link-effect">
                                            <span class="effect-1">EXPLORE MORE</span>
                                            <span class="effect-1">EXPLORE MORE</span>
                                        </span>
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>                                                                        
                    </div>
                </div>
            </div>
        </section>




        

        <!--==============================
        Marquee Section
        ==============================-->
        <div class="tv-marquee-section bg-light position-relative">
            <div class="tv-marquee-inner mx-30 ml-mx-0 position-relative">
                <div class="container-fluid p-0 overflow-hidden">
                    <div class="slider__marquee clearfix marquee-wrap">
                        <ul class="marquee_mode marquee__group">
                            <li class="item m-item"><img loading="lazy" decoding="async" class="icon" src="/assets/images/icons/marquee-icon.png" alt=""> デジタルマーケティング</li>
                            <li class="item m-item"><img loading="lazy" decoding="async" class="icon" src="/assets/images/icons/marquee-icon.png" alt=""> Branding Solutions</li>
                            <li class="item m-item"><img loading="lazy" decoding="async" class="icon" src="/assets/images/icons/marquee-icon.png" alt=""> Custom Website</li>
                            <li class="item m-item"><img loading="lazy" decoding="async" class="icon" src="/assets/images/icons/marquee-icon.png" alt=""> Innovation Design</li>
                            <li class="item m-item"><img loading="lazy" decoding="async" class="icon" src="/assets/images/icons/marquee-icon.png" alt=""> Cyber Security</li>
                        </ul>
                    </div>
                 </div>
            </div>
        </div>




        <!--==============================
        Proces Section One
        ==============================-->
        <section class="tv-process-section bg-light position-relative">
            <div class="p-top-center z-1 wow slideInTop">
                <img loading="lazy" decoding="async" src="/assets/images/process/hm1-shape01.png" alt="">
            </div>
            <div class="process-inner bg-theme3  mx-30 ml-mx-0 br_bl-30 br_br-30 ml-br-0  space  overflow-hidden xxl-br-0 position-relative">
                <div class="container position-relative">
                    <!-- Section Title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="process-title mt--25">
                                <h2 class="text-white text-center">PR<span class="text-theme">O</span>CESS</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-30">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="tv-process-item wow fadeInRightBig" data-wow-delay=".2s">
                                <h4 class="title-text">STEP 01</h4>
                                <div class="process-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/process/hm1-icon1.webp" alt=""></div>
                                    <h3 class="title">Consult Understand</h3>
                                    <p>Technically sound chains to main and paid marketplace</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="tv-process-item wow fadeInRightBig" data-wow-delay=".3s">
                                <h4 class="title-text">STEP 02</h4>
                                <div class="process-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/process/hm1-icon2.webp" alt=""></div>
                                    <h3 class="title">Plan Strategize</h3>
                                    <p>Technically sound chains to main and paid marketplace</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="tv-process-item  wow fadeInRightBig" data-wow-delay=".4s">
                                <h4 class="title-text">STEP 03</h4>
                                <div class="process-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/process/hm1-icon3.webp" alt=""></div>
                                    <h3 class="title">Implement Execute</h3>
                                    <p>Technically sound chains to main and paid marketplace</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="tv-process-item wow fadeInRightBig" data-wow-delay=".5s">
                                <h4 class="title-text">STEP 04</h4>
                                <div class="process-box">
                                    <div class="icon"><img loading="lazy" decoding="async" src="/assets/images/process/hm1-icon4.webp" alt=""></div>
                                    <h3 class="title">Support Optimize</h3>
                                    <p>Technically sound chains to main and paid marketplace</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!--==============================
        料金 Section One
        ==============================-->
        <section class="tv-pricing-section space bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-wrap text-center three">
                            <div class="sub-title-2  text-theme"><i class="fa-solid fa-circle-check"></i>料金 Plans</div>
                            <h2 class="sec-title">Choose the Perfect Plans for <br> Your Business Growth</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-30 align-items-end">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="tv-pricing-card wow fadeInUp" data-wow-delay=".5s">
                            <div class="pricing-inner-box">
                                <div class="pricing-inner">
                                    <div class="pricing-plan">
                                        <h5 class="plan">Starter</h5>
                                        <div class="price">
                                            <h2>29 USD</h2>
                                            <span class="billing-cycle">/ month</span>
                                        </div>
                                        <p>Organize Daily Task by free</p>
                                        <a href="contact.html" class="theme-btn mt-25 w-100 br-25">
                                            <span class="link-effect">
                                                <span class="effect-1">Join this Plan</span>
                                                <span class="effect-1">Join this Plan</span>
                                            </span>
                                            <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                                        </a>
                                        <h4>Key Features</h4>
                                    </div>
                                        <ul class="features">
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> 3 Users availble</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> Limited tools</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> Unlimited Supports</li>
                                            <li class="disabled"><span class="checkmark"><i class="fa-solid fa-circle-x"></i></span> API Access</li>
                                            <li class="disabled"><span class="checkmark"><i class="fa-solid fa-circle-x"></i></span> Premium apps</li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="tv-pricing-card style2 wow fadeInUp" data-wow-delay=".7s">
                            <div class="popular-badge"><i class="fa-solid fa-fire"></i> Most Popular</div>
                            <div class="pricing-inner-box">
                                <div class="top-icon spin"><img loading="lazy" decoding="async" src="/assets/images/pricing/spin-shape02.webp" alt=""></div>
                                <div class="pricing-inner">
                                    <div class="pricing-plan">
                                        <h5 class="plan">Starter</h5>
                                        <div class="price">
                                            <h2>39 USD</h2>
                                            <span class="billing-cycle">/ month</span>
                                        </div>
                                        <p>Organize Daily Task by free</p>
                                        <a href="contact.html" class="theme-btn mt-25 w-100 br-25">
                                            <span class="link-effect">
                                                <span class="effect-1">Join this Plan</span>
                                                <span class="effect-1">Join this Plan</span>
                                            </span>
                                            <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                                        </a>
                                        <h4>Key Features</h4>
                                    </div>
                                        <ul class="features">
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> 3 Users availble</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> Limited tools</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> Unlimited Supports</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> API Access</li>
                                            <li class="disabled"><span class="checkmark"><i class="fa-solid fa-circle-x"></i></span> Premium apps</li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="tv-pricing-card wow fadeInUp" data-wow-delay=".9s">
                            <div class="pricing-inner-box">
                                <div class="pricing-inner">
                                    <div class="pricing-plan">
                                        <h5 class="plan">Business</h5>
                                        <div class="price">
                                            <h2>39 USD</h2>
                                            <span class="billing-cycle">/ month</span>
                                        </div>
                                        <p>Organize Daily Task by free</p>
                                        <a href="contact.html" class="theme-btn mt-25 w-100 br-25">
                                            <span class="link-effect">
                                                <span class="effect-1">Join this Plan</span>
                                                <span class="effect-1">Join this Plan</span>
                                            </span>
                                            <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                                        </a>
                                        <h4>Key Features</h4>
                                    </div>
                                        <ul class="features">
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> 3 Users availble</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> Limited tools</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> Unlimited Supports</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> API Access</li>
                                            <li><span class="checkmark"><i class="fa-solid fa-circle-check"></i></span> Premium apps</li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>





        
        <!--==============================
        Call To Action
        ==============================-->
        <section class="tv-cta-section inner bg-light">
            <div class="container border-top">
                <div class="row gy-30 align-items-center">
                    <div class="col-lg-6">
                        <div class="cta-content-wrapper">
                           <div class="title-wrap three" data-wow-duration="1.5s" data-wow-delay=".4s">
                                <div class="sub-title-2 text-theme"><i class="fa-solid fa-circle-check"></i>Get In Touch</div>
                                <h2 class="sec-title">Let’s Collaborate with Us</h2>
                                <p>Collaboratively supply bricks-and-clicks metrics for maintainable users from <br> reinvent unique value for just in time consult.</p>
                            </div>
                            <a href="contact.html" class="theme-btn">
                                <span class="link-effect">
                                    <span class="effect-1">お問い合わせ with Us</span>
                                    <span class="effect-1">お問い合わせ with Us</span>
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
                    <div class="col-lg-6">
                        <div class="image-grid">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="lines2">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="image-box">
                                <div class="image-item"><img loading="lazy" decoding="async" src="/assets/images/service/details01.webp" alt="Person 1"></div>
                                <div class="image-item"><div class="icon"><i class="icon-handshake"></i></div></div>
                                <div class="image-item"><img loading="lazy" decoding="async" src="/assets/images/service/details02.webp" alt="Person 3"></div>
                                <div class="image-item"><img loading="lazy" decoding="async" src="/assets/images/service/details03.webp" alt="Person 4"></div>
                                <div class="image-item"><img loading="lazy" decoding="async" src="/assets/images/service/details04.webp" alt="Person 5"></div>
                            </div>
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
                                <h3 class="title title-anim" data-animation="bounce-in">最新情報のニュースレターを<br>購読する</h3>
                             </div>
                                <form class="newsletter-form" action="https://formspree.io/f/mzbnjrnb" method="post">
                                    <div class="form-group">
                                        <input type="email" name="email" class="email" value="" placeholder="メールアドレス 住所" autocomplete="on" required="">
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