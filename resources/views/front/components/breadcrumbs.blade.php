<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        <li class="breadcrumb-item">
            <a href="{{ route('front.home') }}">{{ __('Home') }}</a>
            <svg class="breadcrumb-arrow" width="6px" height="9px">
                <use xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-right-6x9') }}"></use>
            </svg>
        </li>

        @foreach($breadcrumbs as $bds)
        <li class="breadcrumb-item">
            <a href="{{ route('front.category', ['slug' => $bds->slug]) }}">{{ $bds->translate->name }}</a>
            <svg class="breadcrumb-arrow" width="6px" height="9px">
                <use xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-right-6x9') }}"></use>
            </svg>
        </li>
        @endforeach

        @switch($model)
            @case('category')
                <li class="breadcrumb-item active" aria-current="page">{{ $category->translate->name }}</li>
                @break
            @case('product')
                <li class="breadcrumb-item active" aria-current="page">{{ $product->translate->name }} {{ $product->sku }}</li>
                @break
        @endswitch

    </ol>
</nav>
