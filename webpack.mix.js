const mix = require('laravel-mix');

mix
    /** FRONT */
    .js('resources/js/front/app.js', 'public/js/front')
    .sass('resources/scss/front/theme.scss', 'public/css/front').sourceMaps()
    .sass('resources/scss/front/style.scss', 'public/css/front').sourceMaps()

    /** ADMIN */
    .js('resources/js/admin/app.js', 'public/js/admin')
    .sass('resources/scss/admin/fontawesome.scss', 'public/css/admin').sourceMaps()
    .sass('resources/scss/admin/style.scss', 'public/css/admin').sourceMaps()
;
