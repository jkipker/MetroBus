<?php // This line is needed for mixItUp gutter ?>

    <article class="edgtf-portfolio-item mix <?php echo esc_attr($categories)?>">
        <div class = "edgtf-item-image-holder">
                <div class="edgtf-showcase-button-holder">
                    <div class="edgtf-showcase-button-holder-inner">
                        <div class="edgtf-showcase-button-holder-inner2">
                            <?php echo conall_edge_execute_shortcode('edgtf_button', $button_params); ?>
                        </div>
                    </div>
                </div>
            <a href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($button_link_target); ?>">
                <?php
                echo get_the_post_thumbnail(get_the_ID(),$thumb_size);
                ?>
            </a>
        </div>
        <div class="edgtf-item-text-holder">
            <<?php echo esc_attr($title_tag)?> class="edgtf-item-title" <?php echo conall_edge_get_inline_style($title_style) ?>>
            <a href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($button_link_target); ?>">
                <?php echo esc_attr(get_the_title()); ?>
            </a>
        </<?php echo esc_attr($title_tag)?>>
        </div>
    </article>

<?php // This line is needed for mixItUp gutter ?>