<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php if (!conall_edge_is_ajax_request()) conall_edge_wp_title(); ?>
    <?php
    /**
     * @see conall_edge_header_meta() - hooked with 10
     * @see edgt_user_scalable - hooked with 10
     */
    ?>
	<?php if (!conall_edge_is_ajax_request()) do_action('conall_edge_header_meta'); ?>

	<?php if (!conall_edge_is_ajax_request()) wp_head(); ?>

    <!--INCLUDE CUSTOM CSS-->
    <link rel='stylesheet' id='pavlov-custom-css'  href='/wp-content/themes/conall/custom-styles.css' type='text/css' media='all' />
</head>
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
<?php if (!conall_edge_is_ajax_request()) conall_edge_get_side_area(); ?>

<?php 
if((!conall_edge_is_ajax_request()) && conall_edge_options()->getOptionValue('smooth_page_transitions') == "yes") {
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

<div class="edgtf-wrapper">
    <div class="edgtf-wrapper-inner">
        <?php if (!conall_edge_is_ajax_request()) conall_edge_get_header(); ?>

        <?php if ((!conall_edge_is_ajax_request()) && conall_edge_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='edgtf-back-to-top'  href='#'>
                <span class="edgtf-icon-stack">
                     <?php conall_edge_icon_collections()->getBackToTopIcon('font_awesome');?>
                </span>
            </a>
        <?php } ?>
        <?php if (!conall_edge_is_ajax_request()) conall_edge_get_full_screen_menu(); ?>

        <div class="edgtf-content" <?php conall_edge_content_elem_style_attr(); ?>>
            <?php if(conall_edge_is_ajax_enabled()) { ?>
            <div class="edgtf-meta">
                <?php do_action('conall_edge_ajax_meta'); ?>
                <span id="edgtf-page-id"><?php echo esc_html(get_queried_object_id()); ?></span>
                <div class="edgtf-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
            </div>
            <?php } ?>
            <div class="edgtf-content-inner">