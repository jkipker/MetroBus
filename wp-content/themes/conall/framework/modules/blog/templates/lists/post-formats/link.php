<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<?php if($display_feature_image){ 
			$image_param = array();
			$image_param['post_format'] = $post_format;
			$image_param['image_post_link_link'] = get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true);
			conall_edge_get_module_template_part('templates/lists/parts/image', 'blog', '', $image_param); } ?>
		<div class="edgtf-post-text">
			<?php 
				$title_param = array();
				$title_param['blog_template_type'] = $blog_template_type;
				$title_param['title_post_format'] = $post_format;
				$title_param['title_post_link_link'] = get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true);
				conall_edge_get_module_template_part('templates/lists/parts/title', 'blog', '', $title_param);
			?>
			<div class="edgtf-post-info">
				<?php conall_edge_post_info(array(
					'author' => $display_author,
					'date' => $display_date,
					'category' => $display_category,
					'comments' => $display_comments, 
					'like' => $display_like,
					'share' => $display_share
				)) ?>
			</div>
			<?php if(esc_html(get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true)) !== '') { ?>
				<a class="edgtf-link-text" href="<?php echo esc_html(get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true)); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true)); ?></a>
			<?php } ?>
			<div class="edgtf-post-read-more-holder">
				<?php conall_edge_read_more_button(); ?>
			</div>
            <?php do_action('conall_edge_blog_list_tags'); ?>
		</div>
	</div>
</article>