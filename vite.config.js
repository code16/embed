import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  // We don't use a publicDir; outputs go straight to resources/dist like Mix
  publicDir: false,
  build: {
    outDir: 'resources/dist',
  },
  plugins: [
    laravel({
      input: [
        'resources/css/embed-iframe-content.css',
        'resources/js/embed-iframe.js',
        'resources/js/embed-iframe-content.js',
      ],
    }),
  ],
})
