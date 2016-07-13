<?php

if (!function_exists('conall_edge_register_footer_sidebar')) {

	function conall_edge_register_footer_sidebar() {

		register_sidebar(array(
			'name' => 'Footer Column 1',
			'id' => 'footer_column_1',
			'description' => 'Footer Column 1',
			'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="edgtf-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 2',
			'id' => 'footer_column_2',
			'description' => 'Footer Column 2',
			'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-2 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="edgtf-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 3',
			'id' => 'footer_column_3',
			'description' => 'Footer Column 3',
			'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-3 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="edgtf-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 4',
			'id' => 'footer_column_4',
			'description' => 'Footer Column 4',
			'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-4 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="edgtf-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom',
			'id' => 'footer_text',
			'description' => 'Footer Bottom',
			'before_widget' => '<div id="%1$s" class="widget edgtf-footer-text %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="edgtf-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom Left',
			'id' => 'footer_bottom_left',
			'description' => 'Footer Bottom Left',
			'before_widget' => '<div id="%1$s" class="widget edgtf-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="edgtf-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom Right',
			'id' => 'footer_bottom_right',
			'description' => 'Footer Bottom Right',
			'before_widget' => '<div id="%1$s" class="widget edgtf-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="edgtf-footer-widget-title">',
			'after_title' => '</h5>'
		));

	}

	add_action('widgets_init', 'conall_edge_register_footer_sidebar');
}

if (!function_exists('conall_edge_get_footer')) {
	/**
	 * Loads footer HTML
	 */
	function conall_edge_get_footer() {

		$parameters = array();
		$id = conall_edge_get_page_id();

		$parameters['footer_classes'] = conall_edge_get_footer_classes($id);
		$parameters['display_footer_top'] = (conall_edge_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
		$parameters['display_footer_bottom'] = (conall_edge_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;

		conall_edge_get_module_template_part('templates/footer', 'footer', '', $parameters);
	}
}

if (!function_exists('conall_edge_get_content_bottom_area')) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function conall_edge_get_content_bottom_area() {

		$parameters = array();

		//Current page id
		$id = conall_edge_get_page_id();

		//is content bottom area enabled for current page?
		$parameters['content_bottom_area'] = conall_edge_get_meta_field_intersect('enable_content_bottom_area', $id);

		if ($parameters['content_bottom_area'] == 'yes') {
			//Sidebar for content bottom area
			$parameters['content_bottom_area_sidebar'] = conall_edge_get_meta_field_intersect('content_bottom_sidebar_custom_display', $id);
			//Content bottom area in grid
			$parameters['content_bottom_area_in_grid'] = conall_edge_get_meta_field_intersect('content_bottom_in_grid', $id);
			//Content bottom area background color
			if(conall_edge_get_meta_field_intersect('content_bottom_background_color', $id) !== '') {
				$parameters['content_bottom_style'][] = 'background-color: '.conall_edge_get_meta_field_intersect('content_bottom_background_color', $id).';';
			}
            //Content bottom area background image
            if(conall_edge_get_meta_field_intersect('content_bottom_background_image', $id) !== '') {
				$parameters['content_bottom_style'][] = ' background-image: url('.conall_edge_get_meta_field_intersect('content_bottom_background_image', $id).')';
            }
		}

		conall_edge_get_module_template_part('templates/parts/content-bottom-area', 'footer', '', $parameters);
	}
}

if (!function_exists('conall_edge_get_footer_top')) {
	/**
	 * Return footer top HTML
	 */
	function conall_edge_get_footer_top() {

		$parameters = array();

		$parameters['footer_in_grid'] = (conall_edge_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_top_classes'] = conall_edge_footer_top_classes();
		$parameters['footer_top_columns'] = conall_edge_options()->getOptionValue('footer_top_columns');

		conall_edge_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
	}
}

if (!function_exists('conall_edge_get_footer_bottom')) {
	/**
	 * Return footer bottom HTML
	 */
	function conall_edge_get_footer_bottom() {

		$parameters = array();

		$parameters['footer_in_grid'] = (conall_edge_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_bottom_columns'] = conall_edge_options()->getOptionValue('footer_bottom_columns');

		conall_edge_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
	}
}

//Functions for loading sidebars

if (!function_exists('conall_edge_get_footer_sidebar_25_25_50')) {

	function conall_edge_get_footer_sidebar_25_25_50() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-three-columns-25-25-50', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_sidebar_50_25_25')) {

	function conall_edge_get_footer_sidebar_50_25_25() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-three-columns-50-25-25', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_sidebar_four_columns')) {

	function conall_edge_get_footer_sidebar_four_columns() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-four-columns', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_sidebar_three_columns')) {

	function conall_edge_get_footer_sidebar_three_columns() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-three-columns', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_sidebar_two_columns')) {

	function conall_edge_get_footer_sidebar_two_columns() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-two-columns', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_sidebar_one_column')) {

	function conall_edge_get_footer_sidebar_one_column() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-one-column', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_bottom_sidebar_three_columns')) {

	function conall_edge_get_footer_bottom_sidebar_three_columns() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-bottom-three-columns', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_bottom_sidebar_two_columns')) {

	function conall_edge_get_footer_bottom_sidebar_two_columns() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-bottom-two-columns', 'footer');
	}
}

if (!function_exists('conall_edge_get_footer_bottom_sidebar_one_column')) {

	function conall_edge_get_footer_bottom_sidebar_one_column() {
		conall_edge_get_module_template_part('templates/sidebars/sidebar-bottom-one-column', 'footer');
	}
}