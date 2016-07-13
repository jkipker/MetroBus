<?php
/**
 * Pie Chart Basic Shortcode Template
 */
?>
<?php
$icon_html = conall_edge_icon_collections()->renderIcon($icon, $icon_pack, $params);
?>
<div <?php conall_edge_class_attribute($holder_classes); ?>>
	<div class="edgtf-percentage" <?php echo conall_edge_get_inline_attrs($pie_chart_data); ?>>
		<span class="edgtf-to-counter">
			<?php if ($type_of_central_text === 'icon') { ?>
				<span class="edgtf-to-counter-icon" <?php conall_edge_inline_style($icon_style); ?>>
					<?php print $icon_html;	?>
				</span>	
			<?php } else { ?>
				<span class="edgtf-to-counter-inner" <?php conall_edge_inline_style($percentage_style); ?>>
					<?php echo esc_html($percent); ?>
				</span>	
			<?php } ?>
		</span>
	</div>
	<div class="edgtf-pie-chart-text" <?php conall_edge_inline_style($pie_chart_style); ?>>
		<<?php echo esc_attr($title_tag); ?> class="edgtf-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_attr($title_tag); ?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>