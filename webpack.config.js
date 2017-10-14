const path = require('path');

const webpack = require('webpack');

const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

let sourceDir = path.resolve(__dirname, './src/js');

let config = {
	context: path.resolve(__dirname, './src/js'), 
	entry: ('./index.js'),
	output: {
		filename: 'bundle.js',
		path: path.resolve(__dirname, './assets/js')
	},
	externals: {
		jquery: 'jQuery'
	},
	module: {
		rules: []
	},
	plugins: [
	]
};

let isWin = /^win/.test(process.platform);
if (isWin) {
	config.plugins.push(new UglifyJSPlugin());
}

// babel loader rule
config.module.rules.push({
	test: /\.js$/,
	exclude: /node_modules/,
	use: {
		loader: 'babel-loader',
		options: {
			cacheDirectory: true,
			presets: [
				['env', {
					targets: {
						browsers: [
							"last 2 versions", 
							"safari >= 7"
						]
					}
				}]
			]
		}
	}
});

// pug loader
config.module.rules.push({
	test: /\.pug/,
	loaders: ['html-loader', 'pug-html-loader']
});

// no emit plugin
config.plugins.push(new webpack.NoEmitOnErrorsPlugin());

// uglify plugin
if ('production' === process.env.NODE_ENV) {
	config.plugins.push(new webpack.optimize.UglifyJsPlugin({sourceMap: true}));
}

module.exports = config;
