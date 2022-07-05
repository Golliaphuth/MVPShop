window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import $ from 'jquery';
window.$ = window.jQuery = $;
require('bootstrap');
require('@fortawesome/fontawesome-free');
require('owl.carousel');
require('lightbox2');
require('select2');
require('select2/dist/js/i18n/ru');
require('select2/dist/js/i18n/uk');
window.noUiSlider = require('nouislider');
window.alertify = require('alertifyjs');
window.svg4everybody = require('svg4everybody/dist/svg4everybody');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: false,
    wsHost: window.location.hostname,
    wsPort: 6001,
    encrypted: false,
    enabledTransports: ['ws', 'wss']
});
