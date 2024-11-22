import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';
import flowbiteEditor from 'flowbite-typography';

/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],

  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#CA4E02',
          50: '#FFF0E6',
          100: '#FEE1CD',
          200: '#FEC39A',
          300: '#FDA468',
          400: '#FD8435',
          500: '#FC6303',
          600: '#CA4E02',
          700: '#973A02',
          800: '#652601',
          900: '#321301',
          950: '#190900',
        },
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
          ...require('daisyui/src/theming/themes')['light'],
          primary: '#FD8435',
          'primary-focus': '#ff8230',
          secondary: '#df4137',
          'secondary-focus': '#d12222',
          accent: '#ffffff',
          info: '#5493ff',
          success: '#14d190',
          warning: '#ff8532',
          error: '#ff6464',
          'base-100': '#f4f4f5',
          'base-200': '#e4e4e7',
          'base-300': '#d4d4d8',
        },
        dark: {
          ...require('daisyui/src/theming/themes')['dark'],
          primary: '#FC6303',
          'primary-focus': '#e65a00',
          secondary: '#d1231b',
          'secondary-focus': '#A40E0E',
          accent: '#ffffff',
          info: '#6266F1',
          success: '#22C55D',
          warning: '#F59D0D',
          error: '#ff2e50',
          'base-100': '#191919',
          'base-200': '#1e1e1e',
          'base-300': '#232323',
        },
      },
    ],
  },

  plugins: [forms, daisyui, flowbiteEditor],

  safelist: [
    'alert-success',
    'alert-error',
    'alert-warning',
    'alert-info',
    'alert-primary',
    'alert-secondary',
    'alert-accent',
    'alert-neutral',
    'alert-light',
    'alert-dark',
    'btn-primary',
    'btn-secondary',
    'btn-accent',
    'btn-neutral',
    'btn-success',
    'btn-warning',
    'btn-error',
    'btn-info',
    'btn-light',
    'btn-dark',
    'btn-ghost',
  ],
};
