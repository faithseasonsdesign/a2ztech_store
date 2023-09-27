<?php

/**
 * Admin main template
 */

defined('ABSPATH') || die();

// $modules             = self::get_modules();
// $total_modules_count = count($modules);
?>
<div class="wrap">
	<h1 class="screen-reader-text"><?php esc_html_e('WowCarousel', 'wdcl-wow-divi-carousel-lite'); ?></h1>
	<div id="wdcl-header-upgrade-message">
		<p><span class="dashicons dashicons-info"></span>
			Thank you for using the free version of <b>Wow Divi Carousel</b>. <a href="https://divipeople.com/wow-divi-carousel/" target="_blank">Upgrade to Pro</a> for create beautiful carousels with Divi layout, Instagam Feed, Posts, Products, etc.</p>
	</div>
	<form class="wdcl-admin" id="wdcl-admin-form">
		<div class="wdcl-admin-header">
			<div class="wdcl-admin-logo-inline">
				<img class="wdcl-logo-icon-size" src="<?php echo WDCL_PLUGIN_ASSETS; ?>imgs/admin/wdcl-logo-white.svg" alt="">
			</div>
			<div class="wdcl-button-wrap">
				<a href="https://divipeople.com/wow-divi-carousel/" target="_blank" class="button wdcl-btn pro wdcl-btn-primary">
					<?php esc_html_e('UPGRADE TO PRO', 'wdcl-wow-divi-carousel-lite'); ?>
				</a>
			</div>
		</div>
		<div class="wdcl-admin-tabs">
			<div class="wdcl-admin-tabs-content">
				<div class="wdcl-admin-panel">
					<div class="wdcl-home-body">
						<div class="wdcl-row wdcl-row-fixed-width">
							<div class="wdcl-col wdcl-col-left">
								<h3 class="wdcl-feature-title">Knowledge Base</h3>
								<p class="wdcl-text f18">We understand the need of a helpful knowledge base and have that for you. It will help you to understand how our plugin works.</p>
								<a class="wdcl-btn wdcl-btn-primary" target="_blank" rel="noopener" href="https://docs.divipeople.com/docs/wow-carousel/">Take Me to The Knowledge Page</a>
							</div>
							<div class="wdcl-col wdcl-col-right">
								<img class="wdcl-img-fluid" src="<?php echo WDCL_PLUGIN_ASSETS; ?>imgs/admin/art1.png" alt="Knowledge Base">
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</form>
</div>