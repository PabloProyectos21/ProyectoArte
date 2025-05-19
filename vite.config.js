import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // Esto fuerza la base de los assets en producción
    base: process.env.ASSET_URL ? process.env.ASSET_URL + '/build/' : '/build/',
});
