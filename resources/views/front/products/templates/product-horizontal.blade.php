<div class="product-card" style="height: 250px;">

    <div class="product-card__badges-list">
        @if($product->new)
            <div class="product-card__badges-list">
                <div class="product-card__badge product-card__badge--new">New</div>
            </div>
        @endif

        @if($product->hot)
            <div class="product-card__badges-list">
                <div class="product-card__badge product-card__badge--hot">Hot</div>
            </div>
        @endif

        @if($product->sale)
            <div class="product-card__badges-list">
                <div class="product-card__badge product-card__badge--sale">Sale</div>
            </div>
        @endif
    </div>

    <div class="product-card__image">
        <a href="{{ route('front.product', ['slug' => $product->slug]) }}">
            <img src="{{ $product->mainImage->url }}" alt="">
        </a>
    </div>

    <div class="product-card__info">
        <div class="product-card__name">
            <a href="{{ route('front.product', ['slug' => $product->slug]) }}">{{ $product->translate->name }}</a>
        </div>
    </div>

    <div class="product-card__actions">
        <div class="product-card__availability">
            @if($product->balance >= config('products.product_min_balance_available'))
                <span class="text-success">{{ __('available') }}</span>
            @else
                <span class="text-warning">{{ __('ends') }}</span>
            @endif
        </div>

        <div class="product-card__prices">{{ $product->retail }} <span style="font-size: 0.8rem;">грн</span></div>

        <div class="product-card__buttons">
            <button type="button" class="btn btn-primary product-card__addtocart btn-add-to-cart" style="display: inline-block!important"
                    data-link="{{ route('front.cart.add') }}"
                    data-product="{{ $product->id }}">{{ __('Add To Cart') }}</button>
        </div>
    </div>
</div>
