const mix = require('laravel-mix');
require('laravel-mix-alias');
const CompressionPlugin = require('compression-webpack-plugin')

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

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        postCss: [
            require('postcss-import'),
            require('tailwindcss'),
        ]
    })

mix.alias({
    '@': '/resources/js',
    '~': '/resources/js/Components',
})

mix.webpackConfig({
    plugins: [
        new CompressionPlugin({
            filename: '[path][name].min[ext]',
        }),
    ],
})
