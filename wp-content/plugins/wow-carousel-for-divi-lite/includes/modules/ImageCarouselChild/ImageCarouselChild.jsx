// External Dependencies
import React, { Component } from "react";
import { _getCustomBgCss, _getOverlayStyleCss } from '../ModulesCore/WowCarouselCommon';
// Internal Dependencies
import "./style.css";

class WDCL_ImageCarouselChild extends Component {

    static slug = "wdcl_image_carousel_child";

    constructor(props) {
        super(props);
        this.state = { width: 0};
        this.updateWindowDimensions = this.updateWindowDimensions.bind(this);
      }

      componentDidMount() {
        this.updateWindowDimensions();
        window.addEventListener('resize', this.updateWindowDimensions);
      }

      componentWillUnmount() {
        window.removeEventListener('resize', this.updateWindowDimensions);
      }

      updateWindowDimensions() {
        this.setState({ width: window.innerWidth});
      }

    static css( props ) {

        const additionalCss = [];

        let content_pos_x                     = props.content_pos_x ? props.content_pos_x : "center",
            content_pos_y                     = props.content_pos_y ? props.content_pos_y : "center",
            content_type                      = props.content_type ? props.content_type : "absolute",
            content_width                     = props.content_width ? props.content_width : "100%",
            image_height                      = props.image_height ? props.image_height : "auto",
            title_bottom_spacing              = props.title_bottom_spacing ? props.title_bottom_spacing : "5px",
            content_padding                   = props.content_padding,
            content_padding_tablet            = props.content_padding_tablet,
            content_padding_phone             = props.content_padding_phone,
            content_padding_last_edited       = props.content_padding_last_edited,
            content_padding_responsive_status = content_padding_last_edited && content_padding_last_edited.startsWith("on");

        if ( content_type === 'absolute' ) {
            content_padding = props.content_padding ? props.content_padding : '10px|20px|10px|20px';
        } else {
            content_padding = props.content_padding ? props.content_padding : '20px|0|0|0';
        }

        let contentPadding = content_padding.split("|");

        // image height
        if( image_height !== 'auto' ) {

            additionalCss.push( [{
                selector: "%%order_class%% .wdcl-image-carousel-item figure",
                declaration: `height: ${image_height};`
            }] );

            additionalCss.push( [{
                selector: "%%order_class%% .wdcl-image-carousel-item figure img",
                declaration: `height: 100%; object-fit: cover;width:100%;`
            }] );
        }

        // Texts
        additionalCss.push( [{
            selector: "%%order_class%% .wdcl-image-carousel-item h3, .et-db #et-boc %%order_class%% .wdcl-image-carousel-item h3",
            declaration: `padding-bottom: ${title_bottom_spacing}!important;`
        }] );

        //content
        if( content_type === 'absolute' ) {
            additionalCss.push( [{
                selector: "%%order_class%% .content--absolute",
                declaration: `
                    align-items: ${content_pos_x};
                    justify-content: ${content_pos_y};`
            }] );
        }

        additionalCss.push( [{
            selector: "%%order_class%% .wdcl-image-carousel-item .content .content-inner",
            declaration: `
                width: ${content_width};
                padding-top: ${contentPadding[0]};
                padding-right: ${contentPadding[1]};
                padding-bottom: ${contentPadding[2]};
                padding-left: ${contentPadding[3]};`
        }] );

        if( content_padding_tablet && content_padding_responsive_status ) {

            let contentPaddingTablet = content_padding_tablet.split("|");
            additionalCss.push( [{
                selector: "%%order_class%% .wdcl-image-carousel-item .content .content-inner",
                device: "tablet",
                declaration: `
                    padding-top: ${contentPaddingTablet[0]};
                    padding-right: ${contentPaddingTablet[1]};
                    padding-bottom: ${contentPaddingTablet[2]};
                    padding-left: ${contentPaddingTablet[3]};`
            }] );
        }

        if( content_padding_phone && content_padding_responsive_status ) {

            let contentPaddingPhone = content_padding_phone.split("|");
            additionalCss.push( [{
                selector: "%%order_class%% .wdcl-image-carousel-item .content .content-inner",
                device: "phone",
                declaration: `
                    padding-top: ${contentPaddingPhone[0]};
                    padding-right: ${contentPaddingPhone[1]};
                    padding-bottom: ${contentPaddingPhone[2]};
                    padding-left: ${contentPaddingPhone[3]};`
            }] );
        }

		// Content Background
        let content_bg_style = _getCustomBgCss( props, 'content', '%%order_class%% .wdcl-image-carousel-item .content .content-inner', "%%order_class%% .wdcl-image-carousel-item .content .content-inner:hover" );

        // Overlay Styles
        let overlay_styles = _getOverlayStyleCss( props );

        return additionalCss.concat( content_bg_style ).concat( overlay_styles );
    }

