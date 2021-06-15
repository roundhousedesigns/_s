/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
	const searchContainer = document.getElementById('header-search');
	const toggle = searchContainer.getElementsByTagName('a')[0];
	const search = searchContainer.getElementsByTagName('form')[0];

	toggle.addEventListener('click', function (e) {
		e.preventDefault();

		searchContainer.classList.toggle('active');

		if (searchContainer.classList.contains('active')) {
			search.setAttribute('aria-expanded', 'true');
		} else {
			search.setAttribute('aria-expanded', 'false');
		}
	});
})();
