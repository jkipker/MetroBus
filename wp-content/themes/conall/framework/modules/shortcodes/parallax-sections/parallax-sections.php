<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\ParallaxSections;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;

class ParallaxSections implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_parallax_sections';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Parallax Section Holder', 'conall'),
			'base' => $this->base,
			'icon' => 'icon-wpb-parallax-sections extended-custom-icon',
			'category' => 'by EDGE',
			'as_parent' => array('only' => 'edgtf_parallax_section'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'colorpicker',
					'class' => '',
					'heading' => 'Background Color',
					'param_name' => 'background_color',
					'value' => '',
					'description' => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'background_color'  => ''
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '';

		$parallax_sections_classes = array();
		$parallax_sections_classes[] = 'edgtf-parallax-sections';
		$parallax_sections_style = '';

		if($background_color != ''){
			$parallax_sections_style .= 'background-color:'. $background_color . ';';
		}

		$parallax_sections_class = implode(' ', $parallax_sections_classes);

		$html .= '<div ' . conall_edge_get_class_attribute($parallax_sections_class) . ' ' . conall_edge_get_inline_attr($parallax_sections_style, 'style'). '>';
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;

	}

}
