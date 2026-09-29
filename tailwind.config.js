import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                claude: {
                    canvas: {
                        DEFAULT: '#FAF9F5',
                        dark: '#1B1A17',
                    },
                    surface: {
                        DEFAULT: '#F3F1EC',
                        elevated: '#FFFFFF',
                        dark: '#262521',
                        'dark-elevated': '#2F2D28',
                        subtle: '#ECEAE3',
                        'dark-subtle': '#36342E',
                    },
                    border: {
                        DEFAULT: '#E5E2D9',
                        subtle: '#ECE9E2',
                        dark: '#383630',
                        'dark-subtle': '#2D2B26',
                        focus: '#D97757',
                    },
                    text: {
                        primary: '#1E1E1E',
                        secondary: '#68655E',
                        tertiary: '#8F8B82',
                        'dark-primary': '#ECEAE5',
                        'dark-secondary': '#AAA69D',
                        'dark-tertiary': '#77736A',
                    },
                    terracotta: {
                        DEFAULT: '#D97757',
                        hover: '#C96646',
                        subtle: '#F7ECE6',
                        dark: '#E07A5F',
                        'dark-subtle': '#3B2A24',
                    }
                }
            },
            fontFamily: {
                serif: ['Lora', 'Newsreader', 'Georgia', 'serif'],
                sans: ['Inter', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', 'Fira Code', ...defaultTheme.fontFamily.mono],
            },
            boxShadow: {
                'claude-input': '0 2px 10px rgba(30, 26, 20, 0.04), 0 0 0 1px rgba(30, 26, 20, 0.06)',
                'claude-card': '0 2px 8px -2px rgba(30, 26, 20, 0.06), 0 1px 3px -1px rgba(30, 26, 20, 0.04)',
                'claude-modal': '0 16px 36px -8px rgba(30, 26, 20, 0.12), 0 4px 12px -2px rgba(30, 26, 20, 0.06)',
            },
            borderRadius: {
                'claude-input': '18px',
            }
        },
    },
    plugins: [forms],
};
