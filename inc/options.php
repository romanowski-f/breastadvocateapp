<?php




// ------ Theme options page ------ //

function ba_options_init() {

  register_setting('ba_theme_options', 'ba_social');  // Options group, option name
  register_setting('ba_theme_options', 'ba_contact');
  register_setting('ba_theme_options', 'ba_cf_shortcode');



// ----------------------------- Sections ----------------------------- //

  // Social media section
  add_settings_section(
    'ba_social_section',         // Section ID
    __('Social Media Links'),     // Section title
    'ba_social_cb',              // Section callback function
    'ba_theme_options'           // Options group
  );

  // Contact info section
  add_settings_section(
    'ba_contact_section',
    __('Contact Info'),
    'ba_contact_cb',
    'ba_theme_options'
  );

  // Contact form shortcode
  add_settings_section(
    'ba_cf_section',
    __('Contact Form Shortcode'),
    'ba_cf_shortcode_cb',
    'ba_theme_options'
  );



// ------------------------- Settings Fields ------------------------- //



  // ------ Social Media Settings fields ------ //

  add_settings_field(
    'ba_facebook',               // id
    __('Facebook'),               // Title
    'ba_social_field',           // Callback
    'ba_theme_options',          // Options group
    'ba_social_section',         // Section
    array(
        'label_for'         => 'ba_facebook',
        'class'             => 'ba-social-row',
        'ba_custom_data'   => 'custom'
      )
  );

  add_settings_field(
    'ba_twitter',
    __('Twitter'),
    'ba_social_field',
    'ba_theme_options',
    'ba_social_section',
    array(
        'label_for'     => 'ba_twitter',
        'class'         => 'ba-social-row',
      )
  );

  add_settings_field(
    'ba_youtube',
    __('YouTube'),
    'ba_social_field',
    'ba_theme_options',
    'ba_social_section',
    array(
        'label_for'     => 'ba_youtube',
        'class'         => 'ba-social-row',
      )
  );



  // ------ Contact info settings fields ------ //

  add_settings_field(
    'ba_phone',
    __('Phone Number'),
    'ba_contact_field',
    'ba_theme_options',
    'ba_contact_section',
    array(
        'label_for'     => 'ba_phone',
        'class'         => 'ba-social-row',
      )
  );

  add_settings_field(
    'ba_email',
    __('Email Address'),
    'ba_contact_field',
    'ba_theme_options',
    'ba_contact_section',
    array(
        'label_for'     => 'ba_email',
        'class'         => 'ba-social-row',
      )
  );

  // ------ Contact form shortcode fields ------ //

  add_settings_field(
    'ba_shortcode',
    __('Contact Form Shortcode'),
    'ba_cf_field',
    'ba_theme_options',
    'ba_cf_section',
    array(
        'label_for'     => 'ba_shortcode',
        'class'         => 'ba-social-row',
      )
  );

}

add_action('admin_init', 'ba_options_init');





// ------ Callbacks ------ //

function ba_social_cb( $args )  { return; }
function ba_contact_cb( $args ) { return; }
function ba_cf_shortcode_cb( $args ) { return; }





// ------ Fields ------ //

function ba_social_field( $args ) {

  $option = get_option('ba_social');
  $label  = $args[label_for];
  $value  = ( isset( $option[$label] ) ) ? $option[$label] : '';
  ?>

  <input  type        = "text"
          id          = "<?php echo $label; ?>"
          data-custom = "custom"
          name        = "ba_social[<?php echo $label; ?>]"
          value       = "<?php echo $value; ?>"
          style       = "width: 300px;" >

<?php
}



function ba_contact_field( $args ) {

  $option = get_option('ba_contact');
  $label  = $args[label_for];
  $value  = ( isset( $option[$label] ) ) ? $option[$label] : '';
  ?>

  <input  type        = "text"
          id          = "<?php echo $label; ?>"
          data-custom = "custom"
          name        = "ba_contact[<?php echo $label; ?>]"
          value       = "<?php echo $value; ?>"
          style       = "width: 300px;" >

<?php
}

function ba_cf_field( $args ) {

  $option = get_option('ba_cf_shortcode');
  $label  = $args[label_for];
  $value  = ( isset( $option[$label] ) ) ? $option[$label] : '';
  ?>

  <input  type        = "text"
          id          = "<?php echo $label; ?>"
          data-custom = "custom"
          name        = "ba_cf_shortcode[<?php echo $label; ?>]"
          value       = "<?php echo esc_attr( $value ); ?>"
          style       = "width: 400px;" >

<?php
}




// ------ Settings page init ------ //

function ba_options_page() {
  add_menu_page(
    'ba Theme Options',            // Page title
    'Theme Options',                // Menu title
    'manage_options',               // Capability
    'ba_options',                  // Menu slug
    'ba_options_page_html',        // Display
    'dashicons-format-video',       // Icon
    150
  );
}

add_action('admin_menu', 'ba_options_page');





// ------ Settings page design ------ //

function ba_options_page_html() {
  if (!current_user_can('manage_options')) {
    return;
  }

  if (isset($_GET['settings-updated'])) {
    add_settings_error('ba_messages', 'ba_messages', __('Settings Saved', 'ba_theme_options'), 'updated');
  }
  settings_errors('ba_messages');
  ?>

  <form action="options.php" method="post">
      <?php
      settings_fields('ba_theme_options');
      do_settings_sections('ba_theme_options');
      submit_button('Save');
      ?>
  </form>

<?php
}

?>