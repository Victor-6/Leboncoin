const mix = require('laravel-mix');
mix.js('resources/js/vue.js', 'public/js');
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
