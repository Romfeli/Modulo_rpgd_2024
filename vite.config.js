
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: {
                'app': 'resources/js/app.js',
                'styles': 'resources/css/app.css',
            },
            output: 'public/assets', // Carpeta de salida para los activos compilados
        }),
    ],
});