import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // AGREGAMOS TUS NUEVAS FUENTES AQUÍ
                fantasy: ['"Cinzel"', 'serif'],
                handwriting: ['"Caveat"', 'cursive'],
            },
            // AGREGAMOS TU PALETA DE COLORES AQUÍ
            colors: {
                'old-lace': '#FFF8E9',
                'grapefruit': '#FE6D73',
                'apricot': '#FFCB77',
                'turquoise': '#24E5D2',
                'cerulean': '#2584A7',
            }
        },
    },

    plugins: [forms],
};