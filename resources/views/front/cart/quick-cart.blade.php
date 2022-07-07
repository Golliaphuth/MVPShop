<div id="quick-cart-component">

    <div class="indicator">

        <a href="{{ route('front.cart') }}" class="indicator__button">
            <span class="indicator__area">
              <svg width="20px" height="20px">
                <use xlink:href="{{ asset('images/front/sprite.svg#cart-20') }}"></use>
              </svg>
              <span class="indicator__value">{{ $counter }}</span>
            </span>
        </a>

    </div>

    @push('scripts')
        <script>
            (function($){
                channelCart.subscribed(() => {

                }).listen('.cart', (event) => {
                    $('.indicator__value').text(event.count);
                    Livewire.emit('cartUpdated');
                });
            })(jQuery)
        </script>
    @endpush

</div>

