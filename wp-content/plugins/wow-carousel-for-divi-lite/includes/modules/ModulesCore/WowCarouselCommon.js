export const _getCarouselSettings = (props, type) => {
    let content_length = 0,
        slide_count = props.slide_count,
        is_fade = props.is_fade,
        slide_count_tablet = props.slide_count_tablet
            ? props.slide_count_tablet
            : props.slide_count,
        slide_count_phone = props.slide_count_phone
            ? props.slide_count_phone
            : slide_count_tablet,
        nav_pagi_tablet = props.nav_pagi_tablet
            ? props.nav_pagi_tablet
            : props.nav_pagi,
        nav_pagi_phone = props.nav_pagi_phone
            ? props.nav_pagi_phone
            : nav_pagi_tablet,
        is_pagi_active =
            props.nav_pagi === "pagi" || props.nav_pagi === "nav_pagi"
                ? true
                : false,
        is_pagi_active_tablet =
            nav_pagi_tablet === "pagi" || nav_pagi_tablet === "nav_pagi"
                ? true
                : false,
        is_pagi_active_phone =
            nav_pagi_phone === "pagi" || nav_pagi_phone === "nav_pagi"
                ? true
                : false,
        is_arrow_active =
            props.nav_pagi === "nav" || props.nav_pagi === "nav_pagi"
                ? true
                : false,
        is_arrow_active_tablet =
            nav_pagi_tablet === "nav" || nav_pagi_tablet === "nav_pagi"
                ? true
                : false,
        is_arrow_active_phone =
            nav_pagi_phone === "nav" || nav_pagi_phone === "nav_pagi"
                ? true
                : false,
        center_mode_type = props.center_mode_type,
        center_padding = props.center_padding,
        center_padding_tablet = props.center_padding_tablet,
        center_padding_phone = props.center_padding_phone,
        is_variable_width = props.is_variable_width,
        is_auto_height = props.is_auto_height,
        slide_to_scroll = props.slide_to_scroll,
        slide_to_scroll_tablet = props.slide_to_scroll_tablet,
        slide_to_scroll_phone = props.slide_to_scroll_phone,
        slide_infinite = null,
        slide_infinite_tablet = null,
        slide_infinite_phone = null;
    is_auto_height =
        slide_count < 2 &&
        is_variable_width === "off" &&
        is_auto_height === "on"
            ? true
            : false;

    // Center Mode Responsive
    if (!center_padding_tablet) {
        center_padding_tablet = center_padding;
    }

    if (!center_padding_phone) {
        center_padding_phone = center_padding_tablet;
    }

    // Center Mode Responsive
    if (!slide_to_scroll_tablet) {
        slide_to_scroll_tablet = slide_to_scroll;
    }

    if (!slide_to_scroll_phone) {
        slide_to_scroll_phone = slide_to_scroll_tablet;
    }

    //fixing slide infinite issue
    if (type !== "jQuery") {
        content_length = props.content.length;
        slide_infinite =
            content_length >= slide_count && props.is_infinite === "on"
                ? true
                : false;
        slide_infinite_tablet =
            content_length >= slide_count_tablet && props.is_infinite === "on"
                ? true
                : false;
        slide_infinite_phone =
            content_length >= slide_count_phone && props.is_infinite === "on"
                ? true
                : false;
    } else {
        slide_infinite = props.is_infinite === "on" ? true : false;
        slide_infinite_tablet = slide_infinite;
        slide_infinite_phone = slide_infinite;
    }

    // variable width won't work for multiple slides
    if (is_variable_width === "on") {
        slide_count = 1;
        slide_count_tablet = 1;
        slide_count_phone = 1;
    }

    // global carousel settings
    let settings = {
        dots: is_pagi_active,
        arrows: is_arrow_active,
        adaptiveHeight: is_auto_height,
        swipe: props.is_center === "on" ? false : true,
        infinite: slide_infinite,
        autoplay: props.is_autoplay === "on" ? true : false,
        autoplaySpeed: parseInt(props.autoplay_speed),
        speed: parseInt(props.animation_speed),
        fade: "on" === is_fade ? true : false,
        slidesToShow: parseInt(slide_count),
        variableWidth: is_variable_width === "on" ? true : false,
        slidesToScroll: parseInt(slide_to_scroll),
        centerMode: props.is_center === "on" ? true : false,
        centerPadding:
            is_variable_width === "off" && center_mode_type === "classic"
                ? center_padding
                : 0,
        vertical: props.is_vertical === "on" ? true : false,
        responsive: [
            {
                breakpoint: 980,
                settings: {
                    slidesToShow: parseInt(slide_count_tablet),
                    dots: is_pagi_active_tablet ? true : false,
                    arrows: is_arrow_active_tablet ? true : false,
                    infinite: slide_infinite_tablet,
                    centerPadding:
                        is_variable_width === "off" &&
                        center_mode_type === "classic"
                            ? center_padding_tablet
                            : 0,
                    slidesToScroll: parseInt(slide_to_scroll_tablet),
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: parseInt(slide_count_phone),
                    dots: is_pagi_active_phone ? true : false,
                    arrows: is_arrow_active_phone ? true : false,
                    infinite: slide_infinite_phone,
                    centerPadding:
                        is_variable_width === "off" &&
                        center_mode_type === "classic"
                            ? center_padding_phone
                            : 0,
                    slidesToScroll: parseInt(slide_to_scroll_phone),
                },
            },
        ],
    };

    return settings;
};

