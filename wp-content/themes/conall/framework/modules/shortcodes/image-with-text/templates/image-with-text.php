<div class="edgtf-imwt-holder">
    <div class="edgtf-imwt-image">
        <?php if ($enable_lightbox) { ?>
            <a href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['title']); ?>">
        <?php } ?>
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo conall_edge_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        <?php if ($enable_lightbox) { ?>
            </a>
        <?php } ?>
    </div>
    <div class="edgtf-imwt-text">
        <div class="edgtf-imwt-title-holder">
        <?php if ($text_before_title !== '') : ?>
            <span class="edgtf-imwt-before-title"><?php echo esc_html($text_before_title); ?></span>
        <?php endif; ?>

        <<?php echo esc_attr($title_tag); ?> class="edgtf-imwt-title"><?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
        </div>

        <?php if ($text !== '') { ?>
            <p class="edgtf-imwt-text"><?php echo esc_html($text); ?></p>
        <?php } ?>

        <?php if(!empty($link) && !empty($link_text)) : ?>
            <?php echo conall_edge_execute_shortcode('edgtf_button', $button_parameters); ?>
        <?php endif; ?>
    </div>
</div>