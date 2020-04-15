<?php




// ------ Theme options page ------ //

function ba_ads_init() {

  register_setting('ba_theme_ads', 'ba_ad_top');  // Options group, option name
  register_setting('ba_theme_ads', 'ba_ad_middle');
  register_setting('ba_theme_ads', 'ba_ad_bottom');


  add_settings_section(
    'ba_ads_section',         // Section ID
    __('Ads'),     // Section title
    'ba_ads_cb',              // Section callback function
    'ba_theme_ads'           // Options group
  );
}

add_action('admin_init', 'ba_ads_init');




// ------ Settings page init ------ //

add_action('admin_menu', 'ba_ads_page');

function ba_ads_page() {
  $ads_page = add_menu_page(
    'Ads',            // Page title
    'Ads',                // Menu title
    'manage_options',               // Capability
    'ba_ads',                  // Menu slug
    'ba_ads_page_html',        // Display
    'dashicons-feedback',       // Icon
    150
  );

  add_action( 'load-' . $ads_page, 'load_admin_js');
}

function load_admin_js() {
  add_action ( 'admin_enqueue_scripts', 'enqueue_admin_js' );
}

function enqueue_admin_js() {
  //  Admin JS
  wp_register_script('ads-js', get_template_directory_uri() . '/assets/js/ads-js.js', array('jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-sortable'), '1.0.3');
  wp_enqueue_script('ads-js');

    // Ads style
  wp_enqueue_style('ads-style', get_template_directory_uri() . '/assets/css/ads-styles.css', array(), '1.0.0');
}



// ------ Callbacks ------ //

