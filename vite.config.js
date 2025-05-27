import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: false,
        hmr: {
            host: '0.0.0.0',
            port: 5173,
            protocol: 'ws',
            clientPort: 5173
        },
        watch: {
            usePolling: true,
            interval: 1000,
        },
    },
    optimizeDeps: {
        include: ['vue', '@inertiajs/vue3']
    },
});
