<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ __('messages.page_titles.refund-policy') }} | {{ config('business.name') }}</title>
    <meta content="Return and refund policy for {{ config('business.name') }} services." name="description">
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
                                <h2 class="title">{{ __('messages.page_titles.refund-policy') }}</h2>
                                <ul class="page-breadcrumb">
                                    <li><a href="{{ url(app()->getLocale()) }}"><i class="fa-solid fa-house-chimney"></i>{{ __('messages.nav.home') }}</a></li>
                                    <li><span>/</span> {{ __('messages.page_titles.refund-policy') }}</li>
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
                        <h2 class="sec-title mb-2">Return and Refund Policy</h2>
                        <p class="policy-updated">Last updated: {{ now()->format('F j, Y') }}</p>

                        <p>
                            We are committed to fair and transparent service. This policy describes how cancellations, returns,
                            and refunds are handled for services purchased from {{ config('business.name') }}.
                        </p>

                        <h3>1. Service Scope Confirmation</h3>
                        <p>
                            Before project start, we confirm the scope, timeline, and deliverables in writing.
                            Refund eligibility depends on the work stage and fulfilled deliverables.
                        </p>

                        <h3>2. Cancellation Before Work Begins</h3>
                        <p>
                            If cancellation is requested before any work has started, you may be eligible for a full refund,
                            excluding non-refundable payment processing fees.
                        </p>

                        <h3>3. Cancellation After Work Begins</h3>
                        <p>
                            If work has already started, refunds are generally prorated based on completed work,
                            time spent, and expenses already incurred.
                        </p>

                        <h3>4. Non-Refundable Cases</h3>
                        <ul>
                            <li>Completed milestones that have been delivered and accepted.</li>
                            <li>Third-party costs (licenses, domain, hosting, paid tools, ad spend).</li>
                            <li>Custom work performed according to approved requirements.</li>
                        </ul>

                        <h3>5. Revision and Resolution Process</h3>
                        <p>
                            If you are not satisfied, please contact us first. We will review the issue and provide
                            reasonable revision options before processing refund decisions.
                        </p>

                        <h3>6. Refund Request Procedure</h3>
                        <ul>
                            <li>Send your request to <a href="mailto:{{ config('business.email.primary') }}">{{ config('business.email.primary') }}</a>.</li>
                            <li>Include project name, invoice/reference, and reason for request.</li>
                            <li>We typically review requests within 5-10 business days.</li>
                        </ul>

                        <h3>7. Refund Method</h3>
                        <p>
                            Approved refunds are issued to the original payment method whenever possible.
                            Processing times depend on your payment provider.
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
