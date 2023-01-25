module.exports = {
	content: ['./**/*.php'],
	theme: {
		// Helper pixel to rem calc: https://nekocalc.com/de/px-zu-rem-umrechner
		fontSize: {
			xs: '0.625rem', // 10px
			sm: '0.875rem', // 14px
			base: '1rem', // 16px
			lg: '1.25rem', // 20px
			xl: '1.5rem', // 24px
			'2xl': '2rem', // 32px
			'3xl': '2.5rem', // 40px
			'4xl': '3.75rem', // 60px
		},
		fontFamily: {
			sans: ['Arial', 'sans-serif'],
			//mono: ['Roboto Mono', 'serif'],
			//serif: ['Roboto Serif', 'serif'],
		},
		fontWeight: {
			light: 200,
			normal: 300,
			medium: 400,
			bold: 500,
		},
	},
	corePlugins: {
		aspectRatio: false,
	},
	plugins: [
		require('@tailwindcss/aspect-ratio'),
		require('@tailwindcss/forms'),
		require('tailwindcss-themer')({
		  defaultTheme: {
			// put the default values of any config you want themed
			// just as if you were to extend tailwind's theme like normal https://tailwindcss.com/docs/theme#extending-the-default-theme
			extend: {
			  // colors is used here for demonstration purposes
			  colors: {
				primary: {
					'50': '#f7f7f7',
					'100': '#e3e3e3',
					'200': '#c8c8c8',
					'300': '#a4a4a4',
					'400': '#818181',
					'500': '#666666',
					'600': '#515151',
					'700': '#434343',
					'800': '#383838',
					DEFAULT: '#000000',
				},
				secondary: {
					DEFAULT: '#f7f7f7',
					'100': '#e3e3e3',
					'200': '#c8c8c8',
					'300': '#a4a4a4',
					'400': '#818181',
					'500': '#666666',
					'600': '#515151',
					'700': '#434343',
					'800': '#383838',
					'900': '#000000',	
				},
				focus: {
					'50': '#e7f6ff',
					'100': '#d3efff',
					'200': '#b0dfff',
					'300': '#81c8ff',
					'400': '#4fa1ff',
					DEFAULT: '#2878ff',
					'600': '#044bff',
					'700': '#0049ff',
					'800': '#0038c4',
					'900': '#0b3aa4',
				}
			  }
			}
		  },
		  // if needed add custom themes here…
		  // themes: [
			// {
			//   name: 'my-theme',
			//   extend: {
			// 	colors: {
			// 	  primary: 'blue'
			// 	}
			//   }
			// }
		  // ]
		})
	],
};
