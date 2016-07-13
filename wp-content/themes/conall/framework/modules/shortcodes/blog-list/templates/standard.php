<li class="edgtf-bli clearfix">
	<div class="edgtf-bli-inner">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="edgtf-bli-image">
			<a itemprop="url" href="<?php echo esc_url(get_permalink()); ?>">
				<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);	?>				
			</a>
		</div>
		<?php } ?>
		<div class="edgtf-item-text-holder">
			<<?php echo esc_html($title_tag)?> itemprop="name" class="entry-title edgtf-bli-title">
				<a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>">
					<?php echo esc_attr(get_the_title()) ?>
				</a>
			</<?php echo esc_html($title_tag) ?>>
			
			<?php if($post_info_section === 'yes') { ?>
				<div class="edgtf-bli-info">
					<?php conall_edge_post_info(array(
						'author' => $post_info_author,
						'date' => $post_info_date,
						'category' => $post_info_category,
						'comments' => $post_info_comments, 
						'like' => $post_info_like,
						'share' => $post_info_share
					)) ?>
				</div>
			<?php } ?>
			
			<?php if ($text_length != '0') {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
				<p itemprop="description" class="edgtf-bli-excerpt"><?php echo esc_html($excerpt)?></p>
			<?php } ?>

			<div class="edgtf-bli-read-more-holder">
				<?php conall_edge_read_more_button(); ?>
			</div>
		</div>
	</div>	
</li>