const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/tutororderdetails.js', 'public/js')
    .js('resources/js/adminorderdetails.js', 'public/js')
    .js('resources/js/addfunds.js', 'public/js')
    .js('resources/js/studentorderdetails.js', 'public/js')
    .js([
        'resources/frontpage/js/template-custom.js'
    ], 'public/js/apphome.js')
    .js('resources/js/vtable.js', 'public/js')
    .styles([
        'resources/frontpage/css/plugins/bundle.css',
        'resources/frontpage/css/font-awesome.min.css',
        'resources/frontpage/css/style.css'
    ], 'public/css/apphome.css')
    .sass('resources/sass/app.scss', 'public/css');