import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'gloflow-purple-100': '#c7c2fa',
            'gloflow-purple-200': '#a598f3',
            'gloflow-purple-300': '#856dea',
            'gloflow-purple-400': '#6a38df',
            'gloflow-purple-500': '#5F00D9',
            'gloflow-purple-600': '#5200bc',
            'gloflow-purple-700': '#380086',
            'gloflow-purple-800': '#200053',
            'gloflow-purple-900': '#0a0025',
        }
    },

    plugins: [
        forms,
        require('flowbite/plugin')({
            charts: true,
        }),
    ],
};
