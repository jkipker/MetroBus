<div id="edgtf-testimonials<?php echo esc_attr($current_id) ?>" class="edgtf-testimonial-content">
    <div class="edgtf-testimonial-content-inner">
        <div class="edgtf-testimonial-text-holder">
            <div class="edgtf-testimonial-icon-holder">
                <i class="pe-7s-comment"></i>
            </div>
            <div class="edgtf-testimonial-text-inner">
                <p class="edgtf-testimonial-text"><?php echo trim($text) ?></p>
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
