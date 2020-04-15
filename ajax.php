<?php /* Template Name: Ajax */ ?>

<?php
	$post = get_post($_POST['id']);

	if ($post) {
		setup_postdata($post);
		$hide_header_text = get_post_meta($post->ID, 'page_option_header', true);
		if (!$hide_header_text) : ?>
			<h1 style="text-transform: none"><?php the_title(); ?></h1>
		<?php endif; ?>
		<?php the_content(); ?>

	<?php }

?>