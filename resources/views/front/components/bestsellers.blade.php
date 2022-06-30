<div>
    @if($products->count() > 0)

    <div class="block block-products block-products--layout--large-first">
        <div class="container">

            <div class="block-header">
                <h3 class="block-header__title">{{ __('Bestsellers') }}</h3>
                <div class="block-header__divider"></div>
            </div>

            <div class="block-products__body">

                <div class="block-products__featured">
                    <div class="block-products__featured-item">
                        <div class="product-card">

                            @if($productTop->new)
                            <div class="product-card__badges-list">
                                <div class="product-card__badge product-card__badge--new">New</div>
                            </div>
                            @endif

                            @if($productTop->hot)
                                <div class="product-card__badges-list">
                                    <div class="product-card__badge product-card__badge--new">Hot</div>
                                </div>
                            @endif

                            @if($productTop->sale)
                                <div class="product-card__badges-list">
                                    <div class="product-card__badge product-card__badge--new">Sale</div>
                                </div>
                            @endif

                            <div class="product-card__image">
                                <a href="{{ route('front.product', $productTop->slug) }}">
                                    <img src="{{ $productTop->mainImage->url }}" alt="{{ $productTop->translate->name }}">
                                </a>
                            </div>

                            <div class="product-card__info">

                                <div class="product-card__name">
                                    <a href="{{ route('front.product', $productTop->slug) }}">{{ $productTop->translate->name }}</a>
                                </div>

                                <ul class="product-card__features-list">
                                    @foreach($productTop->attributesShort as $attribute)
                                        <li>{{ $attribute['attribute']['translate']['name'] }}: {{ $attribute['translate']['value'] }}</li>
                                    @endforeach
                                </ul>

                            </div>

                            <div class="product-card__actions">
                                <div class="product-card__availability">
                                    @if($productTop->balance >= config('products.product_min_balance_available'))
                                        <span class="text-success">{{ __('available') }}</span>
                                    @else
                                        <span class="text-warning">{{ __('ends') }}</span>
                                    @endif
                                </div>
                                <div class="product-card__prices">{{ $productTop->retail }} <span style="font-size: 0.8rem;">грн</span></div>
                                <div class="product-card__buttons">
                                    <button type="button" class="btn btn-primary product-card__addtocart btn-add-to-cart"
                                            data-link="{{ route('front.cart.add') }}"
                                            data-product="{{ $productTop->id }}">{{ __('Add To Cart') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="block-products__list">
                    @foreach($products as $product)
                        <div class="block-products__list-item">
                            @include('front.products.templates.product-vertical', ['product' => $product])
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    @endif
</div>
