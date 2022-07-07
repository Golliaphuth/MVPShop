@extends('admin.layouts.app')

@section('title', 'Товары')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"> </a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Товары</li>
        </ol>
        <h5 class="font-weight-bolder mb-0 mt-3">Товары</h5>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col">

            <div class="card my-4">

                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Товары</h6>
                    </div>
                </div>

                <div class="card-body px-4 pb-2">

                    <div class="table-responsive p-0">
                        <table id="dataTableProducts" class="table align-items-center mb-0" data-order='[[ 1, "asc" ]]'></table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>

        let testFunction = function (row) {
            console.log(row);
        };

        (function ($) {

            $('.js-select2').select2({
                placeholder: "Выбрать категорию",
            });

            window.languageDOM =
                "<'row'<'col.datatable-search-form'f>>" +
                // "<'row'<'col'l>>" +
                "<'row'<'col't>>" +
                "<'row'<'col.datatable-paginator-center'p>>" +
                "<'row'<'col.datatable-info-center'i>>";

            $.extend(true, $.fn.dataTable.defaults, {
                searching: true,
                searchDelay: 500,
                ordering: true,
                paging: true,
                lengthChange: true,
                lengthMenu: [10, 20, 50],
                pageLength: 20,
                pagingType: 'simple_numbers',
                displayStart: 0,
                stateSave: false,
                info: true,
                scrollCollapse: true,
                dom: window.languageDOM,
                language: window.languageDT
            });

            const datatable = $('#dataTableProducts').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.json.products.get') }}',
                },
                columns: [
                    {title: '', data: 'id'},
                    {title: '', data: 'main_image.path'},
                    {title: 'sku', data: 'sku'},
                    {title: '', data: 'translate.name'},
                    {title: '', data: 'category.breadcrumbs'},
                    {title: 'Наиманование', data: null},
                    {title: 'Цена', data: 'retail'},
                    {title: 'Остаток', data: 'balance'},
                    {title: 'sync', data: 'protected'},
                    {title: '', data: 'id'},
                ],
                columnDefs: [
                    { // id
                        targets: [0],
                        visible: true,
                    },
                    { // image
                        targets: [1],
                        render: function (data, type, row) {
                            return '<img src="' + data + '" class="avatar avatar-sm me-3 border-radius-lg" alt="">';
                        },
                    },
                    { // sku
                        targets: [2],
                        visible: true,
                    },
                    { // name
                        targets: [3],
                        visible: false,
                    },
                    { // category
                        targets: [4],
                        visible: false,
                    },
                    { // full name
                        targets: [5],
                        visible: true,
                        render: function (data, type, row) {
                            return '' +
                            '<div>'+
                                '<div class="text-bold" style="max-width: 500px;">'+ row.translate.name + '</div>' +
                                '<div class="font-italic font-weight-light">'+ row.category.breadcrumbs + '</div>' +
                            '</div>';
                        },
                    },
                    { // price
                        targets: [6],
                        type: 'num',
                        render: function (data, type, row) {
                            return '<div class="text-center"><span class="text-secondary text-xs font-weight-bold">' + parseFloat(data) + '</span></div>';
                        },
                    },
                    { // balance
                        targets: [7],
                        type: 'num',
                        render: function (data, type, row) {
                            if (parseInt(data) < 10) {
                                return '<div class="text-center"><span class="badge badge-sm bg-gradient-warning">' + data + '</span></div>';
                            } else {
                                return '<div class="text-center"><span class="badge badge-sm bg-gradient-success">' + data + '</span></div>';
                            }
                        },
                    },
                    { // protected
                        targets: [8],
                        render: function (data, type, row) {
                            let block = '<div class="text-center">';
                            switch (data) {
                                case 0:
                                    block += '<span class="badge badge-sm text-success"><i class="fa-solid fa-rotate"></i></span>';
                                    break;
                                case 1:
                                    block += '<span class="badge badge-sm text-warning"><i class="fa-solid fa-lock"></i></span>';
                                    break;
                            }
                            block += '</div>';
                            return block;
                        },
                    },
                    { // options
                        targets: [9],
                        render: function (data, type, row) {
                            return '<div class="text-center"><a href="#" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit"><i class="fa-solid fa-gear"></i></a></div>';
                        },
                    },
                ],
            });

            /** Event processing data */
            datatable.on('processing.dt', function (e, settings, processing) {
                // TODO create loader
                // console.log(processing ? 'block' : 'none');
            });

            /** Event click cell */
            datatable.on('click', 'td', function () {
                console.log(datatable.cell(this).index());
                // let data = datatable.cell(this).data();
                // console.log(data);
            });

        })(jQuery)
    </script>
@endpush
