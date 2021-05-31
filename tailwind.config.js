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
                    medium: '#6290c8',
                    light: '#ADD7F6',
                    lighter: '#cde8f8'
                },
                level: {
                    1: '#60A5FA',
                    2: '#2563EB',
                    3: '#1E3A8A'
                },
                category: {
                    1: '#5659F0',
                    2: '#1013BC',
                    3: '#07084B'
                }
            },
            backgroundImage: theme => ({
                'bg-boost': "url('/images/bg-boost.svg')"
            })
        },
    },
    variants: {
        extend: {
            padding: ['hover'],
        },
    },
    plugins: [],
}
