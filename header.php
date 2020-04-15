<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php global $post; $postid = $post->ID; ?>
    <?php if (is_front_page()) : ?>
        <meta property="og:url"                content="<?php bloginfo('url'); ?>" />
        <meta property="og:title"              content="<?php bloginfo('name'); ?>" />
    <?php else: ?>
        <meta property="og:url"                content="<?php echo get_permalink( $postid ); ?>" />
        <meta property="og:title"              content="<?php wp_title(); ?>" />
    <?php endif; ?>

    <meta property="og:description"        content="<?php bloginfo('description'); ?>" />
    <meta property="og:image"              content="<?php bloginfo('template_directory'); ?>/assets/images/fb-image-tag.png" />

    <?php if (is_front_page()) : ?>
        <title><?php echo bloginfo('name'); ?></title>
    <?php else: ?>
        <title>Breast Advocate App &reg; - <?php echo bloginfo('name') . ' ' . wp_title(); ?></title>
    <?php endif; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

    <link rel="apple-touch-icon" href="icon.png">

    <meta name="google-site-verification" content="onET2ZYakxunDZdEFOVzXhV-Fa1h8jsv9xRQzYB73B0" />

    <?php wp_head(); ?>
   
</head>

<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

<?php
  $top_ad           = get_option( 'ba_top_ad' );
  $top_ad_image_id  = ( isset( $top_ad['id'] ) ) ? $top_ad['id'] : '';
  $top_ad_image_url = wp_get_attachment_url($top_ad_image_id);
  $top_ad_link      = ( isset( $top_ad['url'] ) ) ? $top_ad['url'] : '';
  $top_ad_enabled   = ( isset( $top_ad['enabled'] ) ) ? $top_ad['enabled'] : false; ?>

<?php if ($top_ad_enabled) : ?>

    <div class="banner-area row">
        <div class="banner-ad">
             <ul id="top-ad" class="ads-list">
                <li>
                    <a href="<?php echo $top_ad_link; ?>" target="_blank">
                        <img src="<?php echo $top_ad_image_url; ?>" alt="">
                    </a>
                </li>
                <li>
                    <a href="<?php echo $top_ad_link; ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/top-ad-2.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>


    </div>

<?php endif; ?>

<div id="overlay" class="<?php if (!is_front_page()) : echo 'active'; endif; ?>">
    <?php
        if (!is_front_page()) : ?>
        <div class="modal-overlay page faded-in">
            <div class="load-icon animated fadeOut"><i class="fas fa-circle-notch fa-spin"></i></div>
            <div class="modal-box zoomed-in fade-in">
                <div id="exit"><i class="fas fa-times"></i></div>
                <div class="modal-content faded-in">
                    <?php
                    if (is_home())          : $template = 'home';
                    elseif (is_page())      : $template = get_page_template_slug($post);
                    elseif (is_single())    : $template = get_post_type($post);
                    endif;

                    switch($template) :
                        case 'home'                     : get_template_part('template-parts/loop', 'news'); break;
                        case 'stories.php'              : get_template_part('template-parts/loop', 'stories');  break;
                        case 'partners-resources.php'   : get_template_part('template-parts/loop', 'partners'); break;
                        case 'stories'                  : get_template_part('template-parts/singlepost', 'stories'); break;
                        case 'partners'                 : get_template_part('template-parts/singlepost', 'partners'); break;
                        default                         : get_template_part('template-parts/loop');             break;
                    endswitch;
                    ?>
                </div>
            </div>
        </div>
        <?php endif;
     ?>
</div>

<div class="wrapper">
    <div class="circles">
        <div class="bg-circle top">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle.png" alt="">
        </div>
        <div class="bg-circle middle">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle.png" alt="">
        </div>
        <div class="bg-circle bottom">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle.png" alt="">
        </div>
    </div>
    <div class="bg-wrapper">
    <header>
        <div class="container">
            <div class="row contact">
                <div class="c2a">
                    <span class="modal signup" data-modalType="signup">Sign Up / Contact Us</span>
                <ul class="connect-icons">
                    <a href="https://www.facebook.com/BreastAdvocate/" target="_blank"><li><i class="fab fa-facebook-f"></i></li></a>
                    <a href="https://twitter.com/breastadvocate?lang=en" target="_blank"><li><i class="fab fa-twitter"></i></li></a>
                    <a href="https://www.instagram.com/breastadvocate/" target="_blank"><li><i class="fab fa-instagram"></i></li></a>
                    <a href="https://www.youtube.com/channel/UCVb2y4y1RXhItb-7C_yHh4A" target="_blank"><li><i class="fab fa-youtube"></i></li></a>
                    <a href="https://www.pinterest.com/breastadvocate/" target="_blank"><li><i class="fab fa-pinterest"></i></li></a>
                </ul>
                </div>
            </div>
            <div class="row main-nav">
                <div class="logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="">
                </div>
                <nav>
                    <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'header-menu',
                            'menu_id'           => '',
                            'menu_class'        => 'navbar-nav ml-auto',
                            'items_wrap'        => '<ul class="nav">%3$s</ul>',
                        ) );
                    ?>
                </nav>
                <div class="mobile-nav-button"><i class="fas fa-bars"></i></div>
                <div class="mobile-nav inactive">
                     <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'mobile-menu',
                            'menu_id'           => '',
                            'items_wrap'        => '<ul>%3$s</ul>',
                        ) );
                    ?>
                    <div class="close-button">Close</div>
                </div>
            </div>
            <div class="row" style="padding-top: 15px; align-items:center">

            </div>
        </div>
    </header>

