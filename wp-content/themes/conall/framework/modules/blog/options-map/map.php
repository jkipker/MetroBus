<?php

if ( ! function_exists('conall_edge_blog_options_map') ) {

	function conall_edge_blog_options_map() {

		conall_edge_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => 'Blog',
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */

		$custom_sidebars = conall_edge_get_custom_sidebars();

		$panel_blog_lists = conall_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => 'Blog Lists'
			)
		);

		conall_edge_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => 'Blog Layout for Archive Pages',
			'description' => 'Choose a default blog layout',
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'standard'				=> 'Blog: Standard',
				'standard-whole-post' 	=> 'Blog: Standard Whole Post',
				'split-column'			=> 'Blog: Split Column',
				'masonry' 				=> 'Blog: Masonry',
				'masonry-full-width' 	=> 'Blog: Masonry Full Width',
			)
		));

		conall_edge_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => 'Archive and Category Sidebar',
			'description' => 'Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'default'			=> 'No Sidebar',
				'sidebar-33-right'	=> 'Sidebar 1/3 Right',
				'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
				'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
				'sidebar-25-left' 	=> 'Sidebar 1/4 Left',
			)
		));


		if(count($custom_sidebars) > 0) {
			conall_edge_add_admin_field(array(
				'name' => 'blog_custom_sidebar',
				'type' => 'selectblank',
				'label' => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"',
				'parent' => $panel_blog_lists,
				'options' => conall_edge_get_custom_sidebars()
			));
		}

		conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'pagination',
				'default_value' => 'yes',
				'label' => 'Pagination',
				'parent' => $panel_blog_lists,
				'description' => 'Enabling this option will display pagination links on bottom of Blog Post List',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_pagination_container'
				)
			)
		);

		$pagination_container = conall_edge_add_admin_container(
			array(
				'name' => 'edgtf_pagination_container',
				'hidden_property' => 'pagination',
				'hidden_value' => 'no',
				'parent' => $panel_blog_lists,
			)
		);

		conall_edge_add_admin_field(
			array(
				'parent' => $pagination_container,
				'type' => 'text',
				'name' => 'blog_page_range',
				'default_value' => '',
				'label' => 'Pagination Range limit',
				'description' => 'Enter a number that will limit pagination to a certain range of links',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(array(
			'name'        => 'masonry_pagination',
			'type'        => 'select',
			'label'       => 'Pagination on Masonry',
			'description' => 'Choose a pagination style for Masonry Blog List',
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'			=> 'Standard',
				'load-more'			=> 'Load More',
				'infinite-scroll' 	=> 'Infinite Scroll'
			),	
		));

        conall_edge_add_admin_field(array(
            'name'        => 'masonry_fullwidth_pagination',
            'type'        => 'select',
            'label'       => 'Pagination on Masonry Full Width',
            'description' => 'Choose a pagination style for Masonry Full Width Blog List',
            'parent'      => $pagination_container,
            'options'     => array(
                'standard'			=> 'Standard',
                'load-more'			=> 'Load More',
                'infinite-scroll' 	=> 'Infinite Scroll'
            ),
        ));


        conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'enable_load_more_pag',
				'default_value' => 'no',
				'label' => 'Load More Pagination on Other Lists',
				'parent' => $pagination_container,
				'description' => 'Enable Load More Pagination on other lists',
				'args' => array(
					'col_width' => 3
				)
			)
		);	
	
		conall_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '',
				'label' => 'Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'standard_number_of_chars',
				'default_value' => '',
				'label' => 'Standard Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'masonry_number_of_chars',
				'default_value' => '',
				'label' => 'Masonry Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'split_column_number_of_chars',
				'default_value' => '22',
				'label' => 'Split Column Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_feature_image',
			'type'          => 'yesno',
			'label'         => 'Show Feature Image',
			'description'   => 'Enabling this option will show feature image for your posts on your blog page',
			'parent'        => $panel_blog_lists,
			'default_value' => 'yes',
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_category',
			'type'          => 'yesno',
			'label'         => 'Show Category',
			'description'   => 'Enabling this option will show category post info on your blog page',
			'parent'        => $panel_blog_lists,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_date',
			'type'          => 'yesno',
			'label'         => 'Show Date',
			'description'   => 'Enabling this option will show date post info on your blog page',
			'parent'        => $panel_blog_lists,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_author',
			'type'          => 'yesno',
			'label'         => 'Show Author',
			'description'   => 'Enabling this option will show author post info on your blog page',
			'parent'        => $panel_blog_lists,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_comment',
			'type'          => 'yesno',
			'label'         => 'Show Comments',
			'description'   => 'Enabling this option will show comments post info on your blog page',
			'parent'        => $panel_blog_lists,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_like',
			'type'          => 'yesno',
			'label'         => 'Show Like',
			'description'   => 'Enabling this option will show like post info on your blog page',
			'parent'        => $panel_blog_lists,
			'default_value' => 'no'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_share',
			'type'          => 'yesno',
			'label'         => 'Show Share',
			'description'   => 'Enabling this option will show share post info on your blog page',
			'parent'        => $panel_blog_lists,
			'default_value' => 'no'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_list_tags',
			'type'          => 'yesno',
			'label'         => 'Show Tags',
			'description'   => 'Enabling this option will show post tags on your blog page.',
			'parent'        => $panel_blog_lists,
			'default_value' => 'yes'
		));

		/**
		 * Blog Single
		 */
		$panel_blog_single = conall_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => 'Blog Single'
			)
		);


		conall_edge_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => 'Sidebar Layout',
			'description' => 'Choose a sidebar layout for Blog Single pages',
			'parent'      => $panel_blog_single,
			'options'     => array(
				'default'			=> 'No Sidebar',
				'sidebar-33-right'	=> 'Sidebar 1/3 Right',
				'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
				'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
				'sidebar-25-left' 	=> 'Sidebar 1/4 Left',
			),
			'default_value'	=> 'default'
		));


		if(count($custom_sidebars) > 0) {
			conall_edge_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar',
				'type' => 'selectblank',
				'label' => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"',
				'parent' => $panel_blog_single,
				'options' => conall_edge_get_custom_sidebars()
			));
		}

		conall_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'blog_single_feature_image_max_width',
				'default_value' => '',
				'label' => 'Featured Image Max Width',
				'parent' => $panel_blog_single,
				'description' => 'Define maximum width for featured image on single post pages. Default value is 1100',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_category',
			'type'          => 'yesno',
			'label'         => 'Show Category',
			'description'   => 'Enabling this option will show category post info on your single post page',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_date',
			'type'          => 'yesno',
			'label'         => 'Show Date',
			'description'   => 'Enabling this option will show date post info on your single post page',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_author',
			'type'          => 'yesno',
			'label'         => 'Show Author',
			'description'   => 'Enabling this option will show author post info on your single post page',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_comment',
			'type'          => 'yesno',
			'label'         => 'Show Comments',
			'description'   => 'Enabling this option will show comments post info on your single post page',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_like',
			'type'          => 'yesno',
			'label'         => 'Show Like',
			'description'   => 'Enabling this option will show like post info on your single post page',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_count',
			'type'          => 'yesno',
			'label'         => 'Show Post Count',
			'description'   => 'Enabling this option will show count post info on your single post page',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_share',
			'type'          => 'yesno',
			'label'         => 'Show Share',
			'description'   => 'Enabling this option will show share post info on your single post page',
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_tags',
			'type'          => 'yesno',
			'label'         => 'Show Tags',
			'description'   => 'Enabling this option will show post tags on your single post page.',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> 'Show Related Posts',
			'description'   => 'Enabling this option will show related posts on your single post page.',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edgtf_related_image_container'
			)
		));

		$related_image_container = conall_edge_add_admin_container(
			array(
				'name' => 'related_image_container',
				'hidden_property' => 'blog_single_related_posts',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'blog_single_related_image_size',
				'default_value' => '',
				'label' => 'Related Posts Image Max Width',
				'parent' => $related_image_container,
				'description' => 'Define maximum width for related posts images on your single post pages. Default value is 1100',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => 'Show Comments Form',
			'description'   => 'Enabling this option will show comments form on your page.',
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => 'Enable Prev/Next Single Post Navigation Links',
				'parent' => $panel_blog_single,
				'description' => 'Enable navigation links through the blog posts (left and right arrows will appear)',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = conall_edge_add_admin_container(
			array(
				'name' => 'edgtf_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		conall_edge_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => 'Enable Navigation Only in Current Category',
				'description' => 'Limit your navigation only through current category',
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => 'Show Author Info Box',
				'parent' => $panel_blog_single,
				'description' => 'Enabling this option will display author name and descriptions on Blog Single pages',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = conall_edge_add_admin_container(
			array(
				'name' => 'edgtf_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		conall_edge_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => 'Show Author Email',
				'description' => 'Enabling this option will show author email',
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		conall_edge_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => 'Show Author Social Icons',
				'description' => 'Enabling this option will show author social icons on your single post page',
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

	}

	add_action( 'conall_edge_options_map', 'conall_edge_blog_options_map', 13);
}