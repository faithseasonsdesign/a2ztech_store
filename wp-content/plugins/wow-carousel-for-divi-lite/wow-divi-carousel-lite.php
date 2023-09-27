<?php
/*
Plugin Name: Divi Carousel Lite
Plugin URI:  https://wordpress.org/plugins/wow-carousel-for-divi-lite/
Description: Best carousel plugin for Divi. Create beautiful carousels with Divi Carousel Lite. Add unlimited carousels to your Divi website.
Version:     1.2.12
Author:      wowcarousel
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wdcl-wow-divi-carousel-lite
Domain Path: /languages

Wow Carousel for Divi Lite is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Wow Carousel for Divi Lite is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Wow Carousel for Divi Lite. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('WDCL_PLUGIN_VERSION', '1.2.12');
define('WDCL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WDCL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WDCL_PLUGIN_ASSETS', trailingslashit(WDCL_PLUGIN_URL . 'assets'));
define('WDCL_PLUGIN_FILE', __FILE__);
define('WDCL_PLUGIN_BASE', plugin_basename(__FILE__));

function wdcl_plugin_activation_hook()
{

    if (get_option('wdcl_activation_time') === false) {
        update_option('wdcl_activation_time', strtotime("now"));
    }

    update_option('wdcl_active_version', WDCL_PLUGIN_VERSION);
    update_option('has_wdcl', true);
}

wdcl_plugin_activation_hook();

function wdcl_has_pro()
{
    return defined('WOW_DIVI_CAROUSEL_VERSION');
}

function wdcl_white_svg_icon()
{
    return 'data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMTQuOTEgMTE0LjkxIj48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2ZmZjt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPnN2ZzwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTEwLjQ4LDM1LjMzbC0zLjkxLDUuOTRhNi41OCw2LjU4LDAsMCwwLS45LDUuMSw0OS40Niw0OS40NiwwLDEsMS05NC4zMy02LjhjMC4xMS0uMjguMjItMC41NiwwLjM0LTAuODRBNDkuNDIsNDkuNDIsMCwwLDEsOTMuNDUsMjMuNTZhNy41LDcuNSwwLDAsMCwxMC42MS4zM2gwQTU3LjE5LDU3LjE5LDAsMSwwLDExMC40OCwzNS4zM1ptLTguMTIsMS40MSw1LTcuNjZhMC4yMSwwLjIxLDAsMCwwLDAtLjA2bC02LDUuNjVDMTAxLjcxLDM1LjM1LDEwMiwzNiwxMDIuMzYsMzYuNzRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDAuMDIpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTAuODMsMzguNzNoMC44NGMtMC4xMi4yOC0uMjMsMC41Ni0wLjM0LDAuODRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDAuMDIpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTA3LjU4LDI4LjgybC0wLjE3LjI2LTUsNy42Nkw3My41OSw4MC4zOSw1OS4yOSw1Ni4xNmExLjA5LDEuMDksMCwwLDAtMS44NiwwbC0xNSwyNC4yNUwyMS4zNSw0NC43M2g2LjA2YTkuMzgsOS4zOCwwLDAsMSw4LjE4LDQuNzlMNDEuODcsNjAuNyw1MC42LDQ4LjI4YTkuNTMsOS41MywwLDAsMSwxNS42Ny4xMmw4LDExLjczLDI3LjA5LTI1LjQ2LDYtNS42NVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMC4wMikiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0xMDcuNTgsMjguODJsLTAuMTcuMjYtNSw3LjY2TDczLjU5LDgwLjM5LDU5LjI5LDU2LjE2YTEuMDksMS4wOSwwLDAsMC0xLjg2LDBsLTE1LDI0LjI1TDIxLjM1LDQ0LjczaDYuMDZhOS4zOCw5LjM4LDAsMCwxLDguMTgsNC43OUw0MS44Nyw2MC43LDUwLjYsNDguMjhhOS41Myw5LjUzLDAsMCwxLDE1LjY3LjEybDgsMTEuNzMsMjcuMDktMjUuNDYsNi01LjY1WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwLjAyKSIvPjwvc3ZnPg==';
}

require_once WDCL_PLUGIN_DIR . 'includes/assets-manager.php';
require_once WDCL_PLUGIN_DIR . 'includes/admin-dashboard.php';
require_once WDCL_PLUGIN_DIR . 'includes/notices.php';

if (!function_exists('wdcl_initialize_extension')) :

    function wdcl_initialize_extension()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/WowDiviCarouselLite.php';
    }

    add_action('divi_extensions_init', 'wdcl_initialize_extension');
endif;

// Get Feedback.
function wdclInitFeedback()
{
    $feedback = true;

    if ($feedback) {
        new WDCL_Admin_Feedback();
    }
}

// Kickoff.
if (is_admin()) {
    wdclInitFeedback();
}
