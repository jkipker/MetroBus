<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\SectionTitle;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class SectionTitle
 */
class SectionTitle implements ShortcodeInterface	{
	private $base; 
	
	function __construct() {
		$this->base = 'edgtf_section_title';

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
			'name' => esc_html__('Edge Section Title', 'conall'),
			'base' => $this->base,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-section-title extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>	array(
                array(
                    'type' => 'textfield',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'admin_label' => true,
                    'description' => ''
                ),
                array(
                    "type" => "dropdown",
                    "heading" => "Tag",
                    "param_name" => "title_tag",
                    "value" => array(
                        "h2" => "h2",
                        "h3" => "h3",
                        "h4" => "h4",
                        "h5" => "h5",
                        "h6" => "h6"
                    ),
                    'save_always' => true,
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Color",
                    "param_name" => "title_color",
                    "description" => "",
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Font family",
                    "param_name" => "title_font_family",
                    "value" => "",
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Font size (px)",
                    "param_name" => "title_font_size",
                    "value" => "",
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Line height (px)",
                    "param_name" => "title_line_height",
                    "value" => "",
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "dropdown",
                    "heading" => "Font Style",
                    "param_name" => "title_font_style",
                    "value" => conall_edge_get_font_style_array(),
                    "description" => "",
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "dropdown",
                    "heading" => "Font weight",
                    "param_name" => "title_font_weight",
                    "value" => conall_edge_get_font_weight_array(true),
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Letter Spacing (px)",
                    "param_name" => "title_letter_spacing",
                    "value" => "",
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "dropdown",
                    "heading" => "Text transform",
                    "param_name" => "title_text_transform",
                    "value" => conall_edge_get_text_transform_array(true),
                    "description" => "",
                    'group'	=> 'Title'
                ),
                array(
                    "type" => "dropdown",
                    "heading" => "Text Align",
                    "param_name" => "title_text_align",
                    "value" => array(
                        "" => "",
                        "Left" => "left",
                        "Center" => "center",
                        "Right" => "right"
                    ),
                    "description" => "",
                    'group'	=> 'Title'
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => 'Enable Separator',
                    'param_name' => 'enable_separator',
                    'value' => array(
                        'No' => 'no',
                        'Yes' => 'yes'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Color",
                    "param_name" => "separator_color",
                    "description" => "",
                    'group'	=> 'Separator Settings'
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Thickness (px)",
                    "param_name" => "separator_thickness",
                    "value" => "",
                    'group'	=> 'Separator Settings'
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Width (px)",
                    "param_name" => "separator_width",
                    "value" => "",
                    'group'	=> 'Separator Settings'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => 'Top Margin',
                    'param_name' => 'separator_top_margin',
                    'value' => '',
                    'description' => '',
                    'group'	=> 'Separator Settings'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => 'Bottom Margin',
                    'param_name' => 'separator_bottom_margin',
                    'value' => '',
                    'group'	=> 'Separator Settings'
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => 'Content',
                    'param_name' => 'content',
                    'value' => '<p>'.'I am test text for Message shortcode.'.'</p>',
                    'description' => ''
                )

            )
		) );

	}

	public function render($atts, $content = null) {
		
		$args = array(
            'title' => '',
            'title_font_tag' => 'h2',
            'title_color' => '',
            'title_font_family' => '',
            'title_font_size' => '',
            'title_line_height' => '',
            'title_font_style' => '',
            'title_font_weight' => '',
            'title_letter_spacing' => '',
            'title_text_transform' => '',
            'title_text_align' => '',
            'enable_separator' => '',
            'separator_color' => '',
            'separator_thickness' => '',
            'separator_width' => '',
            'separator_top_margin' => '',
            'separator_bottom_margin' => ''
        );

		$params = shortcode_atts($args, $atts);
		$params['content'] = $content;

		//Get HTML from template based on type of team

        $params['title_styles'] = $this->getTitleStyles($params);
        $params['text_styles'] = $this->getTextStyles($params);
        $params['title_tag'] = $this->getTitleTag($params,$args);
        $params['separator_params'] = $this->getSeparatorStyles($params);

		$html = conall_edge_get_shortcode_module_template_part('templates/section-title', 'section-title', '', $params);
		
		return $html;
	}

    /**
     * Return Style for Title
     *
     * @param $params
     * @return string
     */
    private function getTitleStyles($params) {
        $title_style = array();

        if ($params['title_color'] !== '') {
            $title_style[] = 'color: '.$params['title_color'];
        }

        if ($params['title_font_family'] !== '') {
            $title_style[] = 'font-family: '.$params['title_font_family'];
        }

        if ($params['title_font_size'] !== '') {
            $font_size = conall_edge_filter_px($params['title_font_size']);
            $title_style[] = 'font-size: '.$font_size.'px';
        }

        if ($params['title_line_height'] !== '') {
            $line_height = conall_edge_filter_px($params['title_line_height']);
            $title_style[] = 'line-height: '.$line_height.'px';
        }

        if ($params['title_font_style'] !== '') {
            $title_style[] = 'font-style: '.$params['title_font_style'];
        }

        if ($params['title_font_weight'] !== '') {
            $title_style[] = 'font-weight: '.$params['title_font_weight'];
        }

        if ($params['title_letter_spacing'] !== '') {
            $letter_spacing = conall_edge_filter_px($params['title_letter_spacing']);
            $title_style[] = 'letter-spacing: '.$letter_spacing.'px';
        }

        if ($params['title_text_transform'] !== '') {
            $title_style[] = 'text-transform: '.$params['title_text_transform'];
        }

        if ($params['title_text_align'] !== '') {
            $title_style[] = 'text-align: '.$params['title_text_align'];
        }

        return implode(';', $title_style);
    }

    /**
     * Return Style for Text
     *
     * @param $params
     * @return string
     */
    private function getTextStyles($params) {
        $text_style = array();

        if ($params['title_text_align'] !== '') {
            $text_style[] = 'text-align: '.$params['title_text_align'];
        }

        return implode(';', $text_style);
    }

    /**
     * Return Title Tag. If provided heading isn't valid get the default one
     *
     * @param $params
     * @return string
     */
    private function getTitleTag($params,$args) {
        $tag_array = array('h2', 'h3', 'h4', 'h5', 'h6');
        return (in_array($params['title_font_tag'], $tag_array)) ? $params['title_font_tag'] : $args['title_font_tag'];
    }

    private function getSeparatorStyles($params) {
        $separator_style = array();

        if ($params['separator_color'] !== '') {
            $separator_style['color'] = $params['separator_color'];
        }

        if ($params['separator_thickness'] !== '') {
            $separator_style['thickness'] = conall_edge_filter_px($params['separator_thickness']);
        }

        if ($params['separator_width'] !== '') {
            $separator_style['width'] = conall_edge_filter_px($params['separator_width']);
        }

        if ($params['title_text_align'] !== '') {
            $separator_style['position'] = $params['title_text_align'];
        }

        if ($params['separator_top_margin'] !== '') {
            $separator_style['top_margin'] = $params['separator_top_margin'];
        }

        if ($params['separator_bottom_margin'] !== '') {
            $separator_style['bottom_margin'] = $params['separator_bottom_margin'];
        }

        return $separator_style;
    }

}