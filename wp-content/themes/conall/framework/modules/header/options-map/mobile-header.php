<?php

if ( ! function_exists('conall_edge_mobile_header_options_map') ) {

	function conall_edge_mobile_header_options_map() {

		conall_edge_add_admin_page(array(
			'slug'  => '_mobile_header',
			'title' => 'Mobile Header',
			'icon'  => 'fa fa-mobile'
		));

		$panel_mobile_header = conall_edge_add_admin_panel(array(
			'title' => 'Mobile header',
			'name'  => 'panel_mobile_header',
			'page'  => '_mobile_header'
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_header_height',
			'type'        => 'text',
			'label'       => 'Mobile Header Height',
			'description' => 'Enter height for mobile header in pixels',
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_header_background_color',
			'type'        => 'color',
			'label'       => 'Mobile Header Background Color',
			'description' => 'Choose background color for mobile header',
			'parent'      => $panel_mobile_header
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_header_border_bottom_color',
			'type'        => 'color',
			'label'       => 'Mobile Header Border Bottom Color',
			'description' => 'Choose border bottom color for mobile header',
			'parent'      => $panel_mobile_header
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_menu_background_color',
			'type'        => 'color',
			'label'       => 'Mobile Menu Background Color',
			'description' => 'Choose background color for mobile menu',
			'parent'      => $panel_mobile_header
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_menu_border_bottom_color',
			'type'        => 'color',
			'label'       => 'Mobile Menu Border Bottom Color',
			'description' => 'Choose border bottom color for mobile menu',
			'parent'      => $panel_mobile_header
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_menu_separator_color',
			'type'        => 'color',
			'label'       => 'Mobile Menu Item Separator Color',
			'description' => 'Choose color for mobile menu horizontal separators',
			'parent'      => $panel_mobile_header
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => 'Logo Height For Mobile Header',
			'description' => 'Define logo height for screen size smaller than 1000px',
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => 'Logo Height For Mobile Devices',
			'description' => 'Define logo height for screen size smaller than 480px',
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		conall_edge_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title'  => 'Typography'
		));

		$first_level_group = conall_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'first_level_group',
				'title' => '1st Level Menu',
				'description' => 'Define styles for 1st level in Mobile Menu Navigation'
			)
		);

		$first_level_row1 = conall_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row1'
			)
		);

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'colorsimple',
			'label'       => 'Navigation Text Color',
			'description' => 'Define color for mobile navigation text',
			'parent'      => $first_level_row1
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => 'Navigation Hover/Active Color',
			'description' => 'Define hover/active color for mobile navigation text',
			'parent'      => $first_level_row1
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_font_family',
			'type'        => 'fontsimple',
			'label'       => 'Navigation Font Family',
			'description' => 'Define font family for mobile navigation text',
			'parent'      => $first_level_row1
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'textsimple',
			'label'       => 'Navigation Font Size',
			'description' => 'Define font size for mobile navigation text',
			'parent'      => $first_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$first_level_row2 = conall_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row2'
			)
		);

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'textsimple',
			'label'       => 'Navigation Line Height',
			'description' => 'Define line height for mobile navigation text',
			'parent'      => $first_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'selectsimple',
			'label'       => 'Navigation Text Transform',
			'description' => 'Define text transform for mobile navigation text',
			'parent'      => $first_level_row2,
			'options'     => conall_edge_get_text_transform_array(true)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'selectsimple',
			'label'       => 'Navigation Font Style',
			'description' => 'Define font style for mobile navigation text',
			'parent'      => $first_level_row2,
			'options'     => conall_edge_get_font_style_array(true)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'selectsimple',
			'label'       => 'Navigation Font Weight',
			'description' => 'Define font weight for mobile navigation text',
			'parent'      => $first_level_row2,
			'options'     => conall_edge_get_font_weight_array(true)
		));

		$second_level_group = conall_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'second_level_group',
				'title' => 'Dropdown Menu',
				'description' => 'Define styles for 1st level in Mobile Menu Navigation'
			)
		);

		$second_level_row1 = conall_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row1'
			)
		);

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_color',
			'type'        => 'colorsimple',
			'label'       => 'Navigation Text Color',
			'description' => 'Define color for mobile navigation text',
			'parent'      => $second_level_row1
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => 'Navigation Hover/Active Color',
			'description' => 'Define hover/active color for mobile navigation text',
			'parent'      => $second_level_row1
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_family',
			'type'        => 'fontsimple',
			'label'       => 'Navigation Font Family',
			'description' => 'Define font family for mobile navigation text',
			'parent'      => $second_level_row1
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_size',
			'type'        => 'textsimple',
			'label'       => 'Navigation Font Size',
			'description' => 'Define font size for mobile navigation text',
			'parent'      => $second_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$second_level_row2 = conall_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row2'
			)
		);

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_line_height',
			'type'        => 'textsimple',
			'label'       => 'Navigation Line Height',
			'description' => 'Define line height for mobile navigation text',
			'parent'      => $second_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_transform',
			'type'        => 'selectsimple',
			'label'       => 'Navigation Text Transform',
			'description' => 'Define text transform for mobile navigation text',
			'parent'      => $second_level_row2,
			'options'     => conall_edge_get_text_transform_array(true)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_style',
			'type'        => 'selectsimple',
			'label'       => 'Navigation Font Style',
			'description' => 'Define font style for mobile navigation text',
			'parent'      => $second_level_row2,
			'options'     => conall_edge_get_font_style_array(true)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_weight',
			'type'        => 'selectsimple',
			'label'       => 'Navigation Font Weight',
			'description' => 'Define font weight for mobile navigation text',
			'parent'      => $second_level_row2,
			'options'     => conall_edge_get_font_weight_array(true)
		));

		conall_edge_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => 'Mobile Menu Opener'
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_icon_pack',
			'type'        => 'select',
			'label'       => 'Mobile Navigation Icon Pack',
			'default_value' => 'font_awesome',
			'description' => 'Choose icon pack for mobile navigation icon',
			'parent'      => $panel_mobile_header,
			'options'     => conall_edge_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'simple_line_icons'))
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => 'Mobile Navigation Icon Color',
			'description' => 'Choose color for icon header',
			'parent'      => $panel_mobile_header
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => 'Mobile Navigation Icon Hover Color',
			'description' => 'Choose hover color for mobile navigation icon ',
			'parent'      => $panel_mobile_header
		));

		conall_edge_add_admin_field(array(
			'name'        => 'mobile_icon_size',
			'type'        => 'text',
			'label'       => 'Mobile Navigation Icon size',
			'description' => 'Choose size for mobile navigation icon ',
			'parent'      => $panel_mobile_header,
			'args' => array(
				'col_width' => 3,
				'suffix' => 'px'
			)
		));

	}

	add_action( 'conall_edge_options_map', 'conall_edge_mobile_header_options_map', 5);
}