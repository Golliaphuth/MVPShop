@extends('admin.layouts.app')

@section('title', 'Заказы');

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"> </a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Заказы</li>
        </ol>
        <h5 class="font-weight-bolder mb-0 mt-3">Заказы</h5>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col">

            <h1>Orders</h1>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function(){

        })(jQuery)
    </script>
@endpush
