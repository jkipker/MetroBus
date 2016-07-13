<li class="edgtf-bli clearfix">
	<div class="edgtf-simple-inner">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="edgtf-simple-image <?php echo ($thumb_image_size == 'sidebar') ? 'edgtf-simple-image-large' : '' ?> ">
			<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php if($thumb_image_size == 'sidebar') {
                    echo conall_edge_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,104,104);
                }
                else {
                    echo get_the_post_thumbnail(get_the_ID(), 'conall_edge_search_image');
                }?>
			</a>
		</div>
		<?php } ?>
		<div class="edgtf-simple-text">
			<<?php echo esc_attr($title_tag);?> itemprop="name" class="entry-title edgtf-simple-title">
				<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</<?php echo esc_attr($title_tag);?>>
            <div class="edgtf-simple-post-info">
                <?php conall_edge_post_info(array(
                    'category' => $post_simple_info_category,
                )); ?>
                <?php conall_edge_post_info(array(
                    'date' => 'yes',
                )); ?>
            </div>
		</div>
	</div>
</li>