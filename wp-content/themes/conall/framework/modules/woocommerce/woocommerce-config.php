<?php
/**
 * Woocommerce configuration file
 */

// Adds theme support for woocommerce
add_theme_support('woocommerce');

//Disable the default WooCommerce stylesheet.
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

if (!function_exists('conall_edge_woocommerce_content')){
	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function conall_edge_woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) : the_post();

				wc_get_template_part( 'content', 'single-product' );

			endwhile;

		} else {

			if ( have_posts() ) :

				do_action('woocommerce_before_shop_loop');

				woocommerce_product_loop_start();

				woocommerce_product_subcategories();

				while ( have_posts() ) : the_post();

					wc_get_template_part( 'content', 'product' );

				endwhile; // end of the loop.

				woocommerce_product_loop_end();

				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );

			elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :

				wc_get_template( 'loop/no-products-found.php' );

			endif;
		}
	}
}

//Overide Product List Pagination Position
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'conall_edge_before_woocommerce_container_close', 'woocommerce_pagination', 10 );

//Define number of products per page
add_filter('loop_shop_per_page', 'conall_edge_woocommerce_products_per_page', 20);

//Set number of related products
add_filter( 'woocommerce_output_related_products_args', 'conall_edge_woocommerce_related_products_args');

//Overide Product List Loop Title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'conall_edge_woocommerce_template_loop_product_title', 10 );

//List Product override rating position
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 9);

//List Product override link position
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

//Single Product Title template override
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 8 );

//Single Product Add To Cart template override
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 45 );

//Single Product override price position
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'conall_edge_woocommerce_template_single_title', 5 );

//Single Product override tabs position
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);

//Single product add social share (default woocommerce_share)
add_action( 'woocommerce_single_product_summary', 'conall_edge_woocommerce_share', 50);

//Sale flash template override
add_filter( 'woocommerce_sale_flash', 'conall_edge_woocommerce_sale_flash');

//Single Product Thumbnaiil Size override
add_filter( 'single_product_small_thumbnail_size', 'conall_edge_woocommerce_product_thumbnail_size', 10);

//Single product add additional html around single product info
add_action( 'woocommerce_before_single_product_summary', 'conall_edge_single_product_additional_tag_before', 30);
add_action( 'woocommerce_after_single_product_summary', 'conall_edge_single_product_additional_tag_after', 5);