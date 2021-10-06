/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function () {
	// Site title and description.
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			document.querySelector('.site-title a').innerHTML = to;
		});
	});

	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			document.querySelector('.site-description').innerHTML = to;
		});
	});

	// Header text color.
	wp.customize('header_textcolor', function (value) {
		value.bind(function (to) {
			let sel1 = document.querySelector('.site-title, .site-description');
			let sel2 = document.querySelector('.site-title a, .site-description');

			if ('blank' === to) {
				sel1.style = {
					...sel1.style,
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				};
			} else {
				sel1.style = {
					...sel1.style,
					clip: 'auto',
					position: 'relative',
				};

				sel2.style.color = to;
			}
		});
	});
})();
