/**
 * Masonry implementation for Portfolio grids.
 */
var grid = document.querySelector('.portfolio-grid');
var gridItems = grid.querySelectorAll('.portfolio-grid__item');
var msnry;

var imgLoad = imagesLoaded(grid, function () {
	msnry = new Masonry(grid, {
		itemSelector: '.portfolio-grid__item',
		columnWidth: '.grid-sizer',
		gutter: 0,
	});
});

grid.addEventListener('click', function (e) {
	// don't proceed if item was not clicked on
	let item = e.target.closest('li');

	if (!matchesSelector(item, '.portfolio-grid__item')) {
		return;
	}

	gridItems.forEach(function (item) {
		item.classList.remove('active');
	});

	item.classList.toggle('active');
	// trigger layout
	msnry.layout();
});
