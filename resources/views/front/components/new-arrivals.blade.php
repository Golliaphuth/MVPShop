<div>

    <div class="block block-products-carousel" data-layout="horizontal">
        <div class="container">
            <div class="block-header">
                <h3 class="block-header__title">{{ __('New Arrivals') }}</h3>
                <div class="block-header__divider"></div>
                <div class="block-header__arrows-list">
                    <button class="block-header__arrow block-header__arrow--left" type="button">
                        <svg width="7px" height="11px">
                            <use xlink:href="images/front/sprite.svg#arrow-rounded-left-7x11"></use>
                        </svg>
                    </button>
                    <button class="block-header__arrow block-header__arrow--right" type="button">
                        <svg width="7px" height="11px">
                            <use xlink:href="images/front/sprite.svg#arrow-rounded-right-7x11"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="block-products-carousel__slider">
                <div class="block-products-carousel__preloader"></div>
                <div class="owl-carousel">
                    @while($products->count() > 0)
                    <div class="block-products-carousel__column">
                        @for($i =0 ; $i < 2; $i++)
                        @php $product = $products->shift(); @endphp
                        <div class="block-products-carousel__cell">
                            @include('front.products.templates.product-horizontal', ['product' => $product])
                        </div>
                        @endfor
                    </div>
                    @endwhile
                </div>
            </div>
        </div>
    </div>

</div>
