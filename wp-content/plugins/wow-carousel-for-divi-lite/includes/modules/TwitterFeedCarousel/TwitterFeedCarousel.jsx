import $ from 'jquery';
import React, { Component } from "react";
import { _getCarouselCss, _getCarouselSettings, _getCustomBgCss } from '../ModulesCore/WowCarouselCommon';
import "./style.css";

class WDCL_TwitterFeedCarousel extends Component {

	static slug = "wdcl_twitter_feed_carousel";

	static css(props) {

        const additionalCss = [];
        let carouselCss     = _getCarouselCss( props );

		// User info
		let user_info_spacing                   = props.user_info_spacing;
		let user_info_spacing_last_edited       = props.user_info_spacing_last_edited;
		let user_info_spacing_responsive_status = user_info_spacing_last_edited && user_info_spacing_last_edited.startsWith("on");
		let user_info_spacing_tablet            = props.user_info_spacing_tablet;
		let user_info_spacing_phone             = props.user_info_spacing_phone;

		additionalCss.push([{
			selector     : "%%order_class%% .wdcl-twitter-feed-author",
			declaration  : `margin-bottom: ${user_info_spacing};`
		}]);

		if( typeof user_info_spacing_tablet !== 'undefined' && user_info_spacing_responsive_status ) {

			additionalCss.push([{
				selector : "%%order_class%% .wdcl-twitter-feed-inner-wrapper",
				device : "tablet",
				declaration : `margin-bottom: ${user_info_spacing};`
			}]);

		}

		if( typeof user_info_spacing_phone !== 'undefined' && user_info_spacing_responsive_status ) {

			additionalCss.push([{
				selector : "%%order_class%% .wdcl-twitter-feed-inner-wrapper",
				device : "phone",
				declaration : `margin-bottom: ${user_info_spacing_phone};`
			}]);

		}

		// Description spacing
		let description_spacing                   = props.description_spacing;
		let description_spacing_last_edited       = props.description_spacing_last_edited;
		let description_spacing_responsive_status = description_spacing_last_edited && description_spacing_last_edited.startsWith("on");
		let description_spacing_tablet            = props.description_spacing_tablet;
		let description_spacing_phone             = props.description_spacing_phone;

		additionalCss.push([{
			selector     : "%%order_class%% .wdcl-inner-twitter-feed-content p",
			declaration  : `margin-bottom: ${description_spacing};`
		}]);

		if( typeof description_spacing_tablet !== 'undefined' && description_spacing_responsive_status ) {

			additionalCss.push([{
				selector : "%%order_class%% .wdcl-inner-twitter-feed-content p",
				device : "tablet",
				declaration : `margin-bottom: ${description_spacing};`
			}]);

		}

		if( typeof description_spacing_phone !== 'undefined' && description_spacing_responsive_status ) {

			additionalCss.push([{
				selector : "%%order_class%% .wdcl-inner-twitter-feed-content p",
				device : "phone",
				declaration : `margin-bottom: ${description_spacing_phone};`
			}]);

		}

		// Twitter icon
		additionalCss.push([{
			selector: "%%order_class%% .wdcl-twitter-feed-icon span",
			declaration: `width: ${props.twitter_icon_size}; height: ${props.twitter_icon_size};`
		}]);

		// User image size
		additionalCss.push([{
			selector: "%%order_class%% .wdcl-twitter-feed-avatar",
			declaration: `width: ${props.profile_image_size}; height: ${props.profile_image_size};`
		}]);


		// Footer Alinmnet
		additionalCss.push([{
			selector: "%%order_class%% .wdcl-twitter-feed-footer",
			declaration: `text-align: ${props.footer_alignment};`
		}]);

        let favorite_color      = props.favorite_color;
        let favorite_icon_color = props.favorite_icon_color;
        let favorite_font_size  = props.favorite_font_size;
        let favorite_icon_size  = props.favorite_icon_size;

        let retweet_color       = props.retweet_color;
        let retweet_icon_color  = props.retweet_icon_color;
        let retweet_icon_size   = props.retweet_icon_size;
        let retweet_font_size   = props.retweet_font_size;

		additionalCss.push([{
			selector: "%%order_class%% .wdcl-tweet-favorite",
			declaration: `color: ${favorite_color};`
		}]);

		additionalCss.push([{
			selector: "%%order_class%% .wdcl-tweet-favorite span",
			declaration: `color: ${favorite_icon_color};`
		}]);

        additionalCss.push([{
            selector: "%%order_class%% .wdcl-tweet-favorite",
            declaration: `font-size: ${favorite_font_size} !important;`
        }]);

        additionalCss.push([{
            selector: "%%order_class%% .wdcl-tweet-favorite span",
            declaration: `font-size: ${favorite_icon_size} !important;`
        }]);

        // Retweets
		additionalCss.push([{
			selector: "%%order_class%% .wdcl-tweet-retweet",
			declaration: `color: ${retweet_color};`
		}]);

		additionalCss.push([{
			selector: "%%order_class%% .wdcl-tweet-retweet span",
			declaration: `color: ${retweet_icon_color};`
		}]);

        additionalCss.push([{
            selector: "%%order_class%% .wdcl-tweet-retweet",
            declaration: `font-size: ${retweet_icon_size} !important;`
        }]);

        additionalCss.push([{
            selector: "%%order_class%% .wdcl-tweet-retweet span",
            declaration: `font-size: ${retweet_font_size} !important;`
        }]);

		// Tweets Item Padding
		let content_padding                   = props.content_padding;
		let content_padding_tablet            = props.content_padding_tablet;
		let content_padding_phone             = props.content_padding_phone;
		let content_padding_responsive_status = props.content_padding_last_edited && props.content_padding_last_edited.startsWith("on");

		content_padding = content_padding.split("|");

		additionalCss.push([{
			selector: "%%order_class%% .wdcl-twitter-feed-inner-wrapper",
			declaration: `padding:
				${ content_padding[0] }
				${ content_padding[1] }
				${ content_padding[2] }
				${ content_padding[3] };
			`
		}]);

		if( typeof content_padding_tablet !== 'undefined' && content_padding_responsive_status ) {

			content_padding_tablet = content_padding_tablet.split("|");

			additionalCss.push([{
				selector: "%%order_class%% .wdcl-twitter-feed-inner-wrapper",
		  		device: "tablet",
				declaration: `padding:
					${ content_padding[0] }
					${ content_padding[1] }
					${ content_padding[2] }
					${ content_padding[3] };
				`
			}]);
		}

		if( typeof content_padding_phone !== 'undefined' && content_padding_responsive_status ) {

			content_padding_phone = content_padding_phone.split("|");

			additionalCss.push([{
				selector: "%%order_class%% .wdcl-twitter-feed-inner-wrapper",
		  		device: "phone",
				declaration: `padding:
					${ content_padding[0] }
					${ content_padding[1] }
					${ content_padding[2] }
					${ content_padding[3] };
				`
			}]);

		}


		let tweets_item_bg_style = _getCustomBgCss( props, 'tweets_item', "%%order_class%% .wdcl-twitter-feed-item-inner", "%%order_class%% .wdcl-twitter-feed-item-inner:hover" );

		return additionalCss.concat( carouselCss ).concat( tweets_item_bg_style );

	}

