<?php get_header(); ?>

<div id="overlay">
	<div class="modal-overlay page faded-in">
		<div class="load-icon animated fadeOut"><i class="fas fa-circle-notch fa-spin"></i></div>
		<div class="modal-box zoomed-in fade-in">
			<div id="exit"><i class="fas fa-times"></i></div>
			<div class="modal-content faded-in">
				<h1>Page Not Found</h1>
				<p>Sorry!</p>
			</div>
		</div>
	</div>
</div>

<div class="content container">

	<?php
	get_template_part('template-parts/news');
	get_template_part('template-parts/about');
	get_template_part('template-parts/testimonials');
	?>

</div>

<?php get_footer(); ?>

<script> modal.open = true; </script>



