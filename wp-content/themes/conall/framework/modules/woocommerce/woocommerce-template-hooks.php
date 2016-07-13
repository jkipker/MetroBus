<?php

if (!function_exists('conall_edge_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function conall_edge_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (conall_edge_options()->getOptionValue('edgtf_woo_products_per_page')) {
			$products_per_page = conall_edge_options()->getOptionValue('edgtf_woo_products_per_page');
		}

		return $products_per_page;
	}
}

if (!function_exists('conall_edge_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function conall_edge_woocommerce_related_products_args($args) {

		if (conall_edge_options()->getOptionValue('edgtf_woo_product_list_columns')) {

			$related = conall_edge_options()->getOptionValue('edgtf_woo_product_list_columns');
			switch ($related) {
				case 'edgtf-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'edgtf-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}

		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;
	}
}

if (!function_exists('conall_edge_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function conall_edge_woocommerce_template_loop_product_title() {

		$tag = conall_edge_options()->getOptionValue('edgtf_products_list_title_tag');
		if($tag === '') {
			$tag = 'h5';
		}
		the_title('<' . $tag . ' class="edgtf-product-list-product-title"><a href="'.get_the_permalink().'">', '</a></' . $tag . '>');
	}
}

if (!function_exists('conall_edge_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function conall_edge_woocommerce_template_single_title() {

		$tag = conall_edge_options()->getOptionValue('edgtf_single_product_title_tag');
		if($tag === '') {
			$tag = 'h1';
		}
		the_title('<' . $tag . '  itemprop="name" class="edgtf-single-product-title">', '</' . $tag . '>');
	}
}

if (!function_exists('conall_edge_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function conall_edge_woocommerce_sale_flash() {

		return '<span class="edgtf-onsale">' . esc_html__('SALE', 'conall') . '</span>';
	}
}

if (!function_exists('conall_edge_woocommerce_product_thumbnail_size')) {
	/**
	 * Function for overriding Single Product Thumbnail Image Size
	 *
	 * @return string
	 */
	function conall_edge_woocommerce_product_thumbnail_size() {

		return "shop_single";
	}
}