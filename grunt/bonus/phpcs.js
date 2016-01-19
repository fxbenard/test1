//https://github.com/SaschaGalley/grunt-phpcs
module.exports = {
	application: {
		dir: ['**/*.php', '!node_modules/**', '!build/**', '!phpcs/**', '!wpcs/**']
		},
		options: {
			bin: 'phpcs/scripts/phpcs',
			verbose: true,
			 showSniffCodes: true,
			 standard: 'WordPress'
		}
};