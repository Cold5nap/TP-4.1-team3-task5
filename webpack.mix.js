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
    .js('resources/js/admin.js', 'public/js/admin')
    .js("resources/js/user.js", 'public/js')
    .vue()
    .sass("vendor/twbs/bootstrap/scss/bootstrap.scss", 'public/css')
    .sass('resources/sass/adminlte.scss', 'public/css/admin');
