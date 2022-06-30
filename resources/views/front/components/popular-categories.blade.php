<div>
    <div class="block block--highlighted block-categories block-categories--layout--classic">
        <div class="container">

            <div class="block-header">
                <h3 class="block-header__title">{{ __('Popular Categories') }}</h3>
                <div class="block-header__divider"></div>
            </div>

            <div class="block-categories__list">

                @foreach($categories as $category)
                <div class="block-categories__item category-card category-card--layout--classic">
                    <div class="category-card__body">
                        <div class="category-card__content">
                            <div class="category-card__name">
                                <a href="{{ route('front.category', ['slug' => $category->slug]) }}">{{ $category->translate->name }}</a>
                            </div>
                            <ul class="category-card__links">
                                @foreach($category->children as $child)
                                    <li>
                                        <a href="{{ route('front.category', ['slug' => $child->slug]) }}">{{ $child->translate->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="category-card__all">
                                <a href="{{ route('front.category', ['slug' => $category->slug]) }}">{{ __('Show All') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
