<?php
/**
 * Call to action shortcode template
 */
?>
<?php if ($full_width == "no") { ?>
	<div class="edgtf-container-inner">
<?php } ?>
	<div class="edgtf-call-to-action <?php echo esc_attr($type) ?>">

		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		<div class="edgtf-container-inner">
		<?php }

		if ($grid_size == "75") { ?>
			<div class="edgtf-call-to-action-row-75-25 clearfix" <?php echo conall_edge_get_inline_style($call_to_action_styles) ?>>
		<?php } elseif ($grid_size == "66") { ?>
			<div class="edgtf-call-to-action-row-66-33 clearfix" <?php echo conall_edge_get_inline_style($call_to_action_styles) ?>>
		<?php } else { ?>
			<div class="edgtf-call-to-action-row-50-50 clearfix" <?php echo conall_edge_get_inline_style($call_to_action_styles) ?>>
		<?php } ?>
				<div class="edgtf-text-wrapper <?php echo esc_attr($text_wrapper_classes) ?>">
					<div class="edgtf-call-to-action-text" <?php echo conall_edge_get_inline_style($content_styles) ?>><?php echo do_shortcode($content); ?></div>
				</div>

				<?php if ($show_button == 'yes') { ?>
					<div class="edgtf-call-to-action-column2 edgtf-call-to-action-cell" <?php echo conall_edge_get_inline_style($info_styles) ?>>
					    <?php if ($type == "normal" && $show_button == 'yes') { ?>
						    <?php echo conall_edge_get_button_html($button_parameters); ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php if ($content_in_grid == 'yes' && $full_width == 'yes') { ?>
		</div>
		<?php } ?>
	</div>
<?php if ($full_width == 'no') { ?>
	</div>
<?php } ?>