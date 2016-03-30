var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
        .sass('bapp.scss')
        .browserify('main.js')
        .browserify('frontb.js')
        .scripts([
            "vendor/jquery.js",
            "vendor/bootstrap.js",
            "vendor/dropzone.js",
            "/dropzonemanager.js"
        ], 'public/js/app.js')
        .scripts([
            "vendor/velocity.min.js",
            //"/menumanager.js",
            "/contactform.js"
        ], 'public/js/front.js')
        .version(["css/app.css", "css/bapp.css", "js/app.js", "js/front.js"]);
});
