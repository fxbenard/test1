//https://github.com/SaschaGalley/grunt-phpcs
module.exports = {
	application: {
		dir: ['*.php', '!node_modules/**', '!build/**',]
		},
		options: {

			standard: 'WordPress',
		}
};