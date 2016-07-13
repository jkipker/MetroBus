<div class="edgtf-gb-holder edgtf-gb-two-holder <?php echo esc_attr($space_between_blocks); ?> <?php echo esc_attr($extra_class); ?>">
	<div class="edgtf-gb-inner">
		<div class="edgtf-gb-item edgtf-text-block">
			<div class="edgtf-gb-item-inner" <?php echo conall_edge_get_inline_style($holder_styles); ?>>
				<?php if($title !== '') { ?>
					<<?php echo esc_attr($title_tag); ?> class="edgtf-gb-title" <?php echo conall_edge_get_inline_style($title_styles); ?>><?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
				<?php } ?>
				<?php if ($text !== '') { ?>
		            <p class="edgtf-gb-text" <?php echo conall_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		        <?php } ?>
				<?php if($button_link !== '' && $button_link_text !== '') { ?>
					<a href="<?php echo esc_url($button_link); ?>" target="<?php echo esc_url($button_link_target); ?>" <?php conall_edge_inline_style($button_styles); ?> <?php conall_edge_class_attribute($button_classes); ?> <?php echo conall_edge_get_inline_attrs($button_data); ?>>
					    <span class="edgtf-btn-text <?php echo esc_attr($button_text_class); ?>"><?php echo esc_html($button_link_text); ?></span>
					    <?php if($button_type === 'simple') { ?>
					    	<i class="edgtf-icon-linea-icon icon-arrows-slim-right"></i>
				    	<?php } ?>
					</a>
				<?php } ?>
			</div>	
			<?php $rand = rand(2000,3000); ?>
			<div class="edgtf-gb-image">
				<?php foreach ($images as $image) { ?>
					<div class="edgtf-gb-image-inner">
						<?php if ($enable_lightbox === 'yes') { ?>
							<a href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[gallery_block_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
						<?php } ?>
						<?php 
							if(is_array($image_size) && count($image_size)) {
								echo conall_edge_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
							} else {
								echo wp_get_attachment_image($image['image_id'], $image_size);
							}
						?>
						<?php if ($enable_lightbox === 'yes') { ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="edgtf-gb-item">
			<div class="edgtf-gb-item-inner">
				<?php $rand = rand(3000,4000); ?>
				<div class="edgtf-gb-image">
					<?php foreach ($featured_images as $featured_image) { ?>
						<div class="edgtf-gb-image-inner edgtf-gb-featured-image">
							<?php if ($enable_lightbox === 'yes') { ?>
								<a href="<?php echo esc_url($featured_image['url'])?>" data-rel="prettyPhoto[gallery_block_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($featured_image['title']); ?>">
							<?php } ?>
							<?php 
								if(is_array($featured_image_size) && count($featured_image_size)) {
									echo conall_edge_generate_thumbnail($featured_image['image_id'], null, $featured_image_size[0], $featured_image_size[1]);
								} else {
									echo wp_get_attachment_image($featured_image['image_id'], $featured_image_size);
								}
							?>
							<?php if ($enable_lightbox === 'yes') { ?>
								</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>