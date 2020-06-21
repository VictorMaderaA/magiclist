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

mix.setPublicPath('public');

mix.js('resources/js/app.js', 'public/js');



mix.js('resources/js/app_1.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.copyDirectory('node_modules/jquery/dist', 'public/mix/jquery')
    .copy('node_modules/admin-lte/dist/js/adminlte.js', 'public/mix/adminlte/js')
    .copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/mix/adminlte/js')
    .copyDirectory('node_modules/admin-lte/dist/css', 'public/mix/adminlte/css')
    .copyDirectory('node_modules/bootstrap/dist', 'public/mix/bootstrap')
;


if (mix.inProduction()) {
    mix.version();
}
