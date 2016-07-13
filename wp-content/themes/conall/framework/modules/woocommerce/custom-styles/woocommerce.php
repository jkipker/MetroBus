<?php

if (!function_exists('conall_edge_woocommerce_area_product_info_style')) {

    function conall_edge_woocommerce_area_product_info_style(){

        $woocmmerce_title_price_style = array();

        if(conall_edge_options()->getOptionValue('edgtf_products_list_title_area_background_color') !== '') {
            $woocmmerce_title_price_style['background-color'] = conall_edge_options()->getOptionValue('edgtf_products_list_title_area_background_color');
        }

        $woocmmerce_title_price_selector = array(
            '.woocommerce .edgtf-product-info-holder'
        );

        echo conall_edge_dynamic_css($woocmmerce_title_price_selector, $woocmmerce_title_price_style);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_woocommerce_area_product_info_style');
}