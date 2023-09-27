<?php
class WDCL_LogoCarouselChild extends WDCL_Builder_Module {

    public $slug            = 'wdcl_logo_carousel_child';
    public $vb_support      = 'on';
    public $type            = 'child';
    public $child_title_var = 'admin_title';

    public function init() {
        $this->name = esc_html__( 'Logo', 'wdcl-wow-divi-carousel-lite' );

        $this->settings_modal_toggles = [
            'general'  => [
                'toggles' => [
                    'main_content' => [
                        'title' => esc_html__( 'Content', 'wdcl-wow-divi-carousel-lite' ),
                    ],
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'overlay' => esc_html__( 'Overlay', 'wdcl-wow-divi-carousel-lite' ),
                    'borders' => esc_html__( 'Borders', 'wdcl-wow-divi-carousel-lite' ),
                ],
            ],
        ];
    }

    public function get_fields() {

        $fields = [

            'logo'         => [
                'label'              => esc_html__( 'Upload Logo', 'wdcl-wow-divi-carousel-lite' ),
                'type'               => 'upload',
                'option_category'    => 'basic_option',
                'upload_button_text' => esc_attr__( 'Upload a Logo', 'wdcl-wow-divi-carousel-lite' ),
                'choose_text'        => esc_attr__( 'Choose a Logo', 'wdcl-wow-divi-carousel-lite' ),
                'update_text'        => esc_attr__( 'Set As Logo', 'wdcl-wow-divi-carousel-lite' ),
                'toggle_slug'        => 'main_content',
            ],

            'logo_alt'     => [
                'label'       => esc_html__( 'Logo Alt Text', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'text',
                'toggle_slug' => 'main_content',
            ],

            'is_link'      => [
                'label'           => esc_html__( 'Use Link', 'wdcl-wow-divi-carousel-lite' ),
                'type'            => 'yes_no_button',
                'option_category' => 'configuration',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'wdcl-wow-divi-carousel-lite' ),
                    'off' => esc_html__( 'No', 'wdcl-wow-divi-carousel-lite' ),
                ],
                'default'         => 'off',
                'toggle_slug'     => 'main_content',
            ],

            'link_url'     => [
                'label'       => esc_html__( 'Link Url', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'text',
                'default'     => '',
                'show_if'     => [
                    'is_link' => 'on',
                ],
                'toggle_slug' => 'main_content',
            ],

            'link_options' => [
                'type'        => 'multiple_checkboxes',
                'default'     => 'off|off',
                'toggle_slug' => 'main_content',
                'options'     => [
                    'link_target' => 'Open in new window',
                    'link_rel'    => 'Add nofollow',
                ],
                'show_if'     => [
                    'is_link' => 'on',
                ],
            ],
        ];

        $label = [
            'admin_title' => [
                'label'       => esc_html__( 'Admin Label', 'wdcl-wow-divi-carousel-lite' ),
                'type'        => 'text',
                'description' => esc_html__( 'This will change the label of the item', 'wdcl-wow-divi-carousel-lite' ),
                'toggle_slug' => 'admin_label',
            ],
        ];

        $overlay = $this->_get_overlay_option_fields( 'overlay', [] );

        return array_merge( $label, $fields, $overlay );
    }

    public function get_advanced_fields_config() {

        $advanced_fields                = [];
        $advanced_fields['text']        = false;
        $advanced_fields['fonts']       = false;
        $advanced_fields['text_shadow'] = false;
        $advanced_fields['max_width']   = false;

        $advanced_fields['margin_padding'] = [
            'css' => [
                'main'      => '%%order_class%% .wdcl-logo-carousel-item',
                'important' => 'all',
            ],
        ];

        $advanced_fields['borders']['item'] = [
            'css'          => [
                'main'      => [
                    'border_radii'  => '%%order_class%%',
                    'border_styles' => '%%order_class%%',
                ],
                'important' => 'all',
            ],
            'label_prefix' => esc_html__( 'Iten', 'wdcl-wow-divi-carousel-lite' ),
            'defaults'     => [
                'border_radii'  => 'on|0px|0px|0px|0px',
                'border_styles' => [
                    'width' => '0px',
                    'color' => '#333',
                    'style' => 'solid',
                ],
            ],
            'tab_slug'     => 'advanced',
            'toggle_slug'  => 'borders',
        ];

        return $advanced_fields;
    }

    public function _render_ref_attr() {

        if ( $this->props['is_link'] === 'on' ) {

            $link_options = explode( '|', $this->props['link_options'] );

            if ( $link_options[1] === 'on' ) {
                return sprintf( 'ref="nofollow"' );
            }

        }

    }

    public function _render_logo() {

        $placeholder = 'data:image/png;base64,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';
        $logo        = !empty( $this->props['logo'] ) ? $this->props['logo'] : $placeholder;
        $logo_alt    = $this->props['logo_alt'];

        if ( $this->props['is_link'] === 'on' ) {

            $link_options = explode( '|', $this->props['link_options'] );
            $target       = $link_options[0] === 'on' ? '_blank' : '_self';
            $link_url     = $this->props['link_url'];

            return sprintf(
                '<a target="%1$s" href="%2$s" %3$s><img class="wdcl-swapped-img" data-mfp-src="%4$s" src="%4$s" alt="%5$s" /></a>',
                $target,
                $link_url,
                $this->_render_ref_attr(),
                $logo,
                $logo_alt
            );
        }

        return sprintf( '<div><img class="wdcl-swapped-img" data-mfp-src="%1$s" src="%1$s" alt="%2$s"/></div>', $logo, $logo_alt );
    }

    public function render( $attrs, $content, $render_slug ) {

        $this->remove_classname( 'et_pb_module' );
        $this->add_classname( 'wdc_et_pb_module' );
        $this->_get_overlay_style( $render_slug );

        $processed_overlay_icon = esc_attr( et_pb_process_font_icon( $this->props['overlay_icon'] ) );
        $overlay_icon           = !empty( $processed_overlay_icon ) ? $processed_overlay_icon : '';

        return sprintf(
            '<div class="wdcl-carousel-item wdcl-logo-carousel-item wdcl-swapped-img-selector">
			<div class="wdcl-overlay" data-icon="%2$s"></div>
				%1$s
			</div>',
            $this->_render_logo(),
            $overlay_icon
        );
    }

}

new WDCL_LogoCarouselChild();
