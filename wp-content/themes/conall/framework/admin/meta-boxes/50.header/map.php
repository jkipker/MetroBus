<?php

$header_meta_box = conall_edge_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header_meta'
    )
);

    conall_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_header_type_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Choose Header Type',
            'description' => 'Select header type layout',
            'parent' => $header_meta_box,
            'options' => array(
                '' => 'Default',
                'header-standard' => 'Standard Header Layout',
                'header-simple' => 'Simple Header Layout',
                'header-classic' => 'Classic Header Layout',
                'header-divided' => 'Divided Header Layout',
                'header-full-screen' => 'Full Screen Header Layout'
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => '#edgtf_edgtf_header_standard_type_meta_container, #edgtf_edgtf_header_simple_type_meta_container, #edgtf_edgtf_header_classic_type_meta_container, #edgtf_edgtf_header_divided_type_meta_container, #edgtf_edgtf_header_full_screen_type_meta_container',
                    "header-standard" => '#edgtf_edgtf_header_simple_type_meta_container, #edgtf_edgtf_header_divided_type_meta_container, #edgtf_edgtf_header_classic_type_meta_container, #edgtf_edgtf_header_full_screen_type_meta_container',
                    "header-simple" => '#edgtf_edgtf_header_standard_type_meta_container, #edgtf_edgtf_header_divided_type_meta_container, #edgtf_edgtf_header_classic_type_meta_container, #edgtf_edgtf_header_full_screen_type_meta_container',
                    "header-classic" => '#edgtf_edgtf_header_standard_type_meta_container, #edgtf_edgtf_header_simple_type_meta_container, #edgtf_edgtf_header_divided_type_meta_container, #edgtf_edgtf_header_full_screen_type_meta_container',
                    "header-divided" => '#edgtf_edgtf_header_standard_type_meta_container, #edgtf_edgtf_header_simple_type_meta_container, #edgtf_edgtf_header_classic_type_meta_container, #edgtf_edgtf_header_full_screen_type_meta_container',
                    "header-full-screen" => '#edgtf_edgtf_header_standard_type_meta_container, #edgtf_edgtf_header_simple_type_meta_container, #edgtf_edgtf_header_classic_type_meta_container, #edgtf_edgtf_header_divided_type_meta_container'
                ),
                "show" => array(
                    "" => '',
                    "header-standard" => '#edgtf_edgtf_header_standard_type_meta_container',
                    "header-simple" => '#edgtf_edgtf_header_simple_type_meta_container',
                    "header-classic" => '#edgtf_edgtf_header_classic_type_meta_container',
                    "header-divided" => '#edgtf_edgtf_header_divided_type_meta_container',
                    "header-full-screen" => '#edgtf_edgtf_header_full_screen_type_meta_container'
                )
            )
        )
    );

    $header_standard_type_meta_container = conall_edge_add_admin_container(
        array(
            'parent' => $header_meta_box,
            'name' => 'edgtf_header_standard_type_meta_container',
            'hidden_property' => 'edgtf_header_type_meta',
            'hidden_values' => array(
                'header-simple',
                'header-classic',
                'header-divided',
                'header-full-screen'
            ),
        )
    );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_color_header_standard_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for header area',
                'parent' => $header_standard_type_meta_container
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_transparency_header_standard_meta',
                'type' => 'text',
                'label' => 'Background Transparency',
                'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
                'parent' => $header_standard_type_meta_container,
                'args' => array(
                    'col_width' => 2
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_border_bottom_color_header_standard_meta',
                'type' => 'color',
                'label' => 'Border Bottom Color',
                'description' => 'Choose a border bottom color for header area',
                'parent' => $header_standard_type_meta_container
            )
        );

    $header_simple_type_meta_container = conall_edge_add_admin_container(
        array(
            'parent' => $header_meta_box,
            'name' => 'edgtf_header_simple_type_meta_container',
            'hidden_property' => 'edgtf_header_type_meta',
            'hidden_values' => array(
                'header-standard',
                'header-classic',
                'header-divided',
                'header-full-screen'
            ),
        )
    );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_enable_grid_layout_header_simple_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Enable Grid Layout',
                'description' => 'Enabling this option you will set simple header area to be in grid',
                'parent' => $header_simple_type_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes',
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_color_header_simple_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for header area',
                'parent' => $header_simple_type_meta_container
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_transparency_header_simple_meta',
                'type' => 'text',
                'label' => 'Background Transparency',
                'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
                'parent' => $header_simple_type_meta_container,
                'args' => array(
                    'col_width' => 2
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_border_bottom_color_header_simple_meta',
                'type' => 'color',
                'label' => 'Border Bottom Color',
                'description' => 'Choose a border bottom color for header area',
                'parent' => $header_simple_type_meta_container
            )
        );

    $header_classic_type_meta_container = conall_edge_add_admin_container(
        array(
            'parent' => $header_meta_box,
            'name' => 'edgtf_header_classic_type_meta_container',
            'hidden_property' => 'edgtf_header_type_meta',
            'hidden_values' => array(
                'header-standard',
                'header-simple',
                'header-divided',
                'header-full-screen'
            ),
        )
    );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_color_header_classic_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for header area',
                'parent' => $header_classic_type_meta_container
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_transparency_header_classic_meta',
                'type' => 'text',
                'label' => 'Background Transparency',
                'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
                'parent' => $header_classic_type_meta_container,
                'args' => array(
                    'col_width' => 2
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_border_bottom_color_header_classic_meta',
                'type' => 'color',
                'label' => 'Border Bottom Color',
                'description' => 'Choose a border bottom color for header area',
                'parent' => $header_classic_type_meta_container
            )
        );    

    $header_divided_type_meta_container = conall_edge_add_admin_container(
        array(
            'parent' => $header_meta_box,
            'name' => 'edgtf_header_divided_type_meta_container',
            'hidden_property' => 'edgtf_header_type_meta',
            'hidden_values' => array(
                'header-standard',
                'header-simple',
                'header-classic',
                'header-full-screen'
            ),
        )
    );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_enable_grid_layout_header_divided_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Enable Grid Layout',
                'description' => 'Enabling this option you will set divided header area to be in grid',
                'parent' => $header_divided_type_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes',
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_color_header_divided_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for header area',
                'parent' => $header_divided_type_meta_container
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_transparency_header_divided_meta',
                'type' => 'text',
                'label' => 'Background Transparency',
                'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
                'parent' => $header_divided_type_meta_container,
                'args' => array(
                    'col_width' => 2
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_border_bottom_color_header_divided_meta',
                'type' => 'color',
                'label' => 'Border Bottom Color',
                'description' => 'Choose a border bottom color for header area',
                'parent' => $header_divided_type_meta_container
            )
        );    

    $header_full_screen_type_meta_container = conall_edge_add_admin_container(
        array(
            'parent' => $header_meta_box,
            'name' => 'edgtf_header_full_screen_type_meta_container',
            'hidden_property' => 'edgtf_header_type_meta',
            'hidden_values' => array(
                'header-standard',
                'header-simple',
                'header-classic',
                'header-divided'
            ),
        )
    );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_enable_grid_layout_header_full_screen_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Enable Grid Layout',
                'description' => 'Enabling this option you will set full screen header area to be in grid',
                'parent' => $header_full_screen_type_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes',
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_color_header_full_screen_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for header area',
                'parent' => $header_full_screen_type_meta_container
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_background_transparency_header_full_screen_meta',
                'type' => 'text',
                'label' => 'Background Transparency',
                'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
                'parent' => $header_full_screen_type_meta_container,
                'args' => array(
                    'col_width' => 2
                )
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_border_bottom_color_header_full_screen_meta',
                'type' => 'color',
                'label' => 'Border Bottom Color',
                'description' => 'Choose a border bottom color for header area',
                'parent' => $header_full_screen_type_meta_container
            )
        );  

        conall_edge_add_meta_box_field(
            array(
                'name'            => 'edgtf_scroll_amount_for_sticky_meta',
                'type'            => 'text',
                'label'           => 'Scroll amount for sticky header appearance',
                'description'     => 'Define scroll amount for sticky header appearance',
                'parent'          => $header_meta_box,
                'args'            => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                ),
                'hidden_property' => 'header_behaviour',
                'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
            )
        );

        conall_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_header_style_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Header Skin',
                'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
                'parent' => $header_meta_box,
                'options' => array(
                    '' => '',
                    'light-header' => 'Light',
                    'dark-header' => 'Dark'
                )
            )
        );