<div <?php conall_edge_class_attribute($holder_classes); ?>>
    <div class="edgtf-iwt-icon-holder">
        <?php if(!empty($custom_icon)) : ?>
            <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
        <?php else: ?>
            <?php echo conall_edge_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
        <?php endif; ?>
    </div>
    <div class="edgtf-iwt-content-holder" <?php conall_edge_inline_style($content_styles); ?>>
        <div class="edgtf-iwt-title-holder">
            <<?php echo esc_attr($title_tag); ?> <?php conall_edge_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        </div>
        <div class="edgtf-iwt-text-holder">
            <p <?php conall_edge_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>

            <?php if(!empty($link) && !empty($link_text)) : ?>
                <?php echo conall_edge_execute_shortcode('edgtf_button', $button_params); ?>
            <?php endif; ?>
        </div>
    </div>
</div>