<div class="block-products__featured">
    <div class="block-products__featured-item">
        <div class="product-card">

            <button class="product-card__quickview" type="button">
                <svg width="16px" height="16px">
                    <use xlink:href="images/front/sprite.svg#quickview-16"></use>
                </svg><span class="fake-svg-icon"></span>
            </button>

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
                <a href="{{ route('front.product', $product->slug) }}">
                    <img src="{{ Storage::disk('products')->url($product->images->first()->filename) }}" alt="{{ $product->translate->name }}">
                </a>
            </div>

            <div class="product-card__info">

                <div class="product-card__name">
                    <a href="{{ route('front.product', $product->slug) }}">{{ $product->translate->name }}</a>
                </div>

                <div class="product-card__rating">
                    <div class="rating">
                        <div class="rating__body">
                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                <g class="rating__fill">
                                    <use xlink:href="images/front/sprite.svg#star-normal"></use>
                                </g>
                                <g class="rating__stroke">
                                    <use xlink:href="images/front/sprite.svg#star-normal-stroke"></use>
                                </g>
                            </svg>
                            <div class="rating__star rating__star--only-edge rating__star--active">
                                <div class="rating__fill">
                                    <div class="fake-svg-icon"></div>
                                </div>
                                <div class="rating__stroke">
                                    <div class="fake-svg-icon"></div>
                                </div>
                            </div>
                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                <g class="rating__fill">
                                    <use xlink:href="images/front/sprite.svg#star-normal"></use>
                                </g>
                                <g class="rating__stroke">
                                    <use xlink:href="images/front/sprite.svg#star-normal-stroke"></use>
                                </g>
                            </svg>
                            <div class="rating__star rating__star--only-edge rating__star--active">
                                <div class="rating__fill">
                                    <div class="fake-svg-icon"></div>
                                </div>
                                <div class="rating__stroke">
                                    <div class="fake-svg-icon"></div>
                                </div>
                            </div>
                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                <g class="rating__fill">
                                    <use xlink:href="images/front/sprite.svg#star-normal"></use>
                                </g>
                                <g class="rating__stroke">
                                    <use xlink:href="images/front/sprite.svg#star-normal-stroke"></use>
                                </g>
                            </svg>
                            <div class="rating__star rating__star--only-edge rating__star--active">
                                <div class="rating__fill">
                                    <div class="fake-svg-icon"></div>
                                </div>
                                <div class="rating__stroke">
                                    <div class="fake-svg-icon"></div>
                                </div>
                            </div>
                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                <g class="rating__fill">
                                    <use xlink:href="images/front/sprite.svg#star-normal"></use>
                                </g>
                                <g class="rating__stroke">
                                    <use xlink:href="images/front/sprite.svg#star-normal-stroke"></use>
                                </g>
                            </svg>
                            <div class="rating__star rating__star--only-edge rating__star--active">
                                <div class="rating__fill">
                                    <div class="fake-svg-icon"></div>
                                </div>
                                <div class="rating__stroke">
                                    <div class="fake-svg-icon"></div>
                                </div>
                            </div>
                            <svg class="rating__star" width="13px" height="12px">
                                <g class="rating__fill">
                                    <use xlink:href="images/front/sprite.svg#star-normal"></use>
                                </g>
                                <g class="rating__stroke">
                                    <use xlink:href="images/front/sprite.svg#star-normal-stroke"></use>
                                </g>
                            </svg>
                            <div class="rating__star rating__star--only-edge">
                                <div class="rating__fill">
                                    <div class="fake-svg-icon"></div>
                                </div>
                                <div class="rating__stroke">
                                    <div class="fake-svg-icon"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card__rating-legend">9 Reviews</div>
                </div>

                <ul class="product-card__features-list">
                    @foreach($product->attributes as $attr)
                        <li>{{ $attr->attribute->translate->name }}: {{ $attr->translate->value }}</li>
                    @endforeach
                </ul>

            </div>

            <div class="product-card__actions">
                <div class="product-card__availability">Availability:
                    <span class="text-success">In Stock</span>
                </div>
                <div class="product-card__prices">$749.00</div>
                <div class="product-card__buttons">
                    <button class="btn btn-primary product-card__addtocart" type="button">{{ __('Add To Cart') }}</button>
                    <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button">{{ __('Add To Cart') }}</button>
                    <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist" type="button">
                        <svg width="16px" height="16px">
                            <use xlink:href="images/front/sprite.svg#wishlist-16"></use>
                        </svg> <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
                    </button>
                    <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare" type="button">
                        <svg width="16px" height="16px">
                            <use xlink:href="images/front/sprite.svg#compare-16"></use>
                        </svg> <span class="fake-svg-icon fake-svg-icon--compare-16"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
