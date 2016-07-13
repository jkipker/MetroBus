<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\PieCharts\PieChartBasic;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class PieChartBasic
 */
class PieChartBasic implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_pie_chart';

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
			'name' => esc_html__('Edge Pie Chart', 'conall'),
			'base' => $this->getBase(),
			'icon' => 'icon-wpb-pie-chart extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
	                array(
	                    'type'        => 'textfield',
	                    'heading'     => 'Custom CSS Class',
	                    'param_name'  => 'custom_class',
	                    'admin_label' => true
	                ),
					array(
						'type' => 'dropdown',
						'heading' => 'Type of Central Text',
						'param_name' => 'type_of_central_text',
						'value' => array(
							'Percent'  => 'percent',
							'Icon'  => 'icon'
						),
						'save_always' => true,
						'admin_label' => true
					),
				),
				\ConallEdgeClassIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
	                    'type' => 'dropdown',
	                    'heading' => 'Percentage Style',
	                    'param_name' => 'percentage_style',
	                    'value' => array(
	                        'Default'  => '',
	                        'Circle' => 'circle'
	                    ),
	                    'save_always' => true,
	                    'dependency'  => array('element' => 'type_of_central_text', 'value' => array('percent'))
	                ),
					array(
						'type' => 'textfield',
						'heading' => 'Percentage',
						'param_name' => 'percent',
						'description' => '',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'param_name' => 'title',
						'description' => '',
						'admin_label' => true
					),
					array(
						'type' => 'dropdown',
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
						'type' => 'textfield',
						'heading' => 'Text',
						'param_name' => 'text',
						'description' => '',
						'admin_label' => true
					),
	                array(
	                    'type' => 'colorpicker',
	                    'heading' => 'Active Color',
	                    'param_name' => 'active_color',
	                    'description' => '',
	                    'admin_label' => true,
	                    'group' => 'Design Options',
	                ),
	                array(
	                    'type' => 'colorpicker',
	                    'heading' => 'Inactive Color',
	                    'param_name' => 'inactive_color',
	                    'description' => '',
	                    'admin_label' => true,
	                    'group' => 'Design Options',
	                ),
					array(
						'type' => 'textfield',
						'heading' => 'Size(px)',
						'param_name' => 'size',
						'description' => '',
						'admin_label' => true,
						'group' => 'Design Options',
					),
					array(
						'type' => 'textfield',
						'heading' => 'Margin below chart (px)',
						'param_name' => 'margin_below_chart',
						'description' => '',
						'group' => 'Design Options',
					),
					array(
	                    'type' => 'colorpicker',
	                    'heading' => 'Percentage Color',
	                    'param_name' => 'percent_color',
	                    'description' => '',
	                    'group' => 'Design Options',
	                    'dependency'  => array('element' => 'percentage_style', 'value' => array('circle'))
	                ),
	                array(
	                    'type' => 'colorpicker',
	                    'heading' => 'Percentage Background Color',
	                    'param_name' => 'percent_background_color',
	                    'description' => '',
	                    'group' => 'Design Options',
	                    'dependency'  => array('element' => 'percentage_style', 'value' => array('circle'))
	                ),
	                array(
	                    'type' => 'colorpicker',
	                    'heading' => 'Icon Color',
	                    'param_name' => 'icon_color',
	                    'description' => 'Only for Icon Type of Central Text',
	                    'group' => 'Design Options'
	                ),
	                array(
	                    'type' => 'colorpicker',
	                    'heading' => 'Icon Background Color',
	                    'param_name' => 'icon_background_color',
	                    'description' => 'Only for Icon Type of Central Text',
	                    'group' => 'Design Options'
	                ),
	                array(
	                    'type' => 'dropdown',
	                    'heading' => 'Text Skin',
	                    'param_name' => 'text_skin',
	                    'value' => array(
	                        'Dark'  => '',
	                        'Light' => 'light'
	                    ),
	                    'save_always' => true,
	                    'admin_label' => true
	                ),
                )
			)
		) );
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
            'custom_class' => '',
			'size' => '',
			'type_of_central_text' => 'percent',
			'percentage_style' => '',
			'title' => '',
			'title_tag' => 'h5',
			'percent' => '',
			'text' => '',
			'active_color' => '',
			'inactive_color' => '',
			'margin_below_chart' => '',
            'text_skin' => '',
            'percent_color' => '',
            'percent_background_color' => '',
            'icon_color' => '',
            'icon_background_color' => ''
		);

		$args = array_merge($args, conall_edge_icon_collections()->getShortcodeParams());

		$params = shortcode_atts($args, $atts);
		$iconPackName = conall_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconClasses = '';
		
		//generate icon holder classes
		$iconClasses .= 'edgtf-pie-chart-icon ';
		$iconClasses .= $params['icon_pack'];
		
		$params['icon_classes'] = $iconClasses;
		$params['icon'] = $params[$iconPackName];

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_tag'] = $this->getValidTitleTag($params, $args);
        $params['pie_chart_data'] = $this->getPieChartData($params);
        $params['pie_chart_style'] = $this->getPieChartStyle($params);
        $params['percentage_style'] = $this->getPercentageStyle($params);
        $params['icon_style'] = $this->getIconStyle($params);

		$html = conall_edge_get_shortcode_module_template_part('templates/pie-chart-basic', 'piecharts/piechartbasic', '', $params);

		return $html;
	}

    /**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = array('edgtf-pie-chart-holder');

        if(!empty($params['percentage_style']) && $params['percentage_style'] !== '') {
            $classes[] = 'edgtf-pv-style-'.$params['percentage_style'];
        }

        if(!empty($params['text_skin'])) {
            $classes[] = 'edgtf-pc-skin-'.$params['text_skin'];
        }

        return $classes;
    }

	/**
	 * Return correct heading value. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @param $args
	 */
	private function getValidTitleTag($params, $args) {

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
	}

	/**
	 * Return data attributes for Pie Chart
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartData($params) {

		$pieChartData = array();

		if( $params['size'] !== '' ) {
			$pieChartData['data-size'] = $params['size'];
		}
		if( $params['percent'] !== '' ) {
			$pieChartData['data-percent'] = $params['percent'];
		}
        if( $params['active_color'] !== '') {
            $pieChartData['data-bar-color'] = $params['active_color'];
        }
        if( $params['inactive_color'] !== '') {
            $pieChartData['data-track-color'] = $params['inactive_color'];
        }

		return $pieChartData;
	}

	private function getPieChartStyle($params) {

		$pieChartStyle = array();

		if ($params['margin_below_chart'] !== '') {
			$pieChartStyle[] = 'margin-top: ' . $params['margin_below_chart'] . 'px';
		}

		return $pieChartStyle;
	}

	private function getPercentageStyle($params) {

		$percentStyle = array();

		if ($params['percent_color'] !== '') {
			$percentStyle[] = 'color: ' . $params['percent_color'];
		}

		if ($params['percent_background_color'] !== '') {
			$percentStyle[] = 'background-color: ' . $params['percent_background_color'];
		}

		return implode(';', $percentStyle);
	}

	private function getIconStyle($params){
		
		$iconStylesArray = array();
		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:' . $params['icon_color'];
		}

		if(!empty($params['icon_background_color'])) {
			$iconStylesArray[] = 'background-color:' . $params['icon_background_color'];
		}
		
		return implode(';', $iconStylesArray);
	}
}