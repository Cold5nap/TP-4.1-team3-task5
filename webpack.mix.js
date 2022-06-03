const mix = require('laravel-mix');

mix
    .js('resources/js/admin.js', 'public/js/admin')
    .js("resources/js/user.js", 'public/js')
    .vue()
    .css("resources/css/nouislider.min.css", 'public/css')
    .sass("vendor/twbs/bootstrap/scss/bootstrap.scss", 'public/css')
    .sass('resources/sass/adminlte.scss', 'public/css/admin');