import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
// Importing Tailwind CSS for use in the Vite build process

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
    },
});
