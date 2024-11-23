import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/tailwind.css',
        'resources/css/app.scss',
        'resources/js/app.js',
        'resources/js/quill.js',
      ],
      refresh: true,
    }),
  ],
    build: {
        minify: false,
        terserOptions: {
            compress: false,
            mangle: false,
        },
    },
});
