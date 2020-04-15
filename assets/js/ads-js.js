jQuery(document).ready(function($) {

/* ==========================================================================
   Ads
   ========================================================================== */
   var icons = {
   		header: 'icon-caret',
   		activeHeader: 'icon-active-caret'
   }
   	// Tabs
   	$('#ads-wrapper').tabs();
   	$('.accordion')
   	.accordion({
   		icons: icons,
   		heightStyle: 'content'
   	})
   	.sortable({
   		axis: 'y',
   		handle: 'h3',
   		stop: function( event, ui ) {
          // IE doesn't register the blur when sorting
          // so trigger focusout handlers to remove .ui-state-focus
          ui.item.children( "h3" ).triggerHandler( "focusout" );

          // Refresh accordion to handle new order
          $( this ).accordion( "refresh" );
   		}
   	})

   	function resetCount(group) {
   		var name = group.replace('-', '_');

		var count = $('#' + group + ' .accordion-item').length;
		var i = 0; $('#' + group + ' .accordion-item').each(function() {
			$(this).attr('id', group + '-' + i + '-item-handle');
			$(this).text('Ad ' + (i + 1));
			i++;
		});

		var i = 0; $('#' + group + ' .ad-content').each(function() {
			$(this).attr('id', group + '-' + i + '-item-content');
			$(this).find('.image-block').attr('data-target', group + '-' + i);
			$(this).find('input[type="hidden"]').attr('id', group + '-' + i).attr('name', 'ba_' + name + '[ad][' + i + ']');
			$(this).find('.ad-link input[type="text"]').attr('id', group + '-' + i + '-url').attr('name', 'ba_' + name + '[url][' + i + ']');
			$(this).find('.button-remove').attr('id', 'ba_' + name + '_' + i).attr('data-target', group + '-' + i);
			i++;
		});

		$('#' + group + '-total').val(count);
		$('.accordion').accordion('refresh');
   	}

	// Delete ad details
	$(document).on('click', '.button-remove', function() {
		var target = $(this).attr('data-target');
		var group  = $(this).attr('data-group');
		var imgTarget = $('#' + target);
		var count = $('#' + group + ' .accordion-item').length;

		if (count == 1) {
			var linkTarget = $('#' + target + '-url');
			var vertTarget = $('#' + target + '-vertical-image');

			imgTarget.val('');
			imgTarget.parent().find('img').remove();
			vertTarget.parent().find('img').remove();
			linkTarget.val('');
			console.log(linkTarget);
		} else {
			$('#' + target + '-item-handle').remove();
			$('#' + target + '-item-content').remove();
		}


		resetCount(group);

		console.log(count);

	})

	$(document).on('click', '.button-add', function() {
		var group  = $(this).attr('data-group');
		var clone  = {
			handle: $('#' + group + ' .accordion-item').last().clone(),
			content: $('#' + group + ' .ad-content').last().clone()
		}

		clone.handle.removeClass().addClass('accordion-item');
		clone.content.find('img').remove();
		clone.content.find('input').val('');

		$('#' + group + ' .accordion').append(clone.handle).append(clone.content);


		resetCount(group);
	})

})