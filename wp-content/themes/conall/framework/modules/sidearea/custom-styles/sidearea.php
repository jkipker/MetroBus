<?php

if (!function_exists('conall_edge_side_area_slide_from_right_type_style')) {

	function conall_edge_side_area_slide_from_right_type_style()	{

		if (conall_edge_options()->getOptionValue('side_area_type') == 'side-menu-slide-from-right') {

			if (conall_edge_options()->getOptionValue('side_area_width') !== '' && conall_edge_options()->getOptionValue('side_area_width') >= 30) {
				echo conall_edge_dynamic_css('.edgtf-side-menu-slide-from-right .edgtf-side-menu', array(
					'right' => '-'.conall_edge_options()->getOptionValue('side_area_width') . '%',
					'width' => conall_edge_options()->getOptionValue('side_area_width') . '%'
				));
			}

			if (conall_edge_options()->getOptionValue('side_area_content_overlay_color') !== '') {

				echo conall_edge_dynamic_css('.edgtf-side-menu-slide-from-right .edgtf-wrapper .edgtf-cover', array(
					'background-color' => conall_edge_options()->getOptionValue('side_area_content_overlay_color')
				));

			}
			if (conall_edge_options()->getOptionValue('side_area_content_overlay_opacity') !== '') {

				echo conall_edge_dynamic_css('.edgtf-side-menu-slide-from-right.edgtf-right-side-menu-opened .edgtf-wrapper .edgtf-cover', array(
					'opacity' => conall_edge_options()->getOptionValue('side_area_content_overlay_opacity')
				));
			}
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_slide_from_right_type_style');
}

if (!function_exists('conall_edge_side_area_icon_color_styles')) {

	function conall_edge_side_area_icon_color_styles() {

		if (conall_edge_options()->getOptionValue('side_area_icon_color') !== '') {

			echo conall_edge_dynamic_css('a.edgtf-side-menu-button-opener .edgtf-side-menu-lines .edgtf-side-menu-line', array(
				'background-color' => conall_edge_options()->getOptionValue('side_area_icon_color')
			));

		}
		if (conall_edge_options()->getOptionValue('side_area_icon_hover_color') !== '') {

			echo conall_edge_dynamic_css('a.edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line', array(
				'background-color' => conall_edge_options()->getOptionValue('side_area_icon_hover_color')
			));

		}
		if (conall_edge_options()->getOptionValue('side_area_light_icon_color') !== '') {

			echo conall_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener .edgtf-side-menu-lines .edgtf-side-menu-line,
			.edgtf-light-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-side-menu-button-opener .edgtf-side-menu-lines .edgtf-side-menu-line,
			.edgtf-light-header .edgtf-top-bar .edgtf-side-menu-button-opener .edgtf-side-menu-lines .edgtf-side-menu-line', array(
				'background-color' => conall_edge_options()->getOptionValue('side_area_light_icon_color') . ' !important'
			));

		}
		if (conall_edge_options()->getOptionValue('side_area_light_icon_hover_color') !== '') {

			echo conall_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener:hover .edgt-side-menu-lines .edgtf-side-menu-line,
			.edgtf-light-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-side-menu-button-opener:hover .edgt-side-menu-lines .edgtf-side-menu-line,
			.edgtf-light-header .edgtf-top-bar .edgtf-side-menu-button-opener:hover .edgt-side-menu-lines .edgtf-side-menu-line', array(
				'background-color' => conall_edge_options()->getOptionValue('side_area_light_icon_hover_color') . ' !important'
			));

		}
		if (conall_edge_options()->getOptionValue('side_area_dark_icon_color') !== '') {

			echo conall_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener .edgtf-side-menu-lines .edgtf-side-menu-line,
			.edgtf-dark-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-side-menu-button-opener .edgtf-side-menu-lines .edgtf-side-menu-line,
			.edgtf-dark-header .edgtf-top-bar .edgtf-side-menu-button-opener .edgtf-side-menu-lines .edgtf-side-menu-line', array(
				'background-color' => conall_edge_options()->getOptionValue('side_area_dark_icon_color') . ' !important'
			));

		}
		if (conall_edge_options()->getOptionValue('side_area_dark_icon_hover_color') !== '') {

			echo conall_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.fixed) .edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line,
			.edgtf-dark-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line,
			.edgtf-dark-header .edgtf-top-bar .edgtf-side-menu-button-opener:hover .edgtf-side-menu-lines .edgtf-side-menu-line', array(
				'background-color' => conall_edge_options()->getOptionValue('side_area_dark_icon_hover_color') . ' !important'
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_icon_color_styles');
}

