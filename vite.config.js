import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  base: 'https://jobpadoy-55dmz.ondigitalocean.app/build/', // <--- FORCE HTTPS HERE!
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});
