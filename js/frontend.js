/**
 * Frontend script.
 */

(function () {
	var products = document.querySelectorAll('.product-list .product');

	for (const product of products) {
		const excerpt = product.querySelector('.product-excerpt');
		const toggle = product.querySelector('.toggle');

		if (toggle) {
			toggle.addEventListener('click', (e) => {
				e.preventDefault();
				excerpt.classList.toggle('active');
			});
		}
	}
})();
