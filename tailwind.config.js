module.exports = {
    purge: [
        'pages/*',
        'partials/*'
    ],
    theme: {
        fontFamily: {
            'display': ['arboria', 'sans-serif'],
            'body': ['Raleway', 'sans-serif'],
        },
        boxShadow: {
            sm: '0 0 2px #B5BAD088',
            DEFAULT: '0 0 3px #B5BAD088',
            md: '0 0 6px #B5BAD088',
            lg: '0 0 15px #B5BAD088',
            xl: '0 0 25px #B5BAD088',
            '2xl': '0 0 50px #B5BAD088',
            '3xl': '0 0 60px #B5BAD088',
            inner: 'inset 0 0 4px 0 #B5BAD088',
            none: 'none',
        },
    },
    variants: {},
    plugins: [],
}
