(function($) {
    "use strict";

    var header = {};
    edgtf.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour = '';
    header.edgtfHeaderBehaviour = edgtfHeaderBehaviour();
    header.edgtfSideArea = edgtfSideArea;
    header.edgtfSideAreaScroll = edgtfSideAreaScroll;
    header.edgtfFullscreenMenu = edgtfFullscreenMenu;
    header.edgtfInitMobileNavigation = edgtfInitMobileNavigation;
    header.edgtfMobileHeaderBehavior = edgtfMobileHeaderBehavior;
    header.edgtfSetDropDownMenuPosition = edgtfSetDropDownMenuPosition;
    header.edgtfDropDownMenu = edgtfDropDownMenu;
    header.edgtfSearch = edgtfSearch;
    header.edgtfSetContentBehindHeader = edgtfSetContentBehindHeader;
    header.edgtfSetMenuWidthForCenteredLogoHeader = edgtfSetMenuWidthForCenteredLogoHeader;

    header.edgtfOnDocumentReady = edgtfOnDocumentReady;
    header.edgtfOnWindowLoad = edgtfOnWindowLoad;
    header.edgtfOnWindowResize = edgtfOnWindowResize;
    header.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfHeaderBehaviour();
        edgtfSideArea();
        edgtfSideAreaScroll();
        edgtfFullscreenMenu();
        edgtfInitMobileNavigation();
        edgtfMobileHeaderBehavior();
        edgtfSetDropDownMenuPosition();
        edgtfDropDownMenu();
        edgtfSearch();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
        edgtfSetContentBehindHeader();
        edgtfSetDropDownMenuPosition();
        edgtfSetMenuWidthForCenteredLogoHeader();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfDropDownMenu();
        edgtfSetContentBehindHeader();
        edgtfSetMenuWidthForCenteredLogoHeader();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
        
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function edgtfHeaderBehaviour() {

        var header = $('.edgtf-page-header');
        var stickyHeader = $('.edgtf-sticky-header');
        var fixedHeaderWrapper = $('.edgtf-fixed-wrapper');
        
        var revSliderHeight =  0;
            if ($('.edgtf-slider').length) {
                revSliderHeight = $('.edgtf-slider').outerHeight();
            }
            

        var headerMenuAreaOffset = $('.edgtf-page-header').find('.edgtf-fixed-wrapper').length ? $('.edgtf-page-header').find('.edgtf-fixed-wrapper').offset().top : 0;

        var stickyAppearAmount;
        var headerAppear;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-up'):
                edgtf.modules.header.behaviour = 'edgtf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = edgtfGlobalVars.vars.edgtfTopBarHeight + edgtfGlobalVars.vars.edgtfLogoAreaHeight + edgtfGlobalVars.vars.edgtfMenuAreaHeight + edgtfGlobalVars.vars.edgtfStickyHeaderHeight;

                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        edgtf.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
                    }else {
                        edgtf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-down-up'):
                edgtf.modules.header.behaviour = 'edgtf-sticky-header-on-scroll-down-up';
                
                if(edgtfPerPageVars.vars.edgtfStickyScrollAmount !== 0){
                    edgtf.modules.header.stickyAppearAmount = edgtfPerPageVars.vars.edgtfStickyScrollAmount;
                } else {
                    var menuHeight = edgtfGlobalVars.vars.edgtfMenuAreaHeight;
                    if (edgtf.body.hasClass('edgtf-slider-position-is-behind-header')) {
                        menuHeight = 0;
                    }
                    edgtf.modules.header.stickyAppearAmount = edgtfGlobalVars.vars.edgtfStickyScrollAmount !== 0 ? edgtfGlobalVars.vars.edgtfStickyScrollAmount : edgtfGlobalVars.vars.edgtfTopBarHeight + edgtfGlobalVars.vars.edgtfLogoAreaHeight + menuHeight + revSliderHeight;
                }

                headerAppear = function(){
                    if(edgtf.scroll < edgtf.modules.header.stickyAppearAmount) {
                        edgtf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
                    }else{
                        edgtf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case edgtf.body.hasClass('edgtf-fixed-on-scroll'):
                edgtf.modules.header.behaviour = 'edgtf-fixed-on-scroll';
                var headerFixed = function(){
                    if(edgtf.scroll <= headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom',0);
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    function edgtfSetMenuWidthForCenteredLogoHeader(){
        if(edgtf.body.hasClass('edgtf-header-divided')){
            //get left side menu width
            var menuArea = $('.edgtf-menu-area');
            var menuAreaWidth = menuArea.width();
            if(menuArea.children('.edgtf-grid').length) {
                menuAreaWidth = menuArea.children('.edgtf-grid').width();
            }
            var menuItemPadding = parseInt($('.edgtf-main-menu > ul > li > a > span.item_outer').css('padding-left'));

            var menuAreaLeftSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - $('.edgtf-menu-area .edgtf-logo-wrapper').width()/2);
            $('.edgtf-menu-area .edgtf-position-left').width(menuAreaLeftSideWidth);

            //get right side menu width
            var menuAreaRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - $('.edgtf-menu-area .edgtf-logo-wrapper').width()/2);
            $('.edgtf-menu-area .edgtf-position-right').width(menuAreaRightSideWidth);

            menuArea.css('opacity',1);

            edgtfDropDownMenu();
            edgtfSetDropDownMenuPosition();
        }
    }

    /**
     * Show/hide side area
     */
    function edgtfSideArea() {

        var wrapper = $('.edgtf-wrapper'),
            sideMenu = $('.edgtf-side-menu'),
            sideMenuButtonOpen = $('a.edgtf-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (edgtf.body.hasClass('edgtf-side-menu-slide-from-right')) {

            cssClass = 'edgtf-right-side-menu-opened';
            wrapper.prepend('<div class="edgtf-cover"/>');
            slideFromRight = true;

        } else if (edgtf.body.hasClass('edgtf-side-menu-slide-with-content')) {

            cssClass = 'edgtf-side-menu-open';
            slideWithContent = true;

        } else if (edgtf.body.hasClass('edgtf-side-area-uncovered-from-content')) {

            cssClass = 'edgtf-right-side-menu-opened';
            slideUncovered = true;
        }

        $('a.edgtf-side-menu-button-opener, a.edgtf-close-side-menu').click( function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                edgtf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.edgtf-wrapper .edgtf-cover').click(function() {
                        edgtf.body.removeClass('edgtf-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(edgtf.scroll - currentScroll) > 400){
                        edgtf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                edgtf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }
            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.click(function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    edgtf.body.removeClass('edgtf-side-menu-open');
                });
            }
        });
    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function edgtfSideAreaScroll(){

        var sideMenu = $('.edgtf-side-menu');

        if(sideMenu.length){    
            sideMenu.niceScroll({ 
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0, 
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false, 
                horizrailenabled: false 
            });
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function edgtfFullscreenMenu() {

        if ($('a.edgtf-fullscreen-menu-opener').length) {

            var popupMenuOpener = $( 'a.edgtf-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".edgtf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.edgtf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.edgtf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.edgtf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.edgtf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.edgtf-fullscreen-menu ul li:not(.has_sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(edgtf.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(edgtf.windowHeight);
            });

            if (edgtf.body.hasClass('edgtf-fade-push-text-right')) {
                cssClass = 'edgtf-push-nav-right';
                fadeRight = true;
            } else if (edgtf.body.hasClass('edgtf-fade-push-text-top')) {
                cssClass = 'edgtf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('edgtf-fm-opened')) {
                    popupMenuOpener.addClass('edgtf-fm-opened');
                    edgtf.body.addClass('edgtf-fullscreen-menu-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-fade-out').addClass('edgtf-fullscreen-fade-in');
                    edgtf.body.removeClass(cssClass);
                    if(!edgtf.body.hasClass('page-template-full_screen-php')){
                        edgtf.modules.common.edgtfDisableScroll();
                    }
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('edgtf-fm-opened');
                            edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                            edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                            edgtf.body.addClass(cssClass);
                            if(!edgtf.body.hasClass('page-template-full_screen-php')){
                                edgtf.modules.common.edgtfEnableScroll();
                            }
                            $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('edgtf-fm-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                    edgtf.body.addClass(cssClass);
                    if(!edgtf.body.hasClass('page-template-full_screen-php')){
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                    $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {

                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){

                    if (e.which == 1) {
                        popupMenuOpener.removeClass('edgtf-fm-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                        edgtf.body.addClass(cssClass);
                        $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                }else{
                    return false;
                }
            });
        }
    }

    function edgtfInitMobileNavigation() {
        var navigationOpener = $('.edgtf-mobile-header .edgtf-mobile-menu-opener');
        var navigationHolder = $('.edgtf-mobile-header .edgtf-mobile-nav');
        var dropdownOpener = $('.edgtf-mobile-nav .mobile_arrow, .edgtf-mobile-nav h6, .edgtf-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('edgtf-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('edgtf-opened');
                        }
                    }

                });
            });
        }

        $('.edgtf-mobile-nav a, .edgtf-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function edgtfMobileHeaderBehavior() {
        if(edgtf.body.hasClass('edgtf-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.edgtf-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('edgtf-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('edgtf-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.edgtf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function edgtfSetDropDownMenuPosition(){

        var menuItems = $(".edgtf-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = edgtf.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(edgtf.body.hasClass('boxed')){
                menuItemFromLeft = edgtf.boxedLayoutWidth  - (menuItemPosition - (browserWidth - edgtf.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });
    }

    function edgtfDropDownMenu() {

        var menu_items = $('.edgtf-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });

                    $(this).find('.second > .inner > ul').css("width", "100%");
                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    var left_position;

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        var headerPadding = 0;
                        if(!$(this).parents('.edgtf-sticky-header').length){
                            headerPadding = parseInt($('.edgtf-page-header .edgtf-menu-area').css('padding-left'));
                        }
                        left_position = dropdown.offset().left - headerPadding;

                        dropDownSecondDiv.css('width', edgtf.windowWidth);
                        dropDownSecondDiv.css('left', -left_position);
                    }
                }

                if(!edgtf.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(edgtf.body.hasClass('edgtf-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 200, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 0, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('edgtf-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('edgtf-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.edgtf-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which == 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        edgtf.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function edgtfSearch() {

        var searchOpener = $('a.edgtf-search-opener'),
            searchClose,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( edgtf.body.hasClass( 'edgtf-fullscreen-search' ) ) {

                var fullscreenSearchFade;

                searchClose = $( '.edgtf-fullscreen-search-close' );
                fullscreenSearchFade = true;
                edgtfFullscreenSearch( fullscreenSearchFade);

            } else if ( edgtf.body.hasClass( 'edgtf-search-covers-header' ) ) {

                edgtfSearchCoversHeader();
            }

            //Check for hover color of search
            if(typeof searchOpener.data('hover-color') !== 'undefined') {
                var changeSearchColor = function(event) {
                    event.data.searchOpener.css('color', event.data.color);
                };

                var originalColor = searchOpener.css('color');
                var hoverColor = searchOpener.data('hover-color');

                searchOpener.on('mouseenter', { searchOpener: searchOpener, color: hoverColor }, changeSearchColor);
                searchOpener.on('mouseleave', { searchOpener: searchOpener, color: originalColor }, changeSearchColor);
            }
        }
        /**
         * Search covers header type of search
         */
        function edgtfSearchCoversHeader() {

            searchOpener.click( function(e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.edgtf-search-cover .edgtf-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                edgtf.body.addClass('edgtf-search-covers-header-opened');

                if($(this).closest('.edgtf-grid').length){
                    searchForm = $(this).closest('.edgtf-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                else{
                    searchForm = $(this).closest('.edgtf-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ( $(this).closest('.edgtf-sticky-header').length > 0 ) {
                    searchForm = $(this).closest('.edgtf-sticky-header').children().first();
                }
                if ( $(this).closest('.edgtf-mobile-header').length > 0 ) {
                    searchForm = $(this).closest('.edgtf-mobile-header').children().children().first();
                }

                //Find search form position in header and height
                if ( searchFormLandmark.parent().hasClass('edgtf-logo-area') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfLogoAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-top-bar') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfTopBarHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-menu-area') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfMenuAreaHeight;
                } else if ( searchFormLandmark.hasClass('edgtf-sticky-header') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfMenuAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-mobile-header') ) {
                    searchFormHeight = $('.edgtf-mobile-header-inner').height();
                }

                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(100);
                searchForm.find('.edgtf-form-holder-outer').addClass('edgtf-appeared');
                $('.edgtf-form-holder-outer').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                    function() {
                        $('.edgtf-search-cover input[type="text"]').focus();
                    });
                $('.edgtf-search-close, .content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(10, 'easeOutSine',
                        function(){
                            searchForm.find('.edgtf-form-holder-outer').removeClass('edgtf-appeared');
                            $('.edgtf-search-cover input[type="text"]').val('');
                        }
                    );
                    edgtf.body.removeClass('edgtf-search-covers-header-opened');
                });

                $(document).keyup(function(e){
                    if (e.keyCode == 27 ) { //KeyCode for ESC button is 27 
                        searchForm.blur();
                        searchForm.stop(true).fadeOut(100, 'easeOutSine',
                            function(){
                                searchForm.find('.edgtf-form-holder-outer').removeClass('edgtf-appeared');
                                $('.edgtf-search-cover input[type="text"]').val('');
                            }
                        );
                        edgtf.body.removeClass('edgtf-search-covers-header-opened');
                    }
                });

            });
        }

        /**
         * Fullscreen search fade
         */
        function edgtfFullscreenSearch( fade) {

            var searchHolder = $( '.edgtf-fullscreen-search-holder');

            searchOpener.click( function(e) {
                e.preventDefault();
                var samePosition = false,
                    closeTop = 0,
                    closeLeft = 0;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    closeTop = $(this).find('.edgtf-search-opener-wrapper').offset().top;
                    closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if ( fade ) {
                    if ( searchHolder.hasClass( 'edgtf-animate' ) ) {
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                        edgtf.body.addClass( 'edgtf-search-fade-out' );
                        edgtf.body.removeClass( 'edgtf-search-fade-in' );
                        searchHolder.removeClass( 'edgtf-animate' );
                        setTimeout(function(){
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        },300);
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    } else {
                        edgtf.body.addClass('edgtf-fullscreen-search-opened');
                        setTimeout(function(){
                            searchHolder.find('.edgtf-search-field').focus();
                        },900);
                        edgtf.body.removeClass('edgtf-search-fade-out');
                        edgtf.body.addClass('edgtf-search-fade-in');
                        searchHolder.addClass('edgtf-animate');
                        if (samePosition) {
                            searchClose.css({
                                'top' : closeTop - edgtf.scroll,
                                'left' : closeLeft
                            });
                        }
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfDisableScroll();
                        }
                    }
                    searchClose.click( function(e) {
                        e.preventDefault();
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                        searchHolder.removeClass('edgtf-animate');
                        setTimeout(function(){
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        },300);
                        edgtf.body.removeClass('edgtf-search-fade-in');
                        edgtf.body.addClass('edgtf-search-fade-out');
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".edgtf-form-holder-inner");
                        if (!container.is(e.target) && container.has(e.target).length === 0)  {
                            e.preventDefault();
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                            searchHolder.removeClass('edgtf-animate');
                            setTimeout(function(){
                                searchHolder.find('.edgtf-search-field').val('');
                                searchHolder.find('.edgtf-search-field').blur();
                            },300);
                            edgtf.body.removeClass('edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            if(!edgtf.body.hasClass('page-template-full_screen-php')){
                                edgtf.modules.common.edgtfEnableScroll();
                            }
                        }
                    });

                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                            searchHolder.removeClass('edgtf-animate');
                            setTimeout(function(){
                                searchHolder.find('.edgtf-search-field').val('');
                                searchHolder.find('.edgtf-search-field').blur();
                            },300);
                            edgtf.body.removeClass('edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            if(!edgtf.body.hasClass('page-template-full_screen-php')){
                                edgtf.modules.common.edgtfEnableScroll();
                            }
                        }
                    });
                }
            });

            //Text input focus change
            $('.edgtf-fullscreen-search-holder .edgtf-search-field').focus(function(){
                $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line').css("width","100%");
            });

            $('.edgtf-fullscreen-search-holder .edgtf-search-field').blur(function(){
                $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line').css("width","0");
            });
        }
    }

    function edgtfSetContentBehindHeader() {

        var holder = $('.edgtf-content');
        var headerHeight = $('.edgtf-page-header').outerHeight();

        if(edgtf.windowWidth < 1025) {
            headerHeight = $('.edgtf-mobile-header').outerHeight();
        }

        if (edgtf.body.hasClass('edgtf-slider-position-is-behind-header')) {
            holder.css('margin-top',-headerHeight);
        }
    }

})(jQuery);