<div class="edgtf-blog-slider-holder <?php echo $navigation == 'yes' ? 'edgtf-blog-slider-active-dots' : '' ?> ">
	<div class="edgtf-blog-slider" <?php echo conall_edge_get_inline_attrs($blog_slider_data_attributes); ?>  >
		<?php
		$html = '';
			if($query_result->have_posts()):
			    while ($query_result->have_posts()) : $query_result->the_post();
				    $html .= conall_edge_get_shortcode_module_template_part('templates/blog-slider-item', 'blog-slider', '', $params);
			    endwhile;
			    print $html;
			else: ?>
			    <div class="edgtf-blog-slider-messsage">
				    <p><?php esc_html_e('No posts were found.', 'conall'); ?></p>
			    </div>
			<?php endif;
			wp_reset_postdata();
		?>
	</div>
</div>