import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  server: {
    hmr: {
      host: 'localhost'
    }
  },
    plugins: [
        vue(),

        laravel({
            input: ['resources/js/app.js', 'resources/js/tabs.js'],
            //Refresh in dev mode when files change.
            refresh: true,
        }),
    ],
    // refresh: [
    //     'routes/**',
    //     'resources/views/**',
    //     'app/Http/Livewire/**',
    // ]
    resolve: {
        alias: {
            '@': '/node_modules/',
        },
    },
    
    build: {
        sourcemap: false,
        rollupOptions: {
          output: {
            manualChunks: (path) => path.split('/').reverse()[path.split('/').reverse().indexOf('node_modules') - 1]
          },
        },
      },
});
