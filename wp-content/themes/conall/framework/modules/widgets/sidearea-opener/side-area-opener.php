<?php

class ConallEdgeClassSideAreaOpener extends ConallEdgeClassWidget {
    public function __construct() {
        parent::__construct(
            'edgtf_side_area_opener', // Base ID
            'Edge Side Area Opener' // Name
        );

        $this->setParams();
    }

    protected function setParams() {

		$this->params = array(
            array(
                'type' => 'textfield',
                'title' => 'Widget Title',
                'name' => 'widget_title'
            ),
            array(
                'type'          => 'textfield',
                'title'         => 'Widget Title Color',
                'name'          => 'widget_title_color',
                'description'   => 'Define color for Side Area Title'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Widget Title Margin (top right bottom left)',
                'name' => 'widget_title_margin'
            ),
			array(
				'name'			=> 'side_area_opener_icon_color',
				'type'			=> 'textfield',
				'title'			=> 'Icon Color',
				'description'	=> 'Define color for Side Area opener icon'
			),
            array(
                'name' => 'side_area_predefined_icon_size',
                'type' => 'dropdown',
                'title' => 'Predefined Icon Size',
                'description' => '',
                'options' => array(
                    '' => 'Default',
                    'large' => 'Large'
                )
            )
		);
    }

    public function widget($args, $instance) {
		
        $sidearea_icon_title_styles = array();
        if (!empty($instance['widget_title_margin'])) {
            $sidearea_icon_title_styles[] = 'margin: ' . $instance['widget_title_margin'];
        }
        if (!empty($instance['widget_title_color'])) {
            $sidearea_icon_title_styles[] = 'color: ' . $instance['widget_title_color'];
        }
        $sidearea_icon_styles = array();
		if (!empty($instance['side_area_opener_icon_color'])) {
			$sidearea_icon_styles[] = 'background-color: ' . $instance['side_area_opener_icon_color'];
		}
		$icon_size = '';
		if ( conall_edge_options()->getOptionValue('side_area_predefined_icon_size') ) {
			$icon_size = conall_edge_options()->getOptionValue('side_area_predefined_icon_size');
		}
        if (!empty($instance['side_area_predefined_icon_size']) && $instance['side_area_predefined_icon_size'] !== '') {
            $icon_size = $instance['side_area_predefined_icon_size'];
        }
		?>
        <a class="edgtf-side-menu-button-opener <?php echo esc_attr( $icon_size ); ?>" href="javascript:void(0)">
            <?php if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') { ?>
                <span class="edgtf-side-menu-title" data-lang="en" <?php conall_edge_inline_style($sidearea_icon_title_styles) ?>><?php echo esc_html($instance['widget_title']); ?></span>
            <?php } ?>
        	<span class="edgtf-side-menu-lines">
        		<span class="edgtf-side-menu-line edgtf-line-1" <?php conall_edge_inline_style($sidearea_icon_styles) ?>></span>
        		<span class="edgtf-side-menu-line edgtf-line-2" <?php conall_edge_inline_style($sidearea_icon_styles) ?>></span>
                <span class="edgtf-side-menu-line edgtf-line-3" <?php conall_edge_inline_style($sidearea_icon_styles) ?>></span>
        	</span>
        </a>

    <?php }
}