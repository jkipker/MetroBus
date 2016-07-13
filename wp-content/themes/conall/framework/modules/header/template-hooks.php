<?php

//top header bar
add_action('conall_edge_before_page_header', 'conall_edge_get_header_top');

//mobile header
add_action('conall_edge_after_page_header', 'conall_edge_get_mobile_header');