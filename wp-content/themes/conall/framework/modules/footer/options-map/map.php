<?php

if ( ! function_exists('conall_edge_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function conall_edge_footer_options_map() {

		conall_edge_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => 'Footer',
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = conall_edge_add_admin_panel(
			array(
				'title' => 'Footer',
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'uncovering_footer',
				'default_value' => 'no',
				'label' => 'Uncovering Footer',
				'description' => 'Enabling this option will make Footer gradually appear on scroll',
				'parent' => $footer_panel,
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'no',
				'label' => 'Footer in Grid',
				'description' => 'Enabling this option will place Footer content in grid',
				'parent' => $footer_panel,
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => 'Show Footer Top',
				'description' => 'Enabling this option will show Footer Top area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = conall_edge_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'default_value' => '4',
				'label' => 'Footer Top Columns',
				'description' => 'Choose number of columns for Footer Top area',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '3(25%+25%+50%)',
					'6' => '3(50%+25%+25%)'
				),
				'parent' => $show_footer_top_container,
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => '',
				'label' => 'Footer Top Columns Alignment',
				'description' => 'Text Alignment in Footer Columns',
				'options' => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right'
				),
				'parent' => $show_footer_top_container,
			)
		);

		conall_edge_add_admin_field(array(
			'name' => 'footer_top_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for top footer area',
			'parent' => $show_footer_top_container
		));

		conall_edge_add_admin_field(array(
			'name' => 'footer_top_padding_top',
			'type' => 'text',
			'label' => 'Padding Top',
			'description' => 'Enter footer top padding (Default is 68)',
			'parent' => $show_footer_top_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		conall_edge_add_admin_field(array(
			'name' => 'footer_top_padding_bottom',
			'type' => 'text',
			'label' => 'Padding Bottom',
			'description' => 'Enter footer bottom padding (Default is 70)',
			'parent' => $show_footer_top_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		$first_level_group = conall_edge_add_admin_group(
			array(
				'parent' => $show_footer_top_container,
				'name' => 'first_level_group',
				'title' => 'Widget Title Style',
				'description' => 'Define styles for widgets title'
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
					'name' => 'footer_title_color',
					'default_value' => '',
					'label' => 'Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'fontsimple',
					'name' => 'footer_title_google_fonts',
					'default_value' => '-1',
					'label' => 'Font Family',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'textsimple',
					'name' => 'footer_title_fontsize',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row1,
					'type' => 'textsimple',
					'name' => 'footer_title_lineheight',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

		$first_level_row2 = conall_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row2',
				'next' => true
			)
		);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_title_fontstyle',
					'default_value' => '',
					'label' => 'Font Style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_title_fontweight',
					'default_value' => '',
					'label' => 'Font Weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row2,
					'type' => 'textsimple',
					'name' => 'footer_title_letterspacing',
					'default_value' => '',
					'label' => 'Letter Spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $first_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_title_texttransform',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

		$second_level_group = conall_edge_add_admin_group(
			array(
				'parent' => $show_footer_top_container,
				'name' => 'second_level_group',
				'title' => 'Widget Text Style',
				'description' => 'Define styles for widgets text'
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
					'name' => 'footer_top_text_color',
					'default_value' => '',
					'label' => 'Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row1,
					'type' => 'fontsimple',
					'name' => 'footer_top_text_google_fonts',
					'default_value' => '-1',
					'label' => 'Font Family',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row1,
					'type' => 'textsimple',
					'name' => 'footer_top_text_fontsize',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row1,
					'type' => 'textsimple',
					'name' => 'footer_top_text_lineheight',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
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
					'type' => 'selectblanksimple',
					'name' => 'footer_top_text_fontstyle',
					'default_value' => '',
					'label' => 'Font Style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_top_text_fontweight',
					'default_value' => '',
					'label' => 'Font Weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'textsimple',
					'name' => 'footer_top_text_letterspacing',
					'default_value' => '',
					'label' => 'Letter Spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $second_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_top_text_texttransform',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);	

		$third_level_group = conall_edge_add_admin_group(
			array(
				'parent' => $show_footer_top_container,
				'name' => 'third_level_group',
				'title' => 'Widget Link Style',
				'description' => 'Define styles for widgets link'
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
					'name' => 'footer_top_link_color',
					'default_value' => '',
					'label' => 'Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row1,
					'type' => 'colorsimple',
					'name' => 'footer_top_link_hover_color',
					'default_value' => '',
					'label' => 'Text Hover Color',
				)
			);

		$third_level_row2 = conall_edge_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name' => 'third_level_row2'
			)
		);	

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'fontsimple',
					'name' => 'footer_top_link_google_fonts',
					'default_value' => '-1',
					'label' => 'Font Family',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row2,
					'type' => 'textsimple',
					'name' => 'footer_top_link_fontsize',
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
					'name' => 'footer_top_link_lineheight',
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
					'name' => 'footer_top_link_fontstyle',
					'default_value' => '',
					'label' => 'Font Style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'footer_top_link_fontweight',
					'default_value' => '',
					'label' => 'Font Weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'textsimple',
					'name' => 'footer_top_link_letterspacing',
					'default_value' => '',
					'label' => 'Letter Spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $third_level_row3,
					'type' => 'selectblanksimple',
					'name' => 'footer_top_link_texttransform',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

		conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => 'Show Footer Bottom',
				'description' => 'Enabling this option will show Footer Bottom area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = conall_edge_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '2',
				'label' => 'Footer Bottom Columns',
				'description' => 'Choose number of columns for Footer Bottom area',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

		conall_edge_add_admin_field(array(
			'name' => 'footer_bottom_height',
			'type' => 'text',
			'label' => 'Height',
			'description' => 'Enter footer bottom bar height (Default is 60)',
			'parent' => $show_footer_bottom_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		conall_edge_add_admin_field(array(
			'name' => 'footer_bottom_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for bottom footer area',
			'parent' => $show_footer_bottom_container
		));

		conall_edge_add_admin_field(array(
			'name' => 'footer_bottom_border_top_color',
			'type' => 'color',
			'label' => 'Border Top Color',
			'description' => 'Set border top color for bottom footer area',
			'parent' => $show_footer_bottom_container
		));

		$fourth_level_group = conall_edge_add_admin_group(
			array(
				'parent' => $show_footer_bottom_container,
				'name' => 'fourth_level_group',
				'title' => 'Widget Text Style',
				'description' => 'Define styles for widgets text'
			)
		);

		$fourth_level_row1 = conall_edge_add_admin_row(
			array(
				'parent' => $fourth_level_group,
				'name' => 'fourth_level_row1'
			)
		);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row1,
					'type' => 'colorsimple',
					'name' => 'footer_bottom_text_color',
					'default_value' => '',
					'label' => 'Text Color',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row1,
					'type' => 'fontsimple',
					'name' => 'footer_bottom_text_google_fonts',
					'default_value' => '-1',
					'label' => 'Font Family',
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row1,
					'type' => 'textsimple',
					'name' => 'footer_bottom_text_fontsize',
					'default_value' => '',
					'label' => 'Font Size',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row1,
					'type' => 'textsimple',
					'name' => 'footer_bottom_text_lineheight',
					'default_value' => '',
					'label' => 'Line Height',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

		$fourth_level_row2 = conall_edge_add_admin_row(
			array(
				'parent' => $fourth_level_group,
				'name' => 'fourth_level_row2',
				'next' => true
			)
		);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_bottom_text_fontstyle',
					'default_value' => '',
					'label' => 'Font Style',
					'options' => conall_edge_get_font_style_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_bottom_text_fontweight',
					'default_value' => '',
					'label' => 'Font Weight',
					'options' => conall_edge_get_font_weight_array()
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row2,
					'type' => 'textsimple',
					'name' => 'footer_bottom_text_letterspacing',
					'default_value' => '',
					'label' => 'Letter Spacing',
					'args' => array(
						'suffix' => 'px'
					)
				)
			);

			conall_edge_add_admin_field(
				array(
					'parent' => $fourth_level_row2,
					'type' => 'selectblanksimple',
					'name' => 'footer_bottom_text_texttransform',
					'default_value' => '',
					'label' => 'Text Transform',
					'options' => conall_edge_get_text_transform_array()
				)
			);

	}

	add_action( 'conall_edge_options_map', 'conall_edge_footer_options_map', 11);
}