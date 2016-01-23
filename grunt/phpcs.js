//https://github.com/SaschaGalley/grunt-phpcs
module.exports = {
	plugin: {
		src: ['**/*.php', '!node_modules/**', '!build/**', '!phpcs/**', '!wpcs/**']
		},
		options: {
			bin: 'phpcs',
			verbose: false,
			 showSniffCodes: false,
			 standard: 'WordPress'
		}
};