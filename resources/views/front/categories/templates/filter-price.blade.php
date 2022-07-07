@if($products_price_min !== $products_price_max)
<div class="widget-filters__item">
    <div class="filter filter--opened" data-collapse-item>
        <button type="button" class="filter__title" data-collapse-trigger>{{ __('Price') }}
            <svg class="filter__arrow" width="12px" height="7px">
                <use xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-down-12x7') }}"></use>
            </svg>
        </button>
        <div class="filter__body" data-collapse-content>
            <div class="filter__container">

                <div class="filter-price"
                     data-min="{{ $products_price_min }}"
                     data-max="{{ $products_price_max }}"
                     data-from="@if(isset($priceMin)){{ $priceMin }}@else{{ $products_price_min }}@endif"
                     data-to="@if(isset($priceMax)){{ $priceMax }}@else{{ $products_price_max }}@endif">

                    <div class="filter-price__slider"></div>
                    <div class="filter-price__title">{{ __('Price') }}:
                        <span class="filter-price__min-value">@if(isset($priceMin)){{ $priceMin }}@endif</span>
                        <span style="font-size: 0.8rem;"> грн</span>
                        –
                        <span class="filter-price__max-value">@if(isset($priceMax)){{ $priceMax }}@endif</span>
                        <span style="font-size: 0.8rem;"> грн</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endif
