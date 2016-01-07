module.exports = {
      readme_txt: {
        src: [ 'readme.txt' ],
        overwrite: true,
        replacements: [{
          from: /Stable tag: (.*)/,
          to: "Stable tag: <%= pkg.version %>"
        },{
          from: 'test1',
          to: 'test2'
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
        }]
      },
        all: {
        src: ['*.php', '**/*.php', '!node_modules/**/*.php', 'assets/js/*js'],
        overwrite: true,
        replacements: [{
          from: 'TEST_2',
          to: '<%= pkg.constant.TEST_1 %>'
        },{
          from: 'TEST2',
          to: '<%= pkg.constant.TEST1 %>'
        },{
          from: 'Test-2',
          to: 'Plugin-French'
        },{
          from: 'Test2',
          to: '<%= pkg.slug %>'
        },{
          from: 'test2',
          to: '<%= pkg.pot.textdomain %>'
        },{
          from: 'test_2',
          to: '<%= pkg.constant.test_1 %>'
        },{
          from: 'test-2',
          to: 'plugin-french'
        },{
          from: 'Test2Ajax',
          to: '<%= pkg.constant.Test1Ajax %>'
        },{
          from: 'spinner-test-2',
          to: 'spinner-plugin-french'
        }]
      }
    };