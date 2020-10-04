module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
  ],
  theme: {
    screens: {
      xs: '380px', // This is mostly to support a smaller search header!
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
    },
    fontFamily: {
      display: ['-apple-system', 'BlinkMacSystemFont', "Segoe UI", 'Roboto', 'Oxygen-Sans', 'Ubuntu', 'Cantarell', "Helvetica Neue", 'sans-serif'],
      body: ['-apple-system', 'BlinkMacSystemFont', "Segoe UI", 'Roboto', 'Oxygen-Sans', 'Ubuntu', 'Cantarell', "Helvetica Neue", 'sans-serif'],
    },
    borderWidth: {
      default: '1px',
      '0': '0',
      '2': '2px',
      '4': '4px',
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',

      black: '#000',
      white: '#fff',

      gray: {
        100: '#F6FAFB',
        200: '#ECF3F6',
        300: '#E0EAEE',
        400: '#C8D7DD',
        500: '#9BB2BB',
        600: '#5F7680',
        700: '#445962',
        800: '#283B43',
        900: '#162328',
      },
      blue: {
        100: '#EBF8FF',
        200: '#BAEAFF',
        300: '#68CFF7',
        400: '#30B8F2',
        500: '#00AAEE',
        600: '#0099D1',
        700: '#007EA8',
        800: '#00345C',
        900: '#00204A',
      },
      red: {
        500: '#FA2A4D',
        600: '#DE0D2D',
        700: '#B50015',
        800: '#870005',
        900: '#520300',
      },
      purple: {
        500: '#9C0280',
        700: '#4A00AA',
      },
    },
    boxShadow: {
      xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
      sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
      default: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
      md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
      lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      focus: '0 0 0 2px #30B8F2',
      none: 'none',
    },
    extend: {
      spacing: {
        '96': '24rem',
        '128': '32rem',
      }
    },
  },
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
  purge: {
    enabled: true,
    content: [
    './app/**/*.php',
    './public/scripts/**/*.js'
  ]
  },
}
