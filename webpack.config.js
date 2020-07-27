const devMode = process.env.NODE_ENV !== 'production';

const path = require('path');
const globImporter = require('node-sass-glob-importer');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const RemovePlugin = require('remove-files-webpack-plugin');

const webpackConfig = {
  devtool: devMode ? 'source-map' : 'cheap-eval-source-map',
  entry: {
    './public/css/app': `./app/styles/app.pcss`,
  },
  output: {
    filename: '[name].js',
    path: path.join(__dirname),
    chunkFilename: '[name]-[chunkhash].js',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          'style-loader',
          'css-loader'
        ],
      },
      {
        test: /\.pcss$/,
        use: [
          // devMode ? 'style-loader' : MiniCssExtractPlugin.loader,
          MiniCssExtractPlugin.loader,
          'css-loader',
          'postcss-loader',
        ],
      },
      {
        test: /\.scss$/,
        use: [
          // devMode ? 'style-loader' : MiniCssExtractPlugin.loader,
          MiniCssExtractPlugin.loader,
          'css-loader',
          'postcss-loader',
          {
            loader: 'sass-loader',
            options: {
              sassOptions: { importer: globImporter() },
            },
          },
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
    }),
    new RemovePlugin({
      after: {
        include: [
          './public/css/app.js',
          './public/css/app.js.map',
        ]
      }
    })
  ],
  watch: devMode,
};

if (devMode) {
  webpackConfig.plugins.push(new LiveReloadPlugin({ delay: 20 }));
}

module.exports = webpackConfig;
