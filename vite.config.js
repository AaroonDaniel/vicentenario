import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue' // si usas Vue
import tailwindcss from 'tailwindcss'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/style.css'
            ],
            refresh: true,
        }),
        vue(),
    ],
});


