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
                                <a href="{{ route('localized.privacy-policy', ['locale' => app()->getLocale()]) }}">{{ __('messages.footer.privacy_policy') }}</a>
                                <a href="{{ route('localized.refund-policy', ['locale' => app()->getLocale()]) }}">{{ __('messages.footer.refund_policy') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        @if (app()->getLocale() === 'jp')
            <style>
                body.jp-locale .sec-title,
                body.jp-locale .title,
                body.jp-locale h1,
                body.jp-locale h2,
                body.jp-locale h3,
                body.jp-locale h4,
                body.jp-locale h5,
                body.jp-locale h6 {
                    letter-spacing: 0;
                    line-height: 1.35;
                    word-break: keep-all;
                }

                body.jp-locale .theme-btn .effect-1 {
                    letter-spacing: 0;
                }

                body.jp-locale .contact-form .theme-btn {
                    min-width: 180px;
                }

                @media (max-width: 991.98px) {
                    body.jp-locale .sec-title {
                        font-size: clamp(1.6rem, 5vw, 2.2rem);
                    }
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.body.classList.add('jp-locale');

                    const exactMap = {
                        'Explore the world': '世界を探る',
                        "World's leading Business agency": '世界をリードするビジネスエージェンシー',
                        'Get latest update for our trusted applications': '信頼できるサービスの最新情報をお届けします',
                        'Search...': '検索...',
                        'Get in Touch': 'お問い合わせ',
                        'Get In Touch': 'お問い合わせ',
                        'Get in Toch': 'お問い合わせ',
                        'Let’s Contact with us': 'お気軽にお問い合わせください',
                        'Let’s お問い合わせ with us': 'お気軽にお問い合わせください',
                        'Get in Touch with Inotek Contact Information': 'Inotekのお問い合わせ情報',
                        'Inotekのお問い合わせ情報 お問い合わせ インフォメーション': 'Inotekのお問い合わせ情報',
                        'Our 住所': '住所',
                        'Our Address': '住所',
                        '送信 E-Mail': 'メール送信',
                        'Send E-Mail': 'メール送信',
                        'Call us Anytime': 'いつでもお電話ください',
                        'Consulting:': '相談窓口:',
                        'Corporate:': '法人窓口:',
                        'Write Message': 'メッセージを入力',
                        'Write メッセージ': 'メッセージを入力',
                        'Your Name': 'お名前',
                        'Your お名前': 'お名前',
                        'Email Address': 'メールアドレス',
                        'メールアドレス 住所': 'メールアドレス',
                        'Phone No.': '電話番号',
                        '電話番号 No.': '電話番号',
                        'What are you need?': 'ご希望のサービスを選択',
                        'Submit Now': '今すぐ送信',
                        'I agree to all terms and conditions.': 'すべての利用規約に同意します。',
                        'Facebook': 'フェイスブック',
                        'Twitter/X': 'X',
                        'LinkedIn': 'リンクトイン',
                        'Instagram': 'インスタグラム',
                        'Subscribe Our Newsletter': 'ニュースレター登録',
                        'For Latest Updates': '最新情報を受け取る',
                        'Air Freight': '航空貨物',
                        'Ocean Freight': '海上貨物',
                        'Rail transport': '鉄道輸送',
                        'Cargo ship': '貨物船',
                        'Bulk cargo': 'バルク貨物',
                        'Enter Your E-Mail *': 'メールアドレスを入力してください *',
                        'Enter Your Email Address': 'メールアドレスを入力してください',
                        'Enter Your メールアドレス': 'メールアドレスを入力してください',
                        'Enter Your メール アドレス': 'メールアドレスを入力してください',
                        'Enter Your メールア ドレス': 'メールアドレスを入力してください'
                    };

                    const partialMap = [
                        ['Get in Touch with Inotek', 'Inotekのお問い合わせ情報'],
                        ['Inotekのお問い合わせ情報 お問い合わせ インフォメーション', 'Inotekのお問い合わせ情報'],
                        ['Contact Information', 'お問い合わせ情報'],
                        ['Our 住所', '住所'],
                        ['Our Address', '住所'],
                        ['送信 E-Mail', 'メール送信'],
                        ['Send E-Mail', 'メール送信'],
                        ['We’re always ready to helps your business. Let’s talk with us', 'いつでもご相談を承っております。お気軽にお問い合わせください。'],
                        ['Visit another branch Office', '他の拠点オフィスを見る'],
                        ['Our Branches', '拠点一覧'],
                        ['HEAD QUARTERS', '本社'],
                        ['BRANCH OFFICE', '支社'],
                        ['San Fransisco', 'サンフランシスコ'],
                        ['Salt Lake City', 'ソルトレイクシティ'],
                        ['Los Angeles', 'ロサンゼルス'],
                        ['Get to Know Us', '私たちについて'],
                        ['Empowering Businesses', '企業成長を支援'],
                        ['Innovative IT Solutions', '革新的なITソリューション'],
                        ['Digital Transformation', 'デジタル変革'],
                        ['Cloud Solution', 'クラウドソリューション'],
                        ['Cyber Security', 'サイバーセキュリティ'],
                        ['Discover More', '詳しく見る'],
                        ['Browse all サービス', 'サービス一覧を見る'],
                        ['Branding Solutions', 'ブランディングソリューション'],
                        ['Custom Website', 'カスタムWebサイト'],
                        ['Innovation Design', 'イノベーションデザイン'],
                        ['Supports', 'サポート'],
                        ['Support', 'サポート'],
                        ['Why Choose Us', '選ばれる理由'],
                        ['Strategy', '戦略'],
                        ['Testimonial', 'お客様の声'],
                        ['Company Mission', '企業ミッション'],
                        ['Future Vision', '将来ビジョン'],
                        ['Company History', '会社沿革'],
                        ['Have any Question?', 'ご質問はありますか？'],
                        ['Free :', 'フリー :'],
                        ['Wordpress', 'ワードプレス'],
                        ['Shopify', 'ショッピファイ'],
                        ['Webflow', 'ウェブフロー'],
                        ['Web Applicationr', 'Webアプリケーション'],
                        ['UI/UX DESIGN', 'UI/UXデザイン'],
                        ['DEVELOPMENT', '開発'],
                        ['3D DESIGN', '3Dデザイン'],
                        ['Idea Planning', '企画立案'],
                        ['Deployments', '導入'],
                        ['Freequently Asked Question', 'よくある質問'],
                        ['Browse all Blog', 'ブログ一覧を見る'],
                        ['Latest Blog', '最新ブログ'],
                        ['Add a Comment', 'コメントを追加'],
                        ['Read More', '続きを読む'],
                        ['Continue Reading', '続きを読む']
                    ];

                    const replaceText = function (text) {
                        const trimmed = text.trim();
                        if (!trimmed) {
                            return text;
                        }

                        let replaced = exactMap[trimmed] ?? trimmed;
                        partialMap.forEach(function (pair) {
                            replaced = replaced.split(pair[0]).join(pair[1]);
                        });

                        if (replaced === trimmed) {
                            return text;
                        }

                        const lead = text.match(/^\s*/)?.[0] ?? '';
                        const trail = text.match(/\s*$/)?.[0] ?? '';
                        return lead + replaced + trail;
                    };

                    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null);
                    const nodes = [];
                    let current = walker.nextNode();
                    while (current) {
                        nodes.push(current);
                        current = walker.nextNode();
                    }

                    nodes.forEach(function (node) {
                        const parentTag = node.parentElement ? node.parentElement.tagName : '';
                        if (['SCRIPT', 'STYLE', 'NOSCRIPT'].includes(parentTag)) return;
                        node.nodeValue = replaceText(node.nodeValue);
                    });

                    document.querySelectorAll('input[placeholder], textarea[placeholder]').forEach(function (el) {
                        el.placeholder = replaceText(el.placeholder).trim();
                    });

                    document.querySelectorAll('option').forEach(function (el) {
                        el.textContent = replaceText(el.textContent);
                    });
                });
            </script>
        @endif
