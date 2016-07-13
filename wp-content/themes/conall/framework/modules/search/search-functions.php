<?php

if( !function_exists('conall_edge_search_body_class') ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function conall_edge_search_body_class($classes) {

		if ( is_active_widget( false, false, 'edgt_search_opener' ) ) {

			$classes[] = 'edgtf-fullscreen-search';

			$classes[] = 'edgtf-search-fade';
		}

		return $classes;
	}

	add_filter('body_class', 'conall_edge_search_body_class');
}

if ( ! function_exists('conall_edge_get_search') ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function conall_edge_get_search() {

		if ( conall_edge_active_widget( false, false, 'edgt_search_opener' ) ) {

			$search_type = 'fullscreen-search';

			conall_edge_load_search_template();
		}
	}
}

if ( ! function_exists('conall_edge_load_search_template') ) {
	/**
	 * Loads HTML template with parameters
	 */
	function conall_edge_load_search_template() {
		global $conall_edge_IconCollections;

		$search_type = 'fullscreen-search';

		$search_icon = '';
		$search_icon_close = '';
		if ( conall_edge_options()->getOptionValue('search_icon_pack') !== '' ) {
			$search_icon = $conall_edge_IconCollections->getSearchIcon( conall_edge_options()->getOptionValue('search_icon_pack'), true );
			$search_icon_close = $conall_edge_IconCollections->getSearchClose( conall_edge_options()->getOptionValue('search_icon_pack'), true );
		}

		$parameters = array(
			'search_in_grid'		=> conall_edge_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'			=> $search_icon,
			'search_icon_close'		=> $search_icon_close
		);

		conall_edge_get_module_template_part( 'templates/types/'.$search_type, 'search', '', $parameters );
	}
}