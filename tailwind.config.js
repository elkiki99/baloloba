import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            blur: {
                xs: '1px',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'xs': { min: '480px' }, // Media query para hasta 1280px
                'portrait': { raw: '(orientation: portrait)' }, // Media query para orientación vertical
                'hover-none': { raw: '(hover: none)' }, // Detecta dispositivos que no soportan hover
              },
        },
    },

    plugins: [forms],
};
