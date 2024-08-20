const plugin = require('tailwindcss/plugin');

module.exports = {
	content: ['./**/*.php'],
	safelist: [
		{
			pattern: /justify-/,
			variants: ['sm', 'md', 'lg'],
		},
		{
			pattern: /text-(xs|sm|lg|xl)/,
		},
		{
			pattern: /(bg|text|border)-(white|black|primary|secondary|neutral|accent|warning|success|error)/,
		},
	],
	theme: {
		screens: {
			xxs: '120px',
			xs: '320px',
			sm: '640px',
			md: '768px',
			lg: '1024px',
			xl: '1280px',
			'2xl': '1536px',
		},
		// Helper pixel to rem calc: https://nekocalc.com/de/px-zu-rem-umrechner
		fontSize: {
			xs: '0.75rem', // 12px
			sm: '0.875rem', // 14px
			base: '1rem', // 16px
			lg: '1.125rem', // 18px -> h6
			xl: '1.25rem', // 20px -> p, h5
			'2xl': '1.5rem', // 24px -> h4
			'3xl': '2rem', // 32px -> h3
			'4xl': '2.5rem', // 40px -> h2
			'5xl': '3.5rem', // 56px -> h1
			'6xl': '6rem', // 96px
			'3vw': '10vw',
		},
		fontFamily: {
			headings: ['Headings', 'sans-serif'],
			texts: ['Texts', 'sans-serif'],
		},
		fontWeight: {
			normal: 300,
			medium: 500,
			bold: 700,
		},
		extend: {
			dropShadow: {
				navbar: ['0px 3px 8px rgba(0, 0, 0, 0.24)'],
			},
			boxShadow: {
				xl: '0 0px 60px -15px rgba(0, 0, 0, 0.3)',
				navbar: '0 8px 30px rgb(0,0,0,0.12);',
				hard: '-10px 10px 0 0 rgb(0,0,0,1);',
			},
			maxWidth: {
				32: '8rem',
			},
			minHeight: {
				32: '8rem',
			},
			height: {
				specialscreen: 'calc(100vh - 5rem)',
			},
			maxHeight: {
				'screen-80': '80vh',
				'screen-1/2': '50vh',
				specialscreen: 'calc(100vh - 5rem)',
			},
			scale: {
				cards: '1.01',
			},
			containers: {
				'2xs': '13.125rem', // 210px
			},
		},
	},
	corePlugins: {
		aspectRatio: false,
	},
	plugins: [
		require('@tailwindcss/aspect-ratio'),
		require('@tailwindcss/container-queries'),
		// plugin(function ({ addBase }) {
		// 	addBase({
		// 		//				html: { fontSize: '6px' },
		// 	});
		// }),
		require('@tailwindcss/forms'),
		require('tailwindcss-themer')({
			defaultTheme: {
				extend: {
					colors: {
						black: {
							DEFAULT: 'black',
						},
						white: {
							DEFAULT: 'white',
						},
						primary: {
							light: '#0000ff',
							DEFAULT: '#000099',
							dark: '#000033',
						},
						secondary: {
							light: '#00ff00',
							DEFAULT: '#009900',
							dark: '#003300',
						},
						neutral: {
							light: '#F8f8f8',
							DEFAULT: '#F6F6F6',
							dark: '#a0a0a0',
						},
						accent: {
							light: '#2878ff',
							DEFAULT: '#2878ff',
							dark: '#2878ff',
						},
						error: {
							light: '#ffc9d4',
							DEFAULT: '#ff3164',
							dark: '#910a3d',
						},
						success: {
							light: '#edfcf4',
							DEFAULT: '#087951',
							dark: '#084c35',
						},
						warning: {
							light: '#fffaec',
							DEFAULT: '#ff7b00',
							dark: '#823b0c',
						},
					},
				},
			},
		}),
	],
};
