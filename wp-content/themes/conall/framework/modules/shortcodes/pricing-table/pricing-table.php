<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\PricingTable;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Pricing Table', 'conall'),
			'base' => $this->base,
			'icon' => 'icon-wpb-pricing-table extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'as_child' => array('only' => 'edgtf_pricing_tables'),
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Type',
					'param_name' => 'type',
					'value' => array(
						'Title Above Price' => 'title_above_price',
						'Title Next To Price' => 'title_in_price'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Title Color',
					'param_name' => 'title_color',
					'group' => 'Design Options',
					'dependency' => array('element' => 'type',  'value' => 'title_above_price') 
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Title Background Color',
					'param_name' => 'title_background_color',
					'group' => 'Design Options',
					'dependency' => array('element' => 'type',  'value' => 'title_above_price') 
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Content Background Color',
					'param_name' => 'content_background_color',
					'group' => 'Design Options'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Title',
					'param_name' => 'title',
					'value' => 'Basic Plan',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Price',
					'param_name' => 'price',
					'description' => 'Default value is 100'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Currency',
					'param_name' => 'currency',
					'description' => 'Default mark is $'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Price Period',
					'param_name' => 'price_period',
					'description' => 'Default label is monthly'
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Show Button',
					'param_name' => 'show_button',
					'value' => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Text',
					'param_name' => 'button_text',
					'dependency' => array('element' => 'show_button',  'value' => 'yes') 
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Link',
					'param_name' => 'link',
					'dependency' => array('element' => 'show_button',  'value' => 'yes')
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Content',
					'param_name' => 'content',
					'value' => '<li>content content content</li><li>content content content</li><li>content content content</li>',
					'description' => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'type'						   => 'title_above_price',
			'title_color'				   => '',
			'title_background_color'	   => '',
			'content_background_color'	   => '',
			'title'         			   => 'Basic Plan',
			'price'         			   => '100',
			'currency'      			   => '$',
			'price_period'  			   => 'Monthly',
			'show_button'				   => 'yes',
			'link'          			   => '',
			'button_text'   			   => 'button'
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html						= '';
		$pricing_table_classes		= 'edgtf-price-table';

		if($type === 'title_above_price') {
			$pricing_table_classes .= ' edgtf-title-above-price';
		} else if($type === 'title_in_price') {
			$pricing_table_classes .= ' edgtf-title-in-price';
		}
		
		$params['pricing_table_classes'] = $pricing_table_classes;
		$params['content']= preg_replace('#^<\/p>|<p>$#', '', $content); // delete p tag before and after content
		$params['pricing_table_styles'] = $this->getPricingTableStyles($params);
		$params['pricing_title_styles'] = $this->getPricingTitleStyles($params);

		$html .= conall_edge_get_shortcode_module_template_part('templates/pricing-table-template','pricing-table', '', $params);
		return $html;
	}

	/**
	 * Return pricing table styles
	 *
	 * @param $params
	 * @return array
	 */
	private function getPricingTableStyles($params) {

		$itemStyle = array();

		if ($params['content_background_color'] !== '') {
            $itemStyle[] = 'background-color: ' . $params['content_background_color'];
        }

		return implode(';', $itemStyle);
	}

	/**
	 * Return pricing table title styles
	 *
	 * @param $params
	 * @return array
	 */
	private function getPricingTitleStyles($params) {

		$itemStyle = array();

		if ($params['title_color'] !== '') {
            $itemStyle[] = 'color: ' . $params['title_color'];
        }

        if ($params['title_background_color'] !== '') {
            $itemStyle[] = 'background-color: ' . $params['title_background_color'];
        }

		return implode(';', $itemStyle);
	}
}