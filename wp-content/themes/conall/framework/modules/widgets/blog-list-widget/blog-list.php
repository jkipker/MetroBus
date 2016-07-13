<?php

/**
 * Widget that adds blog list
 *
 * Class Blog_List_Widget
 */
class ConallEdgeClassBlogListWidget extends ConallEdgeClassWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'edgtf_blog_list_widget', // Base ID
            'Edge Blog List Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'name' => 'widget_title',
                'type' => 'textfield',
                'title' => 'Widget Title'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Number of Posts',
                'name' => 'number_of_posts',
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Order By',
                'name' => 'order_by',
                'options' => array(
                    'title' => 'Title',
                    'date' => 'Date'
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Order',
                'name' => 'order',
                'options' => array(
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Category Slug',
                'name' => 'category',
                'description' => 'Leave empty for all or use comma for list'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Title Tag',
                'name' => 'title_tag',
                'options' => array(
                    'h5' => 'h5',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h6' => 'h6',
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Category',
                'name' => 'post_simple_info_category',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes',
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Image Size',
                'name' => 'widget_image_size',
                'options' => array(
                    'default' => 'Default (Small)',
                    'large' => 'Large',
                ),
                'description' => ''
            ),
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        //prepare variables
        $params = '';

        $instance['type'] = 'simple';
        if(isset($instance['widget_image_size']) && $instance['widget_image_size'] == 'large') {
            $instance['image_size'] = 'sidebar';
        }

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key = '$value' ";
            }
        }

        echo '<div class="widget edgtf-blog-list-widget">';
            if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
                print $args['before_title'].$instance['widget_title'].$args['after_title'];
            }
                
            //finally call the shortcode
            echo do_shortcode("[edgtf_blog_list $params]"); // XSS OK

            echo '</div>'; //close div.mkdf-plw-seven
    }
}