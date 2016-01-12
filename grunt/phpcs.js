//https://github.com/SaschaGalley/grunt-phpcs
module.exports = {
	application: {
		dir: ['*.php', '!node_modules/**', '!build/**',]
		},
		options: {
			bin: 'phpcs',
			standard: 'WordPress',
		}
};