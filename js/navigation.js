/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
	const siteNavigation = document.getElementById('site-navigation');
	const page = document.getElementById('page');
	var menuOpen = false;

	// Return early if the navigation don't exist.
	if (!siteNavigation) {
		return;
	}

	const button = document.getElementById('hamburger');

	// Return early if the button don't exist.
	if ('undefined' === typeof button) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName('ul')[0];

	// Hide menu toggle button if menu is empty and return early.
	if ('undefined' === typeof menu) {
		button.style.display = 'none';
		return;
	}

	if (!menu.classList.contains('nav-menu')) {
		menu.classList.add('nav-menu');
	}

	function openMenu() {
		siteNavigation.classList.add('toggled');
		button.setAttribute('aria-expanded', 'true');
		button.classList.add('toggled');
		page.classList.add('menu-toggled');

		menuOpen = true;
	}

	function closeMenu() {
		siteNavigation.classList.remove('toggled');
		button.setAttribute('aria-expanded', 'false');
		button.classList.remove('toggled');
		page.classList.remove('menu-toggled');

		menuOpen = false;
	}

	document.addEventListener('click', function (event) {
		const isClickButton = button.contains(event.target);
		const isClickNav = siteNavigation.contains(event.target);

		if (isClickButton) {
			if (menuOpen === false) {
				openMenu();
			} else {
				closeMenu();
			}
		}

		if (!isClickNav && !isClickButton) {
			closeMenu();
		}
	});

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName('a');

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll(
		'.menu-item-has-children > a, .page_item_has_children > a'
	);

	// Toggle focus each time a menu link is focused or blurred.
	for (const link of links) {
		link.addEventListener('focus', toggleFocus, true);
		link.addEventListener('blur', toggleFocus, true);
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for (const link of linksWithChildren) {
		link.addEventListener('touchstart', toggleFocus, false);
		link.addEventListener('click', toggleSubMenu, false);
	}

	/**
	 * Opens and closes a sub-menu
	 */
	function toggleSubMenu(event) {
		event.preventDefault();

		let self = this;
		let parent = self.parentNode;

		// Get the nearest ancestor menu item
		if ('li' === parent.tagName.toLowerCase()) {
			parent.classList.toggle('menu-active');
		}
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus(event) {
		if (event.type === 'focus' || event.type === 'blur') {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while (!self.classList.contains('nav-menu')) {
				// On li elements toggle the class .focus.
				if ('li' === self.tagName.toLowerCase()) {
					self.classList.toggle('focus');
				}
				self = self.parentNode;
			}
		}

		if (event.type === 'touchstart') {
			const menuItem = this.parentNode;
			event.preventDefault();
			for (const link of menuItem.parentNode.children) {
				if (menuItem !== link) {
					link.classList.remove('focus');
				}
			}
			menuItem.classList.toggle('focus');
		}
	}
})();
