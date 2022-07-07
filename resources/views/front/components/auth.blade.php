<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#authFormModal{{ $type }}">{{ __('Login') }}</button>

@push('modals')
<!-- Modal -->
<div class="modal fade" id="authFormModal{{ $type }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="authFormModalLabel{{ $type }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authFormModalLabel{{ $type }}">{{ __('Authorization') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-wrapper active">
                    <form id="authLoginForm{{ $type }}" action="{{ route('front.login') }}" method="POST">

                        <div class="from-group mt-2">
                            <label for="email_login{{ $type }}">{{ __('Email') }}</label>
                            <input name="email" id="email_login{{ $type }}" type="email" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="password_login{{ $type }}">{{ __('Password') }}</label>
                            <input name="password" id="password_login{{ $type }}" type="password" class="form-control">
                        </div>

                        <div class="from-group text-center mt-3">
                            <button class="btn btn-primary" type="submit">{{ __('Login') }}</button>
                        </div>

                        <div class="form-group text-center mt-3">
                            <button class="btn btn-default btn-toggle-auth" data-target="#authRegisterForm{{ $type }}" type="button">{{ __('I don`t have an account') }}</button>
                        </div>

                    </form>
                </div>

                <div class="form-wrapper">
                    <form id="authRegisterForm{{ $type }}" action="{{ route('front.register') }}" method="POST">

                        <div class="from-group mt-2">
                            <label for="last_name_register{{ $type }}">{{ __('Last name') }}</label>
                            <input name="last_name" id="last_name_register{{ $type }}" type="text" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="first_name_register{{ $type }}">{{ __('First name') }}</label>
                            <input name="first_name" id="first_name_register{{ $type }}" type="text" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="patronymic_register{{ $type }}">{{ __('Patronymic') }}</label>
                            <input name="patronymic" id="patronymic_register{{ $type }}" type="text" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="email_register{{ $type }}">{{ __('Email') }}</label>
                            <input name="email" id="email_register{{ $type }}" type="email" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="phone_register{{ $type }}">{{ __('Phone') }}</label>
                            <input name="phone" id="phone_register{{ $type }}" type="text" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="location_register{{ $type }}">{{ __('City') }}</label>
                            <input name="location" id="location_register{{ $type }}" type="text" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="password_register{{ $type }}">{{ __('Password') }}</label>
                            <input name="password" id="password_register{{ $type }}" type="password" class="form-control">
                        </div>

                        <div class="from-group mt-2">
                            <label for="password_confirmation_register{{ $type }}">{{ __('Password confirmation') }}</label>
                            <input name="password_confirmation" id="password_confirmation_register{{ $type }}" type="password" class="form-control">
                        </div>

                        <div class="from-group text-center mt-3">
                            <button class="btn btn-primary" type="submit">{{ __('Register') }}</button>
                        </div>

                        <div class="form-group text-center mt-3">
                            <button class="btn btn-default btn-toggle-auth" data-target="#authLoginForm{{ $type }}" type="button">{{ __('I already have an account') }}</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
    <script>
        (function($){

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });

            $('.btn-toggle-auth').on('click', function(){
                let target = $(this).data('target');
                $('.form-wrapper').removeClass('active');
                $(target).parent().addClass('active');
            });

            $('#authLoginForm{{ $type }}').on('submit', function(e){
                e.preventDefault();
                let action = $(this).attr('action');
                let method = $(this).attr('method');
                let fd = new FormData(this);
                $.ajax({
                    url: action,
                    method: method,
                    processData: false,
                    contentType: false,
                    data: fd,
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

            $('#authRegisterForm{{ $type }}').on('submit', function(e){
                e.preventDefault();
                let action = $(this).attr('action');
                let method = $(this).attr('method');
                let fd = new FormData(this);
                $.ajax({
                    url: action,
                    method: method,
                    processData: false,
                    contentType: false,
                    data: fd,
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
