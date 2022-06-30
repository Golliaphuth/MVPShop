<div class="mobile-links__item-sub-links" data-collapse-content>
    <ul class="mobile-links mobile-links--level--2">
        @foreach($categories as $cat)
        <li class="mobile-links__item" data-collapse-item>
            @if($cat->children()->count())
                <div class="mobile-links__item-title">
                    <a href="#" class="mobile-links__item-link">{{ $cat->translate->name }}</a>
                    <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                        <svg class="mobile-links__item-arrow" width="12px" height="7px">
                            <use xlink:href="images/front/sprite.svg#arrow-rounded-down-12x7"></use>
                        </svg>
                    </button>
                </div>
                <div class="mobile-links__item-sub-links" data-collapse-content>
                    @include('front.categories.templates.category-item-mobile', ['categories' => $cat->children])
                </div>
            @else
                <div class="mobile-links__item-title">
                    <a href="#" class="mobile-links__item-link">{{ $cat->translate->name }}</a>
                </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>
