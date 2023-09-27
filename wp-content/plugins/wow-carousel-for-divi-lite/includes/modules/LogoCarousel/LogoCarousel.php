<?php

class WDCL_LogoCarousel extends WDCL_Builder_Module {

    protected $module_credits = [
        'module_uri' => 'https://wowcarousel.com/modules/logo-carousel/',
        'author'     => 'Wow Carousel',
        'author_uri' => 'https://wowcarousel.com/',
    ];

    public function init() {

        $this->name       = esc_html__( 'Wow Logo Carousel', 'wdcl-wow-divi-carousel-lite' );
        $this->slug       = 'wdcl_logo_carousel';
        $this->vb_support = 'on';
        $this->child_slug = 'wdcl_logo_carousel_child';
        $this->icon_path  = plugin_dir_path( __FILE__ ) . 'logo-carousel.svg';

        $this->settings_modal_toggles = [
            'general'  => [
                'toggles' => [
                    'settings'      => [
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
                    'logo_settings' => [
                        'title' => esc_html__( 'Logo Settings', 'wdcl-wow-divi-carousel-lite' ),
                    ],
                ],
            ],

            'advanced' => [
                'toggles' => [
                    'carousel'   => [
                        'title' => esc_html__( 'Carousel', 'wdcl-wow-divi-carousel-lite' ),
                    ],
                    'arrow'      => [
                        'title'             => esc_html__( 'Navigation', 'wdcl-wow-divi-carousel-lite' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'arrow_common' => [
                                'name' => esc_html__( 'Common', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'arrow_left'   => [
                                'name' => esc_html__( 'Left', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'arrow_right'  => [
                                'name' => esc_html__( 'Right', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                        ],
                    ],
                    'pagination' => [
                        'title'             => esc_html__( 'Pagination', 'wdcl-wow-divi-carousel-lite' ),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'pagi_common' => [
                                'name' => esc_html__( 'Common', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                            'pagi_active' => [
                                'name' => esc_html__( 'Active', 'wdcl-wow-divi-carousel-lite' ),
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function get_fields() {

        $carousel_options = WDCL_Builder_Module::_get_carousel_option_fields( 'carousel', [] );

        $logo_options = [

            'logo_hover'  => [
                'label'       => esc_html__( 'Image Hover Animation', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'toggle_slug' => 'logo_settings',
                'default'     => 'zoom_in',
                'options'     => [
                    'no_hover'      => esc_html__( 'None', 'dp-divi-addons' ),
                    'zoom_in'       => esc_html__( 'Zoom In', 'dp-divi-addons' ),
                    'zoom_out'      => esc_html__( 'Zoom Out', 'dp-divi-addons' ),
                    'fade'          => esc_html__( 'Fade', 'dp-divi-addons' ),
                    'black_n_white' => esc_html__( 'Black and White', 'dp-divi-addons' ),
                ],
            ],

            'logo_height' => [
                'label'           => esc_html__( 'Height', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => 'auto',
                'default_unit'    => 'px',
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 1,
                    'max'  => 1000,
                ],
                'toggle_slug'     => 'logo_settings',
                'mobile_options'  => true,
            ],

            'logo_width'  => [
                'label'           => esc_html__( 'Width', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => 'auto',
                'default_unit'    => 'px',
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 1,
                    'max'  => 1000,
                ],
                'toggle_slug'     => 'logo_settings',
                'mobile_options'  => true,
            ],
        ];

        return array_merge( $carousel_options, $logo_options );
    }

    public function get_advanced_fields_config() {

        $advanced_fields = [];

        $advanced_fields['text']         = false;
        $advanced_fields['borders']      = false;
        $advanced_fields['text_shadow']  = false;
        $advanced_fields['link_options'] = false;
        $advanced_fields['fonts']        = false;

        return $advanced_fields;
    }

    public function render( $attrs, $content, $render_slug ) {

        // Props
        $content          = $this->props['content'];
        $logo_hover       = $this->props['logo_hover'];
        $is_center        = $this->props['is_center'];
        $center_mode_type = $this->props['center_mode_type'];
        $custom_cursor    = $this->props['custom_cursor'];
        $sliding_dir      = $this->props['sliding_dir'];

        // Render CSS
        $this->_render_css( $render_slug );

        $classes = [];

        array_push( $classes, $logo_hover );

        if ( $is_center === 'on' ) {
            array_push( $classes, 'wdcl-centered' );
            array_push( $classes, "wdcl-centered--{$center_mode_type}" );
        }

        if ( $custom_cursor === 'on' ) {
            array_push( $classes, 'wdcl-cursor' );
        }

        $output = sprintf(
            '<div dir="%4$s" class="wdcl-carousel wdcl-logo-carousel wdcl-carousel-frontend %3$s" %2$s >
                %1$s
            </div>',
            $content,
            $this->get_carousel_options_data(),
            join( ' ', $classes ),
            $sliding_dir
        );

        return $output;
    }

    public function _render_logo_css( $render_slug ) {

        $logo_height                   = $this->props['logo_height'];
        $logo_height_tablet            = $this->props['logo_height_tablet'];
        $logo_height_phone             = $this->props['logo_height_phone'];
        $logo_height_last_edited       = $this->props['logo_height_last_edited'];
        $logo_height_responsive_status = et_pb_get_responsive_status( $logo_height_last_edited );

        $logo_width                   = $this->props['logo_width'];
        $logo_width_tablet            = $this->props['logo_width_tablet'];
        $logo_width_phone             = $this->props['logo_width_phone'];
        $logo_width_last_edited       = $this->props['logo_width_last_edited'];
        $logo_width_responsive_status = et_pb_get_responsive_status( $logo_width_last_edited );

        if ( $logo_height !== 'auto' ) {

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-logo-carousel-item',
                    'declaration' => sprintf( 'height: %1$s;display: flex; justify-content: center; align-items: center;', $logo_height ),
                ]
            );

            if ( $logo_height_tablet && $logo_height_responsive_status ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .wdcl-logo-carousel-item',
                        'declaration' => sprintf( 'height: %1$s;display: flex; justify-content: center; align-items: center; ', $logo_height_tablet ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    ]
                );
            }

            if ( $logo_height_phone && $logo_height_responsive_status ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .wdcl-logo-carousel-item',
                        'declaration' => sprintf( 'height: %1$s; display: flex; justify-content: center; align-items: center;`', $logo_height_phone ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    ]
                );
            }

        }

        if ( $logo_width !== 'auto' ) {

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-logo-carousel-item img',
                    'declaration' => sprintf( 'width: %1$s;', $logo_width ),
                ]
            );

            if ( $logo_width_tablet && $logo_width_responsive_status ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .wdcl-logo-carousel-item img',
                        'declaration' => sprintf( 'width: %1$s;', $logo_width_tablet ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    ]
                );
            }

            if ( $logo_width_phone && $logo_width_responsive_status ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .wdcl-logo-carousel-item img',
                        'declaration' => sprintf( 'width: %1$s;`', $logo_width_phone ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    ]
                );
            }

        }

    }

    public function _render_css( $render_slug ) {

        // Carousel CSS
        $this->get_carousel_css( $render_slug );

        // Logo carousel
        $this->_render_logo_css( $render_slug );
    }

}

new WDCL_LogoCarousel();
