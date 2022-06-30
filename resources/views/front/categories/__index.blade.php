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

    @if($category->children->count() > 0)
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">

                @foreach($category->children as $cat)
                    <div class="category-child" style="padding: 5px;">
                        <a href="{{ route('front.category', ['slug' => $cat->slug]) }}">{{ $cat->translate->name }}</a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="products-view">

                        <div class="products-view__options">
                            <div class="view-options">
                                <div class="view-options__layout">
                                    <div class="layout-switcher">
                                        <div class="layout-switcher__list">
                                            <button data-layout="grid-4-full" data-with-features="false" title="Grid" type="button" class="layout-switcher__button layout-switcher__button--active">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="{{ asset('images/front/sprite.svg#layout-grid-16x16') }}"></use>
                                                </svg>
                                            </button>
                                            <button data-layout="grid-4-full" data-with-features="true" title="Grid With Features" type="button" class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="{{ asset('images/front/sprite.svg#layout-grid-with-details-16x16') }}"></use>
                                                </svg>
                                            </button>
                                            <button data-layout="list" data-with-features="false" title="List" type="button" class="layout-switcher__button">
                                                <svg width="16px" height="16px">
                                                    <use xlink:href="{{ asset('images/front/sprite.svg#layout-list-16x16') }}"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-options__legend">{{ __('Showing products', ['count' => 12, 'from' => $products_total]) }}</div>
                                <div class="view-options__divider"></div>
                                <div class="view-options__control">
                                    <label for="">{{ __('Sort By') }}</label>
                                    <div>
                                        <select class="form-control form-control-sm" name="sort" id="sortBy">
                                            <option value="popularity">{{ __('Popularity') }}</option>
                                            <option value="newest">{{ __('Newest') }}</option>
                                            <option value="price_low">{{ __('Ascending') }}</option>
                                            <option value="price_high">{{ __('Descending') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="products-view__list products-list" data-layout="grid-4-full" data-with-features="false">
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
        (function($){

            const quickview = {
                cancelPreviousModal: function() {},
                clickHandler: function() {
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
                        success: function(data) {
                            quickview.cancelPreviousModal = function() {};
                            button.removeClass('product-card__quickview--preload');
                            modal.find('.modal-content').html(data);
                            modal.find('.quickview__close').on('click', function() {
                                modal.modal('hide');
                            });
                            modal.modal('show');
                        }
                    });
                    quickview.cancelPreviousModal = function() {
                        button.removeClass('product-card__quickview--preload');
                        if (xhr) xhr.abort();
                    };
                }
            };

            function loadMore(handler) {
                let paginator = $('.custom-pagination');
                let link = $(handler).attr('href');
                $.ajax({
                    url: link,
                    type: 'get',
                    datatype: 'html',
                    beforeSend: function() { }
                })
                .done(function(data) {
                    if(data.body.length === 0) {
                        console.log('empty');
                        return 0;
                    } else {
                        $('.products-list__body').append(data.body);
                        paginator.html(data.pagination);
                        $('.load-more').on('click', function(e){
                            e.preventDefault();
                            loadMore(this);
                        });
                        // $('.product-card__quickview').on('click', function() {
                        //     quickview.clickHandler.apply(this, arguments);
                        // });
                        $('.products-list__body').find('.btn-add-to-cart').on('click', function(){
                            addToCart(this);
                        });
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Something went wrong.');
                });
            }

            $('.load-more').on('click', function(e){
                e.preventDefault();
                loadMore(this);
            });

            // ORDER BY
            $('[name=sort]').on('change', function(e){
                let sortVal = $(this).val();
                let url = new URL(window.location.href);
                let sort = url.searchParams.get("sort");
                console.log(sort);
            });

            const eventCartUpdate  = new Event('event.cart.update');

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
            }

            $('.btn-add-to-cart').on('click', function(){
                addToCart(this);
            });


        })(jQuery)
    </script>
@endpush
