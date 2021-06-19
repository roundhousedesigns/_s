/**
 * Serious Slider plugin customization
 */

(function () {
	let group = document.querySelector('.wp-block-group.home-slider');
	let slideImages = group.querySelectorAll('.item');

	slideImages.forEach((e) => {
		let image = e.querySelector('.item-image');
		let overlay = '<div class="overlay"></div>';
		image.insertAdjacentHTML('beforebegin', overlay);
	});
})();
