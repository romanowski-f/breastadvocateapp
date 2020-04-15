<?php

/*
*
*
*
*
*/
// -------------------------------------------------------------- //
// ----------------------- Front Page --------------------------- //
// -------------------------------------------------------------- //

function front_page_settings() {
   // only add this meta box to the page selected as front page:
   global $post;
   $frontpage_id = get_option('page_on_front');
   if($post->ID == $frontpage_id):
   	  remove_post_type_support( 'page', 'editor' );
   	  add_meta_box('ba_content_box', 'Call to Action text', 'ba_build_content_box', 'page', 'normal', 'core');
   	  add_meta_box('ba_ctaside_box', 'Above-the-Fold Sidebar content', 'ba_build_ctaside_box', 'page', 'normal', 'core');
   	  add_meta_box('ba_about_box', 'About section text', 'ba_build_about_box', 'page', 'normal', 'core');
   	  add_meta_box('ba_popup_box', 'Download reminder popup text', 'ba_build_popup_box', 'page', 'normal', 'core');
   	  remove_meta_box( 'meta-box-page-options', 'page', 'normal' );
   endif;
}

function ba_build_content_box( $post ) {
	wp_nonce_field(basename(__FILE__), 'ba_nonce');

	$cta = get_post_meta($post->ID, 'ba_cta_editor', true);


	$editor_settings = array(
						'media_buttons' => false,
						'textarea_rows' => 7,
						'wpautop' 		=> false
					);

	$about = get_post_meta($post->ID, 'ba_cta_editor', true);
	wp_editor($cta, 'ba_cta_editor', $editor_settings);


	$android_link = get_post_meta($post->ID, 'android_link', true);
	$android_enabled = get_post_meta($post->ID, 'android_enabled', true);
	$iphone_link  = get_post_meta($post->ID, 'iphone_link', true);
	$iphone_enabled = get_post_meta($post->ID, 'iphone_enabled', true);
	$coming_soon  = get_post_meta($post->ID, 'coming_soon', true);
	$coming_soon_enabled  = get_post_meta($post->ID, 'coming_soon_enabled', true);
	?>

    <table style="width: 100%; margin-top:30px">
        <tr>
            <td style="padding:10px 0;"><label for="company-link"><strong>Android Download Link</strong></label></td>
            <td><input style="width: 100%; max-width: 500px;" type="text" id="android-link" name="android_link" value="<?php if (!empty($android_link)) : echo $android_link; endif; ?>"></td>
       		<td><label for="android-enable" class="enable">Enable <input type="checkbox" name="android_enabled" id="android-enable" value="true" <?php checked($android_enabled, 'true'); ?>></label></td>
        </tr>
        <tr>
            <td style="width: 175px; padding: 10px 0;"><label for="iphone-link"><strong>iPhone Download Link</strong></label></td>
            <td><input style="width: 100%; max-width: 500px;" type="text" id="iphone-link" name="iphone_link" value="<?php if (!empty($iphone_link)) : echo $iphone_link; endif; ?>"></td>
       		<td><label for="iphone-enable" class="enable">Enable <input type="checkbox" name="iphone_enabled" id="iphone-enable" value="true" <?php checked($iphone_enabled, 'true'); ?>></label></td>
        </tr>
        <tr>
            <td style="width: 175px; padding: 10px 0;"><label for="coming-soon"><strong>Coming Soon Text</strong></label></td>
            <td style="width: 525px;"><input style="width: 100%; max-width: 500px;" type="text" id="coming-soon" name="coming_soon" value="<?php if (!empty($coming_soon)) : echo $coming_soon; endif; ?>"></td>
       		<td><label for="coming-soon-enable" class="enable">Enable <input type="checkbox" name="coming_soon_enabled" id="coming-soon-enable" value="true" <?php checked($coming_soon_enabled, 'true'); ?>></label></td>
        </tr>
     </table>

   <?php
}

