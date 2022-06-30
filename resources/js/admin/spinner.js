(function($){

    window.preloader = function(action){
        let preloader = $('<div/>', {
            id: 'preloader',
            class: 'preloader'
        }).append(
            $('<span/>', {
                class: 'loader'
            })
        );
        switch(action) {
            case 'show':
                $('body').append(preloader);
                break;
            case 'hide':
                $('#preloader').remove();
        }
    };

})(jQuery)
