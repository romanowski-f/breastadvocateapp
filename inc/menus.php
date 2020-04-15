<?php

function register_new_menu() {
	register_nav_menu('header-menu', __( 'Header Menu' ));
	register_nav_menu('mobile-menu', __( 'Mobile Menu' ));
    register_nav_menu('footer-menu', __( 'Footer Menu' ));
}

add_action('init', 'register_new_menu');

// Add 'nav-item' class to list elements
function add_list_class($classes) {
    $classes[] = 'nav-item';
    return $classes;
}

add_filter( 'nav_menu_css_class', 'add_list_class', 10, 1 );

// Add 'nav-link' class to anchor tags
function add_link_atts($atts) {
  $atts['class'] = "modal";
  return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_link_atts', 100, 1 );

function fallback_menu() { ?>

    <ul class="nav">
        <li><a data-section="who-are-we" href="">Who are we?</a></li>
        <li><a data-section="about-section" href="">About the App</a></li>
        <li><a data-slug="partners" href="/partners" class="modal">Partners</a></li>
        <li><a data-slug="real-life-stories" href="/real-life-stories" class="modal">Real Life Stories</a></li>
        <li><a data-slug="news" href="/news" class="modal" data-id="<?php echo $posts_page; ?>">News</a></li>
    </ul>

<?php
}
?>