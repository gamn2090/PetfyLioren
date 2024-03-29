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

mix
    .styles([
        'resources/vendor/fontawesome-free/css/all.min.css',
        'resources/vendor/bootstrap-datepicker/css/datepicker.css',
        'resources/css/adminlte.css',
        'resources/vendor/alertify/css/alertify.min.css',
    ], 'public/css/app.css')

    .js('resources/js/app.js', 'public/js')

    .scripts([
        'resources/vendor/jquery/jquery.min.js',        
        'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',        
        'resources/vendor/bootstrap-datepicker/bootstrap-datepicker1-3.js',        
        'resources/vendor/momment/momment.js',        
        'resources/vendor/bootstrap-datepicker/english.js',        
        'resources/vendor/alertify/js/alertify.min.js',        
    ], 'public/js/vendor.js')

    .copy('resources/vendor/fontawesome-free/webfonts','public/webfonts')
    .copy('resources/img','public/img')

    //.sass('resources/sass/app.scss', 'public/css');
.version()

;