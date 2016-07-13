<div class="edgtf-parallax-section <?php echo esc_attr($parallax_section_class) ?>" <?php echo conall_edge_get_inline_attr($parallax_section_style, 'style') ?>>
	<div data-bottom-top="top[quadratic]:10%" data-top-bottom="top[quadratic]:-10%" class="edgtf-parallax-text-holder">
		<?php if($heading !== '') { ?> 
			<h3 class="edgtf-parallax-title"><?php echo esc_html($heading)?></h3>
		<?php } ?>	
		<?php if($excerpt !=='') { ?> 
			<p class="edgtf-parallax-excerpt"><?php echo esc_html($excerpt)?></p>
		<?php } ?>	
	</div>
	<div class="edgtf-main-image-holder" data-bottom-top="top[swing]:20%" data-center="top[swing]:-30%" data-top-bottom="top[swing]:-40%">
		<?php if ($main_image_link !== '') { ?>
			<a class="edgtf-parallax-link" href="<?php echo esc_url($main_image_link) ?>" target="<?php echo esc_attr($main_image_link_target); ?>"></a>
		<?php } ?>
		<img class="edgtf-main-image" src="<?php echo esc_url($main_image_src) ?>" alt="<?php esc_html_e('parallax main image','conall')  ?>"/>
	</div>
	<div class="edgtf-side-image-holder" data-bottom-top="top[cubic]:50%" data-center="top[cubic]:35%">
		<?php if ($side_image_link !== '') { ?>
			<a class="edgtf-parallax-link" href="<?php echo esc_url($side_image_link) ?>" target="<?php echo esc_attr($side_image_link_target); ?>"></a>
		<?php } ?>
		<img class="edgtf-side-image" src="<?php echo esc_url($side_image_src) ?>" alt="<?php esc_html_e('parallax side image','conall')  ?>"/>
	</div>
</div>
