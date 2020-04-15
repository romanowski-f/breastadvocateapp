<?php

	$screenshots = get_option('badv_screenshots');
	$screenshots = $screenshots['gallery-list'];
	$screenshots = explode(',', $screenshots);

	$screenshot_URLs = [];


	$frontpage_id = get_option('page_on_front');
	$content = get_post_meta($frontpage_id, 'ba_cta_editor', true);

	$android_link = get_post_meta($frontpage_id, 'android_link', true);
	$android_enabled = get_post_meta($frontpage_id, 'android_enabled', true);
	$iphone_link  = get_post_meta($frontpage_id, 'iphone_link', true);
	$iphone_enabled = get_post_meta($frontpage_id, 'iphone_enabled', true);
	$coming_soon = get_post_meta($frontpage_id, 'coming_soon', true);
	$coming_soon_enabled = get_post_meta($frontpage_id, 'coming_soon_enabled', true);

?>

	<div class="mobile downloads">
	<?php if ($android_enabled == 'true') : ?>
		<a href="<?php echo $android_link; ?>" onclick="ga('send', 'event', 'Downloads', 'Click', 'Android');"><div class="download-button android">Android Download</div></a>
	<?php endif; ?>

	<?php if ($iphone_enabled == 'true') : ?>
		<a href="<?php echo $iphone_link; ?>" onclick="ga('send', 'event', 'Downloads', 'Click', 'iPhone');"><div class="download-button iphone">iPhone Download</div></a>
	<?php endif; ?>
	</div>

	<div id="who-are-we" class="c2a-box">
		<div class="iphone-carousel">
			<div class="iphone-container">
				<img class="frame" src="<?php echo get_template_directory_uri(); ?>/assets/images/iphone.png" alt="Breast Cancer App | Shared Decision-Making">
				<div class="slide-container">
					<?php

						$i = 0;
						foreach($screenshots as $id) {
							$url = wp_get_attachment_url($id);
							$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
							$div = 'slide' . $i;
							$el  = '<div id="' . $div . '" class="slide">';
							$el .= '<img src="'. $url .'" alt="' . $alt . '">';
							$el .= '</div>';
							echo $el;

							$i++;
						}

					?>
				</div>
			</div>
			<div class="ba-description">
				<h1>Breast Advocate<sup>&reg;</sup></h1>
				<?php echo $content; ?>

				<div class="downloads">
				<?php if ($android_enabled == 'true') : ?>
					<a href="<?php echo $android_link; ?>" onclick="ga('send', 'event', 'Downloads', 'Click', 'Android');"><div class="download-button android">Android Download</div></a>
				<?php endif; ?>

				<?php if ($iphone_enabled == 'true') : ?>
					<a href="<?php echo $iphone_link; ?>" onclick="ga('send', 'event', 'Downloads', 'Click', 'iPhone');"><div class="download-button iphone">iPhone Download</div></a>
				<?php endif; ?>
				</div>

				<?php if ($coming_soon_enabled == 'true') : ?>
					<div style="color: #E04B5D; font-size: 21px; margin-top: 10px; text-align: center;"><?php echo $coming_soon; ?></div>
				<?php endif; ?>
			</div>

		</div>


<?php

	$first_module = array(
		'title' => get_post_meta($frontpage_id, 'module_title_1', true),
		'desc'  => get_post_meta($frontpage_id, 'module_text_1', true),
		'link'  => get_post_meta($frontpage_id, 'module_link_1', true),
		'video'  => get_post_meta($frontpage_id, 'module_video_link_1', true),
	);

	$second_module = array(
		'title' => get_post_meta($frontpage_id, 'module_title_2', true),
		'desc'  => get_post_meta($frontpage_id, 'module_text_2', true),
		'link'  => get_post_meta($frontpage_id, 'module_link_2', true),
		'video'  => get_post_meta($frontpage_id, 'module_video_link_2', true),
	);
	$third_module = array(
		'title' => get_post_meta($frontpage_id, 'module_title_3', true),
		'desc'  => get_post_meta($frontpage_id, 'module_text_3', true),
		'link'  => get_post_meta($frontpage_id, 'module_link_3', true),
		'video'  => get_post_meta($frontpage_id, 'module_video_link_3', true),
	);

 ?>

		<div class="news">

			<div class="news-item modal" href="<?php echo $first_module['link']; ?>">
				<div class="image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/news-1.jpg">
				</div>
				<div class="news-item-content">
					<h3><?php echo $first_module['title']; ?></h3>
					<p><?php echo $first_module['desc']; ?></p>
				</div>
			</div>
			<hr />
			<div class="news-item modal" data-modalType="video" data-url="https://www.youtube.com/embed/_jTsYTPWDxA">
				<div class="image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder-interview.jpg">
				</div>
				<div class="news-item-content">
					<h3><?php echo $second_module['title']; ?></h3>
					<p><?php echo $second_module['desc']; ?></p>
				</div>
			</div>
			<hr />
			<div class="news-item modal" href="<?php echo $third_module['link']; ?>">
				<div class="image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/testimonial-3.jpg">
				</div>
				<div class="news-item-content">
					<h3><?php echo $third_module['title']; ?></h3>
					<p><?php echo $third_module['desc']; ?></p>
				</div>
			</div>
		</div>
	</div>