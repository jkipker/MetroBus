<?php 

if(!function_exists('conall_edge_accordions_typography_styles')){
	function conall_edge_accordions_typography_styles(){
		$selector = '.edgtf-accordion-holder .edgtf-title-holder';
		$styles = array();
		
		$font_family = conall_edge_options()->getOptionValue('accordions_font_family');
		if(conall_edge_is_font_option_valid($font_family)){
			$styles['font-family'] = conall_edge_get_font_option_val($font_family);
		}
		
		$text_transform = conall_edge_options()->getOptionValue('accordions_text_transform');
       if(!empty($text_transform)) {
           $styles['text-transform'] = $text_transform;
       }

       $font_style = conall_edge_options()->getOptionValue('accordions_font_style');
       if(!empty($font_style)) {
           $styles['font-style'] = $font_style;
       }

       $letter_spacing = conall_edge_options()->getOptionValue('accordions_letter_spacing');
       if($letter_spacing !== '') {
           $styles['letter-spacing'] = conall_edge_filter_px($letter_spacing).'px';
       }

       $font_weight = conall_edge_options()->getOptionValue('accordions_font_weight');
       if(!empty($font_weight)) {
           $styles['font-weight'] = $font_weight;
       }

       echo conall_edge_dynamic_css($selector, $styles);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_accordions_typography_styles');
}

if(!function_exists('conall_edge_accordions_inital_title_color_styles')){
	function conall_edge_accordions_inital_title_color_styles(){
		$selector = '.edgtf-accordion-holder .edgtf-title-holder';
		$styles = array();
		
		if(conall_edge_options()->getOptionValue('accordions_title_color')) {
           $styles['color'] = conall_edge_options()->getOptionValue('accordions_title_color');
       }
		echo conall_edge_dynamic_css($selector, $styles);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_accordions_inital_title_color_styles');
}

if(!function_exists('conall_edge_accordions_active_title_color_styles')){
	
	function conall_edge_accordions_active_title_color_styles(){
		$selector = array(
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-active',
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover'
		);
		$styles = array();
		
		if(conall_edge_options()->getOptionValue('accordions_title_color_active')) {
           $styles['color'] = conall_edge_options()->getOptionValue('accordions_title_color_active');
       }
		
		echo conall_edge_dynamic_css($selector, $styles);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_accordions_active_title_color_styles');
}

if(!function_exists('conall_edge_accordions_border_color_styles')){

    function conall_edge_accordions_border_color_styles(){
        $selector = array(
            '.edgtf-accordion-holder .edgtf-accordion-content',
            '.edgtf-accordion-holder .edgtf-title-holder'
        );

        $styles = array();

        if(conall_edge_options()->getOptionValue('accordions_border_color')) {
            $styles['border-bottom-color'] = conall_edge_options()->getOptionValue('accordions_border_color');
        }

        echo conall_edge_dynamic_css($selector, $styles);
    }
    add_action('conall_edge_style_dynamic', 'conall_edge_accordions_border_color_styles');
}

if(!function_exists('conall_edge_accordions_inital_icon_color_styles')){
	
	function conall_edge_accordions_inital_icon_color_styles(){
		$selector = '.edgtf-accordion-holder .edgtf-title-holder .edgtf-accordion-mark';
		$styles = array();
		
		if(conall_edge_options()->getOptionValue('accordions_icon_color')) {
           $styles['color'] = conall_edge_options()->getOptionValue('accordions_icon_color');
       }
		if(conall_edge_options()->getOptionValue('accordions_icon_back_color')) {
           $styles['background-color'] = conall_edge_options()->getOptionValue('accordions_icon_back_color');
       }
		echo conall_edge_dynamic_css($selector, $styles);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_accordions_inital_icon_color_styles');
}
if(!function_exists('conall_edge_accordions_active_icon_color_styles')){
	
	function conall_edge_accordions_active_icon_color_styles(){
		$selector = array(
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-active .edgtf-accordion-mark',
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover .edgtf-accordion-mark'
		);
		$styles = array();
		
		if(conall_edge_options()->getOptionValue('accordions_icon_color_active')) {
           $styles['color'] = conall_edge_options()->getOptionValue('accordions_icon_color_active');
       }
		if(conall_edge_options()->getOptionValue('accordions_icon_back_color_active')) {
           $styles['background-color'] = conall_edge_options()->getOptionValue('accordions_icon_back_color_active');
       }
		echo conall_edge_dynamic_css($selector, $styles);
	}
	add_action('conall_edge_style_dynamic', 'conall_edge_accordions_active_icon_color_styles');
}