@extends('front.layouts.app')

@section('title', $product->translate->name)

@section('content')

    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                @include('front.components.breadcrumbs', ['breadcrumbs' => $product->breadcrumbs, 'model' => 'product'])
            </div>
        </div>
    </div>

    <div class="block">
        <div class="container">
            <div class="product product--layout--standard" data-layout="standard">
                <div class="product__content">

                    <!-- .product__gallery -->
                    <div class="product__gallery">
                        <div class="product-gallery">
                            <div class="product-gallery__featured">
                                <div class="owl-carousel" id="product-image">
                                    @foreach($product->images as $image)
                                    <a href="#" onclick="return false;">
                                        <img src="{{ $image->url }}" alt="">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-gallery__carousel">
                                <div class="owl-carousel" id="product-carousel">
                                    @foreach($product->images as $image)
                                    <a href="#" class="product-gallery__carousel-item">
                                        <img class="product-gallery__carousel-image" src="{{ $image->url }}" alt="">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .product__gallery / end -->

                    <!-- .product__info -->
                    <div class="product__info">

                        <div class="product__wishlist-compare">
                            <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="Wishlist">
                                <svg width="16px" height="16px">
                                    <use xlink:href="{{ asset('images/front/sprite.svg#wishlist-16') }}"></use>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="Compare">
                                <svg width="16px" height="16px">
                                    <use xlink:href="{{ asset('images/front/sprite.svg#compare-16') }}"></use>
                                </svg>
                            </button>
                        </div>

                        <h1 class="product__name">{{ $product->translate->name }} {{ $product->sku }}</h1>

                        <div class="product__description">
                            {!! $product->translate->description !!}
                        </div>

                        <ul class="product__meta">
                            <li class="product__meta-availability">
                                @if($product->balance >= config('products.product_min_balance_available'))
                                    <span class="text-success">{{ __('available') }}</span>
                                @else
                                    <span class="text-warning">{{ __('ends') }}</span>
                                @endif
                            </li>
                            <li>SKU: {{ $product->sku }}</li>
                        </ul>
                    </div>
                    <!-- .product__info / end -->

                    <!-- .product__sidebar -->
                    <div class="product__sidebar">
                        <div class="product__availability">
                            @if($product->balance >= config('products.product_min_balance_available'))
                                <span class="text-success">{{ __('available') }}</span>
                            @else
                                <span class="text-warning">{{ __('ends') }}</span>
                            @endif
                        </div>
                        <div class="product__prices">{{ $product->retail }} <span style="font-size: 0.8rem;">грн</span></div>

                        <!-- .product__options -->
                        <form class="product__options">

                            <div class="form-group product__option">
                                <label class="product__option-label" for="product-quantity">{{ __('quantity') }}</label>
                                <div class="product__actions">

                                    <div class="product__actions-item">
                                        <div class="input-number product__quantity">
                                            <input id="product-quantity" class="input-number__input form-control form-control-lg" type="number" min="1" value="1">
                                            <div class="input-number__add"></div>
                                            <div class="input-number__sub"></div>
                                        </div>
                                    </div>

                                    <div class="product__actions-item product__actions-item--addtocart">
                                        <button type="button" class="btn btn-primary btn-lg btn-add-to-cart"
                                                data-link="{{ route('front.cart.add') }}"
                                                data-product="{{ $product->id }}">{{ __('Add To Cart') }}</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <!-- .product__options / end -->
                    </div>
                    <!-- .product__end -->

                </div>
            </div>

            <div class="product-tabs">

                <div class="product-tabs__list">
                    <a href="#tab-specification" class="product-tabs__item">{{ __('Specification') }}</a>
                </div>

                <div class="product-tabs__content">

                    <div class="product-tabs__pane" id="tab-specification">
                        <div class="spec">
                            <div class="spec__section">
                                @foreach($product->attributesFull as $attribute)
                                    <div class="spec__row">
                                        <div class="spec__name">{{ $attribute['attribute']['translate']['name'] }}</div>
                                            <div class="spec__value">{{ $attribute['translate']['value'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        (function(){

            const eventCartUpdate  = new Event('event.cart.update');

            $('.btn-add-to-cart').on('click', function(){
                let link = $(this).data('link');
                let product_id = $(this).data('product');
                let quantity = 1;
                if($('#product-quantity').length > 0) {
                    quantity = $('#product-quantity').val();
                }
                let fd = new FormData();
                fd.append('product_id', product_id);
                fd.append('quantity', quantity);

                $.ajax({
                    url: link,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: fd,
                    beforeSend: function(){

                    },
                    success: function (data) {
                        // TODO alert "Product add to cart"
                        alertify.message('Добавлено!');
                    },
                    error: function (xhr, status, err) {
                        console.log(xhr.responseText);
                    }
                });

            });

        })(jQuery)
    </script>
@endpush

