<?php
if(!function_exists('conall_edge_tabs_typography_styles')){
	function conall_edge_tabs_typography_styles(){
		$selector = '.edgtf-tabs .edgtf-tabs-nav li a';
		$tabs_tipography_array = array();
		$font_family = conall_edge_options()->getOptionValue('tabs_font_family');
		
		if(conall_edge_is_font_option_valid($font_family)){
			$tabs_tipography_array['font-family'] = conall_edge_is_font_option_valid($font_family);
		}
		
		$text_transform = conall_edge_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $tabs_tipography_array['text-transform'] = $text_transform;
        }

        $font_style = conall_edge_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $tabs_tipography_array['font-style'] = $font_style;
        }

        $letter_spacing = conall_edge_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $tabs_tipography_array['letter-spacing'] = conall_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = conall_edge_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $tabs_tipography_array['font-weight'] = $font_weight;
        }

        echo conall_edge_dynamic_css($selector, $tabs_tipography_array);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_tabs_typography_styles');
}

if(!function_exists('conall_edge_tabs_inital_color_styles')){
	function conall_edge_tabs_inital_color_styles(){
		$selector = '.edgtf-tabs .edgtf-tabs-nav li a';
		$styles = array();
		
		if(conall_edge_options()->getOptionValue('tabs_color')) {
            $styles['color'] = conall_edge_options()->getOptionValue('tabs_color');
        }
		
		echo conall_edge_dynamic_css($selector, $styles);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_tabs_inital_color_styles');
}
if(!function_exists('conall_edge_tabs_active_color_styles')){
	function conall_edge_tabs_active_color_styles(){
		$selector = '.edgtf-tabs .edgtf-tabs-nav li.ui-state-active a, .edgtf-tabs .edgtf-tabs-nav li.ui-state-hover a';
		$styles = array();
		
		if(conall_edge_options()->getOptionValue('tabs_color_active')) {
            $styles['color'] = conall_edge_options()->getOptionValue('tabs_color_active');
        }

		echo conall_edge_dynamic_css($selector, $styles);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_tabs_active_color_styles');
}