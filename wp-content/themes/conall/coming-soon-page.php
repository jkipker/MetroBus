<?php
/*
Template Name: Coming Soon Page
*/
$sidebar = conall_edge_sidebar_layout();
$page_id = conall_edge_get_page_id();

$coming_soon_content_class = '';
if(get_post_meta($page_id, "edgtf_enable_full_screen_content", true) === 'yes') {
	$coming_soon_content_class .= 'edgtf-coming-soon-page';
}

if(get_post_meta($page_id, "edgtf_full_screen_content_vertical_alignment", true) === 'middle') {
	$coming_soon_content_class .= ' edgtf-content-vertical-alignment';
}

$coming_soon_content_style = '';
if(get_post_meta($page_id, "edgtf_full_screen_content_background_image", true) !== '') {
	$coming_soon_content_style .= 'background-image: url('.get_post_meta($page_id, "edgtf_full_screen_content_background_image", true).');';
	$coming_soon_content_style .= 'background-repeat: no-repeat;';
	$coming_soon_content_style .= 'background-position: center 0;';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php if (!conall_edge_is_ajax_request()) conall_edge_wp_title(); ?>
        <?php
        /**
         * conall_edge_header_meta hook
         *
         * @see conall_edge_header_meta() - hooked with 10
         * @see edgt_user_scalable_meta() - hooked with 10
         */
        if (!conall_edge_is_ajax_request()) do_action('conall_edge_header_meta');
        ?>
        <?php if (!conall_edge_is_ajax_request()) wp_head(); ?>
    </head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<?php 
			if ((!conall_edge_is_ajax_request()) && conall_edge_options()->getOptionValue('smooth_page_transitions') == "yes") {
				$ajax_class = 'edgtf-mimic-ajax';
			?>
			<div class="edgtf-smooth-transition-loader <?php echo esc_attr($ajax_class); ?>">
			    <div class="edgtf-st-loader">
			        <div class="edgtf-st-loader1">
			            <?php conall_edge_loading_spinners(); ?>
			        </div>
			    </div>
			</div>
		<?php } ?>

		<div class="edgtf-wrapper <?php echo esc_attr($coming_soon_content_class); ?>">
			<div class="edgtf-wrapper-inner">
				<div class="edgtf-content" <?php conall_edge_inline_style($coming_soon_content_style); ?>>
		            <?php if(conall_edge_is_ajax_enabled()) { ?>
		            <div class="edgtf-meta">
		                <?php do_action('conall_edge_ajax_meta'); ?>
		                <span id="edgtf-page-id"><?php echo esc_html(get_queried_object_id()); ?></span>
		                <div class="edgtf-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
		            </div>
		            <?php } ?>
					<div class="edgtf-content-inner">
						<div class="edgtf-full-width">
							<div class="edgtf-full-width-inner">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
									<?php do_action('conall_edge_page_after_content'); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>