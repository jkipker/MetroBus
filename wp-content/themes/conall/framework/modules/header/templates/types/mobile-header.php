<?php do_action('conall_edge_before_mobile_header'); ?>

<header class="edgtf-mobile-header">
    <div class="edgtf-mobile-header-inner">
        <?php do_action( 'conall_edge_after_mobile_header_html_open' ) ?>
        <div class="edgtf-mobile-header-holder">
            <div class="edgtf-grid">
                <div class="edgtf-vertical-align-containers">
                    <?php if($show_navigation_opener) : ?>
                        <div class="edgtf-mobile-menu-opener">
                            <a href="javascript:void(0)">
                    <span class="edgtf-mobile-opener-icon-holder">
                        <?php print $menu_opener_icon; ?>
                    </span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($show_logo) : ?>
                        <div class="edgtf-position-center">
                            <div class="edgtf-position-center-inner">
                                <?php conall_edge_get_mobile_logo(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="edgtf-position-right">
                        <div class="edgtf-position-right-inner">
                            <?php if(is_active_sidebar('edgtf-right-from-mobile-logo')) {
                                dynamic_sidebar('edgtf-right-from-mobile-logo');
                            } ?>
                        </div>
                    </div>
                </div> <!-- close .edgtf-vertical-align-containers -->
            </div>
        </div>
        <?php conall_edge_get_mobile_nav(); ?>
    </div>
</header> <!-- close .edgtf-mobile-header -->

<?php do_action('conall_edge_after_mobile_header'); ?>