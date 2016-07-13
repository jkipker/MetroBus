<?php if(conall_edge_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
    <div class="edgtf-single-tags-holder">
        <h5 class="edgtf-single-tags-title"><?php esc_html_e('Post Tags:', 'conall'); ?></h5>
        <div class="edgtf-tags">
            <?php the_tags('', '', ''); ?>
        </div>
    </div>
<?php } ?>