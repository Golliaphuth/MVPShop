@extends('front.layouts.app')

@section('title', __('Cart'))

@section('content')

    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.home') }}">{{ __('Home') }}</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-right-6x9') }}"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Cart') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>{{ __('Cart') }}</h1>
            </div>
        </div>
    </div>

    <div class="block">
        <livewire:front.cart-component />
    </div>

@endsection

@push('scripts')
    <script>
        (function(){

        })(jQuery)
    </script>
@endpush

