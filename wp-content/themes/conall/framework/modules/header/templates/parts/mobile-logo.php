<?php do_action('conall_edge_before_mobile_logo'); ?>

<div class="edgtf-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php conall_edge_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('mobile logo','conall'); ?>"/>
    </a>
</div>

<?php do_action('conall_edge_after_mobile_logo'); ?>