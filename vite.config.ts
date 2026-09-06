import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'modules/admin/resources/assets/css/app.css',
                'modules/admin/resources/assets/js/app.js',
                'modules/frontend/resources/assets/css/frontend.css',
                'modules/frontend/resources/assets/js/frontend.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
