<?php

if ( ! function_exists('conall_edge_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function conall_edge_woocommerce_options_map() {

		conall_edge_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => 'Woocommerce',
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = conall_edge_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => 'Product List'
			)
		);

		conall_edge_add_admin_field(array(
			'name'        	=> 'edgtf_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> 'Product List Columns',
			'default_value'	=> 'edgtf-woocommerce-columns-4',
			'description' 	=> 'Choose number of columns for product listing and related products on single product',
			'options'		=> array(
				'edgtf-woocommerce-columns-3' => '3 Columns (2 with sidebar)',
				'edgtf-woocommerce-columns-4' => '4 Columns (3 with sidebar)'
			),
			'parent'      	=> $panel_product_list,
		));

		conall_edge_add_admin_field(array(
			'name'        	=> 'edgtf_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> 'Number of products per page',
			'default_value'	=> '',
			'description' 	=> 'Set number of products on shop page',
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		conall_edge_add_admin_field(array(
			'name'        	=> 'edgtf_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> 'Products Title Tag',
			'default_value'	=> 'h5',
			'description' 	=> '',
			'options'		=> array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_product_list,
		));

		conall_edge_add_admin_field(array(
			'name'        	=> 'edgtf_products_list_set_title_inside_image',
			'type'        	=> 'yesno',
			'label'       	=> 'Set Product Info Inside Image',
			'default_value'	=> 'yes',
			'description' 	=> 'Enabling this option you will set title and price info at the bottom area of your product image',
			'parent'      	=> $panel_product_list
		));

		conall_edge_add_admin_field(array(
			'name'        	=> 'edgtf_products_list_title_area_background_color',
			'type'        	=> 'color',
			'label'       	=> 'Product Info Area Background Color',
			'default_value'	=> '',
			'description' 	=> 'Set background color for product title and price info area',
			'parent'      	=> $panel_product_list
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = conall_edge_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => 'Single Product'
			)
		);

		conall_edge_add_admin_field(array(
			'name'        	=> 'edgtf_single_product_title_tag',
			'type'        	=> 'select',
			'label'       	=> 'Single Product Title Tag',
			'default_value'	=> 'h4',
			'description' 	=> '',
			'options'		=> array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_single_product,
		));

		conall_edge_add_admin_field(array(
			'name'          => 'woocommerce_enable_single_sticky_content',
			'type'          => 'yesno',
			'label'         => 'Sticky Side Text',
			'description'   => 'Enabling this option will make side text sticky on Single Product pages',
			'default_value' => 'no',
			'parent'        => $panel_single_product
		));
	}

	add_action( 'conall_edge_options_map', 'conall_edge_woocommerce_options_map', 21);
}