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

mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('node_modules/font-awesome/fonts', 'public/fonts');
mix.sass('resources/sass/app.scss', 'public/css').version();

mix.scripts([
    'resources/js/core/jquery.min.js',
    'resources/js/core/popper.min.js',
    'resources/js/core/bootstrap.min.js',
    'resources/js/plugins/perfect-scrollbar.jquery.min.js',
    'resources/js/plugins/chartjs.min.js',
    'resources/js/plugins/bootstrap-notify.js',
    'resources/js/plugins/now-ui-dashboard.min.js',
    'resources/js/delete.js',
    'resources/js/app.js',
], 'public/js/app.js').version();

