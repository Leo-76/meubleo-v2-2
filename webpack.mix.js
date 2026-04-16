const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Meubleo Shop — Laravel Mix Configuration
 |--------------------------------------------------------------------------
 |
 | Builds:
 |   • Admin panel  → public/css/app.css  + public/js/app.js
 |   • Shop front   → public/css/shop.css + public/js/shop.js
 |   • Vendor chunk → public/js/vendor.js (shared libs)
 |
 */

mix.setPublicPath('public');

// ─── Admin panel assets ───────────────────────────────────────────────────────

mix
    .sass('resources/sass/app.scss', 'public/css/app.css')
    .js('resources/js/app.js', 'public/js/app.js')
    .extract([
        'bootstrap',
        '@hotwired/stimulus',
        'sortablejs',
        'tom-select',
        'flatpickr',
    ], 'public/js/vendor.js');

// ─── Shop front assets ────────────────────────────────────────────────────────

mix
    .sass('resources/sass/shop.scss', 'public/css/shop.css')
    .js('resources/js/shop.js', 'public/js/shop.js');

// ─── Options ──────────────────────────────────────────────────────────────────

mix
    .options({
        processCssUrls: false,
        postCss: [
            require('autoprefixer'),
        ],
    })
    .sourceMaps(false, 'source-map')
    .version();

if (!mix.inProduction()) {
    mix.sourceMaps();
}

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
    output: {
        chunkFilename: 'public/js/chunks/[name].js',
    },
});
