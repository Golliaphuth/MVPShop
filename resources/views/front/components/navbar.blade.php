<div class="navi">
    <div>
        @guest()
            @include('front.components.auth')
        @else
            <form action="{{ route('front.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('common.logout') }}</button>
            </form>
        @endguest
    </div>
</div>
