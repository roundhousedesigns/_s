/**
 * Portfolio grids + lightbox.
 */
var body = document.querySelector("body");
var container = document.querySelector(".portfolio-grid-container");
var navbar = document.querySelector(".site-header");
var grid = container.querySelector(".portfolio-grid");
var gridSizer = grid.querySelector(".grid-sizer");
var gridItems = grid.querySelectorAll(".portfolio-grid__item");
var close = container.querySelector(".item-close");

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

var activeItemHeight, msnry, lightbox, desc, heading;

document.addEventListener("DOMContentLoaded", function () {
	setItemHeight();
});

window.onresize = function () {
	setItemHeight();
};

function closeAllItems(e) {
	gridItems.forEach(function (item) {
		item.classList.remove("active");
		item.style.height = "";
	});

	container.classList.remove("item-active");

	if (lightbox) {
		lightbox.destroy();
	}
}

function setItemHeight() {
	activeItemHeight =
		document.documentElement.clientHeight - navbar.clientHeight + "px";
}

/**
 * Sets HTML elements for the lightbox
 *
 * @param {Object} Item node
 * @returns {string} Custom lightbox HTML
 */
function setCustomLightboxHTMLElements(item) {
	let html = customLightboxHTML;
	desc = item.querySelector(".portfolio-item-description").innerHTML;
	heading = item.querySelector(".portfolio-item-heading").innerHTML;

	html = heading
		? html.replace("%HEADING%", heading)
		: html.replace("%HEADING%", "");

	html = desc
		? html.replace("%DESCRIPTION%", desc)
		: html.replace("%DESCRIPTION%", "");

	return html;
}

/**
 *
 * @param {HTMLElement} elem The child element.
 * @param {string}      selector The ancestor selector.
 * @returns {HTMLElement} The found ancestor, or null if not found.
 */
var getClosest = function (elem, selector) {
	for (; elem && elem !== document; elem = elem.parentNode) {
		if (elem.matches(selector)) return elem;
	}
	return null;
};

var imgLoad = imagesLoaded(grid);
imgLoad.on("progress", function (instance, image) {
	let item = getClosest(image.img, ".portfolio-grid__item");
	item.style.opacity = "1";
});

grid.addEventListener("click", function (e) {
	// don't proceed if item was not clicked on
	e.preventDefault();
	let item = e.target.closest("li");

	if (!item) {
		return;
	}

	closeAllItems();

	let lightboxHTML = setCustomLightboxHTMLElements(item);

	var gallery = item.querySelectorAll(".blocks-gallery-item");
	var content = [];

	gallery.forEach(function (i) {
		let href = i.querySelector("img").src;

		// In case we want to use image captions instead...
		// let caption = i.querySelector('figcaption');

		let description = `<h3>${heading}</h3>&nbsp;&nbsp;<p>${desc}</p>`;

		content.push({
			href,
			description,
		});
	});

	// simpleLightbox
	lightbox = new GLightbox({
		elements: content,
		lightboxHTML,
		skin: "clean",
		zoomable: false,
		moreLength: 80,
	});

	lightbox.on("open", () => {
		body.classList.add("glightbox-open");
	});

	lightbox.on("close", () => {
		body.classList.remove("glightbox-open");
	});

	lightbox.open();
});

close.addEventListener("click", function (e) {
	e.preventDefault();

	closeAllItems();
});
