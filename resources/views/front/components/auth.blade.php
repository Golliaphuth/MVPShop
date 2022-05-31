<form id="authLoginForm" action="{{ route('front.login') }}" method="POST">
    <div>
        <label for="email">{{ __('common.email') }}</label>
        <input name="email" id="email" type="email">
    </div>
    <div>
        <label for="password">{{ __('common.password') }}</label>
        <input name="password" id="password" type="password">
    </div>
    <div>
        <button type="submit">{{ __('common.login') }}</button>
    </div>
</form>

@push('scripts')
    <script>
        (function($){

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });

            $('#authLoginForm').on('submit', function(e){
                e.preventDefault();

                let action = $(this).attr('action');
                let method = $(this).attr('method');

                let fd = new FormData(this);
                let data = {};
                for (let pair of fd.entries()) data[pair[0]] = pair[1];

                $.ajax({
                    url: action,
                    method: method,
                    data: data,
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (xhr, status, err) {
                        // TODO Print error on form
                        let error = JSON.parse(xhr.responseText);
                        alert(error.message);
                    }
                });

            });

        })(jQuery)
    </script>
@endpush
