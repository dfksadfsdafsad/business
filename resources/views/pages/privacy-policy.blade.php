<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ __('messages.page_titles.privacy-policy') }} | {{ config('business.name') }}</title>
    <meta content="Privacy policy for {{ config('business.name') }} website and services." name="description">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <link href="/assets/images/favicons/favicon.png" rel="icon" sizes="32x32" type="image/png">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="/assets/css/flaticon.min.css" rel="stylesheet">
    <link href="/assets/css/fancybox.min.css" rel="stylesheet">
    <link href="/assets/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/css/animate.min.css" rel="stylesheet">
    <link href="/assets/css/select2.min.css" rel="stylesheet">
    <link href="/assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="/assets/css/odometer.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <style>
        .policy-wrap {
            padding: 80px 0;
        }

        .policy-card {
            background: #ffffff;
            border: 1px solid #eceef3;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 8px 30px rgba(11, 29, 52, 0.05);
        }

        .policy-card h3 {
            font-size: 1.25rem;
            margin-top: 28px;
            margin-bottom: 12px;
        }

        .policy-card p,
        .policy-card li {
            color: #5c6370;
            line-height: 1.8;
        }

        .policy-updated {
            color: #7b8393;
            font-size: 0.95rem;
            margin-bottom: 24px;
        }
    </style>
</head>
<body id="body">
<div class="page-wrapper bg-light">
    @include('partials.header')

    <section class="tv-breadcrumb-section">
        <div class="tv-breadcrumb-inner mx-30 ml-mx-0 position-relative overflow-hidden br-30 ml-br-0">
            <div class="bg image"><img loading="lazy" decoding="async" src="/assets/images/bg-img/breadcrumb.webp" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title-outer">
                            <div class="page-title">
                                <h2 class="title">{{ __('messages.page_titles.privacy-policy') }}</h2>
                                <ul class="page-breadcrumb">
                                    <li><a href="{{ url(app()->getLocale()) }}"><i class="fa-solid fa-house-chimney"></i>{{ __('messages.nav.home') }}</a></li>
                                    <li><span>/</span> {{ __('messages.page_titles.privacy-policy') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="policy-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="policy-card">
                        <h2 class="sec-title mb-2">Privacy Policy</h2>
                        <p class="policy-updated">Last updated: {{ now()->format('F j, Y') }}</p>

                        <p>
                            This Privacy Policy explains how {{ config('business.name') }} collects, uses, and protects your information when you visit our website,
                            submit forms, or communicate with our team.
                        </p>

                        <h3>1. Information We Collect</h3>
                        <ul>
                            <li>Contact details such as your name, email address, and phone number.</li>
                            <li>Inquiry details you provide through contact forms.</li>
                            <li>Technical data such as browser type, device information, and page usage analytics.</li>
                        </ul>

                        <h3>2. How We Use Your Information</h3>
                        <ul>
                            <li>To respond to inquiries and provide customer support.</li>
                            <li>To deliver and improve our services.</li>
                            <li>To maintain website security and prevent abuse.</li>
                            <li>To comply with legal obligations.</li>
                        </ul>

                        <h3>3. Data Sharing</h3>
                        <p>
                            We do not sell your personal data. We may share data with trusted service providers (such as hosting, analytics, or email delivery)
                            only when needed to operate our services and under appropriate confidentiality obligations.
                        </p>

                        <h3>4. Data Retention</h3>
                        <p>
                            We retain personal data only for as long as necessary to fulfill the purposes described in this policy, unless a longer retention
                            period is required by law.
                        </p>

                        <h3>5. Cookies and Tracking</h3>
                        <p>
                            We may use cookies or similar technologies to improve website functionality, measure performance, and enhance user experience.
                        </p>

                        <h3>6. Your Rights</h3>
                        <p>
                            Depending on your jurisdiction, you may have rights to access, correct, or request deletion of your personal data.
                            To make a request, contact us at <a href="mailto:{{ config('business.email.primary') }}">{{ config('business.email.primary') }}</a>.
                        </p>

                        <h3>7. Policy Updates</h3>
                        <p>
                            We may update this policy periodically. Changes become effective when posted on this page.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
</div>

<script defer src="/assets/js/jquery-3.7.1.min.js"></script>
<script defer src="/assets/js/bootstrap.bundle.min.js"></script>
<script defer src="/assets/js/swiper-bundle.min.js"></script>
<script defer src="/assets/js/fancybox.js"></script>
<script defer src="/assets/js/wow.js"></script>
<script defer src="/assets/js/aos.js"></script>
<script defer src="/assets/js/odometer.min.js"></script>
<script defer src="/assets/js/appear.min.js"></script>
<script defer src="/assets/js/jquery.marquee.min.js"></script>
<script defer src="/assets/js/select2.min.js"></script>
<script defer src="/assets/js/jquery-ui.js"></script>
<script defer src="/assets/js/main.js"></script>
</body>
</html>
