<?php $currentPage = array(
		'link'  => get_the_permalink(),
		'title' => get_the_title(),
); ?>

<ul class="breadcrumbs">
	<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
	<li><a class="modal" href="<?php echo $currentPage['link']; ?>"><?php echo $currentPage['title']; ?></a></li>
</ul>

<h1 style="text-transform: none"><?php the_title(); ?></h1>
<p>Partner with us! Please <a href="mailto:info@breastadvocateapp.com">contact us</a> to learn more.</p>
<hr style="margin: 40px 0; height: 1px; border: none; background: #ccc; width: 100px;">


<?php
	$sponsors = array();
	$partners = array();

	$args = array(
		'post_type' 		=> 'partners',
		'posts_per_page'	=> -1
	);

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
		$category = get_post_meta($post->ID, 'partners_cat', true);

		$item = array(
			'id'		=> get_the_ID(),
			'title'		=> get_the_title(),
			'link'		=> get_the_permalink(),
			'thumb' 	=> get_the_post_thumbnail_url(),
			'alt' 		=> get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true)
		);

		switch($category) {
			case 'partner': $partners[] = $item; break;

			case 'sponsor':
			default       : $sponsors[] = $item; break;
		}

	endwhile; endif;
?>



<div class="columns-wrapper">
	<div class="half">
		<div class="title">
			<h2>Sponsors</h2>
		</div>
		<ul class="partners-grid">
			<?php foreach($sponsors as $sponsor) : ?>
			<a data-id="<?php echo $sponsor['id']; ?>" class="modal item" href="<?php echo $sponsor['link']; ?>">
				<li>
					<div class="cover"><img src="<?php echo $sponsor['thumb']; ?>" alt="<?php echo $sponsor['alt']; ?>"></div>
				</li>
			</a>
			<?php endforeach; ?>
		</ul>
	</div>



	<div class="half">
		<div class="title">
			<h2>Patient Advocacy Partners</h2>
		</div>
		<ul class="partners-grid">
			<?php foreach($partners as $partner) : ?>
			<a style="display: block" data-id="<?php echo $partner['id']; ?>" class="modal item" href="<?php echo $partner['link']; ?>">
				<li>
					<div class="cover"><img src="<?php echo $partner['thumb']; ?>" alt="<?php echo $partner['alt']; ?>"></div>
				</li>
			</a>
			<?php endforeach; ?>
		</ul>
	</div>
</div>





<ul class="breadcrumbs">
	<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
	<li><a class="modal" href="<?php echo $currentPage; ?>"><?php echo $currentPage['title']; ?></a></li>
</ul>