export const _getCarouselCss = (props) => {
    const additionalCss = [];

    let arrow_height = props.arrow_height,
        arrow_height_tablet = props.arrow_height_tablet
            ? props.arrow_height_tablet
            : arrow_height,
        arrow_height_phone = props.arrow_height_phone
            ? props.arrow_height_phone
            : arrow_height_tablet,
        arrow_width = props.arrow_width,
        arrow_width_tablet = props.arrow_width_tablet
            ? props.arrow_width_tablet
            : arrow_width,
        arrow_width_phone = props.arrow_width_phone
            ? props.arrow_width_phone
            : arrow_width_tablet,
        arrow_color = props.arrow_color,
        arrow_color__hover = props.arrow_color__hover
            ? props.arrow_color__hover
            : arrow_color,
        arrow_bg = props.arrow_bg,
        arrow_bg__hover = props.arrow_bg__hover
            ? props.arrow_bg__hover
            : arrow_bg,
        arrow_icon_size = props.arrow_icon_size,
        arrow_icon_size_tablet = props.arrow_icon_size_tablet
            ? props.arrow_icon_size_tablet
            : arrow_icon_size,
        arrow_icon_size_phone = props.arrow_icon_size_phone
            ? props.arrow_icon_size_phone
            : arrow_icon_size_tablet,
        icon_right = props.icon_right,
        icon_left = props.icon_left,
        arrow_border_width = props.arrow_border_width,
        arrow_border_color = props.arrow_border_color,
        arrow_border_color__hover = props.arrow_border_color__hover
            ? props.arrow_border_color__hover
            : arrow_border_color,
        arrow_border_style = props.arrow_border_style,
        arrow_pos_y = props.arrow_pos_y,
        arrow_pos_y_tablet = props.arrow_pos_y_tablet
            ? props.arrow_pos_y_tablet
            : arrow_pos_y,
        arrow_pos_y_phone = props.arrow_pos_y_phone
            ? props.arrow_pos_y_phone
            : arrow_pos_y_tablet,
        arrow_x_center = props.arrow_x_center,
        arrow_pos_x = props.arrow_pos_x,
        arrow_pos_x_tablet = props.arrow_pos_x_tablet
            ? props.arrow_pos_x_tablet
            : arrow_pos_x,
        arrow_pos_x_phone = props.arrow_pos_x_phone
            ? props.arrow_pos_x_phone
            : arrow_pos_x_tablet,
        arrow_type = props.arrow_type,
        arrow_pos = props.arrow_pos,
        arrow_pos_hz = props.arrow_pos_hz,
        arrow_gap = props.arrow_gap,
        arrow_gap_tablet = props.arrow_gap_tablet
            ? props.arrow_gap_tablet
            : arrow_gap,
        arrow_gap_phone = props.arrow_gap_phone
            ? props.arrow_gap_phone
            : arrow_gap_tablet,
        arrow_skew = props.arrow_skew,
        int_skew = parseInt(arrow_skew),
        arrow_skew_inner =
            int_skew < 0 ? `${Math.abs(int_skew)}` : `-${Math.abs(int_skew)}`,
        pagi_alignment = props.pagi_alignment,
        pagi_color = props.pagi_color,
        pagi_color__hover = props.pagi_color__hover
            ? props.pagi_color__hover
            : pagi_color,
        pagi_pos_y = props.pagi_pos_y,
        pagi_spacing = props.pagi_spacing,
        pagi_color_active = props.pagi_color_active,
        pagi_height = props.pagi_height,
        pagi_width = props.pagi_width,
        pagi_radius = props.pagi_radius.split("|"),
        pagi_width_active = props.pagi_width_active,
        left_border_radius = props.left_border_radius.split("|"),
        right_border_radius = props.right_border_radius.split("|"),
        slide_spacing = props.slide_spacing,
        is_vertical = props.is_vertical,
        is_variable_width = props.is_variable_width,
        sliding_dir = props.sliding_dir,
        slide_width = props.slide_width,
        slide_width_tablet = props.slide_width_tablet,
        slide_width_phone = props.slide_width_phone,
        slide_width_responsive_status =
            props.slide_width_last_edited &&
            props.slide_width_last_edited.startsWith("on"),
        animation_speed = props.animation_speed,
        custom_cursor = props.custom_cursor,
        cursor_name = props.cursor_name,
        carousel_spacing_top = props.carousel_spacing_top,
        carousel_spacing_top_tablet = props.carousel_spacing_top_tablet,
        carousel_spacing_top_phone = props.carousel_spacing_top_phone,
        carousel_spacing_top_responsive_status =
            props.carousel_spacing_top_last_edited &&
            props.carousel_spacing_top_last_edited.startsWith("on"),
        carousel_spacing_bottom = props.carousel_spacing_bottom,
        carousel_spacing_bottom_tablet = props.carousel_spacing_bottom_tablet,
        carousel_spacing_bottom_phone = props.carousel_spacing_bottom_phone,
        carousel_spacing_bottom_responsive_status =
            props.carousel_spacing_bottom_last_edited &&
            props.carousel_spacing_bottom_last_edited.startsWith("on");

    const utils = window.ET_Builder.API.Utils,
        rightIcon = icon_right ? utils.processFontIcon(icon_right) : "5",
        leftIcon = icon_left ? utils.processFontIcon(icon_left) : "4";

    let left = sliding_dir === "ltr" ? "left" : "right",
        right = sliding_dir === "ltr" ? "right" : "left";

    if (arrow_type === "default" && sliding_dir === "ltr") {
        additionalCss.push([
            {
                selector: "%%order_class%% .wdcl-carousel .slick-prev",
                declaration: `right: auto!important;`,
            },
        ]);
        additionalCss.push([
            {
                selector: "%%order_class%% .wdcl-carousel .slick-next",
                declaration: `left: auto!important;`,
            },
        ]);
    }


    let cursor_data = {
        pizza:
            "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAIVBMVEUAAAAAAAD/////zGb/mTOZAAAAzAD/zDP/AAD/Zmb/mZm5WRymAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTCRh4PlpnAAAA8ElEQVQoz12QsbnDIAyExQaWQ0ySztngfW8BMgIFA3gEVardEXfu3KbzmJEgTrCvEfo5wQEgABjMakDVNgZP/1l/GbX9p81ISHuvgJL23tfgIUAs5VCxWgWyjKoQ8GRlpO2lwXOM3TkG9IACAkoTg7pKKsc6hWKzGg1ZhVKohHVMGUkhr8Bw57Kjc5RfA0626Jmk2A9g7m7LNDL6AsRNlynNNJQezOL4ktK4TQDcRr5OMtJswMxMaXXkv2BkJ3kJvkIamAb7A441mv8Bo+9AqIR8fdoadJjWpgaGltnvwfqCnXB/hH6kPwCCg+wRbJe+ATasSMvHEwtpAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjA5OjIzKzAwOjAwCTF7LQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOTowOTowNiswMDowMGhx60sAAAAASUVORK5CYII=",
        burger:
            "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAALVBMVEUAAAAAAAD////MZgBmMwCZMwD/zDP/mQD/zAB4eHhGRkbc3NygoKDIyMhmAAAKaD9VAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTGhFgDaNRAAAAEGNhTnYAAAAgAAAAIAAAAAAAAAAAYrnu+gAAATdJREFUKM9lkbFOwzAQhl2lM4qrLLW68AYgG2VtlIu6sVTxCzCwA5XzACCydmyUpWNNl670CVLyBkxImXkG7i6oSOFXlv+7/85nR4RiIDkEk2FkcvkPUCSA9DyDvMlyDVc9CKmca9Q5FMAS7c2dNr/ELNmiDHcFmdaWPms1R0zOVa1j98gRwCp1xKt7R4A60FlnnXugnnGK3pFs8doDi92OAiVPHWd4JvmyLDWBEa0Vk33Bydd4l4j3cCs63ExDIbfAq7OSdwQ7GQHkdD0jpwqBqrYSSImsP99CMVLN2kvS7ORnByEupG/aTdWu1/VOHSMEX1Ltvd+3zWnzcQAEt1IqX3tfHb2MDIKuS3iEwtkLTIhvMMAkguJpLiiSaj52UZTAb9oBb+ncM8z7Vx4DvwnA3+/jlr78AzvMazraOl3vAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjI2OjE2KzAwOjAwfOGxJQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOToyNjoxNiswMDowMA28CZkAAAAASUVORK5CYII=",
    };

    // center mode animation speed
    additionalCss.push([
        {
            selector:
                "%%order_class%% .wdcl-centered--highlighted .slick-slide",
            declaration: `transition: transform ${animation_speed};`,
        },
    ]);

    // Custom Cursor
    if (custom_cursor === "on") {
        let cursor_type = cursor_name.split("_")[0];
        let cursor_icon = cursor_name.split("_")[1];

        if (cursor_type === "css") {
            additionalCss.push([
                {
                    selector: "%%order_class%%",
                    declaration: `cursor: ${cursor_icon}!important;`,
                },
            ]);
        } else if (cursor_type === "custom") {
            additionalCss.push([
                {
                    selector: "%%order_class%%",
                    declaration: `cursor: url('${cursor_data[cursor_icon]}'), auto!important;`,
                },
            ]);
        }
    }

    // Carousel Spacing Top - Bottom
    additionalCss.push([
        {
            selector: "%%order_class%% .slick-track",
            declaration: `padding-top: ${carousel_spacing_top}; padding-bottom: ${carousel_spacing_bottom};`,
        },
    ]);

    // Carousel Spacing Top Tablet
    if (carousel_spacing_top_tablet && carousel_spacing_top_responsive_status) {
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-track",
                device: "tablet",
                declaration: `padding-top: ${carousel_spacing_top_tablet};`,
            },
        ]);
    }

    // Carousel Spacing Top Phone
    if (carousel_spacing_top_phone && carousel_spacing_top_responsive_status) {
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-track",
                device: "phone",
                declaration: `padding-top: ${carousel_spacing_top_phone};`,
            },
        ]);
    }

    // Carousel Spacing Bottom Tablet
    if (
        carousel_spacing_bottom_tablet &&
        carousel_spacing_bottom_responsive_status
    ) {
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-track",
                device: "tablet",
                declaration: `padding-bottom: ${carousel_spacing_bottom_tablet};`,
            },
        ]);
    }

    // Carousel Spacing Bottom Phone
    if (
        carousel_spacing_bottom_phone &&
        carousel_spacing_bottom_responsive_status
    ) {
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-track",
                device: "phone",
                declaration: `padding-bottom: ${carousel_spacing_bottom_phone};`,
            },
        ]);
    }

    // Slide Variable Width
    if (is_variable_width === "on") {
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-slide",
                declaration: `width: ${slide_width};`,
            },
        ]);

        // Slide Variable Width Tablet
        if (slide_width_tablet && slide_width_responsive_status) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-slide",
                    device: "tablet",
                    declaration: `width: ${slide_width_tablet};`,
                },
            ]);
        }

        // Slide Variable Width Phone
        if (slide_width_phone && slide_width_responsive_status) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-slide",
                    device: "phone",
                    declaration: `width: ${slide_width_phone};`,
                },
            ]);
        }
    }

    // Arrow
    additionalCss.push([
        {
            selector: "%%order_class%% .slick-arrow",
            declaration: `
                height: ${arrow_height};
                width: ${arrow_width};
                color: ${arrow_color};
                background: ${arrow_bg};
                border: ${arrow_border_width} ${arrow_border_style} ${arrow_border_color};
                margin-top: -${parseInt(arrow_height) / 2}px;
                transform: skew(${arrow_skew});`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-arrow:before",
            declaration: `
                font-size: ${arrow_icon_size};
                transform: skew(${arrow_skew_inner}deg);
                display: inline-block;`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-next",
            declaration: `
                border-radius: ${right_border_radius[1]} ${right_border_radius[2]} ${right_border_radius[3]} ${right_border_radius[4]};`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-prev",
            declaration: `
                border-radius: ${left_border_radius[1]} ${left_border_radius[2]} ${left_border_radius[3]} ${left_border_radius[4]};`,
        },
    ]);

    // Arrow tablet
    additionalCss.push([
        {
            selector: "%%order_class%% .slick-arrow",
            device: "tablet",
            declaration: `height: ${arrow_height_tablet}; width: ${arrow_width_tablet};`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-arrow:before",
            device: "tablet",
            declaration: `font-size: ${arrow_icon_size_tablet};`,
        },
    ]);

    //Arrow phone
    additionalCss.push([
        {
            selector: "%%order_class%% .slick-arrow",
            device: "phone",
            declaration: `height: ${arrow_height_phone}; width: ${arrow_width_phone};`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-arrow:before",
            device: "phone",
            declaration: `font-size: ${arrow_icon_size_phone};`,
        },
    ]);

    //Arrow hover
    additionalCss.push([
        {
            selector: "%%order_class%% .slick-arrow:hover",
            declaration: ` color: ${arrow_color__hover}; background: ${arrow_bg__hover}; border-color: ${arrow_border_color__hover};`,
        },
    ]);

    // Arrow type
    if ( sliding_dir === "rtl" || arrow_type === "default") {
        // default arrow type
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-arrow",
                declaration: `top: ${arrow_pos_y};`,
            },
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .slick-next",
                declaration: `right: auto; ${right}: ${arrow_pos_x};`,
            },
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .slick-prev",
                declaration: `left: auto; ${left}: ${arrow_pos_x};`,
            },
        ]);

        // default arrow tablet
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-arrow",
                device: "tablet",
                declaration: `top: ${arrow_pos_y_tablet};`,
            },
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .slick-next",
                device: "tablet",
                declaration: `${right}: ${arrow_pos_x_tablet};`,
            },
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .slick-prev",
                device: "tablet",
                declaration: `${left}: ${arrow_pos_x_tablet};`,
            },
        ]);

        // default arrow phone
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-arrow",
                device: "phone",
                declaration: `top: ${arrow_pos_y_phone};`,
            },
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .slick-next",
                device: "phone",
                declaration: `${right}: ${arrow_pos_x_phone};`,
            },
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .slick-prev",
                device: "phone",
                declaration: `${left}: ${arrow_pos_x_phone};`,
            },
        ]);
    }

    // alongside arrow type
    else if (sliding_dir === "ltr" && arrow_type === "alongside") {

        if ( 'right' === arrow_pos_hz ) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .wdcl-carousel .slick-next",
                    declaration: `left: auto!important;`,
                },
            ]);
        } else {
            additionalCss.push([
                {
                    selector: "%%order_class%% .wdcl-carousel .slick-next",
                    declaration: `right: auto!important;`,
                },
            ]);
        }



        additionalCss.push([
            {
                selector: "%%order_class%% .slick-arrow",
                declaration: `top: auto; ${arrow_pos}: ${arrow_pos_y};`,
            },
        ]);

        if (arrow_x_center && arrow_x_center === "on") {
            //desktop
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-next",
                    declaration: `right: calc(50% - ${parseInt(arrow_width) +
                        parseInt(arrow_gap) / 2}px);`,
                },
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    declaration: `left: calc(50% - ${parseInt(arrow_width) +
                        parseInt(arrow_gap) / 2}px);`,
                },
            ]);

            // tablet
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-next",
                    device: "tablet",
                    declaration: `right: calc(50% - ${parseInt(
                        arrow_width_tablet
                    ) +
                        parseInt(arrow_gap_tablet) / 2}px);`,
                },
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    device: "tablet",
                    declaration: `left: calc(50% - ${parseInt(
                        arrow_width_tablet
                    ) +
                        parseInt(arrow_gap_tablet) / 2}px);`,
                },
            ]);

            // phone
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-next",
                    device: "phone",
                    declaration: `right: calc(50% - ${parseInt(
                        arrow_width_phone
                    ) +
                        parseInt(arrow_gap_phone) / 2}px);`,
                },
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    device: "phone",
                    declaration: `left: calc(50% - ${parseInt(
                        arrow_width_phone
                    ) +
                        parseInt(arrow_gap_phone) / 2}px);`,
                },
            ]);
        } else {
            // position X
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-next",
                    declaration: `${arrow_pos_hz}: ${arrow_pos_x};`,
                },
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    declaration: `left: auto; ${arrow_pos_hz}: ${arrow_pos_x};`,
                },
            ]);

            // position X tablet
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-next",
                    device: "tablet",
                    declaration: `${arrow_pos_hz}: ${arrow_pos_x_tablet};`,
                },
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    device: "tablet",
                    declaration: `left: auto; ${arrow_pos_hz}: ${arrow_pos_x_tablet};`,
                },
            ]);

            // position X phone
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-next",
                    device: "phone",
                    declaration: `${arrow_pos_hz}: ${arrow_pos_x_phone};`,
                },
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    device: "phone",
                    declaration: `left: auto; ${arrow_pos_hz}: ${arrow_pos_x_phone};`,
                },
            ]);

            // arrow gap
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    declaration: `margin-${arrow_pos_hz}: calc(${arrow_width} + ${arrow_gap});`,
                },
            ]);

            // arrow gap tablet
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    device: "tablet",
                    declaration: `margin-${arrow_pos_hz}: calc(${arrow_width_tablet} + ${arrow_gap_tablet});`,
                },
            ]);

            // arrow gap phone
            additionalCss.push([
                {
                    selector: "%%order_class%% .slick-prev",
                    device: "phone",
                    declaration: `margin-${arrow_pos_hz}: calc(${arrow_width_phone} + ${arrow_gap_phone});`,
                },
            ]);
        }

        // position Y tablet
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-arrow",
                device: "tablet",
                declaration: `top: auto;${arrow_pos}: ${arrow_pos_y_tablet};`,
            },
        ]);

        // position Y phone
        additionalCss.push([
            {
                selector: "%%order_class%% .slick-arrow",
                device: "phone",
                declaration: `top: auto; ${arrow_pos}: ${arrow_pos_y_phone};`,
            },
        ]);
    }

    // arrow custom icon
    additionalCss.push([
        {
            selector: "%%order_class%% div .slick-next:before",
            declaration: `content: "${rightIcon}";`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% div .slick-prev:before",
            declaration: `content:" ${leftIcon}";`,
        },
    ]);

    // slide spacing
    if (is_vertical === "off") {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .slick-slide, .et-db #et-boc %%order_class%% .slick-slide",
                declaration: `padding-left: ${slide_spacing}; padding-right: ${slide_spacing};`,
            },
        ]);

        additionalCss.push([
            {
                selector:
                    "%%order_class%% .slick-list, .et-db #et-boc %%order_class%% .slick-list",
                declaration: `margin-left: -${slide_spacing}!important; margin-right: -${slide_spacing}!important;`,
            },
        ]);
    } else {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .slick-slide, .et-db #et-boc %%order_class%% .slick-slide",
                declaration: `padding-top: ${slide_spacing}!important; padding-bottom: ${slide_spacing}!important;`,
            },
        ]);

        additionalCss.push([
            {
                selector:
                    "%%order_class%% .slick-list, .et-db #et-boc %%order_class%% .slick-list",
                declaration: `margin-top: -${slide_spacing}!important; margin-bottom: -${slide_spacing}!important;`,
            },
        ]);
    }

    // Pagination
    additionalCss.push([
        {
            selector: "%%order_class%% .slick-dots",
            declaration: `text-align: ${pagi_alignment}; transform: translateY(${pagi_pos_y});`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-dots li",
            declaration: `margin: 0 ${pagi_spacing};`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-dots li button",
            declaration: `
                background: ${pagi_color};
                height: ${pagi_height};
                width: ${pagi_width};
                border-radius: ${pagi_radius[1]} ${pagi_radius[2]} ${pagi_radius[3]} ${pagi_radius[4]};`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-dots li:hover button",
            declaration: `background: ${pagi_color__hover};`,
        },
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .slick-dots li.slick-active button",
            declaration: `background: ${pagi_color_active}; width: ${pagi_width_active};`,
        },
    ]);

    return additionalCss;
};