	constructor(props) {
        super(props);
        this.carousel = React.createRef();
    }

    componentDidUpdate(prevProps) {

        let settings = _getCarouselSettings( this.props, 'jQuery' );

		//Destory
		if (typeof ( this.carousel.current.slick ) !== "undefined") {
            this.carousel.current.slick.unslick();
        }

		// Init
        $(this.carousel.current).slick(settings);


    }

	rawMarkup(){
        var rawMarkup = this.props.__feed;
        return { __html: rawMarkup };

    }

	render() {

        let is_center        = this.props.is_center,
			center_mode_type = this.props.center_mode_type,
			is_equal_height  = this.props.is_equal_height,
            alignment        = this.props.alignment,
            custom_cursor    = this.props.custom_cursor,
			sliding_dir = this.props.sliding_dir,
            classes          = [];

        if( is_center === 'on' ) {
            classes.push( `wdcl-centered wdcl-centered--${center_mode_type}` );
        }

        if( custom_cursor === 'on' ) {
            classes.push( 'wdcl-cursor' );
        }

        classes.push( `wdcl-twitter-${alignment}` );
        classes.push( `equal-height-${is_equal_height}` );
		classes.push(`dir-${sliding_dir}`);
	    return (
	    	<div className={`wdcl-carousel wdcl-carousel-jq wdcl-twitter-feed-carousel ${classes.join(' ')}`} ref={this.carousel} dangerouslySetInnerHTML={this.rawMarkup()} />
	    );
	}
}

export default WDCL_TwitterFeedCarousel;