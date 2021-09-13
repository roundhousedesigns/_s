(function () {
	const seriesGallery = document.querySelector('.programming-series-gallery');

	if (seriesGallery) {
		const items = seriesGallery.querySelectorAll(
			'.blocks-gallery-grid .blocks-gallery-item'
		);

		[...items].forEach((item) => {
			const caption = item.querySelector('figcaption');
			const href = item.querySelector('a').href;

			caption.innerHTML = `<a href="${href}" rel="bookmark">${caption.innerHTML}</a>`;
		});
	}
})();
