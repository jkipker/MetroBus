<div class="edgtf-blog-slider-item clearfix">
    <?php if ( has_post_thumbnail() ) { ?>
    <div class="edgtf-bls-image">
        <a itemprop="url" href="<?php echo esc_url(get_permalink()); ?>">
            <?php echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);	?>
        </a>
    </div>
    <?php } ?>
    <div class="edgtf-item-text-overlay">
        <div class="edgtf-item-text-overlay-inner">
            <div class="edgtf-item-text-holder">
                <<?php echo esc_html($title_tag)?> itemprop="name" class="entry-title edgtf-item-title">
                    <?php echo esc_attr(get_the_title()) ?>
                </<?php echo esc_html($title_tag) ?>>
                <?php if($post_info_section === 'yes') { ?>
                    <div class="edgtf-item-info">
                        <?php conall_edge_post_info(array(
                            'author' => $post_info_author,
                            'date' => $post_info_date,
                            'category' => $post_info_category,
                            'comments' => $post_info_comments,
                            'like' => $post_info_like
                        )) ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>