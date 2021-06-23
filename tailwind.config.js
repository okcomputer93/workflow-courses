// tailwind.config.js
module.exports = {
    purge: {
        content: [
            './resources/**/*.blade.php',
            './resources/**/*.js',
            './resources/**/*.vue',
        ],
        safelist: [
            'border-category-1',
            'border-category-2',
            'border-category-3',
            'bg-category-1',
            'bg-category-2',
            'bg-category-3',
            'text-category-1',
            'text-category-2',
            'text-category-3'
        ],
        options: {
            keyframes: true,
            fontFace: true
        },
    },
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
            transitionProperty: {
                'width': 'width'
            },
            backgroundImage: theme => ({
                'bg-boost': "url('/images/bg-boost.svg')"
            }),
        },
    },
    variants: {
        extend: {
            padding: ['hover'],
            opacity: ['disabled'],
            cursor: ['disabled']
        },
    },
    plugins: [],
}
