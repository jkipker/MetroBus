<?php

use ConallEdgeNamespace\Modules\Header\Lib\HeaderFactory;

if(!function_exists('conall_edge_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines conall_edge_header_type_parameters filter
     */
    function conall_edge_get_header() {

        //will be read from options
        $header_type     = conall_edge_get_meta_field_intersect('header_type');
        if(conall_edge_get_meta_field_intersect('header_type') == '') {
            $header_type = conall_edge_options()->getOptionValue('header_type');
        }
        $simple_header_in_grid     = conall_edge_get_meta_field_intersect('enable_grid_layout_header_simple');
        if(conall_edge_get_meta_field_intersect('enable_grid_layout_header_simple') == '') {
            $simple_header_in_grid = conall_edge_options()->getOptionValue('enable_grid_layout_header_simple');
        }
        $full_screen_header_in_grid = conall_edge_get_meta_field_intersect('enable_grid_layout_header_full_screen');
        if($full_screen_header_in_grid == '') {
            $full_screen_header_in_grid = conall_edge_options()->getOptionValue('enable_grid_layout_header_full_screen');
        }
        $divided_header_in_grid = conall_edge_get_meta_field_intersect('enable_grid_layout_header_divided');
        if($divided_header_in_grid == '') {
            $divided_header_in_grid = conall_edge_options()->getOptionValue('enable_grid_layout_header_divided');
        }
        $header_behavior = conall_edge_options()->getOptionValue('header_behaviour');

        extract(conall_edge_get_page_options());

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => conall_edge_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'simple_header_in_grid' => $simple_header_in_grid == 'yes' ? true : false,
                'divided_header_in_grid' => $divided_header_in_grid == 'yes' ? true : false,
                'full_screen_header_in_grid' => $full_screen_header_in_grid == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
                'menu_area_background_color' => $menu_area_background_color,
                'menu_area_border_bottom_color' => $menu_area_border_bottom_color
            );

            $parameters = apply_filters('conall_edge_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('conall_edge_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function conall_edge_get_header_top() {

        //generate column width class
        switch(conall_edge_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_widht_class = '50-50';
                break;
            case ('three-columns'):
                $column_widht_class = conall_edge_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths'      => $column_widht_class,
            'show_widget_center' => conall_edge_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
            'show_header_top'    => conall_edge_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => conall_edge_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('conall_edge_header_top_params', $params);

        conall_edge_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('conall_edge_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function conall_edge_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : conall_edge_options()->getOptionValue('header_type');

        if($slug == 'sticky'){
            $logo_image = conall_edge_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = conall_edge_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = conall_edge_options()->getOptionValue('logo_image_dark');
        $logo_image_light = conall_edge_options()->getOptionValue('logo_image_light');


        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = conall_edge_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_styles' => $logo_styles
        );

        conall_edge_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('conall_edge_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function conall_edge_get_main_menu($additional_class = 'edgtf-default-nav') {
        conall_edge_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('conall_edge_get_divided_left_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function conall_edge_get_divided_left_main_menu($additional_class = 'edgtf-default-nav') {
        conall_edge_get_module_template_part('templates/parts/divided-left-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('conall_edge_get_divided_right_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function conall_edge_get_divided_right_main_menu($additional_class = 'edgtf-default-nav') {
        conall_edge_get_module_template_part('templates/parts/divided-right-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('conall_edge_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function conall_edge_get_sticky_menu($additional_class = 'edgtf-default-nav') {
		conall_edge_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('conall_edge_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function conall_edge_get_sticky_header() {

        $parameters = array(
            'hide_logo'             => conall_edge_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_header_in_grid' => conall_edge_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
        );

        conall_edge_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
    }
}

if(!function_exists('conall_edge_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function conall_edge_get_mobile_header() {
        if(conall_edge_is_responsive_on()) {
            $header_type = conall_edge_options()->getOptionValue('header_type');

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => conall_edge_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'menu_opener_icon'       => conall_edge_icon_collections()->getMobileMenuIcon(conall_edge_options()->getOptionValue('mobile_icon_pack'), true),
                'show_navigation_opener' => has_nav_menu('main-navigation')
            );

            conall_edge_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('conall_edge_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function conall_edge_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : conall_edge_options()->getOptionValue('header_type');

        //check if mobile logo has been set and use that, else use normal logo
        if(conall_edge_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = conall_edge_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = conall_edge_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = conall_edge_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        conall_edge_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('conall_edge_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function conall_edge_get_mobile_nav() {

        $slug = conall_edge_options()->getOptionValue('header_type');

        conall_edge_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}

if(!function_exists('conall_edge_get_page_options')) {
    /**
     * Gets options from page
     */
    function conall_edge_get_page_options() {
        $id = conall_edge_get_page_id();
        $page_options = array();
        $menu_area_background_color_rgba = '';
        $menu_area_background_color = '';
        $menu_area_background_transparency = '1';
        $menu_area_border_bottom_color = '';

        $header_type = conall_edge_get_meta_field_intersect('header_type');
        if(conall_edge_get_meta_field_intersect('header_type') == '') {
            $header_type = conall_edge_options()->getOptionValue('header_type');
        }
        
        switch ($header_type) {
            case 'header-standard':

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true) !== '') {
                    $menu_area_background_color = get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true) !== '') {
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true) === '' && get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true) !== '') {
                    $menu_area_background_color = '#fff';
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true);
                }

                if(conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
                    $menu_area_background_color_rgba = 'background-color:'.conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
                }

                if(get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_standard_meta', true) !== '') {
                    $menu_area_border_bottom_color = 'border-color:'.get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_standard_meta', true);
                }

                break;

            case 'header-simple':

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_simple_meta', true) !== '') {
                    $menu_area_background_color = get_post_meta($id, 'edgtf_menu_area_background_color_header_simple_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_transparency_header_simple_meta', true) !== '') {
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_simple_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_simple_meta', true) === '' && get_post_meta($id, 'edgtf_menu_area_background_transparency_header_simple_meta', true) !== '') {
                    $menu_area_background_color = '#fff';
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_simple_meta', true);
                }

                if(conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
                    $menu_area_background_color_rgba = 'background-color:'.conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
                }

                if(get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_simple_meta', true) !== '') {
                    $menu_area_border_bottom_color = 'border-color:'.get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_simple_meta', true);
                }

                break;

            case 'header-classic':

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_classic_meta', true) !== '') {
                    $menu_area_background_color = get_post_meta($id, 'edgtf_menu_area_background_color_header_classic_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_transparency_header_classic_meta', true) !== '') {
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_classic_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_classic_meta', true) === '' && get_post_meta($id, 'edgtf_menu_area_background_transparency_header_classic_meta', true) !== '') {
                    $menu_area_background_color = '#fff';
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_classic_meta', true);
                }

                if(conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
                    $menu_area_background_color_rgba = 'background-color:'.conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
                }

                if(get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_classic_meta', true) !== '') {
                    $menu_area_border_bottom_color = 'border-color:'.get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_classic_meta', true);
                }

                break;    

            case 'header-divided':

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_divided_meta', true) !== '') {
                    $menu_area_background_color = get_post_meta($id, 'edgtf_menu_area_background_color_header_divided_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_transparency_header_divided_meta', true) !== '') {
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_divided_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_divided_meta', true) === '' && get_post_meta($id, 'edgtf_menu_area_background_transparency_header_divided_meta', true) !== '') {
                    $menu_area_background_color = '#fff';
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_divided_meta', true);
                }

                if(conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
                    $menu_area_background_color_rgba = 'background-color:'.conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
                }

                if(get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_divided_meta', true) !== '') {
                    $menu_area_border_bottom_color = 'border-color:'.get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_divided_meta', true);
                }

                break;      

            case 'header-full-screen':

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_full_screen_meta', true) !== '') {
                    $menu_area_background_color = get_post_meta($id, 'edgtf_menu_area_background_color_header_full_screen_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_transparency_header_full_screen_meta', true) !== '') {
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_full_screen_meta', true);
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_full_screen_meta', true) === '' && get_post_meta($id, 'edgtf_menu_area_background_transparency_header_full_screen_meta', true) !== '') {
                    $menu_area_background_color = '#fff';
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_full_screen_meta', true);
                }

                if(conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
                    $menu_area_background_color_rgba = 'background-color:'.conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
                }

                if(get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_full_screen_meta', true) !== '') {
                    $menu_area_border_bottom_color = 'border-color:'.get_post_meta($id, 'edgtf_menu_area_border_bottom_color_header_full_screen_meta', true);
                }

                break;
        }

        $page_options['menu_area_background_color'] = $menu_area_background_color_rgba;
        $page_options['menu_area_border_bottom_color'] = $menu_area_border_bottom_color;

        return $page_options;
    }
}