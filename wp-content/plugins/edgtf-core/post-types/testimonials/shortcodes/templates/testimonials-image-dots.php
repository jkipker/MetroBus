<div class="edgtf-tes-image-nav">
    <?php if ($query_results->have_posts()):
        while ($query_results->have_posts()) : $query_results->the_post(); ?>
        <div class="edgtf-tes-image-single">
                <span class="edgtf-tes-image-holder">
                <?php echo get_the_post_thumbnail(get_the_ID()) ?>
                </span>
            </div>
        <?php endwhile;
        else: ?>
            <span>Sorry, no posts matched your criteria</span>
    <?php endif;
    wp_reset_postdata(); ?>
</div>