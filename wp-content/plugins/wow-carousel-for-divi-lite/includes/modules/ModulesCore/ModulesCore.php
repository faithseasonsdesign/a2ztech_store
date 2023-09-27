<?php
class WDCL_Builder_Module extends ET_Builder_Module {

    protected function _custom_advanced_background_fields( $option_name, $option_label, $tab_slug, $toggle_slug, array $background_tab = [], $show_if = [] ) {

        $color    = [];
        $gradient = [];

        if ( in_array( 'color', $background_tab ) ) {
            $color = $this->generate_background_options( "{$option_name}_bg", 'color', $tab_slug, $toggle_slug, "{$option_name}_bg_color" );
        }

        if ( in_array( 'gradient', $background_tab ) ) {
            $gradient = $this->generate_background_options( "{$option_name}_bg", 'gradient', $tab_slug, $toggle_slug, "{$option_name}_bg_color" );
        }

        $advanced_fields = [];

        $advanced_fields["{$option_name}_bg_color"] = [
            'label'             => sprintf( esc_html__( '%1$s Background', 'wdcl-wow-divi-carousel-lite' ), $option_label ),
            'type'              => 'background-field',
            'base_name'         => "{$option_name}_bg",
            'context'           => "{$option_name}_bg_color",
            'option_category'   => 'layout',
            'custom_color'      => true,
            'default'           => '',
            'tab_slug'          => $tab_slug,
            'toggle_slug'       => $toggle_slug,
            'hover'             => 'tabs',
            'show_if'           => $show_if,
            'background_fields' => array_merge( $color, $gradient ),
        ];

        $skip = $this->generate_background_options( "{$option_name}_bg", 'skip', $tab_slug, $toggle_slug, "{$option_name}_bg_color" );

        $advanced_fields = array_merge( $advanced_fields, $skip );

        return $advanced_fields;
    }

