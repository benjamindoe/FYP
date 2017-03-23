const { mix } = require('laravel-mix');

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
mix.copy('node_modules/dialog-polyfill/dialog-polyfill.js', 'resources/assets/js/vendors/dialog-polyfill.js');

mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/app.js', 'public/js')
   .extract(['jquery-ui', 'jquery', 'dialog-polyfill', 'progressbar.js', 'lodash', 'chart.js']);