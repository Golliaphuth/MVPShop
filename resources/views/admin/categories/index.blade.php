@extends('admin.layouts.app')

@section('title', 'Категории')

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

                    <div id="categoryWidget" class="category-widget">

                        @include('admin.categories.templates.category', ['categories' => $categories])

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="editCategoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="editCategoryForm" action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="editCategoryModalLabel">Категория</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn bg-gradient-primary btn-save" data-action="">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        (function ($) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });

            function initEvents() {

                $('.arrow').on('click', function () {
                    if ($(this).hasClass('show')) {
                        $(this).parent('.category-header').siblings('.category-children').slideUp();
                        $(this).removeClass('show');
                        $(this).children('i').remove();
                        $(this).append($('<i/>', {
                            class: "fas fa-angle-down"
                        }));
                    } else {
                        $(this).parent('.category-header').siblings('.category-children').slideDown();
                        $(this).addClass('show');
                        $(this).children('i').remove();
                        $(this).append($('<i/>', {
                            class: "fas fa-angle-up"
                        }));
                    }
                });

                $('.category-create').on('click', function(){
                    let actionEdit = $(this).data('actionEdit');
                    let actionSave = $(this).data('actionSave');
                    let category_id = $(this).data('id');

                    $.ajax({
                        url: actionEdit,
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: {
                            category_id: category_id
                        },
                        beforeSend: function () {

                        },
                        success: function (data) {
                            $('#editCategoryModal').find('.modal-body').first().html(data);
                            let form = $('#editCategoryForm').first();
                            form.attr('action', actionSave);
                            form.on('submit', function (e) {
                                e.preventDefault();
                                saveCategory()
                            });
                            $('#editCategoryModal').modal('show');
                        },
                        error: function (xhr, status, err) {
                            toastr.error('Ошибка!')
                            console.log(xhr.responseText);
                        }
                    });
                });

                $('.category-edit').on('click', function () {
                    let actionEdit = $(this).data('actionEdit');
                    let actionSave = $(this).data('actionSave');
                    let category_id = $(this).data('id');

                    $.ajax({
                        url: actionEdit,
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: {
                            category_id: category_id
                        },
                        beforeSend: function () {

                        },
                        success: function (data) {
                            $('#editCategoryModal').find('.modal-body').first().html(data);
                            let form = $('#editCategoryForm').first();
                            form.attr('action', actionSave);
                            form.on('submit', function (e) {
                                e.preventDefault();
                                saveCategory()
                            });
                            $('#editCategoryModal').modal('show');
                        },
                        error: function (xhr, status, err) {
                            toastr.error('Ошибка!')
                            console.log(xhr.responseText);
                        }
                    });
                });

                $('.category-sort').on('click', function(){
                    let action = $(this).data('action');

                    $.ajax({
                        url: action,
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: {},
                        beforeSend: function () {

                        },
                        success: function (data) {
                            reload();
                        },
                        error: function (xhr, status, err) {
                            toastr.error('Ошибка!')
                            console.log(xhr.responseText);
                        }
                    });
                });
            }

            function reload() {
                $.ajax({
                    url: '{{ route('admin.categories.reload') }}',
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: {},
                    beforeSend: function () {

                    },
                    success: function (data) {
                        $('#categoryWidget').html(data);
                        initEvents();
                    },
                    error: function (xhr, status, err) {
                        toastr.error('Ошибка!')
                        console.log(xhr.responseText);
                    }
                });
            }

            function saveCategory() {
                let actionSave = $('#editCategoryForm').attr('action');
                let method = $('#editCategoryForm').attr('method');
                let fd = new FormData(document.getElementById('editCategoryForm'));

                $.ajax({
                    url: actionSave,
                    method: method,
                    processData: false,
                    contentType: false,
                    data: fd,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        reload();
                        $('#editCategoryModal').find('.modal-body').first().empty();
                        $('#editCategoryModal').modal('hide');
                    },
                    error: function (xhr, status, err) {
                        toastr.error('Ошибка!')
                        console.log(xhr.responseText);
                    }
                });
            }

            initEvents();
        })(jQuery)
    </script>
@endpush
