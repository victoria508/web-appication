const mix = require('laravel-mix');
const tailwind = require('tailwindcss');
const purgeCSS = require('@fullhuman/postcss-purgecss');

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

const options = {
    processCssUrls: false,
    postCss: [
        tailwind('./tailwind.config.js'),
    ],
};

if (mix.inProduction())
{
    mix.version();

    options.postCss.push(purgeCSS({
        content: [
            '**/*.vue',
            '**/*.blade.php',
        ],
        defaultExtractor(content)
        {
            const contentWithoutStyleBlocks = content.replace(
                /<style[^]+?<\/style>/gi, '');
            return contentWithoutStyleBlocks.match(
                /[A-Za-z0-9-_/:]*[A-Za-z0-9-_/]+/g) || [];
        },
        whitelist: [],
        whitelistPatterns: [
            /-(leave|enter|appear)(|-(to|from|active))$/,
            /^(?!(|.*?:)cursor-move).+-move$/,
            /^router-link(|-exact)-active$/,
            /data-v-.*/,
        ],
    }));
}
else
{
    mix.sourceMaps();
}

mix.
    js('resources/js/app.js', 'public/js').
    sass('resources/sass/app.scss', 'public/css').
    options(options);
