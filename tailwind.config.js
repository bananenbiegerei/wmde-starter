module.exports = {
  content: [
    './**/*.php',
  ],
  theme: {
    // Helper pixel to rem calc: https://nekocalc.com/de/px-zu-rem-umrechner
    fontSize: {
      'xs': '0.5rem',
      'sm': '0.85rem', //small,
      'tiny': '1rem', // h6
      'base': '1.125rem', //p, h5
      'lg': '1.125rem', //h4
      'xl': '1.5rem', //h3
      '2xl': '1.75rem', //h2
      '3xl': '2.5rem', //h1 = 40px
      '4xl': '2.25rem',
    },
    fontFamily: {
      sans: ['Montserrat', 'sans-serif'],
      alt: ['Roboto', 'sans-serif'],
      icon: ['WMDE-Icons', 'serif'],
    },
    fontWeight: {
      light: 200,
      normal: 300,
      bold: 500,
    },
    letterSpacing: {
      tight: '-.25em',
      normal: '0',
      wide: '.0125em',
      wider: '.25em'
    },
    extend: {
      spacing: {
        'page-header': '50rem',
      },
      boxShadow: {
        'wmde': '0px 0px 15px 0px rgba(0,0,0,0.25)',
      }
    }
  },
  corePlugins: {
    aspectRatio: false,
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms'),
    require('tailwindcss-themer')({
      defaultTheme: {
        extend: {
          colors: { // generated with: https://uicolors.app/ ATTENTION: need to get rid of '50' quote signs…
            primary: {
              50: '#e5eeff',
              100: '#cfe0ff',
              200: '#a9c3ff',
              300: '#7599ff',
              400: '#3f5dff',
              500: '#1423ff',
              600: '#0008ff',
              700: '#0009ff',
              800: '#0008e3',
              DEFAULT: '#000068',
            },
          }
        }
      },
      themes: [
        {
          name: 'blue-scheme',
          extend: {
            colors: {
              primary: {
                50: '#e5eeff',
                100: '#cfe0ff',
                200: '#a9c3ff',
                300: '#7599ff',
                400: '#3f5dff',
                500: '#1423ff',
                600: '#0008ff',
                700: '#0009ff',
                800: '#0008e3',
                DEFAULT: '#000068',
              },
            }
          }
        },
        {
          name: 'red-scheme',
          extend: {
            colors: {
              primary: {
                50: '#fcf5f0',
                100: '#f9e7db',
                200: '#f2cdb6',
                300: '#eaab87',
                400: '#e08057',
                500: '#d96036',
                DEFAULT: '#d34e2f',
                700: '#a93825',
                800: '#872e25',
                900: '#6d2821',
              },
            }
          }
        },
        {
          name: 'orga-scheme',
          extend: {
            colors: {
              red: {
                DEFAULT: '#FA4A28',
              },
              cyan: {
                DEFAULT: '#00B9FF',
              },
              blue: {
                DEFAULT: '#3A25FF',
                200: '#EEEAFF'
              },
            }
          }
        }
      ]
      
    })
  ],
}
