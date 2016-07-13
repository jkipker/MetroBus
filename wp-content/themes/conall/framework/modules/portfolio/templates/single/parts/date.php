<?php if(conall_edge_options()->getOptionValue('portfolio_single_hide_date') !== 'yes') : ?>
    <div class="edgtf-portfolio-info-item edgtf-portfolio-date">
        <p class="edgtf-portfolio-info-title"><?php esc_html_e('Date:', 'conall'); ?></p>
        <p itemprop="dateCreated" class="entry-date updated"><?php the_time(get_option('date_format')); ?></p>
    </div>
<?php endif; ?>