<?php

add_theme_support( 'post-thumbnails' );

/*
*
*
*
*
*/
// -------------------------------------------------------------- //
// ---------------------- Enqueue Media ------------------------- //
// -------------------------------------------------------------- //

add_action('wp_enqueue_scripts', 'badv_enqueue_media');

function badv_enqueue_media() {

	// ----------------------------- CSS ----------------------------- //

	// jQuery
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', false, null);
	wp_enqueue_script('jquery');

	// Animate.css
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '1.0.0');

	// Default Styles
	wp_enqueue_style('stylesheet', get_template_directory_uri() . '/style.css', array(), '2.0.03');

	// Font Awesome
	wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.0.12/css/all.css');

	//jQuery UI JS
	// wp_register_script('draggable', get_template_directory_uri() . '/assets/js/draggable/jquery-ui.min.js');
	// wp_enqueue_script('draggable');

	//jQuery UI JS touch event patch
	// wp_register_script('touch-punch', get_template_directory_uri() . '/assets/js/draggable/jquery.ui.touch-punch.min.js');
	// wp_enqueue_script('touch-punch');

	// Modernizr
	wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-custom.js');
	wp_enqueue_script('modernizr');

	// Body Scroll Lock
	//wp_enqueue_script('body-scroll-lock', get_template_directory_uri() . '/assets/node_modules/body-scroll-lock/lib/bodyScrollLock.js', array(), '1.0.0', true);

	// Main scripts
	wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.7.8', true);

	// Bio EP Popup
	wp_enqueue_script('popup-js', get_template_directory_uri() . '/assets/js/bioep.min.js', array(), '2.0.0', true);


}

// Dashboard styling and js
function badv_enqueue_admin_media() {
	// Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.
	wp_enqueue_media();

	wp_enqueue_script( 'wp-link' );

	// Font Awesome
	wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css');

	// Admin style
	wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/admin-styles.css', array(), '1.1.5');

	//jQuery UI JS
	wp_register_script('jquery-ui', get_template_directory_uri() . '/assets/js/draggable/jquery-ui.min.js');
	wp_enqueue_script('jquery-ui');

	//jQuery UI Styles
	wp_enqueue_style('jquery-ui-style', get_template_directory_uri() . '/assets/js/draggable/jquery-ui.min.css', array(), '1.0.0');

	//	Register and enqueue the meta-box-image.js script
	wp_register_script('media-button', get_template_directory_uri() . '/assets/js/media-button.js', array('jquery'), '1.1.0');
	wp_localize_script('media-button', 'badv_media',
		array(
			'title'		=> __('Choose or upload an image'),
			'button'	=> __('Select')
		)
	);
	wp_enqueue_script('media-button');

	//	Admin JS
	wp_register_script('badv-js', get_template_directory_uri() . '/assets/js/admin-js.js', array('jquery'), '1.1.0');
	wp_enqueue_script('badv-js');

}

add_action('admin_enqueue_scripts', 'badv_enqueue_admin_media');

/*
*
*
*
*
*
*
*
*
*/
// -------------------------------------------------------------- //
// --------------------- Options Page --------------------------- //
// -------------------------------------------------------------- //
//include(get_template_directory() . '/inc/options.php');

// -------------------------------------------------------------- //
// ---------------------- Front Page ---------------------------- //
// -------------------------------------------------------------- //
include(get_template_directory() . '/inc/front-page-content.php');

// -------------------------------------------------------------- //
// ----------------------- Ads Page ----------------------------- //
// -------------------------------------------------------------- //
include(get_template_directory() . '/inc/ads.php');

// -------------------------------------------------------------- //
// ------------------- Custom Post Types ------------------------ //
// -------------------------------------------------------------- //
include(get_template_directory() . '/inc/custom-post-types.php');

// -------------------------------------------------------------- //
// ------------------ Screenshots Slider ------------------------ //
// -------------------------------------------------------------- //
include(get_template_directory() . '/inc/screenshots-slider.php');

// -------------------------------------------------------------- //
// ---------------------- Nav Menus ----------------------------- //
// -------------------------------------------------------------- //
include(get_template_directory() . '/inc/menus.php');


/*
*
*
*
*
*
*
*
*
*/
/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return sprintf( '... <br /><br /><strong><a class="read-more modal" href="%1$s">%2$s</a></strong>',
        get_permalink( get_the_ID() ),
        __( 'Read More &raquo;', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


/*
*
*
*
*
*
*
*
*
*/
// -------------------------------------------------------------- //
// --------------------- Page Options --------------------------- //
// -------------------------------------------------------------- //
add_action( 'add_meta_boxes', 'meta_box_page_options' );

function meta_box_page_options()
{
    add_meta_box( 'meta-box-page-options', 'Page Options', 'page_options_callback', 'page', 'normal', 'high' );

   global $post;
   $frontpage_id = get_option('page_on_front');
   if($post->ID == $frontpage_id):
   	  remove_meta_box( 'meta-box-page-options', 'page', 'normal' );
   endif;
}

function page_options_callback( $post ) {
    // Nonce
    wp_nonce_field( basename(__FILE__), 'badv_nonce' );

    $header = get_post_meta($post->ID, 'page_option_header', true);
	?>

	<table>
	<tr>
		<td style="padding: 20px 0px;"><strong>Hide Header Text</strong></td>
		<td style="padding: 20px;"><input type="checkbox" name="page_option_header" value="true" style="display: block" <?php checked($header, 'true'); ?>></td>
	</tr>
	</table>

	<?php
}

/*
*
*
*
*
*
*
*
*
*/
// -------------------------------------------------------------- //
// -------------------- Save Page Options ----------------------- //
// -------------------------------------------------------------- //

add_action('save_post', 'save_page_options', 10, 2);

function save_page_options( $post_id ) {
    global $post;

    // Verify meta box nonce
    if ( !isset( $_POST['badv_nonce'] ) || !wp_verify_nonce( $_POST['badv_nonce'], basename(__FILE__) ) ) {
        return;
    }

    // Return if autosaving
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user's permissions
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $data = array(
        'page_option_header'
        );

    foreach($data as $input) {
        if ( isset( $_REQUEST[$input] ) ) {
            $new = $_POST[$input];
            $old = get_post_meta($post->ID, $input, true);
            if ($new && $new != $old) {
                update_post_meta( $post->ID, $input, wp_kses_post( $new ) );
            }
        } else if ($input == 'page_option_header') {
            update_post_meta( $post->ID, $input, 'false');
        }
    }

}

?>