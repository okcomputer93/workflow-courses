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
