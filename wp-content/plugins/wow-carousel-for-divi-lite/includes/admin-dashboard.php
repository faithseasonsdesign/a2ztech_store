<?php

namespace WowDiviCarouselLite;

defined('ABSPATH') || die();

class Admin_Dashboard
{
    const MODULES_NONCE = 'wdcl_save_admin';

    public function __construct()
    {
        if (!wdcl_has_pro()) {
            add_action('admin_menu', [__CLASS__, 'add_menu'], 21);
        }

        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_scripts'], 21);
        add_filter('plugin_action_links_' . plugin_basename(WDCL_PLUGIN_FILE), [__CLASS__, 'add_action_links']);
    }

    public static function add_menu()
    {
        add_menu_page(
            __('WowCarousel', 'wdcl-wow-divi-carousel-lite'),
            __('WowCarousel', 'wdcl-wow-divi-carousel-lite'),
            'manage_options',
            'wow-divi-carousel-lite',
            [__CLASS__, 'render_main'],
            wdcl_white_svg_icon(),
            111
        );
    }

    public static function add_action_links($links)
    {
        if (!current_user_can('manage_options')) {
            return $links;
        }

        $links = array_merge(
            $links,
            [
                sprintf(
                    '<a target="_blank" style="color:#e2498a; font-weight: bold;" href="%s">%s</a>',
                    'https://divipeople.com/plugins/wow-divi-carousel/',
                    esc_html__('Get Pro', 'wdcl-wow-divi-carousel-lite')
                ),
            ]
        );

        return $links;
    }

    public static function enqueue_scripts()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        wp_enqueue_style(
            'wdcl-admin',
            WDCL_PLUGIN_ASSETS . 'admin/css/admin.css'
        );

        wp_enqueue_script(
            'wdcl-admin-js',
            WDCL_PLUGIN_ASSETS . 'admin/js/admin.js',
            ['jquery'],
            WDCL_PLUGIN_VERSION,
            true
        );

