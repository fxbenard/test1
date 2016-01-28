//https://github.com/yoniholmes/grunt-text-replace
module.exports = {
	readme_txt: {
		src: [ 'readme.txt' ],
		overwrite: true,
		replacements: [{
			from: /Tags: (.*)/,
			to: "Tags: <%= pkg.tags %>"
		},{
			from: /Tested up to: (.*)/,
			to: "Tested up to: <%= pkg.upto %>"
		},{
			from: /Stable tag: (.*)/,
			to: "Stable tag: <%= pkg.version %>"
		},]
	},
	main_init: {
		src: [ 'test1.php' ],
		overwrite: true,
		replacements: [{
			from: / Plugin Name:\s*(.*)/,
			to: " Plugin Name:      <%= pkg.slug %>"
		},{
			from: / Version:\s*(.*)/,
			to: " Version:      <%= pkg.version %>"
		},{
			from: / Description:\s*(.*)/,
			to: " Description:      <%= pkg.description %>"
		},{
			from: / Text Domain:\s*(.*)/,
			to: " Text Domain:      <%= pkg.pot.textdomain %>"
		},{
			from: /'TEST_1_VERSION',\s*(.*)/,
			to: "'<%= pkg.constant.TEST_1 %>_VERSION', '<%= pkg.version %>' );"
		},{
			from: /'TEST_1_ITEM_NICE_NAME',\s*(.*)/,
			to: "'<%= pkg.constant.TEST_1 %>_ITEM_NICE_NAME', '<%= pkg.nicename %>' );"
		},{
			from: /'TEST_1_ITEM_NAME',\s*(.*)/,
			to: "'<%= pkg.constant.TEST_1 %>_ITEM_NAME', '<%= pkg.slug %>' );"
		}]
	},
	all: {
		src: ['*.php', '**/*.php', 'assets/js/*.js', 'assets/css/*.css', '*.txt', '!build/**/*', '!node_modules/**/*.php'],
		overwrite: true,
		replacements: [{
			from: /Test\s1/,
			to: '<%= pkg.nicename %>'
		},{
			from: 'TEST_1',
			to: '<%= pkg.constant.TEST_1 %>'
		},{
			from: 'TEST1',
			to: '<%= pkg.constant.TEST1 %>'
		},{
			from: 'Test-1',
			to: '<%= pkg.constant.Test-1 %>'
		},{
			from: 'Test1',
			to: '<%= pkg.slug %>'
		},{
			from: 'test1',
			to: '<%= pkg.pot.textdomain %>'
		},{
			from: 'test_1',
			to: '<%= pkg.constant.test_1 %>'
		},{
			from: /test-1/,
			to: '<%= pkg.constant.test %>'
		},{
			from: 'test-1-',
			to: '<%= pkg.constant.test %>-'
		},{
			from: '-test-1',
			to: '-<%= pkg.constant.test %>'
		}]
	},
	main_bump: {
		src: [ '<%= pkg.pot.src %>' ],
		overwrite: true,
		replacements: [{
			from: / Version:\s*(.*)/,
			to: " Version:      <%= pkg.version %>"
		},{
			from: /(.*)_VERSION',\s*(.*)/,
			to: "define( '<%= pkg.constant.TEST_1 %>_VERSION', '<%= pkg.version %>' );"
		}]
	}
};
