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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/popper.js', 'public/js')
   .js('resources/assets/js/jquery-2.2.4.min.js', 'public/js')
   .js('resources/assets/js/bootstrap.js', 'public/js')
   
   .js('resources/assets/js/stellar.js', 'public/js')
   .js('resources/assets/js/themes.js', 'public/js')
   ;
   



   mix.sass('resources/assets/sass/style.scss', 'public/css')
     .copyDirectory('resources/assets/images', 'public/images');
 
mix.styles([
	'resources/assets/css/bootstrap.css',
    'resources/assets/css/about.css',
    'resources/assets/css/themify-icons.css',
    'resources/assets/css/flaticon.css',
    'resources/assets/vendors/fontawesome/css/all.min.css',
    'resources/assets/vendors/animate-css/animate.css',
    'resources/assets/vendors/popup/magnific-popup.css',
    'resources/assets/css/style.css',
    'resources/assets/css/responsive.css',
    'resources/assets/vendors/fontawesome/css/all.min.css',
    ], 'public/css/app.css')
	.copyDirectory('resources/assets/vendors/fontawesome/webfonts', 'public/fonts');