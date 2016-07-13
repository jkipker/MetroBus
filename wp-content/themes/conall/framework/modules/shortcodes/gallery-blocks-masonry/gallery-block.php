<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\GalleryBlocksMasonry;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
	* class GalleryBlocksMasonry
*/
class GalleryBlocksMasonry implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'edgtf_gallery_blocks_masonry';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return	$this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' =>  esc_html__('Edge Gallery Blocks Masonry', 'conall'),
			'base' => $this->base,
			'as_parent' => array('only' => 'edgtf_gallery_blocks_masonry_item'),
			'content_element' => true,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-gallery-blocks-masonry extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => 'Extra Class Name',
					'param_name' => 'extra_class',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => 'Space Between Blocks',
					'param_name' => 'space_between_blocks',
					'value' => array(
						'Small' => 'edgtf-small-space',
						'Normal' => 'edgtf-normal-space',
						'Large'  => 'edgtf-large-space'
					),
					'save_always' => true,
					'description' => ''
				)
			)
		) );
	}

	public function render($atts, $content = null) {
		$default_atts=(array(
			'extra_class' => '',
			'space_between_blocks' => 'edgtf-normal-space',
		));

		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$params['content'] = $content;
		
		$output = conall_edge_get_shortcode_module_template_part('templates/gallery-block-template', 'gallery-blocks-masonry', '', $params);

		return $output;
	}
}