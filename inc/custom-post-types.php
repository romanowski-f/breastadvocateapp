<?php

//------------------------------------TESTIMONIALS
function badv_testimonials() {

    $badv_testimonial_labels = array(
        'name'               => __('Testimonials', 'badv'),
        'singular_name'      => __('Testimonial', 'badv'),
        'add_new'            => __('Add New Testimonial', 'badv'),
        'all_items'          => __('View Testimonials', 'badv'),
        'edit_item'          => __('Edit Testimonial', 'badv'),
        'add_new_item'       => __('New Testimonial', 'badv'),
        'view_item'          => __('Preview Testimonial', 'badv'),
        'search_items'       => __('Search Testimonials', 'badv'),
        'not_found'          => __('No Testimonial(s) Found', 'badv'),
        'not_found_in_trash' => __('No Testimonial(s) Found in Trash', 'badv'),
        'parent_item_colon'  => ''
      );

    $badv_testimonial_args = array(
        'labels'              => $badv_testimonial_labels,
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'query_var'           => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => null,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
      );

    register_post_type( 'testimonial', $badv_testimonial_args );

}

// initialization call
add_action( 'init', 'badv_testimonials' );

// Add meta boxes for Testimonials
add_action('add_meta_boxes_testimonial', 'testimonials_add_meta_box');

function testimonials_add_meta_box( $post ) {
    add_meta_box('testimonials_info', 'Additional Information', 'badv_build_info_box', 'testimonial', 'normal', 'high');
}

function badv_build_info_box( $post ) {
    // Nonce
    wp_nonce_field( basename(__FILE__), 'badv_nonce' );

    // Post Meta
    $featured       = get_post_meta($post->ID, 'featured_testimonial', true);
    $title          = get_post_meta($post->ID, 'company_position', true);
    $company_link   = get_post_meta($post->ID, 'company_link', true);
    $company_name   = get_post_meta($post->ID, 'company_name', true);

    ?>
    <table style="width: 100%">
        <tr>
            <td style="width: 175px; padding: 10px 0;"><label for="featured"><strong>Featured Testimonial</strong></label></td>
            <td><input type="checkbox" id="featured" name="featured_testimonial" value="true" <?php checked($featured, 'true'); ?>></td>
        </tr>
        <tr>
            <td style="width: 175px; padding: 10px 0;"><label for="company-name"><strong>Company</strong></label></td>
            <td><input style="width: 100%; max-width: 500px;" type="text" id="company-name" name="company_name" value="<?php if (!empty($company_name)) : echo $company_name; endif; ?>"></td>
        </tr>
        <tr>
            <td style="padding:10px 0;"><label for="company-link"><strong>Company Website URL</strong></label></td>
            <td><input style="width: 100%; max-width: 500px;" type="text" id="company-link" name="company_link" value="<?php if (!empty($company_link)) : echo $company_link; endif; ?>"></td>
        </tr>
        <tr>
            <td style="padding:10px 0;"><label for="company-position"><strong>Position/Title</strong></label></td>
            <td><input style="width: 100%; max-width: 500px;" type="text" id="company-position" name="company_position" value="<?php if (!empty($title)) : echo $title; endif; ?>"></td>
        </tr>
    </table>

    <?php
}


  //------------------------------------PARTNERS & RESOURCES
  function badv_partners() {

    $badv_partners_labels = array(
        'name'               => __('Partners & Resources', 'badv'),
        'singular_name'      => __('Partner', 'badv'),
        'add_new'            => __('Add New Partners', 'badv'),
        'all_items'          => __('View Partners', 'badv'),
        'edit_item'          => __('Edit Partners', 'badv'),
        'add_new_item'       => __('New Partners', 'badv'),
        'view_item'          => __('Preview Partners', 'badv'),
        'search_items'       => __('Search Partners', 'badv'),
        'not_found'          => __('No Partner(s) Found', 'badv'),
        'not_found_in_trash' => __('No Partner(s) Found in Trash', 'badv'),
        'parent_item_colon'  => ''
      );

    $badv_partners_args = array(
        'labels'              => $badv_partners_labels,
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'query_var'           => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => null,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
      );

    register_post_type( 'partners', $badv_partners_args );

  }

  // initialization call
  add_action( 'init', 'badv_partners' );

    // Add meta boxes for Partners
    add_action('add_meta_boxes_partners', 'partners_add_meta_box');

    function partners_add_meta_box( $post ) {
        add_meta_box('partners_info', 'Category', 'badv_build_partners_options_box', 'partners', 'side');
    }

    function badv_build_partners_options_box( $post ) {
        // Nonce
        wp_nonce_field( basename(__FILE__), 'badv_nonce' );

        $partners_cat = get_post_meta($post->ID, 'partners_cat', true);
        $sponsor_check; $partner_check;

        if (empty($partners_cat) || $partners_cat == 'sponsor')  : $sponsor_check = 'checked';
        else                                                     : $partner_check = 'checked';
        endif;
        ?>

        <ul class="categorychecklist form-no-clear">
            <li><label class="selectit"><input type="radio" value="sponsor" name="partners_cat" <?php echo $sponsor_check; ?>> Sponsor</label></li>
            <li><label class="selectit"><input type="radio" value="partner" name="partners_cat" <?php echo $partner_check; ?>> Patient Advocacy Partner</label></li>
        </ul>

        <?php
    }




