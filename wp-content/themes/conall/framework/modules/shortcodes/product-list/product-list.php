<?php

namespace ConallEdgeNamespace\Modules\Shortcodes\ProductList;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class ProductList
 */
class ProductList implements ShortcodeInterface {
	/**
	* @var string
	*/
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_product_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Edge Product List', 'conall'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-list extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Number of Products',
						'param_name' => 'number_of_posts',
						'description' => ''
					),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Number of Columns',
                        'param_name' => 'number_of_columns',
                        'value' => array(
                            'One' => '1',
                            'Two' => '2',
                            'Three' => '3',
                            'Four' => '4'
                        ),
                        'description' => '',
                        'save_always' => true
                    ),
                    array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Space Between Items',
						'param_name' => 'space_between_items',
						'value' => array(
							'Normal' => 'normal',
							'Small' => 'small'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Order By',
						'param_name' => 'order_by',
						'value' => array(
							'Title' => 'title',
							'Date' => 'date',
							'Random' => 'rand',
							'Post Name' => 'name'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Order',
						'param_name' => 'order',
						'value' => array(
							'ASC' => 'ASC',
							'DESC' => 'DESC'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Category Slug',
						'param_name' => 'category',
						'description' => ''
					),
	                array(
						'type' => 'dropdown',
						'class' => '',
						'heading' => 'Switch Product Info Box Below Image',
						'param_name' => 'switch_box_below_image',
						'value' => array(
							'Default' => '',
							'Yes' => 'yes'
						),
						'description' => ''
					),
					array(
	                    'type' => 'colorpicker',
	                    'admin_label' => true,
	                    'heading' => 'Product Info Box Background Color',
	                    'param_name' => 'box_background_color',
	                    'description' => ''
	                )
				)
		) );

	}
	public function render($atts, $content = null) {
		
		$default_atts = array(
            'number_of_posts' 		 => '8',
            'number_of_columns' 	 => '4',
            'space_between_items'	 => 'normal',
            'order_by' 				 => '',
            'order' 				 => '',
            'category' 				 => '',
			'switch_box_below_image' => '',
			'box_background_color'	 => ''
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['product_info_styles'] = $this->getProductInfoStyle($params);
	
		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;	

		$html ='';
        $html .= conall_edge_get_shortcode_module_template_part('templates/product-list-template', 'product-list', '', $params);
		return $html;	
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getHolderClasses($params){
		$holderClasses = '';

		$spaceBetweenItems = $params['space_between_items'];

        switch ($spaceBetweenItems) {
            case 'normal':
                $holderClasses = 'edgtf-normal-space';
                break;
            case 'small':
                $holderClasses = 'edgtf-small-space';
                break;
            default:
                $holderClasses = 'edgtf-normal-space';
                break;
        }

        $columnNumber = $this->getColumnNumberClass($params);

        $holderClasses .= ' '.$columnNumber;
		
		return $holderClasses;
	}

    /**
     * Generates column classes for boxes type
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params){

        $columnsNumber = '';
        $columns = $params['number_of_columns'];

        switch ($columns) {
            case 1:
                $columnsNumber = 'edgtf-one-column';
                break;
            case 2:
                $columnsNumber = 'edgtf-two-columns';
                break;
            case 3:
                $columnsNumber = 'edgtf-three-columns';
                break;
            case 4:
                $columnsNumber = 'edgtf-four-columns';
                break;
            default:
                $columnsNumber = 'edgtf-four-column';
                break;
        }

        return $columnsNumber;
    }

    private function getProductInfoStyle($params) {
        $itemStyle = array();

        if ($params['switch_box_below_image'] === 'yes') {
            $itemStyle[] = 'position: relative';
        }

        if ($params['box_background_color'] !== '') {
            $itemStyle[] = 'background-color: ' . $params['box_background_color'];
        }

        return implode(';', $itemStyle);
    }

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateProductQueryArray($params){
		
		$queryArray = array(
			'post_type' => 'product',
			'posts_per_page' => $params['number_of_posts'],
			'category_name' => $params['category'],
			'orderby' => $params['order_by'],
			'order' => $params['order']
		);
		return $queryArray;
	}
}