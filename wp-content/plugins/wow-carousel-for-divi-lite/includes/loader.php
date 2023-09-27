<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

require_once plugin_dir_path( __FILE__ ) . 'modules/ModulesCore/ModulesCore.php';

$module_files = glob( __DIR__ . '/modules/*/*.php' );

// Load custom Divi Builder modules.
$wdc_options = get_option( 'wdc_options' );
$wdcl_merge  = isset( $wdc_options['wdcl_merge'] ) ? $wdc_options['wdcl_merge'] : 'off';

if ( 'off' === $wdcl_merge ) {
	foreach ( (array) $module_files as $module_file ) {
		if ( $module_file && preg_match( "/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file ) ) {
			require_once $module_file;
		}
	}
}

