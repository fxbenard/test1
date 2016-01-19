// https://github.com/dylang/grunt-notify
module.exports = function (grunt) {
		// Return the configurations
		return {
			init: {
				options: {
					title: "Grunt Init",
					message: '"<%= pkg.name %>" is now ready!'
				}
			},
			bump: {
				options: {
					title: "Grunt Bump it Up",
					message: '"<%= pkg.slug %>" is now in version <%= pkg.version %>!'
				}
			},
			build: {
				options: {
					title: 'Grunt Built it',
					message: 'Version <%= pkg.version %> of "<%= pkg.slug %>" is waiting in "/build"!'
				}
			},
			i18n: {
				options: {
					title: 'Grunt Internationalized it',
					message: 'Version <%= pkg.version %> of "<%= pkg.slug %>" is ready for "l10n"!'
				}
			}
		};
	};