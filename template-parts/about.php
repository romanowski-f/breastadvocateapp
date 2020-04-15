<?php
  // $middle_ad            = get_option( 'ba_middle_ad' );
  // $middle_ad_image_id   = ( isset( $middle_ad['id'] ) ) ? $middle_ad['id'] : '';
  // $middle_ad_image_url  = wp_get_attachment_url($middle_ad_image_id);
  // $middle_ad_image_id_vertical   = ( isset( $middle_ad['vertical_id'] ) ) ? $middle_ad['vertical_id'] : '';
  // $middle_ad_image_url_vertical  = wp_get_attachment_url($middle_ad_image_id_vertical);
  // $middle_ad_link       = ( isset( $middle_ad['url'] ) ) ? $middle_ad['url'] : '';
  // $middle_ad_enabled    = ( isset( $middle_ad['enabled'] ) ) ? $middle_ad['enabled'] : '';
  // $vertical    = ( isset( $middle_ad['vertical'] ) ) ? $middle_ad['vertical'] : '';
  $middle_ad            = get_option( 'ba_ad_middle' );
  $middle_ad_enabled    = ( isset( $middle_ad['enabled'] ) ) ? $middle_ad['enabled'] : '';
  	if ($middle_ad_enabled) :
		for ($i = 0; $i < $middle_ad['total']; $i++) {
		$middle_ad_image_id[$i]  = ( isset( $middle_ad['ad'][$i] ) ) ? $middle_ad['ad'][$i] : '';
		$middle_ad_image_url[$i] = wp_get_attachment_url($middle_ad_image_id[$i]);
		$middle_ad_image_id_vertical[$i]   = ( isset( $middle_ad['vertical_id'][$i] ) ) ? $middle_ad['vertical_id'][$i] : '';
		$middle_ad_image_url_vertical[$i]  = wp_get_attachment_url($middle_ad_image_id_vertical[$i]);
		$middle_ad_link[$i]      = ( isset( $middle_ad['url'][$i] ) ) ? $middle_ad['url'][$i] : '';
		//$vertical    = ( isset( $middle_ad['vertical'] ) ) ? $middle_ad['vertical'] : '';
		}
	endif;
 ?>

	<div id="about" class="vertical" <?php if ($vertical) : echo 'class="vertical"'; endif; ?>>

	<?php if ($middle_ad_enabled) : ?>

			<div class="banner-area row middle vertical">
				<div class="banner-ad desktop">
					<div class="banner-overlay"></div>
					<ul id="middle-ad" class="ads-list">
						<li data-item="0">
<!-- 							<script src="https://bs.serving-sys.com/Serving/adServer.bs?c=28&cn=display&pli=1074845266&w=170&h=560&ord=[timestamp]&z=10000"></script>
							<noscript>
							<a href="https://bs.serving-sys.com/Serving/adServer.bs?cn=brd&pli=1074845266&Page=&Pos=1724713191" target="_blank">
							<img src="https://bs.serving-sys.com/Serving/adServer.bs?c=8&cn=display&pli=1074845266&Page=&Pos=1724713191" border=0 width=170 height=560></a>
							</noscript> -->
						</li>
						<?php for ($i = 0; $i < $middle_ad['total']; $i++) : ?>
						<li data-item="<?php echo $i + 1; ?>">
							<a href="<?php echo $middle_ad_link[$i]; ?>" target="_blank">
						        <img src="<?php echo $middle_ad_image_url_vertical[$i]; ?>" alt="">
					    	</a>
						</li>
						<?php endfor; ?>
					</ul>
				</div>

			    	<div class="banner-ad mobile">
			    		<div class="banner-overlay"></div>
						<ul id="middle-ad" class="ads-list">
<!-- 							<li data-item="0">
								<script src="https://bs.serving-sys.com/Serving/adServer.bs?c=28&cn=display&pli=1074845267&w=586&h=140&ord=[timestamp]&z=10000"></script>
								<noscript>
								<a href="https://bs.serving-sys.com/Serving/adServer.bs?cn=brd&pli=1074845267&Page=&Pos=1666503444" target="_blank">
								<img src="https://bs.serving-sys.com/Serving/adServer.bs?c=8&cn=display&pli=1074845267&Page=&Pos=1666503444" border=0 width=586 height=140></a>
								</noscript>
							</li> -->
							<?php for ($i = 0; $i < $middle_ad['total']; $i++) : ?>
							<li data-item="<?php echo $i + 1; ?>">
								<a href="<?php echo $middle_ad_link[$i]; ?>" target="_blank">
							        <img src="<?php echo $middle_ad_image_url[$i]; ?>" alt="">
						    	</a>
							</li>
							<?php endfor; ?>
						</ul>
			    	</div>

			</div>


	<?php endif; ?>

		<div id="about-section" class="about-header">
			<div id="knowledge-center" class="phone-wrapper">
				<div data-slug="knowledge-center" data-id="6" data-modalType="about-page" class="phone modal">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/knowledge-center.png" alt="Knowledge Center">
				</div>
				<h2 class="about-title">Knowledge Center</h2>
			</div>
			<div id="decision-wizard" class="phone-wrapper">
				<div data-slug="decision-wizard" data-modalType="about-page" class="phone modal">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/decision-wizard.png" alt="Decision Wizard">
				</div>
				<h2 class="about-title">Decision Wizard</h2>
			</div>
			<div id="community" class="phone-wrapper">
				<div data-slug="community" data-modalType="about-page" class="phone modal">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/community-chat.png" alt="Community">
				</div>
				<h2 class="about-title">Community</h2>
			</div>
		</div>
		<?php
		$frontpage_id = get_option('page_on_front');
		$content = get_post_meta($frontpage_id, 'ba_about_editor', true);
		$popup   = get_post_meta($frontpage_id, 'ba_popup_editor', true);
		 ?>

		<div class="about-content">
			<h2>About the App</h2>
			<div class="content-wrap">
				<?php echo $content; ?>
			</div>
		</div>
	</div>

	<?php 	$android_link = get_post_meta($post->ID, 'android_link', true);
			$android_enabled = get_post_meta($post->ID, 'android_enabled', true);
			$iphone_link  = get_post_meta($post->ID, 'iphone_link', true);
			$iphone_enabled = get_post_meta($post->ID, 'iphone_enabled', true);
			$coming_soon  = get_post_meta($post->ID, 'coming_soon', true);
			$coming_soon_enabled  = get_post_meta($post->ID, 'coming_soon_enabled', true);
			$popup_enabled  = get_post_meta($post->ID, 'popup_enabled', true); ?>

	<?php if ($popup_enabled == 'true') : ?>

	<div class="reminder offscreen">
		<div class="reminder__dismiss">
			<i class="fas fa-times"></i> Dismiss
		</div>
		<div class="reminder__phone">
			<img class="frame" src="https://breastadvocateapp.com/wp-content/uploads/2020/04/1f-2.png" alt="iPhone">
		</div>
		<div class="reminder__copy">
			<h3>Download the app now!</h3>
			<?php echo $popup; ?>
		</div>

		<?php if ($android_enabled == 'true') : ?>
			<div class="download-button" style="margin-bottom:10px">iPhone Download</div>
		<?php endif; ?>

		<?php if ($iphone_enabled == 'true') : ?>
			<div class="download-button">Android Download</div>
		<?php endif; ?>

		<?php if ($coming_soon_enabled == 'true') : ?>
			<div style="color: #E04B5D; font-size: 18px; margin-top: 10px; text-align: center;"><?php echo $coming_soon; ?></div>
		<?php endif; ?>

	</div>

	<?php endif;  ?>