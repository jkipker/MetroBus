<div <?php conall_edge_class_attribute($holder_classes); ?>>
    <div class="edgtf-nwt-number-holder">
        <span class="edgtf-nwt-number" <?php conall_edge_inline_style($number_styles); ?> ><?php echo esc_attr($number_text); ?></span>
    </div>
    <div class="edgtf-nwt-content-holder">
        <div class="edgtf-nwt-title-holder">
            <<?php echo esc_attr($title_tag); ?> <?php conall_edge_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        </div>
        <div class="edgtf-nwt-text-holder">
            <p <?php conall_edge_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        </div>
    </div>
</div>