    protected function _get_custom_gradient( $args ) {

        $defaults = apply_filters(
            'et_pb_default_gradient',
            [
                'type'             => ET_Global_Settings::get_value( 'all_background_gradient_type' ),
                'direction'        => ET_Global_Settings::get_value( 'all_background_gradient_direction' ),
                'radial_direction' => ET_Global_Settings::get_value( 'all_background_gradient_direction_radial' ),
                'color_start'      => ET_Global_Settings::get_value( 'all_background_gradient_start' ),
                'color_end'        => ET_Global_Settings::get_value( 'all_background_gradient_end' ),
                'start_position'   => ET_Global_Settings::get_value( 'all_background_gradient_start_position' ),
                'end_position'     => ET_Global_Settings::get_value( 'all_background_gradient_end_position' ),
            ]
        );

        $args           = wp_parse_args( array_filter( $args ), $defaults );
        $direction      = $args['type'] === 'linear' ? $args['direction'] : "circle at {$args['radial_direction']}";
        $start_position = et_sanitize_input_unit( $args['start_position'], false, '%' );
        $end_Position   = et_sanitize_input_unit( $args['end_position'], false, '%' );

        return esc_html(
            "{$args['type']}-gradient(
			{$direction},
			{$args['color_start']} ${start_position},
			{$args['color_end']} ${end_Position}
		)"
        );

    }

    protected function _process_custom_advanced_background_fields( $option_name, $hover_suffix ) {

        // Background Options Styling.
        $background_base_name          = "{$option_name}_bg";
        $background_prefix             = "{$background_base_name}_";
        $background_style              = '';
        $background_image_style        = '';
        $background_images             = [];
        $has_background_color_gradient = false;

        // A. Background Gradient.
        $use_background_color_gradient = isset( $this->props["{$background_prefix}use_color_gradient{$hover_suffix}"] ) ? $this->props["{$background_prefix}use_color_gradient{$hover_suffix}"] : '';

        if ( 'on' === $use_background_color_gradient ) {

            $background_color_gradient_overlays_image = isset( $this->props["{$background_prefix}color_gradient_overlays_image{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_overlays_image{$hover_suffix}"] : '';

            $type = isset( $this->props["{$background_prefix}color_gradient_type{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_type{$hover_suffix}"] : '';

            $direction = isset( $this->props["{$background_prefix}color_gradient_direction{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_direction{$hover_suffix}"] : '';

            $radial_direction = isset( $this->props["{$background_prefix}color_gradient_direction_radial{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_direction_radial{$hover_suffix}"] : '';

            $color_start = isset( $this->props["{$background_prefix}color_gradient_start{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_start{$hover_suffix}"] : '';

            $color_end = isset( $this->props["{$background_prefix}color_gradient_end{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_end{$hover_suffix}"] : '';

            $start_position = isset( $this->props["{$background_prefix}color_gradient_start_position{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_start_position{$hover_suffix}"] : '';

            $end_position = isset( $this->props["{$background_prefix}color_gradient_end_position{$hover_suffix}"] ) ? $this->props["{$background_prefix}color_gradient_end_position{$hover_suffix}"] : '';

            $gradient_properties = [
                'type'             => $type,
                'direction'        => $direction,
                'radial_direction' => $radial_direction,
                'color_start'      => $color_start,
                'color_end'        => $color_end,
                'start_position'   => $start_position,
                'end_position'     => $end_position,
            ];

            // Save background gradient into background images list.
            $background_gradient = $this->_get_custom_gradient( $gradient_properties );
            $background_images[] = $background_gradient;

            // Flag to inform BG Color if current module has Gradient.
            $has_background_color_gradient = true;

        }

        if ( !empty( $background_images ) ) {

// The browsers stack the images in the opposite order to what you'd expect.
            if ( 'on' !== $background_color_gradient_overlays_image ) {
                $background_images = array_reverse( $background_images );
            }

            // Set background image styles only it's different compared to the larger device.
            $background_image_style = join( ', ', $background_images );

            $background_style .= sprintf(
                'background-image: %1$s !important;',
                esc_html( $background_image_style )
            );

        }

// B. Background Color.
        if ( !$has_background_color_gradient ) {
            $background_color = isset( $this->props["{$background_prefix}color{$hover_suffix}"] ) ? $this->props["{$background_prefix}color{$hover_suffix}"] : '';
            if ( '' !== $background_color ) {
                $background_style .= sprintf(
                    'background-color: %1$s%2$s; ',
                    esc_html( $background_color ),
                    esc_html( ' !important' )
                );
            }

        }

        return $background_style;

    }

    public static function _process_padding( $val, $imp ) {

        $_val = explode( '|', $val );

        $padding_top    = '';
        $padding_right  = '';
        $padding_bottom = '';
        $padding_left   = '';
        $imp_text       = '';

        if ( $imp ) {
            $imp_text = '!important';
        }

        if ( isset( $_val[0] ) && !empty( $_val[0] ) ) {
            $padding_top = 'padding-top:' . $_val[0] . $imp_text . ';';
        }

        if ( isset( $_val[1] ) && !empty( $_val[1] ) ) {
            $padding_right = 'padding-right:' . $_val[1] . $imp_text . ';';
        }

        if ( isset( $_val[2] ) && !empty( $_val[2] ) ) {
            $padding_bottom = 'padding-bottom:' . $_val[2] . $imp_text . ';';
        }

        if ( isset( $_val[3] ) && !empty( $_val[3] ) ) {
            $padding_left = 'padding-left:' . $_val[3] . $imp_text . ';';
        }

        return esc_html( "{$padding_top} {$padding_right} {$padding_bottom} {$padding_left}" );
    }

    public static function _get_carousel_option_fields( $design_slug, $supports ) {

        $fields = [

            'animation_speed'         => [
                'label'           => esc_html__( 'Animation Speed', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '700ms',
                'fixed_unit'      => 'ms',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'range_settings'  => [
                    'step' => 100,
                    'min'  => 0,
                    'max'  => 10000,
                ],
            ],

            'is_autoplay'             => [
                'label'           => esc_html__( 'Autoplay', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'on',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'autoplay_speed'          => [
                'label'           => esc_html__( 'Autoplay Speed', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '2000ms',
                'fixed_unit'      => 'ms',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'range_settings'  => [
                    'step' => 100,
                    'min'  => 1000,
                    'max'  => 10000,
                ],
                'show_if'         => [
                    'is_autoplay' => 'on',
                ],
            ],

            'nav_pagi'                => [
                'label'          => esc_html__( 'Navigation & Pagination', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'select',
                'default'        => 'nav',
                'toggle_slug'    => 'settings',
                'sub_toggle'     => 'general',
                'mobile_options' => true,
                'options'        => [
                    'none'     => esc_html__( 'None', 'wdcl-wow-divi-carousel-lite' ),
                    'nav'      => esc_html__( 'Navigation', 'wdcl-wow-divi-carousel-lite' ),
                    'pagi'     => esc_html__( 'Pagination', 'wdcl-wow-divi-carousel-lite' ),
                    'nav_pagi' => esc_html__( 'Navigation & Pagination', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'is_variable_width'       => [
                'label'           => esc_html__( 'Use Fixed Width Slide', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'off',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'slide_width'             => [
                'label'           => esc_html__( 'Slide Width', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'default'         => '360px',
                'option_category' => 'basic_option',
                'fixed_unit'      => 'px',
                'mobile_options'  => true,
                'range_settings'  => [
                    'min'  => 0,
                    'step' => 1,
                    'max'  => 1000,
                ],
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'show_if'         => [
                    'is_variable_width' => 'on',
                ],
            ],

            'slide_count'             => [
                'label'          => esc_html__( 'Slides To Show', 'wdcl-wow-divi-carousel-lite' ),
                'type'           => 'select',
                'default'        => '3',
                'toggle_slug'    => 'settings',
                'sub_toggle'     => 'general',
                'mobile_options' => true,
                'options'        => [
                    '1' => esc_html__( '1', 'wdcl-wow-divi-carousel-lite' ),
                    '2' => esc_html__( '2', 'wdcl-wow-divi-carousel-lite' ),
                    '3' => esc_html__( '3', 'wdcl-wow-divi-carousel-lite' ),
                    '4' => esc_html__( '4', 'wdcl-wow-divi-carousel-lite' ),
                    '5' => esc_html__( '5', 'wdcl-wow-divi-carousel-lite' ),
                    '6' => esc_html__( '6', 'wdcl-wow-divi-carousel-lite' ),
                    '7' => esc_html__( '7', 'wdcl-wow-divi-carousel-lite' ),
                    '8' => esc_html__( '8', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'        => [
                    'is_variable_width' => 'off',
                ],
            ],

            'slide_spacing'           => [
                'label'           => esc_html__( 'Slide Spacing', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '10px',
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
            ],

            'is_infinite'             => [
                'label'           => esc_html__( 'Infinite looping', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'on',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'sliding_dir'             => [
                'label'       => esc_html__( 'Sliding Direction', 'wdcl-wow-divi-carousel-lite' ),
                'description' => esc_html__( 'Define sliding direction. RTL sliding will only work on frontend. ', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'toggle_slug' => 'settings',
                'sub_toggle'  => 'advanced',
                'default'     => 'ltr',
                'options'     => [
                    'ltr' => esc_html__( 'Left to Right', 'wdcl-wow-divi-carousel-lite' ),
                    'rtl' => esc_html__( 'Right to Left', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'is_fade'                 => [
                'label'           => esc_html__( 'Fade Effect', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'off',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'general',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'         => [
                    'is_variable_width' => 'off',
                    'slide_count'       => '1',
                ],
            ],

            'is_auto_height'          => [
                'label'           => esc_html__( 'Auto Height', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'off',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'advanced',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'slide_to_scroll'         => [
                'label'           => esc_html__( 'Items to Scroll', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'default'         => '1',
                'option_category' => 'basic_option',
                'unitless'        => true,
                'mobile_options'  => true,
                'range_settings'  => [
                    'min'  => 1,
                    'step' => 1,
                    'max'  => 20,
                ],
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'advanced',
            ],

            'is_vertical'             => [
                'label'           => esc_html__( 'Vertical Mode', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'off',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'advanced',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'is_center'               => [
                'label'           => esc_html__( 'Center Mode', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'off',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'advanced',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'center_mode_type'        => [
                'label'       => esc_html__( 'Center Mode Type', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'default'     => 'classic',
                'toggle_slug' => 'settings',
                'sub_toggle'  => 'advanced',
                'options'     => [
                    'classic'     => esc_html__( 'Classic', 'wdcl-wow-divi-carousel-lite' ),
                    'highlighted' => esc_html__( 'Highlighted', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'     => [
                    'is_center' => 'on',
                ],
            ],

            'center_padding'          => [
                'label'           => esc_html__( 'Center Padding', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'default'         => '70px',
                'option_category' => 'basic_option',
                'fixed_unit'      => 'px',
                'range_settings'  => [
                    'min'  => 0,
                    'step' => 1,
                    'max'  => 400,
                ],
                'mobile_options'  => true,
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'advanced',
                'show_if'         => [
                    'is_center'         => 'on',
                    'center_mode_type'  => 'classic',
                    'is_variable_width' => 'off',
                ],
            ],

            'custom_cursor'           => [
                'label'           => esc_html__( 'Use Custom Cursor', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'off',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'advanced',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            'cursor_name'             => [
                'label'       => esc_html__( 'Cursor Name', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'default'     => 'css_default',
                'toggle_slug' => 'settings',
                'sub_toggle'  => 'advanced',
                'options'     => [
                    'css_default'   => esc_html__( 'Default', 'wdcl-wow-divi-carousel-lite' ),
                    'css_none'      => esc_html__( 'None', 'wdcl-wow-divi-carousel-lite' ),
                    'css_grab'      => esc_html__( 'Grab', 'wdcl-wow-divi-carousel-lite' ),
                    'css_pointer'   => esc_html__( 'Pointer', 'wdcl-wow-divi-carousel-lite' ),
                    'css_move'      => esc_html__( 'Move', 'wdcl-wow-divi-carousel-lite' ),
                    'custom_pizza'  => esc_html__( 'Pizza', 'wdcl-wow-divi-carousel-lite' ),
                    'custom_burger' => esc_html__( 'Burger', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'     => [
                    'custom_cursor' => 'on',
                ],
            ],

            // carousel style
            'carousel_spacing_top'    => [
                'label'           => esc_html__( 'Carousel Spacing Top', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '0px',
                'fixed_unit'      => 'px',
                'toggle_slug'     => $design_slug,
                'tab_slug'        => 'advanced',
                'mobile_options'  => true,
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 200,
                ],
            ],

            'carousel_spacing_bottom' => [
                'label'           => esc_html__( 'Carousel Spacing Bottom', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '0px',
                'fixed_unit'      => 'px',
                'toggle_slug'     => $design_slug,
                'tab_slug'        => 'advanced',
                'mobile_options'  => true,
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 200,
                ],
            ],

            // Arrow
            'arrow_type'              => [
                'label'       => esc_html__( 'Type', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'default'     => 'default',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_common',
                'options'     => [
                    'default'   => esc_html__( 'Default', 'wdcl-wow-divi-carousel-lite' ),
                    'alongside' => esc_html__( 'Alongside', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'     => ['sliding_dir' => 'ltr'],
            ],

            'arrow_pos'               => [
                'label'       => esc_html__( 'Vertical Placement', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'default'     => 'top',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_common',
                'options'     => [
                    'top'    => esc_html__( 'Top', 'wdcl-wow-divi-carousel-lite' ),
                    'bottom' => esc_html__( 'Bottom', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'     => [
                    'arrow_type'  => 'alongside',
                    'sliding_dir' => 'ltr',
                ],
            ],

            'arrow_pos_hz'            => [
                'label'       => esc_html__( 'Horizontal Placement', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'default'     => 'left',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_common',
                'options'     => [
                    'left'  => esc_html__( 'Left', 'wdcl-wow-divi-carousel-lite' ),
                    'right' => esc_html__( 'Right', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'     => [
                    'arrow_type'  => 'alongside',
                    'sliding_dir' => 'ltr',
                ],
            ],

            'arrow_height'            => [
                'label'           => esc_html__( 'Height', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '40px',
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'mobile_options'  => true,
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 200,
                ],
            ],

            'arrow_width'             => [
                'label'           => esc_html__( 'Width', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '40px',
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'mobile_options'  => true,
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 200,
                ],
            ],

            'arrow_icon_size'         => [
                'label'           => esc_html__( 'Icon Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '30px',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'mobile_options'  => true,
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 200,
                ],
            ],

            'arrow_color'             => [
                'label'       => esc_html__( 'Icon Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'arrow',
                'default'     => '#333',
                'sub_toggle'  => 'arrow_common',
                'hover'       => 'tabs',
            ],

            'arrow_bg'                => [
                'label'       => esc_html__( 'Background', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'arrow',
                'default'     => '#ddd',
                'sub_toggle'  => 'arrow_common',
                'hover'       => 'tabs',
            ],

            'arrow_skew'              => [
                'label'           => esc_html__( 'Skew', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '0deg',
                'fixed_unit'      => 'deg',
                'default_unit'    => 'deg',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'range_settings'  => [
                    'min'  => -90,
                    'max'  => 90,
                    'step' => 1,
                ],
            ],

            'arrow_gap'               => [
                'label'           => esc_html__( 'Spacing Between', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '10px',
                'default_unit'    => 'px',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'mobile_options'  => true,
                'show_if'         => [
                    'arrow_type'  => 'alongside',
                    'sliding_dir' => 'ltr',
                ],
                'range_settings'  => [
                    'min'  => 0,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],

            'arrow_pos_y'             => [
                'label'           => esc_html__( 'Vertical Position', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '50%',
                'mobile_options'  => true,
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'range_settings'  => [
                    'min'  => -150,
                    'max'  => 500,
                    'step' => 1,
                ],
            ],

            'arrow_x_center'          => [
                'label'       => esc_html__( 'Use Horizontal Position Center', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'yes_no_button',
                'default'     => 'off',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_common',
                'options'     => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'show_if'     => [
                    'arrow_type'  => 'alongside',
                    'sliding_dir' => 'ltr',
                ],
            ],

            'arrow_pos_x'             => [
                'label'           => esc_html__( 'Horizontal Position', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'mobile_options'  => true,
                'default'         => '-25px',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'range_settings'  => [
                    'min'  => -300,
                    'max'  => 300,
                    'step' => 1,
                ],
                'show_if_not'     => [
                    'arrow_x_center' => 'on',
                ],
            ],

            'arrow_border_width'      => [
                'label'           => esc_html__( 'Border Width', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '0px',
                'default_unit'    => 'px',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_common',
                'range_settings'  => [
                    'min'  => 0,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],

            'arrow_border_color'      => [
                'label'       => esc_html__( 'Border Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'default'     => '#333',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_common',
                'hover'       => 'tabs',
            ],

            'arrow_border_style'      => [
                'label'       => esc_html__( 'Border Type', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'select',
                'default'     => 'solid',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_common',
                'options'     => [
                    'solid'  => esc_html__( 'Solid', 'wdcl-wow-divi-carousel-lite' ),
                    'dashed' => esc_html__( 'Dashed', 'wdcl-wow-divi-carousel-lite' ),
                    'dotted' => esc_html__( 'Dotted', 'wdcl-wow-divi-carousel-lite' ),
                    'double' => esc_html__( 'Double', 'wdcl-wow-divi-carousel-lite' ),
                    'groove' => esc_html__( 'Groove', 'wdcl-wow-divi-carousel-lite' ),
                    'ridge'  => esc_html__( 'Ridge', 'wdcl-wow-divi-carousel-lite' ),
                    'inset'  => esc_html__( 'Inset', 'wdcl-wow-divi-carousel-lite' ),
                    'outset' => esc_html__( 'Outset', 'wdcl-wow-divi-carousel-lite' ),
                    'none'   => esc_html__( 'None', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],

            // Left Arrow
            'icon_left'               => [
                'label'           => esc_html__( 'Left Icon', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'select_icon',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_left',
            ],

            'left_border_radius'      => [
                'label'       => esc_html__( 'Border Radius', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'border-radius',
                'default'     => 'on|40px|40px|40px|40px',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_left',
            ],

            // Right Arrow
            'icon_right'              => [
                'label'           => esc_html__( 'Right Icon', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'select_icon',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'arrow',
                'tab_slug'        => 'advanced',
                'sub_toggle'      => 'arrow_right',
            ],

            'right_border_radius'     => [
                'label'       => esc_html__( 'Border Radius', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'border-radius',
                'default'     => 'on|40px|40px|40px|40px',
                'toggle_slug' => 'arrow',
                'tab_slug'    => 'advanced',
                'sub_toggle'  => 'arrow_right',
            ],

            // pagination
            'pagi_alignment'          => [
                'label'            => esc_html__( 'Alignment', 'wdcl-wow-divi-carousel-lite' ),
                'type'             => 'text_align',
                'option_category'  => 'layout',
                'options'          => et_builder_get_text_orientation_options( ['justified'] ),
                'options_icon'     => 'module_align',
                'default_on_front' => 'center',
                'default'          => 'center',
                'toggle_slug'      => 'pagination',
                'sub_toggle'       => 'pagi_common',
                'tab_slug'         => 'advanced',
            ],

            'pagi_color'              => [
                'label'       => esc_html__( 'Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'pagination',
                'sub_toggle'  => 'pagi_common',
                'default'     => '#dddddd',
                'hover'       => 'tabs',
            ],

            'pagi_height'             => [
                'label'           => esc_html__( 'Height', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '10px',
                'toggle_slug'     => 'pagination',
                'sub_toggle'      => 'pagi_common',
                'tab_slug'        => 'advanced',
                'range_settings'  => [
                    'min'  => 1,
                    'step' => 1,
                    'max'  => 50,
                ],
            ],

            'pagi_width'              => [
                'label'           => esc_html__( 'Width', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '10px',
                'toggle_slug'     => 'pagination',
                'sub_toggle'      => 'pagi_common',
                'tab_slug'        => 'advanced',
                'range_settings'  => [
                    'min'  => 1,
                    'step' => 1,
                    'max'  => 50,
                ],
            ],

            'pagi_radius'             => [
                'label'       => esc_html__( 'Border Radius', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'border-radius',
                'default'     => 'on|10px|10px|10px|10px',
                'toggle_slug' => 'pagination',
                'sub_toggle'  => 'pagi_common',
                'tab_slug'    => 'advanced',
            ],

            'pagi_pos_y'              => [
                'label'           => esc_html__( 'Vertical Position', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '10px',
                'toggle_slug'     => 'pagination',
                'sub_toggle'      => 'pagi_common',
                'tab_slug'        => 'advanced',
                'range_settings'  => [
                    'min'  => -400,
                    'max'  => 400,
                    'step' => 1,
                ],
            ],

            'pagi_spacing'            => [
                'label'           => esc_html__( 'Spacing', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '10px',
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'pagination',
                'sub_toggle'      => 'pagi_common',
                'tab_slug'        => 'advanced',
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
            ],

            'pagi_color_active'       => [
                'label'       => esc_html__( 'Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'pagination',
                'sub_toggle'  => 'pagi_active',
                'default'     => '#000000',
            ],

            'pagi_width_active'       => [
                'label'           => esc_html__( 'Width', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '10px',
                'fixed_unit'      => 'px',
                'toggle_slug'     => 'pagination',
                'sub_toggle'      => 'pagi_active',
                'tab_slug'        => 'advanced',
                'range_settings'  => [
                    'step' => 1,
                    'min'  => 0,
                    'max'  => 100,
                ],
            ],

        ];

        $additional = [];

        if ( in_array( 'lightbox', $supports, true ) ) {

            $additional['use_lightbox'] = [
                'label'           => esc_html__( 'Open Image in Lightbox', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'default'         => 'off',
                'toggle_slug'     => 'settings',
                'sub_toggle'      => 'advanced',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ];
        }

        if ( in_array( 'equal_height', $supports ) ) {

            $additional['is_equal_height'] = [
                'label'           => esc_html__( 'Use Equal Height', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'description'     => esc_html__( 'Enable this to display all items with same height.' ),
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'         => 'on',
                'toggle_slug'     => $design_slug,
                'tab_slug'        => 'advanced',
            ];
        }

        return array_merge( $fields, $additional );

    }

    protected function _render_default_arrow_css( $render_slug ) {
        $sliding_dir                   = $this->props['sliding_dir'];
        $left                          = 'ltr' === $sliding_dir ? 'left' : 'right';
        $right                         = 'ltr' === $sliding_dir ? 'right' : 'left';
        $arrow_pos_y                   = $this->props['arrow_pos_y'];
        $arrow_pos_y_tablet            = $this->props['arrow_pos_y_tablet'];
        $arrow_pos_y_phone             = $this->props['arrow_pos_y_phone'];
        $arrow_pos_y_last_edited       = $this->props['arrow_pos_y_last_edited'];
        $arrow_pos_y_responsive_status = et_pb_get_responsive_status( $arrow_pos_y_last_edited );

        $arrow_pos_x                   = $this->props['arrow_pos_x'];
        $arrow_pos_x_tablet            = $this->props['arrow_pos_x_tablet'];
        $arrow_pos_x_phone             = $this->props['arrow_pos_x_phone'];
        $arrow_pos_x_last_edited       = $this->props['arrow_pos_x_last_edited'];
        $arrow_pos_x_responsive_status = et_pb_get_responsive_status( $arrow_pos_x_last_edited );

        if ( 'ltr' === $sliding_dir ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-carousel .slick-prev',
                    'declaration' => 'right: auto!important;',
                ]
            );

            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-carousel .slick-next',
                    'declaration' => 'left: auto!important;',
                ]
            );

        }

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-arrow',
                'declaration' => sprintf( ' top: %1$s; ', $arrow_pos_y ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-next',
                'declaration' => sprintf( '%2$s: %1$s;', $arrow_pos_x, $right ),
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-prev',
                'declaration' => sprintf( '%2$s: %1$s; ', $arrow_pos_x, $left ),
            ]
        );

        if ( !empty( $arrow_pos_y_tablet ) && $arrow_pos_y_responsive_status ):
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-next',
                    'declaration' => sprintf( '%2$s: %1$s;', $arrow_pos_y_tablet, $right ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                ]
            );

            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'declaration' => sprintf( '%2$s: %1$s; ', $arrow_pos_y_tablet, $left ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                ]
            );
        endif;

        if ( !empty( $arrow_pos_x_phone ) && $arrow_pos_y_responsive_status ):
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-next',
                    'declaration' => sprintf( '%2$s: %1$s;', $arrow_pos_x_phone, $right ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );

            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'declaration' => sprintf( '%2$s: %1$s; ', $arrow_pos_x_phone, $right ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );
        endif;

        if ( !empty( $arrow_pos_y_tablet ) && $arrow_pos_y_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'declaration' => sprintf( 'top: %1$s; ', $arrow_pos_y_tablet ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                ]
            );
        endif;

        if ( !empty( $arrow_pos_y_phone ) && $arrow_pos_y_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'declaration' => sprintf( 'top: %1$s; ', $arrow_pos_y_phone ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );
        endif;
    }

    protected function _render_alongside_arrow_css( $render_slug ) {
        $sliding_dir                   = $this->props['sliding_dir'];
        $arrow_pos                     = $this->props['arrow_pos'];
        $arrow_pos_hz                  = $this->props['arrow_pos_hz'];
        $arrow_pos_y                   = $this->props['arrow_pos_y'];
        $arrow_pos_y_tablet            = $this->props['arrow_pos_y_tablet'];
        $arrow_pos_y_phone             = $this->props['arrow_pos_y_phone'];
        $arrow_pos_y_last_edited       = $this->props['arrow_pos_y_last_edited'];
        $arrow_pos_y_responsive_status = et_pb_get_responsive_status( $arrow_pos_y_last_edited );

        $arrow_x_center                = $this->props['arrow_x_center'];
        $arrow_pos_x                   = $this->props['arrow_pos_x'];
        $arrow_pos_x_tablet            = $this->props['arrow_pos_x_tablet'];
        $arrow_pos_x_phone             = $this->props['arrow_pos_x_phone'];
        $arrow_pos_x_last_edited       = $this->props['arrow_pos_x_last_edited'];
        $arrow_pos_x_responsive_status = et_pb_get_responsive_status( $arrow_pos_x_last_edited );

        $arrow_width        = $this->props['arrow_width'];
        $arrow_width_tablet = $this->props['arrow_width_tablet'] ? $this->props['arrow_width_tablet'] : $arrow_width;
        $arrow_width_phone  = $this->props['arrow_width_phone'] ? $this->props['arrow_width_phone'] : $arrow_width_tablet;

        $arrow_gap        = $this->props['arrow_gap'];
        $arrow_gap_tablet = $this->props['arrow_gap_tablet'] ? $this->props['arrow_gap_tablet'] : $arrow_gap;
        $arrow_gap_phone  = $this->props['arrow_gap_phone'] ? $this->props['arrow_gap_phone'] : $arrow_gap_tablet;

        if ( 'ltr' === $sliding_dir && 'right' === $arrow_pos_hz ) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .wdcl-carousel .slick-next',
                    'declaration' => 'left: auto!important;',
                ]
            );
        }

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-arrow',
                'declaration' => sprintf( ' top: auto; %1$s: %2$s;', $arrow_pos, $arrow_pos_y ),
            ]
        );

        if ( $arrow_x_center === 'on' ) {

            // desktop
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-next',
                    'declaration' => sprintf( 'right: calc(50%% - %1$spx);', intval( $arrow_width ) + ( intval( $arrow_gap ) / 2 ) ),
                ]
            );

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'declaration' => sprintf( 'left: calc(50%% - %1$spx);', intval( $arrow_width ) + ( intval( $arrow_gap ) / 2 ) ),
                ]
            );

            // tablet
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-next',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'right: calc(50%% - %1$spx);', intval( $arrow_width_tablet ) + ( intval( $arrow_gap_tablet ) / 2 ) ),
                ]
            );

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'left: calc(50%% - %1$spx);', intval( $arrow_width_tablet ) + ( intval( $arrow_gap_tablet ) / 2 ) ),
                ]
            );

            // phone
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-next',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    'declaration' => sprintf( 'right: calc(50%% - %1$spx);', intval( $arrow_width_phone ) + ( intval( $arrow_gap_phone ) / 2 ) ),
                ]
            );

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    'declaration' => sprintf( 'left: calc(50%% - %1$spx);', intval( $arrow_width_phone ) + ( intval( $arrow_gap_phone ) / 2 ) ),
                ]
            );

        } else {

            // position X
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-next',
                    'declaration' => sprintf( ' %2$s: %1$s; ', $arrow_pos_x, $arrow_pos_hz ),
                ]
            );

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'declaration' => sprintf( ' left: auto; %2$s: %1$s; ', $arrow_pos_x, $arrow_pos_hz ),
                ]
            );

// position X tablet
            if ( !empty( $arrow_pos_x_tablet ) && $arrow_pos_x_responsive_status ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .slick-next',
                        'declaration' => sprintf( ' %2$s: %1$s; ', $arrow_pos_x_tablet, $arrow_pos_hz ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    ]
                );

                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .slick-prev',
                        'declaration' => sprintf( 'left: auto; %2$s: %1$s;', $arrow_pos_x_tablet, $arrow_pos_hz ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    ]
                );
            }

// position X phone
            if ( !empty( $arrow_pos_x_phone ) && $arrow_pos_x_responsive_status ) {

                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .slick-next',
                        'declaration' => sprintf( ' %2$s: %1$s; ', $arrow_pos_x_phone, $arrow_pos_hz ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    ]
                );

                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .slick-prev',
                        'declaration' => sprintf( 'left: auto; %2$s: %1$s;', $arrow_pos_x_phone, $arrow_pos_hz ),
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    ]
                );
            }

            // arrow gap
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'declaration' => sprintf( 'margin-%3$s: calc(%1$s + %2$s);', $arrow_width, $arrow_gap, $arrow_pos_hz ),
                ]
            );

            // arrow gap tablet.
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'declaration' => sprintf( 'margin-%3$s: calc(%1$s + %2$s);', $arrow_width_tablet, $arrow_gap_tablet, $arrow_pos_hz ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                ]
            );

            // arrow gap phone
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-prev',
                    'declaration' => sprintf( ' margin-%3$s: calc(%1$s + %2$s); ', $arrow_width_phone, $arrow_gap_phone, $arrow_pos_hz ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );

        }

// position Y tablet
        if ( !empty( $arrow_pos_y_tablet ) && $arrow_pos_y_responsive_status ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'declaration' => sprintf( 'top: auto; %1$s: %2$s; ', $arrow_pos, $arrow_pos_y_tablet ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                ]
            );
        }

// position Y phone
        if ( !empty( $arrow_pos_y_phone ) && $arrow_pos_y_responsive_status ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'declaration' => sprintf( 'top: auto; %1$s: %2$s;', $arrow_pos, $arrow_pos_y_phone ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );
        }

    }

    protected function _render_pagination_css( $render_slug ) {

        $pagi_color        = $this->props['pagi_color'];
        $pagi_color_hover  = $this->get_hover_value( 'pagi_color' );
        $pagi_color_active = $this->props['pagi_color_active'];
        $pagi_alignment    = $this->props['pagi_alignment'];
        $pagi_pos_y        = $this->props['pagi_pos_y'];
        $pagi_spacing      = $this->props['pagi_spacing'];
        $pagi_height       = $this->props['pagi_height'];
        $pagi_width        = $this->props['pagi_width'];
        $pagi_width_active = $this->props['pagi_width_active'];
        $pagi_radius       = explode( '|', $this->props['pagi_radius'] );

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-dots',
                'declaration' => sprintf( ' text-align: %1$s; transform: translateY(%2$s); ', $pagi_alignment, $pagi_pos_y ),
            ]
        );

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-dots li',
                'declaration' => sprintf( ' margin: 0 %1$s;', $pagi_spacing ),
            ]
        );

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-dots li button',
                'declaration' => sprintf(
                    ' background: %1$s; height: %2$s; width: %3$s; border-radius: %4$s %5$s %6$s %7$s;',
                    $pagi_color,
                    $pagi_height,
                    $pagi_width,
                    $pagi_radius[1],
                    $pagi_radius[2],
                    $pagi_radius[3],
                    $pagi_radius[4]
                ),
            ]
        );

        if ( !empty( $pagi_color_hover ) ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-dots li:hover button',
                    'declaration' => sprintf( ' background: %1$s;', $pagi_color_hover ),
                ]
            );
        }

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-dots li.slick-active button',
                'declaration' => sprintf( 'background: %1$s; width: %2$s;', $pagi_color_active, $pagi_width_active ),
            ]
        );
    }

    protected function get_carousel_css( $render_slug ) {
        $sliding_dir                               = $this->props['sliding_dir'];
        $arrow_height                              = $this->props['arrow_height'];
        $arrow_height_tablet                       = $this->props['arrow_height_tablet'];
        $arrow_height_phone                        = $this->props['arrow_height_phone'];
        $arrow_height_last_edited                  = $this->props['arrow_height_last_edited'];
        $arrow_height_responsive_status            = et_pb_get_responsive_status( $arrow_height_last_edited );
        $arrow_width                               = $this->props['arrow_width'];
        $arrow_width_tablet                        = $this->props['arrow_width_tablet'] ? $this->props['arrow_width_tablet'] : $arrow_width;
        $arrow_width_phone                         = $this->props['arrow_width_phone'] ? $this->props['arrow_width_phone'] : $arrow_width_tablet;
        $arrow_width_last_edited                   = $this->props['arrow_width_last_edited'];
        $arrow_width_responsive_status             = et_pb_get_responsive_status( $arrow_width_last_edited );
        $arrow_border_width                        = $this->props['arrow_border_width'];
        $arrow_border_style                        = $this->props['arrow_border_style'];
        $arrow_border_color                        = $this->props['arrow_border_color'];
        $arrow_border_color_hover                  = $this->get_hover_value( 'arrow_border_color' );
        $arrow_color                               = $this->props['arrow_color'];
        $arrow_bg                                  = $this->props['arrow_bg'];
        $arrow_skew                                = $this->props['arrow_skew'];
        $arrow_color_hover                         = $this->get_hover_value( 'arrow_color' );
        $arrow_bg_hover                            = $this->get_hover_value( 'arrow_bg' );
        $arrow_icon_size_tablet                    = $this->props['arrow_icon_size_tablet'];
        $arrow_icon_size_phone                     = $this->props['arrow_icon_size_phone'];
        $arrow_icon_size_last_edited               = $this->props['arrow_icon_size_last_edited'];
        $arrow_icon_size_responsive_status         = et_pb_get_responsive_status( $arrow_icon_size_last_edited );
        $arrow_icon_size                           = $this->props['arrow_icon_size'];
        $right_border_radius                       = explode( '|', $this->props['right_border_radius'] );
        $left_border_radius                        = explode( '|', $this->props['left_border_radius'] );
        $slide_spacing                             = $this->props['slide_spacing'];
        $custom_cursor                             = $this->props['custom_cursor'];
        $cursor_name                               = $this->props['cursor_name'];
        $is_variable_width                         = $this->props['is_variable_width'];
        $slide_width                               = $this->props['slide_width'];
        $slide_width_tablet                        = $this->props['slide_width_tablet'];
        $slide_width_phone                         = $this->props['slide_width_phone'];
        $slide_width_last_edited                   = $this->props['slide_width_last_edited'];
        $slide_width_responsive_status             = et_pb_get_responsive_status( $slide_width_last_edited );
        $is_vertical                               = $this->props['is_vertical'];
        $arrow_type                                = $this->props['arrow_type'];
        $int_skew                                  = intval( $this->props['arrow_skew'] );
        $arrow_skew_inner                          = $int_skew < 0 ? abs( $int_skew ) : '-' . abs( $int_skew );
        $carousel_spacing_top                      = $this->props['carousel_spacing_top'];
        $carousel_spacing_top_tablet               = $this->props['carousel_spacing_top_tablet'];
        $carousel_spacing_top_phone                = $this->props['carousel_spacing_top_phone'];
        $carousel_spacing_top_last_edited          = $this->props['carousel_spacing_top_last_edited'];
        $carousel_spacing_top_responsive_status    = et_pb_get_responsive_status( $carousel_spacing_top_last_edited );
        $animation_speed                           = $this->props['animation_speed'];
        $carousel_spacing_bottom                   = $this->props['carousel_spacing_bottom'];
        $carousel_spacing_bottom_tablet            = $this->props['carousel_spacing_bottom_tablet'];
        $carousel_spacing_bottom_phone             = $this->props['carousel_spacing_bottom_phone'];
        $carousel_spacing_bottom_last_edited       = $this->props['carousel_spacing_bottom_last_edited'];
        $carousel_spacing_bottom_responsive_status = et_pb_get_responsive_status( $carousel_spacing_bottom_last_edited );

        $data_cursor = [
            'pizza'  => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAIVBMVEUAAAAAAAD/////zGb/mTOZAAAAzAD/zDP/AAD/Zmb/mZm5WRymAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTCRh4PlpnAAAA8ElEQVQoz12QsbnDIAyExQaWQ0ySztngfW8BMgIFA3gEVardEXfu3KbzmJEgTrCvEfo5wQEgABjMakDVNgZP/1l/GbX9p81ISHuvgJL23tfgIUAs5VCxWgWyjKoQ8GRlpO2lwXOM3TkG9IACAkoTg7pKKsc6hWKzGg1ZhVKohHVMGUkhr8Bw57Kjc5RfA0626Jmk2A9g7m7LNDL6AsRNlynNNJQezOL4ktK4TQDcRr5OMtJswMxMaXXkv2BkJ3kJvkIamAb7A441mv8Bo+9AqIR8fdoadJjWpgaGltnvwfqCnXB/hH6kPwCCg+wRbJe+ATasSMvHEwtpAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjA5OjIzKzAwOjAwCTF7LQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOTowOTowNiswMDowMGhx60sAAAAASUVORK5CYII=',
            'burger' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAALVBMVEUAAAAAAAD////MZgBmMwCZMwD/zDP/mQD/zAB4eHhGRkbc3NygoKDIyMhmAAAKaD9VAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTGhFgDaNRAAAAEGNhTnYAAAAgAAAAIAAAAAAAAAAAYrnu+gAAATdJREFUKM9lkbFOwzAQhl2lM4qrLLW68AYgG2VtlIu6sVTxCzCwA5XzACCydmyUpWNNl670CVLyBkxImXkG7i6oSOFXlv+7/85nR4RiIDkEk2FkcvkPUCSA9DyDvMlyDVc9CKmca9Q5FMAS7c2dNr/ELNmiDHcFmdaWPms1R0zOVa1j98gRwCp1xKt7R4A60FlnnXugnnGK3pFs8doDi92OAiVPHWd4JvmyLDWBEa0Vk33Bydd4l4j3cCs63ExDIbfAq7OSdwQ7GQHkdD0jpwqBqrYSSImsP99CMVLN2kvS7ORnByEupG/aTdWu1/VOHSMEX1Ltvd+3zWnzcQAEt1IqX3tfHb2MDIKuS3iEwtkLTIhvMMAkguJpLiiSaj52UZTAb9oBb+ncM8z7Vx4DvwnA3+/jlr78AzvMazraOl3vAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjI2OjE2KzAwOjAwfOGxJQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOToyNjoxNiswMDowMA28CZkAAAAASUVORK5CYII=',
        ];

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-centered--highlighted .slick-slide',
                'declaration' => sprintf( 'transition: transform %1$s;', $animation_speed ),
            ]
        );

// Custom Cursor.
        if ( $custom_cursor === 'on' ) {
            $cursor_type = explode( '_', $cursor_name )[0];
            $cursor_icon = explode( '_', $cursor_name )[1];

            if ( $cursor_type === 'css' ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%%',
                        'declaration' => sprintf( 'cursor: %1$s!important;', $cursor_icon ),
                    ]
                );
            } elseif ( $cursor_type === 'custom' ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%%',
                        'declaration' => "cursor: url('{$data_cursor[$cursor_icon]}'), auto!important;",
                    ]
                );
            }

        }

        // Carousel Spacing Top - Bottom.
        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-track',
                'declaration' => sprintf( 'padding-top: %1$s; padding-bottom: %2$s;', $carousel_spacing_top, $carousel_spacing_bottom ),
            ]
        );

// Carousel Spacing Top Tablet.
        if ( $carousel_spacing_top_tablet && $carousel_spacing_top_responsive_status ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-track',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'padding-top: %1$s;', $carousel_spacing_top_tablet ),
                ]
            );
        }

// Carousel Spacing Top Phone.
        if ( $carousel_spacing_top_phone && $carousel_spacing_top_responsive_status ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-track',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    'declaration' => sprintf( 'padding-top: %1$s;', $carousel_spacing_top_phone ),
                ]
            );
        }

// Carousel Spacing Bottom Tablet.
        if ( $carousel_spacing_bottom_tablet && $carousel_spacing_bottom_responsive_status ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-track',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( 'padding-bottom: %1$s;', $carousel_spacing_bottom_tablet ),
                ]
            );
        }

// Carousel Spacing Bottom Phone.
        if ( $carousel_spacing_bottom_phone && $carousel_spacing_bottom_responsive_status ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-track',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                    'declaration' => sprintf( 'padding-bottom: %1$s;', $carousel_spacing_bottom_phone ),
                ]
            );
        }

// Slide  Width.
        if ( $is_variable_width === 'on' ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-slide',
                    'declaration' => sprintf( 'width: %1$s;', $slide_width ),
                ]
            );

// Slide  Width Tablet.
            if ( !empty( $slide_width_tablet ) && $slide_width_responsive_status ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .slick-slide',
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                        'declaration' => sprintf( 'width: %1$s;', $slide_width_tablet ),
                    ]
                );
            }

// Slide  Width Phone.
            if ( !empty( $slide_width_phone ) && $slide_width_responsive_status ) {
                \ET_Builder_Element::set_style(
                    $render_slug,
                    [
                        'selector'    => '%%order_class%% .slick-slide',
                        'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                        'declaration' => sprintf( 'width: %1$s;', $slide_width_phone ),
                    ]
                );
            }

        }

// Slide Spacing.
        if ( $is_vertical === 'off' ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-slide, .et-db #et-boc %%order_class%% .slick-slide',
                    'declaration' => sprintf( ' padding-left: %1$s!important; padding-right: %1$s!important;', $slide_spacing ),
                ]
            );

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-list, .et-db #et-boc %%order_class%% .slick-list',
                    'declaration' => sprintf( ' margin-left: -%1$s!important; margin-right: -%1$s!important;', $slide_spacing ),
                ]
            );
        } else {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-slide, .et-db #et-boc %%order_class%% .slick-slide',
                    'declaration' => sprintf( ' padding-top: %1$s!important; padding-bottom: %1$s!important;', $slide_spacing ),
                ]
            );

            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-list, .et-db #et-boc %%order_class%% .slick-list',
                    'declaration' => sprintf( ' margin-top: -%1$s!important; margin-bottom: -%1$s!important;', $slide_spacing ),
                ]
            );
        }

        // Arrow.
        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-arrow',
                'declaration' => sprintf(
                    'height: %1$s; width: %2$s; color: %3$s; background: %4$s; border: %5$s %6$s %7$s; transform: skew(%8$s);margin-top:-%9$spx;',
                    $arrow_height,
                    $arrow_width,
                    $arrow_color,
                    $arrow_bg,
                    $arrow_border_width,
                    $arrow_border_style,
                    $arrow_border_color,
                    $arrow_skew,
                    (int) $arrow_height / 2
                ),
            ]
        );

