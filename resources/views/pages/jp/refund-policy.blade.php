<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ __('messages.page_titles.refund-policy') }} | {{ config('business.name') }}</title>
    <meta content="{{ config('business.name') }} の返品・返金ポリシー" name="description">
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
                        <h2 class="sec-title mb-2">返品・返金ポリシー</h2>
                        <p class="policy-updated">最終更新日: {{ now()->format('Y年n月j日') }}</p>

                        <p>
                            当社は、公平で透明性のあるサービス提供を重視しています。
                            本ポリシーでは、当社サービスにおけるキャンセル、返品、返金条件を定めます。
                        </p>

                        <h3>1. サービス内容の確定</h3>
                        <p>
                            着手前に、作業範囲・納期・成果物を事前に確認します。
                            返金可否は、進捗状況および納品済み成果物の内容を踏まえて判断します。
                        </p>

                        <h3>2. 着手前のキャンセル</h3>
                        <p>
                            業務着手前のキャンセルは、原則として全額返金対象です。
                            ただし、決済手数料等の実費は返金対象外となる場合があります。
                        </p>

                        <h3>3. 着手後のキャンセル</h3>
                        <p>
                            業務着手後は、完了済み工程・作業時間・実費に応じて按分計算し、
                            返金額を決定します。
                        </p>

                        <h3>4. 返金対象外となる主なケース</h3>
                        <ul>
                            <li>納品・承認済みのマイルストーン成果物</li>
                            <li>外部サービス費用（ドメイン、ホスティング、ライセンス、広告費等）</li>
                            <li>合意仕様に沿って実施済みのカスタム作業</li>
                        </ul>

                        <h3>5. 問題解決と修正対応</h3>
                        <p>
                            ご不満がある場合は、まず内容を確認し、合理的な修正案を提示します。
                            そのうえで返金要否を判断します。
                        </p>

                        <h3>6. 返金申請の方法</h3>
                        <ul>
                            <li><a href="mailto:{{ config('business.email.primary') }}">{{ config('business.email.primary') }}</a> へご連絡ください。</li>
                            <li>案件名、請求番号（または注文情報）、申請理由をご記載ください。</li>
                            <li>通常 5〜10 営業日以内に審査結果をご案内します。</li>
                        </ul>

                        <h3>7. 返金方法</h3>
                        <p>
                            返金承認後、可能な限り元の決済手段へ返金します。
                            反映時期は決済事業者により異なります。
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
