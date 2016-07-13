<?php

/**
 * Widget that adds search icon that triggers opening of search form
 *
 * Class Edge_Search_Opener
 */
class ConallEdgeClassSearchOpener extends ConallEdgeClassWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'edgt_search_opener', // Base ID
            'Edge Search Opener' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'name'        => 'search_icon_size',
                'type'        => 'textfield',
                'title'       => 'Search Icon Size (px)',
                'description' => 'Define size for Search icon'
            ),
            array(
                'name'        => 'search_icon_color',
                'type'        => 'textfield',
                'title'       => 'Search Icon Color',
                'description' => 'Define color for Search icon'
            ),
            array(
                'name'        => 'search_icon_hover_color',
                'type'        => 'textfield',
                'title'       => 'Search Icon Hover Color',
                'description' => 'Define hover color for Search icon'
            ),
            array(
                'name'        => 'show_label',
                'type'        => 'dropdown',
                'title'       => 'Enable Search Icon Text',
                'description' => 'Enable this option to show \'Search\' text next to search icon in header',
                'options'     => array(
                    ''    => '',
                    'yes' => 'Yes',
                    'no'  => 'No'
                )
            ),
			array(
				'name'			=> 'close_icon_position',
				'type'			=> 'dropdown',
				'title'			=> 'Close icon stays on opener place',
				'description'	=> 'Enable this option to set close icon on same position like opener icon',
				'options'		=> array(
					'yes'	=> 'Yes',
					'no'	=> 'No'
				)
			)
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $conall_edge_options, $conall_edge_IconCollections;

        $search_type_class    = 'edgtf-search-opener';
        $search_opener_styles = array();
        $show_search_text     = $instance['show_label'] == 'yes' || $conall_edge_options['enable_search_icon_text'] == 'yes' ? true : false;
		$close_icon_on_same_position = $instance['close_icon_position'] == 'yes' ? true : false;

        if(!empty($instance['search_icon_size'])) {
            $search_opener_styles[] = 'font-size: '.$instance['search_icon_size'].'px';
        }

        if(!empty($instance['search_icon_color'])) {
            $search_opener_styles[] = 'color: '.$instance['search_icon_color'];
        }
        ?>

        <a <?php echo conall_edge_get_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?>
			<?php if ( $close_icon_on_same_position ) {
				echo conall_edge_get_inline_attr('yes', 'data-icon-close-same-position');
			} ?>
            <?php conall_edge_inline_style($search_opener_styles); ?>
            <?php conall_edge_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <span class="edgtf-search-opener-wrapper">
                <?php if(isset($conall_edge_options['search_icon_pack'])) {
                    $conall_edge_IconCollections->getSearchIcon($conall_edge_options['search_icon_pack'], false);
                } ?>
                <?php if($show_search_text) { ?>
                    <span class="edgtf-search-icon-text"><?php esc_html_e('Search', 'conall'); ?></span>
                <?php } ?>
            </span>    
        </a>
    <?php }
}