// Arrow hover.
        if ( $arrow_color_hover ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow:hover',
                    'declaration' => sprintf( 'color: %1$s;', $arrow_color_hover ),
                ]
            );
        }

        if ( $arrow_bg_hover ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow:hover',
                    'declaration' => sprintf( 'background: %1$s;', $arrow_bg_hover ),
                ]
            );
        }

        if ( $arrow_border_color_hover ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow:hover',
                    'declaration' => sprintf( 'border-color: %1$s;', $arrow_border_color_hover ),
                ]
            );
        }

// Arrow Responsive Height.
        if ( !empty( $arrow_height_tablet ) && $arrow_height_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'declaration' => sprintf( 'height: %1$s; ', $arrow_height_tablet ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                ]
            );
        endif;

        if ( !empty( $arrow_height_phone ) && $arrow_height_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'declaration' => sprintf( 'height: %1$s; ', $arrow_height_phone ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );
        endif;

// Arrow Responsive Width.
        if ( !empty( $arrow_width_tablet ) && $arrow_width_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                    'declaration' => sprintf( ' width: %1$s; ', $arrow_width_tablet ),
                ]
            );
        endif;

        if ( !empty( $arrow_width_phone ) && $arrow_width_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow',
                    'declaration' => sprintf( 'width: %1$s; ', $arrow_width_phone ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );
        endif;

        // Arrow Icon.
        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-arrow:before',
                'declaration' => sprintf(
                    'font-size: %1$s; transform: skew(%2$sdeg); display: inline-block;',
                    $arrow_icon_size,
                    $arrow_skew_inner
                ),
            ]
        );

