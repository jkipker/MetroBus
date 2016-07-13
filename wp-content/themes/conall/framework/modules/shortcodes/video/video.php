<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\Video;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Video
 */
class Video implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_video';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see edgt_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map( array(
				'name' => esc_html__('Edge Video', 'conall'),
				'base' => $this->getBase(),
				'category' => 'by EDGE',
				'icon' => 'icon-wpb-video-button extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						"type" => "textfield",
						"heading" => "Video Link",
						"param_name" => "video_link",
						"value" => ""
					),
                    array(
                        "type" => "attach_image",
                        "heading" => "Video Thumbnail",
                        "param_name" => "video_thumbnail",
                        "value" => "",
                        "dependency" => array('element' => 'video_link', 'not_empty' => true),
                    ),
                    array(
                        'type'			=> 'textfield',
                        'heading'		=> 'Image Size',
                        'param_name'	=> 'video_thumbnail_size',
                        'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size'
                    ),
					array(
						"type" => "textfield",
						"heading" => "Play Button Size (px)",
						"param_name" => "button_size",
						"value" => "",
						"dependency" => array('element' => 'video_link', 'not_empty' => true),
					),
					array(
						"type" => "textfield",
						"heading" => "Title",
						"param_name" => "title",
						"value" => "",
					),
					array(
						"type" => "dropdown",
						"heading" => "Title Tag",
						"param_name" => "title_tag",
						"value" => array(
							""   => "",
							"h2" => "h2",
							"h3" => "h3",
							"h4" => "h4",
							"h5" => "h5",
							"h6" => "h6",
						),
						"dependency" => array('element' => 'title', 'not_empty' => true),
					),
				)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'video_link' => '#',
			'video_thumbnail' => '',
			'video_thumbnail_size' => '',
			'button_size' => '',
			'title' => '',
			'title_tag' => 'h5',
		);

		$params = shortcode_atts($args, $atts);

		$params['button_style'] = $this->getButtonStyle($params);
		$params['video_title_tag'] = $this->getVideoButtonTitleTag($params,$args);
        $params['video_thumbnail_size'] = $this->getImageSize($params['video_thumbnail_size']);

		//Get HTML from template
		$html = conall_edge_get_shortcode_module_template_part('templates/video-template', 'video', '', $params);

		return $html;

	}

	/**
	 * Return Style for Button
	 *
	 * @param $params
	 * @return string
	 */
	private function getButtonStyle($params) {
		$button_style = array();

		if ($params['button_size'] !== '') {
			$button_size = strstr($params['button_size'], 'px') ? $params['button_size'] : $params['button_size'].'px';
			$button_style[] = 'width: '.$button_size;
			$button_style[] = 'height: '.$button_size;
			$button_style[] = 'font-size: '. intval($button_size)*0.8 .'px';
		}

		return implode(';', $button_style);
	}

	/**
	 * Return Title Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return string
	 */
	private function getVideoButtonTitleTag($params,$args) {
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
	}

    /**
     * Return image size or custom image size array
     *
     * @param $image_size
     * @return array
     */
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
}