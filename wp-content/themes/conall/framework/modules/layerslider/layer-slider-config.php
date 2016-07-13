<?php
	if(!function_exists('conall_edge_layerslider_overrides')) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function conall_edge_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'conall_edge_layerslider_overrides');
	}
?>