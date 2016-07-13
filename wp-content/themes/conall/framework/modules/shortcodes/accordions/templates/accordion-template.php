<<?php echo esc_attr($title_tag)?> class="clearfix edgtf-title-holder">
    <?php if($number !== ''){ ?>
        <span class="edgtf-accordion-number"><?php echo esc_attr($number) ?></span>
    <?php } ?>
    <span class="edgtf-accordion-mark">
		<span class="edgtf-accordion-mark-icon">
			<span class="edgtf_icon_plus icon_plus"></span>
			<span class="edgtf_icon_minus icon_minus-06"></span>
		</span>
	</span>
	<span class="edgtf-tab-title">
		<span class="edgtf-tab-title-inner">
			<?php echo esc_attr($title)?>
		</span>
	</span>
</<?php echo esc_attr($title_tag)?>>
<div class="edgtf-accordion-content">
	<div class="edgtf-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>