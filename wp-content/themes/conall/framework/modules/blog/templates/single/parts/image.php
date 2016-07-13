<?php
$display_custom_feature_image_width = '';
if(conall_edge_options()->getOptionValue('blog_single_feature_image_max_width') !== ''){
	$display_custom_feature_image_width = intval(conall_edge_options()->getOptionValue('blog_single_feature_image_max_width'));
}
?>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="edgtf-post-image">
		<?php if($display_custom_feature_image_width !== '' && !empty($display_custom_feature_image_width)) {
			the_post_thumbnail(array($display_custom_feature_image_width, 0));
		} else {
			the_post_thumbnail('conall_edge_feature_image');
		} ?>
		<?php if ($image_post_format === 'audio') {
			conall_edge_get_module_template_part('templates/parts/audio', 'blog');
		} ?>
	</div>
<?php  } else {
	if ($image_post_format === 'audio') {
		conall_edge_get_module_template_part('templates/parts/audio', 'blog');
	}
} ?>