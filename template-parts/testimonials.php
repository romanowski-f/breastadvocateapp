<!-- 	<div id="testimonials" class="row">
		<div class="row-header">
			<h2 class="center-text">Testimonials</h2>
		</div>
	</div> -->

	<div class="row expanded">
		<div class="ba-social-widget testimonials">
		<?php
		$args = array(
					'post_type' 		=> 'testimonial'
				);
		$new_query = new WP_Query( $args );
		if ( $new_query->have_posts() ) : while ( $new_query->have_posts() ) : $new_query->the_post();
			$thumb = get_the_post_thumbnail();
			$thumb_url = get_the_post_thumbnail_url();
			$postID = get_the_ID();

			// Post Meta
			$featured       = get_post_meta($post->ID, 'featured_testimonial', true);
			$title          = get_post_meta($post->ID, 'company_position', true);
			$company_link   = get_post_meta($post->ID, 'company_link', true);
			$company_name   = get_post_meta($post->ID, 'company_name', true);
			?>

			<?php if ($featured == 'true') : ?>


				<div class="image-container modal" data-modalType="testimonial" data-id=<?php echo $postID; ?> style="cursor: pointer">
					<img class="testimonial-background" src="<?php echo $thumb_url; ?>">
					<div class="testimonial-text" style="background:rgba(255, 255, 255, 0.8); bottom: 0; padding: 20px; width:100%">
						<?php if (!empty($title) || !empty($company_link) || !empty($company_name)) : ?>
							<p style="margin-bottom: 0; font-size:18px">
							<?php if (!empty($title)) : echo '<strong>' . $title . '</strong>, '; endif; ?>
							<?php if (!empty($company_link)) : ?>
								<a href="<?php echo $company_link; ?>" target="_blank">
									<?php if (!empty($company_name)) : echo '<em>' . $company_name . '</em>'; else : echo $company_link; endif; ?>
								</a>
							<?php endif; ?>
							<?php if (!empty($company_name) && empty($company_link)) : echo '<em>' . $company_name . '</em>'; endif; ?>
							</p>
						<?php endif; ?>
						<?php the_excerpt(); ?>
						<h3 style="margin: 0; text-align: right; font-style:italic"><?php the_title(); ?> <div class="circle-button small modal" data-modalType="testimonial" data-id=<?php echo $postID; ?>><i class="fas fa-angle-right"></i></div></h3>

						<input type="hidden" id="title-<?php echo $postID; ?>" value="<?php the_title(); ?>">
						<input type="hidden" id="content-<?php echo $postID; ?>" value="<?php the_content(); ?>">
						<input type="hidden" id="img-<?php echo $postID; ?>" value="<?php the_post_thumbnail_url(); ?>">
					</div>
				</div>


		<?php endif; //featured ?>

		<?php endwhile; ?>
		<?php endif; ?>
			</div>


			<div class="ba-social-widget facebook">
								<div class="fb-page" data-href="https://www.facebook.com/BreastAdvocate/" data-tabs="timeline" data-height="100%" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/BreastAdvocate/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/BreastAdvocate/">Breast Advocate</a></blockquote></div>
			</div>

			<div class="ba-social-widget twitter">
				<a class="twitter-timeline" data-height="100%" href="https://twitter.com/BreastAdvocate?ref_src=twsrc%5Etfw">Tweets by BreastAdvocate</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
	</div>
