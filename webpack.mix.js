const mix = require('laravel-mix');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
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

mix.js('resources/js/app.js', 'public/js')
.js('resources/landing/js/main.min.js','public/landing/js')
.postCss('resources/css/app.css', 'public/css',[
  require("postcss-import"),
  require('tailwindcss'),
])
mix.vue({ version: 2 })
.postCss('resources/landing/css/style.css','landing/css',[
    require("postcss-import"),
    require('tailwindcss'),
]).browserSync('localhost:8000')

mix.webpackConfig({

    module: {
        rules: [
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
              },
              {
                test: /\.scss$/,
                loader: 'sass-loader',
                options: {
                  sourceMap: true,
                  // options...
                }
                // use: [
                //     MiniCssExtractPlugin.loader,
                //     {
                //       loader: 'css-loader'
                //     },
                //     {
                //       loader: 'sass-loader',
                //       options: {
                //         sourceMap: true,
                //         // options...
                //       }
                //     }
                //   ]
              },
        ],
      },
    //   plugins: [
    //     new MiniCssExtractPlugin({
    //       filename: 'resources/css/sass/bulma.scss'
    //     }),
    //   ]
});
