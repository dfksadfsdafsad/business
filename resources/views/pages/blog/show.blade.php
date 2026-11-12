<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ $post->title }} | {{ config('business.name') }}</title>
    <meta content="{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}" name="description">
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
        .single-blog-wrap {
            padding: 80px 0;
        }
        .single-blog-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 18px;
            overflow: hidden;
        }
        .single-blog-card .thumb {
            aspect-ratio: 16 / 7;
            background: #f2f5fa;
        }
        .single-blog-card .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .single-blog-card .body {
            padding: 28px;
        }
        .single-blog-card .meta {
            color: #7b8393;
            margin-bottom: 10px;
        }
        .single-blog-card .content {
            color: #2f3a4b;
            line-height: 1.85;
            word-break: break-word;
        }
        .single-blog-card .content h1,
        .single-blog-card .content h2,
        .single-blog-card .content h3,
        .single-blog-card .content h4 {
            margin-top: 24px;
            margin-bottom: 12px;
        }
        .recent-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .recent-list li + li {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid #edf0f6;
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
                                <h2 class="title">{{ __('messages.nav.blog_details') }}</h2>
                                <ul class="page-breadcrumb">
                                    <li><a href="{{ url(app()->getLocale()) }}"><i class="fa-solid fa-house-chimney"></i>{{ __('messages.nav.home') }}</a></li>
                                    <li><span>/</span><a href="{{ route('localized.blog-list', ['locale' => app()->getLocale()]) }}">{{ __('messages.nav.blog_list') }}</a></li>
                                    <li><span>/</span> {{ \Illuminate\Support\Str::limit($post->title, 40) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="single-blog-wrap bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <article class="single-blog-card">
                        <div class="thumb">
                            <img loading="lazy" decoding="async" src="{{ $post->featured_image ?: '/assets/images/blog/blog-thumb05.webp' }}" alt="{{ $post->title }}">
                        </div>
                        <div class="body">
                            <div class="meta">
                                <i class="icon-calender"></i>
                                {{ optional($post->published_at ?? $post->created_at)->format('F d, Y') }}
                            </div>
                            <h1 class="h2 mb-3">{{ $post->title }}</h1>
                            @if($post->excerpt)
                                <p class="lead">{{ $post->excerpt }}</p>
                            @endif
                            <div class="content">{!! nl2br(e($post->content)) !!}</div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <div class="single-blog-card">
                        <div class="body">
                            <h3 class="h5 mb-3">{{ __('messages.footer.latest_blog') }}</h3>
                            <ul class="recent-list">
                                @forelse($recentPosts as $recent)
                                    <li>
                                        <a href="{{ route('localized.blog.show', ['locale' => app()->getLocale(), 'slug' => $recent->slug]) }}" class="fw-semibold d-block">{{ $recent->title }}</a>
                                        <small class="text-muted">{{ optional($recent->published_at ?? $recent->created_at)->format('F d, Y') }}</small>
                                    </li>
                                @empty
                                    <li><small class="text-muted">No related posts.</small></li>
                                @endforelse
                            </ul>
                        </div>
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
