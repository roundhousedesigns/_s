/**
 * File frontend.js.
 *
 * Handles frontend visuals.
 *
 * @uses siema
 * @package RHD
 */

(function () {
	var allItems = document.querySelectorAll('.siema');
	var carousels = [];
	[...allItems].forEach((item) => {
		const prev = item.querySelector('.siema-nav__prev');
		const next = item.querySelector('.siema-nav__next');
		const list = item.querySelector('.post-items');

		prev.addEventListener('click', (e) => {
			e.preventDefault();
			mySiema.prev();
		});
		next.addEventListener('click', (e) => {
			e.preventDefault();
			mySiema.next();
		});

		const mySiema = new Siema({
			selector: list,
			perPage: {
				460: 1,
				768: 2,
				1024: 3,
				1200: 4,
			},
		});
	});
})();
