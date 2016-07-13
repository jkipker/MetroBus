<?php
namespace ConallEdgeNamespace\Modules\Shortcodes\CallToAction;

use ConallEdgeNamespace\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class CallToAction
 */
class CallToAction implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_call_to_action';

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

        $call_to_action_icons_array = array();
        for ($x = 1; $x<=6; $x++) {
            $callToActionCollections = conall_edge_icon_collections()->getCollectionsWithSocialIcons();
            foreach ($callToActionCollections as $collection_key => $collection) {

                $call_to_action_icons_array[] = array(
                    'type' => 'dropdown',
                    'heading' => 'Call To Action Icon ' . $x,
                    'param_name' => 'cta_social_' . $collection->param . '_' . $x,
                    'value' => $collection->getSocialIconsArrayVC(),
                    'dependency' => Array('element' => 'cta_social_icon_pack', 'value' => array($collection_key)),
                    'group'			=> 'Icons Options'
                );

            }

            $call_to_action_icons_array[] = array(
                'type' => 'textfield',
                'heading' => 'Call To Action Icon ' . $x . ' Link',
                'param_name' => 'cta_social_icon_' . $x . '_link',
                'dependency' => array('element' => 'cta_social_icon_pack', 'value' => conall_edge_icon_collections()->getIconCollectionsKeys()),
                'group'			=> 'Icons Options'
            );

            $call_to_action_icons_array[] = array(
                'type' => 'dropdown',
                'heading' => 'Call To Action Icon ' . $x . ' Target',
                'param_name' => 'cta_social_icon_' . $x . '_target',
                'value' => array(
                    '' => '',
                    'Self' => '_self',
                    'Blank' => '_blank'
                ),
                'dependency' => Array('element' => 'cta_social_icon_' . $x . '_link', 'not_empty' => true),
                'group'			=> 'Icons Options'
            );
        }
        

		$call_to_action_button_icons_array = array();
		$call_to_action_button_IconCollections = conall_edge_icon_collections()->iconCollections;
		foreach($call_to_action_button_IconCollections as $collection_key => $collection) {

			$call_to_action_button_icons_array[] = array(
				'type' => 'dropdown',
				'heading' => 'Button Icon',
				'param_name' => 'button_0_'.$collection->param,
				'value' => $collection->getIconsArray(),
				'save_always' => true,
				'dependency' => Array('element' => 'button_0_icon_pack', 'value' => array($collection_key)),
                'group'			=> 'Button Options'
			);
		}

        $call_to_action_button_1_icons_array = array();
        $call_to_action_button_IconCollections = conall_edge_icon_collections()->iconCollections;
        foreach($call_to_action_button_IconCollections as $collection_key => $collection) {

            $call_to_action_button_1_icons_array[] = array(
                'type' => 'dropdown',
                'heading' => 'Button 1 Icon',
                'param_name' => 'button_1_'.$collection->param,
                'value' => $collection->getIconsArray(),
                'save_always' => true,
                'dependency' => Array('element' => 'button_1_icon_pack', 'value' => array($collection_key)),
                'group'			=> 'Button Options',
            );

        }

        $call_to_action_button_2_icons_array = array();
        $call_to_action_button_IconCollections = conall_edge_icon_collections()->iconCollections;
        foreach($call_to_action_button_IconCollections as $collection_key => $collection) {

            $call_to_action_button_2_icons_array[] = array(
                'type' => 'dropdown',
                'heading' => 'Button 2 Icon',
                'param_name' => 'button_2_'.$collection->param,
                'value' => $collection->getIconsArray(),
                'save_always' => true,
                'dependency' => Array('element' => 'button_2_icon_pack', 'value' => array($collection_key)),
                'group'			=> 'Button Options',
            );

        }

		vc_map( array(
				'name' => esc_html__('Edge Call To Action', 'conall'),
				'base' => $this->getBase(),
				'category' => 'by EDGE',
				'icon' => 'icon-wpb-call-to-action extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array_merge(
					array(
						array(
							'type'          => 'dropdown',
							'heading'       => 'Full Width',
							'param_name'    => 'full_width',
							'admin_label'	=> true,
							'value'         => array(
								'Yes'       => 'yes',
								'No'        => 'no'
							),
							'save_always' 	=> true,
							'description'   => 'Disabled Full Width for Call To Action Slider',
						),
						array(
							'type'          => 'dropdown',
							'heading'       => 'Content in grid',
							'param_name'    => 'content_in_grid',
							'value'         => array(
								'Yes'       => 'yes',
								'No'        => 'no'
							),
							'save_always'	=> true,
							'description'   => '',
							'dependency'    => array('element' => 'full_width', 'value' => 'yes')
						),
                        array(
                            'type' 			=> 'dropdown',
                            'heading'		=> 'Type',
                            'param_name' 	=> 'type',
                            'admin_label' 	=> true,
                            'value' 		=> array(
                                'Normal' 	=> 'normal',
                                'With Icon' => 'with-icons',
                                'With Two Buttons Below' => 'with-buttons',
                            ),
                            'save_always' 	=> true,
                            'description' 	=> ''
                        ),
						array(
							'type'          => 'dropdown',
							'heading'       => 'Grid size',
							'param_name'    => 'grid_size',
							'value'         => array(
                                '75/25'     => '75',
								'50/50'     => '50',
								'66/33'     => '66',
							),
							'save_always' 	=> true,
							'description'   => '',
							'dependency'    => array('element' => 'type', 'value' => array('normal','with-icons'))
						),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Call To Action Icon Pack',
                            'param_name' => 'cta_social_icon_pack',
                            'admin_label' => true,
                            'value' => array_merge(array('' => ''),conall_edge_icon_collections()->getIconCollectionsVCExclude('linea_icons')),
                            'save_always' => true,
                            'dependency' => array('element' => 'type', 'value' => array('with-icons')),
                            'group'			=> 'Icons Options'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Icons Position',
                            'param_name' => 'icon_position',
                            'value' => array(
                                'Default/right' => '',
                                'Center' => 'center',
                                'Left' => 'left'
                            ),
                            'description' => '',
                            'dependency' => array('element' => 'type', 'value' => array('with-icons')),
                            'group'			=> 'Design Options'
                        ),
					),
                    $call_to_action_icons_array,
					array(
						array(
							'type' 			=> 'textfield',
							'heading' 		=> 'Icon Size (px)',
							'param_name' 	=> 'icon_size',
							'description' 	=> '',
							'dependency' 	=> array('element' => 'type', 'value' => array('with-icons')),
							'group'			=> 'Icons Options',
						),
                        array(
                            'type' 			=> 'dropdown',
                            'heading' 		=> 'Icon Skin',
                            'param_name' 	=> 'icon_skin',
                            'value' 		=> array(
                                'Default' 		=> '',
                                'Light' 		=> 'edgtf-cta-icon-light',
                                'Dark' 		    => 'edgtf-cta-icon-dark',
                            ),
                            'description' 	=> '',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-icons')),
                            'group'			=> 'Icons Options',
                        ),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> 'Box Padding (top right bottom left) px',
							'param_name' 	=> 'box_padding',
							'admin_label' 	=> true,
							'description' 	=> 'Default padding is 20px on all sides',
							'group'			=> 'Design Options'
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> 'Default Text Font Size (px)',
							'param_name' 	=> 'text_size',
							'description' 	=> 'Font size for p tag',
							'group'			=> 'Design Options',
						),
                        array(
							'type' 			=> 'textfield',
							'heading' 		=> 'Space Between Text and Buttons (px)',
							'param_name' 	=> 'space_below_text',
							'description' 	=> '',
							'group'			=> 'Design Options',
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> 'Show Button',
							'param_name' 	=> 'show_button',
							'value' 		=> array(
								'Yes' 		=> 'yes',
								'No' 		=> 'no'
							),
							'admin_label' 	=> true,
							'save_always' 	=> true,
							'description' 	=> '',
                            'dependency' => array('element' => 'type', 'value' => array('normal'))
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Position',
							'param_name' => 'button_position',
							'value' => array(
								'Default/right' => '',
								'Center' => 'center',
								'Left' => 'left'
							),
							'description' => '',
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'			=> 'Button Options'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Size',
							'param_name' => 'button_0_size',
							'value' => array(
								'Default' => '',
								'Small' => 'small',
								'Medium' => 'medium',
								'Large' => 'large',
								'Extra Large' => 'big_large'
							),
							'description' => '',
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
							'group'			=> 'Button Options'
						),
						array(
							'type' => 'textfield',
							'heading' => 'Button Text',
							'param_name' => 'button_0_text',
							'admin_label' 	=> true,
							'description' => 'Default text is "button"',
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'			=> 'Button Options'
						),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Color',
                            'param_name'  => 'button_0_color',
                            'group'       => 'Button Options',
                            'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Hover Color',
                            'param_name'  => 'button_0_hover_color',
                            'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'       => 'Button Options',
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Background Color',
                            'param_name'  => 'button_0_background_color',
                            'admin_label' => true,
                            'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'       => 'Button Options'
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Hover Background Color',
                            'param_name'  => 'button_0_hover_background_color',
                            'admin_label' => true,
                            'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'       => 'Button Options'
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Border Color',
                            'param_name'  => 'button_0_border_color',
                            'admin_label' => true,
                            'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'       => 'Button Options'
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Hover Border Color',
                            'param_name'  => 'button_0_hover_border_color',
                            'admin_label' => true,
                            'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'       => 'Button Options'
                        ),
						array(
							'type' => 'textfield',
							'heading' => 'Button Link',
							'param_name' => 'button_0_link',
							'description' => '',
							'admin_label' 	=> true,
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'			=> 'Button Options'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Target',
							'param_name' => 'button_0_target',
							'value' => array(
								'' => '',
								'Self' => '_self',
								'Blank' => '_blank'
							),
							'description' => '',
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'			=> 'Button Options'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Icon Pack',
							'param_name' => 'button_0_icon_pack',
							'value' => array_merge(array('No Icon' => ''),conall_edge_icon_collections()->getIconCollectionsVC()),
							'save_always' => true,
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
                            'group'			=> 'Button Options'
						)
					),
					$call_to_action_button_icons_array,
                    array(
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button 1 Size',
                            'param_name' => 'button_1_size',
                            'value' => array(
                                'Default' => '',
                                'Small' => 'small',
                                'Medium' => 'medium',
                                'Large' => 'large',
                                'Extra Large' => 'big_large'
                            ),
                            'description' => '',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Button 1 Text',
                            'param_name' => 'button_1_text',
                            'admin_label' 	=> true,
                            'description' => 'Default text is "button"',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 1 Color',
                            'param_name'  => 'button_1_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'       => 'Button Options',
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 1 Hover Color',
                            'param_name'  => 'button_1_hover_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'       => 'Button Options',
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 1 Background Color',
                            'param_name'  => 'button_1_background_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'admin_label' => true,
                            'group'       => 'Button Options'
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 1 Hover Background Color',
                            'param_name'  => 'button_1_hover_background_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'admin_label' => true,
                            'group'       => 'Button Options'
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 1 Border Color',
                            'param_name'  => 'button_1_border_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'admin_label' => true,
                            'group'		  => 'Button Options',
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 1 Hover Border Color',
                            'param_name'  => 'button_1_hover_border_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'admin_label' => true,
                            'group'		  => 'Button Options',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Button 1 Link',
                            'param_name' => 'button_1_link',
                            'description' => '',
                            'admin_label' 	=> true,
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button 1 Target',
                            'param_name' => 'button_1_target',
                            'value' => array(
                                '' => '',
                                'Self' => '_self',
                                'Blank' => '_blank'
                            ),
                            'description' => '',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button 1 Icon Pack',
                            'param_name' => 'button_1_icon_pack',
                            'value' => array_merge(array('No Icon' => ''),conall_edge_icon_collections()->getIconCollectionsVC()),
                            'save_always' => true,
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        )
                    ),
                    $call_to_action_button_1_icons_array,
                    array(
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button 2 Size',
                            'param_name' => 'button_2_size',
                            'value' => array(
                                'Default' => '',
                                'Small' => 'small',
                                'Medium' => 'medium',
                                'Large' => 'large',
                                'Extra Large' => 'big_large'
                            ),
                            'description' => '',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Button 2 Text',
                            'param_name' => 'button_2_text',
                            'admin_label' 	=> true,
                            'description' => 'Default text is "button"',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 2 Color',
                            'param_name'  => 'button_2_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'       => 'Button Options',
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 2 Hover Color',
                            'param_name'  => 'button_2_hover_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'       => 'Button Options',
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 2 Background Color',
                            'param_name'  => 'button_2_background_color',
                            'admin_label' => true,
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'       => 'Button Options'
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 2 Hover Background Color',
                            'param_name'  => 'button_2_hover_background_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'admin_label' => true,
                            'group'       => 'Button Options'
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 2 Border Color',
                            'param_name'  => 'button_2_border_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'admin_label' => true,
                            'group'		  => 'Button Options',
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => 'Button 2 Hover Border Color',
                            'param_name'  => 'button_2_hover_border_color',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'admin_label' => true,
                            'group'		  => 'Button Options',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Button 2 Link',
                            'param_name' => 'button_2_link',
                            'description' => '',
                            'admin_label' 	=> true,
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button 2 Target',
                            'param_name' => 'button_2_target',
                            'value' => array(
                                '' => '',
                                'Self' => '_self',
                                'Blank' => '_blank'
                            ),
                            'description' => '',
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button 2 Icon Pack',
                            'param_name' => 'button_2_icon_pack',
                            'value' => array_merge(array('No Icon' => ''),conall_edge_icon_collections()->getIconCollectionsVC()),
                            'save_always' => true,
                            'dependency' 	=> array('element' => 'type', 'value' => array('with-buttons')),
                            'group'			=> 'Button Options',
                        )
                    ),
                    $call_to_action_button_2_icons_array,
					array(
						array(
							'type' => 'textarea_html',
							'admin_label' => true,
							'heading' => 'Content',
							'param_name' => 'content',
							'value' => '<p>'.'I am test text for Call to action.'.'</p>',
							'description' => ''
						)
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
			'full_width' => 'yes',
            'content_in_grid' => 'yes',
            'type' => 'normal',
            'grid_size' => '75',
            'cta_social_icon_pack' => '',
            'icon_position' => 'right',
			'icon_size' => '',
			'icon_skin' => '',
			'box_padding' => '20px',
			'text_size' => '',
			'space_below_text' => '',
			'show_button' => 'yes',
			'button_position' 				  => 'right',
			'button_0_size' 				  => '',
			'button_0_link' 				  => '',
			'button_0_text'					  => 'button',
			'button_0_target' 				  => '',
			'button_0_icon_pack' 			  => '',
            'button_0_color' 				  => '',
            'button_0_hover_color'            => '',
            'button_0_background_color'       => '',
            'button_0_hover_background_color' => '',
            'button_0_border_color'           => '',
            'button_0_hover_border_color'     => '',
            'button_1_size' 				  => '',
            'button_1_link' 				  => '',
            'button_1_text' 				  => 'button',
            'button_1_target' 				  => '',
            'button_1_icon_pack' 			  => '',
            'button_1_color'	              => '',
            'button_1_hover_color'            => '',
            'button_1_background_color'       => '',
            'button_1_hover_background_color' => '',
            'button_1_border_color'           => '',
            'button_1_hover_border_color'     => '',
            'button_2_size' 				  => '',
            'button_2_link' 				  => '',
            'button_2_text' 				  => 'button',
            'button_2_target' 				  => '',
            'button_2_icon_pack' 			  => '',
            'button_2_color' 				  => '',
            'button_2_hover_color'            => '',
            'button_2_background_color'       => '',
            'button_2_hover_background_color' => '',
            'button_2_border_color'           => '',
            'button_2_hover_border_color'     => '',
		);

		$call_to_action_button_form_fields = array();
		$call_to_action_button_1_form_fields = array();
		$call_to_action_button_2_form_fields = array();

		foreach (conall_edge_icon_collections()->iconCollections as $collection_key => $collection) {

			$call_to_action_button_form_fields['button_0_' . $collection->param ] = '';
			$call_to_action_button_1_form_fields['button_1_' . $collection->param ] = '';
			$call_to_action_button_2_form_fields['button_2_' . $collection->param ] = '';

		}

        $cta_social_icons_form_fields = array();
        $number_of_social_icons = 6;

        for ($x = 1; $x <= $number_of_social_icons; $x++) {

            foreach (conall_edge_icon_collections()->iconCollections as $collection_key => $collection) {
                $cta_social_icons_form_fields['cta_social_' . $collection->param . '_' . $x] = '';
            }

            $cta_social_icons_form_fields['cta_social_icon_'.$x.'_link'] = '';
            $cta_social_icons_form_fields['cta_social_icon_'.$x.'_target'] = '';

        }

		$args = array_merge($args, $call_to_action_button_form_fields, $call_to_action_button_1_form_fields, $call_to_action_button_2_form_fields, $cta_social_icons_form_fields);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content = preg_replace('#^<\/p>|<p>$#', '', $content);
		$params['text_wrapper_classes'] = $this->getTextWrapperClasses($params);
		$params['content_styles'] = $this->getContentStyles($params);
		$params['info_styles'] = $this->getinfoStyles($params);
		$params['call_to_action_styles'] = $this->getCallToActionStyles($params);
		$params['icons'] = $this->getCallToActionIcon($params);
		$params['icon_holder_classes'] = $this->getIconsClasses($params);
		$params['button_parameters'] = $this->getButtonParameters($params, '0');
		$params['button_1_parameters'] = $this->getButtonParameters($params, '1');
		$params['button_2_parameters'] = $this->getButtonParameters($params, '2');

		//Get HTML from template
		$html = conall_edge_get_shortcode_module_template_part('templates/call-to-action', 'calltoaction', $params['type'], $params);

		return $html;

	}

	/**
	 * Return Classes for Call To Action text wrapper
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextWrapperClasses($params) {
		return (($params['show_button'] == 'yes' && $params['type'] == 'normal') || ($params['type'] == 'with-icons')) ? 'edgtf-call-to-action-column1 edgtf-call-to-action-cell' : '';
	}

    /**
     * Return Classes for Call To Action icons
     *
     * @param $params
     * @return string
     */
    private function getIconsClasses($params) {
        return $params['icon_skin'] != '' ? $params['icon_skin'] : '';
    }

	/**
	 * Return CSS styles for Call To Action Content
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentStyles($params) {
		$content_styles = array();

		if ($params['text_size'] !== '') {
			$content_styles[] = 'font-size: ' . conall_edge_filter_px($params['text_size']) . 'px';
		}
        if ($params['space_below_text'] !== '') {
            $content_styles[] = 'margin-bottom: ' . conall_edge_filter_px($params['space_below_text']) . 'px';
        }

		return implode(';', $content_styles);
	}

    /**
     * Return CSS styles for Call To Action Buttons or Icons
     *
     * @param $params
     * @return string
     */
    private function getinfoStyles($params) {
        $info_styles = array();

        if ($params['type'] == 'normal' && $params['button_position'] != ''){
            $info_styles[] = 'text-align: ' . $params['button_position'];
        }
        elseif ($params['type'] == 'with-icons' && $params['icon_position'] != ''){
            $info_styles[] = 'text-align: ' . $params['icon_position'];
        }
        return implode(';', $info_styles);
    }

	/**
	 * Return CSS styles for Call To Action shortcode
	 *
	 * @param $params
	 * @return string
	 */
	private function getCallToActionStyles($params) {
		$call_to_action_styles = array();

		if ($params['box_padding'] != '') {
			$call_to_action_styles[] = 'padding: ' . $params['box_padding'] . ';';
		}

		return implode(';', $call_to_action_styles);
	}

	/**
	 * Return Icon for Call To Action Shortcode
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getCallToActionIcon($params) {

        $number_of_social_icons = 6;

        $call_to_action_icons = array();

        if ($params['cta_social_icon_pack'] !== '') {

            $icon_pack = conall_edge_icon_collections()->getIconCollection($params['cta_social_icon_pack']);
            $cta_social_icon_type_label = 'cta_social_' . $icon_pack->param;
            $cta_social_icon_param_label = $icon_pack->param;

            for ($i = 1; $i <= $number_of_social_icons; $i++) {

                $cta_social_icon = $params[$cta_social_icon_type_label . '_' . $i];


                $cta_social_link = $params['cta_social_icon_' . $i . '_link'];
                $cta_social_target = $params['cta_social_icon_' . $i . '_target'];

                if ($cta_social_icon !== '') {

                    $team_icon_params = array();
                    $team_icon_params['icon_pack'] = $params['cta_social_icon_pack'];
                    $team_icon_params[$cta_social_icon_param_label] = $cta_social_icon;
                    $team_icon_params['link'] = ($cta_social_link !== '') ? $cta_social_link : '';
                    $team_icon_params['target'] = ($cta_social_target !== '') ? $cta_social_target : '';
                    $team_icon_params['custom_size'] = ($params['icon_size'] !== '') ? conall_edge_filter_px($params['icon_size']) : '';

                    $call_to_action_icons[] = conall_edge_execute_shortcode('edgtf_icon', $team_icon_params);
                }
            }
        }

		return $call_to_action_icons;

	}
	
	private function getButtonParameters($params, $index) {
		$button_params_array = array();
		
		if(!empty($params['button_'.$index.'_link'])) {
			$button_params_array['link'] = $params['button_'.$index.'_link'];
		}
		
		if(!empty($params['button_'.$index.'_size'])) {
			$button_params_array['size'] = $params['button_'.$index.'_size'];
		}
		
		if(!empty($params['button_'.$index.'_icon_pack'])) {
			$button_params_array['icon_pack'] = $params['button_'.$index.'_icon_pack'];
			$iconPackName = conall_edge_icon_collections()->getIconCollectionParamNameByKey($params['button_'.$index.'_icon_pack']);
			$button_params_array[$iconPackName] = $params['button_'.$index.'_'.$iconPackName];
		}
				
		if(!empty($params['button_'.$index.'_target'])) {
			$button_params_array['target'] = $params['button_'.$index.'_target'];
		}
		
		if(!empty($params['button_'.$index.'_text'])) {
			$button_params_array['text'] = $params['button_'.$index.'_text'];
		}

        if(!empty($params['button_'.$index.'_target'])) {
            $button_params_array['target'] = $params['button_'.$index.'_target'];
        }

        if(!empty($params['button_'.$index.'_color'])) {
            $button_params_array['color'] = $params['button_'.$index.'_color'];
        }

        if(!empty($params['button_'.$index.'_hover_color'])) {
            $button_params_array['hover_color'] = $params['button_'.$index.'_hover_color'];
        }

        if(!empty($params['button_'.$index.'_background_color'])) {
            $button_params_array['background_color'] = $params['button_'.$index.'_background_color'];
        }

        if(!empty($params['button_'.$index.'_hover_background_color'])) {
            $button_params_array['hover_background_color'] = $params['button_'.$index.'_hover_background_color'];
        }

        if(!empty($params['button_'.$index.'_border_color'])) {
            $button_params_array['border_color'] = $params['button_'.$index.'_border_color'];
        }

        if(!empty($params['button_'.$index.'_hover_border_color'])) {
            $button_params_array['hover_border_color'] = $params['button_'.$index.'_hover_border_color'];
        }
		
		return $button_params_array;
	}
}