const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js/app.min.js')
    .sass('resources/sass/app.scss', 'public/css/app.min,css');

//mix.sass("resources/sass/modules/custom.scss", "public/css/bulma.min.css"); 
