<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\Tab;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Tab
 */

class Tab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'edgtf_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Edge Tab', 'conall'),
			'base' => $this->getBase(),
			'as_parent' => array('except' => 'vc_row'),
			'as_child' => array('only' => 'edgtf_tabs'),
			'is_container' => true,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-tab extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Title',
					'param_name' => 'title',
					'description' => ''
                )
			)
		));

	}

	public function render($atts, $content = null) {
		
		$default_atts = array(
			'title' => 'Tab',
			'tab_id' => ''
		);

		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$rand_number = rand(0, 1000);
		$params['title'] = $params['title'].'-'.$rand_number;

		$params['content'] = $content;
		
		$output = '';
		$output .= conall_edge_get_shortcode_module_template_part('templates/tab-content','tabs', '', $params);
		return $output;
	}
}