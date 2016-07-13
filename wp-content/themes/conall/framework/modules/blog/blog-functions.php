<?php

if( !function_exists('conall_edge_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function conall_edge_get_blog($type) {

		$sidebar = conall_edge_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);
		conall_edge_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}
}

if( !function_exists('conall_edge_get_blog_type') ) {
	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */
	function conall_edge_get_blog_type($type) {
		
		$blog_query = conall_edge_get_blog_query();
		
		$paged = conall_edge_paged();
		$blog_classes = '';

		if(conall_edge_options()->getOptionValue('blog_page_range') != ""){
			$blog_page_range = esc_attr(conall_edge_options()->getOptionValue('blog_page_range'));
		} else{
			$blog_page_range = $blog_query->max_num_pages;
		}
		$show_load_more = conall_edge_enable_load_more();
		
		if($show_load_more){
			$blog_classes .= ' edgtf-blog-load-more';
		}
		
		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type,
			'blog_classes' => $blog_classes
		);

		conall_edge_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
	}
}

if(!function_exists('conall_edge_get_blog_query')){
	/**
	* Function which create query for blog lists
	*
	* @return wp query object
	*/
	function conall_edge_get_blog_query(){
		global $wp_query;
		
		$id = conall_edge_get_page_id();
		$category = esc_attr(get_post_meta($id, "edgtf_blog_category_meta", true));
		if(esc_attr(get_post_meta($id, "edgtf_show_posts_per_page_meta", true)) != ""){
			$post_number = esc_attr(get_post_meta($id, "edgtf_show_posts_per_page_meta", true));
		}else{			
			$post_number = esc_attr(get_option('posts_per_page'));
		} 
		
		$paged = conall_edge_paged();
		$query_array = array(
			'post_type' => 'post',
			'paged' => $paged,
			'cat' 	=> $category,
			'posts_per_page' => $post_number
		);
		if(is_archive()){
			$blog_query = $wp_query;
		}else{
			$blog_query = new WP_Query($query_array);
		}
		return $blog_query;
	}
}

if( !function_exists('conall_edge_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type
	 * @return post hormat template
	 */
	function conall_edge_get_post_format_html($type = "", $ajax = '') {

		$post_format = get_post_format();

		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		if(in_array($post_format,$supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}

		$slug = '';
		if($type !== ""){
			$slug = $type;
		}

		$params = array();
		$params['blog_template_type'] = $type;
		$params['post_format']		  = $post_format;

		$chars_array = conall_edge_blog_lists_number_of_chars();
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}

		$params['display_date'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_list_date') !== ''){
			$params['display_date'] = conall_edge_options()->getOptionValue('blog_list_date');
		}

		$params['display_category'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_list_category') !== ''){
			$params['display_category'] = conall_edge_options()->getOptionValue('blog_list_category');
		}

		$params['display_author'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_list_author') !== ''){
			$params['display_author'] = conall_edge_options()->getOptionValue('blog_list_author');
		}

		$params['display_comments'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_list_comment') !== ''){
			$params['display_comments'] = conall_edge_options()->getOptionValue('blog_list_comment');
		}

		$params['display_like'] = 'no';
		if(conall_edge_options()->getOptionValue('blog_list_like') !== ''){
			$params['display_like'] = conall_edge_options()->getOptionValue('blog_list_like');
		}

		$params['display_share'] = 'no';
		if(conall_edge_options()->getOptionValue('blog_list_share') !== ''){
			$params['display_share'] = conall_edge_options()->getOptionValue('blog_list_share');
		}

		$params['display_feature_image'] = true;
		if(conall_edge_options()->getOptionValue('blog_list_feature_image') === 'no'){
			$params['display_feature_image'] = false;
		}

		if($type === 'masonry') {
			$params['display_category'] = 'no';
			$params['display_like'] = 'no';
			$params['display_share'] = 'no';
		}

		if($ajax == ''){
			conall_edge_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);
		}
		if($ajax == 'yes'){
			return conall_edge_get_blog_module_template_part('templates/lists/post-formats/' . $post_format, $slug, $params);
		}
	}
}

if( !function_exists('conall_edge_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function conall_edge_get_default_blog_list() {

		$blog_list = conall_edge_options()->getOptionValue('blog_list_type');
		return $blog_list;
	}
}

