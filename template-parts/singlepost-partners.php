<?php
//--------------------Content-----------------------------

if ( have_posts() ) : while ( have_posts() ) : the_post();
	$thumb = get_the_post_thumbnail_url(); ?>
	<ul class="breadcrumbs">
		<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
		<li><a class="modal" href="<?php echo bloginfo('home'); ?>/partners">Partners & Resources</a></li>
		<li><a class="modal" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	</ul>
	<img src="<?php echo $thumb; ?>" style="display: block; margin: 0 auto 30px; max-width:300px; height: auto;">
		<h1 style="text-transform: none; text-align: center"><?php the_title(); ?></h1>
		<hr style="margin: 40px auto; height: 1px; border: none; background: #ccc; width: 100px;">
	<?php the_content(); ?>

<?php
endwhile; endif; ?>

<a href="<?php echo bloginfo('home'); ?>/partners/" class="modal" style="text-align:center; margin-top: 60px; display:block;">Back to Partners & Resources</a>

<?php
//------------------------------------------------------- ?>