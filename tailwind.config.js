const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    100: '#FE3C72',
                    75: '#FE6B94',
                    50: '#FE9DB8',
                    25: '#FFCEDC',
                    opacity: 'rgba(254, 60, 114, 0.3)'
                },
                secondary: {
                    100: '#FF7854',
                    75: '#FF9A7F',
                    50: '#FFBBA9',
                    25: '#FFDDD4'
                },
                gray: {
                    100: '#424242',
                    75: '#717171',
                    65: '#c1c1c2',
                    50: '#A0A0A0',
                    35: '#f6f6f7',
                    25: '#D4D8DD',
                    10: '#F7F8FC',

                },
                blue: {
                    100: '#35abf5',
                    50:  '#22b7f9',
                }
            },
            maxHeight: {
                swipe: 'calc(100vh - 200px)',
                chat: 'calc(100vh - 250px)'
            },
            minWidth: {
                '8': '2rem',
                '16': '4rem'
            },
            maxWidth: {
                '8': '2rem',
                '16': '4rem'
            },
            height: {
                swipe: 'calc(100vh - 200px)',
                chat: 'calc(100vh - 250px)'
            },
            keyframes: {
                'pulse-aud': {
                    '0%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(2)'},
                    '100%': { transform: 'scale(1)'},
                }
            },
            animation: {
                'pulse-aud': 'pulse-aud 3s ease-in-out infinite'
            }
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },
    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
