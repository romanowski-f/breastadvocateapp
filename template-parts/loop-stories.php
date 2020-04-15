<ul class="breadcrumbs">
	<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
	<li><a class="modal" href="<?php echo bloginfo('home'); ?>/real-life-stories">Real Life Stories</a></li>
</ul>

<h1 style="text-transform: none"><?php the_title(); ?></h1>
<hr style="margin: 40px 0; height: 1px; border: none; background: #ccc; width: 100px;">

<div class="real-life-stories">


<?php
$args = array(
	'post_type' 		=> 'stories'
);
$pr_query = new WP_Query( $args );
if ( $pr_query->have_posts() ) : while ( $pr_query->have_posts() ) : $pr_query->the_post();
	$thumb = get_the_post_thumbnail_url();
	$img_id = get_post_thumbnail_id(get_the_ID());;
	$alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
	$website = array(
		'name' => get_post_meta($post->ID, 'company_name', true),
		'url'  => get_post_meta($post->ID, 'company_link', true),
	);

	?>
	<div class="story-item">
		<?php if (!empty($thumb)) : ?>
			<a data-id="<?php echo get_the_ID(); ?>" class="modal image-container" href="<?php the_permalink(); ?>">
				<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>">
			</a>
		<?php endif; ?>
		<div class="single-story-content">
		<h2 style="text-transform: none; margin: 0 0 4px"><a data-id="<?php echo get_the_ID(); ?>" class="modal" href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a></h2>
<h3 style="margin-top: 0; font-weight: normal; font-style: italic; font-family: Gotham Book;  text-transform: none"><a href="<?php echo $website['url']; ?>" target="_blank" rel="noopener"><?php echo $website['name'] ?></a></h3>
		<?php the_excerpt(); ?>
		</div>
	</div>
<?php endwhile;
endif;
?>

</div>

<ul class="breadcrumbs">
	<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
	<li><a class="modal" href="<?php echo bloginfo('home'); ?>/real-life-stories">Real Life Stories</a></li>
</ul>