<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\NumberWithText;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class NumberWithText
 * @package ConallEdgeNamespace\Modules\Shortcodes\IconWithText
 */
class NumberWithText implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     *
     */
    public function __construct() {
        $this->base = 'edgtf_number_with_text';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     *
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Edge Number With Text', 'conall'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-number-with-text extended-custom-icon',
            'category'                  => 'by EDGE',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Custom CSS class',
                    'param_name'  => 'custom_class',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => 'Text Alignment',
                    'param_name'  => 'text_alignment',
                    'value'       => array(
                        'Center'             => 'center',
                        'Left'            => 'left',
                        'Right'           => 'right'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Number',
                    'param_name' => 'number_text',
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => 'Number Color',
                    'param_name' => 'number_color',
                    'dependency' => array('element' => 'number_text', 'not_empty' => true),
                    'group'      => 'Number Settings'

                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Font Size (px)',
                    'param_name' => 'number_font_size',
                    'dependency' => array('element' => 'number_text', 'not_empty' => true),
                    'group'      => 'Number Settings'
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => 'Number Weight (px)',
                    'param_name' => 'number_font_weight',
                    'value'       => conall_edge_get_font_weight_array(true),
                    'admin_label' => true,
                    'dependency' => array('element' => 'number_text', 'not_empty' => true),
                    'group'      => 'Number Settings'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Title',
                    'param_name'  => 'title',
                    'value'       => '',
                    'admin_label' => true
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
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group'      => 'Text Settings'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => 'Title Color',
                    'param_name' => 'title_color',
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group'      => 'Text Settings'
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => 'Text',
                    'param_name' => 'text'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => 'Text Color',
                    'param_name' => 'text_color',
                    'dependency' => array('element' => 'text', 'not_empty' => true),
                    'group'      => 'Text Settings'
                )
            )
        ));
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'custom_class'                => '',
            'text_alignment'             => '',
            'number_text'                 => '',
            'number_color'                => '',
            'number_font_size'            => '',
            'number_font_weight'          => '',
            'title'                       => '',
            'title_tag'                   => 'h5',
            'title_color'                 => '',
            'text'                        => '',
            'text_color'                  => ''
        );

        $params       = shortcode_atts($default_atts, $atts);

        $params['holder_classes']  = $this->getHolderClasses($params);
        $params['number_styles']    = $this->getNumberStyles($params);
        $params['title_styles']    = $this->getTitleStyles($params);
        $params['text_styles']     = $this->getTextStyles($params);

        return conall_edge_get_shortcode_module_template_part('templates/nwt', 'number-with-text', '', $params);
    }

    /**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = array('edgtf-nwt', 'clearfix');

        if(!empty($params['custom_class'])) {
            $classes[] = $params['custom_class'];
        }

        switch($params['text_alignment']) {
            case 'center':
                $classes[] = 'text-align-center';
                break;
            case 'left':
                $classes[] = 'text-align-left';
                break;
            case 'right':
                $classes[] = 'text-align-right';
                break;
            default:
                break;
        }

        if(!empty($params['text_alignment'])) {
            $classes[] = $params['text_alignment'];
        }

        return $classes;
    }

    /**
     * Get styles for number
     *
     * @param $params
     *
     * @return array
     */
    private function getNumberStyles($params) {
        $styles = array();

        if(!empty($params['number_color'])) {
            $styles[] = 'color: '.$params['title_color'];
        }

        if(!empty($params['number_font_size'])) {
            $styles[] = 'font-size: ' . conall_edge_filter_px($params['number_font_size']) . 'px';
        }

        if(!empty($params['number_font_weight'])) {
            $styles[] = 'font-weight: '.$params['number_font_weight'];
        }

        return $styles;
    }

    /**
     * Get styles for title
     *
     * @param $params
     *
     * @return array
     */
    private function getTitleStyles($params) {
        $styles = array();

        if(!empty($params['title_color'])) {
            $styles[] = 'color: '.$params['title_color'];
        }

        return $styles;
    }

    /**
     * Get styles for text
     *
     * @param $params
     *
     * @return array
     */
    private function getTextStyles($params) {
        $styles = array();

        if(!empty($params['text_color'])) {
            $styles[] = 'color: '.$params['text_color'];
        }

        return $styles;
    }

}