<?php

namespace ConallEdgeNamespace\Modules\Shortcodes\BlogSlider;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class BlogSlider
 */
class BlogSlider implements ShortcodeInterface {
	/**
	* @var string
	*/
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_blog_slider';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Edge Blog Slider', 'conall'),
			'base' => $this->base,
			'icon' => 'icon-wpb-blog-slider extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Number of Posts',
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
                        'save_always' => true,
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
						'description' => 'Leave empty for all or use comma for list'
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Image Size',
						'param_name' => 'image_size',
						'value' => array(
							'Original' => 'original',
							'Landscape' => 'landscape',
							'Square' => 'square'
						),
						'description' => '',
                        'save_always' => true
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Text Length',
						'param_name' => 'text_length',
						'description' => 'Number of characters',
					),
					array(
						'type' => 'dropdown',
						'class' => '',
						'heading' => 'Title Tag',
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'description' => ''
					),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Enable Post Info Section',
                        'param_name' => 'post_info_section',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'save_always' => true,
                        'description' => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Enable Post Info Author',
                        'param_name' => 'post_info_author',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'save_always' => true,
                        'dependency' => Array('element' => 'post_info_section', 'value' => array('yes'))
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Enable Post Info Date',
                        'param_name' => 'post_info_date',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'save_always' => true,
                        'dependency' => Array('element' => 'post_info_section', 'value' => array('yes'))
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Enable Post Info Category',
                        'param_name' => 'post_info_category',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'save_always' => true,
                        'dependency' => Array('element' => 'post_info_section', 'value' => array('yes'))
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Enable Post Info Comments',
                        'param_name' => 'post_info_comments',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'save_always' => true,
                        'dependency' => Array('element' => 'post_info_section', 'value' => array('yes'))
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Enable Post Info Like',
                        'param_name' => 'post_info_like',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Navigation',
                        'param_name' => 'navigation',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        ),
                        'save_always' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'heading' => 'Pagination',
                        'param_name' => 'pagination',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'save_always' => true,
                    ),
				)
		) );

	}
	public function render($atts, $content = null) {
		
		$default_atts = array(
            'number_of_posts' => '',
            'number_of_columns' => '',
            'image_size' => 'original',
            'order_by' => '',
            'order' => '',
            'category' => '',
            'title_tag' => 'h5',
			'text_length' => '90',
			'title_text_length' => '40',
            'post_info_section' => 'yes',
            'post_info_author' => 'no',
            'post_info_date' => 'no',
            'post_info_category' => 'yes',
            'post_info_comments' => 'no',
            'post_info_like' => 'yes',
            'navigation' => 'yes',
            'pagination' => 'yes'
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['blog_slider_data_attributes'] = $this->getBlogSliderDataAttributes($params);
	
		$queryArray = $this->generateBlogQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;	
     
		
        $thumbImageSize = $this->generateImageSize($params);
		$params['thumb_image_size'] = $thumbImageSize;

		$html = '';
        $html .= conall_edge_get_shortcode_module_template_part('templates/blog-slider-holder', 'blog-slider', '', $params);
		return $html;	
	}

    /**
     * Return data attributes for blog slider
     *
     * @param $params
     * @return array
     */
    private function getBlogSliderDataAttributes($params) {

        $slider_data = array();

        if ($params['number_of_columns'] !== '') {
            $slider_data['data-columns'] = $params['number_of_columns'];
        }
        if ($params['navigation'] !== '') {
            $slider_data['data-navigation'] = $params['navigation'];
        }
        if ($params['pagination'] !== '') {
            $slider_data['data-pagination'] = $params['pagination'];
        }

        return $slider_data;
    }

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateBlogQueryArray($params){
		
		$queryArray = array(
			'orderby' => $params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'category_name' => $params['category']
		);
		return $queryArray;
	}

	/**
	   * Generates image size option
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function generateImageSize($params){
		$thumbImageSize = '';
		$imageSize = $params['image_size'];
		
		if ($imageSize !== '' && $imageSize == 'landscape') {
            $thumbImageSize .= 'conall_edge_landscape';
        } else if($imageSize === 'square'){
			$thumbImageSize .= 'conall_edge_square';
		} else if ($imageSize !== '' && $imageSize == 'original') {
            $thumbImageSize .= 'full';
        } else if ($imageSize !== '' && $imageSize == 'sidebar') {
            $thumbImageSize .= 'sidebar';
        }
		return $thumbImageSize;
	}
}