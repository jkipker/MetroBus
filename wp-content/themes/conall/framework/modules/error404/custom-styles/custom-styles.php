<?php

if(!function_exists('conall_edge_404_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function conall_edge_404_footer_top_general_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('404_page_background_color')) {
            $item_styles['background-color'] = conall_edge_options()->getOptionValue('404_page_background_color');
        }

        if (conall_edge_options()->getOptionValue('404_page_background_image') !== '') {
            $item_styles['background-image'] = 'url('.conall_edge_options()->getOptionValue('404_page_background_image').')';
            $item_styles['background-position'] = 'center 0';
            $item_styles['background-size'] = 'cover';
            $item_styles['background-repeat'] = 'no-repeat';
        }

        if (conall_edge_options()->getOptionValue('404_page_background_pattern_image') !== '') {
            $item_styles['background-image'] = 'url('.conall_edge_options()->getOptionValue('404_page_background_pattern_image').')';
            $item_styles['background-position'] = '0 0';
            $item_styles['background-repeat'] = 'repeat';
        }

        echo conall_edge_dynamic_css('.edgtf-404-page .edgtf-content', $item_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_404_footer_top_general_styles');
}

if(!function_exists('conall_edge_404_title_styles')) {
    /**
     * Generates styles for 404 page title
     */
    function conall_edge_404_title_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('404_title_color') !== '') {
            $item_styles['color'] = conall_edge_options()->getOptionValue('404_title_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('404_title_google_fonts'))) {
            $item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('404_title_google_fonts'));
        }

        if(conall_edge_options()->getOptionValue('404_title_fontsize') !== '') {
            $item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('404_title_fontsize')).'px';
        }

        if(conall_edge_options()->getOptionValue('404_title_lineheight') !== '') {
            $item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('404_title_lineheight')).'px';
        }

        if(conall_edge_options()->getOptionValue('404_title_fontstyle') !== '') {
            $item_styles['font-style'] = conall_edge_options()->getOptionValue('404_title_fontstyle');
        }

        if(conall_edge_options()->getOptionValue('404_title_fontweight') !== '') {
            $item_styles['font-weight'] = conall_edge_options()->getOptionValue('404_title_fontweight');
        }

        if(conall_edge_options()->getOptionValue('404_title_letterspacing') !== '') {
            $item_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('404_title_letterspacing')).'px';
        }

        if(conall_edge_options()->getOptionValue('404_title_texttransform') !== '') {
            $item_styles['text-transform'] = conall_edge_options()->getOptionValue('404_title_texttransform');
        }

        $item_selector = array(
            '.edgtf-404-page .edgtf-page-not-found h1'
        );

        echo conall_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_404_title_styles');
}

if(!function_exists('conall_edge_404_subtitle_styles')) {
    /**
     * Generates styles for 404 page subtitle
     */
    function conall_edge_404_subtitle_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('404_subtitle_color') !== '') {
            $item_styles['color'] = conall_edge_options()->getOptionValue('404_subtitle_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('404_subtitle_google_fonts'))) {
            $item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('404_subtitle_google_fonts'));
        }

        if(conall_edge_options()->getOptionValue('404_subtitle_fontsize') !== '') {
            $item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('404_subtitle_fontsize')).'px';
        }

        if(conall_edge_options()->getOptionValue('404_subtitle_lineheight') !== '') {
            $item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('404_subtitle_lineheight')).'px';
        }

        if(conall_edge_options()->getOptionValue('404_subtitle_fontstyle') !== '') {
            $item_styles['font-style'] = conall_edge_options()->getOptionValue('404_subtitle_fontstyle');
        }

        if(conall_edge_options()->getOptionValue('404_subtitle_fontweight') !== '') {
            $item_styles['font-weight'] = conall_edge_options()->getOptionValue('404_subtitle_fontweight');
        }

        if(conall_edge_options()->getOptionValue('404_subtitle_letterspacing') !== '') {
            $item_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('404_subtitle_letterspacing')).'px';
        }

        if(conall_edge_options()->getOptionValue('404_subtitle_texttransform') !== '') {
            $item_styles['text-transform'] = conall_edge_options()->getOptionValue('404_subtitle_texttransform');
        }

        $item_selector = array(
            '.edgtf-404-page .edgtf-page-not-found h2'
        );

        echo conall_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_404_subtitle_styles');
}