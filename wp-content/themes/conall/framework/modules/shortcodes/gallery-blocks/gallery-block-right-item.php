<?php 
namespace ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocksRightItem;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
	* class GalleryBlocksRightItem
*/
class GalleryBlocksRightItem implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'edgtf_gallery_blocks_right_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( array(
				"name" => esc_html__('Edge Gallery Blocks Right Item', 'conall'),
				"base" => $this->base,
				"as_child" => array('only' => 'edgtf_gallery_blocks'),
				"category" => 'by EDGE',
				"icon" => "icon-wpb-gallery-blocks-right-item extended-custom-icon",
				"params" => array(
					array(
						'type' => 'dropdown',
						'class' => '',
						'heading' => 'Block Item Type',
						'param_name' => 'block_item_type',
						'value' => array(
							'Text Block'  => 'edgtf-text-block',
							'Image Block' => 'edgtf-image-block'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type'			=> 'attach_images',
						'heading'		=> 'Images',
						'param_name'	=> 'images',
						'description'	=> 'Select images from media library. The first image you upload will be set as the featured image if you set Featured Image Size.',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-image-block'))
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> 'Featured Image Size',
						'param_name'	=> 'featured_image_size',
						'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to disable featured image',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-image-block'))
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> 'Image Size',
						'param_name'	=> 'image_size',
						'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-image-block'))
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> 'Enable Lightbox Functionality',
						'param_name'	=> 'enable_lightbox',
						'value'			=> array(
							'No'		=> 'no',
							'Yes'		=> 'yes'
						),
						'save_always'	=> true,
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-image-block'))
					),
	                array(
						'type' => 'colorpicker',
						'heading' => 'Block Background Color',
						'param_name' => 'background_color',
						'description' => '',
						'group' => 'Content Styles',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-text-block'))
					),
					array(
						'type' => 'textfield',
						'heading' => 'Block Padding',
						'param_name' => 'block_padding',
						'description' => 'Insert padding in ex. format: 0 10px 20px 0. (top right bottom left). You can enter the padding in pixels or percentages.',
						'group' => 'Content Styles',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-text-block'))
					),
					array(
	                    'type'       => 'dropdown',
	                    'heading'    => 'Content Text Alignment',
	                    'param_name' => 'content_text_alignment',
	                    'value'      => array(
	                        'Default'   => '',
	                        'Center' => 'center',
	                        'Right' => 'right'
	                    ),
	                    'group' => 'Content Styles',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-text-block'))
	                ),
					array(
	                    'type'        => 'textfield',
	                    'heading'     => 'Title',
	                    'param_name'  => 'title',
	                    'value'       => '',
	                    'admin_label' => true,
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-text-block'))
	                ),
	                array(
	                    'type'       => 'dropdown',
	                    'heading'    => 'Title Tag',
	                    'param_name' => 'title_tag',
	                    'value'      => array(
	                        ''   => '',
	                        'h2' => 'h2',
	                        'h3' => 'h3',
	                        'h4' => 'h4',
	                        'h5' => 'h5',
	                        'h6' => 'h6',
	                    ),
	                    'dependency' => array('element' => 'title', 'not_empty' => true)
	                ),
	                array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => '',
						'group' => 'Text Styles',
	                    'dependency' => array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title Margin',
						'param_name' => 'title_margin',
						'description' => 'Insert margin in ex. format: 0 0 20px 0. (top right bottom left)',
						'group' => 'Text Styles',
	                    'dependency' => array('element' => 'title', 'not_empty' => true)
					),
	                array(
	                    'type'       => 'textarea',
	                    'heading'    => 'Text',
	                    'param_name' => 'text',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-text-block'))
	                ),
					array(
						'type' => 'colorpicker',
						'heading' => 'Text Color',
						'param_name' => 'text_color',
						'description' => '',
						'group' => 'Text Styles',
	                    'dependency' => array('element' => 'text', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Text Margin',
						'param_name' => 'Text_margin',
						'description' => 'Insert margin in ex. format: 0 0 20px 0. (top right bottom left)',
						'group' => 'Text Styles',
	                    'dependency' => array('element' => 'text', 'not_empty' => true)
					),
					array(
						'type'			=> 'attach_image',
						'heading'		=> 'Text Image',
						'param_name'	=> 'text_image',
						'description'	=> 'Select image from media library',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-text-block'))
					),
	                array(
	                    'type'        => 'textfield',
	                    'heading'     => 'Button Link',
	                    'param_name'  => 'button_link',
	                    'value'       => '',
	                    'dependency' => array('element' => 'block_item_type', 'value' => array('edgtf-text-block'))
	                ),
	                array(
	                    'type'        => 'textfield',
	                    'heading'     => 'Button Link Text',
	                    'param_name'  => 'button_link_text',
	                    'description' => 'Default label is READ MORE',
	                    'dependency'  => array('element' => 'button_link', 'not_empty' => true)
	                ),
	                array(
	                    'type'       => 'dropdown',
	                    'heading'    => 'Button Link Target',
	                    'param_name' => 'button_link_target',
	                    'value'      => array(
	                        ''      => '',
	                        'Same Window'  => '_self',
                        	'New Window' => '_blank'
	                    ),
	                    'save_always' => true,
	                    'dependency' => array('element' => 'button_link', 'not_empty' => true),
	                ),
	                array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Type',
                        'param_name'  => 'button_type',
                        'value'       => array(
                            'Outline' => 'outline',
                            'Simple'  => 'simple',
                            'Solid'   => 'solid',
                        ),
                        'save_always' => true,
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Button Size',
                        'param_name'  => 'button_size',
                        'value'       => array(
                            'Small'       => 'small',
                            'Medium'      => 'medium',
                            'Large'       => 'large',
                            'Extra Large' => 'huge',
                        ),
                        'save_always' => true,
                        'description' => 'This option is only for outline and solid button type',
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Button Color',
                        'param_name'  => 'button_color',
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Button Hover Color',
                        'param_name'  => 'button_hover_color',
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Button Background Color',
                        'param_name'  => 'button_background_color',
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Button Hover Background Color',
                        'param_name'  => 'button_hover_background_color',
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Button Border Color',
                        'param_name'  => 'button_border_color',
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Button Hover Border Color',
                        'param_name'  => 'button_hover_border_color',
                        'group'       => 'Button Styles',
                        'dependency'  => array('element' => 'button_link', 'not_empty' => true)
                    ),
                    array(
						'type' => 'textfield',
						'heading' => 'Button Margin',
						'param_name' => 'button_margin',
						'description' => 'Insert margin in ex. format: 0 0 20px 0. (top right bottom left)',
						'group' => 'Button Styles',
	                    'dependency' => array('element' => 'button_link', 'not_empty' => true)
					),
				)
			));
		}
	}

	public function render($atts, $content = null) {

		$default_atts = (array(
			'block_item_type' 				=> 'edgtf-text-block',
			'images'			    		=> '',
			'featured_image_size'  			=> '',
			'image_size'	    			=> 'full',
			'enable_lightbox'   			=> '',
			'background_color' 				=> '',
			'block_padding'					=> '',
			'content_text_alignment'		=> '',
			'title'			  				=> '',
			'title_tag'	 	  				=> 'h3',
			'title_color'	 				=> '',
			'title_margin'	 				=> '',
			'text'			 				=> '',
			'text_color'	  				=> '',
			'text_margin'	 				=> '',
			'text_image'					=> '',
			'button_link'			 		=> '',
			'button_link_text'		  		=> 'READ MORE',
			'button_link_target'			=> '_self',
            'button_type'                   => '',
			'button_size'                   => '',
            'button_color'                  => '',
            'button_hover_color'            => '',
            'button_background_color'       => '',
            'button_hover_background_color' => '',
            'button_border_color'           => '',
            'button_hover_border_color'     => '',
            'button_margin'					=> '',
		));
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['content'] = $content;

		$params['images'] 			   = $this->getImages($params);
		$params['featured_image_size'] = $this->getFeaturedImageSize($params['featured_image_size']);
		$params['image_size'] 		   = $this->getImageSize($params['image_size']);

		$params['title_tag'] 		  = !empty($params['title_tag']) ? $params['title_tag'] : 'h3';
		$params['title_styles'] 	  = $this->getTitleStyle($params);
		$params['text_styles']  	  = $this->getTextStyle($params);
		$params['text_custom_image']  = $this->getTextImage($params);

        $params['button_link_target'] = !empty($params['button_link_target']) ? $params['button_link_target'] : '_self';
        $params['button_classes'] 	  = $this->getButtonClasses($params);
		$params['button_styles']  	  = $this->getButtonStyles($params);
        $params['button_data']    	  = $this->getButtonDataAttr($params);
        $params['button_text_class'] = '';
        if($params['button_type'] === 'simple') {
        	$params['button_text_class'] = 'edgtf-shuffle';
        }

        $params['holder_class']  = ($params['block_item_type'] === 'edgtf-image-block' && $params['featured_image_size'] === 'no-image') ? 'edgtf-gb-fi-disabled' : '';
		$params['holder_styles'] = $this->getHolderStyle($params);

		$output = conall_edge_get_shortcode_module_template_part('templates/gallery-block-item-template', 'gallery-blocks', '', $params);

		return $output;
	}

	private function getHolderStyle($params){
		$itemStyles = array();
		
		if(!empty($params['background_color']) && $params['block_item_type'] === 'edgtf-text-block') {
            $itemStyles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['block_padding']) && $params['block_item_type'] === 'edgtf-text-block') {
            $itemStyles[] = 'padding: '.$params['block_padding'];
        }

        if($params['content_text_alignment'] !== '' && $params['block_item_type'] === 'edgtf-text-block') {
            $itemStyles[] = 'text-align: '.$params['content_text_alignment'];
        }

        return implode(';', $itemStyles);
	}

	private function getImages($params) {
        $image_ids = array();
		$images = array();
		$i = 0;

		if ($params['images'] !== '') {
			$image_ids = explode(',', $params['images']);
		}

		foreach ($image_ids as $id) {

			$image['image_id'] = $id;
			$image_original = wp_get_attachment_image_src($id, 'full');
			$image['url'] = $image_original[0];
			$image['title'] = get_the_title($id);

			$images[$i] = $image;
			$i++;
		}

		return $images;
	}

	private function getFeaturedImageSize($featured_image_size) {

		$featured_image_size = trim($featured_image_size);
		//Find digits
		preg_match_all( '/\d+/', $featured_image_size, $matches );
		if(in_array( $featured_image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $featured_image_size;
		} elseif(!empty($matches[0])) {
			return array(
					$matches[0][0],
					$matches[0][1]
			);
		} else {
			return 'no-image';
		}
	}

	private function getImageSize($image_size) {

		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $image_size;
		} elseif(!empty($matches[0])) {
			return array(
					$matches[0][0],
					$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}

	private function getTitleStyle($params){
		$itemStyles = array();
		
		if(!empty($params['title_color'])) {
            $itemStyles[] = 'color: '.$params['title_color'];
        }

        if(!empty($params['title_margin'])) {
            $itemStyles[] = 'margin: '.$params['title_margin'];
        }

        return implode(';', $itemStyles);
	}

	private function getTextImage($params) {
        $image = array();

        if ($params['text_image'] !== '') {
            $id = $params['text_image'];

            $image['image_id'] = $id;
            $image_original = wp_get_attachment_image_src($id, 'full');
            $image['url'] = $image_original[0];
            $image['title'] = get_the_title($id);
        }

		return $image;
	}

	private function getTextStyle($params){
		$itemStyles = array();
		
		if(!empty($params['text_color'])) {
            $itemStyles[] = 'color: '.$params['text_color'];
        }

        if(!empty($params['text_margin'])) {
            $itemStyles[] = 'margin: '.$params['text_margin'];
        }

        return implode(';', $itemStyles);
	}

    private function getButtonStyles($params) {
        $styles = array();

        if(!empty($params['button_color'])) {
            $styles[] = 'color: '.$params['button_color'];
        }

        if(!empty($params['button_background_color']) && $params['button_type'] !== 'outline') {
            $styles[] = 'background-color: '.$params['button_background_color'];
        }

        if(!empty($params['button_border_color'])) {
            $styles[] = 'border-color: '.$params['button_border_color'];
        }

        if(!empty($params['button_margin'])) {
            $styles[] = 'margin: '.$params['button_margin'];
        }

        return $styles;
    }

    private function getButtonDataAttr($params) {
        $data = array();

        if(!empty($params['button_hover_background_color'])) {
            $data['data-hover-bg-color'] = $params['button_hover_background_color'];
        }

        if(!empty($params['button_hover_color'])) {
            $data['data-hover-color'] = $params['button_hover_color'];
        }

        if(!empty($params['button_hover_border_color'])) {
            $data['data-hover-border-color'] = $params['button_hover_border_color'];
        }

        return $data;
    }

    private function getButtonClasses($params) {
    	$params['button_type'] = !empty($params['button_type']) ? $params['button_type'] : 'outline';
		$params['button_size'] = !empty($params['button_size']) ? $params['button_size'] : 'medium';

        $buttonClasses = array(
            'edgtf-btn',
            'edgtf-btn-'.$params['button_type'],
            'edgtf-btn-'.$params['button_size']
        );

        if($params['button_type'] === 'simple') {
        	$buttonClasses[] = 'edgtf-btn-icon';
        }

        if(!empty($params['button_hover_background_color'])) {
            $buttonClasses[] = 'edgtf-btn-custom-hover-bg';
        }

        if(!empty($params['button_hover_border_color'])) {
            $buttonClasses[] = 'edgtf-btn-custom-border-hover';
        }

        if(!empty($params['button_hover_color'])) {
            $buttonClasses[] = 'edgtf-btn-custom-hover-color';
        }

        return $buttonClasses;
    }
}