<?php

if(!function_exists('conall_edge_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function conall_edge_header_top_bar_styles() {
        global $conall_edge_options;

        if($conall_edge_options['top_bar_height'] !== '') {
            echo conall_edge_dynamic_css('.edgtf-top-bar', array('height' => $conall_edge_options['top_bar_height'].'px'));
            echo conall_edge_dynamic_css('.edgtf-top-bar .edgtf-logo-wrapper a', array('max-height' => $conall_edge_options['top_bar_height'].'px'));
        }

        $background_color = conall_edge_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $background_transparency = 1;
            if(conall_edge_options()->getOptionValue('top_bar_background_transparency') !== '') {
               $background_transparency = conall_edge_options()->getOptionValue('top_bar_background_transparency');
            }

            $background_color = conall_edge_rgba_color($background_color, $background_transparency);
            $top_bar_styles['background-color'] = $background_color;
        }

        echo conall_edge_dynamic_css('.edgtf-top-bar', $top_bar_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_header_top_bar_styles');
}

if(!function_exists('conall_edge_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function conall_edge_header_standard_menu_area_styles() {
        global $conall_edge_options;

        $holder_area_header_standard_styles = array();

        if($conall_edge_options['menu_area_background_color_header_standard'] !== '') {
            $menu_area_background_color        = $conall_edge_options['menu_area_background_color_header_standard'];
            $menu_area_background_transparency = 1;

            if($conall_edge_options['menu_area_background_transparency_header_standard'] !== '') {
                $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_standard'];
            }

            $holder_area_header_standard_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_background_color_header_standard'] === '' && $conall_edge_options['menu_area_background_transparency_header_standard'] !== '') {
            $menu_area_background_color        = '#fff';
            $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_standard'];

            $holder_area_header_standard_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_border_color_header_standard'] !== '') {
            $holder_area_header_standard_styles['border-bottom-color'] = conall_edge_options()->getOptionValue('menu_area_border_color_header_standard');
        }

        $holder_area_header_standard_selector = array(
            '.edgtf-header-standard .edgtf-page-header'
        );

        echo conall_edge_dynamic_css($holder_area_header_standard_selector, $holder_area_header_standard_styles);

        $menu_area_header_standard_styles = array();

        if($conall_edge_options['menu_area_height_header_standard'] !== '') {
            $max_height = intval(conall_edge_filter_px($conall_edge_options['menu_area_height_header_standard'])).'px';
            echo conall_edge_dynamic_css('.edgtf-header-standard .edgtf-page-header .edgtf-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_standard_styles['height'] = conall_edge_filter_px($conall_edge_options['menu_area_height_header_standard']).'px';

        }

        echo conall_edge_dynamic_css('.edgtf-header-standard .edgtf-page-header .edgtf-menu-area', $menu_area_header_standard_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_header_standard_menu_area_styles');
}

if(!function_exists('conall_edge_header_simple_menu_area_styles')) {
    /**
     * Generates styles for header simple menu
     */
    function conall_edge_header_simple_menu_area_styles() {
        global $conall_edge_options;

        $holder_area_header_simple_styles = array();

        if($conall_edge_options['menu_area_background_color_header_simple'] !== '') {
            $menu_area_background_color        = $conall_edge_options['menu_area_background_color_header_simple'];
            $menu_area_background_transparency = 1;

            if($conall_edge_options['menu_area_background_transparency_header_simple'] !== '') {
                $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_simple'];
            }

            $holder_area_header_simple_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_background_color_header_simple'] === '' && $conall_edge_options['menu_area_background_transparency_header_simple'] !== '') {
            $menu_area_background_color        = '#fff';
            $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_simple'];

            $holder_area_header_simple_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_border_bottom_color_header_simple'] !== '') {
            $holder_area_header_simple_styles['border-bottom-color'] = $conall_edge_options['menu_area_border_bottom_color_header_simple'];
        }

        $holder_area_header_simple_selector = array(
            '.edgtf-header-simple .edgtf-page-header'
        );

        echo conall_edge_dynamic_css($holder_area_header_simple_selector, $holder_area_header_simple_styles);

        $menu_area_header_simple_styles = array();

        if($conall_edge_options['menu_area_height_header_simple'] !== '') {
            $max_height = intval(conall_edge_filter_px($conall_edge_options['menu_area_height_header_simple'])).'px';
            echo conall_edge_dynamic_css('.edgtf-header-simple .edgtf-page-header .edgtf-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_simple_styles['height'] = conall_edge_filter_px($conall_edge_options['menu_area_height_header_simple']).'px';

        }

        echo conall_edge_dynamic_css('.edgtf-header-simple .edgtf-page-header .edgtf-menu-area', $menu_area_header_simple_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_header_simple_menu_area_styles');
}

if(!function_exists('conall_edge_header_classic_menu_area_styles')) {
    /**
     * Generates styles for header classic menu
     */
    function conall_edge_header_classic_menu_area_styles() {
        global $conall_edge_options;

        $holder_area_header_classic_styles = array();

        if($conall_edge_options['menu_area_background_color_header_classic'] !== '') {
            $menu_area_background_color        = $conall_edge_options['menu_area_background_color_header_classic'];
            $menu_area_background_transparency = 1;

            if($conall_edge_options['menu_area_background_transparency_header_classic'] !== '') {
                $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_classic'];
            }

            $holder_area_header_classic_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_background_color_header_classic'] === '' && $conall_edge_options['menu_area_background_transparency_header_classic'] !== '') {
            $menu_area_background_color        = '#fff';
            $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_classic'];

            $holder_area_header_classic_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_border_color_header_classic'] !== '') {
            $holder_area_header_classic_styles['border-bottom-color'] = conall_edge_options()->getOptionValue('menu_area_border_color_header_classic');
        }

        $holder_area_header_classic_selector = array(
            '.edgtf-header-classic .edgtf-page-header'
        );

        echo conall_edge_dynamic_css($holder_area_header_classic_selector, $holder_area_header_classic_styles);

        $logo_area_header_classic_styles = array();

        if($conall_edge_options['logo_area_height_header_classic'] !== '') {
            $max_height = intval(conall_edge_filter_px($conall_edge_options['logo_area_height_header_classic'])).'px';
            echo conall_edge_dynamic_css('.edgtf-header-classic .edgtf-page-header .edgtf-logo-wrapper a', array('max-height' => $max_height));

            $logo_area_header_classic_styles['height'] = conall_edge_filter_px($conall_edge_options['logo_area_height_header_classic']).'px';
        }

        echo conall_edge_dynamic_css('.edgtf-header-classic .edgtf-page-header .edgtf-logo-area', $logo_area_header_classic_styles);

        $menu_area_header_classic_styles = array();

        if($conall_edge_options['menu_area_height_header_classic'] !== '') {
            $menu_area_header_classic_styles['height'] = conall_edge_filter_px($conall_edge_options['menu_area_height_header_classic']).'px';
        }

        echo conall_edge_dynamic_css('.edgtf-header-classic .edgtf-page-header .edgtf-menu-area', $menu_area_header_classic_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_header_classic_menu_area_styles');
}

if(!function_exists('conall_edge_header_classic_logo_area_styles')) {
    /**
     * Generates styles for classic header type logo element
     */
    function conall_edge_header_classic_logo_area_styles() {
        global $conall_edge_options;

        $logo_styles = array();

        if($conall_edge_options['logo_area_top_padding_header_classic'] !== '') {
            $logo_styles['padding-top'] = conall_edge_filter_px($conall_edge_options['logo_area_top_padding_header_classic']).'px';
        }

        $logo_styles_selector = array();

        if(is_active_sidebar('edgtf-header-classic-widget-area')) {
            $logo_styles_selector = array(
                '.edgtf-header-classic .edgtf-logo-area .edgtf-logo-wrapper'
            );
        } else {
            $logo_styles_selector = array(
                '.edgtf-header-classic .edgtf-logo-area .edgtf-logo-wrapper',
                '.edgtf-header-classic .edgtf-logo-area .edgtf-position-right .widget'
            );
        }

        echo conall_edge_dynamic_css($logo_styles_selector, $logo_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_header_classic_logo_area_styles');
}

if(!function_exists('conall_edge_header_divided_menu_area_styles')) {
    /**
     * Generates styles for header divided menu
     */
    function conall_edge_header_divided_menu_area_styles() {
        global $conall_edge_options;

        $holder_area_header_divided_styles = array();

        if($conall_edge_options['menu_area_background_color_header_divided'] !== '') {
            $menu_area_background_color        = $conall_edge_options['menu_area_background_color_header_divided'];
            $menu_area_background_transparency = 1;

            if($conall_edge_options['menu_area_background_transparency_header_divided'] !== '') {
                $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_divided'];
            }

            $holder_area_header_divided_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_background_color_header_divided'] === '' && $conall_edge_options['menu_area_background_transparency_header_divided'] !== '') {
            $menu_area_background_color        = '#fff';
            $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_divided'];

            $holder_area_header_divided_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_border_bottom_color_header_divided'] !== '') {
            $holder_area_header_divided_styles['border-bottom-color'] = $conall_edge_options['menu_area_border_bottom_color_header_divided'];
        }

        $holder_area_header_divided_selector = array(
            '.edgtf-header-divided .edgtf-page-header'
        );

        echo conall_edge_dynamic_css($holder_area_header_divided_selector, $holder_area_header_divided_styles);

        $menu_area_header_divided_styles = array();

        if($conall_edge_options['menu_area_height_header_divided'] !== '') {
            $max_height = intval(conall_edge_filter_px($conall_edge_options['menu_area_height_header_divided'])).'px';
            echo conall_edge_dynamic_css('.edgtf-header-divided .edgtf-page-header .edgtf-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_divided_styles['height'] = conall_edge_filter_px($conall_edge_options['menu_area_height_header_divided']).'px';

        }

        echo conall_edge_dynamic_css('.edgtf-header-divided .edgtf-page-header .edgtf-menu-area', $menu_area_header_divided_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_header_divided_menu_area_styles');
}

if(!function_exists('conall_edge_header_full_screen_menu_area_styles')) {
    /**
     * Generates styles for header full_screen menu
     */
    function conall_edge_header_full_screen_menu_area_styles() {
        global $conall_edge_options;

        $holder_area_header_full_screen_styles = array();

        if($conall_edge_options['menu_area_background_color_header_full_screen'] !== '') {
            $menu_area_background_color        = $conall_edge_options['menu_area_background_color_header_full_screen'];
            $menu_area_background_transparency = 1;

            if($conall_edge_options['menu_area_background_transparency_header_full_screen'] !== '') {
                $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_full_screen'];
            }

            $holder_area_header_full_screen_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_background_color_header_full_screen'] === '' && $conall_edge_options['menu_area_background_transparency_header_full_screen'] !== '') {
            $menu_area_background_color        = '#fff';
            $menu_area_background_transparency = $conall_edge_options['menu_area_background_transparency_header_full_screen'];

            $holder_area_header_full_screen_styles['background-color'] = conall_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($conall_edge_options['menu_area_border_bottom_color_header_full_screen'] !== '') {
            $holder_area_header_full_screen_styles['border-bottom-color'] = $conall_edge_options['menu_area_border_bottom_color_header_full_screen'];
        }

        $holder_area_header_full_screen_selector = array(
            '.edgtf-header-full-screen .edgtf-page-header'
        );

        echo conall_edge_dynamic_css($holder_area_header_full_screen_selector, $holder_area_header_full_screen_styles);

        $menu_area_header_full_screen_styles = array();

        if($conall_edge_options['menu_area_height_header_full_screen'] !== '') {
            $max_height = intval(conall_edge_filter_px($conall_edge_options['menu_area_height_header_full_screen'])).'px';
            echo conall_edge_dynamic_css('.edgtf-header-full-screen .edgtf-page-header .edgtf-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_full_screen_styles['height'] = conall_edge_filter_px($conall_edge_options['menu_area_height_header_full_screen']).'px';

        }

        echo conall_edge_dynamic_css('.edgtf-header-full-screen .edgtf-page-header .edgtf-menu-area', $menu_area_header_full_screen_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_header_full_screen_menu_area_styles');
}

if(!function_exists('conall_edge_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function conall_edge_sticky_header_styles() {
        global $conall_edge_options;

        if($conall_edge_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $conall_edge_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($conall_edge_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $conall_edge_options['sticky_header_transparency'];
            }

            echo conall_edge_dynamic_css('.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array('background-color' => conall_edge_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($conall_edge_options['sticky_header_border_color'] !== '') {

            $sticky_header_border_color = $conall_edge_options['sticky_header_border_color'];

            echo conall_edge_dynamic_css('.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array('border-color' => $sticky_header_border_color));
        }

        if($conall_edge_options['sticky_header_height'] !== '') {
            $max_height = intval(conall_edge_filter_px($conall_edge_options['sticky_header_height'])).'px';

            echo conall_edge_dynamic_css('.edgtf-page-header .edgtf-sticky-header', array('height' => $conall_edge_options['sticky_header_height'].'px'));
            echo conall_edge_dynamic_css('.edgtf-page-header .edgtf-sticky-header .edgtf-logo-wrapper a', array('max-height' => $max_height));
        }

        $sticky_menu_item_styles = array();
        if($conall_edge_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $conall_edge_options['sticky_color'];
        }
        if($conall_edge_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = conall_edge_get_formatted_font_family($conall_edge_options['sticky_google_fonts']);
        }
        if($conall_edge_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $conall_edge_options['sticky_fontsize'].'px';
        }
        if($conall_edge_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $conall_edge_options['sticky_lineheight'].'px';
        }
        if($conall_edge_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $conall_edge_options['sticky_texttransform'];
        }
        if($conall_edge_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $conall_edge_options['sticky_fontstyle'];
        }
        if($conall_edge_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $conall_edge_options['sticky_fontweight'];
        }
        if($conall_edge_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $conall_edge_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.edgtf-main-menu.edgtf-sticky-nav > ul > li > a'
        );

        echo conall_edge_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($conall_edge_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $conall_edge_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.edgtf-main-menu.edgtf-sticky-nav > ul > li:hover > a',
            '.edgtf-main-menu.edgtf-sticky-nav > ul > li.edgtf-active-item > a'
        );

        echo conall_edge_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_sticky_header_styles');
}

if(!function_exists('conall_edge_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function conall_edge_fixed_header_styles() {
        global $conall_edge_options;

        $fixed_area_styles = array();

        if($conall_edge_options['fixed_header_background_color'] !== '') {
            $fixed_header_background_color        = $conall_edge_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($conall_edge_options['fixed_header_transparency'] !== '') {
                $fixed_header_background_color_transparency = $conall_edge_options['fixed_header_transparency'];
            }

            $fixed_area_styles['background-color'] = conall_edge_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency) . '!important';
        }

        if($conall_edge_options['fixed_header_background_color'] === '' && $conall_edge_options['fixed_header_transparency'] !== '') {
            $fixed_header_background_color        = '#fff';
            $fixed_header_background_color_transparency = $conall_edge_options['fixed_header_transparency'];

            $fixed_area_styles['background-color'] = conall_edge_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency) . '!important';
        }

        $selector = array(
            '.edgtf-page-header .edgtf-fixed-wrapper.fixed .edgtf-menu-area'
        );

        echo conall_edge_dynamic_css($selector, $fixed_area_styles);

        $fixed_area_holder_styles = array();

        if($conall_edge_options['fixed_header_border_bottom_color'] !== '') {
            $fixed_area_holder_styles['border-bottom-color'] = $conall_edge_options['fixed_header_border_bottom_color'];
        }

        $selector_holder = array(
            '.edgtf-page-header .edgtf-fixed-wrapper.fixed'
        );

        echo conall_edge_dynamic_css($selector_holder, $fixed_area_holder_styles);

        $fixed_menu_item_styles = array();
        if($conall_edge_options['fixed_color'] !== '') {
            $fixed_menu_item_styles['color'] = $conall_edge_options['fixed_color'];
        }
        if($conall_edge_options['fixed_google_fonts'] !== '-1') {
            $fixed_menu_item_styles['font-family'] = conall_edge_get_formatted_font_family($conall_edge_options['fixed_google_fonts']);
        }
        if($conall_edge_options['fixed_fontsize'] !== '') {
            $fixed_menu_item_styles['font-size'] = $conall_edge_options['fixed_fontsize'].'px';
        }
        if($conall_edge_options['fixed_lineheight'] !== '') {
            $fixed_menu_item_styles['line-height'] = $conall_edge_options['fixed_lineheight'].'px';
        }
        if($conall_edge_options['fixed_texttransform'] !== '') {
            $fixed_menu_item_styles['text-transform'] = $conall_edge_options['fixed_texttransform'];
        }
        if($conall_edge_options['fixed_fontstyle'] !== '') {
            $fixed_menu_item_styles['font-style'] = $conall_edge_options['fixed_fontstyle'];
        }
        if($conall_edge_options['fixed_fontweight'] !== '') {
            $fixed_menu_item_styles['font-weight'] = $conall_edge_options['fixed_fontweight'];
        }
        if($conall_edge_options['fixed_letterspacing'] !== '') {
            $fixed_menu_item_styles['letter-spacing'] = $conall_edge_options['fixed_letterspacing'].'px';
        }

        $fixed_menu_item_selector = array(
            '.edgtf-fixed-wrapper.fixed .edgtf-main-menu > ul > li > a'
        );

        echo conall_edge_dynamic_css($fixed_menu_item_selector, $fixed_menu_item_styles);

        $fixed_menu_item_hover_styles = array();
        if($conall_edge_options['fixed_hovercolor'] !== '') {
            $fixed_menu_item_hover_styles['color'] = $conall_edge_options['fixed_hovercolor'];
        }

        $fixed_menu_item_hover_selector = array(
            '.edgtf-fixed-wrapper.fixed .edgtf-main-menu > ul > li:hover > a',
            '.edgtf-fixed-wrapper.fixed .edgtf-main-menu > ul > li.edgtf-active-item > a'
        );

        echo conall_edge_dynamic_css($fixed_menu_item_hover_selector, $fixed_menu_item_hover_styles);
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_fixed_header_styles');
}

if(!function_exists('conall_edge_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function conall_edge_main_menu_styles() {
        global $conall_edge_options;

        if($conall_edge_options['menu_color'] !== '' || $conall_edge_options['menu_fontsize'] !== '' || $conall_edge_options['menu_lineheight'] !== "" ||$conall_edge_options['menu_fontstyle'] !== '' || $conall_edge_options['menu_fontweight'] !== '' || $conall_edge_options['menu_texttransform'] !== '' || $conall_edge_options['menu_letterspacing'] !== '' || $conall_edge_options['menu_google_fonts'] != "-1") { ?>
            .edgtf-main-menu > ul > li > a {
            <?php if($conall_edge_options['menu_color']) { ?> color: <?php echo esc_attr($conall_edge_options['menu_color']); ?>; <?php } ?>
            <?php if($conall_edge_options['menu_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $conall_edge_options['menu_google_fonts'])); ?>', sans-serif;
            <?php } ?>
            <?php if($conall_edge_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($conall_edge_options['menu_fontsize']); ?>px; <?php } ?>
            <?php if($conall_edge_options['menu_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($conall_edge_options['menu_lineheight']); ?>px; <?php } ?>
            <?php if($conall_edge_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($conall_edge_options['menu_fontstyle']); ?>; <?php } ?>
            <?php if($conall_edge_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($conall_edge_options['menu_fontweight']); ?>; <?php } ?>
            <?php if($conall_edge_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($conall_edge_options['menu_texttransform']); ?>;  <?php } ?>
            <?php if($conall_edge_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($conall_edge_options['menu_letterspacing']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($conall_edge_options['menu_hovercolor'] !== '') { ?>
            .edgtf-main-menu > ul > li > a:hover,
            .edgtf-main-menu > ul > li.edgtf-active-item:hover > a {
                color: <?php echo esc_attr($conall_edge_options['menu_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($conall_edge_options['menu_activecolor'] !== '') { ?>
            .edgtf-main-menu > ul > li.edgtf-active-item > a {
                color: <?php echo esc_attr($conall_edge_options['menu_activecolor']); ?>;
            }
        <?php } ?>

        <?php if($conall_edge_options['menu_light_hovercolor'] !== '') { ?>
            .edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li > a:hover,
            .edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li.edgtf-active-item:hover > a {
                color: <?php echo esc_attr($conall_edge_options['menu_light_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($conall_edge_options['menu_light_activecolor'] !== '') { ?>
            .edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li.edgtf-active-item > a {
                color: <?php echo esc_attr($conall_edge_options['menu_light_activecolor']); ?> !important;
            }
        <?php } ?>

        <?php if($conall_edge_options['menu_dark_hovercolor'] !== '') { ?>
            .edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li > a:hover,
            .edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li.edgtf-active-item:hover > a {
                color: <?php echo esc_attr($conall_edge_options['menu_dark_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($conall_edge_options['menu_dark_activecolor'] !== '') { ?>
            .edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header):not(.edgtf-fixed-wrapper) .edgtf-main-menu > ul > li.edgtf-active-item > a {
                color: <?php echo esc_attr($conall_edge_options['menu_dark_activecolor']); ?>;
            }
        <?php } ?>

        <?php if( $conall_edge_options['menu_padding_left_right'] !== '') { ?>
            .edgtf-main-menu > ul > li > a > span.item_outer {
                padding: 0  <?php echo esc_attr($conall_edge_options['menu_padding_left_right']); ?>px;
            }
        <?php } ?>

        <?php if($conall_edge_options['menu_margin_left_right'] !== '') { ?>
            .edgtf-main-menu > ul > li > a {
                margin: 0  <?php echo esc_attr($conall_edge_options['menu_margin_left_right']); ?>px;
            }
        <?php } ?>

        <?php if($conall_edge_options['dropdown_top_position'] !== '') { ?>
            header .edgtf-drop-down .second {
                top: <?php echo esc_attr($conall_edge_options['dropdown_top_position']).'%;'; ?>
            }
        <?php } ?>

        <?php if($conall_edge_options['dropdown_color'] !== '' || $conall_edge_options['dropdown_fontsize'] !== '' || $conall_edge_options['dropdown_lineheight'] !== '' || $conall_edge_options['dropdown_fontstyle'] !== '' || $conall_edge_options['dropdown_fontweight'] !== '' || $conall_edge_options['dropdown_google_fonts'] != "-1" || $conall_edge_options['dropdown_texttransform'] !== '' || $conall_edge_options['dropdown_letterspacing'] !== '') { ?>
                .edgtf-drop-down .second .inner > ul > li > a{
                    <?php if(!empty($conall_edge_options['dropdown_color'])) { ?> color: <?php echo esc_attr($conall_edge_options['dropdown_color']); ?>; <?php } ?>
                    <?php if($conall_edge_options['dropdown_google_fonts'] != "-1") { ?>
                        font-family: '<?php echo esc_attr(str_replace('+', ' ', $conall_edge_options['dropdown_google_fonts'])); ?>', sans-serif !important;
                    <?php } ?>
                    <?php if($conall_edge_options['dropdown_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($conall_edge_options['dropdown_fontsize']); ?>px; <?php } ?>
                    <?php if($conall_edge_options['dropdown_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($conall_edge_options['dropdown_lineheight']); ?>px; <?php } ?>
                    <?php if($conall_edge_options['dropdown_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($conall_edge_options['dropdown_fontstyle']); ?>;  <?php } ?>
                    <?php if($conall_edge_options['dropdown_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($conall_edge_options['dropdown_fontweight']); ?>; <?php } ?>
                    <?php if($conall_edge_options['dropdown_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($conall_edge_options['dropdown_texttransform']); ?>;  <?php } ?>
                    <?php if($conall_edge_options['dropdown_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($conall_edge_options['dropdown_letterspacing']); ?>px;  <?php } ?>
                }
        <?php } ?>

        <?php if(!empty($conall_edge_options['dropdown_hovercolor'])) { ?>
            .edgtf-drop-down .second .inner > ul > li > a:hover,
            .edgtf-drop-down .second .inner > ul > li.current-menu-ancestor > a,
            .edgtf-drop-down .second .inner > ul > li.current-menu-item > a {
                color: <?php echo esc_attr($conall_edge_options['dropdown_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($conall_edge_options['dropdown_wide_color'] !== '' || $conall_edge_options['dropdown_wide_fontsize'] !== '' || $conall_edge_options['dropdown_wide_lineheight'] !== '' || $conall_edge_options['dropdown_wide_fontstyle'] !== '' || $conall_edge_options['dropdown_wide_fontweight'] !== '' || $conall_edge_options['dropdown_wide_google_fonts'] !== "-1" || $conall_edge_options['dropdown_wide_texttransform'] !== '' || $conall_edge_options['dropdown_wide_letterspacing'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner > ul > li > a {
            <?php if($conall_edge_options['dropdown_wide_color'] !== '') { ?> color: <?php echo esc_attr($conall_edge_options['dropdown_wide_color']); ?>; <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $conall_edge_options['dropdown_wide_google_fonts'])); ?>', sans-serif !important;
            <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($conall_edge_options['dropdown_wide_fontsize']); ?>px; <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($conall_edge_options['dropdown_wide_lineheight']); ?>px; <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($conall_edge_options['dropdown_wide_fontstyle']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($conall_edge_options['dropdown_wide_fontweight']); ?>; <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($conall_edge_options['dropdown_wide_texttransform']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($conall_edge_options['dropdown_wide_letterspacing']); ?>px;  <?php } ?>
            }
        <?php } ?>

        <?php if($conall_edge_options['dropdown_wide_hovercolor'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner > ul > li > a:hover,
            .edgtf-drop-down .wide .second .inner > ul > li.current-menu-ancestor > a,
            .edgtf-drop-down .wide .second .inner > ul > li.current-menu-item > a {
                color: <?php echo esc_attr($conall_edge_options['dropdown_wide_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($conall_edge_options['dropdown_color_thirdlvl'] !== '' || $conall_edge_options['dropdown_fontsize_thirdlvl'] !== '' || $conall_edge_options['dropdown_lineheight_thirdlvl'] !== '' || $conall_edge_options['dropdown_fontstyle_thirdlvl'] !== '' || $conall_edge_options['dropdown_fontweight_thirdlvl'] !== '' || $conall_edge_options['dropdown_google_fonts_thirdlvl'] != "-1" || $conall_edge_options['dropdown_texttransform_thirdlvl'] !== '' || $conall_edge_options['dropdown_letterspacing_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .second .inner ul li ul li a {
            <?php if($conall_edge_options['dropdown_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($conall_edge_options['dropdown_color_thirdlvl']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_google_fonts_thirdlvl'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $conall_edge_options['dropdown_google_fonts_thirdlvl'])); ?>', sans-serif;
            <?php } ?>
            <?php if($conall_edge_options['dropdown_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($conall_edge_options['dropdown_fontsize_thirdlvl']); ?>px;  <?php } ?>
            <?php if($conall_edge_options['dropdown_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($conall_edge_options['dropdown_lineheight_thirdlvl']); ?>px;  <?php } ?>
            <?php if($conall_edge_options['dropdown_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($conall_edge_options['dropdown_fontstyle_thirdlvl']); ?>;   <?php } ?>
            <?php if($conall_edge_options['dropdown_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($conall_edge_options['dropdown_fontweight_thirdlvl']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($conall_edge_options['dropdown_texttransform_thirdlvl']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($conall_edge_options['dropdown_letterspacing_thirdlvl']); ?>px;  <?php } ?>
            }
        <?php } ?>
        
        <?php if($conall_edge_options['dropdown_hovercolor_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .second .inner ul li ul li a:hover,
            .edgtf-drop-down .second .inner ul li ul li.current-menu-ancestor > a,
            .edgtf-drop-down .second .inner ul li ul li.current-menu-item > a {
                color: <?php echo esc_attr($conall_edge_options['dropdown_hovercolor_thirdlvl']); ?> !important;
            }
        <?php } ?>

        <?php if($conall_edge_options['dropdown_wide_color_thirdlvl'] !== '' || $conall_edge_options['dropdown_wide_fontsize_thirdlvl'] !== '' || $conall_edge_options['dropdown_wide_lineheight_thirdlvl'] !== '' || $conall_edge_options['dropdown_wide_fontstyle_thirdlvl'] !== '' || $conall_edge_options['dropdown_wide_fontweight_thirdlvl'] !== '' || $conall_edge_options['dropdown_wide_google_fonts_thirdlvl'] != "-1" || $conall_edge_options['dropdown_wide_texttransform_thirdlvl'] !== '' || $conall_edge_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner ul li ul li a {
            <?php if($conall_edge_options['dropdown_wide_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($conall_edge_options['dropdown_wide_color_thirdlvl']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_google_fonts_thirdlvl'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $conall_edge_options['dropdown_wide_google_fonts_thirdlvl'])); ?>', sans-serif;
            <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($conall_edge_options['dropdown_wide_fontsize_thirdlvl']); ?>px;  <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($conall_edge_options['dropdown_wide_lineheight_thirdlvl']); ?>px;  <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($conall_edge_options['dropdown_wide_fontstyle_thirdlvl']); ?>;   <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($conall_edge_options['dropdown_wide_fontweight_thirdlvl']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($conall_edge_options['dropdown_wide_texttransform_thirdlvl']); ?>;  <?php } ?>
            <?php if($conall_edge_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($conall_edge_options['dropdown_wide_letterspacing_thirdlvl']); ?>px;  <?php } ?>
            }
        <?php } ?>

        <?php if($conall_edge_options['dropdown_wide_hovercolor_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner ul li ul li a:hover,
            .edgtf-drop-down .wide .second .inner ul li ul li.current-menu-ancestor > a,
            .edgtf-drop-down .wide .second .inner ul li ul li.current-menu-item > a {
                color: <?php echo esc_attr($conall_edge_options['dropdown_wide_hovercolor_thirdlvl']); ?> !important;
            }
        <?php }
    }

    add_action('conall_edge_style_dynamic', 'conall_edge_main_menu_styles');
}