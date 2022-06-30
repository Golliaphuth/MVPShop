const mix = require('laravel-mix');

mix
    /** FRONT */
    .js('resources/js/front/app.js', 'public/js/front')
    .sass('resources/scss/front/bootstrap/bootstrap.scss', 'public/css/front/vendor').sourceMaps()
    .css('resources/css/front/style.css', 'public/css/front').sourceMaps()
    .sass('resources/scss/front/custom.scss', 'public/css/front').sourceMaps()

    /** ADMIN */
    .js('resources/js/admin/app.js', 'public/js/admin')
    .sass('resources/scss/admin/fontawesome.scss', 'public/css/admin').sourceMaps()
    .sass('resources/scss/admin/style.scss', 'public/css/admin').sourceMaps()
;

mix.options({
    hmrOptions: {
        host: 'localhost',
        port: 8080,
    }
});
