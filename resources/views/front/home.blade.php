@extends('layouts.app')

@section('content')
    <div class="container pt-0 pb-0">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="col text-center">
                <h1>
                    <i class="fa fa-coffee" aria-hidden="true"></i>
                    {{ env('APP_NAME', 'ALFA') }}
                </h1>
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

