<?php
if ( ! function_exists('conall_edge_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function conall_edge_contact_form_map()
	{

		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => 'Style',
			'param_name' => 'html_class',
			'value' => array(
				'Default' => 'default',
				'Custom Style 1' => 'cf7_custom_style_1',
				'Custom Style 2' => 'cf7_custom_style_2',
                'Custom Style 3' => 'cf7_custom_style_3'
			),
			'description' => 'You can style each form element individually in Edge Options > Contact Form 7'
		));

	}
	add_action('vc_after_init', 'conall_edge_contact_form_map');
}
?>