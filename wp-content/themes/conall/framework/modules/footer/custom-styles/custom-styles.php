<?php

if(!function_exists('conall_edge_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function conall_edge_footer_top_general_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('footer_top_background_color')) {
            $item_styles['background-color'] = conall_edge_options()->getOptionValue('footer_top_background_color');
        }

        echo conall_edge_dynamic_css('footer .edgtf-footer-top-holder', $item_styles);

        $item_inner_styles = array();

        if(conall_edge_options()->getOptionValue('footer_top_padding_top') !== '') {
            $item_inner_styles['padding-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_padding_top')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_top_padding_bottom') !== '') {
            $item_inner_styles['padding-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_padding_bottom')).'px';
        }

        $item_inner_selector = array(
            'footer .edgtf-footer-top:not(.edgtf-footer-top-full) .edgtf-container-inner',
            'footer .edgtf-footer-top.edgtf-footer-top-full'
        );

        echo conall_edge_dynamic_css($item_inner_selector, $item_inner_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_footer_top_general_styles');
}

if(!function_exists('conall_edge_footer_top_title_styles')) {
    /**
     * Generates styles for footer top widgets title
     */
    function conall_edge_footer_top_title_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('footer_title_color') !== '') {
            $item_styles['color'] = conall_edge_options()->getOptionValue('footer_title_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('footer_title_google_fonts'))) {
            $item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('footer_title_google_fonts'));
        }

        if(conall_edge_options()->getOptionValue('footer_title_fontsize') !== '') {
            $item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_title_fontsize')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_title_lineheight') !== '') {
            $item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_title_lineheight')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_title_fontstyle') !== '') {
            $item_styles['font-style'] = conall_edge_options()->getOptionValue('footer_title_fontstyle');
        }

        if(conall_edge_options()->getOptionValue('footer_title_fontweight') !== '') {
            $item_styles['font-weight'] = conall_edge_options()->getOptionValue('footer_title_fontweight');
        }

        if(conall_edge_options()->getOptionValue('footer_title_letterspacing') !== '') {
            $item_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_title_letterspacing')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_title_texttransform') !== '') {
            $item_styles['text-transform'] = conall_edge_options()->getOptionValue('footer_title_texttransform');
        }

        $item_selector = array(
            '.edgtf-footer-top-holder .widget > .edgtf-footer-widget-title'
        );

        echo conall_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_footer_top_title_styles');
}

if(!function_exists('conall_edge_footer_top_text_styles')) {
    /**
     * Generates styles for footer top widgets text
     */
    function conall_edge_footer_top_text_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('footer_top_text_color') !== '') {
            $item_styles['color'] = conall_edge_options()->getOptionValue('footer_top_text_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('footer_top_text_google_fonts'))) {
            $item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('footer_top_text_google_fonts'));
        }

        if(conall_edge_options()->getOptionValue('footer_top_text_fontsize') !== '') {
            $item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_text_fontsize')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_top_text_lineheight') !== '') {
            $item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_text_lineheight')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_top_text_fontstyle') !== '') {
            $item_styles['font-style'] = conall_edge_options()->getOptionValue('footer_top_text_fontstyle');
        }

        if(conall_edge_options()->getOptionValue('footer_top_text_fontweight') !== '') {
            $item_styles['font-weight'] = conall_edge_options()->getOptionValue('footer_top_text_fontweight');
        }

        if(conall_edge_options()->getOptionValue('footer_top_text_letterspacing') !== '') {
            $item_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_text_letterspacing')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_top_text_texttransform') !== '') {
            $item_styles['text-transform'] = conall_edge_options()->getOptionValue('footer_top_text_texttransform');
        }

        $item_selector = array(
            '.edgtf-footer-top-holder .widget',
            '.edgtf-footer-top-holder .widget p',
            '.edgtf-footer-top-holder .edgtf-twitter-widget li .edgtf-tweet-text',
            'footer .widget.widget_rss li .rss-date'
        );

        echo conall_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_footer_top_text_styles');
}

