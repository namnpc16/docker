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

/* Backend */
mix.styles([
 'node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css',
 'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.css',
 'node_modules/admin-lte/plugins/summernote/summernote-bs4.css',
 'node_modules/admin-lte/plugins/sweetalert2/sweetalert2.css',
 'node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css',
 'node_modules/admin-lte/plugins/select2/css/select2.min.css',
 'node_modules/admin-lte/dist/css/adminlte.min.css',
 'resources/assets/back/css/main.css',
], 'public/back/css/app.css');
mix.scripts([
     // lib
     'node_modules/admin-lte/plugins/jquery/jquery.min.js',
     'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
     'node_modules/admin-lte/plugins/moment/moment.min.js',
     'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.js',
     'node_modules/admin-lte/plugins/summernote/summernote-bs4.min.js',
     'node_modules/admin-lte/plugins/summernote/lang/summernote-ja-JP.js',
     'node_modules/admin-lte/plugins/sweetalert2/sweetalert2.js',
     'node_modules/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js',
     'node_modules/admin-lte/plugins/select2/js/select2.js',
     // app
     'node_modules/admin-lte/dist/js/adminlte.min.js',
     'resources/assets/back/js/main.js'
    ], 'public/back/js/app.js'
);
mix.copyDirectory('node_modules/admin-lte/plugins/summernote/font', 'public/back/css/font');
mix.copyDirectory('node_modules/admin-lte/plugins/fontawesome-free/webfonts', 'public/back/webfonts');
mix.copyDirectory('resources/assets/back/img', 'public/back/img');

mix.version();

// development env
mix.browserSync({
 proxy: process.env.APP_URL,
 port: 3000
});