export const _getCustomBgCss = (props, opt_name, selector, hover_selector) => {
    let _bg_style = "";
    let _bg_images = [];
    let additionalCss = [];

    let has_bg_color_gradient = false;

    // A. Background Gradient.
    let use_background_color_gradient =
        props[opt_name + "_bg_use_color_gradient"] || "off";
    let _bg_gradient_overlays_image =
        props[opt_name + "_bg_color_gradient_overlays_image"] || "off";

    if ("on" === use_background_color_gradient) {
        let _bg_gradient_type =
            props[opt_name + "_bg_color_gradient_type"] || "linear";
        let _bg_gradient_direction =
            props[opt_name + "_bg_color_gradient_direction"] || "180deg";
        let _bg_gradient_radial_direction =
            props[opt_name + "_bg_color_gradient_direction_radial"] || "center";
        let _bg_gradient_color_start =
            props[opt_name + "_bg_color_gradient_start"] || "#2b87da";
        let _bg_gradient_color_end =
            props[opt_name + "_bg_color_gradient_end"] || "#29c4a9";
        let _bg_gradient_start_position =
            props[opt_name + "_bg_color_gradient_start_position"] || "0%";
        let _bg_gradient_end_position =
            props[opt_name + "_bg_color_gradient_end_position"] || "100%";

        _bg_gradient_direction =
            _bg_gradient_type === "linear"
                ? _bg_gradient_direction
                : `circle at ${_bg_gradient_radial_direction}`;

        let _bg_gradient_css = `${_bg_gradient_type}-gradient( ${_bg_gradient_direction}, ${_bg_gradient_color_start} ${_bg_gradient_start_position}, ${_bg_gradient_color_end} ${_bg_gradient_end_position} )`;

        _bg_images.push(_bg_gradient_css);

        has_bg_color_gradient = true;
    }

    if (_bg_images !== "") {
        // The browsers stack the images in the opposite order to what you'd expect.
        if ("on" !== _bg_gradient_overlays_image) {
            _bg_images = _bg_images.reverse();
        }
        // Set background image styles only it's different compared to the larger device.
        _bg_style += `background-image: ${_bg_images.join(", ")} !important;`;
    }

    if (!has_bg_color_gradient) {
        // The background color
        if (typeof props[opt_name + "_bg_color"] !== "undefined") {
            _bg_style += `background-color: ${
                props[opt_name + "_bg_color"]
            } !important;`;
        }
    }

    additionalCss.push([
        {
            selector: selector,
            declaration: `${_bg_style}`,
        },
    ]);

    // hover
    let _bg_style_hover = "";
    let _bg_images_hover = [];
    let _hover_enabled = props[opt_name + "_bg_color__hover_enabled"];
    let has_bg_color_gradient_hover = false;

    _hover_enabled = _hover_enabled ? _hover_enabled.startsWith("on") : false;

    if (_hover_enabled) {
        // A. Background Gradient.
        let use_background_color_gradient_hover =
            props[opt_name + "_bg_use_color_gradient__hover"] || "off";
        let _bg_gradient_overlays_image_hover =
            props[opt_name + "_bg_color_gradient_overlays_image__hover"] ||
            "off";

        if (
            "on" === use_background_color_gradient_hover ||
            props[opt_name + "_bg_color_gradient_start__hover"]
        ) {
            let _bg_gradient_type_hover =
                props[opt_name + "_bg_color_gradient_type__hover"] || "linear";
            let _bg_gradient_direction_hover =
                props[opt_name + "_bg_color_gradient_direction__hover"] ||
                "180deg";
            let _bg_gradient_radial_direction_hover =
                props[
                    opt_name + "_bg_color_gradient_direction_radial__hover"
                ] || "circle";
            let _bg_gradient_color_start_hover =
                props[opt_name + "_bg_color_gradient_start__hover"] ||
                "#2b87da";
            let _bg_gradient_color_end_hover =
                props[opt_name + "_bg_color_gradient_end__hover"] || "#29c4a9";
            let _bg_gradient_start_position_hover =
                props[opt_name + "_bg_color_gradient_start_position__hover"] ||
                "0%";
            let _bg_gradient_end_position_hover =
                props[opt_name + "_bg_color_gradient_end_position__hover"] ||
                "100%";

            _bg_gradient_direction_hover =
                _bg_gradient_type_hover === "linear"
                    ? _bg_gradient_direction_hover
                    : `circle at ${_bg_gradient_radial_direction_hover}`;

            let _bg_gradient_css_hover = `${_bg_gradient_type_hover}-gradient( ${_bg_gradient_direction_hover}, ${_bg_gradient_color_start_hover} ${_bg_gradient_start_position_hover}, ${_bg_gradient_color_end_hover} ${_bg_gradient_end_position_hover} )`;
            _bg_images_hover.push(_bg_gradient_css_hover);
            has_bg_color_gradient_hover = true;
        }

        if (_bg_images_hover !== "") {
            // The browsers stack the images in the opposite order to what you'd expect.
            if ("on" !== _bg_gradient_overlays_image_hover) {
                _bg_images_hover = _bg_images_hover.reverse();
            }
            // Set background image styles only it's different compared to the larger device.
            _bg_style_hover += `background-image: ${_bg_images_hover.join(
                ", "
            )} !important;`;
        }

        if (!has_bg_color_gradient_hover) {
            // The background color
            if (typeof props[opt_name + "_bg_color__hover"] !== "undefined") {
                _bg_style_hover += `background-color: ${
                    props[opt_name + "_bg_color__hover"]
                } !important;`;
            }
        }

        if (props.hover_enabled === 1) {
            additionalCss.push([
                {
                    selector: selector,
                    declaration: `${_bg_style_hover}`,
                },
            ]);
        }

        additionalCss.push([
            {
                selector: hover_selector,
                declaration: `${_bg_style_hover}`,
            },
        ]);
    }

    return additionalCss;
};

