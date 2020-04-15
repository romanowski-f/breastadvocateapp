	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$thumb = get_the_post_thumbnail();
		$hide_header_text = get_post_meta($post->ID, 'page_option_header', true);

		if (is_singular('post')) : ?>
			<ul class="breadcrumbs">
				<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
				<li><a class="modal" href="<?php echo bloginfo('home'); ?>/news">News</a></li>
				<li><a class="modal" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			</ul>
		<?php endif; ?>

		<?php if ($hide_header_text != 'true') :	?>
			<h1 id="page-title" style="text-transform: none"><?php the_title(); ?></h1>
			<hr style="margin: 40px 0; height: 1px; border: none; background: #ccc; width: 100px;">
		<?php endif; ?>
		<?php the_content(); ?>
		<?php echo $thumb; ?>
		<hr style="margin: 40px auto; width:40%; border: none; height: 1px; background:#ccc">
		<div class="share-box">
			<h4>Share this story</h4>
			<ul class="share-icons">
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><li><i class="fab fa-facebook-f"></i></li></a>
				<a href="http://www.twitter.com/share?url=<?php echo get_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><li><i class="fab fa-twitter"></i></li></a>
			</ul>
	</div>
		<?php if (is_singular('post')) : ?>
			<a href="<?php echo bloginfo('home'); ?>/news" class="modal" style="display: block; text-align: center; margin-top: 60px;">&laquo; Back</a>
		<?php endif; ?>
	<?php endwhile;
	endif;
	?>