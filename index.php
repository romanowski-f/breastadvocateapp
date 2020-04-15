<?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') : ?>

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

<?php else : ?>

	<?php get_header(); ?>

	<div class="content container">

		<?php
		get_template_part('template-parts/news');
		get_template_part('template-parts/about');
		get_template_part('template-parts/testimonials');
		?>

	</div>

	<?php get_footer(); ?>

	<script>
		modal.open = true;
		$('html').css({'overflow-y': 'hidden'});
		$('#overlay').css('overflow-y', 'scroll');
	</script>

<?php endif; ?>

