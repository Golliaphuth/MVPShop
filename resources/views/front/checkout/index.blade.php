@extends('front.layouts.app')

@section('title', __('Checkout'))

@section('content')

    <div class="checkout block">
        <div class="container">

            <div class="row">

                @guest
                <div class="col-12 mt-3">
                    <div class="alert alert-lg alert-primary">{{ __('Returning customer?') }}
                        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#authFormModal">{{ __('Click here to login') }}</button>
                    </div>
                </div>
                @endguest

                <div class="col-12 col-lg-6 col-xl-7 mt-3">

                    <div>
                        <div class="card mb-lg-0">
                            <div class="card-body">
                                <h3 class="card-title">{{ __('Order details') }}</h3>
                                <form id="checkoutForm">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="checkout-email">{{ __('Email') }}</label>
                                            <input name="email" type="email" class="form-control" id="checkout-email" placeholder="{{ __('Email') }}"
                                                   @if($customer) value="{{ $customer->email }}" @endif>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="checkout-phone">{{ __('Phone') }}</label>
                                            <input name="phone" type="text" class="form-control" id="checkout-phone" placeholder="{{ __('Phone') }}"
                                                   @if($customer) value="{{ $customer->phone }}" @endif>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="checkout-last-name">{{ __('Last name') }}</label>
                                            <input name="last_name" type="text" class="form-control" id="checkout-last-name" placeholder="{{ __('First name') }}"
                                                   @if($customer) value="{{ $customer->last_name }}" @endif>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="checkout-first-name">{{ __('First name') }}</label>
                                            <input name="first_name" type="text" class="form-control" id="checkout-first-name" placeholder="{{ __('First name') }}"
                                                   @if($customer) value="{{ $customer->first_name }}" @endif>
                                        </div>
                                    </div>

                                    <div id="delivery-module">

                                        <div class="form-group">
                                            <label for="deliveryMethod">{{ __('Delivery method') }}</label>
                                            <select name="method" id="deliveryMethod" class="form-control">
                                                <option selected disabled>{{ __('Set delivery') }}</option>
                                                <option value="self">{{ __('Self-delivery') }}"</option>
                                                <option value="address">{{ __('Address-delivery') }}</option>
                                            </select>
                                        </div>

                                        <div class="hidden-box">

                                            <div class="step-first">
                                                <div class="form-group">
                                                    <label for="checkout-city">{{ __('City') }}</label>
                                                    <select name="city" id="checkout-city" class="form-control"></select>
                                                </div>
                                            </div>

                                            <div class="step-second-self">
                                                <div class="form-group" data-delivery="self" style="display: none;">
                                                    <label for="checkout-warehouse">{{ __('Warehouse') }}</label>
                                                    <select name="warehouse" id="checkout-warehouse" class="form-control"></select>
                                                </div>
                                            </div>

                                            <div class="step-second-address">
                                                <div class="form-group" data-delivery="address" style="display: none;">
                                                    <label for="checkout-street">{{ __('Street') }}</label>
                                                    <select name="street" id="checkout-street" class="form-control"></select>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group" data-delivery="address" style="display: none;">
                                                            <label for="checkout-building">{{ __('BuildingNumber') }}</label>
                                                            <input name="building" type="text" class="form-control" id="checkout-building">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group" data-delivery="address" style="display: none;">
                                                            <label for="checkout-flat">{{ __('Flat') }}</label>
                                                            <input name="flat" type="text" class="form-control" id="checkout-flat">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-lg-6 col-xl-5 mt-3">
                    <div class="card mb-0">

                        <div class="card-body">
                            <h3 class="card-title">{{ __('Your Order') }}</h3>

                            <table class="checkout__totals">
                                <thead class="checkout__totals-header">
                                <tr>
                                    <th>{{ __('ProductName') }}</th>
                                    <th>{{ __('Price') }}</th>
                                </tr>
                                </thead>
                                <tbody class="checkout__totals-products">
                                    @foreach($cart->items as $item)
                                    <tr>
                                        <td>{{ $item->product->translate->name }} × {{ $item->quantity }}</td>
                                        <td>{{ $item->product->retail }} <span style="font-size: 0.8rem;">грн</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="checkout__totals-footer">
                                <tr>
                                    <th>{{ __('Total') }}</th>
                                    <td style="width: 200px;">{{ $total }} <span style="font-size: 0.8rem;">грн</span></td>
                                </tr>
                                </tfoot>
                            </table>

                            <button id="btnCheckout" type="submit" class="btn btn-primary btn-xl btn-block">{{ __('Place Order') }}</button>

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

            $.fn.checkout = function(){

                const module = this;

                let data = {
                    method: null,
                    city: null,
                    city_ref: null,
                    warehouse: null,
                    warehouse_ref: null,
                    street: null,
                    building: null,
                    flat: null,
                };

                let inputs = {
                    method: $('#deliveryMethod'),
                    city: $('#checkout-city').select2({
                        theme: 'bootstrap4',
                        minimumInputLength: 3,
                        language: "{{ app()->getLocale() }}",
                        ajax: {
                            delay: 250,
                            url: '{{ route('front.np.cities') }}',
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    query: params.term
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            }
                        }
                    }),
                    warehouse: $('#checkout-warehouse').select2({
                        theme: 'bootstrap4',
                        language: "{{ app()->getLocale() }}",
                        ajax: {
                            delay: 250,
                            url: '{{ route('front.np.warehouses') }}',
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    query: params.term,
                                    city_ref: data.city_ref
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            }
                        }
                    }),
                    street: $('#checkout-street').select2({
                        theme: 'bootstrap4',
                        minimumInputLength: 3,
                        language: "{{ app()->getLocale() }}",
                        ajax: {
                            url: '{{ route('front.np.streets') }}',
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    query: params.term,
                                    city_ref: data.city_ref
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            }
                        }
                    }),
                    building: $('#checkout-building'),
                    flat: $('#checkout-flat'),
                };

                let buttons = {
                    submit: $('#btnCheckout')
                };

                inputs.method.on('change', function(){
                    switch($(this).val()) {
                        case "self":
                            data.method = "self";
                            $('*[data-delivery="self"]').css('display', 'block');
                            $('*[data-delivery="address"]').css('display', 'none');
                            $('.step-second-self').slideDown();
                            break;
                        case "address":
                            data.method = "address";
                            $('*[data-delivery="self"]').css('display', 'none');
                            $('*[data-delivery="address"]').css('display', 'block');
                            $('.step-second-address').slideDown();
                            break;
                    }
                    $(module).find('.hidden-box').slideDown();
                });

                inputs.city.on('change', function(){
                    let selectedData = $(this).select2('data');
                    data.city = selectedData[0].text;
                    data.city_ref = selectedData[0].id;
                });

                inputs.warehouse.on('change', function(){
                    let selectedData = $(this).select2('data');
                    data.warehouse = selectedData[0].text;
                    data.warehouse_ref = selectedData[0].id;
                });

                inputs.street.on('change', function(){
                    let selectedData = $(this).select2('data');
                    data.street = selectedData[0].text;
                    data.street_ref = selectedData[0].id;
                });

                inputs.building.on('keyup', function(){
                    data.building = $(this).val();
                });

                inputs.flat.on('keyup', function(){
                    data.flat = $(this).val();
                });

                buttons.submit.on('click', function(){
                    console.log(data);
                    // TODO Ajax send checkout
                });

            };

            $('#delivery-module').checkout();

        })(jQuery)
    </script>
@endpush

