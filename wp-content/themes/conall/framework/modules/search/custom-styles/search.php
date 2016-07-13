<?php

if (!function_exists('conall_edge_search_opener_icon_size')) {

	function conall_edge_search_opener_icon_size() {

		if (conall_edge_options()->getOptionValue('header_search_icon_size')) {
			echo conall_edge_dynamic_css('.edgtf-search-opener', array(
				'font-size' => conall_edge_filter_px(conall_edge_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_opener_icon_size');

}

if (!function_exists('conall_edge_search_opener_icon_colors')) {

	function conall_edge_search_opener_icon_colors() {

		if (conall_edge_options()->getOptionValue('header_search_icon_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-search-opener', array(
				'color' => conall_edge_options()->getOptionValue('header_search_icon_color')
			));
		}

		if (conall_edge_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-search-opener:hover', array(
				'color' => conall_edge_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if (conall_edge_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-search-opener, .edgtf-light-header .edgtf-top-bar .edgtf-search-opener', array(
				'color' => conall_edge_options()->getOptionValue('header_light_search_icon_color') . ' !important'
			));
		}

		if (conall_edge_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-search-opener:hover, .edgtf-light-header .edgtf-top-bar .edgtf-search-opener:hover', array(
				'color' => conall_edge_options()->getOptionValue('header_light_search_icon_hover_color') . ' !important'
			));
		}

		if (conall_edge_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-search-opener, .edgtf-dark-header .edgtf-top-bar .edgtf-search-opener', array(
				'color' => conall_edge_options()->getOptionValue('header_dark_search_icon_color') . ' !important'
			));
		}
		if (conall_edge_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-search-opener:hover, .edgtf-dark-header .edgtf-top-bar .edgtf-search-opener:hover', array(
				'color' => conall_edge_options()->getOptionValue('header_dark_search_icon_hover_color') . ' !important'
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_opener_icon_colors');

}

if (!function_exists('conall_edge_search_opener_icon_background_colors')) {

	function conall_edge_search_opener_icon_background_colors()	{

		if (conall_edge_options()->getOptionValue('search_icon_background_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-search-opener', array(
				'background-color' => conall_edge_options()->getOptionValue('search_icon_background_color')
			));
		}

		if (conall_edge_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-search-opener:hover', array(
				'background-color' => conall_edge_options()->getOptionValue('search_icon_background_hover_color')
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_opener_icon_background_colors');
}

if (!function_exists('conall_edge_search_opener_text_styles')) {

	function conall_edge_search_opener_text_styles() {
		$text_styles = array();

		if (conall_edge_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = conall_edge_options()->getOptionValue('search_icon_text_color');
		}
		if (conall_edge_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if (conall_edge_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if (conall_edge_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = conall_edge_options()->getOptionValue('search_icon_text_texttransform');
		}
		if (conall_edge_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if (conall_edge_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = conall_edge_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if (conall_edge_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = conall_edge_options()->getOptionValue('search_icon_text_fontweight');
		}

		if (!empty($text_styles)) {
			echo conall_edge_dynamic_css('.edgtf-search-icon-text', $text_styles);
		}
		if (conall_edge_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo conall_edge_dynamic_css('.edgtf-search-opener:hover .edgtf-search-icon-text', array(
				'color' => conall_edge_options()->getOptionValue('search_icon_text_color_hover')
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_opener_text_styles');
}

if (!function_exists('conall_edge_search_opener_spacing')) {

	function conall_edge_search_opener_spacing() {
		$spacing_styles = array();

		if (conall_edge_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (conall_edge_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (conall_edge_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (conall_edge_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo conall_edge_dynamic_css('.edgtf-search-opener', $spacing_styles);
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_opener_spacing');
}

if (!function_exists('conall_edge_search_bar_background')) {

	function conall_edge_search_bar_background() {

		if (conall_edge_options()->getOptionValue('search_background_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-search-fade .edgtf-fullscreen-search-holder .edgtf-fullscreen-search-table, .edgtf-fullscreen-search-overlay, .edgtf-search-slide-window-top, .edgtf-search-slide-window-top input[type="text"]', array(
				'background-color' => conall_edge_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_bar_background');
}

if (!function_exists('conall_edge_search_text_styles')) {

	function conall_edge_search_text_styles() {
		$text_styles = array();

		if (conall_edge_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = conall_edge_options()->getOptionValue('search_text_color');
		}
		if (conall_edge_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if (conall_edge_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = conall_edge_options()->getOptionValue('search_text_texttransform');
		}
		if (conall_edge_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if (conall_edge_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = conall_edge_options()->getOptionValue('search_text_fontstyle');
		}
		if (conall_edge_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = conall_edge_options()->getOptionValue('search_text_fontweight');
		}
		if (conall_edge_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-field', $text_styles);
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_text_styles');
}

if (!function_exists('conall_edge_search_label_styles')) {

	function conall_edge_search_label_styles()	{
		$text_styles = array();

		if (conall_edge_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = conall_edge_options()->getOptionValue('search_label_text_color');
		}
		if (conall_edge_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_label_text_fontsize')) . 'px';
		}
		if (conall_edge_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = conall_edge_options()->getOptionValue('search_label_text_texttransform');
		}
		if (conall_edge_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('search_label_text_google_fonts')) . ', sans-serif';
		}
		if (conall_edge_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = conall_edge_options()->getOptionValue('search_label_text_fontstyle');
		}
		if (conall_edge_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = conall_edge_options()->getOptionValue('search_label_text_fontweight');
		}
		if (conall_edge_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('search_label_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-label', $text_styles);
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_label_styles');
}

if (!function_exists('conall_edge_search_icon_styles')) {

	function conall_edge_search_icon_styles() {

		if (conall_edge_options()->getOptionValue('search_icon_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-submit', array(
				'color' => conall_edge_options()->getOptionValue('search_icon_color')
			));
		}
		if (conall_edge_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-submit:hover', array(
				'color' => conall_edge_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (conall_edge_options()->getOptionValue('search_icon_size') !== '') {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-submit', array(
				'font-size' => conall_edge_filter_px(conall_edge_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_icon_styles');
}

if (!function_exists('conall_edge_search_close_icon_styles')) {

	function conall_edge_search_close_icon_styles()	{

		if (conall_edge_options()->getOptionValue('search_close_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-close span', array(
				'color' => conall_edge_options()->getOptionValue('search_close_color')
			));
		}
		if (conall_edge_options()->getOptionValue('search_close_hover_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-close:hover span', array(
				'color' => conall_edge_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (conall_edge_options()->getOptionValue('search_close_size') !== '') {
			echo conall_edge_dynamic_css('.edgtf-fullscreen-search-close span', array(
				'font-size' => conall_edge_filter_px(conall_edge_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('conall_edge_style_dynamic', 'conall_edge_search_close_icon_styles');
}
?>