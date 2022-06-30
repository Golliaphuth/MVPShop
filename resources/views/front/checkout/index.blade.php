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
                    <div class="card mb-lg-0">
                        <div class="card-body">
                            <h3 class="card-title">{{ __('Order details') }}</h3>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="checkout-email">{{ __('Email') }}</label>
                                    <input type="email" class="form-control" id="checkout-email" placeholder="{{ __('Email') }}"
                                           @if($customer) value="{{ $customer->email }}" @endif>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="checkout-phone">{{ __('Phone') }}</label>
                                    <input type="text" class="form-control" id="checkout-phone" placeholder="{{ __('Phone') }}"
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

                            <div class="form-group">
                                <label for="checkout-city">{{ __('City') }}</label>
                                <input type="text" class="form-control" id="checkout-city"
                                       @if($customer) value="{{ $customer->location }}" @endif>
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
                                    @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item['product']->translate->name }} × {{ $item['quantity'] }}</td>
                                        <td>{{ $item['product']->retail }} <span style="font-size: 0.8rem;">грн</span></td>
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

                            <button type="submit" class="btn btn-primary btn-xl btn-block">{{ __('Place Order') }}</button>

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

        })(jQuery)
    </script>
@endpush

