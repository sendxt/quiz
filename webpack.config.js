var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/assets/')
    .setPublicPath('/assets')
    .cleanupOutputBeforeBuild()
    .addEntry('main', './app/Resources/public/js/main.js')
    .addEntry('form/quiz', './app/Resources/public/js/quiz.js')
    .enableSassLoader(function(sassOptions) {}, {
        resolve_url_loader: false
    })
    .enableSourceMaps(!Encore.isProduction());

module.exports = Encore.getWebpackConfig();
