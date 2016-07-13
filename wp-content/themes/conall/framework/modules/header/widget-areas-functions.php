<?php

if(!function_exists('conall_edge_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function conall_edge_register_top_header_areas() {
        $top_bar_layout  = conall_edge_options()->getOptionValue('top_bar_layout');
        $top_bar_enabled = conall_edge_options()->getOptionValue('top_bar');

        if($top_bar_enabled == 'yes') {
            register_sidebar(array(
                'name'          => esc_html__('Top Bar Left', 'conall'),
                'id'            => 'edgtf-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-top-bar-widget">',
                'after_widget'  => '</div>'
            ));

            //register this widget area only if top bar layout is three columns
            if($top_bar_layout === 'three-columns') {
                register_sidebar(array(
                    'name'          => esc_html__('Top Bar Center', 'conall'),
                    'id'            => 'edgtf-top-bar-center',
                    'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-top-bar-widget">',
                    'after_widget'  => '</div>'
                ));
            }

            register_sidebar(array(
                'name'          => esc_html__('Top Bar Right', 'conall'),
                'id'            => 'edgtf-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-top-bar-widget">',
                'after_widget'  => '</div>'
            ));
        }
    }

    add_action('widgets_init', 'conall_edge_register_top_header_areas');
}

if(!function_exists('conall_edge_header_widget_areas')) {
    /**
     * Registers widget areas for header types
     */
    function conall_edge_header_standard_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Header Standard Widget Area', 'conall'),
            'id'            => 'edgtf-header-standard-widget-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-header-standard-widget-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu. Only for Standard Header Type.', 'conall')
        ));
        register_sidebar(array(
            'name'          => esc_html__('Header Simple Widget Area', 'conall'),
            'id'            => 'edgtf-header-simple-widget-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-header-simple-widget-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu. Only for Simple Header Type.', 'conall')
        ));
        register_sidebar(array(
            'name'          => esc_html__('Header Classic Widget Area', 'conall'),
            'id'            => 'edgtf-header-classic-widget-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-header-classic-widget-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the logo and logo will goes left. Only for Classic Header Type.', 'conall')
        ));
        register_sidebar(array(
            'name'          => esc_html__('Header Divided Widget Area', 'conall'),
            'id'            => 'edgtf-header-divided-widget-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-header-divided-widget-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the right part of menu items. Only for Divided Header Type.', 'conall')
        ));
        register_sidebar(array(
            'name'          => esc_html__('Header Full Screen Widget Area', 'conall'),
            'id'            => 'edgtf-header-full-screen-widget-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-header-full-screen-widget-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right side of your header area. Only for Full Screen Header Type.', 'conall')
        ));
    }

    add_action('widgets_init', 'conall_edge_header_standard_widget_areas');
}

if(!function_exists('conall_edge_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function conall_edge_register_mobile_header_areas() {
        if(conall_edge_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Mobile Logo', 'conall'),
                'id'            => 'edgtf-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'conall')
            ));
        }
    }

    add_action('widgets_init', 'conall_edge_register_mobile_header_areas');
}

if(!function_exists('conall_edge_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function conall_edge_register_sticky_header_areas() {
        if(in_array(conall_edge_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Right', 'conall'),
                'id'            => 'edgtf-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'conall')
            ));
        }
    }

    add_action('widgets_init', 'conall_edge_register_sticky_header_areas');
}