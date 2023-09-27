// This script is loaded both on the frontend page and in the Visual Builder.

jQuery(function($) {
    var wdcl_carousel = $( '.wdcl-carousel' );

    if ( wdcl_carousel ) {
        wdcl_carousel.each( function() {

            let is_pagi           = $( this ).data( 'pagi' ),
                is_pagi_tablet    = $( this ).data( 'pagi-tablet' ),
                is_pagi_phone     = $( this ).data( 'pagi-phone' ),
                variable_width    = $( this ).data( 'variable-width' ),
                is_nav            = $( this ).data( 'nav' ),
                is_nav_tablet     = $( this ).data( 'nav-tablet' ),
                is_nav_phone      = $( this ).data( 'nav-phone' ),
                is_autoplay       = $( this ).data( 'autoplay' ),
                is_autoplay_speed = $( this ).data( 'autoplay-speed' ),
                speed             = $( this ).data( 'speed' ),
                slides            = $( this ).data( 'slides' ),
                slides_tablet     = $( this ).data( 'slides-tablet' ),
                slides_phone      = $( this ).data( 'slides-phone' ),
                is_center         = $( this ).data( 'center' ),
                slide_infinite    = $( this ).data( 'infinite' ),
                is_vertical       = $( this ).data( 'vertical' ),
                icon_left         = $( this ).data( 'icon-left' ),
                icon_right        = $( this ).data( 'icon-right' ),
                center_mode_type  = $( this ).data( 'center-mode-type' ),
                center_padding    = $( this ).data( 'center-padding' ),
                is_variable_width = $( this ).data( 'variable-width' ),
                is_auto_height    = $( this ).data( 'auto-height' ),
                fade              = $( this ).data( 'fade' ),
                dir              = $( this ).data( 'dir' ),
                scroll_items      = $( this ).data( 'items-scroll' );

            scroll_items = scroll_items.split("|");
            center_padding = center_padding.split("|");

            if( scroll_items[1] === '' ) {
                scroll_items[1] = scroll_items[0];
            }

            if( scroll_items[2] === '' ) {
                scroll_items[2] = scroll_items[1];
            }

            if( center_padding[1] === '' ) {
                center_padding[1] = center_padding[0];
            }

            if( center_padding[2] === '' ) {
                center_padding[2] = center_padding[1];
            }

            if( is_variable_width === 'on' ) {
                slides        = 1;
                slides_tablet = 1;
                slides_phone  = 1;
            }

            $( this ).slick( {
                swipeToSlide   : 1,
                focusOnSelect  : !1,
                focusOnChange  : !1,
                edgeFriction   : .35,
                useTransform   : true,
                cssEase        : 'ease-in-out',
                adaptiveHeight : is_auto_height === 'on' ? true : false,
                touchThreshold : 600,
                swipe          : is_center === "on" ? false : true,
                draggable      : 0,
                waitForAnimate : true,
                variableWidth  : variable_width === "on" ? true : false,
                dots           : is_pagi ? true : false,
                arrows         : is_nav ? true : false,
                infinite       : slide_infinite === "on" ? true : false,
                autoplay       : is_autoplay    === "on" ? true : false,
                autoplaySpeed  : parseInt( is_autoplay_speed ),
                touchMove       : !0,
                speed          : parseInt( speed ),
                slidesToShow   : parseInt( slides ),
				fade           : 'off' === fade ? false : true,
				rtl           : 'ltr' === dir ? false : true,
                slidesToScroll : parseInt( scroll_items[0] ),
                centerMode     : is_center === "on" ? true : false,
                centerPadding  : is_variable_width === 'off' && center_mode_type === 'classic' ? center_padding[0] : 0,
                vertical       : is_vertical === "on" ? true : false,
                prevArrow      : `<button type="button" data-icon="${icon_left}" class="slick-arrow slick-prev">Prev</button>`,
                nextArrow      : `<button type="button" data-icon="${icon_right}" class="slick-arrow slick-next">Prev</button>`,
                responsive     : [
                    {
                        breakpoint: 980,
                        settings: {
                            slidesToShow   : parseInt( slides_tablet ),
                            dots           : is_pagi_tablet ? true : false,
                            arrows         : is_nav_tablet ? true : false,
                            centerPadding  : is_variable_width === 'off' && center_mode_type === 'classic' ? center_padding[1] : 0,
                            slidesToScroll : parseInt( scroll_items[1] ),
                        }
                    },
                    {
                        breakpoint: 767,
                        settings  : {
                            slidesToShow   : parseInt( slides_phone ),
                            dots           : is_pagi_phone ? true : false,
                            arrows         : is_nav_phone ? true : false,
                            centerPadding  : is_variable_width === 'off' && center_mode_type === 'classic' ? center_padding[2] : 0,
                            slidesToScroll : parseInt( scroll_items[2] ),
                        }
                    }
                ]
            } );
        } );
    }

	// Lightbox
    let wdcl_ilb_on  = $('.wdcl-lightbox-on .wdcl-lightbox-ctrl img'),
        wdcl_ilb_off = $('.wdcl-lightbox-off .wdcl-lightbox-ctrl img');

    wdcl_ilb_on.magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
        gallery: { enabled:false },
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
        }

    } );

    wdcl_ilb_off.each( function() {
        $(this).removeAttr('data-mfp-src');
    } );

	// Lino options fixing
	if( typeof et_link_options_data !== 'undefined' ) {
		et_link_options_data.forEach( function(el,i) {
			$(document).on( 'click', `.${et_link_options_data[i].class}`, function(){
				window.open(et_link_options_data[i].url, et_link_options_data[i].target);

			})
		})
	}
});
