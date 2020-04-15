<?php
//  $bottom_ad           = get_option( 'ba_bottom_ad' );
//  $bottom_ad_image_id  = ( isset( $bottom_ad['id'] ) ) ? $bottom_ad['id'] : '';
//  $bottom_ad_image_url = wp_get_attachment_url($bottom_ad_image_id);
//  $bottom_ad_link      = ( isset( $bottom_ad['url'] ) ) ? $bottom_ad['url'] : '';
//  $bottom_ad_enabled   = ( isset( $bottom_ad['enabled'] ) ) ? $bottom_ad['enabled'] : false;

$bottom_ad            = get_option( 'ba_ad_bottom' );
$bottom_ad_enabled    = ( isset( $bottom_ad['enabled'] ) ) ? $bottom_ad['enabled'] : '';
	if ($bottom_ad_enabled) :
	for ($i = 0; $i < $bottom_ad['total']; $i++) {
	$bottom_ad_image_id[$i]  = ( isset( $bottom_ad['ad'][$i] ) ) ? $bottom_ad['ad'][$i] : '';
	$bottom_ad_image_url[$i] = wp_get_attachment_url($bottom_ad_image_id[$i]);
	$bottom_ad_link[$i]      = ( isset( $bottom_ad['url'][$i] ) ) ? $bottom_ad['url'][$i] : '';
	}
endif;

?>

<?php if ($bottom_ad_enabled) : ?>

<div class="banner-area row bottom" style="padding-bottom: 40px">

    	<div class="banner-ad">
    		<div class="banner-overlay"></div>
    		<ul id="bottom-ad" class="ads-list">
	   			<li id="footer-ad-0">
<!-- 					<script src="https://bs.serving-sys.com/Serving/adServer.bs?c=28&cn=display&pli=1074845267&w=586&h=140&ord=[timestamp]&z=10000"></script>
					<noscript>
						<a href="https://bs.serving-sys.com/Serving/adServer.bs?cn=brd&pli=1074845267&Page=&Pos=1666503444" target="_blank">
						<img src="https://bs.serving-sys.com/Serving/adServer.bs?c=8&cn=display&pli=1074845267&Page=&Pos=1666503444" border=0 width=586 height=140></a>
					</noscript> -->
    			</li>
    			<?php for ($i = 1; $i < $bottom_ad['total']; $i++) : ?>
    			<li id="footer-ad-<?php echo $i; ?>">
		    		<a href="<?php echo $bottom_ad_link[$i]; ?>" target="_blank">
			        	<img src="<?php echo $bottom_ad_image_url[$i]; ?>" alt="">
			        </a>
    			</li>
    			<?php endfor; ?>
    		</ul>
    	</div>
</div>

<?php endif; ?>

</div>
    </div> <!-- Wrapper -->

<div class="contact-form-container">
	<div class="contact-content">
		<h1 style="text-align: center; margin-bottom: 30px;">Sign Up For Our Newsletter!</h1>
		<?php echo do_shortcode('[mc4wp_form id="88"]'); ?>

		<hr style="margin: 60px auto; max-width: 80%; width: 300px; border: none; height: 1px; background: #ccc;" />

		<h1 style="text-align: center; margin-bottom: 30px;">Contact Us</h1>
		<?php echo do_shortcode('[contact-form-7 id="56" title="Contact form 1"]'); ?>
	</div>
</div>

    <footer>
		<div class="container">
			<div class="row sign-up">
				<div class="sign-up-button">
					<a class="button modal" href="contact">Newsletter Sign Up</a>
				</div>
				<div class="benefits">

				</div>
				<div class="sign-up-button" data-section="who-are-we">
					<a class="button">Download the App</a>
				</div>
			</div>
			<div class="row footer-nav">
				<div class="footer-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.png" alt="Breast Advocate Logo">
				</div>
                    <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'footer-menu',
                            'items_wrap'        => '<ul class="nav footer">%3$s</ul>',
                        ) );
                    ?>
			</div>
			<div class="row legal" style="margin-top:10px; text-transform:uppercase"><a class="modal" href="/privacy-policy" style="font-size:12px;">Privacy Policy</a></div>
		</div>
    </footer>
    <input type="hidden" id="base" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
	<?php wp_footer(); ?>

	<script type="text/javascript">
	    bioEp.init({
	        html: '<h1>Sign Up For Our Newsletter!</h1>' +
	        '<div id="mc_embed_signup"><form action="https://breastadvocateapp.us18.list-manage.com/subscribe/post?u=ea4706a037eb6ae7bfff6df74&amp;id=199c277724" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate><div id="mc_embed_signup_scroll"><div class="mc-field-group"><input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name"></div><div class="mc-field-group"><input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name"></div><div class="mc-field-group"><input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email"></div><div id="mce-responses" class="clear"><div class="response" id="mce-error-response" style="display:none"></div><div class="response" id="mce-success-response" style="display:none"></div></div><div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ea4706a037eb6ae7bfff6df74_199c277724" tabindex="-1" value=""></div><div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div></div></form></div>',
	        css: '',
	        delay: 0,
	        cookieExp: 0
	    });
	</script>

<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
</body>
</html>