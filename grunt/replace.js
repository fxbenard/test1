module.exports = {
      readme_txt: {
        src: [ 'readme.txt' ],
        overwrite: true,
        replacements: [{
          from: /Stable tag: (.*)/,
          to: "Stable tag: <%= pkg.version %>"
        }]
      },
      main_php: {
        src: [ '<%= pkg.pot.src %>' ],
        overwrite: true,
        replacements: [{
          from: / Version:\s*(.*)/,
          to: " Version: <%= pkg.version %>"
        },{
          from: / Description:\s*(.*)/,
          to: " Description:     <%= pkg.description %>"
        },{
          from: / Text Domain:\s*(.*)/,
          to: " Text Domain:     <%= pkg.pot.textdomain %>"
        },{
          from: /'TEST_1_VERSION',\s*(.*)/,
              to: "'<%= pkg.constant.TEST_1 %>_VERSION', '<%= pkg.version %>' );"
    }]
      },
        all: {
        src: ['*.php', '**/*.php', '!node_modules/**/*.php', 'assets/js/*js', '!build/**/*'],
        overwrite: true,
        replacements: [{
          from: 'TEST_1',
          to: '<%= pkg.constant.TEST_1 %>'
        },{
          from: 'TEST1',
          to: '<%= pkg.constant.TEST1 %>'
        },{
          from: 'Test-1',
          to: 'Plugin-French'
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
          from: 'test-1',
          to: 'plugin-french'
        },{
          from: 'Test1Ajax',
          to: '<%= pkg.constant.Test1Ajax %>'
        },{
          from: 'spinner-test-1',
          to: 'spinner-plugin-french'
        }]
      }
    };