        wp_localize_script(
            'wdcl-admin-js',
            'dismissible_notice',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('wdcl-dismiss-notice'),
                'action'  => 'wdcl-dismiss-notice',
            ]
        );
    }

    // private static function get_all_modules()
    // {
    //     $modules_map = [

    //         'image-carousel'   => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-image-carousel/',
    //             'title'   => __('Image Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => true,
    //         ],

    //         'logo-carousel'    => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-logo-carousel/',
    //             'title'   => __('Logo Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => true,
    //         ],

    //         'content-carousel' => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-content-carousel/',
    //             'title'   => __('Content Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'card-carousel'    => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-card-carousel/',
    //             'title'   => __('Card Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'team-carousel'    => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-team-carousel/',
    //             'title'   => __('Team Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'testimonial'      => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-testimonial-carousel/',
    //             'title'   => __('Testimonial Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'divi-library'     => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-smart-slider/',
    //             'title'   => __('Divi Library Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'post-carousel'    => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-post-carousel/',
    //             'title'   => __('Post Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'twitter-feed'     => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-twitter-feed/',
    //             'title'   => __('Twitter Feed', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => true,
    //         ],

    //         'product-carousel' => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-woocommerce-products/',
    //             'title'   => __('Product Carousel', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'google-reviews'   => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-google-review/',
    //             'title'   => __('Google Review', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],

    //         'instagram-feed'   => [
    //             'demo'    => 'https://demo.divipeople.com/plugins/wow-carousel/wow-instagram-feed/',
    //             'title'   => __('Instagram Feed', 'wdcl-wow-divi-carousel-lite'),
    //             'is_free' => false,
    //         ],
    //     ];

    //     return $modules_map;
    // }

    // private static function get_all_plugins()
    // {
    //     $plugins_map = [
    //         [
    //             'name' => 'Divi ConKit Pro',
    //             'slug' => 'divi-conkit-pro',
    //             'desc' => 'Divi ConKit Pro is the best total solutions for the Divi builder. This plugin comes with the most advanced modules and extensions.',
    //         ],
    //         [
    //             'name' => 'Divi Instagram Feed',
    //             'slug' => 'divi-instagram-feed',
    //             'desc' => 'Divi Instagram Feed is one of the best Instagram feed plugins for Divi. This plugin comes with two featureful Instagram modules.',
    //         ],
    //         [
    //             'name' => 'Divi Blog Pro',
    //             'slug' => 'divi-blog-pro',
    //             'desc' => 'It allows you to display posts with different layouts using different modules, such as Post Masonry, Post Grid, Post Ticker, and more.',
    //         ],
    //         [
    //             'name' => 'Divi Social Plus',
    //             'slug' => 'divi-social-plus',
    //             'desc' => 'This is one of the most worthwhile social media sharing & social feed plugins in Divi. It has the most advanced social modules.',
    //         ],
    //         [
    //             'name' => 'Wow Divi Carousel',
    //             'slug' => 'wow-divi-carousel',
    //             'desc' => 'This the most powerful and user-friendly Divi Carousel plugin to create beautiful carousels with Images, Posts, Products.',
    //         ],
    //         [
    //             'name' => 'Divi Carousel Pro',
    //             'slug' => 'divi-carousel-pro',
    //             'desc' => 'Not unlike other typical carousel plugins, Divi carousel pro will bring your designing experience to the upper level.',
    //         ],
    //         [
    //             'name' => 'Divi Timeline Plus',
    //             'slug' => 'divi-timeline-plus',
    //             'desc' => 'Divi Timeline Plus is the most worthwhile timeline plugin for the Divi Builder. This is the best plugin to create timelines.',
    //         ],
    //         [
    //             'name' => 'Divi Menu Plus',
    //             'slug' => 'divi-menu-plus',
    //             'desc' => 'Divi Menu Plus is the ultimate solution for the Divi websites menu. This is a top-notch plugin to create the mega menu and off-canvas.',
    //         ],
    //         [
    //             'name' => 'Divi Hotspots Plus',
    //             'slug' => 'divi-hotspots-plus',
    //             'desc' => 'Divi Hotspots Plus plugin lets you make the image area hotspots with custom tooltips so that users can click on the hotspots.',
    //         ],
    //         [
    //             'name' => 'Divi Flipbox Plus',
    //             'slug' => 'divi-flipbox-plus',
    //             'desc' => 'Bring a new life to your boring content by using the Divi Flipbox Plus plugin animation effect and construct it looks attractive for visitors.',
    //         ],
    //         [
    //             'name' => 'Divi Image Plus',
    //             'slug' => 'divi-image-plus',
    //             'desc' => 'Divi Image Plus comes with numerous outstanding featured image modules. Those modules are most needed and most worthwhile.',
    //         ],
    //         [
    //             'name' => 'Divi Animated Gallery',
    //             'slug' => 'divi-animated-gallery',
    //             'desc' => 'It ensures you for getting a beautiful animated gallery on your website with less effort! And comes with multiple animations and layouts.',
    //         ],
    //         [
    //             'name' => 'Divi Video Carousel',
    //             'slug' => 'divi-video-carousel',
    //             'desc' => 'Divi Video Carousel plugin comes with numerous outstanding features that have been developed for the Divi Theme & Builder.',
    //         ],
    //         [
    //             'name' => 'Divi Contact Form 7',
    //             'slug' => 'contact-form-7-for-divi',
    //             'desc' => 'Divi Contact Form 7 Styler is a plugin with many features in the Divi marketplace. You can feel free design a form with this plugin.',
    //         ],
    //     ];

    //     return $plugins_map;
    // }

    // public static function get_modules()
    // {
    //     $modules_map = self::get_all_modules();

    //     return $modules_map;
    // }

    // public static function get_plugins()
    // {
    //     $plugins_map = self::get_all_plugins();

    //     return $plugins_map;
    // }

    private static function load_template($template)
    {
        $file = WDCL_PLUGIN_DIR . 'templates/admin/admin-' . $template . '.php';

        if (is_readable($file)) {
            include $file;
        }
    }

    public static function render_main()
    {
        self::load_template('main');
    }

    // public static function render_plugins()
    // {
    //     self::load_template('plugins');
    // }
}

new Admin_Dashboard();
