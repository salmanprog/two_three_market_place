const mix = require('laravel-mix');

mix.js('Resources/js/app.js', 'public/modules/reseller/js')
    .sass('Resources/sass/app.scss', 'public/modules/reseller/css')
    .webpackConfig({
        output: {
            chunkFilename: 'public/modules/reseller/js/chunks/[name].js',
        }
    }); 