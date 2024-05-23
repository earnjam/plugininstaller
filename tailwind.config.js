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
            colors: {
                'gray': {
                    50: '#F8F9FA',
                    100: '#F3F4F6',
                    200: '#E5E7EB',
                    300: '#D1D5DB',
                    400: '#8C929F',
                    500: '#6B7280',
                    600: '#4B5563',
                    700: '#374151',
                    800: '#1F2937',
                    900: '#111827'
                },
                'yoast-green': '#77B227',
                'yoast-purple': {
                    50: '#F9F1F6',
                    100: '#F3E5ED',
                    200: '#EDCFE0',
                    300: '#CD82AB',
                    400: '#B94986',
                    500: '#A61E69',
                    600: '#9A1660',
                    700: '#8F0F57',
                    800: '#83084E',
                    900: '#770045',
                    'dark': '#5D237A'
                }
            },
        },
    },

    plugins: [forms],
};
