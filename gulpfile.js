var elixir = require('laravel-elixir'),
    gulp = require('gulp');

require('laravel-elixir-vue');

elixir(function (mix) {
    mix.scripts([
        'popper.min.js',
        'jquery-3.2.1.min.js',
        'jquery-ui.min.js',
        'bootstrap.min.js',
        'sortable-code.js',
        'tooltipsy.min.js',
        'patchCableCode.js',
        'app.js'
    ],
        'public/js/app.js'
    );
    mix.copy(
        'resources/assets/fonts',
        'public/build/fonts'
    ); // move fonts

    mix.styles([
        'bootstrap.min.css',
        'font-awesome.min.css',
        'app.css'
    ],
        'public/css/app.css'
    );

    mix.version(['css/app.css', 'js/app.js']);;
});
