<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\Accordion;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
	* class Accordions
*/
class Accordion implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'edgtf_accordion';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' =>  esc_html__('Edge Accordion', 'conall'),
			'base' => $this->base,
			'as_parent' => array('only' => 'edgtf_accordion_tab'),
			'content_element' => true,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-accordion extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'conall' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'conall' )
				),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => 'Type',
                    'param_name' => 'type',
                    'value' => array(
                        'Default (with sign)' => 'default',
                        'With Numbers' => 'with_numbers'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
				array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => 'Style',
					'param_name' => 'style',
					'value' => array(
						'Accordion'       => 'accordion',
						'Toggle'          => 'toggle'
					),
					'save_always' => true,
					'description' => ''
				),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => 'Icon Position',
                    'param_name' => 'icon_position',
                    'value' => array(
                        'Default (Right)'       => '',
                        'Left'          => 'left'
                    ),
                    'dependency' => array('element' => 'type', 'value' => array('default')),
                    'description' => ''
                )
			)
		) );
	}
	public function render($atts, $content = null) {
		$default_atts=(array(
			'type' => 'default',
			'title' => '',
			'style' => 'accordion',
			'icon_position' => ''
		));
		$params = shortcode_atts($default_atts, $atts);
		extract($params);

 		$acc_class = $this->getAccordionClasses($params);
		$params['acc_class'] = $acc_class;
		$params['content'] = $content;

		$output = '';

		$output .= conall_edge_get_shortcode_module_template_part('templates/accordion-holder-template','accordions', '', $params);

		return $output;
	}

	/**
	   * Generates accordion classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getAccordionClasses($params){

		$acc_class = '';
		$style = $params['style'];
		switch($params['type']) {
			case 'default':
				$acc_class .= 'edgtf-ac-default';
				break;
            case 'with_numbers':
                $acc_class .= 'edgtf-ac-with-numbers';
                break;
            default:
				break;
		}

        switch($style) {
            case 'toggle':
                $acc_class .= ' edgtf-toggle';
                break;
            default:
                $acc_class .= ' edgtf-accordion';
                break;
        }

        $icon_position = $params['icon_position'];
        switch($icon_position) {
            case 'left':
                $acc_class .= ' edgtf-ac-icon-left';
                break;
            default:
                break;
        }


        return $acc_class;
	}
}