if (!function_exists('conall_edge_side_area_icon_spacing_styles')) {

	function conall_edge_side_area_icon_spacing_styles()	{
		$icon_spacing = array();

		if (conall_edge_options()->getOptionValue('side_area_icon_padding_left') !== '') {
			$icon_spacing['padding-left'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_icon_padding_left')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_icon_padding_right') !== '') {
			$icon_spacing['padding-right'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_icon_padding_right')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_icon_margin_left') !== '') {
			$icon_spacing['margin-left'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_icon_margin_left')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_icon_margin_right') !== '') {
			$icon_spacing['margin-right'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_icon_margin_right')) . 'px';
		}

		if (!empty($icon_spacing)) {

			echo conall_edge_dynamic_css('a.edgtf-side-menu-button-opener', $icon_spacing);
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_icon_spacing_styles');
}

if (!function_exists('conall_edge_side_area_icon_border_styles')) {

	function conall_edge_side_area_icon_border_styles() {
		if (conall_edge_options()->getOptionValue('side_area_icon_border_yesno') == 'yes') {

			$side_area_icon_border = array();

			if (conall_edge_options()->getOptionValue('side_area_icon_border_color') !== '') {
				$side_area_icon_border['border-color'] = conall_edge_options()->getOptionValue('side_area_icon_border_color');
			}

			if (conall_edge_options()->getOptionValue('side_area_icon_border_width') !== '') {
				$side_area_icon_border['border-width'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_icon_border_width')) . 'px';
			} else {
				$side_area_icon_border['border-width'] = '1px';
			}

			if (conall_edge_options()->getOptionValue('side_area_icon_border_radius') !== '') {
				$side_area_icon_border['border-radius'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_icon_border_radius')) . 'px';
			}

			if (conall_edge_options()->getOptionValue('side_area_icon_border_style') !== '') {
				$side_area_icon_border['border-style'] = conall_edge_options()->getOptionValue('side_area_icon_border_style');
			} else {
				$side_area_icon_border['border-style'] = 'solid';
			}

			if (!empty($side_area_icon_border)) {
				$side_area_icon_border['-webkit-transition'] = 'all 0.15s ease-out';
				$side_area_icon_border['transition'] = 'all 0.15s ease-out';
				echo conall_edge_dynamic_css('a.edgtf-side-menu-button-opener', $side_area_icon_border);
			}

			if (conall_edge_options()->getOptionValue('side_area_icon_border_hover_color') !== '') {
				$side_area_icon_border_hover['border-color'] = conall_edge_options()->getOptionValue('side_area_icon_border_hover_color');
                echo conall_edge_dynamic_css('a.edgtf-side-menu-button-opener:hover', $side_area_icon_border_hover);
			}
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_icon_border_styles');
}

if (!function_exists('conall_edge_side_area_alignment')) {

	function conall_edge_side_area_alignment() {

		if (conall_edge_options()->getOptionValue('side_area_aligment')) {

			echo conall_edge_dynamic_css('.edgtf-side-menu-slide-from-right .edgtf-side-menu, .edgtf-side-menu-slide-with-content .edgtf-side-menu, .edgtf-side-area-uncovered-from-content .edgtf-side-menu', array(
				'text-align' => conall_edge_options()->getOptionValue('side_area_aligment')
			));

			if(conall_edge_options()->getOptionValue('side_area_aligment') == 'center') {
				echo conall_edge_dynamic_css('.edgtf-side-menu .widget img', array(
					'margin' => '0 auto'
				));
			}
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_alignment');
}

if (!function_exists('conall_edge_side_area_styles')) {

	function conall_edge_side_area_styles() {

		$side_area_styles = array();

		if (conall_edge_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = conall_edge_options()->getOptionValue('side_area_background_color');
		}

		if (conall_edge_options()->getOptionValue('side_area_padding_top') !== '') {
			$side_area_styles['padding-top'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_padding_top')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_padding_right') !== '') {
			$side_area_styles['padding-right'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_padding_right')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_padding_bottom') !== '') {
			$side_area_styles['padding-bottom'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_padding_bottom')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_padding_left') !== '') {
			$side_area_styles['padding-left'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_padding_left')) . 'px';
		}

		if (!empty($side_area_styles)) {
			echo conall_edge_dynamic_css('.edgtf-side-menu', $side_area_styles);
		}

		if (conall_edge_options()->getOptionValue('side_area_close_icon') == 'dark') {
			echo conall_edge_dynamic_css('.edgtf-side-menu a.edgtf-close-side-menu span, .edgtf-side-menu a.edgtf-close-side-menu i', array(
				'color' => '#000000'
			));
		}

		if (conall_edge_options()->getOptionValue('side_area_close_icon_size') !== '') {
			echo conall_edge_dynamic_css('.edgtf-side-menu a.edgtf-close-side-menu', array(
				'height' => conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'padding' => 0,
			));
			echo conall_edge_dynamic_css('.edgtf-side-menu a.edgtf-close-side-menu span, .edgtf-side-menu a.edgtf-close-side-menu i', array(
				'font-size' => conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'height' => conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_close_icon_size')) . 'px',
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_styles');
}

if (!function_exists('conall_edge_side_area_title_styles')) {

	function conall_edge_side_area_title_styles() {

		$title_styles = array();

		if (conall_edge_options()->getOptionValue('side_area_title_color') !== '') {
			$title_styles['color'] = conall_edge_options()->getOptionValue('side_area_title_color');
		}

		if (conall_edge_options()->getOptionValue('side_area_title_fontsize') !== '') {
			$title_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_title_fontsize')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_title_lineheight') !== '') {
			$title_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_title_lineheight')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_title_texttransform') !== '') {
			$title_styles['text-transform'] = conall_edge_options()->getOptionValue('side_area_title_texttransform');
		}

		if (conall_edge_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('side_area_title_google_fonts')) . ', sans-serif';
		}

		if (conall_edge_options()->getOptionValue('side_area_title_fontstyle') !== '') {
			$title_styles['font-style'] = conall_edge_options()->getOptionValue('side_area_title_fontstyle');
		}

		if (conall_edge_options()->getOptionValue('side_area_title_fontweight') !== '') {
			$title_styles['font-weight'] = conall_edge_options()->getOptionValue('side_area_title_fontweight');
		}

		if (conall_edge_options()->getOptionValue('side_area_title_letterspacing') !== '') {
			$title_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_title_letterspacing')) . 'px';
		}

		if (!empty($title_styles)) {

			echo conall_edge_dynamic_css('.edgtf-side-menu .widget .edgtf-sidearea-widget-title', $title_styles);
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_title_styles');
}

if (!function_exists('conall_edge_side_area_text_styles')) {

	function conall_edge_side_area_text_styles() {
		$text_styles = array();

		if (conall_edge_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('side_area_text_google_fonts')) . ', sans-serif';
		}

		if (conall_edge_options()->getOptionValue('side_area_text_fontsize') !== '') {
			$text_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_text_fontsize')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_text_lineheight') !== '') {
			$text_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_text_lineheight')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('side_area_text_letterspacing')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('side_area_text_fontweight') !== '') {
			$text_styles['font-weight'] = conall_edge_options()->getOptionValue('side_area_text_fontweight');
		}

		if (conall_edge_options()->getOptionValue('side_area_text_fontstyle') !== '') {
			$text_styles['font-style'] = conall_edge_options()->getOptionValue('side_area_text_fontstyle');
		}

		if (conall_edge_options()->getOptionValue('side_area_text_texttransform') !== '') {
			$text_styles['text-transform'] = conall_edge_options()->getOptionValue('side_area_text_texttransform');
		}

		if (conall_edge_options()->getOptionValue('side_area_text_color') !== '') {
			$text_styles['color'] = conall_edge_options()->getOptionValue('side_area_text_color');
		}

		if (!empty($text_styles)) {

			echo conall_edge_dynamic_css('.edgtf-side-menu .widget, .edgtf-side-menu .widget.widget_search form, .edgtf-side-menu .widget.widget_search form input[type="text"], .edgtf-side-menu .widget.widget_search form input[type="submit"], .edgtf-side-menu .widget h6, .edgtf-side-menu .widget h6 a, .edgtf-side-menu .widget p, .edgtf-side-menu .widget li a, .edgtf-side-menu .widget.widget_rss li a.rsswidget, .edgtf-side-menu #wp-calendar caption,.edgtf-side-menu .widget li, .edgtf-side-menu h3, .edgtf-side-menu .widget.widget_archive select, .edgtf-side-menu .widget.widget_categories select, .edgtf-side-menu .widget.widget_text select, .edgtf-side-menu .widget.widget_search form input[type="submit"], .edgtf-side-menu #wp-calendar th, .edgtf-side-menu #wp-calendar td, .edgtf-side-menu .q_social_icon_holder i.simple_social', $text_styles);

		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_text_styles');
}

if (!function_exists('conall_edge_side_area_link_styles')) {

	function conall_edge_side_area_link_styles()	{
		$link_styles = array();

		if (conall_edge_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
			$link_styles['font-family'] = conall_edge_get_formatted_font_family(conall_edge_options()->getOptionValue('sidearea_link_font_family')) . ',sans-serif';
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_font_size') !== '') {
			$link_styles['font-size'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('sidearea_link_font_size')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_line_height') !== '') {
			$link_styles['line-height'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('sidearea_link_line_height')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
			$link_styles['letter-spacing'] = conall_edge_filter_px(conall_edge_options()->getOptionValue('sidearea_link_letter_spacing')) . 'px';
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_font_weight') !== '') {
			$link_styles['font-weight'] = conall_edge_options()->getOptionValue('sidearea_link_font_weight');
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_font_style') !== '') {
			$link_styles['font-style'] = conall_edge_options()->getOptionValue('sidearea_link_font_style');
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_text_transform') !== '') {
			$link_styles['text-transform'] = conall_edge_options()->getOptionValue('sidearea_link_text_transform');
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_color') !== '') {
			$link_styles['color'] = conall_edge_options()->getOptionValue('sidearea_link_color');
		}

		if (!empty($link_styles)) {

			echo conall_edge_dynamic_css('.edgtf-side-menu .widget li a, .edgtf-side-menu .widget a:not(.qbutton)', $link_styles);
		}

		if (conall_edge_options()->getOptionValue('sidearea_link_hover_color') !== '') {
			echo conall_edge_dynamic_css('.edgtf-side-menu .widget a:not(.qbutton):hover', array(
				'color' => conall_edge_options()->getOptionValue('sidearea_link_hover_color')
			));
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_link_styles');
}

if (!function_exists('conall_edge_side_area_border_styles')) {

	function conall_edge_side_area_border_styles() {

		if (conall_edge_options()->getOptionValue('side_area_enable_bottom_border') == 'yes') {

			if (conall_edge_options()->getOptionValue('side_area_bottom_border_color') !== '') {

				echo conall_edge_dynamic_css('.edgtf-side-menu .widget', array(
					'border-bottom' => '1px solid ' . conall_edge_options()->getOptionValue('side_area_bottom_border_color'),
					'margin-bottom' => '10px',
					'padding-bottom' => '10px',
				));
			}
		}
	}

	add_action('conall_edge_style_dynamic', 'conall_edge_side_area_border_styles');
}