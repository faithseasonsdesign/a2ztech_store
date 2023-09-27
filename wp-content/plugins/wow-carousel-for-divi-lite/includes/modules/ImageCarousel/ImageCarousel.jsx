// External Dependencies
import React, { Component } from "react";
import Slider from "react-slick";
import { _getCarouselCss, _getCarouselSettings } from '../ModulesCore/WowCarouselCommon';
import "./style.css";

class WDCL_ImageCarousel extends Component {

    static slug = "wdcl_image_carousel";

    static css(props) {
        return _getCarouselCss(props);
    }

    render() {

        let settings         = _getCarouselSettings( this.props ),
            is_center        = this.props.is_center,
            center_mode_type = this.props.center_mode_type,
            sliding_dir = this.props.sliding_dir,
            custom_cursor    = this.props.custom_cursor,
            classes          = [];

        if( is_center === 'on' ) {
            classes.push( `wdcl-centered wdcl-centered--${center_mode_type}` );
        }

        if( custom_cursor === 'on' ) {
            classes.push( 'wdcl-cursor' );
        }

        classes.push(`dir-${sliding_dir}`);

        return (
            <div className={`wdcl-carousel wdcl-image-carousel ${classes.join(' ')}`}>
                <Slider {...settings}>{ this.props.content }</Slider>
            </div>
        );
    }
}

export default WDCL_ImageCarousel;
