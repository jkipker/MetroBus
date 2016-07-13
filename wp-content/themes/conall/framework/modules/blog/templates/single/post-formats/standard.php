<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<?php
			$image_param = array();
			$image_param['image_post_format'] = $post_format;
			conall_edge_get_module_template_part('templates/single/parts/image', 'blog', '', $image_param); ?>
		<div class="edgtf-post-text">
			<?php 
				$title_param = array();
				$title_param['title_post_format'] = $post_format;
				conall_edge_get_module_template_part('templates/single/parts/title', 'blog', '', $title_param);
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
			<?php the_content(); ?>
		</div>
	</div>
	<?php do_action('conall_edge_before_blog_article_closed_tag'); ?>
</article>