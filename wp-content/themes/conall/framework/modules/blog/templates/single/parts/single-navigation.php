<?php if(conall_edge_options()->getOptionValue('blog_single_navigation') == 'yes'){ ?>
	<?php $navigation_blog_through_category = conall_edge_options()->getOptionValue('blog_navigation_through_same_category') ?>
	<div class="edgtf-blog-single-navigation">
		<?php if(get_previous_post() != ""){ ?>
			<div class="edgtf-blog-single-prev">
				<div class="edgtf-blog-single-prev-inner">
					<?php
					if($navigation_blog_through_category == 'yes'){
						previous_post_link('%link','<span class="edgtf-blog-single-nav-mark icon-arrows-slim-left"></span>', true,'','category');
						if(get_previous_post(true) != ""){
							$prev_post = get_previous_post(true);
							echo '<div class="edgtf-blog-single-nav-text">';
							echo '<h5>'.esc_html__('PREV', 'conall').'</h5>';
							echo '<p>'.esc_html($prev_post->post_title).'</p>';
							echo '</div>';
						}
					} else {
						previous_post_link('%link','<span class="edgtf-blog-single-nav-mark icon-arrows-slim-left"></span>');
						if(get_previous_post() != ""){
							$prev_post = get_previous_post();
							echo '<div class="edgtf-blog-single-nav-text">';
							echo '<h5>'.esc_html__('PREV', 'conall').'</h5>';
							echo '<p>'.esc_html($prev_post->post_title).'</p>';
							echo '</div>';
						}
					}
					?>
				</div>	
			</div>
		<?php } ?>
		<?php if(get_next_post() != ""){ ?>
			<div class="edgtf-blog-single-next">
				<div class="edgtf-blog-single-prev-inner">
					<?php
					if($navigation_blog_through_category == 'yes'){
						if(get_next_post(true) != ""){
							$next_post = get_next_post(true);
							echo '<div class="edgtf-blog-single-nav-text">';
							echo '<h5>'.esc_html__('NEXT', 'conall').'</h5>';
							echo '<p>'.esc_html($next_post->post_title).'</p>';
							echo '</div>';
						}
						next_post_link('%link','<span class="edgtf-blog-single-nav-mark icon-arrows-slim-right"></span>', true,'','category');
					} else {
						if(get_next_post() != ""){
							$next_post = get_next_post();
							echo '<div class="edgtf-blog-single-nav-text">';
							echo '<h5>'.esc_html__('NEXT', 'conall').'</h5>';
							echo '<p>'.esc_html($next_post->post_title).'</p>';
							echo '</div>';
						}
						next_post_link('%link','<span class="edgtf-blog-single-nav-mark icon-arrows-slim-right"></span>');
					}
					?>
				</div>	
			</div>
		<?php } ?>
	</div>
<?php } ?>