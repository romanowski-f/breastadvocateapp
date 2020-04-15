	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		$thumb = get_the_post_thumbnail(); ?>

		<h2><?php the_title(); ?></h2>
		<?php echo $thumb; ?>

	<?php endwhile;
	endif; ?>