// tailwind.config.js
module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            height: {
                medium: '90vh'
            },
            colors: {
                blue: {
                    dark: '#1f2937',
                },
                category: {
                    1:    '#13315C',
                    2: '#8DA9C4',
                    3: '#0B2545'
                }
            }
        },
    },
    variants: {
        extend: {
            padding: ['hover'],
        },
    },
    plugins: [],
}
