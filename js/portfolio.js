/**
 * Masonry implementation for Portfolio grids.
 */
var container = document.querySelector('.portfolio-grid-container');
var navbar = document.querySelector('.site-header');
var grid = container.querySelector('.portfolio-grid');
var gridItems = grid.querySelectorAll('.portfolio-grid__item');
var close = container.querySelector('.item-close');

var activeItemHeight, msnry, lightbox;

document.addEventListener('DOMContentLoaded', function () {
	setItemHeight();
});

window.onresize = function () {
	setItemHeight();
};

function closeAllItems(e) {
	gridItems.forEach(function (item) {
		item.classList.remove('active');
		item.style.height = '';
	});

	container.classList.remove('item-active');

	if (lightbox) {
		lightbox.destroy();
	}
}

function setItemHeight() {
	activeItemHeight =
		document.documentElement.clientHeight - navbar.clientHeight + 'px';
}

var imgLoad = imagesLoaded(grid, function () {
	msnry = new Masonry(grid, {
		itemSelector: '.portfolio-grid__item',
		columnWidth: '.grid-sizer',
		gutter: 5
	});
});

grid.addEventListener('click', function (e) {
	// don't proceed if item was not clicked on
	e.preventDefault();
	let item = e.target.closest('li');

	if (!item) {
		return;
	}

	closeAllItems();

	// container.classList.add('item-active');
	// item.classList.add('active');
	// item.style.height = activeItemHeight;

	var gallery = item.querySelectorAll('.blocks-gallery-item');
	var content = [];
	gallery.forEach(function (i) {
		let href = i.querySelector('img').src;
		let caption = i.querySelector('figcaption');
		content.push({
			href,
			description: caption ? caption.textContent : '',
		});
	});

	//  simpleLightbox
	lightbox = new GLightbox({
		elements: content,
		// skin: 'portfolio',
		loop: true,
		moreLength: 0,
	});

	// console.log(lightbox);
	lightbox.open();

	// // trigger re-layout
	// msnry.layout();
});

close.addEventListener('click', function (e) {
	e.preventDefault();

	closeAllItems();
});
