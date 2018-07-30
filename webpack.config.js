require('./node_modules/laravel-mix/src/index');
require(Mix.paths.mix());
Mix.dispatch('init', Mix);
let WebpackConfig = require('./node_modules/laravel-mix/src/builder/WebpackConfig');
module.exports = new WebpackConfig().build();
