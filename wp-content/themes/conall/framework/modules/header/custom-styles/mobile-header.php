<?php

if(!function_exists('conall_edge_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function conall_edge_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(conall_edge_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(conall_edge_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = conall_edge_options()->getOptionValue('mobile_header_background_color');
        }

        if(conall_edge_options()->getOptionValue('mobile_header_border_bottom_color')) {
            $mobile_header_styles['border-color'] = conall_edge_options()->getOptionValue('mobile_header_border_bottom_color');
        }

        echo conall_edge_dynamic_css('.edgtf-mobile-header .edgtf-mobile-header-inner', $mobile_header_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_mobile_header_general_styles');
}

if(!function_exists('conall_edge_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function conall_edge_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(conall_edge_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = conall_edge_options()->getOptionValue('mobile_menu_background_color');
        }

        if(conall_edge_options()->getOptionValue('mobile_menu_border_bottom_color')) {
            $mobile_nav_styles['border-color'] = conall_edge_options()->getOptionValue('mobile_menu_border_bottom_color');
        }

        echo conall_edge_dynamic_css('.edgtf-mobile-header .edgtf-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(conall_edge_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = conall_edge_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(conall_edge_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = conall_edge_options()->getOptionValue('mobile_text_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('mobile_font_family'));
        }

        if(conall_edge_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(conall_edge_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(conall_edge_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = conall_edge_options()->getOptionValue('mobile_text_transform');
        }

        if(conall_edge_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = conall_edge_options()->getOptionValue('mobile_font_style');
        }

        if(conall_edge_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = conall_edge_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.edgtf-mobile-header .edgtf-mobile-nav .edgtf-grid > ul > li > a',
            '.edgtf-mobile-header .edgtf-mobile-nav .edgtf-grid > ul > li > h6'
        );

        echo conall_edge_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(conall_edge_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = conall_edge_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.edgtf-mobile-header .edgtf-mobile-nav .edgtf-grid > ul > li > a:hover',
            '.edgtf-mobile-header .edgtf-mobile-nav .edgtf-grid > ul > li > h6:hover'
        );

        echo conall_edge_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);

        $mobile_nav_dropdown_item_styles = array();
        if(conall_edge_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_dropdown_item_styles['border-bottom-color'] = conall_edge_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(conall_edge_options()->getOptionValue('mobile_dropdown_text_color') !== '') {
            $mobile_nav_dropdown_item_styles['color'] = conall_edge_options()->getOptionValue('mobile_dropdown_text_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('mobile_dropdown_font_family'))) {
            $mobile_nav_dropdown_item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('mobile_dropdown_font_family'));
        }

        if(conall_edge_options()->getOptionValue('mobile_dropdown_font_size') !== '') {
            $mobile_nav_dropdown_item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_dropdown_font_size')).'px';
        }

        if(conall_edge_options()->getOptionValue('mobile_dropdown_line_height') !== '') {
            $mobile_nav_dropdown_item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_dropdown_line_height')).'px';
        }

        if(conall_edge_options()->getOptionValue('mobile_dropdown_text_transform') !== '') {
            $mobile_nav_dropdown_item_styles['text-transform'] = conall_edge_options()->getOptionValue('mobile_dropdown_text_transform');
        }

        if(conall_edge_options()->getOptionValue('mobile_dropdown_font_style') !== '') {
            $mobile_nav_dropdown_item_styles['font-style'] = conall_edge_options()->getOptionValue('mobile_dropdown_font_style');
        }

        if(conall_edge_options()->getOptionValue('mobile_dropdown_font_weight') !== '') {
            $mobile_nav_dropdown_item_styles['font-weight'] = conall_edge_options()->getOptionValue('mobile_dropdown_font_weight');
        }

        $mobile_nav_dropdown_item_selector = array(
            '.edgtf-mobile-header .edgtf-mobile-nav a',
            '.edgtf-mobile-header .edgtf-mobile-nav h6'
        );

        echo conall_edge_dynamic_css($mobile_nav_dropdown_item_selector, $mobile_nav_dropdown_item_styles);

        $mobile_nav_dropdown_item_hover_styles = array();
        if(conall_edge_options()->getOptionValue('mobile_dropdown_text_hover_color') !== '') {
            $mobile_nav_dropdown_item_hover_styles['color'] = conall_edge_options()->getOptionValue('mobile_dropdown_text_hover_color');
        }

        $mobile_nav_dropdown_item_selector_hover = array(
            '.edgtf-mobile-header .edgtf-mobile-nav a:hover',
            '.edgtf-mobile-header .edgtf-mobile-nav h4:hover'
        );

        echo conall_edge_dynamic_css($mobile_nav_dropdown_item_selector_hover, $mobile_nav_dropdown_item_hover_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_mobile_navigation_styles');
}

if(!function_exists('conall_edge_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function conall_edge_mobile_logo_styles() {
        if(conall_edge_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo conall_edge_dynamic_css(
                '.edgtf-mobile-header .edgtf-mobile-logo-wrapper a',
                array('height' => conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(conall_edge_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo conall_edge_dynamic_css(
                '.edgtf-mobile-header .edgtf-mobile-logo-wrapper a',
                array('height' => conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }

        if(conall_edge_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval(conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_header_height'))).'px';
            echo conall_edge_dynamic_css('.edgtf-mobile-header .edgtf-mobile-logo-wrapper a', array('max-height' => $max_height));
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_mobile_logo_styles');
}

if(!function_exists('conall_edge_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function conall_edge_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(conall_edge_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = conall_edge_options()->getOptionValue('mobile_icon_color');
        }

        if(conall_edge_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo conall_edge_dynamic_css('.edgtf-mobile-header .edgtf-mobile-menu-opener a', $mobile_icon_styles);

        if(conall_edge_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo conall_edge_dynamic_css(
                '.edgtf-mobile-header .edgtf-mobile-menu-opener a:hover',
                array('color' => conall_edge_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_mobile_icon_styles');
}