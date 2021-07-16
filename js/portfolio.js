/**
 * Masonry implementation for Portfolio grids.
 */
var body = document.querySelector('body');
var container = document.querySelector('.portfolio-grid-container');
var navbar = document.querySelector('.site-header');
var grid = container.querySelector('.portfolio-grid');
var gridItems = grid.querySelectorAll('.portfolio-grid__item');
var close = container.querySelector('.item-close');

var desc = container.querySelector('.portfolio-item-description').innerHTML;
var heading = container.querySelector('.portfolio-item-heading').innerHTML;

var customLightboxHTML = `<div id="glightbox-body" class="glightbox-container">
	<div class="gloader visible"></div>
	<div class="goverlay"></div>
	<div class="gcontainer">
	<div id="glightbox-slider" class="gslider">
		<div class="portfolio-description">
			<h3 class="portfolio-item-heading">%HEADING%</h3>
			<div class="portfolio-item-content">%DESCRIPTION%</div>
		</div>
	</div>
	<button class="gnext gbtn" tabindex="0" aria-label="Next" data-customattribute="example">{nextSVG}</button>
	<button class="gprev gbtn" tabindex="1" aria-label="Previous">{prevSVG}</button>
	<button class="gclose gbtn" tabindex="2" aria-label="Close">{closeSVG}</button>
	</div>
	</div>`;

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

/**
 * Sets HTML elements for the lightbox
 *
 * @returns {string} Custom lightbox HTML
 */
function setCustomLightboxHTMLElements() {
	let html = customLightboxHTML;

	html = heading
		? html.replace('%HEADING%', heading)
		: html.replace('%HEADING%', '');

	html = desc
		? html.replace('%DESCRIPTION%', desc)
		: html.replace('%DESCRIPTION%', '');

	return html;
}

var imgLoad = imagesLoaded(grid, function () {
	msnry = new Masonry(grid, {
		itemSelector: '.portfolio-grid__item',
		columnWidth: '.grid-sizer',
		gutter: 5,
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

	var gallery = item.querySelectorAll('.blocks-gallery-item');
	var content = [];

	gallery.forEach(function (i) {
		let href = i.querySelector('img').src;

		// In case we want to use image captions instead...
		// let caption = i.querySelector('figcaption');

		content.push({
			href,
			description: desc ? desc : '',
		});
	});

	let lightboxHTML = setCustomLightboxHTMLElements();

	// simpleLightbox
	lightbox = new GLightbox({
		elements: content,
		lightboxHTML,
		skin: 'clean',
		zoomable: false,
	});

	lightbox.on('open', () => {
		body.classList.add('glightbox-open');
	});

	lightbox.on('close', () => {
		body.classList.remove('glightbox-open');
	});

	lightbox.open();
});

close.addEventListener('click', function (e) {
	e.preventDefault();

	closeAllItems();
});
