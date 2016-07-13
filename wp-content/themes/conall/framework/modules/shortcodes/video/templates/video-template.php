<?php
/**
 * Video shortcode template
 */
?>

<div class="edgtf-video-holder">
    <div class="edgtf-video-image-holder">
        <?php if(is_array($video_thumbnail_size) && count($video_thumbnail_size)) : ?>
            <?php echo conall_edge_generate_thumbnail($video_thumbnail, null, $video_thumbnail_size[0], $video_thumbnail_size[1]); ?>
        <?php else: ?>
            <?php echo wp_get_attachment_image($video_thumbnail, $video_thumbnail_size); ?>
        <?php endif; ?>
    </div>
    <div class="edgtf-video-content-holder">
        <div class="edgtf-video-content-inner">
            <span class="edgtf-video-play" <?php echo conall_edge_inline_style($button_style);?>>
                <span class="edgtf-video-wrapper">
                    <span class="arrow_triangle-right"></span>
                </span>
            </span>
            <?php if ($title !== ''){?>
                <<?php echo esc_attr($title_tag);?> class="edgtf-video-title">
                    <?php echo esc_html($title); ?>
                </<?php echo esc_attr($title_tag);?>>
            <?php } ?>
        </div>
    </div>
    <a class="edgtf-video-link" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto"></a>
</div>