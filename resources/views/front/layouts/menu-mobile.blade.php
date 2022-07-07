<div class="mobilemenu">
    <div class="mobilemenu__backdrop"></div>
    <div class="mobilemenu__body">

        <div class="mobilemenu__header">
            <div class="mobilemenu__title">{{ __('Menu') }}</div>
            @auth('web')
            <div class="mobilemenu__title">
                <a href="#" style="color: #3d464d;">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
            @else
                @include('front.components.auth', ['type' => 'Mobile'])
            @endauth

            <button type="button" class="mobilemenu__close">
                <svg width="20px" height="20px">
                    <use xlink:href="{{ asset('images/front/sprite.svg#cross-20') }}"></use>
                </svg>
            </button>
        </div>

        <div class="mobilemenu__content">
            <ul class="mobile-links mobile-links--level--0" data-collapse="" data-collapse-opened-class="mobile-links__item--open">

                <!-- Langs -->
                <li class="mobile-links__item" data-collapse-item="">
                    <div class="row">
                        @foreach(config('app.locales') as $lng)
                            <div class="col text-center" style="padding: 10px;">
                                <a href="{{ route('front.locale.set', ['locale' => $lng]) }}"
                                   class="mobile-links__item-link"
                                   style="text-transform: uppercase;"
                                >{{ $lng }}</a>
                            </div>
                        @endforeach
                    </div>
                </li>

                <!-- Categories -->
                <li class="mobile-links__item" data-collapse-item="">

                    <div class="mobile-links__item-title">
                        <a href="#" class="mobile-links__item-link">{{ __('Сategories') }}</a>
                        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger="">
                            <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                <use xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-down-12x7') }}"></use>
                            </svg>
                        </button>
                    </div>

                    <div class="mobile-links__item-sub-links" data-collapse-content="">
                        <ul class="mobile-links mobile-links--level--1">

                            @foreach($categories as $cat)
                                <li class="mobile-links__item" data-collapse-item="">

                                    @if($cat->children()->count())
                                        <div class="mobile-links__item-title">
                                            <a href="{{ route('front.category', ['slug' => $cat->slug]) }}" class="mobile-links__item-link">{{ $cat->translate->name }}</a>
                                            <button class="mobile-links__item-toggle" type="button" data-collapse-trigger="">
                                                <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                                    <use xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-down-12x7') }}"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        @include('front.categories.templates.category-item-mobile', ['categories' => $cat->children, 'level' => 2])
                                    @else
                                        <div class="mobile-links__item-title">
                                            <a href="{{ route('front.category', ['slug' => $cat->slug]) }}" class="mobile-links__item-link">{{ $cat->translate->name }}</a>
                                        </div>
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </li>


                <!-- Home -->
                <li class="mobile-links__item" data-collapse-item="">
                    <div class="mobile-links__item-title">
                        <a href="{{ route('front.home') }}" class="mobile-links__item-link">{{ __('Home') }}</a>
                    </div>
                </li>

                <!-- Blog -->
                <li class="mobile-links__item" data-collapse-item="">
                    <div class="mobile-links__item-title">
                        <a href="{{ route('front.blog') }}" class="mobile-links__item-link">{{ __('Blog') }}</a>
                    </div>
                </li>

                <!-- About us -->
                <li class="mobile-links__item" data-collapse-item="">
                    <div class="mobile-links__item-title">
                        <a href="{{ route('front.about') }}" class="mobile-links__item-link">{{ __('About us') }}</a>
                    </div>
                </li>

                <!-- Contacts -->
                <li class="mobile-links__item" data-collapse-item="">
                    <div class="mobile-links__item-title">
                        <a href="{{ route('front.contacts') }}" class="mobile-links__item-link">{{ __('Contacts') }}</a>
                    </div>
                </li>

                @auth('web')
                <!-- Logout -->
                <li class="mobile-links__item" data-collapse-item="">
                    <div class="mobile-links__item-title">
                        <a href="{{ route('front.logout') }}" class="mobile-links__item-link">{{ __('Logout') }}</a>
                    </div>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</div>