if (!function_exists('conall_edge_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */
	function conall_edge_pagination($pages = '', $range = 4, $paged = 1){

		$showitems = $range+1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}
		
		$show_load_more = conall_edge_enable_load_more();
		$masonry_template = conall_edge_is_masonry_template();
		
		$search_template = 'no';
		if(is_search()){
			$search_template = 'yes';
		}
		
		if($pages != 1){
			if($show_load_more == 'yes'  && $search_template !== 'yes' && !$masonry_template){
				$params = array(
					'type' => 'solid',
					'size' => 'large',
					'custom_class' => 'edgtf-btn-custom-border-hover edgtf-btn-custom-hover-color edgtf-btn-custom-hover-bg',
					'text' => esc_html__('LOAD MORE', 'conall')
				);
				echo '<div class="edgtf-load-more-ajax-pagination">';
				echo conall_edge_get_button_html($params);
				echo '</div>';
			} else {
				echo '<span class="edgtf-pagination-new-holder">'. get_the_posts_pagination().'</span>';

				echo '<div class="edgtf-pagination">';
					echo '<div class="edgtf-grid"><ul>';
						if($paged > 2 && $paged > $range+1 && $showitems < $pages){
							echo '<li class="edgtf-pagination-first-page"><a href="'.esc_url(get_pagenum_link(1)).'"><i class="edgtf-pagination-icon icon-arrows-left-double-32"></i></a></li>';
						}
						if ($paged > 1) {
							echo "<li class='edgtf-pagination-prev'><a href='".esc_url(get_pagenum_link($paged - 1))."'><i class='edgtf-pagination-icon icon-arrows-slim-left'></i></a></li>";
						}
						for ($i=1; $i <= $pages; $i++){
							if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
								echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
							}
						}
						if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
							echo '<li class="edgtf-pagination-last-page"><a href="'.esc_url(get_pagenum_link($pages)).'"><i class="edgtf-pagination-icon icon-arrows-right-double"></i></a></li>';
						}
						if ($paged !== intval($pages)){
							echo '<li class="edgtf-pagination-next"><a href="';
							if($pages > $paged){
								echo esc_url(get_pagenum_link($paged + 1));
							} else {
								echo esc_url(get_pagenum_link($paged));
							}
							echo '"><i class="edgtf-pagination-icon icon-arrows-slim-right"></i></a></li>';
						}
					echo '</ul></div>';
				echo "</div>";
			}
		}
	}
}

if(!function_exists('conall_edge_post_info')){
	/**
	 * Function that loads parts of blog post info section
	 * Possible options are:
	 * 1. date
	 * 2. category
	 * 3. author
	 * 4. comments
	 * 5. like
	 * 6. share
	 *
	 * @param $config array of sections to load
	 */
	function conall_edge_post_info($config){
		$default_config = array(
			'author' => '',
			'date' => '',
			'category' => '',
			'comments' => '',
			'like' => '',
			'share' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($author == 'yes'){
			conall_edge_get_module_template_part('templates/parts/post-info-author', 'blog');
		}
		if($date == 'yes'){
			conall_edge_get_module_template_part('templates/parts/post-info-date', 'blog');
		}
		if($category == 'yes'){
			conall_edge_get_module_template_part('templates/parts/post-info-category', 'blog');
		}
		if($comments == 'yes'){
			conall_edge_get_module_template_part('templates/parts/post-info-comments', 'blog');
		}
		if($like == 'yes'){
			conall_edge_get_module_template_part('templates/parts/post-info-like', 'blog');
		}
		if($share == 'yes'){
			conall_edge_get_module_template_part('templates/parts/post-info-share', 'blog');
		}
	}
}

if(!function_exists('conall_edge_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in edgt_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function conall_edge_excerpt($excerpt_length = '') {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(conall_edge_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = '45';
			if(isset($excerpt_length) && $excerpt_length != ""){
				$word_count = $excerpt_length;

			} elseif(conall_edge_options()->getOptionValue('number_of_chars') != '') {
				$word_count = esc_attr(conall_edge_options()->getOptionValue('number_of_chars'));
			}
			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode (' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

				//and finally implode words together
				$excerpt 			= implode (' ', $excerpt_word_array);

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="edgtf-post-excerpt">'.rtrim(wp_kses_post($excerpt)).'</p>';
				}
			}
		}
	}
}

