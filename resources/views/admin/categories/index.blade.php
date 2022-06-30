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

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-default shadow-secondary"
                                    data-bs-toggle="modal" data-bs-target="#createNewCategoryModal">
                                Создать категорию
                            </button>
                        </div>
                    </div>

                    <ul id="category-ui" class="category-ul mt-3">
                        @foreach($categories as $category)
                            <li class="category-li">
                                <div class="category-name @if($category->children()->count()) with-children @endif">
                                    @if($category->children()->count())
                                    <span class="category-toggle">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </span>
                                    @endif
                                    {{ $category->translate->name }}
                                </div>
                                <div class="category-children">
                                    @if($category->children()->count())
                                        @include('admin.categories.templates.category', ['categories' => $category->children])
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="createNewCategoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createNewCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="createNewCategoryModalLabel">Создать категорию</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">

                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Название</label>
                            <input name="name" type="text" class="form-control">
                        </div>

                        <div class="input-group input-group-static my-3">
                            <label class="form-label">Название</label>
                            <select name="parent_id" class="form-control js-select">
                                <option>Без родительской категории</option>
                                @foreach($categories_all as $category)
                                    <option value="{{ $category->id }}">{{ $category->translate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn bg-gradient-primary">Создать</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        (function ($) {

            $.fn.categoryUI = function(){
                let handler = $(this);
                $(handler).find('.category-toggle').on('click', function(){
                    if($(this).closest('.category-li').hasClass('show')) {
                        $(this).closest('.category-li').find('.category-children').first().slideUp();
                        $(this).closest('.category-li').removeClass('show');
                        $(this).html('<i class="fa-solid fa-chevron-right"></i>');
                    } else {
                        $(this).closest('.category-li').find('.category-children').first().slideDown();
                        $(this).closest('.category-li').addClass('show');
                        $(this).html('<i class="fa-solid fa-chevron-down"></i>');
                    }
                });
            }

            $('#category-ui').categoryUI();

            $('.js-select').select2();

        })(jQuery)
    </script>
@endpush
