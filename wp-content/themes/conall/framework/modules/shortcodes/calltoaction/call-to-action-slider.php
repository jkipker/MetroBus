<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\CallToActionSlider;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;

class CallToActionSlider implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_call_to_action_slider';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
                'name' => esc_html__('Edge Call To Action Slider', 'conall'),
				'base' => $this->base,
				'as_parent' => array('only' => 'edgtf_call_to_action'),
                'is_container' => true,
				'category' => 'by EDGE',
				'icon' => 'icon-wpb-call-to-action-slider extended-custom-icon',
                'js_view' => 'VcColumnView',
				'show_settings_on_create' => true,
				'params' => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Custom CSS class',
                        'param_name'  => 'custom_class',
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Show navigation?',
                        'param_name' => 'show_navigation',
                        'value' => array(
                            'No' => '',
                            'Next/Prev' => 'next-prev',
                            'Paging' => 'paging',
                        ),
                        'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Slider Speed',
                        'admin_label' => true,
                        'value' => '5000',
                        'param_name' => 'animation_speed',
                        'save_always' => true,
                        'description' => 'Default value is 5000. Value is in ms.'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Navigation Skin',
                        'param_name' => 'skin',
                        'value' => array(
                            'Default' => '',
                            'Light' => 'light',
                            'Dark' => 'dark'
                        ),
                        'admin_label' => true,
                        'description' => ''
                    ),
				),
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'custom_class'          => '',
			'show_navigation'       => 'paging',
            'animation_speed'       => '5000',
            'skin'                  => ''
		);
		
		$params = shortcode_atts($args, $atts);
        $params['call_to_action_data_attributes'] = $this->getCallToActionDataAttributes($params);
        $params['holder_classes']  = $this->getHolderClasses($params);
		extract($params);

		$html = '<div class="edgtf-call-to-action-slider clearfix '.esc_attr($holder_classes).'">';
            $html .= '<div class="edgtf-call-to-action-slider-inner edgtf-grid"' .  conall_edge_get_inline_attrs($call_to_action_data_attributes) . '>';
                $html .= do_shortcode($content);
            $html .= '</div>';

            if($show_navigation == 'next-prev') {
                $html .= '<div class="edgtf-cta-nav edgtf-cta-controls">';
                    $html .= '<a href="#" class="edgtf-cta-nav-prev"><span class="edgtf-icon-mark"></span><span class="edgtf-nav-label">PREV</span></a>';
                    $html .= '<a href="#" class="edgtf-cta-nav-next"><span class="edgtf-nav-label">NEXT</span><span class="edgtf-icon-mark"></span></a>';
                $html .= '</div>';
            }

            if($show_navigation == 'paging') {
                $html .= '<div class="edgtf-cta-dots edgtf-cta-controls">';
                $html .= '</div>';
            }

        $html .= '</div>';

		return $html;
	}


    /**
     * Return all data that call to action slider needs
     *
     * @param $params
     * @return array
     */
    private function getCallToActionDataAttributes($params){

        $data_attr = array();

        if(!empty($params['show_navigation'])){
            $data_attr['data-navigation'] = $params['show_navigation'];
        }
        if(!empty($params['animation_speed'])){
            $data_attr['data-speed'] = $params['animation_speed'];
        }

        return $data_attr;
    }

    /**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = '';

        if(!empty($params['custom_class'])) {
            $classes .= $params['custom_class'];
        }

        if(!empty($params['skin'])) {
            switch($params['skin']) {
                case 'light':
                    $classes .= ' edgtf-ctas-light';
                    break;
                case 'dark':
                    $classes .= ' edgtf-ctas-dark';
                    break;
                default:
                    break;
            }
        }

        return $classes;
    }
}