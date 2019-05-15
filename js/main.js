jQuery("a").on('click', function() {
	jQuery('a').removeClass('current');
	var result = jQuery(this).attr('data-filter');
	jQuery(this).addClass('current');
	console.log(result);
	jQuery('div.col-lg-4').hide();
	if (result == '*') {
		jQuery(`div.col-lg-4`).closest('div').fadeIn();
	} else {
		jQuery(`${result}`).closest('div').fadeIn();
	}
})

jQuery(document).ready(function() {
	// executes when complete page is fully loaded, including all frames, objects and images
	setTimeout(() => {
		jQuery('.loader').fadeOut();
	}, 1500);
});