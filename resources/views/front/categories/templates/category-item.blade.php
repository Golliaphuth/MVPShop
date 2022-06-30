<ul class="menu menu--layout--classic">
    @foreach($categories as $cat)
        @if($cat->children->count())
            <li>
                <a href="{{ route('front.category', ['slug' => $cat->slug]) }}">{{ $cat->translate->name }}
                    <svg class="menu__arrow" width="6px" height="9px">
                        <use xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-right-6x9') }}"></use>
                    </svg>
                </a>
                <div class="menu__submenu">
                    @include('front.categories.templates.category-item', ['categories' => $cat->children])
                </div>
            </li>
        @else
            <li><a href="{{ route('front.category', ['slug' => $cat->slug]) }}">{{ $cat->translate->name }}</a></li>
        @endif
    @endforeach
</ul>
