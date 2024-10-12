/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin')

module.exports = {
    darkMode: 'class',
    content: [
        "./app/Enums/**/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors : {
                'primary' : '#1A202C',
                'secondary' : '#2D3748',
                'tertiary' : '#4A5568',
                'quaternary' : '#718096',
                'quinary' : '#A0AEC0',
                'senary' : '#CBD5E0',
                'septenary' : '#E2E8F0',
                'octonary' : '#EDF2F7',
                'nonary' : '#F7FAFC',
                'denary' : '#FFFFFF',
                "logo-orange": {
                    100: "#fbe0cc",
                    200: "#f7c199",
                    300: "#f3a166",
                    400: "#ef8233",
                    500: "#eb6300",
                    600: "#bc4f00",
                    700: "#8d3b00",
                    800: "#5e2800",
                    900: "#2f1400"
                }
            },
        
            textShadow: {
                sm: '0 1px 2px var(--tw-shadow-color)',
                DEFAULT: '0 2px 4px var(--tw-shadow-color)',
                lg: '0 8px 16px var(--tw-shadow-color)',
            },
        },
    },
    plugins: [
        require('flowbite/plugin'),
        plugin(function ({ matchUtilities, theme }) {
            matchUtilities(
              {
                'text-shadow': (value) => ({
                  textShadow: value,
                }),
              },
              { values: theme('textShadow') }
            )
        }),
    ],
}

