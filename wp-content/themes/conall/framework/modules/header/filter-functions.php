<?php

if(!function_exists('conall_edge_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function conall_edge_header_class($classes) {
        $header_type = conall_edge_get_meta_field_intersect('header_type', conall_edge_get_page_id());

        $classes[] = 'edgtf-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'conall_edge_header_class');
}

if(!function_exists('conall_edge_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function conall_edge_header_behaviour_class($classes) {

        $classes[] = 'edgtf-'.conall_edge_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'conall_edge_header_behaviour_class');
}

if(!function_exists('conall_edge_mobile_header_class')) {
    function conall_edge_mobile_header_class($classes) {
        $classes[] = 'edgtf-default-mobile-header';

        $classes[] = 'edgtf-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'conall_edge_mobile_header_class');
}

if(!function_exists('conall_edge_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function conall_edge_menu_dropdown_appearance($classes) {

        if(conall_edge_options()->getOptionValue('menu_dropdown_appearance') !== 'default'){
            $classes[] = 'edgtf-'.conall_edge_options()->getOptionValue('menu_dropdown_appearance');
        }

        return $classes;
    }

    add_filter('body_class', 'conall_edge_menu_dropdown_appearance');
}

if (!function_exists('conall_edge_header_skin_class')) {

    function conall_edge_header_skin_class( $classes ) {

        $id = conall_edge_get_page_id();

		if(($meta_temp = get_post_meta($id, 'edgtf_header_style_meta', true)) !== ''){
			$classes[] = 'edgtf-' . $meta_temp;
		} else if ( conall_edge_options()->getOptionValue('header_style') !== '' ) {
            $classes[] = 'edgtf-' . conall_edge_options()->getOptionValue('header_style');
        }

        return $classes;

    }

    add_filter('body_class', 'conall_edge_header_skin_class');
}

if(!function_exists('conall_edge_header_class_set_slider_meta_position')) {
    function conall_edge_header_class_set_slider_meta_position($classes) {
        $id = conall_edge_get_page_id();

        if(get_post_meta($id, 'edgtf_page_slider_meta', true) !== '' && get_post_meta($id, 'edgtf_page_slider_meta_position', true) === 'yes'){
            $classes[]= 'edgtf-slider-position-is-behind-header';
        }

        return $classes;
    }

    add_filter('body_class', 'conall_edge_header_class_set_slider_meta_position');
}

if(!function_exists('conall_edge_header_class_set_sticky_shadow')) {
    function conall_edge_header_class_set_sticky_shadow($classes) {

        if(conall_edge_options()->getOptionValue('sticky_header_shadow') === 'yes'){
            $classes[]= 'edgtf-sticky-has-shadow';
        }

        return $classes;
    }

    add_filter('body_class', 'conall_edge_header_class_set_sticky_shadow');
}

if(!function_exists('conall_edge_header_global_js_var')) {
    function conall_edge_header_global_js_var($global_variables) {

        $global_variables['edgtfTopBarHeight'] = conall_edge_get_top_bar_height();
        $global_variables['edgtfStickyHeaderHeight'] = conall_edge_get_sticky_header_height();
        $global_variables['edgtfStickyHeaderTransparencyHeight'] = conall_edge_get_sticky_header_height_of_complete_transparency();
        $global_variables['edgtfStickyScrollAmount'] = conall_edge_get_sticky_scroll_amount();

        return $global_variables;
    }

    add_filter('conall_edge_js_global_variables', 'conall_edge_header_global_js_var');
}

if(!function_exists('conall_edge_header_per_page_js_var')) {
    function conall_edge_header_per_page_js_var($perPageVars) {

        $perPageVars['edgtfStickyScrollAmount'] = conall_edge_get_sticky_scroll_amount_per_page();

        return $perPageVars;
    }

    add_filter('conall_edge_per_page_js_vars', 'conall_edge_header_per_page_js_var');
}