// Arrow Icon Responsive.
        if ( !empty( $arrow_icon_size_tablet ) && $arrow_icon_size_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow:before',
                    'declaration' => sprintf( ' font-size: %1$s; ', $arrow_icon_size_tablet ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
                ]
            );
        endif;

        if ( !empty( $arrow_icon_size_phone ) && $arrow_icon_size_responsive_status ):
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .slick-arrow:before',
                    'declaration' => sprintf( ' font-size: %1$s; ', $arrow_icon_size_phone ),
                    'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
                ]
            );
        endif;

        // Arrow Border Radius.
        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-next',
                'declaration' => sprintf(
                    'border-radius: %1$s %2$s %3$s %4$s;',
                    $right_border_radius[1],
                    $right_border_radius[2],
                    $right_border_radius[3],
                    $right_border_radius[4]
                ),
            ]
        );

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .slick-prev',
                'declaration' => sprintf(
                    'border-radius: %1$s %2$s %3$s %4$s;',
                    $left_border_radius[1],
                    $left_border_radius[2],
                    $left_border_radius[3],
                    $left_border_radius[4]
                ),
            ]
        );

// Array Type.
        if ( 'rtl' === $sliding_dir || $arrow_type === 'default' ) {

            $this->_render_default_arrow_css( $render_slug );

        } elseif ( 'ltr' === $sliding_dir && 'alongside' === $arrow_type ) {

            $this->_render_alongside_arrow_css( $render_slug );

        }

        // Carousel Pagination.
        $this->_render_pagination_css( $render_slug );
    }

    protected function get_carousel_options_data() {
        $sliding_dir            = $this->props['sliding_dir'];
        $is_autoplay            = $this->props['is_autoplay'];
        $is_auto_height         = $this->props['is_auto_height'];
        $autoplay_speed         = $this->props['autoplay_speed'];
        $animation_speed        = $this->props['animation_speed'];
        $slide_count            = $this->props['slide_count'];
        $is_center              = $this->props['is_center'];
        $center_mode_type       = $this->props['center_mode_type'];
        $center_padding         = $this->props['center_padding'];
        $center_padding_tablet  = $this->props['center_padding_tablet'];
        $center_padding_phone   = $this->props['center_padding_phone'];
        $is_vertical            = $this->props['is_vertical'];
        $slide_infinite         = $this->props['is_infinite'];
        $slide_count            = $this->props['slide_count'];
        $slide_count_tablet     = $this->props['slide_count_tablet'] ? $this->props['slide_count_tablet'] : $slide_count;
        $slide_count_phone      = $this->props['slide_count_phone'] ? $this->props['slide_count_phone'] : $slide_count_tablet;
        $icon_left              = esc_html( et_pb_process_font_icon( $this->props['icon_left'] ) );
        $icon_right             = esc_html( et_pb_process_font_icon( $this->props['icon_right'] ) );
        $nav_pagi               = $this->props['nav_pagi'];
        $nav_pagi_tablet        = !empty( $this->props['nav_pagi_tablet'] ) ? $this->props['nav_pagi_tablet'] : $nav_pagi;
        $nav_pagi_phone         = !empty( $this->props['nav_pagi_phone'] ) ? $this->props['nav_pagi_phone'] : $nav_pagi_tablet;
        $is_pagi_active         = $nav_pagi === 'pagi' || $nav_pagi === 'nav_pagi' ? 'true' : 'false';
        $is_pagi_active_tablet  = $nav_pagi_tablet === 'pagi' || $nav_pagi_tablet === 'nav_pagi' ? 'true' : 'false';
        $is_pagi_active_phone   = $nav_pagi_phone === 'pagi' || $nav_pagi_phone === 'nav_pagi' ? 'true' : 'false';
        $is_arrow_active        = $nav_pagi === 'nav' || $nav_pagi === 'nav_pagi' ? 'true' : 'false';
        $is_arrow_active_tablet = $nav_pagi_tablet === 'nav' || $nav_pagi_tablet === 'nav_pagi' ? 'true' : 'false';
        $is_arrow_active_phone  = $nav_pagi_phone === 'nav' || $nav_pagi_phone === 'nav_pagi' ? 'true' : 'false';
        $is_variable_width      = $this->props['is_variable_width'];
        $slide_to_scroll        = $this->props['slide_to_scroll'];
        $slide_to_scroll_tablet = $this->props['slide_to_scroll_tablet'];
        $slide_to_scroll_phone  = $this->props['slide_to_scroll_phone'];
        $fade                   = 'off';
        $is_fade                = $this->props['is_fade'];

        if ( 'off' === $is_variable_width && '1' === $slide_count && 'on' === $is_fade ) {
            $fade = $is_fade;
        }

        $carousel_options = sprintf(
            'data-pagi="%1$s"
			data-pagi-tablet="%2$s"
			data-pagi-phone="%3$s"
			data-nav="%4$s"
			data-nav-tablet="%5$s"
			data-nav-phone="%6$s"
			data-autoplay="%7$s"
			data-autoplay-speed="%8$s"
			data-speed="%9$s"
			data-slides="%10$s"
			data-slides-tablet="%11$s"
			data-slides-phone="%12$s"
			data-center="%13$s"
			data-center-mode-type="%14$s"
			data-center-padding="%15$s|%16$s|%17$s"
			data-vertical="%18$s"
			data-icon-left="%19$s"
			data-icon-right="%20$s"
			data-infinite="%21$s"
			data-variable-width="%22$s"
			data-auto-height="%23$s"
			data-items-scroll="%24$s|%25$s|%26$s"
			data-fade="%27$s"
			data-dir="%28$s"',
            $is_pagi_active, // 1
            $is_pagi_active_tablet, // 2
            $is_pagi_active_phone, // 3
            $is_arrow_active, // 4
            $is_arrow_active_tablet, // 5
            $is_arrow_active_phone, // 6
            $is_autoplay, // 7
            $autoplay_speed, // 8
            $animation_speed, // 9
            $slide_count, // 10
            $slide_count_tablet, // 11
            $slide_count_phone, // 12
            $is_center, // 13
            $center_mode_type, // 14
            $center_padding, // 15
            $center_padding_tablet, // 16
            $center_padding_phone, // 17
            $is_vertical, // 18
            $icon_left ? $icon_left : '4', // 19
            $icon_right ? $icon_right : '5', // 20
            $slide_infinite, // 21
            $is_variable_width, // 22
            $is_auto_height, // 23
            $slide_to_scroll, // 24
            $slide_to_scroll_tablet, // 25
            $slide_to_scroll_phone, // 26
            $fade, // 27
            $sliding_dir // 28
        );

        return $carousel_options;
    }

    protected function _get_custom_bg_style( $render_slug, $opt_slug, $selector, $hover_selector ) {

        $_bg = $this->_process_custom_advanced_background_fields( $opt_slug, '' );

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => $selector,
                'declaration' => $_bg,
            ]
        );

        // hover
        $_bg_hover = $this->_process_custom_advanced_background_fields( $opt_slug, '__hover' );

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => $hover_selector,
                'declaration' => $_bg_hover,
            ]
        );

    }

    protected function _get_overlay_option_fields( $opt_slug, $show_if ) {

        $fields = [

            'overlay_icon'         => [
                'label'           => esc_html__( 'Overlay Icon', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'select_icon',
                'option_category' => 'basic_option',
                'toggle_slug'     => $opt_slug,
                'tab_slug'        => 'advanced',
                'show_if'         => $show_if,
                'hover'           => 'tabs',
            ],

            'overlay_icon_color'   => [
                'label'       => esc_html__( 'Overlay Icon Color', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'color-alpha',
                'tab_slug'    => 'advanced',
                'default'     => '#2EA3F2',
                'toggle_slug' => $opt_slug,
                'show_if'     => $show_if,
                'hover'       => 'tabs',
            ],

            'overlay_icon_size'    => [
                'label'           => esc_html__( 'Overlay Icon Size', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '32px',
                'range_settings'  => [
                    'min'  => 0,
                    'max'  => 200,
                    'step' => 1,
                ],
                'toggle_slug'     => $opt_slug,
                'tab_slug'        => 'advanced',
                'show_if'         => $show_if,
            ],

            'overlay_icon_opacity' => [
                'label'           => esc_html__( 'Overlay Icon Opacity', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'default'         => '1',
                'unitless'        => true,
                'range_settings'  => [
                    'min'  => 0,
                    'max'  => 1,
                    'step' => .02,
                ],
                'toggle_slug'     => $opt_slug,
                'tab_slug'        => 'advanced',
                'show_if'         => $show_if,
                'hover'           => 'tabs',
            ],

        ];

        $overlay = $this->_custom_advanced_background_fields( 'overlay', 'Overlay', 'advanced', $opt_slug, ['color', 'gradient'], $show_if );

        return array_merge( $overlay, $fields );

    }

    protected function _get_overlay_style( $render_slug ) {

        $overlay_icon_color         = $this->props['overlay_icon_color'];
        $overlay_icon_color_hover   = $this->get_hover_value( 'overlay_icon_color' );
        $overlay_icon_size          = $this->props['overlay_icon_size'];
        $overlay_icon_size_hover    = $this->get_hover_value( 'overlay_icon_size' );
        $overlay_icon_opacity       = $this->props['overlay_icon_opacity'];
        $overlay_icon_opacity_hover = $this->get_hover_value( 'overlay_icon_opacity' );

        // Overlay background.
        $this->_get_custom_bg_style( $render_slug, 'overlay', '%%order_class%% .wdcl-overlay', '%%order_class%% .wdcl-carousel-item:hover .wdcl-overlay' );

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-overlay',
                'declaration' => sprintf( 'color: %1$s;', $overlay_icon_color ),
            ]
        );

        if ( !empty( $overlay_icon_color_hover ) ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%%:hover .wdcl-overlay',
                    'declaration' => sprintf( 'color: %1$s;', $overlay_icon_color_hover ),
                ]
            );
        }

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-overlay:after',
                'declaration' => "font-size:{$overlay_icon_size};",
            ]
        );

        if ( !empty( $overlay_icon_size_hover ) ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%%:hover .wdcl-overlay:after',
                    'declaration' => "font-size:{$overlay_icon_size_hover};",
                ]
            );
        }

        \ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .wdcl-overlay:after',
                'declaration' => "opacity:{$overlay_icon_opacity};",
            ]
        );

        if ( !empty( $overlay_icon_opacity_hover ) ) {
            \ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%%:hover .wdcl-overlay:after',
                    'declaration' => "opacity:{$overlay_icon_opacity_hover};",
                ]
            );
        }

    }

}
