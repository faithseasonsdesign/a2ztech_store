<?php

defined('ABSPATH') or die();

class WDCL_Admin_Feedback
{

	public function __construct()
	{
		add_action('wp_ajax_wdcl-dismiss-notice', [$this, 'ajax_dismiss_notice']);
		add_action('admin_notices', [$this, 'admin_notices']);
	}

	public function admin_notices()
	{

		$wdcl_notice = get_user_meta(get_current_user_id(), 'wdcl-notice-rating', true);

		if ('dismissed' == $wdcl_notice || get_transient('wdcl-notice-rating')) {
			return;
		}

?>
		<div class="wdcl-notice notice is-dismissible">
			<div class="wdcl-notice-container">
				<div class="wdcl-notice-image">
					<img src="https://ps.w.org/wow-carousel-for-divi-lite/assets/icon-256x256.png" alt="wdcl-logo">
				</div>
				<div class="wdcl-notice-content">
					<div class="wdcl-notice-heading">
						<?php esc_html_e('Hello! Seems like you are using Wow Carousel plugin to build your Divi website - Thanks a lot!', 'wdcl-wow-divi-carousel-lite'); ?>
					</div>
					<?php esc_html_e('Could you please do us a BIG favor and give it a 5-star rating on WordPress? This would boost our motivation and help other users make a comfortable decision while choosing the Wow Carousel plugin.', 'wdcl-wow-divi-carousel-lite'); ?>
					<br />
					<div class="wdcl-review-notice-container">
						<a href="https://wordpress.org/support/plugin/wow-carousel-for-divi-lite/reviews/?filter=5#new-post" class="wdcl-review-deserve button-primary" target="_blank">
							<?php esc_html_e('Ok, you deserve it', 'wdcl-wow-divi-carousel-lite'); ?>
						</a>
						<span class="dashicons dashicons-calendar"></span>
						<a href="#" class="wdcl-review-later">
							<?php esc_html_e('Nope, maybe later', 'wdcl-wow-divi-carousel-lite'); ?>
						</a>
						<span class="dashicons dashicons-smiley"></span>
						<a href="#" class="wdcl-review-done">
							<?php esc_html_e('I already did', 'wdcl-wow-divi-carousel-lite'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>

<?php
	}

	public function ajax_dismiss_notice()
	{

		if (!current_user_can('manage_options')) {
			return;
		}

		if (!check_ajax_referer('wdcl-dismiss-notice', 'nonce')) {
			wp_send_json_error();
		}

		if ($_POST['repeat'] == 'true') {
			set_transient('wdcl-notice-rating', true, WEEK_IN_SECONDS);
		} else {
			update_user_meta(get_current_user_id(), 'wdcl-notice-rating', 'dismissed');
		}

		wp_send_json_success();
	}
}