    _render_figure = () => {

        const utils         = window.ET_Builder.API.Utils;
        let placeholder_img = "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTA4MCIgaGVpZ2h0PSI1NDAiIHZpZXdCb3g9IjAgMCAxMDgwIDU0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZmlsbD0iI0VCRUJFQiIgZD0iTTAgMGgxMDgwdjU0MEgweiIvPgogICAgICAgIDxwYXRoIGQ9Ik00NDUuNjQ5IDU0MGgtOTguOTk1TDE0NC42NDkgMzM3Ljk5NSAwIDQ4Mi42NDR2LTk4Ljk5NWwxMTYuMzY1LTExNi4zNjVjMTUuNjItMTUuNjIgNDAuOTQ3LTE1LjYyIDU2LjU2OCAwTDQ0NS42NSA1NDB6IiBmaWxsLW9wYWNpdHk9Ii4xIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgICAgICA8Y2lyY2xlIGZpbGwtb3BhY2l0eT0iLjA1IiBmaWxsPSIjMDAwIiBjeD0iMzMxIiBjeT0iMTQ4IiByPSI3MCIvPgogICAgICAgIDxwYXRoIGQ9Ik0xMDgwIDM3OXYxMTMuMTM3TDcyOC4xNjIgMTQwLjMgMzI4LjQ2MiA1NDBIMjE1LjMyNEw2OTkuODc4IDU1LjQ0NmMxNS42Mi0xNS42MiA0MC45NDgtMTUuNjIgNTYuNTY4IDBMMTA4MCAzNzl6IiBmaWxsLW9wYWNpdHk9Ii4yIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgIDwvZz4KPC9zdmc+Cg==";
        let overlay_icon    = this.props.overlay_icon ? utils.processFontIcon( this.props.overlay_icon ) : '',
            url             = this.props.photo ? this.props.photo : placeholder_img;

        return (
            <figure>
                <div data-icon={`${overlay_icon}`} className="wdcl-overlay"></div>
                <img src={url} alt="" />
            </figure>
        );
    };

    _render_title = () => {
        if( this.props.title ) {
            let Title = this.props.title_level ? this.props.title_level : 'h3';
			if( this.props.dynamic.title.value ) {
				return (
					<Title className='wdcl-image-title'>{this.props.dynamic.title.render()}</Title>
				  );
			}
			else {
				return (
					<Title className="wdcl-image-title" dangerouslySetInnerHTML={{ __html: this.props.title }} />
				  );
			}
        }
    };

    _render_sub_title = () => {
        if ( this.props.sub_title ) {
            let Subtitle = this.props.subtitle_level ? this.props.subtitle_level : 'h5';

			if( this.props.dynamic.sub_title.value ) {
				return (
					<Subtitle className='wdcl-image-subtitle'>{this.props.dynamic.sub_title.render()}</Subtitle>
				  );
			}
			else {
				return (
					<Subtitle className="wdcl-image-subtitle" dangerouslySetInnerHTML={{ __html: this.props.sub_title }} />
				  );
			}
        }
    };


    _render_content = ({
        title,
        sub_title,
        content_type,
        content_alignment
    }) => {

        if (!title && !sub_title) return;

        content_alignment = content_alignment ? content_alignment : "left";
        content_type      = content_type ? content_type : "absolute";

        return (
            <div className={`content content--${content_type} content--${content_alignment}`}>
                <div className="content-inner">
                    { this._render_title() }
                    { this._render_sub_title() }
                </div>
            </div>
        );
    };


    render() {

        return (
            <div className={`wdcl-carousel-item wdcl-image-carousel-item wdcl-hover--${this.props.image_hover_animation}`}>
                {this._render_figure() }
                {this._render_content( this.props )}
            </div>
        );
    }
}

export default WDCL_ImageCarouselChild;
