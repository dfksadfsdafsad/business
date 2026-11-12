<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>{{ __('messages.page_titles.blog-list') }} | {{ config('business.name') }}</title>
    <meta content="Latest blog updates" name="description">
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
        .blog-card-custom {
            border: 1px solid #e8edf5;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            height: 100%;
        }
        .blog-card-custom .thumb {
            display: block;
            aspect-ratio: 16 / 9;
            background: #f2f5fa;
        }
        .blog-card-custom .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .blog-card-custom .body {
            padding: 20px;
        }
        .blog-card-custom .title {
            font-size: 1.15rem;
            line-height: 1.4;
            margin-bottom: 10px;
        }
        .blog-card-custom .meta {
            color: #7b8393;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .blog-card-custom .excerpt {
            color: #5c6370;
            margin-bottom: 14px;
        }
        .blog-view-toggle a {
            border: 1px solid #d9e2f2;
            border-radius: 8px;
            padding: 7px 12px;
            text-decoration: none;
            color: #17223b;
            font-weight: 600;
        }
        .blog-view-toggle a.active {
            background: #17223b;
            border-color: #17223b;
            color: #fff;
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
                                <h2 class="title">{{ $isGrid ? __('messages.nav.blog_grid') : __('messages.nav.blog_list') }}</h2>
                                <ul class="page-breadcrumb">
                                    <li><a href="{{ url(app()->getLocale()) }}"><i class="fa-solid fa-house-chimney"></i>{{ __('messages.nav.home') }}</a></li>
                                    <li><span>/</span> {{ __('messages.nav.blog') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">{{ __('messages.footer.latest_blog') }}</h3>
                <div class="blog-view-toggle d-flex gap-2">
                    <a class="{{ $isGrid ? '' : 'active' }}" href="{{ route('localized.blog-list', ['locale' => app()->getLocale()]) }}">{{ __('messages.nav.blog_list') }}</a>
                    <a class="{{ $isGrid ? 'active' : '' }}" href="{{ route('localized.blog-grid', ['locale' => app()->getLocale()]) }}">{{ __('messages.nav.blog_grid') }}</a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="{{ $isGrid ? 'col-lg-4 col-md-6' : 'col-12' }}">
                        <article class="blog-card-custom {{ $isGrid ? '' : 'd-md-flex' }}">
                            <a class="thumb {{ $isGrid ? '' : 'col-md-4' }}" href="{{ route('localized.blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}">
                                <img loading="lazy" decoding="async" src="{{ $post->featured_image ?: '/assets/images/blog/blog-thumb05.webp' }}" alt="{{ $post->title }}">
                            </a>
                            <div class="body {{ $isGrid ? '' : 'col-md-8' }}">
                                <div class="meta">
                                    <i class="icon-calender"></i>
                                    {{ optional($post->published_at ?? $post->created_at)->format('F d, Y') }}
                                </div>
                                <h4 class="title">
                                    <a href="{{ route('localized.blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h4>
                                <p class="excerpt">{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}</p>
                                <a class="theme-btn style3" href="{{ route('localized.blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}">
                                    {{ __('messages.nav.blog_details') }}
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No published blog posts yet.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
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
