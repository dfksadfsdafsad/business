<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ __('messages.page_titles.privacy-policy') }} | {{ config('business.name') }}</title>
    <meta content="{{ config('business.name') }} のプライバシーポリシー" name="description">
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
                        <h2 class="sec-title mb-2">プライバシーポリシー</h2>
                        <p class="policy-updated">最終更新日: {{ now()->format('Y年n月j日') }}</p>

                        <p>
                            {{ config('business.name') }}（以下「当社」）は、当社ウェブサイトのご利用時に取得する個人情報を、
                            関連法令に基づき適切に取り扱います。
                        </p>

                        <h3>1. 取得する情報</h3>
                        <ul>
                            <li>氏名、メールアドレス、電話番号などのお問い合わせ情報</li>
                            <li>お問い合わせフォームでご提供いただく内容</li>
                            <li>アクセスログ、ブラウザ情報、利用状況などの技術情報</li>
                        </ul>

                        <h3>2. 利用目的</h3>
                        <ul>
                            <li>お問い合わせへの回答およびサポート提供</li>
                            <li>サービス提供・品質向上・機能改善</li>
                            <li>不正利用防止およびセキュリティ維持</li>
                            <li>法令等に基づく対応</li>
                        </ul>

                        <h3>3. 第三者提供</h3>
                        <p>
                            当社は、法令で認められる場合を除き、ご本人の同意なく個人情報を第三者へ提供しません。
                            ただし、業務委託先（ホスティング、メール配信、解析など）へ必要最小限の情報を提供する場合があります。
                        </p>

                        <h3>4. 保管期間</h3>
                        <p>
                            個人情報は、利用目的の達成に必要な期間のみ保管し、不要となった情報は適切に削除または匿名化します。
                        </p>

                        <h3>5. Cookie等の利用</h3>
                        <p>
                            当社サイトでは、利便性向上や利用状況分析のためCookie等を使用する場合があります。
                        </p>

                        <h3>6. 開示・訂正・削除の請求</h3>
                        <p>
                            ご本人からの個人情報に関する開示、訂正、削除等の請求には、法令に従い適切に対応します。
                            ご希望の場合は <a href="mailto:{{ config('business.email.primary') }}">{{ config('business.email.primary') }}</a> までご連絡ください。
                        </p>

                        <h3>7. 改定について</h3>
                        <p>
                            本ポリシーは必要に応じて改定する場合があります。改定後は本ページに掲載した時点で効力を生じます。
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