if(!function_exists('conall_edge_footer_top_link_styles')) {
    /**
     * Generates styles for footer top widgets link
     */
    function conall_edge_footer_top_link_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('footer_top_link_color') !== '') {
            $item_styles['color'] = conall_edge_options()->getOptionValue('footer_top_link_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('footer_top_link_google_fonts'))) {
            $item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('footer_top_link_google_fonts'));
        }

        if(conall_edge_options()->getOptionValue('footer_top_link_fontsize') !== '') {
            $item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_link_fontsize')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_top_link_lineheight') !== '') {
            $item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_link_lineheight')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_top_link_fontstyle') !== '') {
            $item_styles['font-style'] = conall_edge_options()->getOptionValue('footer_top_link_fontstyle');
        }

        if(conall_edge_options()->getOptionValue('footer_top_link_fontweight') !== '') {
            $item_styles['font-weight'] = conall_edge_options()->getOptionValue('footer_top_link_fontweight');
        }

        if(conall_edge_options()->getOptionValue('footer_top_link_letterspacing') !== '') {
            $item_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_top_link_letterspacing')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_top_link_texttransform') !== '') {
            $item_styles['text-transform'] = conall_edge_options()->getOptionValue('footer_top_link_texttransform');
        }

        $item_selector = array(
            '.edgtf-footer-top-holder .widget a, .edgtf-footer-top-holder .edgtf-twitter-widget li .edgtf-tweet-text a'
        );

        echo conall_edge_dynamic_css($item_selector, $item_styles);

        $item_hover_styles = array();

        if(conall_edge_options()->getOptionValue('footer_top_link_hover_color') !== '') {
            $item_hover_styles['color'] = conall_edge_options()->getOptionValue('footer_top_link_hover_color');
        }

        $item_hover_selector = array(
            '.edgtf-footer-top-holder .widget a:hover'
        );

        echo conall_edge_dynamic_css($item_hover_selector, $item_hover_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_footer_top_link_styles');
}

if(!function_exists('conall_edge_footer_bottom_general_styles')) {
    /**
     * Generates general custom styles for footer bottom area
     */
    function conall_edge_footer_bottom_general_styles() {
        $item_styles = array();
        if(conall_edge_options()->getOptionValue('footer_bottom_height') !== '') {
            $item_styles['height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_bottom_height')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_background_color')) {
            $item_styles['background-color'] = conall_edge_options()->getOptionValue('footer_bottom_background_color');
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_border_top_color')) {
            $item_styles['border'] = '1px solid '.conall_edge_options()->getOptionValue('footer_bottom_border_top_color');
        }

        echo conall_edge_dynamic_css('footer .edgtf-footer-bottom-holder', $item_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_footer_bottom_general_styles');
}

if(!function_exists('conall_edge_footer_bottom_text_styles')) {
    /**
     * Generates styles for footer bottom widgets text
     */
    function conall_edge_footer_bottom_text_styles() {
        $item_styles = array();

        if(conall_edge_options()->getOptionValue('footer_bottom_text_color') !== '') {
            $item_styles['color'] = conall_edge_options()->getOptionValue('footer_bottom_text_color');
        }

        if(conall_edge_is_font_option_valid(conall_edge_options()->getOptionValue('footer_bottom_text_google_fonts'))) {
            $item_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('footer_bottom_text_google_fonts'));
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_text_fontsize') !== '') {
            $item_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_bottom_text_fontsize')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_text_lineheight') !== '') {
            $item_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_bottom_text_lineheight')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_text_fontstyle') !== '') {
            $item_styles['font-style'] = conall_edge_options()->getOptionValue('footer_bottom_text_fontstyle');
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_text_fontweight') !== '') {
            $item_styles['font-weight'] = conall_edge_options()->getOptionValue('footer_bottom_text_fontweight');
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_text_letterspacing') !== '') {
            $item_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('footer_bottom_text_letterspacing')).'px';
        }

        if(conall_edge_options()->getOptionValue('footer_bottom_text_texttransform') !== '') {
            $item_styles['text-transform'] = conall_edge_options()->getOptionValue('footer_bottom_text_texttransform');
        }

        $item_selector = array(
            '.edgtf-footer-bottom-holder .widget',
            '.edgtf-footer-bottom-holder .widget p'
        );

        echo conall_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_footer_bottom_text_styles');
}