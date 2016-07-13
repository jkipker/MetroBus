<?php
    /*
        Template Name: Blog: Standard
    */
?>
<?php get_header(); ?>
<?php conall_edge_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="edgtf-container">
	    <?php do_action('conall_edge_after_container_open'); ?>
	    <div class="edgtf-container-inner" >
	        <?php conall_edge_get_blog('standard'); ?>
	    </div>
	    <?php do_action('conall_edge_before_container_close'); ?>
	</div>
	<?php do_action('conall_edge_blog_list_additional_tags'); ?>
<?php get_footer(); ?>