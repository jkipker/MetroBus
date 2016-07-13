<?php if(conall_edge_options()->getOptionValue('enable_social_share') == 'yes' && conall_edge_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="edgtf-portfolio-social edgtf-portfolio-info-item">
        <?php echo conall_edge_get_social_share_html() ?>
    </div>
<?php endif; ?>