//------------------------------------REAL LIFE STORIES

  function badv_stories() {

    $badv_stories_labels = array(
        'name'               => __('Real Life Stories', 'badv'),
        'singular_name'      => __('Story', 'badv'),
        'add_new'            => __('Add New Stories', 'badv'),
        'all_items'          => __('View Stories', 'badv'),
        'edit_item'          => __('Edit Stories', 'badv'),
        'add_new_item'       => __('New Stories', 'badv'),
        'view_item'          => __('Preview Stories', 'badv'),
        'search_items'       => __('Search Stories', 'badv'),
        'not_found'          => __('No Partner(s) Found', 'badv'),
        'not_found_in_trash' => __('No Partner(s) Found in Trash', 'badv'),
        'parent_item_colon'  => ''
      );

    $badv_stories_args = array(
        'labels'              => $badv_stories_labels,
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'query_var'           => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => null,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
      );

    register_post_type( 'stories', $badv_stories_args );

  }

  // initialization call
  add_action( 'init', 'badv_stories' );

// Add meta boxes for Testimonials
add_action('add_meta_boxes_stories', 'stories_add_meta_box');

function stories_add_meta_box( $post ) {
    add_meta_box('stories_info', 'Additional Information', 'badv_build_stories_info_box', 'stories', 'normal', 'high');
}

function badv_build_stories_info_box( $post ) {
    // Nonce
    wp_nonce_field( basename(__FILE__), 'badv_nonce' );

    // Post Meta
    $company_link   = get_post_meta($post->ID, 'company_link', true);
    $company_name   = get_post_meta($post->ID, 'company_name', true);

    ?>
    <table style="width: 100%">
        <tr>
            <td style="width: 175px; padding: 10px 0;"><label for="company-name"><strong>Website</strong></label></td>
            <td><input style="width: 100%; max-width: 500px;" type="text" id="company-name" name="company_name" value="<?php if (!empty($company_name)) : echo $company_name; endif; ?>"></td>
        </tr>
        <tr>
            <td style="padding:10px 0;"><label for="company-link"><strong>Website URL</strong></label></td>
            <td><input style="width: 100%; max-width: 500px;" type="text" id="company-link" name="company_link" value="<?php if (!empty($company_link)) : echo $company_link; endif; ?>"></td>
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
// ----------------------- Save Data ---------------------------- //
// -------------------------------------------------------------- //

add_action('save_post', 'save_custom_posts', 10, 2);

function save_custom_posts( $post_id ) {
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
        'featured_testimonial',
        'company_link',
        'company_name',
        'company_position',
        'page_option_header',
        'partners_cat'
        );

    foreach($data as $input) {
        if ( isset( $_REQUEST[$input] ) ) {
            $new = $_POST[$input];
            $old = get_post_meta($post->ID, $input, true);
            if ($new && $new != $old) {
                update_post_meta( $post->ID, $input, wp_kses_post( $new ) );
            }
        } else if ($input == 'featured_testimonial' || $input == 'page_option_header') {
            update_post_meta( $post->ID, $input, 'false');
        }
    }

}

?>