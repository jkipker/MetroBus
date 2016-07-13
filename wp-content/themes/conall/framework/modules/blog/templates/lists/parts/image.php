<?php 
$post_format_icon = '';
$post_link = get_the_permalink();
switch ($post_format) {
	case 'video':
		$post_format_icon = 'arrow_triangle-right_alt2';

		break;
	case 'audio':
		$post_format_icon = 'icon_headphones';

		break;
	case 'quote':
		$post_format_icon = 'icon_quotations_alt2';

		break;
	case 'link':
		$post_format_icon = 'icon_link_alt';

		if($image_post_link_link !== '') {
			$post_link = $image_post_link_link;
		} else {
			$post_link = get_the_permalink();
		}

		break;		
	default:
		$post_format_icon = '';
		break;
}
?>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="edgtf-post-image">
		<a itemprop="url" href="<?php echo esc_html($post_link); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('conall_edge_feature_image'); ?>
			<?php if($post_format_icon !== '') { ?>
				<div class="edgtf-post-format-icon"><span class="<?php echo esc_attr($post_format_icon); ?>"></span></div>
			<?php } ?>
		</a>
		<?php if ($post_format === 'audio') {
			conall_edge_get_module_template_part('templates/parts/audio', 'blog');
		} ?>
	</div>
<?php } else {
	if ($post_format === 'audio') {
		conall_edge_get_module_template_part('templates/parts/audio', 'blog');
	}
} ?>