        @php
            $currentLocale = app()->getLocale();
            $supportedLocales = array_keys(config('site.supported_locales', ['en' => 'English', 'jp' => 'Japanese']));
            if (!in_array($currentLocale, $supportedLocales, true)) {
                $currentLocale = config('site.default_locale', 'en');
            }

            $segments = request()->segments();
            if (!empty($segments) && in_array($segments[0], $supportedLocales, true)) {
                array_shift($segments);
            }
            $relativePath = implode('/', $segments);
            $enUrl = url('en'.($relativePath !== '' ? '/'.$relativePath : ''));
            $jpUrl = url('jp'.($relativePath !== '' ? '/'.$relativePath : ''));
        @endphp
        <header class="tv-header header-style2">
            <div class="main-wrapper">
                <!-- Main Menu Area -->
                <div class="menu-area">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto logo">
                            <div class="header-logo">
                                <a href="{{ url('/') }}">
                                    <img alt="logo" src="/assets/images/logo/logo-2.png">
                                    <img alt="logo" src="/assets/images/logo/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-auto nav-outer">
                            <div class="nav-menu">
                                <nav class="main-menu d-none d-lg-inline-block">
                                    <ul class="navigation">
                                        <li class="active">
                                            <a class="active" href="{{ url($currentLocale) }}">{{ __('messages.nav.home') }}</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">{{ __('messages.nav.pages') }}</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ url($currentLocale.'/about') }}">{{ __('messages.nav.about') }}</a></li>
                                                                                                <li class="menu-item-has-children">
                                                    <a href="#">{{ __('messages.nav.team') }}</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ url($currentLocale.'/team') }}">{{ __('messages.nav.our_team') }}</a></li>
                                                        <li><a href="{{ url($currentLocale.'/team-details') }}">{{ __('messages.nav.team_details') }}</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">{{ __('messages.nav.projects') }}</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ url($currentLocale.'/project') }}">{{ __('messages.nav.projects') }}</a></li>
                                                        <li><a href="{{ url($currentLocale.'/project-details') }}">{{ __('messages.nav.project_details') }}</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ url($currentLocale.'/gallery') }}">{{ __('messages.nav.gallery') }}</a></li>

                                                <li><a href="{{ url($currentLocale.'/pricing') }}">{{ __('messages.nav.pricing') }}</a></li>
                                                <li><a href="{{ url($currentLocale.'/faq') }}">{{ __('messages.nav.faq') }}</a></li>
                                                <li><a href="{{ url($currentLocale.'/404') }}">{{ __('messages.nav.not_found') }}</a></li>
                                                <li><a href="{{ url($currentLocale.'/contact') }}">{{ __('messages.nav.contact') }}</a></li>
                                            </ul>
                                        </li>                                        
                                        <li class="menu-item-has-children">
                                            <a href="#">{{ __('messages.nav.services') }}</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ url($currentLocale.'/service') }}">{{ __('messages.nav.services') }}</a></li>
                                                <li><a href="{{ url($currentLocale.'/service-details') }}">{{ __('messages.nav.service_details') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">{{ __('messages.nav.portfolio') }}</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ url($currentLocale.'/project') }}">{{ __('messages.nav.projects') }}</a></li>
                                                <li><a href="{{ url($currentLocale.'/project-details') }}">{{ __('messages.nav.project_details') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">{{ __('messages.nav.blog') }}</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ url($currentLocale.'/blog-grid') }}">{{ __('messages.nav.blog_grid') }}</a></li>
                                                <li><a href="{{ url($currentLocale.'/blog-list') }}">{{ __('messages.nav.blog_list') }}</a></li>
                                                <li><a href="{{ url($currentLocale.'/blog-details') }}">{{ __('messages.nav.blog_details') }}</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ url($currentLocale.'/contact') }}">{{ __('messages.nav.contact') }}</a></li>
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
                        <div class="col-auto header-right-wrapper">
                            <div class="outer-box">
                                <div class="d-inline-block me-2 position-relative" data-lang-switcher>
                                    <button class="theme-btn style3" type="button" data-lang-toggle aria-haspopup="true" aria-expanded="false">
                                        @if ($currentLocale === 'jp')
                                            <img src="{{ url('/assets/images/icons/flag-jp.svg') }}" alt="JP" style="width: 18px; height: 12px; margin-right: 8px;">
                                            {{ __('messages.lang_jp') }}
                                        @else
                                            <img src="{{ url('/assets/images/icons/flag-us.svg') }}" alt="EN" style="width: 18px; height: 12px; margin-right: 8px;">
                                            {{ __('messages.lang_en') }}
                                        @endif
                                    </button>
                                    <ul data-lang-menu style="display: none; position: absolute; right: 0; top: calc(100% + 8px); min-width: 170px; background: #fff; border: 1px solid #e8e8e8; border-radius: 8px; box-shadow: 0 8px 24px rgba(0,0,0,.12); padding: 8px 0; z-index: 9999; list-style: none; margin: 0;">
                                        <li>
                                            <a href="{{ $enUrl }}" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; color: #1a1a1a; text-decoration: none;">
                                                <img src="{{ url('/assets/images/icons/flag-us.svg') }}" alt="EN" style="width: 18px; height: 12px;">
                                                <span>{{ __('messages.lang_en') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $jpUrl }}" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; color: #1a1a1a; text-decoration: none;">
                                                <img src="{{ url('/assets/images/icons/flag-jp.svg') }}" alt="JP" style="width: 18px; height: 12px;">
                                                <span>{{ __('messages.lang_jp') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- <button class="search-btn">
                                    <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                </button> -->
                                <a href="{{ url($currentLocale.'/about') }}" class="theme-btn">
                                    <span class="link-effect">
                                        <span class="effect-1">{{ __('messages.nav.quote') }}</span>
                                        <span class="effect-1">{{ __('messages.nav.quote') }}</span>
                                    </span>
                                    <span class="arrow-all">
                                        <i>
                                            <svg width="16" height="19" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 6H10M10 6L6 2M10 6L6 10" stroke="#061153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <svg width="16" height="19" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 6H10M10 6L6 2M10 6L6 10" stroke="#061153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </i>
                                    </span>
                                </a>
                                <!-- <div class="sidebar-icon">
                                    <button class="sidebar-trigger open">
                                        <img src="/assets/images/icons/sidebar-toggle.webp" alt="">
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
