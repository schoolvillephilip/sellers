// price slider
$("#price-slider").ionRangeSlider({
	min: 130,
	max: 575,
	type: 'double',
	prefix: "$",
	prettify: false,
	hasGrid: false
});

$('#jqzoom').jqzoom({
	zoomType: 'standard',
	lens: true,
	preloadImages: false,
	alwaysOn: false,
	zoomWidth: 460,
	zoomHeight: 460,
	// xOffset:390,
	yOffset: 0,
	position: 'left'
});


$('.owl-carousel').each(function () {
	$(this).owlCarousel();
});


// Lighbox gallery
$('#popup-gallery').each(function () {
	$(this).magnificPopup({
		delegate: 'a.popup-gallery-image',
		type: 'image',
		gallery: {
			enabled: true
		}
	});
});

// Lighbox image
$('.popup-image').magnificPopup({
	type: 'image'
});

// Lighbox text
$('.popup-text').magnificPopup({
	removalDelay: 500,
	closeBtnInside: true,
	callbacks: {
		beforeOpen: function () {
			this.st.mainClass = this.st.el.attr('data-effect');
		}
	},
	midClick: true
});


$(".product-page-qty-plus").on('click', function () {
	var currentVal = parseInt($(this).prev(".product-page-qty-input").val(), 10);

	if (!currentVal || currentVal == "" || currentVal == "NaN") currentVal = 0;

	$(this).prev(".product-page-qty-input").val(currentVal + 1);
});

$(".product-page-qty-minus").on('click', function () {
	var currentVal = parseInt($(this).next(".product-page-qty-input").val(), 10);
	if (currentVal == "NaN") currentVal = 1;
	if (currentVal > 1) {
		$(this).next(".product-page-qty-input").val(currentVal - 1);
	}
});


/*
* Notification message
* Notification types : ['success', 'error', 'warning']
* */

function notification_message(msg, icon = 'fa fa-info-circle', notification_type = '') {
	let background = '#408d47';
	let color = '#fff';
	switch (notification_type) {
		case 'success':
			background = '#408d47';
			break;
		case 'error':
			background = '#ce3f39';
			break;
		case 'warning':
			background = '#f9dc1b';
			color = '#181818';
			break;
		default:
			break
	}
	$('body').append(`
		<div class="notification" style="background: ${background}; color: ${color}">
			<i class="${icon}" aria-hidden="true"></i> ${msg}
		</div>
	`);
	$(".notification").delay(5000).fadeOut();
}
