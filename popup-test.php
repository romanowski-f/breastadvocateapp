<?php /* Template Name: Popup Test */ ?>
<?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') : ?>

	<?php get_template_part('template-parts/loop'); ?>

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