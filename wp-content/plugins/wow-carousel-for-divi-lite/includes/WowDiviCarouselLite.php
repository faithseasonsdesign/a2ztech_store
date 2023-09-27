<?php

class WDCL_WowDiviCarouselLite extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'wdcl-wow-divi-carousel-lite';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'wow-divi-carousel-lite';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = WDCL_PLUGIN_VERSION;

	/**
	 * WDCL_WowDiviCarouselLite constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'wow-divi-carousel-lite', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );
	}
}

new WDCL_WowDiviCarouselLite();
