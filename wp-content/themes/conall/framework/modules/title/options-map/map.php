<?php

if ( ! function_exists('conall_edge_title_options_map') ) {

	function conall_edge_title_options_map() {

		conall_edge_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => 'Title',
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = conall_edge_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => 'Title Settings'
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'show_title_area',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => 'Show Title Area',
				'description' => 'This option will enable/disable Title Area',
				'parent' => $panel_title,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgtf_show_title_area_container"
				)
			)
		);

		$show_title_area_container = conall_edge_add_admin_container(
			array(
				'parent' => $panel_title,
				'name' => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value' => 'no'
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_type',
				'type' => 'select',
				'default_value' => 'standard',
				'label' => 'Title Area Type',
				'description' => 'Choose title type',
				'parent' => $show_title_area_container,
				'options' => array(
					'standard' => 'Standard',
					'breadcrumb' => 'Breadcrumb'
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"standard" => "",
						"breadcrumb" => "#edgtf_title_area_type_container"
					),
					"show" => array(
						"standard" => "#edgtf_title_area_type_container",
						"breadcrumb" => ""
					)
				)
			)
		);

		$title_area_type_container = conall_edge_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_type_container',
				'hidden_property' => 'title_area_type',
				'hidden_value' => '',
				'hidden_values' => array('breadcrumb'),
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_enable_breadcrumbs',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Enable Breadcrumbs',
				'description' => 'This option will display Breadcrumbs in Title Area',
				'parent' => $title_area_type_container,
			)
		);

        conall_edge_add_admin_field(
            array(
                'name' => 'title_predefined_size',
                'type' => 'select',
                'default_value' => 'small',
                'label' => 'Predefined Title Size',
                'description' => 'Choose Title Predefined size',
                'parent' => $title_area_type_container,
                'options' => array(
                    'small' => 'Small',
                    'medium' => 'Medium',
                    'large' => 'Large'
                )
            )
        );

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_animation',
				'type' => 'select',
				'default_value' => 'no',
				'label' => 'Animations',
				'description' => 'Choose an animation for Title Area',
				'parent' => $show_title_area_container,
				'options' => array(
					'no' => 'No Animation',
					'right-left' => 'Text right to left',
					'left-right' => 'Text left to right'
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_vertial_alignment',
				'type' => 'select',
				'default_value' => 'header_bottom',
				'label' => 'Vertical Alignment',
				'description' => 'Specify title vertical alignment',
				'parent' => $show_title_area_container,
				'options' => array(
					'header_bottom' => 'From Bottom of Header',
					'window_top' => 'From Window Top'
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_content_alignment',
				'type' => 'select',
				'default_value' => 'left',
				'label' => 'Horizontal Alignment',
				'description' => 'Specify title horizontal alignment',
				'parent' => $show_title_area_container,
				'options' => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right'
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_background_color',
				'type' => 'color',
				'label' => 'Background Color',
				'description' => 'Choose a background color for Title Area',
				'parent' => $show_title_area_container
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_background_image',
				'type' => 'image',
				'label' => 'Background Image',
				'description' => 'Choose an Image for Title Area',
				'parent' => $show_title_area_container
			)
		);

        conall_edge_add_admin_field(
            array(
                'name' => 'title_area_background_overlay',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Background Gradient Overlay',
                'description' => 'Place gradient overlay for Title Area',
                'parent' => $show_title_area_container
            )
        );

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_background_image_responsive',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Background Responsive Image',
				'description' => 'Enabling this option will make Title background image responsive',
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#edgtf_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = conall_edge_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value' => 'yes'
			)
		);

		conall_edge_add_admin_field(
			array(
				'name' => 'title_area_background_image_parallax',
				'type' => 'select',
				'default_value' => 'no',
				'label' => 'Background Image in Parallax',
				'description' => 'Enabling this option will make Title background image parallax',
				'parent' => $title_area_background_image_responsive_container,
				'options' => array(
					'no' => 'No',
					'yes' => 'Yes',
					'yes_zoom' => 'Yes, with zoom out'
				)
			)
		);

		conall_edge_add_admin_field(array(
			'name' => 'title_area_height',
			'type' => 'text',
			'label' => 'Height',
			'description' => 'Set a height for Title Area',
			'parent' => $title_area_background_image_responsive_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));


		$panel_typography = conall_edge_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title_typography',
				'title' => 'Typography'
			)
		);

        conall_edge_add_admin_section_title(array(
            'name' => 'type_section_title',
            'title' => 'Title',
            'parent' => $panel_typography
        ));

        $group_page_title_styles = conall_edge_add_admin_group(array(
			'name'			=> 'group_page_title_styles',
			'title'			=> 'Small Size Type',
			'description'	=> 'Define styles for page title small type',
			'parent'		=> $panel_typography
		));

		$row_page_title_styles_1 = conall_edge_add_admin_row(array(
			'name'		=> 'row_page_title_styles_1',
			'parent'	=> $group_page_title_styles
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_color',
			'default_value'	=> '',
			'label'			=> 'Text Color',
			'parent'		=> $row_page_title_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_fontsize',
			'default_value'	=> '',
			'label'			=> 'Font Size',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_lineheight',
			'default_value'	=> '',
			'label'			=> 'Line Height',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_texttransform',
			'default_value'	=> '',
			'label'			=> 'Text Transform',
			'options'		=> conall_edge_get_text_transform_array(),
			'parent'		=> $row_page_title_styles_1
		));

		$row_page_title_styles_2 = conall_edge_add_admin_row(array(
			'name'		=> 'row_page_title_styles_2',
			'parent'	=> $group_page_title_styles,
			'next'		=> true
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_title_google_fonts',
			'default_value'	=> '-1',
			'label'			=> 'Font Family',
			'parent'		=> $row_page_title_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontstyle',
			'default_value'	=> '',
			'label'			=> 'Font Style',
			'options'		=> conall_edge_get_font_style_array(),
			'parent'		=> $row_page_title_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontweight',
			'default_value'	=> '',
			'label'			=> 'Font Weight',
			'options'		=> conall_edge_get_font_weight_array(),
			'parent'		=> $row_page_title_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_letter_spacing',
			'default_value'	=> '',
			'label'			=> 'Letter Spacing',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_2
		));

        $group_page_title_medium_styles = conall_edge_add_admin_group(array(
            'name'			=> 'group_page_title_medium_styles',
            'title'			=> 'Normal Size Type',
            'description'	=> 'Define styles for page title normal type',
            'parent'		=> $panel_typography
        ));

        $row_page_title_medium_styles_1 = conall_edge_add_admin_row(array(
            'name'		=> 'row_page_title_medium_styles_1',
            'parent'	=> $group_page_title_medium_styles
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'colorsimple',
            'name'			=> 'page_title_medium_color',
            'default_value'	=> '',
            'label'			=> 'Text Color',
            'parent'		=> $row_page_title_medium_styles_1
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_title_medium_fontsize',
            'default_value'	=> '',
            'label'			=> 'Font Size',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_page_title_medium_styles_1
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_title_medium_lineheight',
            'default_value'	=> '',
            'label'			=> 'Line Height',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_page_title_medium_styles_1
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_title_medium_texttransform',
            'default_value'	=> '',
            'label'			=> 'Text Transform',
            'options'		=> conall_edge_get_text_transform_array(),
            'parent'		=> $row_page_title_medium_styles_1
        ));

        $row_page_title_medium_styles_2 = conall_edge_add_admin_row(array(
            'name'		=> 'row_page_title_medium_styles_2',
            'parent'	=> $group_page_title_medium_styles,
            'next'		=> true
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'fontsimple',
            'name'			=> 'page_title_medium_google_fonts',
            'default_value'	=> '-1',
            'label'			=> 'Font Family',
            'parent'		=> $row_page_title_medium_styles_2
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_title_medium_fontstyle',
            'default_value'	=> '',
            'label'			=> 'Font Style',
            'options'		=> conall_edge_get_font_style_array(),
            'parent'		=> $row_page_title_medium_styles_2
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_title_medium_fontweight',
            'default_value'	=> '',
            'label'			=> 'Font Weight',
            'options'		=> conall_edge_get_font_weight_array(),
            'parent'		=> $row_page_title_medium_styles_2
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_title_medium_letter_spacing',
            'default_value'	=> '',
            'label'			=> 'Letter Spacing',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_page_title_medium_styles_2
        ));

        $group_page_title_large_styles = conall_edge_add_admin_group(array(
            'name'			=> 'group_page_title_large_styles',
            'title'			=> 'Large Size Type',
            'description'	=> 'Define styles for page title large type',
            'parent'		=> $panel_typography
        ));

        $row_page_title_large_styles_1 = conall_edge_add_admin_row(array(
            'name'		=> 'row_page_title_large_styles_1',
            'parent'	=> $group_page_title_large_styles
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'colorsimple',
            'name'			=> 'page_title_large_color',
            'default_value'	=> '',
            'label'			=> 'Text Color',
            'parent'		=> $row_page_title_large_styles_1
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_title_large_fontsize',
            'default_value'	=> '',
            'label'			=> 'Font Size',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_page_title_large_styles_1
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_title_large_lineheight',
            'default_value'	=> '',
            'label'			=> 'Line Height',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_page_title_large_styles_1
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_title_large_texttransform',
            'default_value'	=> '',
            'label'			=> 'Text Transform',
            'options'		=> conall_edge_get_text_transform_array(),
            'parent'		=> $row_page_title_large_styles_1
        ));

        $row_page_title_large_styles_2 = conall_edge_add_admin_row(array(
            'name'		=> 'row_page_title_large_styles_2',
            'parent'	=> $group_page_title_large_styles,
            'next'		=> true
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'fontsimple',
            'name'			=> 'page_title_large_google_fonts',
            'default_value'	=> '-1',
            'label'			=> 'Font Family',
            'parent'		=> $row_page_title_large_styles_2
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_title_large_fontstyle',
            'default_value'	=> '',
            'label'			=> 'Font Style',
            'options'		=> conall_edge_get_font_style_array(),
            'parent'		=> $row_page_title_large_styles_2
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_title_large_fontweight',
            'default_value'	=> '',
            'label'			=> 'Font Weight',
            'options'		=> conall_edge_get_font_weight_array(),
            'parent'		=> $row_page_title_large_styles_2
        ));

        conall_edge_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_title_large_letter_spacing',
            'default_value'	=> '',
            'label'			=> 'Letter Spacing',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_page_title_large_styles_2
        ));

        conall_edge_add_admin_section_title(array(
            'name' => 'type_section_subtitle',
            'title' => 'Subtitle',
            'parent' => $panel_typography
        ));

		$group_page_subtitle_styles = conall_edge_add_admin_group(array(
			'name'			=> 'group_page_subtitle_styles',
			'title'			=> 'Subtitle',
			'description'	=> 'Define styles for page subtitle',
			'parent'		=> $panel_typography
		));

		$row_page_subtitle_styles_1 = conall_edge_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_1',
			'parent'	=> $group_page_subtitle_styles
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_subtitle_color',
			'default_value'	=> '',
			'label'			=> 'Text Color',
			'parent'		=> $row_page_subtitle_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_fontsize',
			'default_value'	=> '',
			'label'			=> 'Font Size',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_lineheight',
			'default_value'	=> '',
			'label'			=> 'Line Height',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_texttransform',
			'default_value'	=> '',
			'label'			=> 'Text Transform',
			'options'		=> conall_edge_get_text_transform_array(),
			'parent'		=> $row_page_subtitle_styles_1
		));

		$row_page_subtitle_styles_2 = conall_edge_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_2',
			'parent'	=> $group_page_subtitle_styles,
			'next'		=> true
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_subtitle_google_fonts',
			'default_value'	=> '-1',
			'label'			=> 'Font Family',
			'parent'		=> $row_page_subtitle_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontstyle',
			'default_value'	=> '',
			'label'			=> 'Font Style',
			'options'		=> conall_edge_get_font_style_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontweight',
			'default_value'	=> '',
			'label'			=> 'Font Weight',
			'options'		=> conall_edge_get_font_weight_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_letter_spacing',
			'default_value'	=> '',
			'label'			=> 'Letter Spacing',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_2
		));

        conall_edge_add_admin_section_title(array(
            'name' => 'type_section_breadcrumbs',
            'title' => 'Breadcrumbs',
            'parent' => $panel_typography
        ));

		$group_page_breadcrumbs_styles = conall_edge_add_admin_group(array(
			'name'			=> 'group_page_breadcrumbs_styles',
			'title'			=> 'Breadcrumbs',
			'description'	=> 'Define styles for page breadcrumbs',
			'parent'		=> $panel_typography
		));

		$row_page_breadcrumbs_styles_1 = conall_edge_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_1',
			'parent'	=> $group_page_breadcrumbs_styles
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_color',
			'default_value'	=> '',
			'label'			=> 'Text Color',
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_fontsize',
			'default_value'	=> '',
			'label'			=> 'Font Size',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_lineheight',
			'default_value'	=> '',
			'label'			=> 'Line Height',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_texttransform',
			'default_value'	=> '',
			'label'			=> 'Text Transform',
			'options'		=> conall_edge_get_text_transform_array(),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		$row_page_breadcrumbs_styles_2 = conall_edge_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_2',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_breadcrumb_google_fonts',
			'default_value'	=> '-1',
			'label'			=> 'Font Family',
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontstyle',
			'default_value'	=> '',
			'label'			=> 'Font Style',
			'options'		=> conall_edge_get_font_style_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontweight',
			'default_value'	=> '',
			'label'			=> 'Font Weight',
			'options'		=> conall_edge_get_font_weight_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_letter_spacing',
			'default_value'	=> '',
			'label'			=> 'Letter Spacing',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		$row_page_breadcrumbs_styles_3 = conall_edge_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_3',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_hovercolor',
			'default_value'	=> '',
			'label'			=> 'Hover/Active Color',
			'parent'		=> $row_page_breadcrumbs_styles_3
		));
    }

	add_action( 'conall_edge_options_map', 'conall_edge_title_options_map', 6);
}