function ba_build_ctaside_box( $post ) {
	$first_module = array(
		'title' => get_post_meta($post->ID, 'module_title_1', true),
		'desc'  => get_post_meta($post->ID, 'module_text_1', true),
		'link'  => get_post_meta($post->ID, 'module_link_1', true),
		'video'  => get_post_meta($post->ID, 'module_video_link_1', true),
	);
	$second_module = array(
		'title' => get_post_meta($post->ID, 'module_title_2', true),
		'desc'  => get_post_meta($post->ID, 'module_text_2', true),
		'link'  => get_post_meta($post->ID, 'module_link_2', true),
		'video'  => get_post_meta($post->ID, 'module_video_link_2', true),
	);
	$third_module = array(
		'title' => get_post_meta($post->ID, 'module_title_3', true),
		'desc'  => get_post_meta($post->ID, 'module_text_3', true),
		'link'  => get_post_meta($post->ID, 'module_link_3', true),
		'video'  => get_post_meta($post->ID, 'module_video_link_3', true),
	);

	?>

	<div class="cta-side">
		<div class="cta-module">
			<input style="width: 100%;" type="text" name="module_title_1" placeholder="Title" value="<?php if (!empty($first_module['title'])) : echo $first_module['title']; endif; ?>">

			<textarea name="module_text_1"><?php if (!empty($first_module['desc'])) : echo $first_module['desc']; endif; ?></textarea>

			<input style="width: 100%; margin-top:20px" type="text" name="module_link_1" placeholder="Link" value="<?php if (!empty($first_module['link'])) : echo $first_module['link']; endif; ?>">
			<?php //$args = array('class'	=> 'page-id', 'name' => 'ba_pages[]', 'selected' => $pages[0]); ?>
			<?php //wp_dropdown_pages( $args ); ?>

			<div class="check-wrapper">
				<label for="mod-vid-link-1">Video <input type="checkbox" name="module_video_link_1" id="mod-vid-link-1" value="true" <?php checked($first_module['video'], 'true'); ?>></label>
			</div>

		</div>
		<div class="cta-module">
			<input style="width: 100%;" type="text" name="module_title_2" placeholder="Title" value="<?php if (!empty($second_module['title'])) : echo $second_module['title']; endif; ?>">

			<textarea name="module_text_2"><?php if (!empty($second_module['desc'])) : echo $second_module['desc']; endif; ?></textarea>

			<input style="width: 100%; margin-top:20px" type="text" name="module_link_2" placeholder="Link" value="<?php if (!empty($second_module['link'])) : echo $second_module['link']; endif; ?>">

			<?php //$args = array('class'	=> 'page-id', 'name' => 'ba_pages[]', 'selected' => $pages[0]); ?>
			<?php //wp_dropdown_pages( $args ); ?>

			<div class="check-wrapper">
				<label for="mod-vid-link-2">Video <input type="checkbox" name="module_video_link_2" id="mod-vid-link-2" value="true" <?php checked($second_module['video'], 'true'); ?>></label>
			</div>
		</div>
		<div class="cta-module">
			<input style="width: 100%;" type="text" name="module_title_3" placeholder="Title" value="<?php if (!empty($third_module['title'])) : echo $third_module['title']; endif; ?>">

			<textarea name="module_text_3"><?php if (!empty($third_module['desc'])) : echo $third_module['desc']; endif; ?></textarea>

			<input style="width: 100%; margin-top:20px" type="text" name="module_link_3" placeholder="Link" value="<?php if (!empty($third_module['link'])) : echo $third_module['link']; endif; ?>">

			<?php //$args = array('class'	=> 'page-id', 'name' => 'ba_pages[]', 'selected' => $pages[0]); ?>
			<?php //wp_dropdown_pages( $args ); ?>

			<div class="check-wrapper">
				<label for="mod-vid-link-3">Video <input type="checkbox" name="module_video_link_3" id="mod-vid-link-3" value="true" <?php checked($third_module['video'], 'true'); ?>></label>
			</div>
		</div>
	</div>

	<?php
}

function ba_build_about_box($post) {

	$editor_settings = array(
						'media_buttons' => false,
						'textarea_rows' => 9,
						'wpautop' 		=> false
					);

	wp_nonce_field(basename(__FILE__), 'ba_nonce');
	$about = get_post_meta($post->ID, 'ba_about_editor', true);
	wp_editor($about, 'ba_about_editor', $editor_settings);
}

function ba_build_popup_box($post) {

	$popup_enabled  = get_post_meta($post->ID, 'popup_enabled', true);

	?>  <label for="popup-enable" class="enable" style="width: 180px;">Enable Popup Reminder<input type="checkbox" name="popup_enabled" id="popup-enable" value="true" <?php checked($popup_enabled, 'true'); ?>></label> <?php

	$editor_settings = array(
						'media_buttons' => false,
						'textarea_rows' => 4,
						'wpautop' 		=> false
					);

	wp_nonce_field(basename(__FILE__), 'ba_nonce');
	$contact = get_post_meta($post->ID, 'ba_popup_editor', true);
	wp_editor($contact, 'ba_popup_editor', $editor_settings);
}

add_action( 'add_meta_boxes', 'front_page_settings' );


/*
*
*
*
*
*
*/
// Save data
add_action('save_post', 'save_front_page', 10, 2);

function save_front_page( $post_id ) {
	global $post;

	// Verify meta box nonce
	if ( !isset( $_POST['ba_nonce'] ) || !wp_verify_nonce( $_POST['ba_nonce'], basename(__FILE__) ) ) {
		return;
	}

	// Return if autosaving
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check user;s permissions
	if ( !current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$save_data = array(
		'ba_cta_editor',
		'ba_about_editor',
		'ba_popup_editor',
		'iphone_link',
		'android_link',
		'coming_soon',
	);

	// Save About content
	foreach($save_data as $data) {
		if ( isset( $_REQUEST[$data] ) ) {
			$editor = $_POST[$data];
			$old_editor_meta = get_post_meta($post->ID, $data, true);
			if ( $editor && $editor != $old_editor_meta ) {
				update_post_meta( $post->ID, $data, wp_kses_post( $editor ) );
			}
		}
	}

	// Update checkboxes
	$save_checkboxes = array(
		'coming_soon_enabled',
		'iphone_enabled',
		'android_enabled',
		'popup_enabled'
	);

	foreach($save_checkboxes as $data) {
		if ( isset ($_REQUEST[$data] ) ) {
			$checked = $_POST[$data];
			update_post_meta( $post->ID, $data, wp_kses_post( $checked ) );
		} else {
			update_post_meta( $post->ID, $data, wp_kses_post( 'false' ) );
		}
	}


	$modules = array(
		array('module_title_1', 'module_text_1', 'module_link_1', 'module_video_link_1'),
		array('module_title_2', 'module_text_2', 'module_link_2', 'module_video_link_2'),
		array('module_title_3', 'module_text_3', 'module_link_3', 'module_video_link_3'),
	);

	foreach($modules as $module) {
		foreach($module as $data) {
			if ( isset( $_REQUEST[$data] ) ) {
				$editor = $_POST[$data];
				$old_editor_meta = get_post_meta($post->ID, $data, true);
				if ( $editor && $editor != $old_editor_meta ) {
					update_post_meta( $post->ID, $data, wp_kses_post( $editor ) );
				}
			}
		}
	}

}

?>