<?php 

namespace ConallEdgeNamespace\Modules\Shortcodes\AccordionTab;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
	* class Accordions
*/
class AccordionTab implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'edgtf_accordion_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( array(
				"name" => esc_html__('Edge Accordion Tab', 'conall'),
				"base" => $this->base,
				"as_child" => array('only' => 'edgtf_accordion'),
				'is_container' => true,
				"category" => 'by EDGE',
				"icon" => "icon-wpb-accordion-tab extended-custom-icon",
				"show_settings_on_create" => true,
				"js_view" => 'VcColumnView',
				"params" => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'conall' ),
						'param_name' => 'title',
						'admin_label' => true,
						'value' => esc_html__( 'Section', 'conall' ),
						'description' => esc_html__( 'Enter accordion section title.', 'conall' )
					),
					array(
						'type' => 'el_id',
						'heading' => esc_html__( 'Section ID', 'conall' ),
						'param_name' => 'el_id',
						'description' => sprintf( esc_html__( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'conall' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . esc_html__( 'link', 'conall' ) . '</a>' ),
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => "Title Tag",
						"param_name" => "title_tag",
						"value" => array(
							""   => "",
							"p"  => "p",
							"h2" => "h2",
							"h3" => "h3",
							"h4" => "h4",
							"h5" => "h5",
							"h6" => "h6",
						),
						"description" => ""
					),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Number', 'conall' ),
                        'param_name' => 'number',
                        'admin_label' => true,
                        'value' => '',
                        'description' => esc_html__( 'Notes: This option is only available for type "With Number"', 'conall' )
                    ),
				)

			));
		}
	}	
	public function render($atts, $content = null) {

		$default_atts = (array(
			'title'	=> "Accordion Title",
			'title_tag' => 'h5',
			'el_id' => '',
			'number' => ''
		));
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['content'] = $content;
		
		$output = '';
		
		$output .= conall_edge_get_shortcode_module_template_part('templates/accordion-template','accordions', '',$params);

		return $output;
		
	}

}