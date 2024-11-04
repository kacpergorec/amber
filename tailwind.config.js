import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from "daisyui";

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

    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["light"],
                    "primary": "#F59E0B",
                    "primary-focus": "#EB8305",
                    "secondary": "#df4137",
                    "secondary-focus": "#d12222",
                    "accent": "#0799ff",
                    "info": "#5493ff",
                    "success": "#1ed89c",
                    "warning": "#ff8532",
                    "error": "#ff6464",
                    "base-100": "#f4f4f5",
                    "base-200": "#e4e4e7",
                    "base-300": "#d4d4d8",
                },
                dark: {
                    ...require("daisyui/src/theming/themes")["dark"],
                    "primary": "#F59E0B",
                    "primary-focus": "#EB8305",
                    "secondary": "#ef261c",
                    "secondary-focus": "#A40E0E",
                    "accent": "#005bff",
                    "info": "#005bff",
                    "success": "#00ca6e",
                    "warning": "#ff6800",
                    "error": "#ff0000",
                    "base-100": "#171717",
                    "base-200": "#1e1e1e",
                    "base-300": "#252525",
                },
            },
        ],
    },

    plugins: [
        forms,
        daisyui
    ],
};
