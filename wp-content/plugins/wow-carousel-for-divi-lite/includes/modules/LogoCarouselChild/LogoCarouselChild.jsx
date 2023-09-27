// External Dependencies
import React, { Component } from "react";
import { PLACEHOLDER_LOGO } from "./placeHolderLogo";

// Internal Dependencies
import "./style.css";
import { _getOverlayStyleCss } from '../ModulesCore/WowCarouselCommon';

class WDCL_LogoCarouselChild extends Component {

    static slug = "wdcl_logo_carousel_child";

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

        // Overlay Styles
        let overlay_styles = _getOverlayStyleCss( props );

        return overlay_styles;
    }

    _render_logo = ( url ) => {

        let props        = this.props,
            is_link      = props.is_link ? props.is_link : 'off',
            logo_alt   = props.logo_alt,
            link_options = props.link_options ? props.link_options : "off|off",
            link_url     = props.link_url,
            logo         = props.logo ? props.logo : PLACEHOLDER_LOGO;

        if ( is_link === "on" ) {

            let linkOptions = link_options.split("|"),
                linkTarget  = linkOptions[0] === "off" ? "_self" : "_blank",
                attr        = {};

            if (linkOptions[1] === "on") {
                attr["rel"] = "nofollow";
            }

            return (
                <a href={link_url} target={linkTarget} {...attr}>
                    <img src={logo} alt={logo_alt} />
                </a>
            );
        }
        return <img src={logo} alt={logo_alt} />;
    };


    render() {

        const utils      = window.ET_Builder.API.Utils;
        let overlay_icon = this.props.overlay_icon ? utils.processFontIcon( this.props.overlay_icon ) : '';

        return (
            <div className="wdcl-carousel-item wdcl-logo-carousel-item">
                <div data-icon={`${overlay_icon}`} className="wdcl-overlay"></div>
                { this._render_logo() }
            </div>
        );
    }
}

export default WDCL_LogoCarouselChild;