if(!function_exists('conall_edge_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function conall_edge_get_blog_single() {
		$sidebar = conall_edge_sidebar_layout();

		$params = array(
			"sidebar" => $sidebar
		);

		conall_edge_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('conall_edge_get_single_html') ) {
	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */
	function conall_edge_get_single_html() {

		$post_format = get_post_format();
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		if(in_array($post_format,$supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}		

		//Related posts
		$related_posts_params = array();
		$show_related = (conall_edge_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
		if ($show_related) {
			$hasSidebar = conall_edge_sidebar_layout();
			$post_id = get_the_ID();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array(
				'posts_per_page' => $related_post_number
			);
			$related_posts_image_size = '';
			if(conall_edge_options()->getOptionValue('blog_single_related_image_size') !== '') {
				$related_posts_image_size = intval(conall_edge_options()->getOptionValue('blog_single_related_image_size'));
			}
			$related_posts_params = array(
				'related_posts' => conall_edge_get_related_post_type($post_id, $related_posts_options),
				'related_posts_image_size' => $related_posts_image_size
			);
		}

		$params = array();
		$params['post_format']	= $post_format;

		$params['display_category'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_single_category') !== ''){
			$params['display_category'] = conall_edge_options()->getOptionValue('blog_single_category');
		}

		$params['display_date'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_single_date') !== ''){
			$params['display_date'] = conall_edge_options()->getOptionValue('blog_single_date');
		}

		$params['display_author'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_single_author') !== ''){
			$params['display_author'] = conall_edge_options()->getOptionValue('blog_single_author');
		}

		$params['display_comments'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_single_comment') !== ''){
			$params['display_comments'] = conall_edge_options()->getOptionValue('blog_single_comment');
		}

		$params['display_like'] = 'yes';
		if(conall_edge_options()->getOptionValue('blog_single_like') !== ''){
			$params['display_like'] = conall_edge_options()->getOptionValue('blog_single_like');
		}

		$params['display_share'] = 'no';
		conall_edge_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog', '', $params);

		$social_params = array();
		$social_params['display_social_share'] = false;
		if(conall_edge_options()->getOptionValue('blog_single_share') === 'yes'){
			$social_params['display_social_share'] = true;
		}
		conall_edge_get_module_template_part('templates/single/parts/single-social-share', 'blog', '', $social_params);

		conall_edge_get_module_template_part('templates/single/parts/single-navigation', 'blog');

		$author_params = array();
		$author_params['display_author_social'] = true;
		if(conall_edge_options()->getOptionValue('blog_single_author_social') === 'no'){
			$author_params['display_author_social'] = false;
		}
		conall_edge_get_module_template_part('templates/single/parts/author-info', 'blog', '', $author_params);
		
		if ($show_related) {
			conall_edge_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
		}
		if(conall_edge_show_comments()){
			comments_template('', true);
		}
	}
}

if(!function_exists('conall_edge_add_user_custom_fields')) {
	/**
	 * Function creates custom social fields for users
	 *
	 * return $user_contact
	 */
	function conall_edge_add_user_custom_fields($user_contact) {

		/**
		 * Function that add custom user fields
		 **/
		$user_contact['facebook']   = esc_html__('Facebook', 'conall');
		$user_contact['twitter']    = esc_html__('Twitter', 'conall');
		$user_contact['linkedin']   = esc_html__('Linkedin', 'conall');
		$user_contact['instagram']  = esc_html__('Instagram', 'conall');
		$user_contact['pinterest']  = esc_html__('Pinterest', 'conall');
		$user_contact['tumblr']     = esc_html__('Tumbrl', 'conall');
		$user_contact['googleplus'] = esc_html__('Google Plus', 'conall');

		return $user_contact;
	}

	add_filter('user_contactmethods', 'conall_edge_add_user_custom_fields');
}

if(!function_exists('conall_edge_get_user_custom_fields')) {
	/**
	 * Function returns links and icons for author social networks
	 *
	 * return array
	 */
	function conall_edge_get_user_custom_fields() {

		$user_social_array    = array();
		$social_network_array = array(
			'facebook',
			'twitter',
			'linkedin',
			'instagram',
			'pinterest',
			'tumblr',
			'googleplus'
		);

		foreach($social_network_array as $network) {
			if(get_the_author_meta($network) !== '') {
				$$network                    = array(
					'link'  => get_the_author_meta($network),
					'class' => 'fa-'.$network.' edgtf-author-social-'.$network.' edgtf-author-social-icon'
				);
				$user_social_array[$network] = $$network;
			}
		}

		return $user_social_array;
	}
}

if( !function_exists('conall_edge_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */

	function conall_edge_additional_post_items() {

		if(has_tag()){
			conall_edge_get_module_template_part('templates/single/parts/tags', 'blog');
		}

		$args_pages = array(
			'before'           => '<div class="edgtf-single-links-pages"><div class="edgtf-single-links-pages-inner">',
			'after'            => '</div></div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);

	}
	add_action('conall_edge_before_blog_article_closed_tag', 'conall_edge_additional_post_items');
}

if( !function_exists('conall_edge_additional_post_list_items') ) {

    /**
     * Function which return parts on default blog list which are just below content
     *
     * @return tags html
     */
    function conall_edge_additional_post_list_items() {

        conall_edge_get_module_template_part('templates/lists/parts/tags', 'blog');

        $args_pages = array(
            'before'           => '<div class="edgtf-single-links-pages"><div class="edgtf-single-links-pages-inner">',
            'after'            => '</div></div>',
            'link_before'      => '<span>',
            'link_after'       => '</span>',
            'pagelink'         => '%'
        );

        wp_link_pages($args_pages);

    }
    add_action('conall_edge_blog_list_tags', 'conall_edge_additional_post_list_items');
}

if( !function_exists('conall_edge_additional_elements_for_blog_list') ) {
    /**
     * Function which return pagination below content for blog pages
     *
     * @return tags html
     */
    function conall_edge_additional_elements_for_blog_list() {

    	$query = conall_edge_get_blog_query();

		$standard_pagination_type = conall_edge_options()->getOptionValue('enable_load_more_pag');
		$masonry_pagination_type = conall_edge_options()->getOptionValue('masonry_pagination');
		$masonry_full_width_pagination_type = conall_edge_options()->getOptionValue('masonry_fullwidth_pagination');

		if (conall_edge_options()->getOptionValue('pagination') === 'yes' && (($standard_pagination_type === 'no' && (get_page_template_slug(conall_edge_get_page_id()) === 'blog-standard.php' || ((is_archive() || is_home()) && conall_edge_options()->getOptionValue('blog_list_type') === 'standard'))) || ($standard_pagination_type === 'no' && (get_page_template_slug(conall_edge_get_page_id()) === 'blog-standard-whole-post.php' || ((is_archive() || is_home()) && conall_edge_options()->getOptionValue('blog_list_type') === 'standard-whole-post'))) || ($standard_pagination_type === 'no' && (get_page_template_slug(conall_edge_get_page_id()) === 'blog-split-column.php' || ((is_archive() || is_home()) && conall_edge_options()->getOptionValue('blog_list_type') === 'split-column'))) || ($masonry_pagination_type === 'standard' && (get_page_template_slug(conall_edge_get_page_id()) === 'blog-masonry.php' || ((is_archive() || is_home()) && conall_edge_options()->getOptionValue('blog_list_type') === 'masonry'))) || ($masonry_full_width_pagination_type === 'standard' && (get_page_template_slug(conall_edge_get_page_id()) === 'blog-masonry-full-width.php' || ((is_archive() || is_home()) && conall_edge_options()->getOptionValue('blog_list_type') === 'masonry-full-width'))))) {
			conall_edge_pagination($query->max_num_pages, conall_edge_get_blog_page_range($query), conall_edge_paged());
		}
    }

    add_action('conall_edge_blog_list_additional_tags', 'conall_edge_additional_elements_for_blog_list');
}

if (!function_exists('conall_edge_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */
	function conall_edge_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'edgtf-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' edgtf-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' edgtf-pingback-comment';
		}
		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="edgtf-comment-image"> <?php echo conall_edge_kses_img(get_avatar($comment, 82)); ?> </div>
			<?php } ?>
			<div class="edgtf-comment-text">
				<div class="edgtf-comment-info">
					<h5 class="edgtf-comment-name">
						<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'conall'); } ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
					</h5>
					<?php
						comment_reply_link( array_merge( $args, array('reply_text' => esc_html__('REPLY', 'conall'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
						edit_comment_link(esc_html__('EDIT','conall'));
					?>
				</div>
				<?php if(!$is_pingback_comment) { ?>
					<div class="edgtf-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				<?php } ?>
				<div class="edgtf-comment-date"><?php comment_time(get_option('date_format')); ?></div>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

if( !function_exists('conall_edge_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */
	function conall_edge_blog_archive_pages_classes($blog_type) {

		$classes = array();

		if(in_array($blog_type, conall_edge_blog_full_width_types())){
			$classes['holder'] = 'edgtf-full-width';
			$classes['inner'] = 'edgtf-full-width-inner';
		} elseif(in_array($blog_type, conall_edge_blog_grid_types())){
			$classes['holder'] = 'edgtf-container';
			$classes['inner'] = 'edgtf-container-inner clearfix';
		}

		return $classes;
	}
}

if( !function_exists('conall_edge_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */
	function conall_edge_blog_full_width_types() {

		$types = array('masonry-full-width');

		return $types;
	}
}

if( !function_exists('conall_edge_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */

	function conall_edge_blog_grid_types() {

		$types = array('standard', 'masonry', 'split-column', 'standard-whole-post');

		return $types;
	}
}

if( !function_exists('conall_edge_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */
	function conall_edge_blog_types() {

		$types = array_merge(conall_edge_blog_grid_types(), conall_edge_blog_full_width_types());

		return $types;
	}
}

if( !function_exists('conall_edge_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */
	function conall_edge_blog_templates() {

		$templates = array();
		$grid_templates = conall_edge_blog_grid_types();
		$full_templates = conall_edge_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;
	}
}

if( !function_exists('conall_edge_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */
	function conall_edge_blog_lists_number_of_chars() {

		$number_of_chars = array();

		if(conall_edge_options()->getOptionValue('standard_number_of_chars')) {
			$number_of_chars['standard'] = conall_edge_options()->getOptionValue('standard_number_of_chars');
		}
		if(conall_edge_options()->getOptionValue('masonry_number_of_chars')){
			$number_of_chars['masonry'] = conall_edge_options()->getOptionValue('masonry_number_of_chars');
            $number_of_chars['masonry-full-width'] = conall_edge_options()->getOptionValue('masonry_number_of_chars');
		}
		if(conall_edge_options()->getOptionValue('split_column_number_of_chars')){
			$number_of_chars['split-column'] = conall_edge_options()->getOptionValue('split_column_number_of_chars');
		}

		return $number_of_chars;
	}
}

if (!function_exists('conall_edge_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function conall_edge_excerpt_length( $length ) {

		if(conall_edge_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(conall_edge_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'conall_edge_excerpt_length', 999 );
}

if(!function_exists('conall_edge_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function conall_edge_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('conall_edge_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function conall_edge_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('conall_edge_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function conall_edge_modify_read_more_link() {
		$link = '<div class="edgtf-more-link-container">';
		$link .= conall_edge_get_button_html(array(
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'conall')
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'conall_edge_modify_read_more_link');
}

if(!function_exists('conall_edge_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function conall_edge_has_blog_widget() {
		$widgets_array = array(
			'edgt_latest_posts_widget'
		);

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('conall_edge_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function conall_edge_has_blog_shortcode() {
		$blog_shortcodes = array(
			'edgtf_blog_list',
			'edgtf_blog_slider',
			'edgtf_blog_carousel'
		);

		$slider_field = get_post_meta(conall_edge_get_page_id(), 'edgtf_page_slider_meta', true); //TODO change

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = conall_edge_has_shortcode($blog_shortcode) || conall_edge_has_shortcode($blog_shortcode, $slider_field);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('conall_edge_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see conall_edge_is_ajax_enabled()
	 * @see conall_edge_is_ajax_enabled_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see edgt_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see edgt_has_blog_widget()
	 * @return bool
	 */
	function conall_edge_load_blog_assets() {
		return conall_edge_is_ajax_enabled() || conall_edge_is_blog_template() || is_home() || is_single() || conall_edge_has_blog_shortcode() || is_archive() || is_search() || conall_edge_has_blog_widget();
	}
}

if(!function_exists('conall_edge_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see conall_edge_get_page_template_name()
	 */
	function conall_edge_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = conall_edge_get_page_template_name();
		}

		$blog_templates = conall_edge_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('conall_edge_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function conall_edge_read_more_button($option = '', $class = '') {
		if($option != '') {
			$show_read_more_button = conall_edge_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		if($show_read_more_button && !conall_edge_post_has_read_more() && !post_password_required()) {
			echo conall_edge_get_button_html(array(
				'type'         => 'simple',
				'size'         => 'medium',
				'link'         => get_the_permalink(),
				'text'         => esc_html__('READ MORE', 'conall'),
				'icon_pack'    => 'linea_icons',
				'linea_icon'   => 'icon-arrows-slim-right',
				'custom_class' => $class
			));
		}
	}
}

if(!function_exists('conall_edge_set_blog_holder_data_params')){
	/**
	 * Function which set data params on blog holder div
	 */
	function conall_edge_set_blog_holder_data_params(){
		
		$show_load_more = conall_edge_enable_load_more();
		if($show_load_more){
			$current_query = conall_edge_get_blog_query();
			
			$data_params = array();
			$data_return_string = '';
			
			$paged = conall_edge_paged();
			
			$posts_number =  '';
			if(get_post_meta(get_the_ID(), "edgtf_show_posts_per_page_meta", true) != ""){
				$posts_number = get_post_meta(get_the_ID(), "edgtf_show_posts_per_page_meta", true);
			}else{			
				$posts_number = get_option('posts_per_page');
			} 
			$category = get_post_meta(conall_edge_get_page_id(), 'edgtf_blog_category_meta', true);
			
			//set data params
			$data_params['data-next-page'] = $paged+1;
			$data_params['data-max-pages'] =  $current_query->max_num_pages;
			
			if($posts_number !=''){
				$data_params['data-post-number'] = $posts_number;
			}
			
			if($category !=''){
				$data_params['data-category'] = $category;
			}
			if(is_archive()){
				if(is_category()){
					$cat_id = get_queried_object_id();
					$data_params['data-archive-category'] = $cat_id;
				}
				if(is_author()){
					$author_id = get_queried_object_id();
					$data_params['data-archive-author'] = $author_id;
 				}
				if(is_tag()){
					$current_tag_id = get_queried_object_id();
					$data_params['data-archive-tag'] = $current_tag_id;
				}
				if(is_date()){
					$day  = get_query_var('day');
					$month = get_query_var('monthnum');
					$year = get_query_var('year');
					
					$data_params['data-archive-day'] = $day;
					$data_params['data-archive-month'] = $month;
					$data_params['data-archive-year'] = $year;
				}				
			}
			if(is_search()){
				$search_query = get_search_query();
				$data_params['data-archive-search-string'] = $search_query; // to do, not finished
			}
			
			foreach($data_params as $key => $value) {
				if ($key !== '') {
					$data_return_string .= $key.'= '.esc_attr($value).' ';
				}
			}
			
			return $data_return_string;
		}
	}
}

if(!function_exists('conall_edge_enable_load_more')){
	/**
	 * Function that check if load more is enabled
	 * 
	 * return boolean
	 */
	function conall_edge_enable_load_more(){
		$enable_load_more = false;
		
		if(conall_edge_options()->getOptionValue('enable_load_more_pag') == 'yes') {
			$enable_load_more = true;
		}
		return $enable_load_more;
	}
}

if(!function_exists('conall_edge_is_masonry_template')){
	/**
     * Check if is masonry template enabled
     * return boolean
     */ 
	function conall_edge_is_masonry_template(){
		$page_id = conall_edge_get_page_id();
		$page_template = get_page_template_slug($page_id);
		$page_options_template = conall_edge_options()->getOptionValue('blog_list_type');

		if (!is_archive()) {
			if($page_template == 'blog-masonry.php' ||  $page_template == 'blog-masonry-full-width.php'){
				return true;
			}
		} elseif (is_archive() || is_home()) {
			if($page_options_template == 'masonry' || $page_options_template == 'masonry-full-width'){
				return true;
			}
		} else {
			return false;
		}
	}
}

/**
 * Loads more function for blog posts.
 *
 */
if(!function_exists('conall_edge_blog_load_more')){
	
	function conall_edge_blog_load_more(){
		$return_obj = array();
		$paged = $post_number = $category = $blog_type = '';
		$archive_category = $archive_author = $archive_tag = $archive_day = $archive_month = $archive_year = '';
		
		if (!empty($_POST['nextPage'])) {
	        $paged = $_POST['nextPage'];
	    }
		if (!empty($_POST['number'])) {
	        $post_number = $_POST['number'];
	    }
		if (!empty($_POST['category'])) {
	        $category = $_POST['category'];
	    }
		if (!empty($_POST['blogType'])) {
	        $blog_type = $_POST['blogType'];
	    }
		if (!empty($_POST['archiveCategory'])) {
	        $archive_category = $_POST['archiveCategory'];
	    }
		if (!empty($_POST['archiveAuthor'])) {
	        $archive_author = $_POST['archiveAuthor'];
	    }
		if (!empty($_POST['archiveTag'])) {
	        $archive_tag = $_POST['archiveTag'];
	    }
		if (!empty($_POST['archiveDay'])) {
	        $archive_day = $_POST['archiveDay'];
	    }
		if (!empty($_POST['archiveMonth'])) {
	        $archive_month = $_POST['archiveMonth'];
	    }
		if (!empty($_POST['archiveYear'])) {
	        $archive_year = $_POST['archiveYear'];
	    }
		
		$html = '';
		$query_array = array(
			'post_type' => 'post',
			'paged' => $paged,
			'posts_per_page' => $post_number
		);
		if($category != ''){
			$query_array['cat'] = $category;
		}
		if($archive_category != ''){
			$query_array['cat'] = $archive_category;
		}
		if($archive_author != ''){
			$query_array['author'] = $archive_author;
		}
		if($archive_tag != ''){
			$query_array['tag'] = $archive_tag;
		}
		if($archive_day !='' && $archive_month != '' && $archive_year !=''){
			$query_array['day'] = $archive_day;
			$query_array['monthnum'] = $archive_month;
			$query_array['year'] = $archive_year;
		}
		$query_results = new \WP_Query($query_array);
		
		if($query_results->have_posts()):			
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$html .=  conall_edge_get_post_format_html($blog_type, 'yes');
			endwhile;
			else:
				$html .= '<p>'. esc_html__('Sorry, no posts matched your criteria.', 'conall') .'</p>';
			endif;
			
		$return_obj = array(
			'html' => $html,
		);
		
		echo json_encode($return_obj); exit;
	}
}

add_action('wp_ajax_nopriv_conall_edge_blog_load_more', 'conall_edge_blog_load_more');
add_action( 'wp_ajax_conall_edge_blog_load_more', 'conall_edge_blog_load_more' );

if(!function_exists('conall_edge_get_post_by_ajax')){
    /**
     * Function loads page content via ajax
     */
    function conall_edge_get_post_by_ajax(){
        global $wp_query;

        $item_id = $html = '';
        
        if (!empty($_POST['currentPostUrl'])) {
            $item_id = url_to_postid($_POST['currentPostUrl']);
        }

        $query_array = array(
            'post_type' => 'post',
            'p' => $item_id
        );

        $query_results = new \WP_Query($query_array);

        $wp_query = $query_results; 

        if($query_results->have_posts()):           
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $html .= conall_edge_get_single_html('yes');
            endwhile;
        else:
            $html .= conall_edge_get_module_template_part('templates/parts/no-posts', 'blog');
        endif;

        $return_obj = array(
            'html' => $html
        );

        $wp_query = null;
    
        echo json_encode($return_obj); exit;   
    }
}

add_action('wp_ajax_nopriv_conall_edge_get_post_by_ajax', 'conall_edge_get_post_by_ajax');
add_action('wp_ajax_conall_edge_get_post_by_ajax', 'conall_edge_get_post_by_ajax');

if(!function_exists('conall_edge_get_max_number_of_pages')) {
    /**
     * Function that return max number of posts/pages for pagination
     * @return int
     *
     * @version 0.1
     */
    function conall_edge_get_max_number_of_pages() {
        global $wp_query;

        $max_number_of_pages = 10; //default value
        
        if($wp_query) {
            $max_number_of_pages = $wp_query->max_num_pages;
        }

        return $max_number_of_pages;
    }
}

if(!function_exists('conall_edge_get_blog_page_range')) {
    /**
     * Function that return current page for blog list pagination
     * @return int
     *
     * @version 0.1
     */
    function conall_edge_get_blog_page_range($query = '') {
        global $wp_query;

        if($query == ''){
			$query = $wp_query;
		}

        if(conall_edge_options()->getOptionValue('blog_page_range') != ""){
            $blog_page_range = esc_attr(conall_edge_options()->getOptionValue('blog_page_range'));
        } else{
            $blog_page_range = $query->max_num_pages;
        }

        return $blog_page_range;
    }
}
?>