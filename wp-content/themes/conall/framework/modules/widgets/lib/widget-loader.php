<?php

if (!function_exists('conall_edge_register_widgets')) {

	function conall_edge_register_widgets() {

		$widgets = array(
			'ConallEdgeClassFullScreenMenuOpener',
			'ConallEdgeClassImageWidget',
			'ConallEdgeClassSearchOpener',
			'ConallEdgeClassSideAreaOpener',
			'ConallEdgeClassStickySidebar',
			'ConallEdgeClassSocialIconWidget',
			'ConallEdgeClassSeparatorWidget',
            'ConallEdgeClassBlogListWidget'
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'conall_edge_register_widgets');