function ba_ads_cb( $args )  {
  $top_ad           = get_option( 'ba_ad_top' );
  if (!isset($top_ad['total'])) $top_ad['total'] = 1;
  for ($i = 0; $i < $top_ad['total']; $i++) {
    $top_ad_image_id[$i]  = ( isset( $top_ad['ad'][$i] ) ) ? $top_ad['ad'][$i] : '';
    $top_ad_image_url[$i] = wp_get_attachment_url($top_ad_image_id[$i]);
    $top_ad_link[$i]      = ( isset( $top_ad['url'][$i] ) ) ? $top_ad['url'][$i] : '';
  }


  $middle_ad            = get_option( 'ba_ad_middle' );
  if (!isset($middle_ad['total'])) $middle_ad['total'] = 1;
  for ($i = 0; $i < $middle_ad['total']; $i++) {
    $middle_ad_image_id[$i]  = ( isset( $middle_ad['ad'][$i] ) ) ? $middle_ad['ad'][$i] : '';
    $middle_ad_image_url[$i] = wp_get_attachment_url($middle_ad_image_id[$i]);
    $middle_ad_image_id_vertical[$i]   = ( isset( $middle_ad['vertical_id'][$i] ) ) ? $middle_ad['vertical_id'][$i] : '';
    $middle_ad_image_url_vertical[$i]  = wp_get_attachment_url($middle_ad_image_id_vertical[$i]);
    $middle_ad_link[$i]      = ( isset( $middle_ad['url'][$i] ) ) ? $middle_ad['url'][$i] : '';
  }

  // $middle_ad_image_id   = ( isset( $middle_ad['id'] ) ) ? $middle_ad['id'] : '';
  // $middle_ad_image_url  = wp_get_attachment_url($middle_ad_image_id);
  // $middle_ad_image_id_vertical   = ( isset( $middle_ad['vertical_id'] ) ) ? $middle_ad['vertical_id'] : '';
  // $middle_ad_image_url_vertical  = wp_get_attachment_url($middle_ad_image_id_vertical);
  // $middle_ad_link       = ( isset( $middle_ad['url'] ) ) ? $middle_ad['url'] : '';
  // $middle_ad_enabled    = ( isset( $middle_ad['enabled'] ) ) ? $middle_ad['enabled'] : '';
  // $middle_ad_vertical    = ( isset( $middle_ad['vertical'] ) ) ? $middle_ad['vertical'] : '';

  $bottom_ad            = get_option( 'ba_ad_bottom' );
  if (!isset($bottom_ad['total'])) $bottom_ad['total'] = 1;
  for ($i = 0; $i < $bottom_ad['total']; $i++) {
    $bottom_ad_image_id[$i]  = ( isset( $bottom_ad['ad'][$i] ) ) ? $bottom_ad['ad'][$i] : '';
    $bottom_ad_image_url[$i] = wp_get_attachment_url($bottom_ad_image_id[$i]);
    $bottom_ad_link[$i]      = ( isset( $bottom_ad['url'][$i] ) ) ? $bottom_ad['url'][$i] : '';
  }

  // $bottom_ad_image_id   = ( isset( $bottom_ad['id'] ) ) ? $bottom_ad['id'] : '';
  // $bottom_ad_image_url  = wp_get_attachment_url($bottom_ad_image_id);
  // $bottom_ad_link       = ( isset( $bottom_ad['url'] ) ) ? $bottom_ad['url'] : '';
  // $bottom_ad_enabled    = ( isset( $bottom_ad['enabled'] ) ) ? $bottom_ad['enabled'] : '';

  ?>

<div id="ads-wrapper">
    <ul class="ad-tabs">
      <li><a href="#ad-middle">Middle Ads</a></li>
      <li><a href="#ad-bottom">Bottom Ads</a></li>
      <!-- <li><a href="#ad-top">Top Ads</a></li>       -->
    </ul>


<!--   <div id="ad-top" class="ad-container">
    <div class="check-wrapper">
      <label for="ad-top-enable">Enable <input type="checkbox" name="ba_ad_top[enabled]" id="ad-top-enable" value="true" <?php checked($top_ad['enabled'], 'true'); ?>></label>
    </div>
    <h1>Top Ads</h1>
    <div class="accordion">

      <?php for ($ads = 0; $ads < $top_ad['total']; $ads++) : ?>
        <h3 id="ad-top-<?php echo $ads; ?>-item-handle" class="accordion-item">Ad <?php echo $ads + 1; ?></h3>
        <div id="ad-top-<?php echo $ads; ?>-item-content" class="ad-content">
          <div class="image-block change-image" data-type="image" data-target="ad-top-<?php echo $ads; ?>" data-multiple="false">
            <img src="<?php echo $top_ad_image_url[$ads] ?>">
            <div class="image-block-overlay"><span>Change Banner Image</span></div>
            <input type="hidden" id="ad-top-<?php echo $ads; ?>" name="<?php echo 'ba_ad_top[ad][' . $ads . ']'; ?>" value="<?php echo $top_ad_image_id[$ads]; ?>">
          </div>

          <div class="ad-link">
            <input type="text" id="ad-top-<?php echo $ads; ?>-url" name="<?php echo 'ba_ad_top[url][' . $ads . ']'; ?>" placeholder="http://" value="<?php echo $top_ad_link[$ads]; ?>">
          </div>

          <div class="media-button-wrapper">
            <a href="#" id="ba_top_ad_<?php echo $ads; ?>_remove" class="button button-remove" data-target="ad-top-<?php echo $ads; ?>" data-group="ad-top">Remove Ad</a>
          </div>
        </div>
      <?php endfor; ?>

    </div>

    <a href="#" id="ba_top_ad_new" class="button button-add" data-group="ad-top" style="margin: 20px auto">New Ad</a>
    <input type="hidden" id="ad-top-total" name="ba_ad_top[total]" value="<?php echo $ads; ?>">

  </div> -->









  <div id="ad-middle" class="ad-container">

    <div class="check-wrapper">
      <label for="ad-middle-enable">Enable <input type="checkbox" name="ba_ad_middle[enabled]" id="ad-middle-enable" value="true" <?php checked($middle_ad['enabled'], 'true'); ?>></label>
    </div>
    <h1>Middle Ads</h1>

    <div class="accordion">

      <?php for ($ads = 0; $ads < $middle_ad['total']; $ads++) : ?>
        <h3 id="ad-middle-<?php echo $ads; ?>-item-handle" class="accordion-item">Ad <?php echo $ads + 1; ?></h3>
        <div id="ad-middle-<?php echo $ads; ?>-item-content" class="ad-content">

          <div class="description"><strong>Vertical Image</strong> <br /> For screens wider than 840px (will appear to the right of the "About" section)</div>
          <div class="image-block change-image middle-vertical" data-type="image" data-target="<?php echo 'ad-middle-vertical-image-' . $ads; ?>" data-multiple="false">
            <img src="<?php echo $middle_ad_image_url_vertical[$ads] ?>">
            <div class="image-block-overlay"><span>Change Vertical Banner Image</span></div>
            <input type="hidden" id="ad-middle-vertical-image-<?php echo $ads; ?>" name="<?php echo 'ba_ad_middle[vertical_id][' . $ads . ']'; ?>" value="<?php echo $middle_ad_image_id_vertical[$ads]; ?>">
          </div>

          <div class="description"><strong>Horizontal Image</strong> <br /> For screens less than 840px wide (will appear above the "About" section)</div>
          <div class="image-block change-image" data-type="image" data-target="ad-middle-<?php echo $ads; ?>" data-multiple="false">
            <img src="<?php echo $middle_ad_image_url[$ads] ?>">
            <div class="image-block-overlay"><span>Change Banner Image</span></div>
            <input type="hidden" id="ad-middle-<?php echo $ads; ?>" name="<?php echo 'ba_ad_middle[ad][' . $ads . ']'; ?>" value="<?php echo $middle_ad_image_id[$ads]; ?>">
          </div>

          <div class="ad-link">
            <input type="text" id="ad-middle-<?php echo $ads; ?>-url" name="<?php echo 'ba_ad_middle[url][' . $ads . ']'; ?>" placeholder="http://" value="<?php echo $middle_ad_link[$ads]; ?>">
          </div>

          <div class="media-button-wrapper">
            <a href="#" id="ba_middle_ad_<?php echo $ads; ?>_remove" class="button button-remove" data-target="ad-middle-<?php echo $ads; ?>" data-group="ad-middle">Remove Ad</a>
          </div>
        </div>
      <?php endfor; ?>

    </div>

    <a href="#" id="ba_middle_ad_new" class="button button-add" data-group="ad-middle" style="margin: 20px auto">New Ad</a>
    <input type="hidden" id="ad-middle-total" name="ba_ad_middle[total]" value="<?php echo $ads; ?>">

  </div>






  <div id="ad-bottom" class="ad-container">

    <div class="check-wrapper">
      <label for="ad-bottom-enable">Enable <input type="checkbox" name="ba_ad_bottom[enabled]" id="ad-bottom-enable" value="true" <?php checked($bottom_ad['enabled'], 'true'); ?>></label>
    </div>
    <h1>Bottom Ads</h1>

    <div class="accordion">
      <?php for ($ads = 0; $ads < $bottom_ad['total']; $ads++) : ?>
        <h3 id="ad-bottom-<?php echo $ads; ?>-item-handle" class="accordion-item">Ad <?php echo $ads + 1; ?></h3>
        <div id="ad-bottom-<?php echo $ads; ?>-item-content" class="ad-content">
          <div class="image-block change-image" data-type="image" data-target="ad-bottom-<?php echo $ads; ?>" data-multiple="false">
            <img src="<?php echo $bottom_ad_image_url[$ads] ?>">
            <div class="image-block-overlay"><span>Change Banner Image</span></div>
            <input type="hidden" id="ad-bottom-<?php echo $ads; ?>" name="<?php echo 'ba_ad_bottom[ad][' . $ads . ']'; ?>" value="<?php echo $bottom_ad_image_id[$ads]; ?>">
          </div>

          <div class="ad-link">
            <input type="text" id="ad-bottom-<?php echo $ads; ?>-url" name="<?php echo 'ba_ad_bottom[url][' . $ads . ']'; ?>" placeholder="http://" value="<?php echo $bottom_ad_link[$ads]; ?>">
          </div>

          <div class="media-button-wrapper">
            <a href="#" id="ba_bottom_ad_<?php echo $ads; ?>_remove" class="button button-remove" data-target="ad-bottom-<?php echo $ads; ?>" data-group="ad-bottom">Remove Ad</a>
          </div>
        </div>
      <?php endfor; ?>
    </div>
    <a href="#" id="ba_bottom_ad_new" class="button button-add" data-group="ad-bottom" style="margin: 20px auto">New Ad</a>
    <input type="hidden" id="ad-bottom-total" name="ba_ad_bottom[total]" value="<?php echo $ads; ?>">

  </div>

</div>

  <?php
}




// ------ Settings page design ------ //

function ba_ads_page_html() {
  if (!current_user_can('manage_options')) {
    return;
  }

  if (isset($_GET['settings-updated'])) {
    add_settings_error('ba_messages', 'ba_messages', __('Settings Saved', 'ba_theme_ads'), 'updated');
  }
  settings_errors('ba_messages');
  ?>

  <form action="options.php" method="post">
      <?php
      settings_fields('ba_theme_ads');
      do_settings_sections('ba_theme_ads');
      submit_button('Save');
      ?>
  </form>

<?php
}

?>