//https://github.com/gruntjs/grunt-contrib-clean
module.exports = {
	init: ["languages/**/*"],
	build: ['build/<%= pkg.name %>']
};