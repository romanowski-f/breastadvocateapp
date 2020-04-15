<?php

// screenshots page

function badv_screenshots_options_init() {
  register_setting('badv_screenshots_options', 'badv_screenshots'); // Options group, option name

// ----------------------------- Sections ----------------------------- //

  // screenshots section
  add_settings_section(
  'badv_photo_section',         // Section ID
  __('Photo Gallery'),      // Section title
  'badv_photo_cb',              // Section callback function
  'badv_screenshots_options'           // Options group
  );

}

add_action('admin_init', 'badv_screenshots_options_init');





function badv_photo_cb( $args ) {
  $gallery = get_option('badv_screenshots');
  $value = ( isset( $gallery['gallery-list'] ) ) ? $gallery['gallery-list'] : '';

  if (!empty($value)) {

  }

  ?>

  <div class="options-container">
    <ul id="photography-gallery" class="image-gallery-container sortable">
      <?php
        if (!empty($value)) {
          $list = explode(',', $value);
          foreach ($list as $id) {
            $url = wp_get_attachment_url($id);
            echo '<li class="gallery-item" style="background: url(' . $url . ') center no-repeat; background-size: cover;" data-id="' . $id . '"><div class="delete"><i class="fas fa-times"></i></div></li>';
          }
        }
      ?>
    </ul>
  </div>

  <a href="#" id="badv_images_media_bottom" class="button button-add-media" data-type="image" data-target="gallery-items" data-multiple="true">Add Media</a>

  <input type="hidden" id="gallery-items" name="badv_screenshots[gallery-list]" value="<?php echo $value; ?>">

<?php
}





function badv_screenshots_page() {
  add_menu_page(
    'Screenshot Slider',            // Page title
    'Screenshots Slider',                // Menu title
    'manage_options',               // Capability
    'badv_screenshots_page',                  // Menu slug
    'badv_screenshots_page_html',        // Display
    'dashicons-format-video',       // Icon
    150
  );
}

add_action('admin_menu', 'badv_screenshots_page');





function badv_screenshots_page_html() {
  if (!current_user_can('manage_options')) {
    return;
  }

  if (isset($_GET['settings-updated'])) {
    add_settings_error('badv_messages', 'badv_messages', __('Gallery Saved', 'badv_theme_options'), 'updated');
  }
  settings_errors('badv_messages');
  ?>

  <form action="options.php" method="post">
      <?php
      settings_fields('badv_screenshots_options');
      do_settings_sections('badv_screenshots_options');
      submit_button('Save');
      ?>
  </form>

<?php
}

?>