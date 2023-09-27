// External Dependencies
import React, { Component } from "react";
import Slick from "react-slick";
import {
    _getCarouselCss,
    _getCarouselSettings
} from "../ModulesCore/WowCarouselCommon";
// Internal Dependencies
import "./style.css";

class WDCL_LogoCarousel extends Component {
    static slug = "wdcl_logo_carousel";

    static css(props) {
        const additionalCss = [];
        let carouselCss = _getCarouselCss(props);

        /**
         *  Logo Height
         */
        let logo_height = props.logo_height ? props.logo_height : "auto";
        let logo_height_tablet = props.logo_height_tablet;
        let logo_height_phone = props.logo_height_phone;
        let logo_height_last_edited = props.logo_height_last_edited;
        let logo_height_responsive_status =
            logo_height_last_edited && logo_height_last_edited.startsWith("on");

        let logo_width = props.logo_width ? props.logo_width : "auto";
        let logo_width_tablet = props.logo_width_tablet;
        let logo_width_phone = props.logo_width_phone;
        let logo_width_last_edited = props.logo_width_last_edited;
        let logo_width_responsive_status =
            logo_width_last_edited && logo_width_last_edited.startsWith("on");

        if (logo_height !== "auto") {
            additionalCss.push([
                {
                    selector: "%%order_class%% .wdcl-logo-carousel-item",
                    declaration: `
                    height: ${logo_height};
                    display: flex;
                    justify-content: center;
                    align-items: center;`,
                },
            ]);

            if (logo_height_tablet && logo_height_responsive_status) {
                additionalCss.push([
                    {
                        selector: "%%order_class%% .wdcl-logo-carousel-item",
                        device: "tablet",
                        declaration: `
                        height: ${logo_height_tablet};
                        display: flex;
                        justify-content: center;
                        align-items: center;`,
                    },
                ]);
            }

            if (logo_height_phone && logo_height_responsive_status) {
                additionalCss.push([
                    {
                        selector: "%%order_class%% .wdcl-logo-carousel-item",
                        device: "phone",
                        declaration: `
                        height: ${logo_height_phone};
                        display: flex;
                        justify-content: center;
                        align-items: center;`,
                    },
                ]);
            }
        }

        if (logo_width !== "auto") {
            additionalCss.push([
                {
                    selector: "%%order_class%% .wdcl-logo-carousel-item img",
                    declaration: `width: ${logo_width};`,
                },
            ]);

            if (logo_width_tablet && logo_width_responsive_status) {
                additionalCss.push([
                    {
                        selector:
                            "%%order_class%% .wdcl-logo-carousel-item img",
                        device: "tablet",
                        declaration: `width: ${logo_width_tablet};`,
                    },
                ]);
            }

            if (logo_width_phone && logo_width_responsive_status) {
                additionalCss.push([
                    {
                        selector:
                            "%%order_class%% .wdcl-logo-carousel-item img",
                        device: "phone",
                        declaration: `width: ${logo_width_phone};`,
                    },
                ]);
            }
        }

        return additionalCss.concat(carouselCss);
    }

    render() {
        let settings = _getCarouselSettings(this.props),
            is_center = this.props.is_center,
            center_mode_type = this.props.center_mode_type,
            custom_cursor = this.props.custom_cursor,
            sliding_dir = this.props.sliding_dir,
            classes = [];

        if (is_center === "on") {
            classes.push(`wdcl-centered wdcl-centered--${center_mode_type}`);
        }

        if (custom_cursor === "on") {
            classes.push("wdcl-cursor");
        }

        classes.push(this.props.logo_hover);
        classes.push(`dir-${sliding_dir}`);
        return (
            <div
                className={`wdcl-carousel wdcl-logo-carousel ${classes.join(
                    " "
                )}`}
            >
                <Slick {...settings}>{this.props.content}</Slick>
            </div>
        );
    }
}

export default WDCL_LogoCarousel;
