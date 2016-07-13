<?php

if ( ! function_exists('conall_edge_header_options_map') ) {

	function conall_edge_header_options_map() {

		conall_edge_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => 'Header',
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = conall_edge_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => 'Header'
			)
		);

		conall_edge_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'radiogroup',
				'name' => 'header_type',
				'default_value' => 'header-standard',
				'label' => 'Choose Header Type',
				'description' => 'Select the type of header you would like to use',
				'options' => array(
					'header-standard' => array(
						'image' => EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/standard-header.png'
					),
					'header-simple' => array(
                        'image' => EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/simple-header.png'
                    ),
                    'header-classic' => array(
                        'image' => EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/classic-header.png'
                    ),
                    'header-divided' => array(
                        'image' => EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/divided-header.png'
                    ),
                    'header-full-screen' => array(
                        'image' => EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT.'/img/full-screen-header.png'
                    )
				),
				'args' => array(
					'use_images' => true,
					'hide_labels' => true,
					'dependence' => true,
					'show' => array(
						'header-standard' => '#edgtf_panel_header_standard,#edgtf_header_behaviour,#edgtf_panel_fixed_header,#edgtf_panel_sticky_header,#edgtf_panel_main_menu',
						'header-simple' => '#edgtf_panel_header_simple,#edgtf_header_behaviour,#edgtf_panel_fixed_header,#edgtf_panel_sticky_header,#edgtf_panel_main_menu',
						'header-classic' => '#edgtf_panel_header_classic,#edgtf_header_behaviour,#edgtf_panel_fixed_header,#edgtf_panel_sticky_header,#edgtf_panel_main_menu',
						'header-divided' => '#edgtf_panel_header_divided,#edgtf_header_behaviour,#edgtf_panel_fixed_header,#edgtf_panel_sticky_header,#edgtf_panel_main_menu',
						'header-full-screen' => '#edgtf_panel_header_full_screen',
					),
					'hide' => array(
						'header-standard' => '#edgtf_panel_header_simple,#edgtf_panel_header_classic,#edgtf_panel_header_divided,#edgtf_panel_header_full_screen',
						'header-simple' => '#edgtf_panel_header_standard,#edgtf_panel_header_classic,#edgtf_panel_header_divided,#edgtf_panel_header_full_screen',
						'header-classic' => '#edgtf_panel_header_standard,#edgtf_panel_header_simple,#edgtf_panel_header_divided,#edgtf_panel_header_full_screen',
						'header-divided' => '#edgtf_panel_header_standard,#edgtf_panel_header_simple,#edgtf_panel_header_classic,#edgtf_panel_header_full_screen',
						'header-full-screen' => '#edgtf_panel_header_standard,#edgtf_panel_header_simple,#edgtf_panel_header_classic,#edgtf_panel_header_divided,#edgtf_panel_main_menu,#edgtf_header_behaviour,#edgtf_panel_fixed_header,#edgtf_panel_sticky_header',
					)
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'fixed-on-scroll',
				'label' => 'Choose Header Behaviour',
				'description' => 'Select the behaviour of header when you scroll down to page',
				'options' => array(
					'sticky-header-on-scroll-up' => 'Sticky on scroll up',
					'sticky-header-on-scroll-down-up' => 'Sticky on scroll up/down',
					'fixed-on-scroll' => 'Fixed on scroll'
				),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
	                'header-full-screen'
                ),
				'args' => array(
					'dependence' => true,
					'show' => array(
						'sticky-header-on-scroll-up' => '#edgtf_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#edgtf_panel_sticky_header',
						'fixed-on-scroll' => '#edgtf_panel_fixed_header'
					),
					'hide' => array(
						'sticky-header-on-scroll-up' => '#edgtf_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#edgtf_panel_fixed_header',
						'fixed-on-scroll' => '#edgtf_panel_sticky_header',
					)
				)
			)
		);

		/***************** Top Header Layout **********************/

			conall_edge_add_admin_field(
				array(
					'name' => 'top_bar',
					'type' => 'yesno',
					'default_value' => 'no',
					'label' => 'Top Bar',
					'description' => 'Enabling this option will show top bar area',
					'parent' => $panel_header,
					'args' => array(
						"dependence" => true,
						"dependence_hide_on_yes" => "",
						"dependence_show_on_yes" => "#edgtf_top_bar_container"
					)
				)
			);

			$top_bar_container = conall_edge_add_admin_container(array(
				'name' => 'top_bar_container',
				'parent' => $panel_header,
				'hidden_property' => 'top_bar',
				'hidden_value' => 'no'
			));

			conall_edge_add_admin_field(
				array(
					'parent' => $top_bar_container,
					'type' => 'select',
					'name' => 'top_bar_layout',
					'default_value' => 'three-columns',
					'label' => 'Choose top bar layout',
					'description' => 'Select the layout for top bar',
					'options' => array(
						'two-columns' => 'Two columns',
						'three-columns' => 'Three columns'
					),
					'args' => array(
						"dependence" => true,
						"hide" => array(
							"two-columns" => "#edgtf_top_bar_layout_container",
							"three-columns" => ""
						),
						"show" => array(
							"two-columns" => "",
							"three-columns" => "#edgtf_top_bar_layout_container"
						)
					)
				)
			);

			$top_bar_layout_container = conall_edge_add_admin_container(array(
				'name' => 'top_bar_layout_container',
				'parent' => $top_bar_container,
				'hidden_property' => 'top_bar_layout',
				'hidden_value' => '',
				'hidden_values' => array("two-columns"),
			));

			conall_edge_add_admin_field(
				array(
					'parent' => $top_bar_layout_container,
					'type' => 'select',
					'name' => 'top_bar_column_widths',
					'default_value' => '30-30-30',
					'label' => 'Choose column widths',
					'description' => '',
					'options' => array(
						'30-30-30' => '33% - 33% - 33%',
						'25-50-25' => '25% - 50% - 25%'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'name' => 'top_bar_in_grid',
					'type' => 'yesno',
					'default_value' => 'yes',
					'label' => 'Top Bar in grid',
					'description' => 'Set top bar content to be in grid',
					'parent' => $top_bar_layout_container,
					'args' => array(
						"dependence" => true,
						"dependence_hide_on_yes" => "",
						"dependence_show_on_yes" => "#edgtf_top_bar_in_grid_container"
					)
				)
			);

			$top_bar_in_grid_container = conall_edge_add_admin_container(array(
				'name' => 'top_bar_in_grid_container',
				'parent' => $top_bar_layout_container,
				'hidden_property' => 'top_bar_in_grid',
				'hidden_value' => 'no'
			));

			conall_edge_add_admin_field(array(
				'name' => 'top_bar_background_color',
				'type' => 'color',
				'label' => 'Background Color',
				'description' => 'Set background color for top bar',
				'parent' => $top_bar_layout_container
			));

			conall_edge_add_admin_field(array(
				'name' => 'top_bar_background_transparency',
				'type' => 'text',
				'label' => 'Background Transparency',
				'description' => 'Set background transparency for top bar',
				'parent' => $top_bar_layout_container,
				'args' => array('col_width' => 3)
			));

			conall_edge_add_admin_field(array(
				'name' => 'top_bar_height',
				'type' => 'text',
				'label' => 'Top bar height',
				'description' => 'Enter top bar height (Default is 32px)',
				'parent' => $top_bar_layout_container,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			));

		/***************** Top Header Layout **********************/	

		/***************** Header Skin Options ********************/

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'select',
					'name' => 'header_style',
					'default_value' => '',
					'label' => 'Header Skin',
					'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
					'options' => array(
						'' => '',
						'light-header' => 'Light',
						'dark-header' => 'Dark'
					)
				)
			);

		/***************** Header Skin Options ********************/	

		/***************** Standard Header Layout *****************/

			$panel_header_standard = conall_edge_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_standard',
					'title' => 'Header Standard',
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
	                    'header-simple',
	                    'header-classic',
	                    'header-divided',
	                    'header-full-screen'
					)
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_standard,
					'name' => 'menu_area_title',
					'title' => 'Menu Area'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_standard,
					'type' => 'color',
					'name' => 'menu_area_background_color_header_standard',
					'default_value' => '',
					'label' => 'Background Color',
					'description' => 'Set background color for header'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_standard,
					'type' => 'text',
					'name' => 'menu_area_background_transparency_header_standard',
					'default_value' => '',
					'label' => 'Background Transparency',
					'description' => 'Set background transparency for header',
					'args' => array(
						'col_width' => 3
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_standard,
					'type' => 'color',
					'name' => 'menu_area_border_color_header_standard',
					'default_value' => '',
					'label' => 'Border Color',
					'description' => 'Set border color for header'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_standard,
					'type' => 'text',
					'name' => 'menu_area_height_header_standard',
					'default_value' => '',
					'label' => 'Height',
					'description' => 'Enter Header Height (default is 88px)',
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/***************** Standard Header Layout *****************/

		/***************** Simple Header Layout *******************/

			$panel_header_simple = conall_edge_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_simple',
					'title' => 'Header Simple',
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
	                    'header-standard',
	                    'header-classic',
	                    'header-divided',
	                    'header-full-screen'
					)
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_simple,
					'name' => 'header_simple_title',
					'title' => 'Header Simple'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_simple,
					'type' => 'yesno',
					'name' => 'enable_grid_layout_header_simple',
					'default_value' => 'yes',
					'label' => 'Enable Grid Layout',
					'description' => 'Enabling this option you will set simple header area to be in grid',
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_simple,
					'name' => 'menu_area_title',
					'title' => 'Menu Area'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_simple,
					'type' => 'color',
					'name' => 'menu_area_background_color_header_simple',
					'default_value' => '',
					'label' => 'Background Color',
					'description' => 'Set background color for header'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_simple,
					'type' => 'text',
					'name' => 'menu_area_background_transparency_header_simple',
					'default_value' => '',
					'label' => 'Background Transparency',
					'description' => 'Set background transparency for header',
					'args' => array(
						'col_width' => 3
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_simple,
					'type' => 'color',
					'name' => 'menu_area_border_bottom_color_header_simple',
					'default_value' => '',
					'label' => 'Border Bottom Color',
                	'description' => 'Choose a border bottom color for header area',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_simple,
					'type' => 'text',
					'name' => 'menu_area_height_header_simple',
					'default_value' => '',
					'label' => 'Height',
					'description' => 'Enter Header Height (default is 88px)',
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/***************** Simple Header Layout *******************/

		/****************** Classic Header Layout *****************/

			$panel_header_classic = conall_edge_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_classic',
					'title' => 'Header Classic',
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
	                    'header-standard',
	                    'header-simple',
	                    'header-divided',
	                    'header-full-screen'
					)
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_classic,
					'name' => 'menu_area_title',
					'title' => 'Menu Area'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'color',
					'name' => 'menu_area_background_color_header_classic',
					'default_value' => '',
					'label' => 'Background Color',
					'description' => 'Set background color for header'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'text',
					'name' => 'menu_area_background_transparency_header_classic',
					'default_value' => '',
					'label' => 'Background Transparency',
					'description' => 'Set background transparency for header',
					'args' => array(
						'col_width' => 3
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'color',
					'name' => 'menu_area_border_color_header_classic',
					'default_value' => '',
					'label' => 'Border Color',
					'description' => 'Set border color for header'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'text',
					'name' => 'logo_area_height_header_classic',
					'default_value' => '',
					'label' => 'Logo Area Height',
					'description' => 'Enter Logo Area Height (default is 102px)',
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent'      => $panel_header_classic,
					'type'        => 'text',
					'name'        => 'logo_area_top_padding_header_classic',
					'label'       => 'Top Padding For Non-Scrolled Logo',
					'description' => 'Enter top padding value to move your logo image down in pixels.',
					'args'        => array(
						'col_width' => 3,
						'suffix'    => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_classic,
					'type' => 'text',
					'name' => 'menu_area_height_header_classic',
					'default_value' => '',
					'label' => 'Menu Area Height',
					'description' => 'Enter Menu Area Height (default is 84px)',
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/****************** Classic Header Layout ******************/

		/***************** Divided Header Layout *******************/

			$panel_header_divided = conall_edge_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_divided',
					'title' => 'Header Divided',
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
	                    'header-standard',
	                    'header-simple',
	                    'header-classic',
	                    'header-full-screen'
					)
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_divided,
					'name' => 'header_divided_title',
					'title' => 'Header Divided'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_divided,
					'type' => 'yesno',
					'name' => 'enable_grid_layout_header_divided',
					'default_value' => 'no',
					'label' => 'Enable Grid Layout',
					'description' => 'Enabling this option you will set divided header area to be in grid',
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_divided,
					'name' => 'menu_area_title',
					'title' => 'Menu Area'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_divided,
					'type' => 'color',
					'name' => 'menu_area_background_color_header_divided',
					'default_value' => '',
					'label' => 'Background Color',
					'description' => 'Set background color for header'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_divided,
					'type' => 'text',
					'name' => 'menu_area_background_transparency_header_divided',
					'default_value' => '',
					'label' => 'Background Transparency',
					'description' => 'Set background transparency for header',
					'args' => array(
						'col_width' => 3
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_divided,
					'type' => 'color',
					'name' => 'menu_area_border_bottom_color_header_divided',
					'default_value' => '',
					'label' => 'Border Bottom Color',
                	'description' => 'Choose a border bottom color for header area',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_divided,
					'type' => 'text',
					'name' => 'menu_area_height_header_divided',
					'default_value' => '',
					'label' => 'Height',
					'description' => 'Enter Header Height (default is 88px)',
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/***************** Divided Header Layout *******************/

		/***************** Full Screen Header Layout *******************/

			$panel_header_full_screen = conall_edge_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header_full_screen',
					'title' => 'Header Full Screen',
					'hidden_property' => 'header_type',
					'hidden_value' => '',
					'hidden_values' => array(
	                    'header-standard',
	                    'header-simple',
	                    'header-classic',
	                    'header-divided'
					)
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_full_screen,
					'name' => 'header_full_screen_title',
					'title' => 'Header Full Screen'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_full_screen,
					'type' => 'yesno',
					'name' => 'enable_grid_layout_header_full_screen',
					'default_value' => 'yes',
					'label' => 'Enable Grid Layout',
					'description' => 'Enabling this option you will set full screen header area to be in grid',
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_header_full_screen,
					'name' => 'menu_area_title',
					'title' => 'Menu Area'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_full_screen,
					'type' => 'color',
					'name' => 'menu_area_background_color_header_full_screen',
					'default_value' => '',
					'label' => 'Background Color',
					'description' => 'Set background color for header'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_full_screen,
					'type' => 'text',
					'name' => 'menu_area_background_transparency_header_full_screen',
					'default_value' => '',
					'label' => 'Background Transparency',
					'description' => 'Set background transparency for header',
					'args' => array(
						'col_width' => 3
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_full_screen,
					'type' => 'color',
					'name' => 'menu_area_border_bottom_color_header_full_screen',
					'default_value' => '',
					'label' => 'Border Bottom Color',
                	'description' => 'Choose a border bottom color for header area',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_header_full_screen,
					'type' => 'text',
					'name' => 'menu_area_height_header_full_screen',
					'default_value' => '',
					'label' => 'Height',
					'description' => 'Enter Header Height (default is 88px)',
					'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
					)
				)
			);

		/***************** Full Screen Header Layout *******************/

        /***************** Sticky Header Layout *******************/

			$panel_sticky_header = conall_edge_add_admin_panel(
				array(
					'title' => 'Sticky Header',
					'name' => 'panel_sticky_header',
					'page' => '_header_page',
					'hidden_property' => 'header_behaviour',
					'hidden_values' => array(
						'fixed-on-scroll'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'name' => 'scroll_amount_for_sticky',
					'type' => 'text',
					'label' => 'Scroll Amount for Sticky',
					'description' => 'Enter scroll amount for Sticky Menu to appear (deafult is header height). This value can be overriden on a page level basis.',
					'parent' => $panel_sticky_header,
					'args' => array(
						'col_width' => 2,
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'name' => 'sticky_header_in_grid',
					'type' => 'yesno',
					'default_value' => 'no',
					'label' => 'Sticky Header in Grid',
					'description' => 'Enabling this option will put sticky header in grid',
					'parent' => $panel_sticky_header,
				)
			);

			conall_edge_add_admin_field(array(
				'name' => 'sticky_header_background_color',
				'type' => 'color',
				'label' => 'Background Color',
				'description' => 'Set background color for sticky header',
				'parent' => $panel_sticky_header
			));

			conall_edge_add_admin_field(array(
				'name' => 'sticky_header_transparency',
				'type' => 'text',
				'label' => 'Background Transparency',
				'description' => 'Enter transparency for sticky header (value from 0 to 1)',
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 1
				)
			));

			conall_edge_add_admin_field(array(
				'name' => 'sticky_header_border_color',
				'type' => 'color',
				'label' => 'Border Color',
				'description' => 'Set bottom border color for sticky header',
				'parent' => $panel_sticky_header
			));

			conall_edge_add_admin_field(
				array(
					'name' => 'sticky_header_shadow',
					'type' => 'yesno',
					'default_value' => 'no',
					'label' => 'Enable Sticky Header Shadow',
					'description' => 'Enabling this option will show sticky header shadow',
					'parent' => $panel_sticky_header,
				)
			);

			conall_edge_add_admin_field(array(
				'name' => 'sticky_header_height',
				'type' => 'text',
				'label' => 'Sticky Header Height',
				'description' => 'Enter height for sticky header (default is 60px)',
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			));

			$group_sticky_header_menu = conall_edge_add_admin_group(array(
				'title' => 'Sticky Header Menu',
				'name' => 'group_sticky_header_menu',
				'parent' => $panel_sticky_header,
				'description' => 'Define styles for sticky menu items',
			));

			$row1_sticky_header_menu = conall_edge_add_admin_row(array(
				'name' => 'row1',
				'parent' => $group_sticky_header_menu
			));

			conall_edge_add_admin_field(array(
				'name' => 'sticky_color',
				'type' => 'colorsimple',
				'label' => 'Text Color',
				'description' => '',
				'parent' => $row1_sticky_header_menu
			));

			conall_edge_add_admin_field(array(
				'name' => 'sticky_hovercolor',
				'type' => 'colorsimple',
				'label' => 'Hover/Active color',
				'description' => '',
				'parent' => $row1_sticky_header_menu
			));

			$row2_sticky_header_menu = conall_edge_add_admin_row(array(
				'name' => 'row2',
				'parent' => $group_sticky_header_menu
			));

			conall_edge_add_admin_field(
				array(
					'name' => 'sticky_google_fonts',
					'type' => 'fontsimple',
					'label' => 'Font Family',
					'default_value' => '-1',
					'parent' => $row2_sticky_header_menu,
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'sticky_fontsize',
					'label' => 'Font Size',
					'default_value' => '',
					'parent' => $row2_sticky_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'sticky_lineheight',
					'label' => 'Line Height',
					'default_value' => '',
					'parent' => $row2_sticky_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'sticky_texttransform',
					'label' => 'Text Transform',
					'default_value' => '',
					'options' => conall_edge_get_text_transform_array(),
					'parent' => $row2_sticky_header_menu
				)
			);

			$row3_sticky_header_menu = conall_edge_add_admin_row(array(
				'name' => 'row3',
				'parent' => $group_sticky_header_menu
			));

			conall_edge_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'sticky_fontstyle',
					'default_value' => '',
					'label' => 'Font Style',
					'options' => conall_edge_get_font_style_array(),
					'parent' => $row3_sticky_header_menu
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'sticky_fontweight',
					'default_value' => '',
					'label' => 'Font Weight',
					'options' => conall_edge_get_font_weight_array(),
					'parent' => $row3_sticky_header_menu
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'sticky_letterspacing',
					'label' => 'Letter Spacing',
					'default_value' => '',
					'parent' => $row3_sticky_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

		/***************** Sticky Header Layout *******************/	

		/***************** Fixed Header Layout ********************/	

			$panel_fixed_header = conall_edge_add_admin_panel(
				array(
					'title' => 'Fixed Header',
					'name' => 'panel_fixed_header',
					'page' => '_header_page',
					'hidden_property' => 'header_behaviour',
					'hidden_values' => array(
						'sticky-header-on-scroll-up', 
						'sticky-header-on-scroll-down-up'
					)
				)
			);

			conall_edge_add_admin_field(array(
				'name' => 'fixed_header_background_color',
				'type' => 'color',
				'default_value' => '',
				'label' => 'Background Color',
				'description' => 'Set background color for fixed header',
				'parent' => $panel_fixed_header
			));

			conall_edge_add_admin_field(array(
				'name' => 'fixed_header_transparency',
				'type' => 'text',
				'label' => 'Background Transparency',
				'description' => 'Enter transparency for fixed header (value from 0 to 1)',
				'parent' => $panel_fixed_header,
				'args' => array(
					'col_width' => 1
				)
			));

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_fixed_header,
					'type' => 'color',
					'name' => 'fixed_header_border_bottom_color',
					'default_value' => '',
					'label' => 'Border Bottom Color',
                	'description' => 'Choose a border bottom color for fixed header area',
				)
			);

			$group_fixed_header_menu = conall_edge_add_admin_group(array(
				'title' => 'Fixed Header Menu',
				'name' => 'group_fixed_header_menu',
				'parent' => $panel_fixed_header,
				'description' => 'Define styles for fixed menu items',
			));

			$row1_fixed_header_menu = conall_edge_add_admin_row(array(
				'name' => 'row1',
				'parent' => $group_fixed_header_menu
			));

			conall_edge_add_admin_field(array(
				'name' => 'fixed_color',
				'type' => 'colorsimple',
				'label' => 'Text Color',
				'description' => '',
				'parent' => $row1_fixed_header_menu
			));

			conall_edge_add_admin_field(array(
				'name' => 'fixed_hovercolor',
				'type' => 'colorsimple',
				'label' => 'Hover/Active color',
				'description' => '',
				'parent' => $row1_fixed_header_menu
			));

			$row2_fixed_header_menu = conall_edge_add_admin_row(array(
				'name' => 'row2',
				'parent' => $group_fixed_header_menu
			));

			conall_edge_add_admin_field(
				array(
					'name' => 'fixed_google_fonts',
					'type' => 'fontsimple',
					'label' => 'Font Family',
					'default_value' => '-1',
					'parent' => $row2_fixed_header_menu,
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'fixed_fontsize',
					'label' => 'Font Size',
					'default_value' => '',
					'parent' => $row2_fixed_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'fixed_lineheight',
					'label' => 'Line Height',
					'default_value' => '',
					'parent' => $row2_fixed_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'fixed_texttransform',
					'label' => 'Text Transform',
					'default_value' => '',
					'options' => conall_edge_get_text_transform_array(),
					'parent' => $row2_fixed_header_menu
				)
			);

			$row3_fixed_header_menu = conall_edge_add_admin_row(array(
				'name' => 'row3',
				'parent' => $group_fixed_header_menu
			));

			conall_edge_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'fixed_fontstyle',
					'default_value' => '',
					'label' => 'Font Style',
					'options' => conall_edge_get_font_style_array(),
					'parent' => $row3_fixed_header_menu
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'selectblanksimple',
					'name' => 'fixed_fontweight',
					'default_value' => '',
					'label' => 'Font Weight',
					'options' => conall_edge_get_font_weight_array(),
					'parent' => $row3_fixed_header_menu
				)
			);

			conall_edge_add_admin_field(
				array(
					'type' => 'textsimple',
					'name' => 'fixed_letterspacing',
					'label' => 'Letter Spacing',
					'default_value' => '',
					'parent' => $row3_fixed_header_menu,
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

		/***************** Fixed Header Layout ********************/	

		/******************* Main Menu Layout *********************/

			$panel_main_menu = conall_edge_add_admin_panel(
				array(
					'title' => 'Main Menu',
					'name' => 'panel_main_menu',
					'page' => '_header_page',
				)
			);

			conall_edge_add_admin_section_title(
				array(
					'parent' => $panel_main_menu,
					'name' => 'main_menu_area_title',
					'title' => 'Main Menu General Settings'
				)
			);

			$drop_down_group = conall_edge_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'drop_down_group',
					'title' => 'Main Dropdown Menu',
					'description' => 'Choose a color and transparency for the main menu background (0 = fully transparent, 1 = opaque)'
				)
			);

			$drop_down_row1 = conall_edge_add_admin_row(
				array(
					'parent' => $drop_down_group,
					'name' => 'drop_down_row1',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $drop_down_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_background_color',
					'default_value' => '',
					'label' => 'Background Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $drop_down_row1,
					'type' => 'textsimple',
					'name' => 'dropdown_background_transparency',
					'default_value' => '',
					'label' => 'Background Transparency',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_main_menu,
					'type' => 'select',
					'name' => 'menu_dropdown_appearance',
					'default_value' => 'default',
					'label' => 'Main Dropdown Menu Appearance',
					'description' => 'Choose appearance for dropdown menu',
					'options' => array(
						'dropdown-default' => 'Default',
						'dropdown-slide-from-bottom' => 'Slide From Bottom',
						'dropdown-slide-from-top' => 'Slide From Top',
						'dropdown-animate-height' => 'Animate Height',
						'dropdown-slide-from-left' => 'Slide From Left'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $panel_main_menu,
					'type' => 'text',
					'name' => 'dropdown_top_position',
					'default_value' => '',
					'label' => 'Dropdown Position',
					'description' => 'Enter value in percentage of entire header height',
					'args' => array(
						'col_width' => 3,
						'suffix' => '%'
					)
				)
			);

			$first_level_group = conall_edge_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'first_level_group',
					'title' => '1st Level Menu',
					'description' => 'Define styles for 1st level in Top Navigation Menu'
				)
			);

			$first_level_row1 = conall_edge_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row1'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'colorsimple',
					'name' => 'menu_color',
					'default_value' => '',
					'label' => 'Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'colorsimple',
					'name' => 'menu_hovercolor',
					'default_value' => '',
					'label' => 'Hover Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'colorsimple',
					'name' => 'menu_activecolor',
					'default_value' => '',
					'label' => 'Active Text Color',
				)
			);

			$first_level_row3 = conall_edge_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row3',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row3,
					'type' => 'colorsimple',
					'name' => 'menu_light_hovercolor',
					'default_value' => '',
					'label' => 'Light Menu Hover Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row3,
					'type' => 'colorsimple',
					'name' => 'menu_light_activecolor',
					'default_value' => '',
					'label' => 'Light Menu Active Text Color',
				)
			);

			$first_level_row4 = conall_edge_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row4',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row4,
					'type' => 'colorsimple',
					'name' => 'menu_dark_hovercolor',
					'default_value' => '',
					'label' => 'Dark Menu Hover Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row4,
					'type' => 'colorsimple',
					'name' => 'menu_dark_activecolor',
					'default_value' => '',
					'label' => 'Dark Menu Active Text Color',
				)
			);

			$first_level_row5 = conall_edge_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row5',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row5,
					'type' => 'fontsimple',
					'name' => 'menu_google_fonts',
					'default_value' => '-1',
					'label' => 'Font Family',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row5,
					'type' => 'textsimple',
					'name' => 'menu_fontsize',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row5,
					'type' => 'textsimple',
					'name' => 'menu_lineheight',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$first_level_row6 = conall_edge_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row6',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'selectblanksimple',
					'name' => 'menu_fontstyle',
					'default_value' => '',
					'label' => 'Font Style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'selectblanksimple',
					'name' => 'menu_fontweight',
					'default_value' => '',
					'label' => 'Font Weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'textsimple',
					'name' => 'menu_letterspacing',
					'default_value' => '',
					'label' => 'Letter Spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row6,
					'type' => 'selectblanksimple',
					'name' => 'menu_texttransform',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

			$first_level_row7 = conall_edge_add_admin_row(
				array(
					'parent' => $first_level_group,
					'name' => 'first_level_row7',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row7,
					'type' => 'textsimple',
					'name' => 'menu_padding_left_right',
					'default_value' => '',
					'label' => 'Padding Left/Right',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row7,
					'type' => 'textsimple',
					'name' => 'menu_margin_left_right',
					'default_value' => '',
					'label' => 'Margin Left/Right',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$second_level_group = conall_edge_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'second_level_group',
					'title' => '2nd Level Menu',
					'description' => 'Define styles for 2nd level in Top Navigation Menu'
				)
			);

			$second_level_row1 = conall_edge_add_admin_row(
				array(
					'parent' => $second_level_group,
					'name' => 'second_level_row1'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_color',
					'default_value' => '',
					'label' => 'Text Color'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_hovercolor',
					'default_value' => '',
					'label' => 'Hover/Active Color'
				)
			);

			$second_level_row2 = conall_edge_add_admin_row(
				array(
					'parent' => $second_level_group,
					'name' => 'second_level_row2',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_google_fonts',
					'default_value' => '-1',
					'label' => 'Font Family'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_fontsize',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_lineheight',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$second_level_row3 = conall_edge_add_admin_row(
				array(
					'parent' => $second_level_group,
					'name' => 'second_level_row3',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_fontstyle',
					'default_value' => '',
					'label' => 'Font style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_fontweight',
					'default_value' => '',
					'label' => 'Font weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_letterspacing',
					'default_value' => '',
					'label' => 'Letter spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_texttransform',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

			$second_level_wide_group = conall_edge_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'second_level_wide_group',
					'title' => '2nd Level Wide Menu',
					'description' => 'Define styles for 2nd level in Wide Menu'
				)
			);

			$second_level_wide_row1 = conall_edge_add_admin_row(
				array(
					'parent' => $second_level_wide_group,
					'name' => 'second_level_wide_row1'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_color',
					'default_value' => '',
					'label' => 'Text Color'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_hovercolor',
					'default_value' => '',
					'label' => 'Hover/Active Color'
				)
			);

			$second_level_wide_row2 = conall_edge_add_admin_row(
				array(
					'parent' => $second_level_wide_group,
					'name' => 'second_level_wide_row2',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_wide_google_fonts',
					'default_value' => '-1',
					'label' => 'Font Family'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_fontsize',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_lineheight',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$second_level_wide_row3 = conall_edge_add_admin_row(
				array(
					'parent' => $second_level_wide_group,
					'name' => 'second_level_wide_row3',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_fontstyle',
					'default_value' => '',
					'label' => 'Font style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_fontweight',
					'default_value' => '',
					'label' => 'Font weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_letterspacing',
					'default_value' => '',
					'label' => 'Letter spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_texttransform',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

			$third_level_group = conall_edge_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'third_level_group',
					'title' => '3nd Level Menu',
					'description' => 'Define styles for 3nd level in Top Navigation Menu'
				)
			);

			$third_level_row1 = conall_edge_add_admin_row(
				array(
					'parent' => $third_level_group,
					'name' => 'third_level_row1'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_color_thirdlvl',
					'default_value' => '',
					'label' => 'Text Color'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_hovercolor_thirdlvl',
					'default_value' => '',
					'label' => 'Hover/Active Color'
				)
			);

			$third_level_row2 = conall_edge_add_admin_row(
				array(
					'parent' => $third_level_group,
					'name' => 'third_level_row2',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_google_fonts_thirdlvl',
					'default_value' => '-1',
					'label' => 'Font Family'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_fontsize_thirdlvl',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_lineheight_thirdlvl',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$third_level_row3 = conall_edge_add_admin_row(
				array(
					'parent' => $third_level_group,
					'name' => 'third_level_row3',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_fontstyle_thirdlvl',
					'default_value' => '',
					'label' => 'Font style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_fontweight_thirdlvl',
					'default_value' => '',
					'label' => 'Font weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_letterspacing_thirdlvl',
					'default_value' => '',
					'label' => 'Letter spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_texttransform_thirdlvl',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

			$third_level_wide_group = conall_edge_add_admin_group(
				array(
					'parent' => $panel_main_menu,
					'name' => 'third_level_wide_group',
					'title' => '3rd Level Wide Menu',
					'description' => 'Define styles for 3rd level in Wide Menu'
				)
			);

			$third_level_wide_row1 = conall_edge_add_admin_row(
				array(
					'parent' => $third_level_wide_group,
					'name' => 'third_level_wide_row1'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_color_thirdlvl',
					'default_value' => '',
					'label' => 'Text Color'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row1,
					'type' => 'colorsimple',
					'name' => 'dropdown_wide_hovercolor_thirdlvl',
					'default_value' => '',
					'label' => 'Hover/Active Color'
				)
			);

			$third_level_wide_row2 = conall_edge_add_admin_row(
				array(
					'parent' => $third_level_wide_group,
					'name' => 'third_level_wide_row2',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row2,
					'type' => 'fontsimple',
					'name' => 'dropdown_wide_google_fonts_thirdlvl',
					'default_value' => '-1',
					'label' => 'Font Family'
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_fontsize_thirdlvl',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row2,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_lineheight_thirdlvl',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			$third_level_wide_row3 = conall_edge_add_admin_row(
				array(
					'parent' => $third_level_wide_group,
					'name' => 'third_level_wide_row3',
					'next' => true
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_fontstyle_thirdlvl',
					'default_value' => '',
					'label' => 'Font style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_fontweight_thirdlvl',
					'default_value' => '',
					'label' => 'Font weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'textsimple',
					'name' => 'dropdown_wide_letterspacing_thirdlvl',
					'default_value' => '',
					'label' => 'Letter spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_wide_row3,
					'type' => 'selectblanksimple',
					'name' => 'dropdown_wide_texttransform_thirdlvl',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

        /******************* Main Menu Layout *********************/
	}

	add_action( 'conall_edge_options_map', 'conall_edge_header_options_map', 4);
}