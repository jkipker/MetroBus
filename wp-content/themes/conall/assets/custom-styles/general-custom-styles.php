<?php
if(!function_exists('conall_edge_design_styles')) {
    /**
     * Generates general custom styles
     */
    function conall_edge_design_styles() {

        $preload_background_styles = array();

        if(conall_edge_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.conall_edge_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(EDGE_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo conall_edge_dynamic_css('.edgtf-preload-background', $preload_background_styles);

		if (conall_edge_options()->getOptionValue('google_fonts')){
			$font_family = conall_edge_options()->getOptionValue('google_fonts');
			if(conall_edge_is_font_option_valid($font_family)) {
				echo conall_edge_dynamic_css('body', array('font-family' => conall_edge_get_font_option_val($font_family)));
			}
		}

        if(conall_edge_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a',
                'p a',
                '.edgtf-comment-holder .edgtf-comment-text .replay:hover',
                '.edgtf-comment-holder .edgtf-comment-text .comment-reply-link:hover',
                '.edgtf-comment-holder .edgtf-comment-text .comment-edit-link:hover',
                '.edgtf-pagination ul li.edgtf-pagination-first-page a:hover',
                '.edgtf-pagination ul li.edgtf-pagination-prev a:hover',
                '.edgtf-pagination ul li.edgtf-pagination-next a:hover',
                '.edgtf-pagination ul li.edgtf-pagination-last-page a:hover',
                '.edgtf-pagination ul li a:hover',
                '.edgtf-pagination ul li.active span',
                '.edgtf-owl-slider .owl-nav .edgtf-prev-icon:hover',
                '.edgtf-owl-slider .owl-nav .edgtf-next-icon:hover',
                'aside.edgtf-sidebar .widget a:hover',
                'aside.edgtf-sidebar .widget #wp-calendar caption',
                'aside.edgtf-sidebar .widget.widget_rss li .rss-date',
                'aside.edgtf-sidebar .widget.widget_recent_entries .post-date',
                '.edgtf-main-menu > ul > li > a:hover',
                '.edgtf-main-menu > ul > li.edgtf-active-item > a',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-main-menu > ul > li > a:hover',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-main-menu > ul > li.edgtf-active-item > a',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-main-menu > ul > li > a:hover',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-main-menu > ul > li.edgtf-active-item > a',
                '.edgtf-light-header .edgtf-top-bar .widget a:hover',
                '.edgtf-dark-header .edgtf-top-bar .widget a:hover',
                '.edgtf-sticky-header .edgtf-main-menu > ul > li > a:hover',
                '.edgtf-sticky-header .edgtf-main-menu > ul > li.edgtf-active-item > a',
                '.edgtf-mobile-header .edgtf-mobile-nav ul ul li.current-menu-ancestor > a',
                '.edgtf-mobile-header .edgtf-mobile-nav ul ul li.current-menu-item > a',
                '.edgtf-mobile-header .edgtf-mobile-nav a:hover, .edgtf-mobile-header .edgtf-mobile-nav h6:hover',
                '.edgtf-mobile-header .edgtf-mobile-nav .edgtf-grid > ul > li.edgtf-active-item > a',
                '.edgtf-mobile-header .edgtf-mobile-menu-opener a:hover',
                'footer .widget a:hover',
                '.edgtf-side-menu a.edgtf-close-side-menu:hover span',
                '.edgtf-side-menu .widget a:hover',
                'nav.edgtf-fullscreen-menu ul li a:hover',
                'nav.edgtf-fullscreen-menu ul li ul li.current-menu-ancestor > a',
                'nav.edgtf-fullscreen-menu ul li ul li.current-menu-item > a',
                'nav.edgtf-fullscreen-menu > ul > li > a:hover',
                'nav.edgtf-fullscreen-menu > ul > li.edgtf-active-item > a',
                '.edgtf-search-page-holder article.sticky .edgtf-post-title-area h3 a',
                '.edgtf-search-page-holder article .edgtf-post-title-area .edgtf-post-info > div a:hover',
                '.edgtf-search-opener:hover',
                '.edgtf-portfolio-single-holder .edgtf-portfolio-author-name',
                '.edgtf-portfolio-single-nav .edgtf-portfolio-back-btn a:hover',
                '.edgtf-portfolio-single-nav .edgtf-portfolio-next a:hover',
                '.edgtf-portfolio-single-nav .edgtf-portfolio-prev a:hover',
                '.edgtf-blog-holder article.sticky .edgtf-post-title a',
                '.edgtf-blog-holder article .edgtf-post-info > div.edgtf-post-info-author .edgtf-post-info-author-link',
                '.edgtf-blog-holder article .edgtf-post-info > div a:hover',
                '.edgtf-single-tags-holder .edgtf-tags a:hover',
                '.edgtf-author-description .edgtf-author-description-text-holder .edgtf-author-name a',
                '.edgtf-author-description .edgtf-author-description-text-holder .edgtf-author-social-icons a:hover',
                '.edgtf-related-posts-holder .edgtf-related-post .edgtf-post-info a:hover',
                '.edgtf-blog-single-navigation .edgtf-blog-single-prev a:hover',
                '.edgtf-blog-single-navigation .edgtf-blog-single-next a:hover',
                '.edgtf-single-links-pages .edgtf-single-links-pages-inner > a:hover',
                '.edgtf-single-links-pages .edgtf-single-links-pages-inner > span:hover',
                '.edgtf-call-to-action.with-icons .edgtf-call-to-action-icons-holder.edgtf-cta-icon-light .edgtf-call-to-action-icons .edgtf-call-to-action-icons-inner .edgtf-icon-shortcode:hover .edgtf-icon-element',
                '.edgtf-counter-holder .edgtf-counter',
                '.edgtf-amp',
                '.edgtf-icon-list-item .edgtf-icon-list-icon-holder-inner i',
                '.edgtf-icon-list-item .edgtf-icon-list-icon-holder-inner .font_elegant',
                '.edgtf-iwt .edgtf-icon-shortcode:not(.circle):not(.square):hover',
                '.edgtf-message .edgtf-message-inner a.edgtf-close:hover',
                '.edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner ul li:hover span',
                '.edgtf-social-share-holder.edgtf-list li a:hover',
                '.edgtf-tabs .edgtf-tabs-nav li.ui-state-active a',
                '.edgtf-tabs .edgtf-tabs-nav li.ui-state-hover a',
                '.edgtf-testimonials-holder .edgtf-testimonials.edgtf-testimonials-slider .edgtf-testimonial-author-text',
                '.edgtf-testimonials-holder .edgtf-testimonials.edgtf-testimonials-carousel .edgtf-testimonial-bottom .edgtf-testimonial-author .edgtf-testimonial-author-text .edgtf-testimonials-job',
                '.edgtf-testimonials-holder .edgtf-testimonials.edgtf-testimonials-classic .edgtf-testimonial-author',
                '.edgtf-unordered-list.edgtf-check-mark ul > li:before',
                '.edgtf-twitter-widget li .edgtf-twitter-icon i',
                '.edgtf-twitter-widget li .edgtf-tweet-text a:hover',
                '.edgtf-footer-top-holder .edgtf-twitter-widget li .edgtf-tweet-text a:hover',
                '.edgtf-sidebar .widget_icl_lang_sel_widget a:hover',
                '.wpb_widgetised_column .widget_icl_lang_sel_widget a:hover',
                '.edgtf-top-bar #lang_sel .lang_sel_sel:hover',
                '.edgtf-page-header .edgtf-menu-area #lang_sel .lang_sel_sel:hover',
                '.edgtf-top-bar #lang_sel ul ul a:hover',
                '.edgtf-page-header .edgtf-menu-area #lang_sel ul ul a:hover',
                '.edgtf-sticky-header #lang_sel ul ul a:hover',
                '.edgtf-top-bar #lang_sel_list ul li a:hover',
                '.edgtf-page-header .edgtf-menu-area #lang_sel_list ul li a:hover',
                '.edgtf-sticky-header #lang_sel .lang_sel_sel:hover',
                '.edgtf-sticky-header #lang_sel_list ul li a:hover',
                '.edgtf-main-menu .menu-item-language .submenu-languages a:hover',
                '.edgtf-blog-list-holder .edgtf-bli-info > div.edgtf-post-info-author .edgtf-post-info-author-link',
                '.edgtf-blog-list-holder .edgtf-bli-info > div a:hover',
                '.edgtf-blog-list-holder.edgtf-simple .edgtf-simple-text .edgtf-post-info-date a:hover',
                '.carousel .carousel-control .edgtf-prev-nav:hover',
                '.carousel .carousel-control .edgtf-next-nav:hover',
                '.edgtf-dark-header .carousel .carousel-control .edgtf-prev-nav:hover',
                '.edgtf-dark-header .carousel .carousel-control .edgtf-next-nav:hover',
                '.edgtf-light-header .carousel .carousel-control .edgtf-prev-nav:hover',
                '.edgtf-light-header .carousel .carousel-control .edgtf-next-nav:hover',
                '.edgtf-testimonials-holder .edgtf-tes-nav > *.edgtf-tes-nav-prev:hover',
                '.edgtf-testimonials-holder .edgtf-tes-nav > *.edgtf-tes-nav-next:hover',
                '.edgtf-title .edgtf-title-holder .edgtf-breadcrumbs a:hover',
                '.edgtf-fullscreen-search-holder .edgtf-search-submit:hover'
            );

            $woo_color_selector = array();
            if(conall_edge_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.woocommerce-pagination .page-numbers li a:hover', 
                    '.woocommerce-pagination .page-numbers li a.current',
                    '.woocommerce-pagination .page-numbers li span:hover',
                    '.woocommerce-pagination .page-numbers li span.current',
                    '.woocommerce-pagination .page-numbers li.prev-arrow a:hover', 
                    '.woocommerce-pagination .page-numbers li.next-arrow a:hover',
                    '.edgtf-single-product-summary .product_meta > span a:hover',
                    '.edgtf-single-product-summary .edgtf-woo-social-share-holder .edgtf-social-share-holder ul li a:hover',
                    '.edgtf-woocommerce-page.edgtf-woocommerce-single-page .woocommerce-tabs ul.tabs > li:hover a',
                    '.edgtf-woocommerce-page.edgtf-woocommerce-single-page .woocommerce-tabs ul.tabs > li.active a',
                    '.edgtf-woocommerce-page .edgtf-content .edgtf-quantity-buttons .edgtf-quantity-input:focus',
                    '.edgtf-woocommerce-page .edgtf-content .edgtf-quantity-buttons .edgtf-quantity-minus:hover',
                    '.edgtf-woocommerce-page .edgtf-content .edgtf-quantity-buttons .edgtf-quantity-plus:hover',
                    '.edgtf-woocommerce-page .woocommerce-info .showcoupon:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_products ul li a:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_recent_reviews ul li a:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_top_rated_products ul li a:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_recently_viewed_products ul li a:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_product_categories ul li a:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content ul li .remove:hover',
                    '.edgtf-shopping-cart-holder .edgtf-header-cart:hover',
                    '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-shopping-cart-holder .edgtf-header-cart:hover',
                    '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-shopping-cart-holder .edgtf-header-cart:hover',
                    '.edgtf-shopping-cart-dropdown .edgtf-item-info-holder a:not(.remove):hover',
                    '.edgtf-shopping-cart-dropdown .edgtf-item-info-holder .remove:hover',
                    '.edgtf-woocommerce-page table.cart tr.cart_item td.product-name a:hover',
                    '.edgtf-woocommerce-page table.cart tr.cart_item td.product-remove a:hover',
                    '.edgtf-woocommerce-page .cart-collaterals .woocommerce-shipping-calculator .shipping-calculator-button:hover',
                    '.select2-container .select2-choice:hover',
                    '.select2-container .select2-choice:hover .select2-arrow'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector); 

            $color_important_selector = array(
                '.edgtf-light-header .edgtf-page-header > div:not(.fixed):not(.edgtf-sticky-header) .edgtf-menu-area .widget a:hover',
                '.edgtf-light-header .edgtf-page-header > div:not(.fixed):not(.edgtf-sticky-header).edgtf-menu-area .widget a:hover',
                '.edgtf-dark-header .edgtf-page-header > div:not(.fixed):not(.edgtf-sticky-header) .edgtf-menu-area .widget a:hover',
                '.edgtf-dark-header .edgtf-page-header > div:not(.fixed):not(.edgtf-sticky-header).edgtf-menu-area .widget a:hover',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener.opened .edgtf-side-menu-title',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener:hover .edgtf-side-menu-title',
                '.edgtf-light-header .edgtf-top-bar .edgtf-side-menu-button-opener.opened .edgtf-side-menu-title',
                '.edgtf-light-header .edgtf-top-bar .edgtf-side-menu-button-opener:hover .edgtf-side-menu-title',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener.opened .edgtf-side-menu-title',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener:hover .edgtf-side-menu-title',
                '.edgtf-dark-header .edgtf-top-bar .edgtf-side-menu-button-opener.opened .edgtf-side-menu-title',
                '.edgtf-dark-header .edgtf-top-bar .edgtf-side-menu-button-opener:hover .edgtf-side-menu-title',
                '.edgtf-side-menu-button-opener.opened .edgtf-side-menu-title',
                '.edgtf-side-menu-button-opener:hover .edgtf-side-menu-title',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-search-opener:hover',
                '.edgtf-light-header .edgtf-top-bar .edgtf-search-opener:hover',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-search-opener:hover',
                '.edgtf-dark-header .edgtf-top-bar .edgtf-search-opener:hover',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-social-icon-widget-holder:hover',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-social-icon-widget-holder:hover'
            );

            $background_color_selector = array(
                '.edgtf-st-loader .pulse',
                '.edgtf-st-loader .double_pulse .double-bounce1, .edgtf-st-loader .double_pulse .double-bounce2',
                '.edgtf-st-loader .cube',
                '.edgtf-st-loader .rotating_cubes .cube1, .edgtf-st-loader .rotating_cubes .cube2',
                '.edgtf-st-loader .stripes > div',
                '.edgtf-st-loader .wave > div',
                '.edgtf-st-loader .two_rotating_circles .dot1, .edgtf-st-loader .two_rotating_circles .dot2',
                '.edgtf-st-loader .five_rotating_circles .container1 > div',
                '.edgtf-st-loader .five_rotating_circles .container2 > div',
                '.edgtf-st-loader .five_rotating_circles .container3 > div',
                '.edgtf-st-loader .atom .ball-1:before',
                '.edgtf-st-loader .atom .ball-2:before',
                '.edgtf-st-loader .atom .ball-3:before',
                '.edgtf-st-loader .atom .ball-4:before',
                '.edgtf-st-loader .clock .ball:before',
                '.edgtf-st-loader .mitosis .ball',
                '.edgtf-st-loader .lines .line1',
                '.edgtf-st-loader .lines .line2',
                '.edgtf-st-loader .lines .line3',
                '.edgtf-st-loader .lines .line4',
                '.edgtf-st-loader .fussion .ball',
                '.edgtf-st-loader .fussion .ball-1',
                '.edgtf-st-loader .fussion .ball-2',
                '.edgtf-st-loader .fussion .ball-3',
                '.edgtf-st-loader .fussion .ball-4',
                '.edgtf-st-loader .wave_circles .ball',
                '.edgtf-st-loader .pulse_circles .ball',
                '#submit_comment:hover',
                '.post-password-form input[type="submit"]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.edgtf-two-columns-form-without-space input.wpcf7-form-control.wpcf7-submit',
                '#edgtf-back-to-top > span',
                'aside.edgtf-sidebar .widget #wp-calendar td#today',
                'aside.edgtf-sidebar .widget.widget_tag_cloud a:hover',
                'footer .widget #wp-calendar td#today',
                'footer .widget.widget_tag_cloud a:hover',
                '.edgtf-side-menu .widget #wp-calendar td#today',
                '.edgtf-side-menu .widget.widget_tag_cloud a:hover',
                '.edgtf-search-page-holder .edgtf-search-page-form .edgtf-form-holder .edgtf-search-submit',
                '.edgtf-blog-holder article .edgtf-post-image .edgtf-post-format-icon',
                '.edgtf-blog-holder article .edgtf-post-video-holder .edgtf-post-format-icon',
                '.edgtf-blog-load-more-button-holder .edgtf-btn.edgtf-btn-solid:hover',
                '.edgtf-load-more-ajax-pagination .edgtf-btn.edgtf-btn-solid:hover',
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                '.edgtf-call-to-action.with-icons .edgtf-call-to-action-icons-holder .edgtf-call-to-action-icons .edgtf-call-to-action-icons-inner .edgtf-icon-shortcode:hover',
                '.edgtf-dropcaps.edgtf-square, .edgtf-dropcaps.edgtf-circle',
                '.edgtf-icon-shortcode.circle, .edgtf-icon-shortcode.square',
                '.edgtf-team-holder .edgtf-team-social-holder a'.
                '.edgtf-video-holder:hover .edgtf-video-content-holder .edgtf-video-content-inner .edgtf-video-play .edgtf-video-wrapper',
                '.edgtf-search-page-holder .edgtf-search-page-form .edgtf-form-holder .edgtf-search-submit:hover'
            );

            $woo_background_color_selector = array();
            if(conall_edge_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce .edgtf-onsale',
                    '.edgtf-woocommerce-page .edgtf-content a.add_to_cart_button:hover',
                    '.edgtf-woocommerce-page .edgtf-content a.added_to_cart:hover',
                    '.edgtf-woocommerce-page .edgtf-content a.single_add_to_cart_button:hover',
                    '.edgtf-woocommerce-page .edgtf-content a.checkout-button:hover',
                    '.edgtf-woocommerce-page .edgtf-content input[type="submit"]:hover',
                    '.edgtf-woocommerce-page .edgtf-content button[type="submit"]:hover',
                    '.edgtf-woocommerce-page .edgtf-content .return-to-shop .button:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_product_tag_cloud .tagcloud a:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_price_filter .ui-slider-horizontal .ui-slider-range',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_product_search input[type="submit"]:hover',
                    '.edgtf-shopping-cart-holder .edgtf-header-cart .edgtf-cart-number',
                    '.edgtf-shopping-cart-dropdown .edgtf-cart-bottom .edgtf-ddcw-button:hover',
                    '.edgtf-product-list-holder .edgtf-pli-image .edgtf-pli-onsale',
                    '.edgtf-product-list-holder .edgtf-pli-image .edgtf-button:hover',
                    '.edgtf-content .edgtf-product-featured-button-holder .button:hover',
                    '.select2-drop .select2-results .select2-highlighted'
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector); 

            $background_color_important_selector = array(
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener.opened .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-light-header .edgtf-top-bar .edgtf-side-menu-button-opener.opened .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-light-header .edgtf-top-bar .edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener.opened .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-dark-header .edgtf-top-bar .edgtf-side-menu-button-opener.opened .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-dark-header .edgtf-top-bar .edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-side-menu-button-opener.opened .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line',
                '.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-fullscreen-menu-opener:not(.edgtf-fm-opened) .edgt-fullscreen-menu-lines:hover .edgtf-fullscreen-menu-line',
                '.edgtf-dark-header .edgtf-top-bar .edgtf-fullscreen-menu-opener:not(.edgtf-fm-opened) .edgt-fullscreen-menu-lines:hover .edgtf-fullscreen-menu-line',
                '.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-fullscreen-menu-opener:not(.edgtf-fm-opened) .edgt-fullscreen-menu-lines:hover .edgtf-fullscreen-menu-line',
                '.edgtf-light-header .edgtf-top-bar .edgtf-fullscreen-menu-opener:not(.edgtf-fm-opened) .edgt-fullscreen-menu-lines:hover .edgtf-fullscreen-menu-line',
                '.edgtf-fullscreen-menu-opener .edgt-fullscreen-menu-lines:hover .edgtf-fullscreen-menu-line'
            );

            $border_color_selector = array(
                '.edgtf-st-loader .pulse_circles .ball',
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus',
                '#respond textarea:focus',
                '#respond input[type="text"]:focus',
                '.post-password-form input[type="password"]:focus',
                '.edgtf-two-columns-form-without-space .wpcf7-form-control.wpcf7-text:focus',
                '#edgtf-back-to-top > span',
                'aside.edgtf-sidebar .widget.widget_search form > div:hover input',
                'aside.edgtf-sidebar .widget.widget_tag_cloud a:hover',
                'footer .widget.widget_search form > div:hover input',
                'footer .widget.widget_tag_cloud a:hover',
                '.edgtf-side-menu .widget.widget_search form > div:hover input',
                '.edgtf-side-menu .widget.widget_tag_cloud a:hover',
                '.edgtf-search-page-holder .edgtf-search-page-form .edgtf-form-holder .edgtf-search-field:focus',
                '.edgtf-call-to-action.with-icons .edgtf-call-to-action-icons-holder .edgtf-call-to-action-icons .edgtf-call-to-action-icons-inner',
                '.edgtf-call-to-action.with-icons .edgtf-call-to-action-icons-holder .edgtf-call-to-action-icons .edgtf-call-to-action-icons-inner .edgtf-icon-shortcode:not(:last-child)',
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-border-hover):hover'
            );

            $woo_border_color_selector = array();
            if(conall_edge_is_woocommerce_installed()) {
                $woo_border_color_selector = array(
                    '.edgtf-woocommerce-page .edgtf-content input[type="text"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content input[type="email"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content input[type="tel"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content input[type="password"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content textarea:focus',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_product_tag_cloud .tagcloud a:hover',
                    'aside.edgtf-sidebar .widget.woocommerce.widget_product_search .search-field:focus',
                    '.edgtf-shopping-cart-dropdown .edgtf-cart-bottom .edgtf-ddcw-button:hover'
                );
            }

            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector); 

            echo conall_edge_dynamic_css($color_selector, array('color' => conall_edge_options()->getOptionValue('first_color')));
            echo conall_edge_dynamic_css($color_important_selector, array('color' => conall_edge_options()->getOptionValue('first_color').'!important'));
            echo conall_edge_dynamic_css('::selection', array('background' => conall_edge_options()->getOptionValue('first_color')));
            echo conall_edge_dynamic_css('::-moz-selection', array('background' => conall_edge_options()->getOptionValue('first_color')));
            echo conall_edge_dynamic_css($background_color_selector, array('background-color' => conall_edge_options()->getOptionValue('first_color')));
            echo conall_edge_dynamic_css($background_color_important_selector, array('background-color' => conall_edge_options()->getOptionValue('first_color').'!important'));
            echo conall_edge_dynamic_css($border_color_selector, array('border-color' => conall_edge_options()->getOptionValue('first_color')));
        }

		if (conall_edge_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.edgtf-wrapper-inner',
				'.edgtf-content'
			);
			echo conall_edge_dynamic_css($background_color_selector, array('background-color' => conall_edge_options()->getOptionValue('page_background_color')));
		}

		if (conall_edge_options()->getOptionValue('selection_color')) {
			echo conall_edge_dynamic_css('::selection', array('background' => conall_edge_options()->getOptionValue('selection_color')));
			echo conall_edge_dynamic_css('::-moz-selection', array('background' => conall_edge_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (conall_edge_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = conall_edge_options()->getOptionValue('page_background_color_in_box');
		}

		if (conall_edge_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(conall_edge_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (conall_edge_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(conall_edge_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (conall_edge_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (conall_edge_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo conall_edge_dynamic_css('.edgtf-boxed .edgtf-wrapper', $boxed_background_style);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_design_styles');
}

if(!function_exists('conall_edge_content_styles')) {
    /**
     * Generates content custom styles
     */
    function conall_edge_content_styles() {

        $content_style = array();
        if (conall_edge_options()->getOptionValue('content_top_padding') !== '') {
            $padding_top = (conall_edge_options()->getOptionValue('content_top_padding'));
            $content_style['padding-top'] = conall_edge_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.edgtf-content .edgtf-content-inner > .edgtf-full-width > .edgtf-full-width-inner',
        );

        echo conall_edge_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
        if (conall_edge_options()->getOptionValue('content_top_padding_in_grid') !== '') {
            $padding_top_in_grid = (conall_edge_options()->getOptionValue('content_top_padding_in_grid'));
            $content_style_in_grid['padding-top'] = conall_edge_filter_px($padding_top_in_grid).'px';

        }

        $content_selector_in_grid = array(
            '.edgtf-content .edgtf-content-inner > .edgtf-container > .edgtf-container-inner',
        );

        echo conall_edge_dynamic_css($content_selector_in_grid, $content_style_in_grid);

    }

    add_action('conall_edge_style_dynamic', 'conall_edge_content_styles');
}

if (!function_exists('conall_edge_h1_styles')) {

    function conall_edge_h1_styles() {

        $h1_styles = array();

        if(conall_edge_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = conall_edge_options()->getOptionValue('h1_color');
        }
        if(conall_edge_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('h1_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(conall_edge_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(conall_edge_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = conall_edge_options()->getOptionValue('h1_texttransform');
        }
        if(conall_edge_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = conall_edge_options()->getOptionValue('h1_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = conall_edge_options()->getOptionValue('h1_fontweight');
        }
        if(conall_edge_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h1_letterspacing')).'px';
        }
        if(conall_edge_options()->getOptionValue('h1_margin_top') !== '') {
            $h1_styles['margin-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h1_margin_top')).'px';
        }
        if(conall_edge_options()->getOptionValue('h1_margin_bottom') !== '') {
            $h1_styles['margin-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h1_margin_bottom')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo conall_edge_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_h1_styles');
}

if (!function_exists('conall_edge_h2_styles')) {

    function conall_edge_h2_styles() {

        $h2_styles = array();

        if(conall_edge_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = conall_edge_options()->getOptionValue('h2_color');
        }
        if(conall_edge_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('h2_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(conall_edge_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(conall_edge_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = conall_edge_options()->getOptionValue('h2_texttransform');
        }
        if(conall_edge_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = conall_edge_options()->getOptionValue('h2_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = conall_edge_options()->getOptionValue('h2_fontweight');
        }
        if(conall_edge_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h2_letterspacing')).'px';
        }
        if(conall_edge_options()->getOptionValue('h2_margin_top') !== '') {
            $h2_styles['margin-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h2_margin_top')).'px';
        }
        if(conall_edge_options()->getOptionValue('h2_margin_bottom') !== '') {
            $h2_styles['margin-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h2_margin_bottom')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo conall_edge_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_h2_styles');
}

if (!function_exists('conall_edge_h3_styles')) {

    function conall_edge_h3_styles() {

        $h3_styles = array();

        if(conall_edge_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = conall_edge_options()->getOptionValue('h3_color');
        }
        if(conall_edge_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('h3_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(conall_edge_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(conall_edge_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = conall_edge_options()->getOptionValue('h3_texttransform');
        }
        if(conall_edge_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = conall_edge_options()->getOptionValue('h3_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = conall_edge_options()->getOptionValue('h3_fontweight');
        }
        if(conall_edge_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h3_letterspacing')).'px';
        }
        if(conall_edge_options()->getOptionValue('h3_margin_top') !== '') {
            $h3_styles['margin-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h3_margin_top')).'px';
        }
        if(conall_edge_options()->getOptionValue('h3_margin_bottom') !== '') {
            $h3_styles['margin-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h3_margin_bottom')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo conall_edge_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_h3_styles');
}

if (!function_exists('conall_edge_h4_styles')) {

    function conall_edge_h4_styles() {

        $h4_styles = array();

        if(conall_edge_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = conall_edge_options()->getOptionValue('h4_color');
        }
        if(conall_edge_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('h4_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(conall_edge_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(conall_edge_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = conall_edge_options()->getOptionValue('h4_texttransform');
        }
        if(conall_edge_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = conall_edge_options()->getOptionValue('h4_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = conall_edge_options()->getOptionValue('h4_fontweight');
        }
        if(conall_edge_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h4_letterspacing')).'px';
        }
        if(conall_edge_options()->getOptionValue('h4_margin_top') !== '') {
            $h4_styles['margin-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h4_margin_top')).'px';
        }
        if(conall_edge_options()->getOptionValue('h4_margin_bottom') !== '') {
            $h4_styles['margin-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h4_margin_bottom')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo conall_edge_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_h4_styles');
}

if (!function_exists('conall_edge_h5_styles')) {

    function conall_edge_h5_styles() {

        $h5_styles = array();

        if(conall_edge_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = conall_edge_options()->getOptionValue('h5_color');
        }
        if(conall_edge_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('h5_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(conall_edge_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(conall_edge_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = conall_edge_options()->getOptionValue('h5_texttransform');
        }
        if(conall_edge_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = conall_edge_options()->getOptionValue('h5_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = conall_edge_options()->getOptionValue('h5_fontweight');
        }
        if(conall_edge_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h5_letterspacing')).'px';
        }
        if(conall_edge_options()->getOptionValue('h5_margin_top') !== '') {
            $h5_styles['margin-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h5_margin_top')).'px';
        }
        if(conall_edge_options()->getOptionValue('h5_margin_bottom') !== '') {
            $h5_styles['margin-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h5_margin_bottom')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo conall_edge_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_h5_styles');
}

if (!function_exists('conall_edge_h6_styles')) {

    function conall_edge_h6_styles() {

        $h6_styles = array();

        if(conall_edge_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = conall_edge_options()->getOptionValue('h6_color');
        }
        if(conall_edge_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('h6_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(conall_edge_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(conall_edge_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = conall_edge_options()->getOptionValue('h6_texttransform');
        }
        if(conall_edge_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = conall_edge_options()->getOptionValue('h6_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = conall_edge_options()->getOptionValue('h6_fontweight');
        }
        if(conall_edge_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h6_letterspacing')).'px';
        }
        if(conall_edge_options()->getOptionValue('h6_margin_top') !== '') {
            $h6_styles['margin-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h6_margin_top')).'px';
        }
        if(conall_edge_options()->getOptionValue('h6_margin_bottom') !== '') {
            $h6_styles['margin-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('h6_margin_bottom')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo conall_edge_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_h6_styles');
}

if (!function_exists('conall_edge_text_styles')) {

    function conall_edge_text_styles() {

        $text_styles = array();

        if(conall_edge_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = conall_edge_options()->getOptionValue('text_color');
        }
        if(conall_edge_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('text_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('text_fontsize')).'px';
        }
        if(conall_edge_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('text_lineheight')).'px';
        }
        if(conall_edge_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = conall_edge_options()->getOptionValue('text_texttransform');
        }
        if(conall_edge_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = conall_edge_options()->getOptionValue('text_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = conall_edge_options()->getOptionValue('text_fontweight');
        }
        if(conall_edge_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo conall_edge_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_text_styles');
}

if (!function_exists('conall_edge_link_styles')) {

    function conall_edge_link_styles() {

        $link_styles = array();

        if(conall_edge_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = conall_edge_options()->getOptionValue('link_color');
        }
        if(conall_edge_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = conall_edge_options()->getOptionValue('link_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = conall_edge_options()->getOptionValue('link_fontweight');
        }
        if(conall_edge_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = conall_edge_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo conall_edge_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_link_styles');
}

if (!function_exists('conall_edge_link_hover_styles')) {

    function conall_edge_link_hover_styles() {

        $link_hover_styles = array();

        if(conall_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = conall_edge_options()->getOptionValue('link_hovercolor');
        }
        if(conall_edge_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = conall_edge_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo conall_edge_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(conall_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = conall_edge_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo conall_edge_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_link_hover_styles');
}

if (!function_exists('conall_edge_smooth_page_transition_styles')) {

    function conall_edge_smooth_page_transition_styles() {
        
        $loader_style = array();

        if(conall_edge_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = conall_edge_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.edgtf-smooth-transition-loader');

        if (!empty($loader_style)) {
            echo conall_edge_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(conall_edge_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = conall_edge_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.edgtf-st-loader .pulse',
            '.edgtf-st-loader .double_pulse .double-bounce1',
            '.edgtf-st-loader .double_pulse .double-bounce2',
            '.edgtf-st-loader .cube',
            '.edgtf-st-loader .rotating_cubes .cube1',
            '.edgtf-st-loader .rotating_cubes .cube2',
            '.edgtf-st-loader .stripes > div',
            '.edgtf-st-loader .wave > div',
            '.edgtf-st-loader .two_rotating_circles .dot1',
            '.edgtf-st-loader .two_rotating_circles .dot2',
            '.edgtf-st-loader .five_rotating_circles .container1 > div',
            '.edgtf-st-loader .five_rotating_circles .container2 > div',
            '.edgtf-st-loader .five_rotating_circles .container3 > div',
            '.edgtf-st-loader .atom .ball-1:before',
            '.edgtf-st-loader .atom .ball-2:before',
            '.edgtf-st-loader .atom .ball-3:before',
            '.edgtf-st-loader .atom .ball-4:before',
            '.edgtf-st-loader .clock .ball:before',
            '.edgtf-st-loader .mitosis .ball',
            '.edgtf-st-loader .lines .line1',
            '.edgtf-st-loader .lines .line2',
            '.edgtf-st-loader .lines .line3',
            '.edgtf-st-loader .lines .line4',
            '.edgtf-st-loader .fussion .ball',
            '.edgtf-st-loader .fussion .ball-1',
            '.edgtf-st-loader .fussion .ball-2',
            '.edgtf-st-loader .fussion .ball-3',
            '.edgtf-st-loader .fussion .ball-4',
            '.edgtf-st-loader .wave_circles .ball',
            '.edgtf-st-loader .pulse_circles .ball'
        );

        if (!empty($spinner_style)) {
            echo conall_edge_dynamic_css($spinner_selectors, $spinner_style);
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_smooth_page_transition_styles');
}