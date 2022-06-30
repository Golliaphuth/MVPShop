@extends('front.layouts.app')

@section('title', __('common.home'))

@section('content')

    <!-- Slideshow -->
    <div class="block-slideshow block-slideshow--layout--with-departments block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9 offset-lg-3">
                    <div class="block-slideshow__body">
                        <div class="owl-carousel">

                            <a class="block-slideshow__slide" href="#">
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url({{ asset('images/front/slides/slide-1.jpg') }})"></div>
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url({{ asset('images/front/slides/slide-1-mobile.jpg') }})"></div>
                                <div class="block-slideshow__slide-content">
                                    <div class="block-slideshow__slide-title">Big choice of
                                        <br>Plumbing products</div>
                                    <div class="block-slideshow__slide-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        <br>Etiam pharetra laoreet dui quis molestie.</div>
                                    <div class="block-slideshow__slide-button"><span class="btn btn-primary btn-lg">Shop Now</span></div>
                                </div>
                            </a>

                            <a class="block-slideshow__slide" href="#">
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url({{ asset('images/front/slides/slide-2.jpg') }})"></div>
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url({{ asset('images/front/slides/slide-2-mobile.jpg') }})"></div>
                                <div class="block-slideshow__slide-content">
                                    <div class="block-slideshow__slide-title">Screwdrivers
                                        <br>Professional Tools</div>
                                    <div class="block-slideshow__slide-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        <br>Etiam pharetra laoreet dui quis molestie.</div>
                                    <div class="block-slideshow__slide-button"><span class="btn btn-primary btn-lg">Shop Now</span></div>
                                </div>
                            </a>

                            <a class="block-slideshow__slide" href="#">
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url({{ asset('images/front/slides/slide-3.jpg') }})"></div>
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url({{ asset('images/front/slides/slide-3-mobile.jpg') }})"></div>
                                <div class="block-slideshow__slide-content">
                                    <div class="block-slideshow__slide-title">One more
                                        <br>Unique header</div>
                                    <div class="block-slideshow__slide-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        <br>Etiam pharetra laoreet dui quis molestie.</div>
                                    <div class="block-slideshow__slide-button"><span class="btn btn-primary btn-lg">Shop Now</span></div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advantages -->
    <x-advantages/>

    <!-- Bestsellers -->
    <x-bestsellers/>

    <!-- New arrivals -->
    <x-new-arrivals/>

    <!-- Banner -->
    <div class="block block-banner">
        <div class="container">
            <a href="#" class="block-banner__body">
                <div class="block-banner__image block-banner__image--desktop" style="background-image: url('{{ asset('images/front/banners/banner-1.jpg') }}')"></div>
                <div class="block-banner__image block-banner__image--mobile" style="background-image: url('{{ asset('images/front/banners/banner-1-mobile.jpg') }}')"></div>
                <div class="block-banner__title">Hundreds
                    <br class="block-banner__mobile-br">Hand Tools</div>
                <div class="block-banner__text">Hammers, Chisels, Universal Pliers, Nippers, Jigsaws, Saws</div>
                <div class="block-banner__button"><span class="btn btn-sm btn-primary">Shop Now</span></div>
            </a>
        </div>
    </div>

    <!-- Popular categories -->
    <x-popular-categories/>

    <!-- Brands -->
{{--    <x-brands/>--}}

@endsection

@push('scripts')
<script>
    (function(){

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

