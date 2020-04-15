<?php
//--------------------Content-----------------------------

if ( have_posts() ) : while ( have_posts() ) : the_post();
	$website = array(
		'name' => get_post_meta($post->ID, 'company_name', true),
		'url'  => get_post_meta($post->ID, 'company_link', true),
	);
	$thumb = get_the_post_thumbnail_url(); ?>
	<ul class="breadcrumbs">
		<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
		<li><a class="modal" href="<?php echo bloginfo('home'); ?>/real-life-stories/">Real Life Stories</a></li>
		<li><a class="modal" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	</ul>
		<h1 style="text-transform: none; text-align: center"><?php the_title(); ?></h1>
		<h3 style="margin-top: 0; text-align: center; font-weight: normal; font-style: italic; font-family: Gotham Book;  text-transform: none"><a href="<?php echo $website['url']; ?>" target="_blank" rel="noopener"><?php echo $website['name'] ?></a></h3>
		<hr style="margin: 40px auto; height: 1px; border: none; background: #ccc; width: 100px;">
	<?php the_content(); ?>

<?php
endwhile; endif; ?>

<a href="<?php echo bloginfo('home'); ?>/real-life-stories/" class="modal" style="text-align:center; margin-top: 60px; display:block;">Back to Real Life Stories</a>

<?php
//------------------------------------------------------- ?>

