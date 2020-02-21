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
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
mix.sass('resources/sass/app.scss', 'public/css').version();

mix.webpackConfig({ devtool: 'source-map' })

mix.scripts([
    'resources/js/core/jquery.min.js',
    'resources/js/core/popper.min.js',
    'resources/js/core/bootstrap.min.js',
    'resources/js/plugins/perfect-scrollbar.jquery.min.js',
    'resources/js/plugins/chartjs.min.js',
    'resources/js/plugins/bootstrap-notify.js',
    'resources/js/now-ui-dashboard.js',
    'node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js',
    'node_modules/noty/lib/noty.js',
    'node_modules/jquery-circle-progress/dist/circle-progress.js',
    'node_modules/@yaireo/tagify/dist/tagify.min.js',
    'node_modules/@yaireo/tagify/dist/jQuery.tagify.min.js',
    'node_modules/pickerjs/dist/picker.js',
    'node_modules/@fortawesome/fontawesome-free/js/all.js',
    'node_modules/jquery-typeahead/dist/jquery.typeahead.min.js',
    'resources/js/delete.js',
    'resources/js/zigbee/cooldown.js',
    'resources/js/zigbee/lights.js',
    'resources/js/zigbee/groups.js',
    'resources/js/app.js',
], 'public/js/app.js').version();

