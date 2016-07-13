<?php

if(!function_exists('conall_edge_button_typography_styles')) {
    /**
     * Typography styles for all button types
     */
    function conall_edge_button_typography_styles() {
        $selector = '.edgtf-btn';
        $styles = array();

        $font_family = conall_edge_options()->getOptionValue('button_font_family');
        if(conall_edge_is_font_option_valid($font_family)) {
            $styles['font-family'] = conall_edge_get_font_option_val($font_family);
        }

        $text_transform = conall_edge_options()->getOptionValue('button_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = conall_edge_options()->getOptionValue('button_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = conall_edge_options()->getOptionValue('button_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = conall_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = conall_edge_options()->getOptionValue('button_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo conall_edge_dynamic_css($selector, $styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_button_typography_styles');
}

if(!function_exists('conall_edge_button_outline_styles')) {
    /**
     * Generate styles for outline button
     */
    function conall_edge_button_outline_styles() {
        //outline styles
        $outline_styles   = array();
        $outline_selector = '.edgtf-btn.edgtf-btn-outline';

        if(conall_edge_options()->getOptionValue('btn_outline_text_color')) {
            $outline_styles['color'] = conall_edge_options()->getOptionValue('btn_outline_text_color');
        }

        if(conall_edge_options()->getOptionValue('btn_outline_border_color')) {
            $outline_styles['border-color'] = conall_edge_options()->getOptionValue('btn_outline_border_color');
        }

        echo conall_edge_dynamic_css($outline_selector, $outline_styles);

        //outline hover styles
        if(conall_edge_options()->getOptionValue('btn_outline_hover_text_color')) {
            echo conall_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => conall_edge_options()->getOptionValue('btn_outline_hover_text_color').'!important')
            );
        }

        if(conall_edge_options()->getOptionValue('btn_outline_hover_bg_color')) {
            echo conall_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => conall_edge_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
            );
        }

        if(conall_edge_options()->getOptionValue('btn_outline_hover_border_color')) {
            echo conall_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-border-hover):hover',
                array('border-color' => conall_edge_options()->getOptionValue('btn_outline_hover_border_color').'!important')
            );
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_button_outline_styles');
}

if(!function_exists('conall_edge_button_solid_styles')) {
    /**
     * Generate styles for solid type buttons
     */
    function conall_edge_button_solid_styles() {
        //solid styles
        $solid_selector = '.edgtf-btn.edgtf-btn-solid';
        $solid_styles = array();

        if(conall_edge_options()->getOptionValue('btn_solid_text_color')) {
            $solid_styles['color'] = conall_edge_options()->getOptionValue('btn_solid_text_color');
        }

        if(conall_edge_options()->getOptionValue('btn_solid_bg_color')) {
            $solid_styles['background-color'] = conall_edge_options()->getOptionValue('btn_solid_bg_color');
        }

        if(conall_edge_options()->getOptionValue('btn_solid_border_color')) {
            $solid_styles['border-color'] = conall_edge_options()->getOptionValue('btn_solid_border_color');
        }

        echo conall_edge_dynamic_css($solid_selector, $solid_styles);

        //solid hover styles
        if(conall_edge_options()->getOptionValue('btn_solid_hover_text_color')) {
            echo conall_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => conall_edge_options()->getOptionValue('btn_solid_hover_text_color').'!important')
            );
        }

        if(conall_edge_options()->getOptionValue('btn_solid_hover_bg_color')) {
            echo conall_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => conall_edge_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
            );
        }

        if(conall_edge_options()->getOptionValue('btn_solid_hover_border_color')) {
            echo conall_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                array('border-color' => conall_edge_options()->getOptionValue('btn_solid_hover_border_color').'!important')
            );
        }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_button_solid_styles');
}