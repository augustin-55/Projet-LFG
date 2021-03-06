var Encore = require('@symfony/webpack-encore');

Encore
  // the project directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // the public path used by the web server to access the previous directory
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  // uncomment to create hashed filenames (e.g. app.abc123.css)
  // .enableVersioning(Encore.isProduction())

  // uncomment to define the assets of the project
  .addEntry('js/app', './assets/js/app.js')
  .addStyleEntry('css/app', './assets/scss/app.scss')
  .addStyleEntry('css/base', './assets/scss/base.scss')
  .addStyleEntry('css/profile', './assets/scss/profile.scss')
  .addStyleEntry('css/admin', './assets/scss/admin.scss')
  .addStyleEntry('css/base_responsive', './assets/scss/base_responsive.scss')
  .addStyleEntry('css/base_responsive_smartphone', './assets/scss/base_responsive_smartphone.scss')

  // uncomment if you use Sass/SCSS files
  .enableSassLoader()

  // uncomment for legacy applications that require $/jQuery as a global variable
  .autoProvidejQuery({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery'
  });

module.exports = Encore.getWebpackConfig();
