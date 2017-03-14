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
mix.copy('node_modules/dialog-polyfill/dialog-polyfill.js', 'resources/assets/vendors/dialog-polyfill.js');

mix.sass('resources/assets/sass/app.scss', 'public/css')
.scripts([
	'resources/assets/js/vendors/*.js',
	'resources/assets/js/*.js']);