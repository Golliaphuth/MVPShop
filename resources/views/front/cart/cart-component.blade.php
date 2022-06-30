<div class="container">

    <table class="cart__table cart-table">

        <thead class="cart-table__head">
            <tr class="cart-table__row">
                <th class="cart-table__column cart-table__column--image">{{ __('Image') }}</th>
                <th class="cart-table__column cart-table__column--product">{{ __('ProductName') }}</th>
                <th class="cart-table__column cart-table__column--price">{{ __('Price') }}</th>
                <th class="cart-table__column cart-table__column--quantity">{{ __('Quantity') }}</th>
                <th class="cart-table__column cart-table__column--total">{{ __('Total') }}</th>
                <th class="cart-table__column cart-table__column--remove"></th>
            </tr>
        </thead>

        <tbody class="cart-table__body">
            @foreach($items as $item)
                <tr class="cart-table__row">
                    <td class="cart-table__column cart-table__column--image">
                        <a href="#">
                            <img src="{{ Storage::disk('products')->url($item->product->mainImage->filename) }}" alt="">
                        </a>
                    </td>
                    <td class="cart-table__column cart-table__column--product">
                        <a href="#" class="cart-table__product-name">{{ $item->product->translate->name }}</a>
                    </td>
                    <td class="cart-table__column cart-table__column--price" data-title="Price">
                        {{ $item->product->retail }} <span style="font-size: 0.8rem;">грн</span>
                    </td>
                    <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                        <div class="input-number">
                            <input class="form-control input-number__input" type="number" min="1" value="{{ $item->quantity }}">
                            <div wire:click="quantityAdd({{ $item->product->id }})" class="input-number__add"></div>
                            <div wire:click="quantitySub({{ $item->product->id }})" class="input-number__sub"></div>
                        </div>
                    </td>
                    <td class="cart-table__column cart-table__column--total" data-title="Total">
                        {{ $item->product->retail * $item['quantity'] }} <span style="font-size: 0.8rem;">грн</span>
                    </td>
                    <td class="cart-table__column cart-table__column--remove">
                        <button wire:click="remove({{ $item->product->id }})" type="button" class="btn btn-light btn-sm btn-svg-icon">
                            <svg width="12px" height="12px">
                                <use xlink:href="{{ asset('images/front/sprite.svg#cross-12') }}"></use>
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="row justify-content-end pt-5">
        <div class="col-12 col-md-7 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-body">
                    <table class="cart__totals">
                        <tfoot class="cart__totals-footer">
                        <tr>
                            <th>{{ __('Total') }}</th>
                            <td>{{ $total }} <span style="font-size: 0.8rem;">грн</span></td>
                        </tr>
                        </tfoot>
                    </table>
                    <a class="btn btn-primary btn-xl btn-block cart__checkout-button" href="{{ route('front.checkout') }}">{{ __('Proceed to checkout') }}</a>
                </div>
            </div>
        </div>
    </div>

</div>
