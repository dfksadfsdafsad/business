        <footer class="footer-section z-1 br-30 xxl-br-0 pt-75 bg-dark position-relative mx-30 mb-30 xxl-m-0 overflow-hidden">
            <div class="bg image mbm-screen"><img src="/assets/images/footer/hm1-bg01.webp" alt=""></div>
            <div class="footer-top space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 footer-brand">
                            <div class="brand-info wow fadeInUp" data-wow-delay=".6s">
                                <div class="logo">
                                    <img src="/assets/images/logo/logo-2.png" alt="{{ config('business.name') }} Logo" >
                                </div>
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <h3 class="title">{{ __('messages.footer.free_conversation') }}</h3>
                                        <a href="mailto:{{ config('business.email.primary') }}">
                                            <i class="fa-sharp fa-light fa-envelope"></i> {{ config('business.email.primary') }}
                                        </a>
                                    </div>
                                    <div class="contact-item">
                                        <h3 class="title">{{ __('messages.footer.call_us') }}</h3>
                                        <a href="tel:{{ config('business.phone.raw') }}">
                                            <i class="flaticon-phone"></i> {{ config('business.phone.display') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="social-links">
                                    <a href="{{ config('business.social.facebook', '#') }}" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ config('business.social.x_twitter', '#') }}" class="social-icon"><i class="fab fa-x-twitter"></i></a>
                                    <a href="{{ config('business.social.linkedin', '#') }}" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="{{ config('business.social.pinterest', '#') }}" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 p-0 sm-pl-15">
                                    <div class="footer-widget wow fadeInUp" data-wow-delay="1s">
                                        <h4 class="title">{{ __('messages.footer.information') }}</h4>
                                        <ul class="list-unstyled">
                                            <li><a href="#">{{ __('messages.footer.about_us') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.our_team') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.latest_blog') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.contact_us') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.career') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 p-0 sm-pl-15">
                                    <div class="footer-widget wow fadeInUp" data-wow-delay="1.3s">
                                        <h4 class="title">{{ __('messages.footer.services') }}</h4>
                                        <ul class="list-unstyled">
                                            <li><a href="#">{{ __('messages.footer.web_development') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.uiux_design') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.digital_marketing') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.networking') }}</a></li>
                                            <li><a href="#">{{ __('messages.footer.hosting') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 md-d-none"></div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-widget ml-0 mb-0 wow fadeInUp" data-wow-delay="1.6s">
                                <h4 class="title">{{ __('messages.footer.latest_blog') }}</h4>
                                <div class="recent-post-item">
									<figure class="image">
										<a href="#"><img src="/assets/images/footer/gallery-1.webp" alt=""></a>
									</figure>
									<div class="recent-post-info">
                                        <h4 class="title"><a href="#">{{ __('messages.footer.blog_post_1') }}</a></h4>
										<span class="post-date">10 AUG, 2025</span>
									</div>
								</div>
								<div class="recent-post-item mb--20">
									<figure class="image">
										<a href="#"><img src="/assets/images/footer/gallery-2.webp" alt=""></a>
									</figure>
									<div class="recent-post-info">
                                        <h4 class="title"><a href="#">{{ __('messages.footer.blog_post_2') }}</a></h4>
										<span class="post-date">10 AUG, 2025</span>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row gy-15">
                        <div class="col-md-6">
                            <div class="copyright wow fadeInUp" data-wow-delay=".3s">
                                <p class="mb-0">Copyright &copy; {{ date('Y') }} {{ config('business.name') }}. {{ __('messages.footer.rights') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="footer-policy wow fadeInUp" data-wow-delay=".6s">
                                <a href="#">{{ __('messages.footer.privacy_policy') }}</a>
                                <a href="#">{{ __('messages.footer.refund_policy') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
