const mix = require('laravel-mix');

mix.copy([
        'node_modules/iframe-resizer/js/iframeResizer.contentWindow.min.js',
        'node_modules/iframe-resizer/js/iframeResizer.min.js'
    ], 'resources/dist')
    .sass('resources/scss/iframe-content.scss', 'css')
    .setPublicPath('resources/dist')
    .options({
        processCssUrls: false,
    })
    .version()
