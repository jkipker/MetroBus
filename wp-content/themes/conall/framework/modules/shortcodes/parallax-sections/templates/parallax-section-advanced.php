<div class="edgtf-parallax-section-advanced <?php echo esc_attr($parallax_section_class) ?>" <?php echo conall_edge_get_inline_attr($parallax_section_style, 'style') ?>  <?php echo conall_edge_get_inline_attrs($resp_height_data); ?>>
	<div class="edgtf-parallax-inner" <?php echo conall_edge_get_inline_attr($parallax_inner_style, 'style') ?> >
		<div class="edgtf-parallax-hero-image-holder" data-center="transform[customEase]:translateY(<?php echo esc_attr($offsets['hero_image_y_start_offset']) ?>)" data-top-center="transform[customEase]:translateY(<?php echo esc_attr($offsets['hero_image_y_end_offset']) ?>)">
			<?php if ($hero_image_link !== '') { ?>
				<a class="edgtf-parallax-link" href="<?php echo esc_url($hero_image_link) ?>" target="<?php echo esc_attr($hero_image_link_target); ?>"></a>
			<?php } ?>
			<?php if ($hero_image_src !== '') { ?>
				<img class="edgtf-hero-image" src="<?php echo esc_url($hero_image_src) ?>" alt="<?php esc_html_e('parallax hero image','conall')  ?>"/>
			<?php } ?>
		</div>
		<div class="edgtf-parallax-info-section" data-center="transform[customEase]:translateY(<?php echo esc_attr($offsets['info_section_y_start_offset']) ?>)" data-top-center="transform[customEase]:translateY(<?php echo esc_attr($offsets['info_section_y_end_offset']) ?>)">
			<?php if ($heading_image !== '') { ?> 
				<img class="edgtf-parallax-heading-image" src="<?php echo esc_url($heading_image_src) ?>" alt="<?php esc_html_e('parallax heading image','conall')?>" />
			<?php } ?>
			<?php if ($excerpt !=='') { ?> 
				<p class="edgtf-parallax-excerpt"><?php echo esc_html($excerpt)?></p>
			<?php } ?>
			<?php if ($show_buttons == 'yes') { 
					if (($first_button_label !=='') && ($first_button_url !== '')) {
						echo conall_edge_execute_shortcode('edgtf_button', $first_button_params);
					}
					if (($second_button_label !=='') && ($second_button_url !== '')) {
						echo conall_edge_execute_shortcode('edgtf_button', $second_button_params);
					}
			} ?>
		</div>
		<div class="edgtf-additional-image-holder edgtf-add-1">
			<?php if ($add_image1_src !== '') { ?>
				<img class="edgtf-add-image" src="<?php echo esc_url($add_image1_src) ?>" alt="<?php esc_html_e('parallax additional image','conall')  ?>"/>
			<?php } ?>
		</div>
		<div class="edgtf-additional-image-holder edgtf-add-2">
			<?php if ($add_image2_src !== '') { ?>
				<img class="edgtf-add-image" src="<?php echo esc_url($add_image2_src) ?>" alt="<?php esc_html_e('parallax additional image','conall')  ?>"/>
			<?php } ?>
		</div>
		<div class="edgtf-additional-image-holder edgtf-add-3">
			<?php if ($add_image3_src !== '') { ?>
				<img class="edgtf-add-image" src="<?php echo esc_url($add_image3_src) ?>" alt="<?php esc_html_e('parallax additional image','conall')  ?>"/>
			<?php } ?>
		</div>
		<div class="edgtf-additional-image-holder edgtf-add-4">
			<?php if ($add_image4_src !== '') { ?>
				<img class="edgtf-add-image" src="<?php echo esc_url($add_image4_src) ?>" alt="<?php esc_html_e('parallax additional image','conall')  ?>"/>
			<?php } ?>
		</div>
		<div class="edgtf-additional-image-holder edgtf-add-5">
			<?php if ($add_image5_src !== '') { ?>
				<img class="edgtf-add-image" src="<?php echo esc_url($add_image5_src) ?>" alt="<?php esc_html_e('parallax additional image','conall')  ?>"/>
			<?php } ?>
		</div>
	</div>
</div>