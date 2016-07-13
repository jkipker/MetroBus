<?php

//WooCommerce
if(conall_edge_is_woocommerce_installed()){

    $woocommerce_meta_box = conall_edge_add_meta_box(
        array(
            'scope' => array('product'),
            'title' => 'Product Meta',
            'name' => 'woo_product_meta'
        )
    );

        conall_edge_add_meta_box_field(array(
            'name'        => 'edgtf_product_featured_image_size',
            'type'        => 'select',
            'label'       => 'Dimensions for Product List Shortcode',
            'description' => 'Choose image layout when it appears in Edge Product List shortcode',
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                'edgtf-woo-image-normal-width'       => 'Default',
                'edgtf-woo-image-large-width'        => 'Large Width',
            )
        ));
}