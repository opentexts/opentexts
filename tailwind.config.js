module.exports = {
  theme: {
    screens: {
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
    },
    extend: {
      spacing: {
        '96': '24rem',
        '128': '32rem',
      }
    }
  }
}
