@extends('admin.layouts.app')

@section('title', 'Импорт')

@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#"> </a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Импорт</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col">

            <div class="row">
                <div class="col">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Импорт</h6>
                            </div>
                        </div>
                        <div class="card-body px-2 pb-2"></div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-4">
                    <div class="card mt-4">

                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                                <h6 class="text-white text-capitalize ps-3">Опции</h6>
                            </div>
                        </div>

                        <form id="importOptionsForm" action="{{ route('admin.import.options') }}" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    @foreach(\App\Models\ImportConfig::$options as $optionAvailable)
                                        <div class="form-check">
                                            <input name="{{$optionAvailable}}" class="form-check-input" type="checkbox"
                                                   id="check_{{$optionAvailable}}"
                                                   @if(array_key_exists($optionAvailable, $options) and $options[$optionAvailable])
                                                   checked=""
                                                   @endif
                                            >
                                            <label class="custom-control-label" for="check_{{$optionAvailable}}">{{ __('options.'.$optionAvailable) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer" style="padding: 0.5rem 1.5rem 1.5rem;">
                                <div style="text-align: center">
                                    <button id="importStartBtn" class="btn btn-info" type="button"
                                        @if($state) disabled @endif
                                        data-action="{{ route('admin.import.start') }}" >@if($state)В процессе...@elseИмпортировать@endif</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function($){

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });


            $('#importOptionsForm').find('[type=checkbox]').on('change', function(e){
                e.preventDefault();
                let form = $('#importOptionsForm');
                let action = form.attr('action');
                let method = form.attr('method');
                let fd = new FormData();
                form.find('[type=checkbox]').each(function(){
                    fd.append($(this).attr('name'), ($(this).is(':checked')) ? "1" : "0");
                });
                $.ajax({
                    url: action,
                    method: method,
                    processData: false,
                    contentType: false,
                    data: fd,
                    beforeSend: function(){
                    },
                    success: function (data) {
                        toastr.success('Сохранено!')
                    },
                    error: function (xhr, status, err) {
                        toastr.error('Ошибка!')
                        console.log(xhr.responseText);
                    }
                });
            });

            let importStartBtn = $('#importStartBtn');
            importStartBtn.on('click', function(e){
                let action = $(this).data('action');
                $.ajax({
                    url: action,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: {},
                    beforeSend: function(){
                        importStartBtn.prop('disabled', true);
                        importStartBtn.text('В процессе...');
                    },
                    success: function (data) {
                        toastr.success('Импорт запущен!')
                    },
                    error: function (xhr, status, err) {
                        importStartBtn.prop('disabled', false);
                        importStartBtn.text('Импортировать');
                        toastr.error('Ошибка!')
                        console.log(xhr.responseText);
                    }
                });
            });

            document.addEventListener('successImportEvent', function (e) {
                importStartBtn.prop('disabled', false);
                importStartBtn.text('Импортировать');
            }, false);

        })(jQuery)
    </script>
@endpush
