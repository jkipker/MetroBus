<?php

if ( ! function_exists('conall_edge_social_options_map') ) {

	function conall_edge_social_options_map() {

		conall_edge_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => 'Social Networks',
				'icon'  => 'fa fa-share-alt'
			)
		);

		/**
		 * Enable Social Share
		 */
		$panel_social_share = conall_edge_add_admin_panel(array(
			'page'  => '_social_page',
			'name'  => 'panel_social_share',
			'title' => 'Enable Social Share'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Social Share',
			'description'	=> 'Enabling this option will allow social share on networks of your choice',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_panel_social_networks, #edgtf_panel_show_social_share_on'
			),
			'parent'		=> $panel_social_share
		));

		$panel_show_social_share_on = conall_edge_add_admin_panel(array(
			'page'  			=> '_social_page',
			'name'  			=> 'panel_show_social_share_on',
			'title' 			=> 'Show Social Share On',
			'hidden_property'	=> 'enable_social_share',
			'hidden_value'		=> 'no'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_post',
			'default_value'	=> 'no',
			'label'			=> 'Posts',
			'description'	=> 'Show Social Share on Blog Posts',
			'parent'		=> $panel_show_social_share_on
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_page',
			'default_value'	=> 'no',
			'label'			=> 'Pages',
			'description'	=> 'Show Social Share on Pages',
			'parent'		=> $panel_show_social_share_on
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_attachment',
			'default_value'	=> 'no',
			'label'			=> 'Media',
			'description'	=> 'Show Social Share for Images and Videos',
			'parent'		=> $panel_show_social_share_on
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_portfolio-item',
			'default_value'	=> 'no',
			'label'			=> 'Portfolio Item',
			'description'	=> 'Show Social Share for Portfolio Items',
			'parent'		=> $panel_show_social_share_on
		));

		if(conall_edge_is_woocommerce_installed()){
			conall_edge_add_admin_field(array(
				'type'			=> 'yesno',
				'name'			=> 'enable_social_share_on_product',
				'default_value'	=> 'no',
				'label'			=> 'Product',
				'description'	=> 'Show Social Share for Product Items',
				'parent'		=> $panel_show_social_share_on
			));
		}

		/**
		 * Social Share Networks
		 */
		$panel_social_networks = conall_edge_add_admin_panel(array(
			'page'  			=> '_social_page',
			'name'				=> 'panel_social_networks',
			'title'				=> 'Social Networks',
			'hidden_property'	=> 'enable_social_share',
			'hidden_value'		=> 'no'
		));

		/**
		 * Facebook
		 */
		conall_edge_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'facebook_title',
			'title'		=> 'Share on Facebook'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_facebook_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Facebook',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_enable_facebook_share_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_facebook_share_container = conall_edge_add_admin_container(array(
			'name'		=> 'enable_facebook_share_container',
			'hidden_property'	=> 'enable_facebook_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'facebook_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_facebook_share_container
		));

		/**
		 * Twitter
		 */
		conall_edge_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'twitter_title',
			'title'		=> 'Share on Twitter'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_twitter_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Twitter',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_enable_twitter_share_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_twitter_share_container = conall_edge_add_admin_container(array(
			'name'		=> 'enable_twitter_share_container',
			'hidden_property'	=> 'enable_twitter_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'twitter_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_twitter_share_container
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'text',
			'name'			=> 'twitter_via',
			'default_value'	=> '',
			'label'			=> 'Via',
			'parent'		=> $enable_twitter_share_container
		));

		/**
		 * Google Plus
		 */
		conall_edge_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'google_plus_title',
			'title'		=> 'Share on Google Plus'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_google_plus_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Google Plus',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_enable_google_plus_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_google_plus_container = conall_edge_add_admin_container(array(
			'name'		=> 'enable_google_plus_container',
			'hidden_property'	=> 'enable_google_plus_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'google_plus_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_google_plus_container
		));

		/**
		 * Linked In
		 */
		conall_edge_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'linkedin_title',
			'title'		=> 'Share on LinkedIn'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_linkedin_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via LinkedIn',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_enable_linkedin_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_linkedin_container = conall_edge_add_admin_container(array(
			'name'		=> 'enable_linkedin_container',
			'hidden_property'	=> 'enable_linkedin_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'linkedin_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_linkedin_container
		));

		/**
		 * Tumblr
		 */
		conall_edge_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'tumblr_title',
			'title'		=> 'Share on Tumblr'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_tumblr_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Tumblr',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_enable_tumblr_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_tumblr_container = conall_edge_add_admin_container(array(
			'name'		=> 'enable_tumblr_container',
			'hidden_property'	=> 'enable_tumblr_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'tumblr_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_tumblr_container
		));

		/**
		 * Pinterest
		 */
		conall_edge_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'pinterest_title',
			'title'		=> 'Share on Pinterest'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_pinterest_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Pinterest',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_enable_pinterest_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_pinterest_container = conall_edge_add_admin_container(array(
			'name'				=> 'enable_pinterest_container',
			'hidden_property'	=> 'enable_pinterest_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'pinterest_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_pinterest_container
		));

		/**
		 * VK
		 */
		conall_edge_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'vk_title',
			'title'		=> 'Share on VK'
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_vk_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via VK',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_enable_vk_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_vk_container = conall_edge_add_admin_container(array(
			'name'				=> 'enable_vk_container',
			'hidden_property'	=> 'enable_vk_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		conall_edge_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'vk_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_vk_container
		));

		if(defined('EDGEF_TWITTER_FEED_VERSION')) {
            $twitter_panel = conall_edge_add_admin_panel(array(
                'title' => 'Twitter',
                'name'  => 'panel_twitter',
                'page'  => '_social_page'
            ));

            conall_edge_add_admin_twitter_button(array(
                'name'   => 'twitter_button',
                'parent' => $twitter_panel
            ));
        }

        if(defined('EDGEF_INSTAGRAM_FEED_VERSION')) {
            $instagram_panel = conall_edge_add_admin_panel(array(
                'title' => 'Instagram',
                'name'  => 'panel_instagram',
                'page'  => '_social_page'
            ));

            conall_edge_add_admin_instagram_button(array(
                'name'   => 'instagram_button',
                'parent' => $instagram_panel
            ));
        }
	}

	add_action( 'conall_edge_options_map', 'conall_edge_social_options_map', 18);
}