// noinspection JSAnnotator
let mix = require('laravel-mix');

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

// Fonts & Icons
mix.sass('resources/assets/sass/fonts.scss', 'public/css');

// Main application assets
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/images/', 'public/images', false)
    .autoload({
        jquery: ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"],
        'popper.js/dist/umd/popper.js': ['Popper']
    });

// Dashboard assets
mix
    // .js('node_modules/coreui.io/Static_Full_Project_GULP/js/app.js', 'public/js/admin.js')
    .sass('resources/assets/sass/admin.scss', 'public/css');
