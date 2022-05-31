@extends('admin.layouts.app')

@section('title', 'Категории')

@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endpush

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#"></a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Категории</li>
        </ol>
        <h5 class="font-weight-bolder mb-0 mt-3">Категории</h5>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card my-4">

                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Категории</h6>
                    </div>
                </div>

                <div class="card-body px-2 pb-2">
                    <ul class="sortable-main">
                        @foreach($categories as $category)
                            <li>{{ $category->translate->name }}</li>
                            @if($category->childs()->count())
                                @include('admin.components.category', ['categories' => $category->childs])
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function ($) {
            $(".sortable-main").sortable({
                axis: "y"
            });
        })(jQuery)
    </script>
@endpush
