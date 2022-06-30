<footer class="site__footer">
    <div class="site-footer">
        <div class="container">

            <div class="site-footer__widgets">
                <div class="row">

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="site-footer__widget footer-contacts">
                            <h5 class="footer-contacts__title">{{ __('Contact us') }}</h5>
                            <ul class="footer-contacts__contacts">
                                <li><i class="footer-contacts__icon far fa-envelope"></i> stroyka@example.com</li>
                                <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> (800) 060-0730, (800) 060-0730</li>
                                <li><i class="footer-contacts__icon far fa-clock"></i> Mon-Sat 10:00pm - 7:00pm</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-lg-2">
                        <div class="site-footer__widget footer-links">
                            <h5 class="footer-links__title">{{ __('Information') }}</h5>
                            <ul class="footer-links__list">
                                <li class="footer-links__item"><a href="{{ route('front.home') }}" class="footer-links__link">{{ __('Home') }}</a></li>
                                <li class="footer-links__item"><a href="{{ route('front.blog') }}" class="footer-links__link">{{ __('Blog') }}</a></li>
                                <li class="footer-links__item"><a href="{{ route('front.about') }}" class="footer-links__link">{{ __('About us') }}</a></li>
                                <li class="footer-links__item"><a href="{{ route('front.contacts') }}" class="footer-links__link">{{ __('Contacts') }}</a></li>
                            </ul>
                        </div>
                    </div>

                    @auth('web')
                    <div class="col-12 col-md-3 col-lg-2">
                        <div class="site-footer__widget footer-links">
                            <h5 class="footer-links__title">{{ __('My account') }}</h5>
                            <ul class="footer-links__list">
                                <li class="footer-links__item"><a href="#" class="footer-links__link">{{ __('My cabinet') }}</a></li>
{{--                                <li class="footer-links__item"><a href="#" class="footer-links__link">Order History</a></li>--}}
{{--                                <li class="footer-links__item"><a href="#" class="footer-links__link">Wish List</a></li>--}}
{{--                                <li class="footer-links__item"><a href="#" class="footer-links__link">Newsletter</a></li>--}}
{{--                                <li class="footer-links__item"><a href="#" class="footer-links__link">Specials</a></li>--}}
{{--                                <li class="footer-links__item"><a href="#" class="footer-links__link">Gift Certificates</a></li>--}}
{{--                                <li class="footer-links__item"><a href="#" class="footer-links__link">Affiliate</a></li>--}}
                            </ul>
                        </div>
                    </div>
                    @endauth

                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="site-footer__widget footer-newsletter">
                            <h5 class="footer-newsletter__title">{{ __('News')  }}</h5>
{{--                            <div class="footer-newsletter__text">Praesent pellentesque volutpat ex, vitae auctor lorem pulvinar mollis felis at lacinia.</div>--}}
                            <form action="#" class="footer-newsletter__form">
                                <label class="sr-only" for="footer-newsletter-address">{{ __('Email') }}</label>
                                <input type="text" class="footer-newsletter__form-input form-control" id="footer-newsletter-address" placeholder="{{ __('Email') }}...">
                                <button class="footer-newsletter__form-button btn btn-primary">{{ __('Subscribe') }}</button>
                            </form>
{{--                            <div class="footer-newsletter__text footer-newsletter__text--social">{{ __('Follow us on social media') }}</div>--}}
{{--                            <ul class="footer-newsletter__social-links">--}}
{{--                                <li class="footer-newsletter__social-link footer-newsletter__social-link--facebook"><a href="https://themeforest.net/user/kos9" target="_blank"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                                <li class="footer-newsletter__social-link footer-newsletter__social-link--twitter"><a href="https://themeforest.net/user/kos9" target="_blank"><i class="fab fa-twitter"></i></a></li>--}}
{{--                                <li class="footer-newsletter__social-link footer-newsletter__social-link--youtube"><a href="https://themeforest.net/user/kos9" target="_blank"><i class="fab fa-youtube"></i></a></li>--}}
{{--                                <li class="footer-newsletter__social-link footer-newsletter__social-link--instagram"><a href="https://themeforest.net/user/kos9" target="_blank"><i class="fab fa-instagram"></i></a></li>--}}
{{--                                <li class="footer-newsletter__social-link footer-newsletter__social-link--rss"><a href="https://themeforest.net/user/kos9" target="_blank"><i class="fas fa-rss"></i></a></li>--}}
{{--                            </ul>--}}
                        </div>
                    </div>

                </div>
            </div>

{{--            <div class="site-footer__bottom">--}}
{{--                <div class="site-footer__payments">--}}
{{--                    <img src="{{ asset('images/front/payments.png') }}" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
</footer>
