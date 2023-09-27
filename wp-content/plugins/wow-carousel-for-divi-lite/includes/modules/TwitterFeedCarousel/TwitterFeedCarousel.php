<?php

class WDCL_Twitter_Feed_Carousel extends WDCL_Builder_Module {

    protected $module_credits = [
        'module_uri' => 'https://wowcarousel.com/modules/twitter-feed/',
        'author'     => 'Wow Carousel',
        'author_uri' => 'https://wowcarousel.com/',
    ];

    public function init() {

        $this->vb_support = 'on';
        $this->name       = esc_html__( 'Wow Twitter Feed', 'wdcl-wow-divi-carousel-lite' );
        $this->slug       = 'wdcl_twitter_feed_carousel';
        $this->icon_path  = plugin_dir_path( __FILE__ ) . 'twitter-feed.svg';

        $this->settings_modal_toggles = [
            'general'  => [
                'toggles' => [
                    'twitter_feed'     => esc_html__( 'Twitter Feed', 'wdcl-wow-divi-carousel-lite' ),
                    'twitter_settings' => esc_html__( 'Twitter Settings', 'wdcl-wow-divi-carousel-lite' ),
                    'general_settings' => esc_html__( 'General Settings', 'wdcl-wow-divi-carousel-lite' ),
                    'settings'         => [
                        'title'             => esc_html__( 'Carousel Settings', 'wdcl-wow-divi-carousel-lite' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'general'  => [
                                'name' => esc_html__( 'General', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'advanced' => [
                                'name' => esc_html__( 'Advanced', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                        ],
                    ],
                ],
            ],

            'advanced' => [
                'toggles' => [
                    'common'     => esc_html__( 'Common', 'wdcl-wow-divi-carousel-lite' ),
                    'tweets'     => esc_html__( 'Tweets Box', 'wdcl-wow-divi-carousel-lite' ),
                    'user_info'  => esc_html__( 'User Info', 'wdcl-wow-divi-carousel-lite' ),
                    'user_text'  => [
                        'title'             => esc_html__( 'User Text', 'wdcl-wow-divi-carousel-lite' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'name'     => [
                                'name' => esc_html__( 'Name', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'username' => [
                                'name' => esc_html__( 'Username', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                        ],
                    ],
                    'content'    => [
                        'title'             => esc_html__( 'Content', 'wdcl-wow-divi-carousel-lite' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'description' => [
                                'name' => esc_html__( 'Description', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'read_more'   => [
                                'name' => esc_html__( 'Read More', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'date'        => [
                                'name' => esc_html__( 'Date', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                        ],
                    ],
                    'footer'     => esc_html__( 'Footer', 'wdcl-wow-divi-carousel-lite' ),
                    'arrow'      => [
                        'title'             => esc_html__( 'Navigation', 'wdcl-wow-divi-carousel-lite' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'arrow_common' => [
                                'name' => esc_html( 'Common', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'arrow_left'   => [
                                'name' => esc_html( 'Left', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'arrow_right'  => [
                                'name' => esc_html( 'Right', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                        ],
                    ],
                    'pagination' => [
                        'title'             => esc_html( 'Pagination', 'wdcl-wow-divi-carousel-lite' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'pagi_common' => [
                                'name' => esc_html( 'Common', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'pagi_active' => [
                                'name' => esc_html( 'Active', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function get_fields() {

        $fields = [

            // Twitter Feed.
            'user_name'           => [
                'label'            => __( 'User Name', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'text',
                'default'          => '@divipeople',
                'description'      => __( 'Use @ sign with your Twitter user name.', 'wdcl-wow-divi-carousel-lite' ),
                'toggle_slug'      => 'twitter_feed',
                'computed_affects' => ['__feed'],
            ],

            'consumer_key'        => [
                'label'            => __( 'Consumer Key', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'text',
                'default'          => 'okjSlxMnSMCKTKlBVjPhg5R1v',
                'description'      => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Key.</a> Create a new app or select existing app and grab the consumer key.',
                'toggle_slug'      => 'twitter_feed',
                'computed_affects' => ['__feed'],
            ],

            'consumer_secret'     => [
                'label'            => __( 'Consumer Secret', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'text',
                'default'          => '8GhKIROr4kT1byyCqiXsJkttS3BXqePOJlWN2TfKCVgenHMCeb',
                'description'      => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Secret key.</a> Create a new app or select existing app and grab the consumer secret.',
                'toggle_slug'      => 'twitter_feed',
                'computed_affects' => ['__feed'],
            ],

            // Twitter Settings
            'sort_by'             => [
                'label'            => __( 'Sort By', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'select',
                'default'          => 'recent-posts',
                'options'          => [
                    'recent-posts'   => __( 'Recent Posts', 'wdcl-wow-divi-carousel-lite' ),
                    'old-posts'      => __( 'Old Posts', 'wdcl-wow-divi-carousel-lite' ),
                    'favorite_count' => __( 'Favorite', 'wdcl-wow-divi-carousel-lite' ),
                    'retweet_count'  => __( 'Retweet', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'tweets_limit'        => [
                'label'            => __( 'Number of tweets to show', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'range',
                'default'          => '8',
                'unitless'         => true,
                'range_settings'   => [
                    'step' => 1,
                    'min'  => 3,
                    'max'  => 24,
                ],
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'show_twitter_icon'   => [
                'label'            => __( 'Show Twitter Logo', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'show_user_image'     => [
                'label'            => __( 'Show User Image', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'show_name'           => [
                'label'            => __( 'Show Name', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'show_user_name'      => [
                'label'            => __( 'Show User Name', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'off',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'show_date'           => [
                'label'            => __( 'Show Date', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'show_favorite'       => [
                'label'            => __( 'Show Favorite', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'show_retweet'        => [
                'label'            => __( 'Show Retweet', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => ['__feed'],
            ],

            'read_more'           => [
                'label'            => __( ' Show Read More', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => __( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'twitter_settings',
                'computed_affects' => [
                    '__feed',
                ],
            ],

            'read_more_text'      => [
                'label'            => __( 'Read More Text', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'text',
                'default'          => 'Read More',
                'description'      => __( 'Use @ sign with your Twitter user name.', 'wdcl-wow-divi-carousel-lite' ),
                'toggle_slug'      => 'twitter_settings',
                'show_if'          => ['read_more' => 'on'],
                'computed_affects' => [
                    '__feed',
                ],
            ],

            // Genegal Settings
            'alignment'           => [
                'label'            => __( 'Alignment', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'text_align',
                'options'          => et_builder_get_text_orientation_options( ['justified'] ),
                'options_icon'     => 'module_align',
                'default'          => 'left',
                'toggle_slug'      => 'general_settings',
                'computed_affects' => ['__feed'],
            ],

            'footer_alignment'    => [
                'label'            => __( 'Footer Alignment', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'text_align',
                'options'          => et_builder_get_text_orientation_options( ['justified'] ),
                'options_icon'     => 'module_align',
                'default'          => 'right',
                'toggle_slug'      => 'general_settings',
                'computed_affects' => ['__feed'],
            ],

            /**
             * User Info
             */
            'user_info_spacing'   => [
                'label'          => __( 'User Info Spacing', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '20px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'user_info',
            ],

            'twitter_icon_size'   => [
                'label'          => __( 'Twitter Icon Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '20px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 50,
                ],
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'user_info',
            ],

            'profile_image_size'  => [
                'label'          => __( 'Profile Image Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '48px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 48,
                ],
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'user_info',
            ],

            /**
             * Tweets
             */
            'content_padding'     => [
                'label'          => __( 'Tweets Padding', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'custom_padding',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'tweets',
                'default'        => '50px|50px|50px|50px',
                'mobile_options' => true,
            ],

            'is_equal_height'     => [
                'label'           => esc_html__( 'Use Equal Height', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'description'     => esc_html__( 'Enable this to display all Box with same height.' ),
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'         => 'on',
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'tweets',
            ],

            // Description
            'description_spacing' => [
                'label'          => __( 'Bottom Spacing', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '25px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
                'mobile_options' => true,
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'content',
                'sub_toggle'     => 'description',
            ],

            // Footer
            'favorite_color'      => [
                'label'       => __( 'Favorite Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'footer',

                'show_if'     => ['show_favorite' => 'on'],
                'default'     => '#000000',
            ],

            'favorite_font_size'  => [
                'label'          => __( 'Favorite Text Font Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '14px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
                'mobile_options' => true,

                'show_if'        => ['show_favorite' => 'on'],
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'footer',
            ],

            'favorite_icon_color' => [
                'label'       => __( 'Favorite Icon Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'footer',

                'show_if'     => ['show_favorite' => 'on'],
                'default'     => '#000000',
            ],

            'favorite_icon_size'  => [
                'label'          => __( 'Favorite Icon Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '14px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
                'mobile_options' => true,

                'show_if'        => ['show_favorite' => 'on'],
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'footer',
            ],

            'retweet_color'       => [
                'label'       => __( 'Retweet Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'footer',
                'show_if'     => ['show_retweet' => 'on'],
                'default'     => '#000000',
            ],

            'retweet_font_size'   => [
                'label'          => __( 'Favorite Text Font Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '14px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
                'mobile_options' => true,
                'tab_slug'       => 'advanced',
                'show_if'        => ['show_retweet' => 'on'],
                'toggle_slug'    => 'footer',
            ],

            'retweet_icon_color'  => [
                'label'       => __( 'Retweet Icon Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'footer',
                'show_if'     => ['show_retweet' => 'on'],
                'default'     => '#000000',
            ],

            'retweet_icon_size'   => [
                'label'          => __( 'Retweet Icon Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'range',
                'default'        => '14px',
                'range_settings' => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
                'mobile_options' => true,
                'tab_slug'       => 'advanced',
                'show_if'        => ['show_retweet' => 'on'],
                'toggle_slug'    => 'footer',
            ],

            '__feed'              => [
                'type'                => 'computed',
                'computed_callback'   => ['WDCL_Twitter_Feed_Carousel', 'twitter_feed_render'],
                'computed_depends_on' => [
                    'user_name',
                    'consumer_key',
                    'consumer_secret',
                    'sort_by',
                    'tweets_limit',
                    'show_twitter_icon',
                    'show_user_image',
                    'show_name',
                    'show_user_name',
                    'show_date',
                    'show_favorite',
                    'show_retweet',
                    'read_more',
                    'read_more_text',
                ],
                'computed_minimum'    => [
                    'user_name',
                    'consumer_key',
                    'consumer_secret',
                ],
            ],
        ];

        $carousel_options   = WDCL_Builder_Module::_get_carousel_option_fields( 'common', ['equal_height'] );
        $additional_options = $this->_custom_advanced_background_fields( 'tweets_item', 'Tweets', 'advanced', 'tweets', ['color', 'gradient'] );

        return array_merge( $carousel_options, $fields, $additional_options );
    }

    public function get_advanced_fields_config() {

        $advanced_fields = [];

        $advanced_fields['text']        = false;
        $advanced_fields['text_shadow'] = false;
        $advanced_fields['fonts']       = false;

        $advanced_fields['borders']['tweets'] = [
            'css'          => [
                'main'      => [
                    'border_radii'  => '%%order_class%% .wdcl-twitter-feed-item-inner',
                    'border_styles' => '%%order_class%% .wdcl-twitter-feed-item-inner',
                ],
                'important' => 'all',
            ],
            'label_prefix' => esc_html__( 'Tweets Box', 'wdcl-wow-divi-carousel-lite' ),
            'defaults'     => [
                'border_radii'  => 'on|0px|0px|0px|0px',
                'border_styles' => [
                    'width' => '0px',
                    'color' => 'transparent',
                    'style' => 'solid',
                ],
            ],
            'tab_slug'     => 'advanced',
            'toggle_slug'  => 'tweets',
        ];

        $advanced_fields['borders']['avatar'] = [
            'css'          => [
                'main'      => [
                    'border_radii'  => '%%order_class%% .wdcl-twitter-feed-avatar',
                    'border_styles' => '%%order_class%% .wdcl-twitter-feed-avatar',
                ],
                'important' => 'all',
            ],
            'label_prefix' => esc_html__( 'Avatar Image', 'wdcl-wow-divi-carousel-lite' ),
            'defaults'     => [
                'border_radii'  => 'on|0px|0px|0px|0px',
                'border_styles' => [
                    'width' => '0px',
                    'color' => 'transparent',
                    'style' => 'solid',
                ],
            ],
            'tab_slug'     => 'advanced',
            'toggle_slug'  => 'user_info',
        ];

        $advanced_fields['box_shadow']['tweets'] = [
            'label'       => esc_html__( 'Tweets Box Shadow', 'wdcl-wow-divi-carousel-lite' ),
            'css'         => [
                'main'      => '%%order_class%% .wdcl-twitter-feed-item-inner',
                'important' => 'all',
            ],
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'tweets',
        ];

        $advanced_fields['box_shadow']['avatar'] = [
            'label'       => esc_html__( 'Avatar Box Shadow', 'wdcl-wow-divi-carousel-lite' ),
            'css'         => [
                'main'      => '%%order_class%% .wdcl-twitter-feed-avatar',
                'important' => 'all',
            ],
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'user_info',
        ];

        $advanced_fields['fonts']['name'] = [
            'css'             => [
                'main'      => '%%order_class%% .wdcl-twitter-feed-author-name',
                'important' => 'all',
            ],
            'line_height'     => [
                'range_settings' => [
                    'min'  => '1',
                    'max'  => '3',
                    'step' => '1',
                ],
            ],
            'hide_text_align' => true,
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'user_text',
            'sub_toggle'      => 'name',
        ];

        $advanced_fields['fonts']['username'] = [
            'css'             => [
                'main'      => '%%order_class%% .wdcl-twitter-feed-username',
                'important' => 'all',
            ],
            'line_height'     => [
                'range_settings' => [
                    'min'  => '1',
                    'max'  => '3',
                    'step' => '1',
                ],
            ],
            'hide_text_align' => true,
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'user_text',
            'sub_toggle'      => 'username',
        ];

        $advanced_fields['fonts']['description'] = [
            'css'             => [
                'main'      => '%%order_class%% .wdcl-twitter-feed-content p',
                'important' => 'all',
            ],
            'line_height'     => [
                'range_settings' => [
                    'min'  => '1',
                    'max'  => '3',
                    'step' => '1',
                ],
            ],
            'hide_text_align' => true,
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'content',
            'sub_toggle'      => 'description',
        ];

        $advanced_fields['fonts']['readmore'] = [
            'css'             => [
                'main'      => '%%order_class%% .wdcl-twitter-feed-content p a',
                'important' => 'all',
            ],
            'line_height'     => [
                'range_settings' => [
                    'min'  => '1',
                    'max'  => '3',
                    'step' => '1',
                ],
            ],
            'hide_text_align' => true,
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'content',
            'sub_toggle'      => 'read_more',
        ];

        $advanced_fields['fonts']['date'] = [
            'css'             => [
                'main'      => '%%order_class%% .wdcl-twitter-feed-date',
                'important' => 'all',
            ],
            'line_height'     => [
                'range_settings' => [
                    'min'  => '1',
                    'max'  => '3',
                    'step' => '1',
                ],
            ],
            'hide_text_align' => true,
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'content',
            'sub_toggle'      => 'date',
        ];

        return $advanced_fields;
    }

    public static function twitter_feed_render( $args = [], $conditional_tags = [], $current_page = [] ) {

        $defaults = [
            'user_name'         => '',
            'consumer_key'      => '',
            'consumer_secret'   => '',
            'sort_by'           => '',
            'tweets_limit'      => '',
            'show_twitter_icon' => '',
            'show_user_image'   => '',
            'show_name'         => '',
            'show_user_name'    => '',
            'show_date'         => '',
            'show_favorite'     => '',
            'show_retweet'      => '',
            'read_more'         => '',
            'read_more_text'    => '',
        ];

        $args = wp_parse_args( $args, $defaults );

        $wdcl_tweets_token = '_builder_tweet_token_lite';
        $wdcl_tweets_cash  = '_builder_tweet_cash_lite';
        $user_name         = trim( $args['user_name'] );

        if ( empty( $user_name ) || empty( $args['consumer_key'] ) || empty( $args['consumer_secret'] ) ) {
            return;
        }

        $transient_key = $user_name . $wdcl_tweets_cash;
        $twitter_data  = get_transient( $transient_key );
        $credentials   = base64_encode( $args['consumer_key'] . ':' . $args['consumer_secret'] );

        $messages = [];

        if ( $twitter_data === false ) {

            $auth_url      = 'https://api.twitter.com/oauth2/token';
            $auth_response = wp_remote_post(
                $auth_url,
                [
                    'method'      => 'POST',
                    'httpversion' => '1.1',
                    'blocking'    => true,
                    'headers'     => [
                        'Authorization' => 'Basic ' . $credentials,
                        'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
                    ],
                    'body'        => [
                        'grant_type' => 'client_credentials',
                    ],
                ]
            );

            $body  = json_decode( wp_remote_retrieve_body( $auth_response ) );
            $token = $body->access_token;

            // Twitter Url
            $twitter_url     = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $user_name . '&count=999&tweet_mode=extended';
            $tweets_response = wp_remote_get(
                $twitter_url,
                [
                    'httpversion' => '1.1',
                    'blocking'    => true,
                    'headers'     => ['Authorization' => "Bearer $token"],
                ]
            );

            $twitter_data = json_decode( wp_remote_retrieve_body( $tweets_response ), true );
            set_transient( $user_name . $wdcl_tweets_cash, $twitter_data, 5 * MINUTE_IN_SECONDS );
        }

        if ( !empty( $twitter_data ) && array_key_exists( 'errors', $twitter_data ) ) {

            foreach ( $twitter_data['errors'] as $error ) {
                $messages['error'] = $error['message'];
            }

        } elseif ( count( $twitter_data ) < $args['tweets_limit'] ) {
            $messages['item_limit'] = __( '"Number of Tweets to show" is more than your actual total Tweets\'s number. You have only ' . count( $twitter_data ) . ' Tweets', 'wdcl-wow-divi-carousel-lite' );

        }

        if ( !empty( $messages ) ) {

            foreach ( $messages as $key => $message ) {
                $output = sprintf( '<div class="wdcl-%2$s wdcl-tweet-error-message">%1$s</div>', esc_html( $message ), esc_html( $key ) );
            }

            return $output;
        }

        switch ( $args['sort_by'] ) {

        case 'old-posts':
            usort(
                $twitter_data,
                function ( $a, $b ) {

                    if ( strtotime( $a['created_at'] ) == strtotime( $b['created_at'] ) ) {
                        return 0;
                    }

                    return ( strtotime( $a['created_at'] ) < strtotime( $b['created_at'] ) ? -1 : 1 );
                }
            );
            break;

        case 'favorite_count':
            usort(
                $twitter_data,
                function ( $a, $b ) {

                    if ( $a['favorite_count'] == $b['favorite_count'] ) {
                        return 0;
                    }

                    return ( $a['favorite_count'] > $b['favorite_count'] ) ? -1 : 1;
                }
            );
            break;

        case 'retweet_count':
            usort(
                $twitter_data,
                function ( $a, $b ) {

                    if ( $a['retweet_count'] == $b['retweet_count'] ) {
                        return 0;
                    }

                    return ( $a['retweet_count'] > $b['retweet_count'] ) ? -1 : 1;
                }
            );
            break;
        default:
            $twitter_data;

        }

        if ( !empty( $args['tweets_limit'] ) && count( $twitter_data ) > $args['tweets_limit'] ) {
            $items = array_splice( $twitter_data, 0, $args['tweets_limit'] );
        }

        if ( empty( $args['tweets_limit'] ) ) {
            $items = $twitter_data;
        }

        ob_start();

        foreach ( $items as $item ): ?>

			<div class="wdcl-twitter-has-shadow wdcl-twitter-feed-item-inner">

				<?php

        if ( $args['show_twitter_icon'] == 'on' ): ?>
					<div class="wdcl-twitter-feed-icon">
						<span>
							<svg version="1.1" id="wdcl-twitter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
								<path style="fill:#1da1f2;" d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
								c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
								c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
								c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
								c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
								c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
								C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
								C480.224,136.96,497.728,118.496,512,97.248z"/>
							</svg>
						</span>
					</div>
				<?php endif;?>

				<div class="wdcl-twitter-feed-inner-wrapper">
					<div class="wdcl-twitter-feed-author">

						<?php

        if ( $args['show_user_image'] == 'on' ): ?>

							<a href="<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>">
								<img
									src="<?php echo esc_url( $item['user']['profile_image_url_https'] ); ?>"
									alt="<?php echo esc_attr( $item['user']['name'] ); ?>"
									class="wdcl-twitter-feed-avatar"
								>
							</a>

						<?php endif;?>

						<div class="wdcl-twitter-feed-user">

							<?php

        if ( $args['show_name'] == 'on' ): ?>
								<a href="<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class="wdcl-twitter-feed-author-name">
									<?php echo esc_html( $item['user']['name'] ); ?>
								</a>
							<?php endif;?>

							<?php

        if ( $args['show_user_name'] == 'on' ): ?>
								<a href="<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class="wdcl-twitter-feed-username">
									<?php echo esc_html( $args['user_name'] ); ?>
								</a>
							<?php endif;?>
						</div>
					</div>
					<div class="wdcl-twitter-feed-content">

						<?php

        if ( isset( $item['entities']['urls'][0] ) ) {
            $content = str_replace( $item['entities']['urls'][0]['url'], '', $item['full_text'] );
        } else {
            $content = $item['full_text'];
        }

        ?>

						<div class="wdcl-inner-twitter-feed-content">
							<p>
								<?php echo esc_html( $content ); ?>
								<?php

        if ( $args['read_more'] == 'on' ): ?>
									<a href="<?php echo esc_url( '//twitter.com/' . $item['user']['screen_name'] . '/status/' . $item['id'] ); ?>" target="_blank">
										<?php echo esc_html( $args['read_more_text'] ); ?>
									</a>
								<?php endif;?>
							</p>
						</div>

						<?php

        if ( $args['show_date'] == 'on' ): ?>
							<div class="wdcl-twitter-feed-date">
								<?php echo esc_html( date( 'M d Y', strtotime( $item['created_at'] ) ) ); ?>
							</div>
						<?php endif;?>
					</div>
				</div>

				<?php

        if ( $args['show_favorite'] == 'on' || $args['show_retweet'] == 'on' ): ?>
					<div class="wdcl-twitter-feed-footer-wrapper">
						<div class="wdcl-twitter-feed-footer">
							<?php

        if ( $args['show_favorite'] == 'on' ): ?>
								<div class="wdcl-tweet-favorite">
									<?php echo esc_html( $item['favorite_count'] ); ?>
									<span class="et-pb-icon wdcl-icon wdcl-tweet-favorite-icon"></span>
								</div>
							<?php endif;?>

							<?php

        if ( $args['show_retweet'] == 'on' ): ?>
								<div class="wdcl-tweet-retweet">
									<?php echo esc_html( $item['retweet_count'] ); ?>
									<span class="et-pb-icon wdcl-icon wdcl-tweet-retweet-icon"></span>
								</div>
							<?php endif;?>
						</div>
					</div>
				<?php endif;?>
			</div>

			<?php

        endforeach;

        if ( !$output = ob_get_clean() ) {
            $output = 'Something is wrong';
        }

        return $output;
    }

    public function render( $attrs, $content, $render_slug ) {

        // Render Css
        $this->_render_css( $render_slug );

        // Props
        $user_name         = $this->props['user_name'];
        $consumer_key      = $this->props['consumer_key'];
        $consumer_secret   = $this->props['consumer_secret'];
        $sort_by           = $this->props['sort_by'];
        $tweets_limit      = $this->props['tweets_limit'];
        $show_twitter_icon = $this->props['show_twitter_icon'];
        $show_user_image   = $this->props['show_user_image'];
        $show_name         = $this->props['show_name'];
        $show_user_name    = $this->props['show_user_name'];
        $show_date         = $this->props['show_date'];
        $show_favorite     = $this->props['show_favorite'];
        $show_retweet      = $this->props['show_retweet'];
        $read_more         = $this->props['read_more'];
        $read_more_text    = $this->props['read_more_text'];
        $order_class       = self::get_module_order_class( $render_slug );
        $unique_number     = str_replace( '_', '', str_replace( $this->slug, '', $order_class ) );
        $wdcl_tweets_token = '_' . $unique_number . '_tweet_token_lite';
        $wdcl_tweets_cash  = '_' . $unique_number . '_tweet_cash_lite';
        $user_name         = trim( $user_name );
        $alignment         = $this->props['alignment'];

        // props carousel settings
        $is_equal_height  = $this->props['is_equal_height'];
        $is_center        = $this->props['is_center'];
        $center_mode_type = $this->props['center_mode_type'];
        $custom_cursor    = $this->props['custom_cursor'];

        if ( empty( $user_name ) || empty( $consumer_key ) || empty( $consumer_secret ) ) {
            return;
        }

        $transient_key = $user_name . $wdcl_tweets_cash;
        $twitter_data  = get_transient( $transient_key );
        $credentials   = base64_encode( $consumer_key . ':' . $consumer_secret );

        $messages = [];

        if ( $twitter_data === false ) {

            $auth_url = 'https://api.twitter.com/oauth2/token';

            $auth_response = wp_remote_post(
                $auth_url,
                [
                    'method'      => 'POST',
                    'httpversion' => '1.1',
                    'blocking'    => true,
                    'headers'     => [
                        'Authorization' => 'Basic ' . $credentials,
                        'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
                    ],
                    'body'        => [
                        'grant_type' => 'client_credentials',
                    ],
                ]
            );

            $body = json_decode( wp_remote_retrieve_body( $auth_response ) );

            $token = $body->access_token;

            // Twitter Url
            $twitter_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $user_name . '&count=999&tweet_mode=extended';

            $tweets_response = wp_remote_get(
                $twitter_url,
                [
                    'httpversion' => '1.1',
                    'blocking'    => true,
                    'headers'     => ['Authorization' => "Bearer $token"],
                ]
            );

            $twitter_data = json_decode( wp_remote_retrieve_body( $tweets_response ), true );
            set_transient( $user_name . $wdcl_tweets_cash, $twitter_data, 5 * MINUTE_IN_SECONDS );

        }

        if ( !empty( $twitter_data ) && array_key_exists( 'errors', $twitter_data ) ) {

            foreach ( $twitter_data['errors'] as $error ) {
                $messages['error'] = $error['message'];
            }

        } elseif ( count( $twitter_data ) < $tweets_limit ) {

            $messages['item_limit'] = __( ' "Number of Tweets to show"  is more than your actual total Tweets\'s number. You have only ' . count( $twitter_data ) . ' Tweets', 'wdcl-wow-divi-carousel-lite' );

        }

        if ( !empty( $messages ) ) {

            foreach ( $messages as $key => $message ) {
                $output = sprintf( '<div class="wdcl-tweet-error-message">%1$s</div>', esc_html( $message ) );
            }

            return $output;

        }

        switch ( $sort_by ) {

        case 'old-posts':
            usort(
                $twitter_data,
                function ( $a, $b ) {

                    if ( strtotime( $a['created_at'] ) == strtotime( $b['created_at'] ) ) {
                        return 0;
                    }

                    return ( strtotime( $a['created_at'] ) < strtotime( $b['created_at'] ) ? -1 : 1 );
                }
            );
            break;

        case 'favorite_count':
            usort(
                $twitter_data,
                function ( $a, $b ) {

                    if ( $a['favorite_count'] == $b['favorite_count'] ) {
                        return 0;
                    }

                    return ( $a['favorite_count'] > $b['favorite_count'] ) ? -1 : 1;
                }
            );
            break;

        case 'retweet_count':
            usort(
                $twitter_data,
                function ( $a, $b ) {

                    if ( $a['retweet_count'] == $b['retweet_count'] ) {
                        return 0;
                    }

                    return ( $a['retweet_count'] > $b['retweet_count'] ) ? -1 : 1;
                }
            );
            break;

        default:
            $twitter_data;

        }

        if ( !empty( $tweets_limit ) && count( $twitter_data ) > $tweets_limit ) {
            $items = array_splice( $twitter_data, 0, $tweets_limit );
        }

        if ( empty( $tweets_limit ) ) {
            $items = $twitter_data;
        }

        ob_start();

        foreach ( $items as $item ):
        ?>
			<div class="wdcl-twitter-feed-item">
				<div class="wdcl-twitter-feed-item-inner">

					<?php

        if ( $show_twitter_icon == 'on' ): ?>
						<div class="wdcl-twitter-feed-icon">
							<span>
								<svg version="1.1" id="wdcl-twitter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
									<path style="fill:#1da1f2;" d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
									c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
									c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
									c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
									c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
									c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
									C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
									C480.224,136.96,497.728,118.496,512,97.248z"/>
								</svg>
							</span>
						</div>
					<?php endif;?>

					<div class="wdcl-twitter-feed-inner-wrapper">
						<div class="wdcl-twitter-feed-author">

							<?php

        if ( $show_user_image == 'on' ): ?>
								<a href="<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>">
									<img
										src="<?php echo esc_url( $item['user']['profile_image_url_https'] ); ?>"
										alt="<?php echo esc_attr( $item['user']['name'] ); ?>"
										class="wdcl-twitter-feed-avatar"
									>
								</a>
							<?php endif;?>
							<div class="wdcl-twitter-feed-user">

								<?php

        if ( $show_name == 'on' ): ?>
									<a href="<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class="wdcl-twitter-feed-author-name">
										<?php echo esc_html( $item['user']['name'] ); ?>
									</a>
								<?php endif;?>

								<?php

        if ( $show_user_name == 'on' ): ?>
									<a href="<?php echo esc_url( 'https://twitter.com/' . $user_name ); ?>" class="wdcl-twitter-feed-username">
										<?php echo esc_html( $user_name ); ?>
									</a>
								<?php endif;?>

							</div>

						</div>

						<div class="wdcl-twitter-feed-content">

							<?php

        if ( isset( $item['entities']['urls'][0] ) ) {
            $content = str_replace( $item['entities']['urls'][0]['url'], '', $item['full_text'] );
        } else {
            $content = $item['full_text'];
        }

        ?>

							<div class="wdcl-inner-twitter-feed-content">
								<p>
									<?php echo esc_html( $content ); ?>
									<?php

        if ( $read_more == 'on' ): ?>
										<a href="<?php echo esc_url( '//twitter.com/' . $item['user']['screen_name'] . '/status/' . $item['id'] ); ?>" target="_blank">
											<?php echo esc_html( $read_more_text ); ?>
										</a>
									<?php endif;?>
								</p>
							</div>

							<?php

        if ( $show_date == 'on' ): ?>
								<div class="wdcl-twitter-feed-date">
									<?php echo esc_html( date( 'M d Y', strtotime( $item['created_at'] ) ) ); ?>
								</div>
							<?php endif;?>
						</div>
					</div>

					<?php

        if ( $show_favorite == 'on' || $show_retweet == 'on' ): ?>
						<div class="wdcl-twitter-feed-footer-wrapper">
							<div class="wdcl-twitter-feed-footer">
								<?php

        if ( $show_favorite == 'on' ): ?>
									<div class="wdcl-tweet-favorite">
										<?php echo esc_html( $item['favorite_count'] ); ?>
										<span class="et-pb-icon wdcl-icon wdcl-tweet-favorite-icon"></span>
									</div>
								<?php endif;?>

								<?php

        if ( $show_retweet == 'on' ): ?>
									<div class="wdcl-tweet-retweet">
										<?php echo esc_html( $item['retweet_count'] ); ?>
										<span class="et-pb-icon wdcl-icon wdcl-tweet-retweet-icon"></span>
									</div>
								<?php endif;?>
							</div>
						</div>
					<?php endif;?>

				</div>
			</div>
			<?php
endforeach;

        if ( !$twitter_items = ob_get_clean() ) {
            $twitter_items = 'Something is wrong!';
        }

        // CSS Classes
        $classes = [];

        if ( $is_center === 'on' ) {
            array_push( $classes, 'wdcl-centered' );
            array_push( $classes, "wdcl-centered--{$center_mode_type}" );
        }

        if ( $custom_cursor === 'on' ) {
            array_push( $classes, 'wdcl-cursor' );
        }

        array_push( $classes, "wdcl-twitter-{$alignment}" );
        array_push( $classes, "equal-height-{$is_equal_height}" );
        $sliding_dir = $this->props['sliding_dir'];

        $output = sprintf(
            '<div dir="%4$s" class="wdcl-carousel wdcl-carousel-jq wdcl-twitter-feed-carousel wdcl-carousel-frontend %2$s" %3$s>
				%1$s
			</div>',
            $twitter_items,
            join( ' ', $classes ),
            $this->get_carousel_options_data(),
            $sliding_dir
        );

        return $output;
    }

    public function _render_user_info_css( $render_slug ) {

        // Props: User info spacing
        $user_info_spacing                   = $this->props['user_info_spacing'];
        $user_info_spacing_tablet            = isset( $this->props['user_info_spacing_tablet'] ) ? $this->props['user_info_spacing_tablet'] : $user_info_spacing;
        $user_info_spacing_phone             = isset( $this->props['user_info_spacing_phone'] ) ? $this->props['user_info_spacing_phone'] : $user_info_spacing_tablet;
        $user_info_spacing_last_edited       = isset( $this->props['user_info_spacing_last_edited'] ) ? $this->props['user_info_spacing_last_edited'] : '';
        $user_info_spacing_responsive_status = et_pb_get_responsive_status( $user_info_spacing_last_edited );

        // Desktop
        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-author',
                'declaration' => sprintf( 'margin-bottom: %1$s;', $user_info_spacing ),
            ]
        );

// Tablet
        if ( $user_info_spacing_tablet && $user_info_spacing_responsive_status ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-twitter-feed-author',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'margin-bottom: %1$s;', $user_info_spacing_tablet ),
                ]
            );
        }

// Phone
        if ( $user_info_spacing_phone && $user_info_spacing_responsive_status ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-twitter-feed-author',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'margin-bottom: %1$s;', $user_info_spacing_phone ),
                ]
            );
        }

        // Twitter icon
        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-icon span',
                'declaration' => sprintf( 'width: %1$s; height: %1$s;', $this->props['twitter_icon_size'] ),
            ]
        );

        // User image size
        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-avatar',
                'declaration' => sprintf( 'width: %1$s; height: %1$s;', $this->props['profile_image_size'] ),
            ]
        );
    }

    public function _render_footer_css( $render_slug ) {

        $favorite_color      = $this->props['favorite_color'];
        $favorite_icon_color = $this->props['favorite_icon_color'];
        $favorite_font_size  = $this->props['favorite_font_size'];
        $favorite_icon_size  = $this->props['favorite_icon_size'];

        $retweet_color      = $this->props['retweet_color'];
        $retweet_icon_color = $this->props['retweet_icon_color'];
        $retweet_font_size  = $this->props['retweet_font_size'];
        $retweet_icon_size  = $this->props['retweet_icon_size'];

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-favorite',
                'declaration' => sprintf( 'color: %1$s !important;', $favorite_color ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-favorite',
                'declaration' => sprintf( 'font-size: %1$s !important;', $favorite_font_size ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-favorite span',
                'declaration' => sprintf( 'color: %1$s !important;', $favorite_icon_color ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-favorite span',
                'declaration' => sprintf( 'font-size: %1$s !important;', $favorite_icon_size ),
            ]
        );

        // Retweets
        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-retweet',
                'declaration' => sprintf( 'color: %1$s !important;', $retweet_color ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-retweet span',
                'declaration' => sprintf( 'color: %1$s !important;', $retweet_icon_color ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-retweet',
                'declaration' => sprintf( 'font-size: %1$s !important;', $retweet_font_size ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-tweet-retweet span',
                'declaration' => sprintf( 'font-size: %1$s !important;', $retweet_icon_size ),
            ]
        );
    }

    public function _render_content_css( $render_slug ) {

        $description_spacing                   = $this->props['description_spacing'];
        $description_spacing_tablet            = isset( $this->props['description_spacing_tablet'] ) ? $this->props['description_spacing_tablet'] : $description_spacing;
        $description_spacing_phone             = isset( $this->props['description_spacing_phone'] ) ? $this->props['description_spacing_phone'] : $description_spacing_tablet;
        $description_spacing_last_edited       = isset( $this->props['description_spacing_last_edited'] ) ? $this->props['description_spacing_last_edited'] : '';
        $description_spacing_responsive_status = et_pb_get_responsive_status( $description_spacing_last_edited );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-content p',
                'declaration' => sprintf( 'margin-bottom: %1$s !important;', $description_spacing ),
            ]
        );

        if ( $description_spacing_tablet && $description_spacing_responsive_status ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-twitter-feed-content p',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'margin-bottom: %1$s !important;', $description_spacing_tablet ),
                ]
            );
        }

        if ( $description_spacing_phone && $description_spacing_responsive_status ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-twitter-feed-content p',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'margin-bottom: %1$s !important;', $description_spacing_phone ),
                ]
            );
        }

        $content_padding                   = $this->props['content_padding'];
        $content_padding_phone             = $this->props['content_padding_phone'];
        $content_padding_tablet            = $this->props['content_padding_tablet'];
        $content_padding_last_edited       = $this->props['content_padding_last_edited'];
        $content_padding_responsive_status = et_pb_get_responsive_status( $content_padding_last_edited );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-inner-wrapper',
                'declaration' => $this->_process_padding( $content_padding, false ),
            ]
        );

// Tablet
        if ( $content_padding_tablet && $content_padding_responsive_status ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-twitter-feed-inner-wrapper',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => $this->_process_padding( $content_padding_tablet, false ),
                ]
            );

        }

        if ( $content_padding_phone && $content_padding_responsive_status ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-twitter-feed-inner-wrapper',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    'declaration' => $this->_process_padding( $content_padding_phone, false ),
                ]
            );
        }

    }

    public function _render_css( $render_slug ) {

        $this->get_carousel_css( $render_slug );
        $this->_render_content_css( $render_slug );
        $this->_render_user_info_css( $render_slug );

        // Item background
        $tweets_item_background = $this->_process_custom_advanced_background_fields( 'tweets_item', '' );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-item-inner',
                'declaration' => $tweets_item_background,
            ]
        );

        // Item background: hover
        $tweets_item_hover_background = $this->_process_custom_advanced_background_fields( 'tweets_item', '__hover' );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-item-inner:hover',
                'declaration' => $tweets_item_hover_background,
            ]
        );

        // footer css
        $this->_render_footer_css( $render_slug );

        // Footer Aligmment
        $footer_alignment = $this->props['footer_alignment'];
        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-twitter-feed-footer',
                'declaration' => sprintf( 'text-align: %1$s !important;', $footer_alignment ),
            ]
        );
    }

}

new WDCL_Twitter_Feed_Carousel();
