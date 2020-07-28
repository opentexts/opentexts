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
      cyan: '#00AAEE',
      darkCyan: '#0080AB',
      red: '#00345C',
      offWhite: '#F5F8FA',
      white: '#F5F8FA',
      slate: '#4A6370',
      cobalt: '#00345C',
      navy_alt: '#002643', // maybe nix this entirely
      navy: '#00204A', // For backgrounds and stuff
    },
    extend: {
      spacing: {
        '96': '24rem',
        '128': '32rem',
      }
    }
  }
}
