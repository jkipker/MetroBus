<?php
use ConallEdgeNamespace\Modules\Header\Lib;

if(!function_exists('conall_edge_set_header_object')) {
    function conall_edge_set_header_object() {
        $header_type = conall_edge_get_meta_field_intersect('header_type', conall_edge_get_page_id());

        $object = Lib\HeaderFactory::getInstance()->build($header_type);

        if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
            $header_connector = new Lib\HeaderConnector($object);
            $header_connector->connect($object->getConnectConfig());
        }
    }

    add_action('wp', 'conall_edge_set_header_object', 1);
}