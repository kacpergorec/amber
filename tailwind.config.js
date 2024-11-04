import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#FFFBFA",
                    100: "#FFF1EB",
                    200: "#FFE0CC",
                    300: "#FFCB9F",
                    400: "#FCB864",
                    500: "#F59E0B",
                    600: "#EB8305",
                    700: "#DA6601",
                    800: "#B84600",
                    900: "#802600",
                    950: "#330B00"
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
