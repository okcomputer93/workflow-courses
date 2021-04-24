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