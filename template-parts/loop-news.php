<ul class="breadcrumbs">
	<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
	<li><a class="modal" href="<?php echo bloginfo('home'); ?>/news">News</a></li>
</ul>
<div class="news">
	<h1 id="page-title">News</h1>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		  $thumb = get_the_post_thumbnail(); ?>

	<div class="news-item">
		<div class="date">
			<?php $date = get_the_date('M d'); ?>
			<?php $date = explode(' ', $date); ?>
			<?php echo '<span class="month">' . $date[0] . '</span>'; ?>
			<hr class="break" />
			<?php echo '<span class="day">' . $date[1] . '</span>'; ?>
		</div>
		<?php if (!empty($thumb)) : ?>
			<div class="image-container"><?php echo $thumb; ?></div>
			<div class="single-news-content has-featured-image">
		<?php else : ?>
			<div class="single-news-content">
		<?php endif; ?>
		<h2 style="text-transform: none"><a data-id="<?php echo get_the_ID(); ?>" class="modal" href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a></h2>
		<?php the_excerpt(); ?>
		</div>
	</div>

	<?php endwhile; ?>
	<?php endif; ?>
<?php the_posts_pagination(); ?>
</div>
<ul class="breadcrumbs">
	<li><a class="exit-modal" href="<?php echo bloginfo('home'); ?>">Home</a></li>
	<li><a class="modal" href="<?php echo bloginfo('home'); ?>/news">News</a></li>
</ul>