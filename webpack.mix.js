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
mix.sass('resources/sass/app.scss', 'public/css').version();

mix.webpackConfig({ devtool: 'source-map' });

mix.js('resources/js/app.js', 'public/js').version();

/*
mix.scripts([
    'node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js',
    'resources/js/zigbee/cooldown.js',
    'resources/js/zigbee/lights.js',
    'resources/js/zigbee/groups.js',
    'resources/js/app.js',
], 'public/js/app.js').version();*/

mix.browserSync({proxy: 'zigbeelights.test', notify: false });

