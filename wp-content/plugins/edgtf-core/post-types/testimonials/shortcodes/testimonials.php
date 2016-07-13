<?php

namespace EdgeCore\CPT\Testimonials\Shortcodes;


use EdgeCore\Lib;

/**
 * Class Testimonials
 * @package EdgeCore\CPT\Testimonials\Shortcodes
 */
class Testimonials implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgtf_testimonials';

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
     * Maps shortcode to Visual Composer
     *
     * @see vc_map()
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => 'Edge Testimonials',
                'base' => $this->base,
                'category' => 'by EDGE',
                'icon' => 'icon-wpb-testimonials extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Custom CSS class',
                        'param_name'  => 'custom_class',
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Testimonials Type',
                        'param_name' => 'testimonials_type',
                        'value' => array(
                            'Slider' => 'slider',
                            'Carousel' => 'carousel',
                            'Classic' => 'classic'
                        ),
                        'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Category',
                        'param_name' => 'category',
                        'value' => '',
                        'description' => 'Category Slug (leave empty for all)'
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Number',
                        'param_name' => 'number',
                        'value' => '',
                        'description' => 'Number of Testimonials'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'admin_label' => true,
                        'heading' => 'Background Color',
                        'param_name' => 'background_color',
                        'value' => '',
                        'group' => 'Content Styles',
                        'dependency' => array('element' => 'testimonials_type', 'value' => array('classic'))
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Title',
                        'param_name' => 'show_title',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes',
                        ),
                        'save_always' => true,
                        'description' => '',
                        'group' => 'Content Styles',
                        'dependency' => array('element' => 'testimonials_type', 'value' => array('carousel')),
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author',
                        'param_name' => 'show_author',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
                        'save_always' => true,
                        'group' => 'Content Styles',
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author Job Position',
                        'param_name' => 'show_position',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        ),
                        'save_always' => true,
                        'group' => 'Content Styles',
                        'dependency' => array('element' => 'show_author', 'value' => array('yes')),
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'param_name' => 'visible_items',
                        'heading' => 'Visible Items',
                        'save_always' => true,
                        'value' => array(
                            '2' => '2',
                            '3'  => '3',
                            '4'  => '4'
                        ),
                        'group' => 'Content Styles',
                        'dependency' => array('element' => 'testimonials_type', 'value' => array('carousel')),
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Navigation',
                        'param_name' => 'show_navigation',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        ),
                        'save_always' => true,
                        'group' => 'Content Styles',
                        'description' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Animation speed',
                        'param_name' => 'animation_speed',
                        'value' => '',
                        'description' => 'Speed of slide animation in milliseconds. Default value is 600.'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Skin',
                        'param_name' => 'skin',
                        'value' => array(
                            'Dark'  => '',
                            'Light' => 'light'
                        ),
                        'admin_label' => true,
                        'group' => 'Content Styles',
                        'dependency' => array('element' => 'testimonials_type', 'value' => array('slider'))
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Padding',
                        'param_name' => 'padding',
                        'value' => '',
                        'group' => 'Content Styles',
                        'description' => 'Insert padding in either px or percentage using the format: 0 10px 20px 0. (top right bottom left)',
                        'dependency' => array('element' => 'testimonials_type', 'value' => array('slider'))
                    ),
                )
            ) );
        }
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
            'testimonials_type' => '',
            'number' => '-1',
            'category' => '',
            'background_color' => '',
            'show_title' => 'no',
            'show_author' => 'yes',
            'show_position' => 'yes',
            'show_navigation' => '',
            'visible_items' => '3',
            'animation_speed' => '',
            'skin' => '',
            'padding' => ''
        );
        $params = shortcode_atts($args, $atts);


        $params['number'] = esc_attr($params['number']);
        $params['category'] = esc_attr($params['category']);
        $params['animation_speed'] = esc_attr($params['animation_speed']);


        //Extract params for use in method
        extract($params);

        $data_attr = $this->getDataParams($params);
        $query_args = $this->getQueryParams($params);
        $query_results = new \WP_Query($query_args);

        $holder_classes = $this->getHolderClasses($params);
        $paramClasses = $this->getParamClasses($params);
        $typeClasses = $this->getTypeClasses($params);

        $testimonials_wrapper_styles = $this->getTestimonialsStyle($params);

        $html = '';
        $html .= '<div class="edgtf-testimonials-holder clearfix '.$holder_classes.'">';
        $html .= '<div class="edgtf-testimonials-inner">';
        $html .= '<div class="edgtf-grid">';

        if ($testimonials_type == 'slider') {
            $slider_params['query_results'] = $query_results;
            $html .= edgt_core_get_shortcode_module_template_part('testimonials', 'testimonials-image-dots', '', $slider_params);
        }

        $html .= '<div class="edgtf-testimonials ' . $paramClasses . ' ' . $typeClasses . '"' . $data_attr . ' ' . conall_edge_get_inline_style($testimonials_wrapper_styles) . '>';

        if ($query_results->have_posts()):
            while ($query_results->have_posts()) : $query_results->the_post();
                $author = get_post_meta(get_the_ID(), 'edgtf_testimonial_author', true);
                $text = get_post_meta(get_the_ID(), 'edgtf_testimonial_text', true);
                $title = get_post_meta(get_the_ID(), 'edgtf_testimonial_title', true);
                $job = get_post_meta(get_the_ID(), 'edgtf_testimonial_author_position', true);

                $params['author'] = $author;
                $params['text'] = $text;
                $params['title'] = $title;
                $params['job'] = $job;
                $params['current_id'] = get_the_ID();

                $html .= edgt_core_get_shortcode_module_template_part('testimonials', 'testimonials-' . $testimonials_type, '', $params);

            endwhile;
        else:
            $html .= esc_html__('Sorry, no posts matched your criteria.', 'edgt_core');
        endif;

        wp_reset_postdata();

        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';


        if ($show_navigation == 'yes') {
            $html .= $this->getNavigation();
        }

        $html .= '</div>';

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
        $classes = array();

        if(!empty($params['custom_class'])) {
            $classes[] = $params['custom_class'];
        }

        if(!empty($params['skin'])) {
            $classes[] = 'edgtf-tes-skin-'.$params['skin'];
        }

        return implode(' ', $classes);
    }

    /**
     * Generates testimonial data attribute array
     *
     * @param $params
     *
     * @return string
     */
    private function getDataParams($params) {
        $data_attr = '';

        if (!empty($params['animation_speed'])) {
            $data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
        }

        if (!empty($params['visible_items'])) {
            $data_attr .= ' data-visible-items ="' . $params['visible_items'] . '"';
        }

        return $data_attr;
    }

    /**
     * Generates testimonials query attribute array
     *
     * @param $params
     *
     * @return array
     */
    private function getQueryParams($params) {

        $args = array(
            'post_type' => 'testimonials',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $params['number']
        );

        if ($params['category'] != '') {
            $args['testimonials_category'] = $params['category'];
        }
        return $args;
    }

    /**
     * Generates testimonials type classes
     *
     * @param $params
     *
     * @return array
     */
    private function getTypeClasses($params) {

        $classes = array();

        if ($params['testimonials_type'] == 'slider') {
            $classes[] = 'edgtf-testimonials-slider';
        } elseif ($params['testimonials_type'] == 'carousel') {
            $classes[] = 'edgtf-testimonials-carousel';
        } elseif ($params['testimonials_type'] == 'classic') {
            $classes[] = 'edgtf-testimonials-classic';
        }
        return implode(' ', $classes);
    }

    /**
     * Generates testimonials param classes
     *
     * @param $params
     *
     * @return array
     */
    private function getParamClasses($params) {

        $classes = array();

        if ($params['number'] == '1') {
            $classes[] = 'edgtf-single-testimonial';
        }
        if ($params['show_navigation'] == 'yes') {
            $classes[] = 'edgtf-testimonials-navigation';
        }

        return implode(' ', $classes);
    }

    /**
     * Generates testimonials styles
     *
     * @param $params
     *
     * @return array
     */

    private function getTestimonialsStyle($params) {

        $style = array();

        if (!empty($params['background_color'])) {
            $style[] = 'background-color: ' . $params['background_color'];
        }

        if ($params['testimonials_type'] == 'slider') {
            if (!empty($params['padding'])) {
                $style[] = 'padding: ' . $params['padding'];
            }
        }

        return $style;

    }

    /**
     * Generates testimonials html for navigation arrows
     *
     * @return string
     */
    private function getNavigation() {

        $html = '';

        $html .= '<div class="edgtf-tes-nav edgtf-tes-controls">';
        $html .= '<span class="edgtf-tes-nav-prev"><span class="edgtf-icon-mark"></span></span>';
        $html .= '<span class="edgtf-tes-nav-next"><span class="edgtf-icon-mark"></span></span>';
        $html .= '</div>';

        return $html;
    }
}