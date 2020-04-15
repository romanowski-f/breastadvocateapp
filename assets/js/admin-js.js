function order(list) {
	imageIDs = [];
	jQuery('#' + list + ' li').each(function() {
		var el 		= jQuery(this).attr('data-id');
		imageIDs.push(el);
	})
	jQuery('#gallery-items').val(imageIDs);
}

jQuery(document).ready(function($) {

/* ==========================================================================
   Screenshot Gallery
   ========================================================================== */

	// Enable sortable jQuery UI elements
	if (('.sortable').length) {
		$('.sortable').sortable({
			revert: true,
			placeholder: 'item-placeholder',
			items: 'li:not(.delete)',
			tolerance: 'pointer',
			update: function() {
				var thisID = $(this).attr('id');
				order(thisID);
			}
		});
	}

	// Delete gallery item
	$(document).on('click', '.delete', function() {
		var list = $(this).parent().parent().attr('id');
		$(this).parent().remove();
		order(list);
	})

})