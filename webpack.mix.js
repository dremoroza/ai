
let mix = require('laravel-mix');

mix.webpackConfig({
    stats: {
         children: true
    }
});

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .sass('resources/sass/app.scss', 'public/css').vue();

    mix.version()
    mix.browserSync('http://ai-dev.virtualcentral.co')    