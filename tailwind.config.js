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
                    1: '#119DA4',
                    2: '#80DED9',
                    3: '#F5B0CB'
                },
                level: {
                    1: '#00A6FB',
                    2: '#0582CA',
                    3: '#006494'
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
