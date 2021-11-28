const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/components-vue/*'
    ],

    theme: {
        scale: {
            '0': '0',
           '25': '.25',
            '50': '.5',
            '75': '.75',
            '90': '.9',
           '95': '.95',
            '100': '1',
           '105': '1.05',
           '110': '1.1',
            '125': '1.25',
            '150': '1.5',
           '200': '2',
           '400': '4'
          },
          minHeight: {
            '0': '0',
            '100': '100px',
            '150': '150px',
            '200': '200px',
            '250': '250px',
            '300': '300px',
            '400': '400px',
            '1/4': '25%',
            '1/2': '50%',
            '3/4': '75%',
            'full': '100%',
           },
           minWidth: {
            '70': '70px',
            '100': '100px',
            '150': '150px',
            '200': '200px',
            '250': '250px',
            '300': '300px',
            '400': '400px',
            '1/4': '25%',
            '1/2': '50%',
            '3/4': '75%',
            'full': '100%',
           },
           maxWidth: {
            '0': '0',
            '100': '100px',
            '150': '150px',
            '200': '200px',
            '250': '250px',
            '300': '300px',
            '400': '400px',
            '700': '700px',
            '1/4': '25%',
            '1/2': '50%',
            '3/4': '75%',
            'full': '100%',
           },
        fontSize: {
            'xxs': '0.6rem',
            'xs': '.75rem',
            'sm': '.875rem',
            'tiny': '.875rem',
             'base': '1rem',
             'lg': '1.125rem',
             'xl': '1.25rem',
             '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
             '5xl': '3rem',
             '6xl': '4rem',
            '7xl': '5rem',
           },
        borderWidth: {
            DEFAULT: '1px',
            '1/2':'0.5px',
            '1': '1px',
            '2': '2px',
           '3': '3px',
            '4': '4px',
           '6': '6px',
           '8': '8px',
          },
        extend: {
            colors:{
                mygreenMain: 'hsl(177, 100%, 43%)',
                mygreenLight: 'hsl(177, 100%, 49%)',
                mygreenDark: 'hsl(177, 100%, 39%)',
                mygreenSLight: 'hsl(177, 73%, 84%)',
                mygreenSDark: 'hsl(177, 87%, 32%)',

            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },

    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
