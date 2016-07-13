<?php
	/*
		Template Name: Blog: Masonry Full Width
	*/
?>
<?php get_header(); ?>
<?php conall_edge_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="edgtf-full-width">
		<div class="edgtf-full-width-inner clearfix">
			<?php conall_edge_get_blog('masonry-full-width'); ?>
		</div>
	</div>
	<?php do_action('conall_edge_blog_list_additional_tags'); ?>
<?php get_footer(); ?>