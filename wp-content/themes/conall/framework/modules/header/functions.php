<?php

if(!function_exists('conall_edge_header_register_main_navigation')) {
    /**
     * Registers main navigation
     */
    function conall_edge_header_register_main_navigation() {
        register_nav_menus(
            array(
                'main-navigation' => esc_html__('Main Navigation', 'conall'),
                'divided-left-navigation' => esc_html__('Divided Left Navigation', 'conall'),
                'divided-right-navigation' => esc_html__('Divided Right Navigation', 'conall'),
                'mobile-navigation' => esc_html__('Mobile Navigation', 'conall')
            )
        );
    }

    add_action('after_setup_theme', 'conall_edge_header_register_main_navigation');
}

if(!function_exists('conall_edge_is_top_bar_transparent')) {
    /**
     * Checks if top bar is transparent or not
     *
     * @return bool
     */
    function conall_edge_is_top_bar_transparent() {
        $top_bar_enabled = conall_edge_is_top_bar_enabled();

        $top_bar_bg_color = conall_edge_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = conall_edge_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency >= 0 && $top_bar_transparency < 1;
        }

        return false;
    }
}

if(!function_exists('conall_edge_is_top_bar_completely_transparent')) {
    function conall_edge_is_top_bar_completely_transparent() {
        $top_bar_enabled = conall_edge_is_top_bar_enabled();

        $top_bar_bg_color = conall_edge_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = conall_edge_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency === '0';
        }

        return false;
    }
}

if(!function_exists('conall_edge_is_top_bar_enabled')) {
    function conall_edge_is_top_bar_enabled() {
        $top_bar_enabled = conall_edge_options()->getOptionValue('top_bar') == 'yes';

        return $top_bar_enabled;
    }
}

if(!function_exists('conall_edge_get_top_bar_height')) {
    /**
     * Returns top bar height
     *
     * @return bool|int|void
     */
    function conall_edge_get_top_bar_height() {
        if(conall_edge_is_top_bar_enabled()) {
            $top_bar_height = conall_edge_filter_px(conall_edge_options()->getOptionValue('top_bar_height'));

            return $top_bar_height !== '' ? intval($top_bar_height) : 32;
        }

        return 0;
    }
}

if(!function_exists('conall_edge_get_sticky_header_height')) {
    /**
     * Returns top sticky header height
     *
     * @return bool|int|void
     */
    function conall_edge_get_sticky_header_height() {
        //sticky menu height, needed only for sticky header on scroll up
        if(in_array(conall_edge_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up'))) {

            $sticky_header_height = conall_edge_filter_px(conall_edge_options()->getOptionValue('sticky_header_height'));

            return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
        }

        return 0;

    }
}

if(!function_exists('conall_edge_get_sticky_header_height_of_complete_transparency')) {
    /**
     * Returns top sticky header height it is fully transparent. used in anchor logic
     *
     * @return bool|int|void
     */
    function conall_edge_get_sticky_header_height_of_complete_transparency() {

        $stickyHeaderTransparent = conall_edge_options()->getOptionValue('sticky_header_background_color') !== '' && conall_edge_options()->getOptionValue('sticky_header_transparency') === '0';

        if($stickyHeaderTransparent) {
            return 0;
        } else {
            $sticky_header_height = conall_edge_filter_px(conall_edge_options()->getOptionValue('sticky_header_height'));

            return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
        }

        return 0;
    }
}

if(!function_exists('conall_edge_get_sticky_scroll_amount')) {
    /**
     * Returns top sticky scroll amount
     *
     * @return bool|int|void
     */
    function conall_edge_get_sticky_scroll_amount() {

        //sticky menu scroll amount
        if(in_array(conall_edge_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {

            $sticky_scroll_amount = conall_edge_filter_px(conall_edge_options()->getOptionValue('scroll_amount_for_sticky'));

            return $sticky_scroll_amount !== '' ? intval($sticky_scroll_amount) : 0;
        }

        return 0;
    }
}

if(!function_exists('conall_edge_get_sticky_scroll_amount_per_page')) {
    /**
     * Returns top sticky scroll amount
     *
     * @return bool|int|void
     */
    function conall_edge_get_sticky_scroll_amount_per_page() {
        $post_id =  get_the_ID();
        //sticky menu scroll amount
        if(in_array(conall_edge_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {

            $sticky_scroll_amount_per_page = conall_edge_filter_px(get_post_meta($post_id, "edgtf_scroll_amount_for_sticky_meta", true));

            return $sticky_scroll_amount_per_page !== '' ? intval($sticky_scroll_amount_per_page) : 0;
        }

        return 0;
    }
}