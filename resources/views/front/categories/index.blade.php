@extends('front.layouts.app')

@section('title', $category->translate->name)

@section('content')

    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                @include('front.components.breadcrumbs', ['breadcrumbs' => $category->breadcrumbs, 'model' => 'category'])
            </div>
            <div class="page-header__title">
                <h1>{{ $category->translate->name }}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="shop-layout shop-layout--sidebar--start">

            <div class="shop-layout__sidebar">
                <div class="block block-sidebar">
                    <div class="block-sidebar__item">
                        <div class="widget-filters widget" data-collapse data-collapse-opened-class="filter--opened">
                            <h4 class="widget__title">{{ __('Filters') }}</h4>
                            <div class="widget-filters__list">

                                <!-- Category filter -->
                                @if($category->children->count() > 0)
                                    <div class="widget-filters__item">
                                        <div class="filter filter--opened" data-collapse-item>
                                            <button type="button" class="filter__title"
                                                    data-collapse-trigger>{{ __('Сategories') }}
                                                <svg class="filter__arrow" width="12px" height="7px">
                                                    <use
                                                        xlink:href="{{ asset('images/front/sprite.svg#arrow-rounded-down-12x7') }}"></use>
                                                </svg>
                                            </button>
                                            <div class="filter__body" data-collapse-content>
                                                <div class="filter__container">
                                                    <div class="filter-categories">
                                                        <ul class="filter-categories__list">
                                                            @foreach($category->children as $cat)
                                                                <li class="filter-categories__item filter-categories__item--child">
                                                                    <a href="{{ route('front.category', ['slug' => $cat->slug]) }}">{{ $cat->translate->name }}</a>
                                                                    <div class="filter-categories__counter"></div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Filter price -->
                                @include('front.categories.templates.filter-price')

                                <!-- Filter brands -->
                                {{-- @include('front.categories.templates.filter-brands')--}}

                                <!-- Filter color -->
                                {{-- @include('front.categories.templates.filter-color')--}}

                            </div>
                            <div class="widget-filters__actions d-flex">
                                <button id="btnFilter" class="btn btn-primary btn-sm">{{ __('Do filter') }}</button>
                                <button id="btnFilterClear" class="btn btn-secondary btn-sm ml-2">{{ __('Reset') }}</button>
                            </div>
                        </div>
                    </div>

                    @if(count($newArrivals) > 0)
                        <div class="block-sidebar__item d-none d-lg-block">
                            <div class="widget-products widget">
                                <h4 class="widget__title">{{ __('New Arrivals') }}</h4>
                                <div class="widget-products__list">

                                    @foreach($newArrivals as $newProduct)
                                        <div class="widget-products__item">
                                            <div class="widget-products__image">
                                                <a href="#">
                                                    <img
                                                        src="{{ Storage::disk('products')->url($newProduct->mainImage->filename) }}"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div class="widget-products__info">
                                                <div class="widget-products__name">
                                                    <a href="{{ route('front.product', ['slug' => $newProduct->slug]) }}">{{ $newProduct->translate->name }}</a>
                                                </div>
                                                <div class="widget-products__prices">{{ $newProduct->retail }}<span
                                                        style="font-size: 0.8rem;">грн</span></div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <div class="shop-layout__content">
                <div class="block">
                    <div class="products-view">

                        <div class="products-view__options">
                            <div class="view-options">

                                <div class="view-options__layout">
                                    <div class="layout-switcher">
                                        <div class="layout-switcher__list">
                                            <button data-layout="grid-3-sidebar" data-with-features="false" title="Grid"
                                                    type="button" class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="{{ asset('images/front/sprite.svg#layout-grid-16x16') }}"></use>
                                                </svg>
                                            </button>
                                            <button data-layout="grid-3-sidebar" data-with-features="true"
                                                    title="Grid With Features" type="button"
                                                    class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="{{ asset('images/front/sprite.svg#layout-grid-with-details-16x16') }}"></use>
                                                </svg>
                                            </button>
                                            <button data-layout="list" data-with-features="false" title="List"
                                                    type="button"
                                                    class="layout-switcher__button layout-switcher__button--active">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="{{ asset('images/front/sprite.svg#layout-list-16x16') }}"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="view-options__divider"></div>

                                <div class="view-options__control">
                                    <label for="">{{ __('Sort By') }}</label>
                                    <div>
                                        <select id="sortBy" name="sort" class="form-control form-control-sm">
                                            <option value="newest"
                                                    @if($currentSort == 'newest') selected @endif>{{ __('Newest') }}</option>
                                            <option value="popularity"
                                                    @if($currentSort == 'popularity') selected @endif>{{ __('Popularity') }}</option>
                                            <option value="price_low"
                                                    @if($currentSort == 'price_low') selected @endif>{{ __('Ascending') }}</option>
                                            <option value="price_high"
                                                    @if($currentSort == 'price_high') selected @endif>{{ __('Descending') }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="products-view__list products-list" data-layout="list" data-with-features="false">
                            <div class="products-list__body">
                                @foreach($products as $product)
                                    <div class="products-list__item">
                                        @include('front.products.templates.product-vertical', ['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="custom-pagination">
                            {{ $products->links('front.components.cursor-pagination') }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        (function ($) {

            const quickview = {
                cancelPreviousModal: function () {
                },
                clickHandler: function () {
                    const modal = $('#quickview-modal');
                    const button = $(this);
                    const doubleClick = button.is('.product-card__quickview--preload');
                    const link = $(this).data('target');
                    quickview.cancelPreviousModal();
                    if (doubleClick) return;
                    button.addClass('product-card__quickview--preload');
                    let xhr = null;
                    xhr = $.ajax({
                        url: link,
                        success: function (data) {
                            quickview.cancelPreviousModal = function () {
                            };
                            button.removeClass('product-card__quickview--preload');
                            modal.find('.modal-content').html(data);
                            modal.find('.quickview__close').on('click', function () {
                                modal.modal('hide');
                            });
                            modal.modal('show');
                        }
                    });
                    quickview.cancelPreviousModal = function () {
                        button.removeClass('product-card__quickview--preload');
                        if (xhr) xhr.abort();
                    };
                }
            };

            function loadMore(handler) {
                let paginator = $('.custom-pagination');
                let link = generateLink($(handler).attr('href'));
                $.ajax({
                    url: link,
                    type: 'get',
                    datatype: 'html',
                    beforeSend: function () {

                    }
                })
                .done(function (data) {
                    if (data.body.length === 0) {
                        console.log('empty');
                        return 0;
                    } else {
                        $('.products-list__body').append(data.body);
                        paginator.html(data.pagination);
                        $('.load-more').on('click', function (e) {
                            e.preventDefault();
                            loadMore(this);
                        });
                        $('.products-list__body').find('.btn-add-to-cart').on('click', function () {
                            addToCart(this);
                        });
                    }
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('Something went wrong.');
                });
            }

            $('.load-more').on('click', function (e) {
                e.preventDefault();
                loadMore(this);
            });

            // ORDER BY
            $('[name=sort]').on('change', function (e) {
                window.location.href = generateLink(window.location.href);
            });

            $('#btnFilter').on('click', function(){
                window.location.href = generateLink(window.location.href);
            });

            $('#btnFilterClear').on('click', function(){
                window.location.href = window.location.protocol + '//' + window.location.host + window.location.pathname;
            });

            function generateLink(currentUrl) {
                let url = new URL(currentUrl);
                // TODO Set params
                url.searchParams.set('sort', $('[name=sort]').val());
                url.searchParams.set('price_min', $('.filter-price__min-value').text());
                url.searchParams.set('price_max', $('.filter-price__max-value').text());
                return url.toString();
            }

            const eventCartUpdate = new Event('event.cart.update');

            function addToCart(handler) {
                let link = $(handler).data('link');
                let product_id = $(handler).data('product');
                let quantity = 1;
                let fd = new FormData();
                fd.append('product_id', product_id);
                fd.append('quantity', quantity);
                $.ajax({
                    url: link,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: fd,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        // TODO alert "Product add to cart"
                        alertify.message('Добавлено!');
                    },
                    error: function (xhr, status, err) {
                        console.log(xhr.responseText);
                    }
                });
            }

            $('.btn-add-to-cart').on('click', function () {
                addToCart(this);
            });


        })(jQuery)
    </script>
@endpush
