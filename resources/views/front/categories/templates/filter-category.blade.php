@if($category->children->count() > 0)
    <div class="widget-filters__item">
        <div class="filter filter--opened" data-collapse-item>
            <button type="button" class="filter__title"
                    data-collapse-trigger>{{ __('Сategories') }}
                <svg class="filter__arrow" width="12px" height="7px">
                    <use
                        xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-down-12x7') }}"></use>
                </svg>
            </button>
            <div class="filter__body" data-collapse-content>
                <div class="filter__container">
                    <div class="filter-categories">
                        <ul class="filter-categories__list">
                            @foreach($category->children as $cat)
                                <li class="filter-categories__item filter-categories__item--child">
                                    <a href="{{ route('front.category', ['slug' => $cat->slug]) }}">{{ $cat->translate->name }}</a>
                                    <div class="filter-categories__counter"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
