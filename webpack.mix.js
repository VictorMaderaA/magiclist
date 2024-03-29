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

// Override mix internal webpack output configuration mix.config.webpackConfig.output = {
mix.config.webpackConfig.output = {
    chunkFilename: 'js/chunks/[name].bundle.js',
    publicPath: '/',
};

mix.setPublicPath('public');

mix.js('resources/js/app.js', 'public/js');

mix.js('resources/js/app_explore.js', 'public/js');



mix.js('resources/js/app_1.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');

mix.copyDirectory('node_modules/jquery/dist', 'public/mix/jquery')
    .copy('node_modules/admin-lte/dist/js/adminlte.js', 'public/mix/adminlte/js')
    .copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/mix/adminlte/js')
    .copyDirectory('node_modules/admin-lte/dist/css', 'public/mix/adminlte/css')
    .copyDirectory('node_modules/bootstrap/dist', 'public/mix/bootstrap')
;

//Snotify
mix.copy('node_modules/vue-snotify/styles/dark.css', 'public/mix/snotify/css')
    .copy('node_modules/vue-snotify/styles/material.css', 'public/mix/snotify/css')
    .copy('node_modules/vue-snotify/styles/simple.css', 'public/mix/snotify/css')
;

//HolderJs
mix.copy('node_modules/holderjs/holder.js', 'public/mix/holderjs/')
    .copy('node_modules/holderjs/holder.min.js', 'public/mix/holderjs/')
;


if (mix.inProduction()) {
    mix.version();
}
