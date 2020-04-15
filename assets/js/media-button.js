/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){

// Instantiates the variable that holds the media library frame.
var meta_image_frame;
var thisInput;
var prevType;
var newType;
if ($('#gallery-items').length != '') {
    imageIDs = $('#gallery-items').val();
    imageIDs = imageIDs.split(',');
    console.log(imageIDs);
}




$(document).on('click', '.button-add-media, .change-image', function(e){
    e.preventDefault();
    var target = $(this).attr('data-target');
    var type = $(this).attr('data-type');
    var multiple = $(this).attr('data-multiple');
    mediaLibrary(type, target, multiple);
});

function mediaLibrary(type, targetInput, multiple) {
    target = targetInput;
    targetInput = $('#' + targetInput);
    newType = type;

    console.log('Target: ' + targetInput.attr('id'));

    // If the frame already exists, re-open it.
    if ( meta_image_frame && newType == prevType ) {
        meta_image_frame.open();
        return;
    }

    // Sets up the media library frame
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: badv_media.title,
        multiple: multiple,
        button: { text:  badv_media.button },
        library: { type: type }
    });

    // Runs when an image is selected.
    meta_image_frame.on('select', function(){

        // Grabs the attachment selection and creates a JSON representation of the model.
        var media_attachment = meta_image_frame.state().get('selection');//.first().toJSON();

        media_attachment.map(function(attachment) {
            attachment = attachment.toJSON();

            switch (target) {
                case 'gallery-items':
                    imageIDs.push(attachment.id);
                    targetInput.val(imageIDs);
                    $('.image-gallery-container').append('<li class="gallery-item" style="background: url(' + attachment.url + ') center no-repeat; background-size: cover;" data-id="' + attachment.id + '"><div class="delete"><i class="fas fa-times"></i></div></li>');
                break;

                default:
                    var finalTarget = $('#' + target);
                    finalTarget.val(attachment.id);
                    var img = finalTarget.parent().find('img');
                    console.log(finalTarget.attr('id'));
                    if (img.length != 0) {
                        img.attr('src', attachment.url);
                    } else {
                        targetInput.parent().prepend('<img src="' + attachment.url + '">');
                    }

                break;

            }
        })

    });

    // Opens the media library frame.
    meta_image_frame.open();
    prevType = type;

}
});