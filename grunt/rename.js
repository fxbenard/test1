//https://github.com/jasonlam604/grunt-contrib-rename
module.exports = {
  main: {
    src: 'test1.php',
    dest: '<%= pkg.pot.src %>',
  },
  classes: {
    src: 'inc/classes/TEST_1_Plugin_Updater.php',
    dest: 'inc/classes/<%= pkg.constant.TEST_1 %>' + '_Plugin_Updater.php',
  }
};