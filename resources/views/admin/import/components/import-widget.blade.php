<div id="importWidget" class="widget-bottom-right bg-gradient-faded-secondary shadow-secondary border-radius-lg"></div>

@push('scripts')
    <script>
        (function($){

            let eventSuccessImport = new Event('successImportEvent');

            let progressContainer = $('#importWidget');
            window.progressBar = {};

            channelImport.subscribed(() => {
                console.log('subscribed');
            }).listen('.import', (event) => {
                console.log(event.state);
                let wrapper = null;
                switch(event.state) {
                    case "start":
                        break;
                    case "progress":
                        progressContainer.show();
                        if(window.progressBar[event.item] === undefined) {
                            wrapper = $('<div/>', {
                                class: 'progress-wrapper',
                                style: 'width: 100%;'
                            });
                            let label = $('<div/>', {
                                class: 'progress-label',
                                text: event.label
                            });
                            let bar = $('<div/>', {
                                id: 'importProgressBar-' + event.item,
                                style: 'width: 100%; height: 20px;'
                            });

                            wrapper.append(label).append(bar);
                            progressContainer.append(wrapper);

                            window.progressBar[event.item] = new ProgressBar.Line('#importProgressBar-' + event.item, {
                                color: '#1A73E8',
                                duration: 10,
                                easing: 'easeInOut',
                                strokeWidth: 1,
                                trailWidth: 1,
                            });
                        }
                        window.progressBar[event.item].animate(parseFloat(event.step / event.steps));
                        break;
                    case "finish":
                        progressContainer.hide();
                        progressContainer.empty();
                        break;
                    case "success":
                        progressContainer.hide();
                        progressContainer.empty();
                        document.dispatchEvent(eventSuccessImport);
                        break;
                }
            });

        })(jQuery)
    </script>
@endpush
