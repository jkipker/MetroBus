<?php

if(!function_exists('conall_edge_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function conall_edge_register_sidebars() {

        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'description' => 'Default Sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5>',
            'after_title' => '</h5>'
        ));

    }

    add_action('widgets_init', 'conall_edge_register_sidebars');
}

if(!function_exists('conall_edge_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates ConallEdgeClassSidebar object
     */
    function conall_edge_add_support_custom_sidebar() {
        add_theme_support('ConallEdgeClassSidebar');
        if (get_theme_support('ConallEdgeClassSidebar')) new ConallEdgeClassSidebar();
    }

    add_action('after_setup_theme', 'conall_edge_add_support_custom_sidebar');
}