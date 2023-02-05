import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vueJsx from '@vitejs/plugin-vue-jsx'

export default defineConfig({
    plugins: [vue(), vueJsx({
        // options are passed on to @vue/babel-plugin-jsx
    }),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

            ],
            refresh: true,
        }),
    ],
});
