import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            transformStyle: {
              'preserve-3d': 'preserve-3d',
            },
            backfaceVisibility: {
              hidden: 'hidden',
            },
            perspective: {
              1000: '1000px',
            },
            rotate: {
              'y-180': 'rotateY(180deg)',
            }
          }
    },
    plugins: [],
};