<div id="edgtf-testimonials<?php echo esc_attr($current_id) ?>" class="edgtf-testimonial-content">
    <div class="edgtf-testimonial-content-inner">
        <div class="edgtf-testimonial-text-holder">
            <div class="edgtf-testimonial-text-inner">
                <?php if($show_title == "yes"){ ?>
                    <h3 class="edgtf-testimonial-title">
                        <?php echo esc_attr($title) ?>
                    </h3>
                <?php }?>
                <p class="edgtf-testimonial-text"><?php echo trim($text) ?></p>
                <div class="edgtf-testimonial-bottom">
                <?php if ($show_author == "yes") { ?>
                    <div class = "edgtf-testimonial-author">
                        <p class="edgtf-testimonial-author-text"><?php echo esc_attr($author)?>
                            <?php if($show_position == "yes" && $job !== ''){ ?>
                                <span> / </span><span class="edgtf-testimonials-job"><?php echo esc_attr($job)?></span>
                            <?php }?>
                        </p>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="edgtf-testimonial-image-holder">
        <?php esc_html(the_post_thumbnail($current_id)) ?>
    </div>
</div>
