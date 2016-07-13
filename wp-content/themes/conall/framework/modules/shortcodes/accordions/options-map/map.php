<?php 
if(!function_exists('conall_edge_accordions_map')) {
    /**
     * Add Accordion options to elements panel
     */
   function conall_edge_accordions_map() {
		
       $panel = conall_edge_add_admin_panel(array(
           'title' => 'Accordions',
           'name'  => 'panel_accordions',
           'page'  => '_elements_page'
       ));

       //Typography options
       conall_edge_add_admin_section_title(array(
           'name' => 'typography_section_title',
           'title' => 'Typography',			
           'parent' => $panel
       ));

       $typography_group = conall_edge_add_admin_group(array(
           'name' => 'typography_group',
           'title' => 'Typography',
			'description' => 'Setup typography for accordions navigation',
           'parent' => $panel
       ));

       $typography_row = conall_edge_add_admin_row(array(
           'name' => 'typography_row',
           'next' => true,
           'parent' => $typography_group
       ));

       conall_edge_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'fontsimple',
           'name'          => 'accordions_font_family',
           'default_value' => '',
           'label'         => 'Font Family',
       ));

       conall_edge_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'selectsimple',
           'name'          => 'accordions_text_transform',
           'default_value' => '',
           'label'         => 'Text Transform',
           'options'       => conall_edge_get_text_transform_array()
       ));

       conall_edge_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'selectsimple',
           'name'          => 'accordions_font_style',
           'default_value' => '',
           'label'         => 'Font Style',
           'options'       => conall_edge_get_font_style_array()
       ));

       conall_edge_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'textsimple',
           'name'          => 'accordions_letter_spacing',
           'default_value' => '',
           'label'         => 'Letter Spacing',
           'args'          => array(
               'suffix' => 'px'
           )
       ));

       $typography_row2 = conall_edge_add_admin_row(array(
           'name' => 'typography_row2',
           'next' => true,
           'parent' => $typography_group
       ));		
		
       conall_edge_add_admin_field(array(
           'parent'        => $typography_row2,
           'type'          => 'selectsimple',
           'name'          => 'accordions_font_weight',
           'default_value' => '',
           'label'         => 'Font Weight',
           'options'       => conall_edge_get_font_weight_array()
       ));
		
		//Initial Accordion Color Styles
		
		conall_edge_add_admin_section_title(array(
           'name' => 'accordion_color_section_title',
           'title' => 'Basic Accordions Color Styles',			
           'parent' => $panel
       ));
		
		$accordions_color_group = conall_edge_add_admin_group(array(
           'name' => 'accordions_color_group',
           'title' => 'Accordion Color Styles',
			'description' => 'Set color styles for accordion title',
           'parent' => $panel
       ));
		$accordions_color_row = conall_edge_add_admin_row(array(
           'name' => 'accordions_color_row',
           'next' => true,
           'parent' => $accordions_color_group
       ));
		conall_edge_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_title_color',
           'default_value' => '',
           'label'         => 'Title Color'
       ));
		conall_edge_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_icon_color',
           'default_value' => '',
           'label'         => 'Icon Color'
       ));
       conall_edge_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_border_color',
           'default_value' => '',
           'label'         => 'Border Color'
       ));

       //Active Accordion Color Styles
		
		$active_accordions_color_group = conall_edge_add_admin_group(array(
           'name' => 'active_accordions_color_group',
           'title' => 'Active and Hover Accordion Color Styles',
			'description' => 'Set color styles for active and hover accordions',
           'parent' => $panel
       ));
		$active_accordions_color_row = conall_edge_add_admin_row(array(
           'name' => 'active_accordions_color_row',
           'next' => true,
           'parent' => $active_accordions_color_group
       ));
		conall_edge_add_admin_field(array(
           'parent'        => $active_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_title_color_active',
           'default_value' => '',
           'label'         => 'Title Color'
       ));
		conall_edge_add_admin_field(array(
           'parent'        => $active_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_icon_color_active',
           'default_value' => '',
           'label'         => 'Icon Color'
       ));

       
   }
   add_action('conall_edge_options_elements_map', 'conall_edge_accordions_map');
}