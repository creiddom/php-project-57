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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],

    safelist: [
        'bg-blue-100',
        'text-blue-800',
        'bg-sky-100',
        'text-sky-800',
        'bg-indigo-100',
        'text-indigo-800',
        'bg-violet-100',
        'text-violet-800',
        'bg-teal-100',
        'text-teal-800',
        'bg-emerald-100',
        'text-emerald-800',
        'bg-cyan-100',
        'text-cyan-800',
        'bg-amber-100',
        'text-amber-800',
        'bg-rose-100',
        'text-rose-800',
        'bg-fuchsia-100',
        'text-fuchsia-800',
    ],
};
