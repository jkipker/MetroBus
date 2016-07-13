<?php

if (!function_exists('conall_edge_title_area_typography_style')) {

    function conall_edge_title_area_typography_style(){

        // title default/small size

        $title_styles = array();

        if(conall_edge_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = conall_edge_options()->getOptionValue('page_title_color');
        }
        if(conall_edge_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('page_title_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = conall_edge_options()->getOptionValue('page_title_fontsize').'px';
        }
        if(conall_edge_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = conall_edge_options()->getOptionValue('page_title_lineheight').'px';
        }
        if(conall_edge_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = conall_edge_options()->getOptionValue('page_title_texttransform');
        }
        if(conall_edge_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = conall_edge_options()->getOptionValue('page_title_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = conall_edge_options()->getOptionValue('page_title_fontweight');
        }
        if(conall_edge_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = conall_edge_options()->getOptionValue('page_title_letter_spacing').'px';
        }

        $title_selector = array(
            '.edgtf-title.edgtf-title-size-small .edgtf-title-holder h1'
        );

        echo conall_edge_dynamic_css($title_selector, $title_styles);

        // title medium size

        $title_styles = array();

        if(conall_edge_options()->getOptionValue('page_title_medium_color') !== '') {
            $title_styles['color'] = conall_edge_options()->getOptionValue('page_title_medium_color');
        }
        if(conall_edge_options()->getOptionValue('page_title_medium_google_fonts') !== '-1') {
            $title_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('page_title_medium_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('page_title_medium_fontsize') !== '') {
            $title_styles['font-size'] = conall_edge_options()->getOptionValue('page_title_medium_fontsize').'px';
        }
        if(conall_edge_options()->getOptionValue('page_title_medium_lineheight') !== '') {
            $title_styles['line-height'] = conall_edge_options()->getOptionValue('page_title_medium_lineheight').'px';
        }
        if(conall_edge_options()->getOptionValue('page_title_medium_texttransform') !== '') {
            $title_styles['text-transform'] = conall_edge_options()->getOptionValue('page_title_medium_texttransform');
        }
        if(conall_edge_options()->getOptionValue('page_title_medium_fontstyle') !== '') {
            $title_styles['font-style'] = conall_edge_options()->getOptionValue('page_title_medium_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('page_title_medium_fontweight') !== '') {
            $title_styles['font-weight'] = conall_edge_options()->getOptionValue('page_title_medium_fontweight');
        }
        if(conall_edge_options()->getOptionValue('page_title_medium_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = conall_edge_options()->getOptionValue('page_title_medium_letter_spacing').'px';
        }

        $title_selector = array(
            '.edgtf-title.edgtf-title-size-medium .edgtf-title-holder h1'
        );

        echo conall_edge_dynamic_css($title_selector, $title_styles);

        // title large size

        $title_styles = array();

        if(conall_edge_options()->getOptionValue('page_title_large_color') !== '') {
            $title_styles['color'] = conall_edge_options()->getOptionValue('page_title_large_color');
        }
        if(conall_edge_options()->getOptionValue('page_title_large_google_fonts') !== '-1') {
            $title_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('page_title_large_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('page_title_large_fontsize') !== '') {
            $title_styles['font-size'] = conall_edge_options()->getOptionValue('page_title_large_fontsize').'px';
        }
        if(conall_edge_options()->getOptionValue('page_title_large_lineheight') !== '') {
            $title_styles['line-height'] = conall_edge_options()->getOptionValue('page_title_large_lineheight').'px';
        }
        if(conall_edge_options()->getOptionValue('page_title_large_texttransform') !== '') {
            $title_styles['text-transform'] = conall_edge_options()->getOptionValue('page_title_large_texttransform');
        }
        if(conall_edge_options()->getOptionValue('page_title_large_fontstyle') !== '') {
            $title_styles['font-style'] = conall_edge_options()->getOptionValue('page_title_large_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('page_title_large_fontweight') !== '') {
            $title_styles['font-weight'] = conall_edge_options()->getOptionValue('page_title_large_fontweight');
        }
        if(conall_edge_options()->getOptionValue('page_title_large_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = conall_edge_options()->getOptionValue('page_title_large_letter_spacing').'px';
        }

        $title_selector = array(
            '.edgtf-title.edgtf-title-size-large .edgtf-title-holder h1'
        );

        echo conall_edge_dynamic_css($title_selector, $title_styles);


        $subtitle_styles = array();

        if(conall_edge_options()->getOptionValue('page_subtitle_color') !== '') {
            $subtitle_styles['color'] = conall_edge_options()->getOptionValue('page_subtitle_color');
        }
        if(conall_edge_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
            $subtitle_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('page_subtitle_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('page_subtitle_fontsize') !== '') {
            $subtitle_styles['font-size'] = conall_edge_options()->getOptionValue('page_subtitle_fontsize').'px';
        }
        if(conall_edge_options()->getOptionValue('page_subtitle_lineheight') !== '') {
            $subtitle_styles['line-height'] = conall_edge_options()->getOptionValue('page_subtitle_lineheight').'px';
        }
        if(conall_edge_options()->getOptionValue('page_subtitle_texttransform') !== '') {
            $subtitle_styles['text-transform'] = conall_edge_options()->getOptionValue('page_subtitle_texttransform');
        }
        if(conall_edge_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
            $subtitle_styles['font-style'] = conall_edge_options()->getOptionValue('page_subtitle_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('page_subtitle_fontweight') !== '') {
            $subtitle_styles['font-weight'] = conall_edge_options()->getOptionValue('page_subtitle_fontweight');
        }
        if(conall_edge_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
            $subtitle_styles['letter-spacing'] = conall_edge_options()->getOptionValue('page_subtitle_letter_spacing').'px';
        }

        $subtitle_selector = array(
            '.edgtf-title .edgtf-title-holder .edgtf-subtitle'
        );

        echo conall_edge_dynamic_css($subtitle_selector, $subtitle_styles);


        $breadcrumb_styles = array();

        if(conall_edge_options()->getOptionValue('page_breadcrumb_color') !== '') {
            $breadcrumb_styles['color'] = conall_edge_options()->getOptionValue('page_breadcrumb_color');
        }
        if(conall_edge_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(conall_edge_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = conall_edge_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(conall_edge_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = conall_edge_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(conall_edge_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = conall_edge_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(conall_edge_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = conall_edge_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(conall_edge_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = conall_edge_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(conall_edge_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = conall_edge_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.edgtf-title .edgtf-title-holder .edgtf-breadcrumbs a, .edgtf-title .edgtf-title-holder .edgtf-breadcrumbs span'
        );

        echo conall_edge_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(conall_edge_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = conall_edge_options()->getOptionValue('page_breadcrumb_hovercolor');
        }

        $breadcrumb_hover_selector = array(
            '.edgtf-title .edgtf-title-holder .edgtf-breadcrumbs a:hover'
        );

        echo conall_edge_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);

    }

    add_action('conall_edge_style_dynamic', 'conall_edge_title_area_typography_style');

}


