// tailwind.config.js
module.exports = {
    purge: {
        content: [
            './resources/**/*.blade.php',
            './resources/**/*.js',
            './resources/**/*.vue',
        ],
        options: {
            keyframes: true,
            fontFace: true,
            safelist: [
                'border-category-1',
                'border-category-2',
                'border-category-3',
                'bg-category-1',
                'bg-category-2',
                'bg-category-3',
                'text-category-1',
                'text-category-2',
                'text-category-3',
                'border-level-1',
                'border-level-2',
                'border-level-3',
                'bg-level-1',
                'bg-level-2',
                'bg-level-3',
                'text-level-1',
                'text-level-2',
                'text-level-3',
                'top-6',
                'top-1',
                'bottom-6',
                'bottom-1',
                'left-6',
                'left-1',
                'right-6',
                'right-1'
            ],
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
