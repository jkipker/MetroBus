<button type="submit" <?php conall_edge_inline_style($button_styles); ?> <?php conall_edge_class_attribute($button_classes); ?> <?php echo conall_edge_get_inline_attrs($button_data); ?> <?php echo conall_edge_get_inline_attrs($button_custom_attrs); ?>>
    <?php if ($type == 'simple') { ?>
    	<span class="edgtf-btn-text edgtf-shuffle" data-lang="en"><?php echo esc_html($text); ?></span>
    <?php } else { ?>
    	<span class="edgtf-btn-text"><?php echo esc_html($text); ?></span>
    <?php } ?>
    <?php echo conall_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>