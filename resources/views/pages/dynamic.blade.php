<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ $title }} | {{ config('business.name') }}</title>
    <meta content="{{ $metaDescription }}" name="description">
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
</head>
<body id="body">
<div class="page-wrapper bg-light">
    @include('partials.header')

    @foreach($sections as $section)
        @php
            $type = data_get($section, 'type', 'text');
            $props = data_get($section, 'props', []);
            $style = data_get($section, 'style', []);
            $paddingTop = (int) data_get($style, 'padding_top', 48);
            $paddingBottom = (int) data_get($style, 'padding_bottom', 48);
            $bg = data_get($style, 'background_color', '#ffffff');
            $color = data_get($style, 'text_color', '#111827');
            $inlineStyle = 'padding-top:'.max(0, min(220, $paddingTop)).'px;padding-bottom:'.max(0, min(220, $paddingBottom)).'px;background:'.$bg.';color:'.$color.';';
        @endphp

        @if($type === 'hero')
            <section style="{{ $inlineStyle }} {{ data_get($props, 'background_image') ? 'background-image:url('.e(data_get($props, 'background_image')).');background-size:cover;background-position:center;' : '' }}">
                <div class="container">
                    <div class="text-center">
                        <div class="small fw-semibold mb-2">{{ data_get($props, 'eyebrow') }}</div>
                        <h1 class="mb-3">{{ data_get($props, 'heading') }}</h1>
                        <p class="mb-4">{{ data_get($props, 'subheading') }}</p>
                        <a href="{{ data_get($props, 'button_url', '#') }}" class="btn btn-light">{{ data_get($props, 'button_text') }}</a>
                    </div>
                </div>
            </section>
        @elseif($type === 'image')
            <section style="{{ $inlineStyle }}">
                <div class="container text-center">
                    @if(data_get($props, 'image_url'))
                        <a href="{{ data_get($props, 'link_url', '#') }}">
                            <img src="{{ data_get($props, 'image_url') }}" alt="{{ data_get($props, 'alt') }}" style="max-width:100%;height:auto;border-radius:10px;">
                        </a>
                    @endif
                    @if(data_get($props, 'caption'))
                        <p class="mt-2 mb-0">{{ data_get($props, 'caption') }}</p>
                    @endif
                </div>
            </section>
        @elseif($type === 'cta')
            <section style="{{ $inlineStyle }} background:{{ data_get($props, 'background_color', '#111827') }}; color:{{ data_get($props, 'text_color', '#ffffff') }};">
                <div class="container text-center">
                    <h2 class="mb-3">{{ data_get($props, 'heading') }}</h2>
                    <a href="{{ data_get($props, 'button_url', '#') }}" class="btn btn-outline-light">{{ data_get($props, 'button_text') }}</a>
                </div>
            </section>
        @else
            <section style="{{ $inlineStyle }} text-align:{{ data_get($props, 'align', 'left') }};">
                <div class="container">
                    <h2 class="mb-3">{{ data_get($props, 'heading') }}</h2>
                    <p class="mb-0">{{ data_get($props, 'body') }}</p>
                </div>
            </section>
        @endif
    @endforeach

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
