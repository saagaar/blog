const mix = require('laravel-mix');

const CKEditorWebpackPlugin = require( '@ckeditor/ckeditor5-dev-webpack-plugin' );
const CKEStyles = require('@ckeditor/ckeditor5-dev-utils').styles;
const CKERegex = {
    svg: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
    css: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css/,
};

Mix.listen('configReady', webpackConfig => {
    const rules = webpackConfig.module.rules;
    const targetSVG = /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/;
    const targetCSS = /\.css$/;

    // exclude CKE regex from mix's default rules
    // if there's a better way to loop/change this, open to suggestions
    for (let rule of rules) {
        if (rule.test.toString() === targetSVG.toString()) {
            rule.exclude = CKERegex.svg;
        }
        else if (rule.test.toString() === targetCSS.toString()) {
            rule.exclude = CKERegex.css;
        }
    }
});

mix.webpackConfig({
    plugins: [
        new CKEditorWebpackPlugin({
            language: 'en'
        })
    ],
    module: {
        rules: [
            {
                test: CKERegex.svg,
                use: [ 'raw-loader' ]
            },
            {
                test: CKERegex.css,
                use: [
                    {
                        loader: 'style-loader',
                        options: {
                             injectType: 'singletonStyleTag'
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: CKEStyles.getPostCssConfig({
                            themeImporter: {
                                themePath: require.resolve('@ckeditor/ckeditor5-theme-lark')
                            },
                            minify: true
                        })
                    },
                ]
            }
        ]
    }
});






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
    mix.js('resources/assets/js/app.js','public/frontend/js');
    mix.js('resources/assets/js/dashboard.js','public/frontend/js');
    mix.js('resources/assets/js/landing-page.js','public/frontend/js');
  
  mix.scripts(
    [
        'resources/assets/landing-page/js/scripts.js',
        'resources/assets/landing-page/js/slick.min.js',
    ],  'public/frontend/js/landing.support.js');

    mix.scripts(
    [
        'resources/assets/maintainence-mode/js/jquery-3.2.1.min.js',
        'resources/assets/maintainence-mode/js/vendor/countdowntime/moment.min.js',
        'resources/assets/maintainence-mode/js/vendor/countdowntime/moment-timezone.min.js',
        'resources/assets/maintainence-mode/js/vendor/countdowntime/moment-timezone-with-data.min.js',
        'resources/assets/maintainence-mode/js/vendor/countdowntime/countdowntime.js',
        'resources/assets/maintainence-mode/js/vendor/tilt/tilt.jquery.min.js',
        'resources/assets/maintainence-mode/js/main.js',
    
    ], 'public/frontend/js/maintainence.mode.js');

    mix.scripts([
        'resources/assets/vendors/popup/jquery.magnific-popup.min.js',
        'resources/assets/js/theme.js',
    ], 'public/frontend/js/common.js');

   // mix.sass('resources/assets/sass/style.scss', 'public/frontend/css')
   //   .copyDirectory('resources/assets/images', 'public/frontend/images');
 
    mix.styles([
    // 'resources/assets/vendors/fontawesome/css/all.min.css',
	'resources/assets/css/bootstrap.css',  
    'resources/assets/css/themify-icons.css',
    'resources/assets/css/flaticon.css',
    'resources/assets/vendors/animate-css/animate.css',
    'resources/assets/vendors/popup/magnific-popup.css',
    'resources/assets/css/style.css',
    'resources/assets/css/ckeditor-styles.css',
    'resources/assets/css/responsive.css',
    'resources/assets/css/responsive.min.css',

    ], 'public/frontend/css/app.css')
	.copyDirectory('resources/assets/font', 'public/frontend/fonts');

    mix.styles([
    'resources/assets/landing-page/css/bootstrap.css',
    'resources/assets/vendors/fontawesome/css/all.min.css',
    'resources/assets/landing-page/css/themify-icons.css',
    'resources/assets/landing-page/css/slick.css',
    'resources/assets/landing-page/animate.css',
    'resources/assets/landing-page/css/styles.css',
    'resources/assets/landing-page/css/responsive-landing.css',

    ], 'public/frontend/css/landing-page.css')

     mix.styles([
    'resources/assets/landing-page/css/bootstrap.css',
    'resources/assets/landing-page/animate.css',
    'resources/assets/maintainence-mode/css/font-awesome.min.css',
    'resources/assets/maintainence-mode/css/util.css',
    'resources/assets/maintainence-mode/css/main.css',
    ], 'public/frontend/css/maintainence-mode.css')

