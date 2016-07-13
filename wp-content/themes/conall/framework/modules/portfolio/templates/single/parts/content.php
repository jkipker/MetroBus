<div class="edgtf-content-item edgtf-portfolio-info-item">
    <h4 itemprop="name" class="edgtf-portfolio-item-title"><?php the_title(); ?></h4>
    <div class="edgtf-portfolio-content">
        <?php the_content(); ?>
    </div>
    <div class="edgtf-portfolio-item-author">
        <span class="edgtf-portfolio-author-label"><?php esc_html_e('Illustration by:','conall'); ?></span>
        <span class="edgtf-portfolio-author-name"><?php the_author_link(); ?></span>
    </div>
</div>