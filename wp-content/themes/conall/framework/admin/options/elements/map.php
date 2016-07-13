<?php

if ( ! function_exists('conall_edge_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function conall_edge_load_elements_map() {

		conall_edge_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-star'
			)
		);

		do_action( 'conall_edge_options_elements_map' );

		$panel_parallax = conall_edge_add_admin_panel(
			array(
				'page'  => '_elements_page',
				'name'  => 'panel_parallax',
				'title' => 'Parallax'
			)
		);

		conall_edge_add_admin_field(array(
			'type'			=> 'onoff',
			'name'			=> 'parallax_on_off',
			'default_value'	=> 'off',
			'label'			=> 'Parallax on touch devices',
			'description'	=> 'Enabling this option will allow parallax on touch devices',
			'parent'		=> $panel_parallax
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'text',
			'name'			=> 'parallax_min_height',
			'default_value'	=> '400',
			'label'			=> 'Parallax Min Height',
			'description'	=> 'Set a minimum height for parallax images on small displays (phones, tablets, etc.)',
			'args'			=> array(
				'col_width'	=> 3,
				'suffix'	=> 'px'
			),
			'parent'		=> $panel_parallax
		));
	}

	add_action('conall_edge_options_map', 'conall_edge_load_elements_map', 12);
}