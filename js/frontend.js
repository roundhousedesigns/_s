(function () {
	const seriesGallery = document.querySelector('.programming-series-gallery');

	if (seriesGallery) {
		const items = seriesGallery.querySelectorAll(
			'.blocks-gallery-grid .blocks-gallery-item'
		);

		var i = 0;
		[...items].forEach((item) => {
			const caption = item.querySelector('figcaption');
			const a = item.querySelector('a');
			if (a) {
				const href = a.href;

				caption.innerHTML = `<a href="${href}" rel="bookmark">${caption.innerHTML}</a>`;
			}
			i++;
		});
	}
})();
