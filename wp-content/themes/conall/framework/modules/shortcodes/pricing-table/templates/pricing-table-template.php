<div <?php conall_edge_class_attribute($pricing_table_classes)?>>
	<div class="edgtf-price-table-inner">
		<ul <?php echo conall_edge_get_inline_style($pricing_table_styles); ?>>
			<?php if($type === 'title_above_price') { ?>
				<li class="edgtf-table-title" <?php echo conall_edge_get_inline_style($pricing_title_styles); ?>>
					<span class="edgtf-title-content"><?php echo esc_html($title); ?></span>
				</li>
			<?php } ?>
			<li class="edgtf-table-prices">
				<?php if($type === 'title_above_price') { ?>
					<div class="edgtf-price-in-table">
						<sup class="edgtf-value"><?php echo esc_attr($currency); ?></sup>
						<span class="edgtf-price"><?php echo esc_attr($price); ?></span>
						<span class="edgtf-mark"><?php echo esc_attr($price_period); ?></span>
					</div>	
				<?php } else { ?>
					<div class="edgtf-price-in-table">
						<span class="edgtf-price-value">
							<span class="edgtf-price"><?php echo esc_attr($price); ?></span>
							<sup class="edgtf-value"><?php echo esc_attr($currency); ?></sup>
						</span>	
						<span class="edgtf-title-mark">
							<span class="edgtf-title-content"><?php echo esc_html($title); ?></span>
							<span class="edgtf-mark"><?php echo esc_attr($price_period); ?></span>
						</span>
					</div>
				<?php } ?>
			</li>
			<li class="edgtf-table-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if($show_button == "yes" && $button_text !== ''){ ?>
				<?php
					$button_type = 'solid';
					if($type !== 'title_above_price') {
						$button_type = 'outline';
					}
				?>
				<li class="edgtf-price-button">
					<?php echo conall_edge_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'large',
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>