<div class="edgtf-st">
	<div class="edgtf-st-inner">
        <div class="edgtf-st-title-holder">
            <<?php echo esc_attr($title_tag); ?> class="edgtf-st-title" <?php echo conall_edge_get_inline_style($title_styles); ?>>
                <span><?php echo esc_attr($title); ?></span>
            </<?php echo esc_attr($title_tag);?>>
        </div>
        <?php if($enable_separator !== 'no'){ echo conall_edge_execute_shortcode('edgtf_separator', $separator_params); } ?>
		<div class="edgtf-st-text-holder" <?php echo conall_edge_get_inline_style($text_styles); ?>>
            <span class="edgtf-st-text-text"><?php echo do_shortcode($content); ?></span>
		</div>
	</div>
</div>