export const _getOverlayStyleCss = (props) => {
    let additionalCss = [],
        overlay_icon_color = props.overlay_icon_color
            ? props.overlay_icon_color
            : "#2EA3F2",
        overlay_icon_color__hover = props.overlay_icon_color__hover,
        overlay_icon_size = props.overlay_icon_size
            ? props.overlay_icon_size
            : "32px",
        overlay_icon_size__hover = props.overlay_icon_size__hover,
        overlay_icon_opacity = props.overlay_icon_opacity
            ? props.overlay_icon_opacity
            : "1",
        overlay_icon_opacity__hover = props.overlay_icon_opacity__hover;

    additionalCss.push([
        {
            selector: "%%order_class%% .wdcl-overlay",
            declaration: `color: ${overlay_icon_color};`,
        },
    ]);

    if (overlay_icon_color__hover) {
        additionalCss.push([
            {
                selector: "%%order_class%%:hover .wdcl-overlay",
                declaration: `color: ${overlay_icon_color__hover};`,
            },
        ]);
    }

    additionalCss.push([
        {
            selector: "%%order_class%% .wdcl-overlay:after",
            declaration: `font-size: ${overlay_icon_size};`,
        },
    ]);

    if (overlay_icon_size__hover) {
        additionalCss.push([
            {
                selector: "%%order_class%%:hover .wdcl-overlay:after",
                declaration: `font-size: ${overlay_icon_size__hover};`,
            },
        ]);
    }

    additionalCss.push([
        {
            selector: "%%order_class%% .wdcl-overlay:after",
            declaration: `opacity: ${overlay_icon_opacity};`,
        },
    ]);

    if (overlay_icon_opacity__hover) {
        additionalCss.push([
            {
                selector: "%%order_class%%:hover .wdcl-overlay:after",
                declaration: `opacity: ${overlay_icon_opacity__hover};`,
            },
        ]);
    }

    if (props.hover_enabled === 1) {
        if (overlay_icon_opacity__hover) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .wdcl-overlay:after",
                    declaration: `opacity: ${overlay_icon_opacity__hover};`,
                },
            ]);
        }
        if (overlay_icon_size__hover) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .wdcl-overlay:after",
                    declaration: `font-size: ${overlay_icon_size__hover};`,
                },
            ]);
        }
        if (overlay_icon_color__hover) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .wdcl-overlay",
                    declaration: `color: ${overlay_icon_color__hover};`,
                },
            ]);
        }
    }

    // Overlay Background
    let overlay_bg_style = _getCustomBgCss(
        props,
        "overlay",
        "%%order_class%% .wdcl-overlay",
        "%%order_class%% .wdcl-carousel-item:hover .wdcl-overlay"
    );

    return additionalCss.concat(overlay_bg_style);
};
