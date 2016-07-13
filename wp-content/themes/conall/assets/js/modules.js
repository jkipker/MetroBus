(function($) {
    "use strict";

    window.edgtf = {};
    edgtf.modules = {};

    edgtf.scroll = 0;
    edgtf.window = $(window);
    edgtf.document = $(document);
    edgtf.windowWidth = $(window).width();
    edgtf.windowHeight = $(window).height();
    edgtf.body = $('body');
    edgtf.html = $('html, body');
    edgtf.htmlEl = $('html');
    edgtf.menuDropdownHeightSet = false;
    edgtf.defaultHeaderStyle = '';
    edgtf.minVideoWidth = 1500;
    edgtf.videoWidthOriginal = 1280;
    edgtf.videoHeightOriginal = 720;
    edgtf.videoRatio = 1.61;

    edgtf.edgtfOnDocumentReady = edgtfOnDocumentReady;
    edgtf.edgtfOnWindowLoad = edgtfOnWindowLoad;
    edgtf.edgtfOnWindowResize = edgtfOnWindowResize;
    edgtf.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtf.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(edgtf.body.hasClass('edgtf-dark-header')){ edgtf.defaultHeaderStyle = 'edgtf-dark-header';}
        if(edgtf.body.hasClass('edgtf-light-header')){ edgtf.defaultHeaderStyle = 'edgtf-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtf.windowWidth = $(window).width();
        edgtf.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
        edgtf.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case edgtf.body.hasClass('edgtf-grid-1300'):
            edgtf.boxedLayoutWidth = 1350;
            break;
        case edgtf.body.hasClass('edgtf-grid-1200'):
            edgtf.boxedLayoutWidth = 1250;
            break;
        case edgtf.body.hasClass('edgtf-grid-1000'):
            edgtf.boxedLayoutWidth = 1050;
            break;
        case edgtf.body.hasClass('edgtf-grid-800'):
            edgtf.boxedLayoutWidth = 850;
            break;
        default :
            edgtf.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    edgtf.modules.common = common;

    common.edgtfIsTouchDevice = edgtfIsTouchDevice;
    common.edgtfDisableSmoothScrollForMac = edgtfDisableSmoothScrollForMac;
    common.edgtfFluidVideo = edgtfFluidVideo;
    common.edgtfPreloadBackgrounds = edgtfPreloadBackgrounds;
    common.edgtfPrettyPhoto = edgtfPrettyPhoto;
    common.edgtfInitParallax = edgtfInitParallax;
    common.edgtfEnableScroll = edgtfEnableScroll;
    common.edgtfDisableScroll = edgtfDisableScroll;
    common.edgtfWheel = edgtfWheel;
    common.edgtfKeydown = edgtfKeydown;
    common.edgtfPreventDefaultValue = edgtfPreventDefaultValue;
    common.edgtfOwlSlider = edgtfOwlSlider;
    common.edgtfInitSelfHostedVideoPlayer = edgtfInitSelfHostedVideoPlayer;
    common.edgtfSelfHostedVideoSize = edgtfSelfHostedVideoSize;
    common.edgtfInitBackToTop = edgtfInitBackToTop;
    common.edgtfBackButtonShowHide = edgtfBackButtonShowHide;
    common.edgtfSmoothTransition = edgtfSmoothTransition;
    common.edgtfInit404PageSize = edgtfInit404PageSize;
    common.edgtfInitComingSoonPageSize = edgtfInitComingSoonPageSize;
    common.edgtfCharShuffle = edgtfCharShuffle;
    common.edgtfFooterAppear = edgtfFooterAppear;

    common.edgtfOnDocumentReady = edgtfOnDocumentReady;
    common.edgtfOnWindowLoad = edgtfOnWindowLoad;
    common.edgtfOnWindowResize = edgtfOnWindowResize;
    common.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfIsTouchDevice();
        edgtfDisableSmoothScrollForMac();
        edgtfFluidVideo();
        edgtfPreloadBackgrounds();
        edgtfPrettyPhoto();
        edgtfInitElementsAnimations();
        edgtfInitAnchor().init();
        edgtfInitVideoBackground();
        edgtfInitVideoBackgroundSize();
        edgtfSetContentBottomMargin();
        edgtfOwlSlider();
        edgtfInitSelfHostedVideoPlayer();
        edgtfSelfHostedVideoSize();
        edgtfInitBackToTop();
        edgtfBackButtonShowHide();
        edgtfInit404PageSize();
        edgtfInitComingSoonPageSize();
        edgtfCharShuffle();
        edgtfBrowserDetection();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
        edgtfInitParallax();
        edgtfSmoothTransition();
        edgtfFooterAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfInitVideoBackgroundSize();
        edgtfSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
        
    }

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function edgtfIsTouchDevice() {
        if(Modernizr.touch && !edgtf.body.hasClass('edgtf-no-animations-on-touch')) {
            edgtf.body.addClass('edgtf-no-animations-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function edgtfDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && edgtf.body.hasClass('edgtf-smooth-scroll')) {
            edgtf.body.removeClass('edgtf-smooth-scroll');
        }
    }

	function edgtfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    /**
     * Init Owl Carousel
     */
    function edgtfOwlSlider() {

        var sliders = $('.edgtf-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this);

                slider.owlCarousel({
                    autoplay: true,
                    autoplayTimeout: 5000,
                    smartSpeed: 600,
                    items: 1,
                    animateOut: false,
                    animateIn: false,
                    loop: true,
                    dots: false,
                    nav: true,
                    navText: [
                        '<span class="edgtf-prev-icon"><span class="icon-arrows-slim-left"></span></span>',
                        '<span class="edgtf-next-icon"><span class="icon-arrows-slim-right"></span></span>'
                    ]
                });
            });
        }
    }

    /*
     *	Preload background images for elements that have 'edgtf-preload-background' class
     */
    function edgtfPreloadBackgrounds(){

        $(".edgtf-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('edgtf-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('edgtf-preload-background'); }); //make sure that edgtf-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function edgtfPrettyPhoto() {
        /*jshint multistr: true */
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    /*
     *	Start animations on elements
     */
    function edgtfInitElementsAnimations(){

        var touchClass = $('.edgtf-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.edgtf-grow-in, .edgtf-fade-in-down, .edgtf-element-from-fade, .edgtf-element-from-left, .edgtf-element-from-right, .edgtf-element-from-top, .edgtf-element-from-bottom, .edgtf-flip-in, .edgtf-x-rotate, .edgtf-z-rotate, .edgtf-y-translate, .edgtf-fade-in, .edgtf-fade-in-left-x-rotate'),
            animationClass,
            animationData,
            animationDelay;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
                var thisElement = $(this);
                thisElement.appear(function() {
                    animationData = thisElement.data('animation');
                    animationDelay = parseInt(thisElement.data('animation-delay'));
                    if(typeof animationData !== 'undefined' && animationData !== '') {
                        animationClass = animationData;
                        var newClass = animationClass+'-on';
                        setTimeout(function(){
                            thisElement.addClass(newClass);
                        },animationDelay);
                    }
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }

    }


    /*
     **	Sections with parallax background image
     */
    function edgtfInitParallax(){

        if($('.edgtf-parallax-section-holder').length){
            $('.edgtf-parallax-section-holder').each(function() {

                var parallaxElement = $(this);
                if(parallaxElement.hasClass('edgtf-full-screen-height-parallax')){
                    parallaxElement.height(edgtf.windowHeight);
                    parallaxElement.find('.edgtf-parallax-content-outer').css('padding',0);
                }
                var speed = parallaxElement.data('edgtf-parallax-speed')*0.4;
                parallaxElement.parallax("50%", speed);
            });
        }
    }

    /*
     **	Anchor functionality
     */
    var edgtfInitAnchor = edgtf.modules.common.edgtfInitAnchor = function() {
        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function(anchor){

            $('.edgtf-main-menu .edgtf-active-item, .edgtf-mobile-nav .edgtf-active-item, .edgtf-vertical-menu .edgtf-active-item, .edgtf-fullscreen-menu .edgtf-active-item').removeClass('edgtf-active-item');
            anchor.parent().addClass('edgtf-active-item');

            $('.edgtf-main-menu a, .edgtf-mobile-nav a, .edgtf-vertical-menu a, .edgtf-fullscreen-menu a').removeClass('current');
            anchor.addClass('current');
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function(){

            $('[data-edgtf-anchor]').waypoint( function(direction) {
                if(direction === 'down') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edgtf-anchor")+"']"));
                }
            }, { offset: '50%' });

            $('[data-edgtf-anchor]').waypoint( function(direction) {
                if(direction === 'up') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edgtf-anchor")+"']"));
                }
            }, { offset: function(){
                return -($(this.element).outerHeight() - 150);
            } });

        };

        /**
         * Check anchor active state on load
         */
        var checkActiveStateOnLoad = function(){
            var hash = window.location.hash.split('#')[1];

            if(hash !== "" && $('[data-edgtf-anchor="'+hash+'"]').length > 0){

                //triggers click which is handled in 'anchorClick' function
                $("a[href='#"+hash+"'").trigger( "click" );
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function(anchoredElementOffset){

            if(edgtf.modules.header.behaviour == 'edgtf-sticky-header-on-scroll-down-up') {
                edgtf.modules.header.isStickyVisible = (anchoredElementOffset > edgtf.modules.header.stickyAppearAmount);
            }

            if(edgtf.modules.header.behaviour == 'edgtf-sticky-header-on-scroll-up') {
                if((anchoredElementOffset > edgtf.scroll)){
                    edgtf.modules.header.isStickyVisible = false;
                }
            }

            var headerHeight = edgtf.modules.header.isStickyVisible ? edgtfGlobalVars.vars.edgtfStickyHeaderTransparencyHeight : edgtfPerPageVars.vars.edgtfHeaderTransparencyHeight;

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function() {
            edgtf.document.on("click", ".edgtf-main-menu a, .edgtf-vertical-menu a, .edgtf-fullscreen-menu a, .edgtf-btn, .edgtf-anchor, .edgtf-mobile-nav a", function() {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if(hash !== "" && $('[data-edgtf-anchor="' + hash + '"]').length > 0 ) {

                    var anchoredElementOffset = $('[data-edgtf-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-edgtf-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - edgtfGlobalVars.vars.edgtfAddForAdminBar;

                    setActiveState(anchor);

                    edgtf.html.stop().animate({
                        scrollTop: Math.round(scrollAmount)
                    }, 1000, function() {
                        //change hash tag in url
                        if(history.pushState) { history.pushState(null, null, '#'+hash); }
                    });
                    return false;
                }
            });
        };

        return {
            init: function() {
                if($('[data-edgtf-anchor]').length) {
                    anchorClick();
                    checkActiveStateOnScroll();
                    $(window).load(function() { checkActiveStateOnLoad(); });
                }
            }
        };

    };

    /*
     **	Video background initialization
     */
    function edgtfInitVideoBackground(){

        $('.edgtf-section .edgtf-video-wrap .edgtf-video').mediaelementplayer({
            enableKeyboard: false,
            iPadUseNativeControls: false,
            pauseOtherPlayers: false,
            // force iPhone's native controls
            iPhoneUseNativeControls: false,
            // force Android's native controls
            AndroidUseNativeControls: false
        });

        //mobile check
        if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
            edgtfInitVideoBackgroundSize();
            $('.edgtf-section .edgtf-mobile-video-image').show();
            $('.edgtf-section .edgtf-video-wrap').remove();
        }
    }

    /*
     **	Calculate video background size
     */
    function edgtfInitVideoBackgroundSize(){

        $('.edgtf-section .edgtf-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.edgtf-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.edgtf-section').outerHeight();
            edgtf.minVideoWidth = edgtf.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / edgtf.videoWidthOriginal;
            var scaleV = sectionHeight / edgtf.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * edgtf.videoWidthOriginal < edgtf.minVideoWidth) {scale = edgtf.minVideoWidth / edgtf.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * edgtf.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * edgtf.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function edgtfSetContentBottomMargin(){
        var uncoverFooter = $('.edgtf-footer-uncover');

        if(uncoverFooter.length){
            $('.edgtf-content').css('margin-bottom', $('.edgtf-footer-inner').height());
        }
    }

    function edgtfDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', edgtfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = edgtfWheel;
        document.onkeydown = edgtfKeydown;

        if(edgtf.body.hasClass('edgtf-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function edgtfEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', edgtfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(edgtf.body.hasClass('edgtf-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function edgtfWheel(e) {
        edgtfPreventDefaultValue(e);
    }

    function edgtfKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                edgtfPreventDefaultValue(e);
                return;
            }
        }
    }

    function edgtfPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function edgtfInitSelfHostedVideoPlayer() {

        var players = $('.edgtf-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function edgtfSelfHostedVideoSize(){

		$('.edgtf-self-hosted-video-holder .edgtf-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.edgtf-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / edgtf.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}

    function edgtfToTopButton(a) {

        var b = $("#edgtf-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function edgtfBackButtonShowHide(){
        edgtf.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { edgtfToTopButton('off'); } else { edgtfToTopButton('on'); }
        });
    }

    function edgtfInitBackToTop(){
        var backToTopButton = $('#edgtf-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            edgtf.html.animate({scrollTop: 0}, edgtf.window.scrollTop()/3, 'linear');
        });
    }

    function edgtfSmoothTransition() {
        var loader = $('body > .edgtf-smooth-transition-loader.edgtf-mimic-ajax');
        if (loader.length) {
            loader.fadeOut(500);
            $(window).bind("pageshow", function(event) {
                if (event.originalEvent.persisted) {
                    loader.fadeOut(500);
                }
            });

            if($('a').parent().hasClass('edgtf-blog-load-more-button') || $('a').parent().hasClass('edgtf-ptf-list-load-more')) {
                return false;
            }

            $('a').click(function(e) {
                var a = $(this);
                if (
                    e.which == 1 && // check if the left mouse button has been pressed
                    a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
					(typeof a.data('rel') === 'undefined') && //Not pretty photo link
                    (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                    (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                ) {
                    e.preventDefault();
                    loader.addClass('edgtf-hide-spinner');
                    loader.fadeIn(500, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }

    function edgtfInit404PageSize() {
        
        var holder = $('.edgtf-404-page');

        if(holder.length && edgtf.windowWidth > 700){
            holder.find('.edgtf-content').css('height',edgtf.windowHeight-edgtfGlobalVars.vars.edgtfAddForAdminBar);
        } else if (holder.length && edgtf.windowWidth <= 700) {
            holder.find('.edgtf-content').css('min-height',edgtf.windowHeight-edgtfGlobalVars.vars.edgtfAddForAdminBar);
        }
    }

    function edgtfInitComingSoonPageSize() {
        
        var holder = $('.edgtf-coming-soon-page');

        if(holder.length && edgtf.windowWidth > 700){
            holder.find('.edgtf-content').css('height',edgtf.windowHeight-edgtfGlobalVars.vars.edgtfAddForAdminBar);
        } else if (holder.length && edgtf.windowWidth <= 700) {
            holder.find('.edgtf-content').css('min-height',edgtf.windowHeight-edgtfGlobalVars.vars.edgtfAddForAdminBar);
        }
    }

    /*
    ** Init footer appearance
    */
    function edgtfFooterAppear() {
        var footer = $('body.edgtf-portfolio-list-in-content footer'),
            timeOut = 0;

        if (footer.length) {
            if ((edgtf.body.find('.edgtf-content').height() < edgtf.window.height())) {
                timeOut = 1500;
            }

            setTimeout(function(){
                footer.addClass('edgtf-appeared');
            },timeOut);
        }
    }


    /*
    * Init Char Shuffle effect
    */
    function edgtfCharShuffle() {
        var item = $(':not(.edgtf-portfolio-link) > .edgtf-shuffle'); /* disable for portfolio showcase */
        item.each(function(){
            var thisItem = $(this);
            thisItem.css('width',thisItem.width());
        });
        item.chaffle({
              speed: 25,
              time: 100
        });
    }

    /*
    * Init Browser Detection
    */
    function edgtfBrowserDetection() {

        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
        var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
        
        if (isChrome) {
            $('body').addClass('edgtf-chrome');
        }
        if (isSafari) {
            $('body').addClass('edgtf-safari');
        }
        if ($.browser.msie  && parseInt($.browser.version, 10) > 8) {
            $('body').addClass('edgtf-ms-explorer-9-10');
        }

    }

})(jQuery);
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
(function($) {
    "use strict";

    var title = {};
    edgtf.modules.title = title;

    title.edgtfParallaxTitle = edgtfParallaxTitle;

    title.edgtfOnDocumentReady = edgtfOnDocumentReady;
    title.edgtfOnWindowLoad = edgtfOnWindowLoad;
    title.edgtfOnWindowResize = edgtfOnWindowResize;
    title.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {

    }
    

    /*
     **	Title image with parallax effect
     */
    function edgtfParallaxTitle(){
        if($('.edgtf-title.edgtf-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.edgtf-title.edgtf-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.edgtf-title.edgtf-has-parallax-background.edgtf-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(edgtf.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+edgtfGlobalVars.vars.edgtfAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-edgtf.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(edgtf.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+edgtfGlobalVars.vars.edgtfAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-edgtf.scroll + 'px auto'});
            });

        }
    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    edgtf.modules.shortcodes = shortcodes;

    shortcodes.edgtfInitCounter = edgtfInitCounter;
    shortcodes.edgtfInitProgressBars = edgtfInitProgressBars;
    shortcodes.edgtfInitCountdown = edgtfInitCountdown;
    shortcodes.edgtfInitMessages = edgtfInitMessages;
    shortcodes.edgtfInitMessageHeight = edgtfInitMessageHeight;
    shortcodes.edgtfInitTestimonials = edgtfInitTestimonials;
    shortcodes.edgtfInitCarousels = edgtfInitCarousels;
    shortcodes.edgtfInitPieChart = edgtfInitPieChart;
    shortcodes.edgtfInitTabs = edgtfInitTabs;
    shortcodes.edgtfCustomFontResize = edgtfCustomFontResize;
    shortcodes.edgtfInitImageGallery = edgtfInitImageGallery;
    shortcodes.edgtfInitTeamCarousel = edgtfInitTeamCarousel();
    shortcodes.edgtfInitAccordions = edgtfInitAccordions;
    shortcodes.edgtfShowGoogleMap = edgtfShowGoogleMap;
    shortcodes.edgtfCheckSliderForHeaderStyle = edgtfCheckSliderForHeaderStyle;
    shortcodes.edgtfInitVideo = edgtfInitVideo;
    shortcodes.edgtfStickySidebarWidget = edgtfStickySidebarWidget;
    shortcodes.edgtfInitGalleryBlocks = edgtfInitGalleryBlocks;

    shortcodes.edgtfOnDocumentReady = edgtfOnDocumentReady;
    shortcodes.edgtfOnWindowLoad = edgtfOnWindowLoad;
    shortcodes.edgtfOnWindowResize = edgtfOnWindowResize;
    shortcodes.edgtfOnWindowScroll = edgtfOnWindowScroll;
    shortcodes.edgtfParallaxSections = edgtfParallaxSections;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitCounter();
        edgtfInitProgressBars();
        edgtfInitCountdown();
        edgtfIcon().init();
        edgtfInitMessages();
        edgtfInitMessageHeight();
        edgtfInitTestimonials();
        edgtfInitCarousels();
        edgtfInitPieChart();
        edgtfInitTabs();
        edgtfButton().init();
        edgtfCustomFontResize();
        edgtfInitImageGallery();
        edgtfInitTeamCarousel();
        edgtfInitAccordions();
        edgtfShowGoogleMap();
        edgtfSocialIconWidget().init();
        edgtfCallToActionSlider().init();
        edgtfInitIconList().init();
        edgtfInitVideo();
        edgtfInitGalleryBlocksMasonry();
        edgtfInitProductListShortcode();
        edgtfSlider().init();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
        edgtfInitGalleryBlocks();
        edgtfStickySidebarWidget().init();
        edgtfParallaxSections();
        resetParallaxPositions();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfCustomFontResize();
        edgtfInitGalleryBlocksMasonry();
        edgtfInitProductListShortcode();
        edgtfParallaxSections();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {

    }

    /**
     * Counter Shortcode
     */
    function edgtfInitCounter() {

        var counters = $('.edgtf-counter');


        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parent().addClass('edgtf-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }
    }

    /*
    **	Horizontal progress bars shortcode
    */
    function edgtfInitProgressBars(){

        var progressBar = $('.edgtf-progress-bar');

        if(progressBar.length){

            progressBar.each(function() {

                var thisBar = $(this);

                thisBar.appear(function() {
                    edgtfInitToCounterProgressBar(thisBar);

                    var percentage = thisBar.find('.edgtf-progress-content').data('percentage'),
                        progressContent = thisBar.find('.edgtf-progress-content');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                });
            });
        }
    }

    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function edgtfInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.edgtf-progress-content').data('percentage'));
        var percent = progressBar.find('.edgtf-progress-number .edgtf-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.edgtf-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }

    /*
    **	Function to close message shortcode
    */
    function edgtfInitMessages(){
        var message = $('.edgtf-message');
        if(message.length){
            message.each(function(){
                var thisMessage = $(this);
                thisMessage.find('.edgtf-close').click(function(e){
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }

    /*
    **	Init message height
    */
    function edgtfInitMessageHeight(){
       var message = $('.edgtf-message.edgtf-with-icon');
       if(message.length){
           message.each(function(){
               var thisMessage = $(this);
               var textHolderHeight = thisMessage.find('.edgtf-message-text-holder').height();
               var iconHolderHeight = thisMessage.find('.edgtf-message-icon-holder').height();

               if(textHolderHeight > iconHolderHeight) {
                   thisMessage.find('.edgtf-message-icon-holder').height(textHolderHeight);
               } else {
                   thisMessage.find('.edgtf-message-text-holder').height(iconHolderHeight);
               }
           });
       }
    }

    /**
     * Countdown Shortcode
     */
    function edgtfInitCountdown() {

        var countdowns = $('.edgtf-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px'
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var edgtfIcon = edgtf.modules.shortcodes.edgtfIcon = function() {
        //get all icons on page
        var icons = $('.edgtf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('edgtf-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.edgtf-icon-animation-holder').addClass('edgtf-icon-animation-show');
                }, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.edgtf-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var edgtfSocialIconWidget = edgtf.modules.shortcodes.edgtfSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.edgtf-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');
                if(typeof icon.data('original-color') !== 'undefined') {
                    originalColor = icon.data('original-color');
                }

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function edgtfInitTestimonials(){

        var testimonial = $('.edgtf-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var theseTestimonials = $(this).filter(':not(.edgtf-single-testimonial)'),
                    testimonialsHolder = $(this).closest('.edgtf-testimonials-holder'),
                    numberOfItems,
                    numberOfItemsTablet,
                    numberOfItemsMobile,
                    itemMargin,
                    animationSpeed = 900,
                    dragGrab,
                    touchDrag = true,
                    allowFlag = true;

                //slider or classic
                if (theseTestimonials.hasClass('edgtf-testimonials-slider')) {
                    numberOfItems = 1;
                    numberOfItemsTablet = 1;
                    numberOfItemsMobile = 1;
                    itemMargin = 0;
                    dragGrab = false;
                    touchDrag = false;
                }


                // classic
                if (theseTestimonials.hasClass('edgtf-testimonials-classic')) {
                    numberOfItems = 1;
                    numberOfItemsTablet = 1;
                    numberOfItemsMobile = 1;
                    itemMargin = 0;
                    dragGrab = true;
                }

                //carousel
                if (theseTestimonials.hasClass('edgtf-testimonials-carousel')) {
                    if(typeof theseTestimonials.data('visible-items') !== 'undefined' && theseTestimonials.data('visible-items') !== false) {
                        numberOfItems = theseTestimonials.data('visible-items');
                    }
                    else {
                        numberOfItems = 3;
                    }
                    numberOfItemsTablet = 2;
                    numberOfItemsMobile = 1;
                    itemMargin = 60;
                    dragGrab = true;
                }

                //get animation speed
                if(typeof theseTestimonials.data('animation-speed') !== 'undefined' && theseTestimonials.data('animation-speed') !== false) {
                    animationSpeed = theseTestimonials.data('animation-speed');
                }

                //get navigation
                if (theseTestimonials.hasClass('edgtf-testimonials-navigation')) {

                    // Go to the next item
                    theseTestimonials.parent().parent().parent().find('.edgtf-tes-nav-next').click(function (e) {
                        e.preventDefault();
                        if(allowFlag) {

                            allowFlag = false;
                            owl.trigger('next.owl.carousel');

                            // only for slider
                            if (theseTestimonials.hasClass('edgtf-testimonials-slider')) {
                                owlImageDots.trigger('next.owl.carousel');
                            }

                            setTimeout(function(){
                                allowFlag = true;
                            }, 900);
                        }
                    });
                    // Go to the previous item
                    theseTestimonials.parent().parent().parent().find('.edgtf-tes-nav-prev').click(function (e) {
                        e.preventDefault();
                        if(allowFlag) {

                            allowFlag = false;
                            owl.trigger('prev.owl.carousel');

                            // only for slider
                            if (theseTestimonials.hasClass('edgtf-testimonials-slider')) {
                                owlImageDots.trigger('prev.owl.carousel');
                            }

                            setTimeout(function(){
                                allowFlag = true;
                            }, 900);
                        }
                    });
                }


                var owl = theseTestimonials.owlCarousel({
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:numberOfItemsMobile,
                        },
                        768:{
                            items:numberOfItemsTablet,
                        },
                        1000:{
                            items:numberOfItems,
                        }
                    },
                    margin:itemMargin,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    smartSpeed: animationSpeed,
                    loop: true,
                    nav: false,
                    info: true,
                    mouseDrag: dragGrab,
                    touchDrag: touchDrag,
                    autoplayHoverPause: false,

                    onInitialized: function() {
                        edgtfAppear();
                    }
                });

                //callback function to show testimonials
                function edgtfAppear() {
                    testimonialsHolder.css('visibility','visible');
                    testimonialsHolder.animate({opacity:1},300);
                }

                //carousel additional image slider
                if (theseTestimonials.hasClass('edgtf-testimonials-slider')) {
                    var imageDots = $('.edgtf-tes-image-nav');

                    var owlImageDots = imageDots.owlCarousel({
                        autoplay: true,
                        autoplayTimeout: 5000,
                        smartSpeed: animationSpeed,
                        center: true,
                        loop: true,
                        mouseDrag: dragGrab,
                        autoplayHoverPause: false,
                        touchDrag: touchDrag,
                        responsive:{
                            480:{
                                items:3,
                            },
                            0:{
                                items:1,
                            },
                        },
                    });

                }

            });

        }

    }


    /**
     * Init Carousel shortcode
     */
    function edgtfInitCarousels() {

        var carouselHolders = $('.edgtf-carousel-holder'),
            carousel,
            numberOfItems,
            pagination;

            setTimeout(function(){
                carouselHolders.addClass('edgtf-appeared');
            },300);

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                carousel = $(this).children('.edgtf-carousel');
                numberOfItems = carousel.data('items');
                pagination = false;

                if(carousel.data('pagination') === 'yes') {
                    pagination = true;
                }

                //Responsive breakpoints
                var items = numberOfItems;

                var responsiveItems1 = 3;
                var responsiveItems2 = 2;
                var responsiveItems3 = 1;

                if (items < 3) {
                    responsiveItems1 = items;
                }

                if (items < 2) {
                    responsiveItems2 = items;
                }

                carousel.owlCarousel({
                    autoplay:true,
                    autoplayTimeout:3000,
                    itemsCustom: items,
                    loop:true,
                    dots: pagination,
                    nav: false,
                    margin:60,
                    smartSpeed: 800,
                    responsive:{
                        1201:{
                            items: items
                        },
                        769:{
                            items: responsiveItems1
                        },
                        481:{
                            items: responsiveItems2
                        },
                        0:{
                            items: responsiveItems3
                        }
                    }
                });

            });
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function edgtfInitPieChart() {

        var pieCharts = $('.edgtf-pie-chart-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.edgtf-percentage'),
                    barColor = '#202020',
                    trackColor,
                    lineWidth,
                    size = 192;

                if(typeof percentageHolder.data('bar-color') !== 'undefined' && percentageHolder.data('bar-color') !== '') {
                    barColor = percentageHolder.data('bar-color');
                }

                if(typeof percentageHolder.data('track-color') !== 'undefined' && percentageHolder.data('track-color') !== '') {
                    trackColor = percentageHolder.data('track-color');
                }

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }
    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.edgtf-to-counter-inner'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });
    }

    /*
    **	Init tabs shortcode
    */
    function edgtfInitTabs(){

       var tabs = $('.edgtf-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this);

                thisTabs.children('.edgtf-tab-container').each(function(index){
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.edgtf-tabs-nav li:nth-child('+index+') a'),
                        navLink = navItem.attr('href');

                        link = '#'+link;

                        if(link.indexOf(navLink) > -1) {
                            navItem.attr('href',link);
                        }
                });

                if(thisTabs.hasClass('edgtf-horizontal-tab')){
                    thisTabs.tabs();
                } else if(thisTabs.hasClass('edgtf-vertical-tab')){
                    thisTabs.tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
                    thisTabs.find('.edgtf-tabs-nav > ul >li').removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var edgtfButton = edgtf.modules.shortcodes.edgtfButton = function() {
        //all buttons on the page
        var buttons = $('.edgtf-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };

        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };

	/*
	**	Custom Font resizing
	*/
	function edgtfCustomFontResize(){
		var customFont = $('.edgtf-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (edgtf.windowWidth < 1480){
					coef1 = 0.8;
				}

				if (edgtf.windowWidth < 1200){
					coef1 = 0.7;
				}

				if (edgtf.windowWidth < 768){
					coef1 = 0.55;
					coef2 = 0.65;
				}

				if (edgtf.windowWidth < 600){
					coef1 = 0.45;
					coef2 = 0.55;
				}

				if (edgtf.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && edgtf.windowWidth < 1440) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && edgtf.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function edgtfShowGoogleMap(){

        if($('.edgtf-google-map').length){
            $('.edgtf-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "edgtf-map-"+ uniqueId;

                edgtfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }

    /*
     **	Init Google Map
     */
    function edgtfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'edgtf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Edge Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edgtf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('edgtf-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            edgtfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function edgtfInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function edgtfInitAccordions(){
        var accordion = $('.edgtf-accordion-holder');
        if(accordion.length){
            accordion.each(function(){

               var thisAccordion = $(this);

				if(thisAccordion.hasClass('edgtf-accordion')){

					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('edgtf-toggle')){

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.edgtf-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
                    toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
            });
        }
    }

    function edgtfInitImageGallery() {

        var galleries = $('.edgtf-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.edgtf-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                gallery.owlCarousel({
                    autoplay: true,
                    autoplayTimeout: autoplay * 1000,
                    items: 1,
                    loop: true,
                    animateIn : animation, //fade, fadeUp, backSlide, goDown
                    nav: navigation,
                    dots: pagination,
                    smartSpeed: 600,
                    navText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-icon-linea-icon icon-arrows-slim-left"></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-icon-linea-icon icon-arrows-slim-right"></span></span>'
                    ]
                });

            });
        }
    }

    function edgtfInitTeamCarousel() {

        var teamCarousels = $('.edgtf-team-carousel-holder');

        if (teamCarousels.length) {
            teamCarousels.each(function () {
                var teamCarousel = $(this).children('.edgtf-team-carousel-inner'),
                    speed = (teamCarousel.data('speed') !== '') ? parseInt(teamCarousel.data('speed')) : 5000,
                    items = (teamCarousel.data('items') !== '') ? parseInt(teamCarousel.data('items')) : 4,
                    navigation = teamCarousel.data('navigation'),
                    currentItem,
                    autoplayPause = false,
                    dotsHolder,
                    numberOfSlides,
                    dotsHTML = '',
                    newIndex = '';

                teamCarousel.css('visibility', 'visible');
                teamCarousel.animate({opacity:1},600,'easeOutSine');

                var responsiveItems1 = 3;
                var responsiveItems2 = 2;

                if(teamCarousel.siblings('.edgtf-cta-controls'.length)) {
                    autoplayPause = true;
                }

                if (items < 3) {
                    responsiveItems1 = items;
                    responsiveItems2 = items;
                }

                var owl = teamCarousel.owlCarousel({
                    autoplay: true,
                    autoplayTimeout: speed,
                    autoplayHoverPause: autoplayPause,
                    smartSpeed: 600,
                    items: items,
                    margin: 25,
                    loop: true,
                    dots: true,
                    nav: false,
                    responsive:{
                        1024:{
                            items: items
                        },
                        768:{
                            items: responsiveItems1
                        },
                        600:{
                            items: responsiveItems2
                        },
                        0:{
                            items: 1
                        }
                    }
                });

                if (autoplayPause === true) {
                    teamCarousel.closest('.edgtf-team-carousel-holder').mouseenter(function(){
                        teamCarousel.trigger('stop.owl.autoplay');
                    });
                    teamCarousel.closest('.edgtf-team-carousel-holder').mouseleave(function(){
                        teamCarousel.trigger('play.owl.autoplay');
                    });
                }

                if(navigation === 'next-prev') {
                    // Go to the next item
                    teamCarousel.parent().find('.edgtf-tc-nav-next').click(function (e) {
                        e.preventDefault();
                        teamCarousel.trigger('next.owl.carousel');
                    });
                    // Go to the previous item
                    teamCarousel.parent().find('.edgtf-tc-nav-prev').click(function (e) {
                        e.preventDefault();
                        teamCarousel.trigger('prev.owl.carousel');
                    });
                }

                if(navigation === 'paging') {
                    dotsHolder = teamCarousel.parent().children('.edgtf-tc-dots'),
                    numberOfSlides = teamCarousel.find('.owl-item:not(.cloned)').length;

                    for(var i = 0; i < Math.ceil(numberOfSlides/items); i++){
                        dotsHTML += '<div class="edgtf-tc-dot';
                        if(i === 0) {
                            dotsHTML += ' active';
                        }
                        dotsHTML += '"><span></span></div>';
                    }

                    dotsHolder.html(dotsHTML);

                    // Go to specific item
                    teamCarousel.parent().find('.edgtf-tc-dot').click(function (e) {
                        e.preventDefault();
                        newIndex = teamCarousel.parent().find('.edgtf-tc-dot').index($(this));
                        teamCarousel.trigger('to.owl.carousel', newIndex);
                    });

                    owl.on('changed.owl.carousel', function(event) {
                        currentItem = event.page.index + 1;

                        dotsHolder.children().removeClass('active');
                        dotsHolder.children(':nth-child('+currentItem+')').addClass('active');
                    });

                }

            });
        }
    }

    /**
     * Button object that initializes call to action slider
     * @type {Function}
     */
    var edgtfCallToActionSlider = edgtf.modules.shortcodes.edgtfCallToActionSlider = function() {
        var callToActionSlider = $('.edgtf-call-to-action-slider > .edgtf-call-to-action-slider-inner');

        /**
         * Initializes call to action slider
         * @param ctaSlider current slider
         */
        var callToActionSliderInit = function(ctaSlider) {
                var speed = (ctaSlider.data('speed') !== '') ? parseInt(ctaSlider.data('speed')) : 5000,
                    navigation = ctaSlider.data('navigation'),
                    currentItem,
                    dotsHolder,
                    numberOfSlides,
                    dotsHTML = '',
                    newIndex = '',
                    animationOut,
                    animationIn,
                    autoplayPause = false;

            if (callToActionSlider.siblings('.edgtf-cta-controls').length) {
                autoplayPause = true;
            }

            animationOut = (navigation == 'paging') ? 'fadeOutRight' : false;
            animationIn = (navigation == 'paging') ? 'fadeInLeft' : false; //animate.css

            var owl = ctaSlider.owlCarousel({
                autoplay: true,
                autoplayTimeout: speed,
                smartSpeed: 600,
                items: 1,
                loop: true,
                dots: true,
                nav: false,
                info: true,
                autoplayHoverPause:autoplayPause,
                animateOut: animationOut,
                animateIn: animationIn
            });

            if (autoplayPause === true) {
                callToActionSlider.closest('.edgtf-call-to-action-slider').mouseenter(function(){
                    ctaSlider.trigger('stop.owl.autoplay');
                });
                callToActionSlider.closest('.edgtf-call-to-action-slider').mouseleave(function(){
                    ctaSlider.trigger('play.owl.autoplay');
                });
            }

            if(navigation === 'next-prev') {
                // Go to the next item
                ctaSlider.parent().find('.edgtf-cta-nav-next').click(function (e) {
                    e.preventDefault();
                    ctaSlider.trigger('next.owl.carousel');
                });
                // Go to the previous item
                ctaSlider.parent().find('.edgtf-cta-nav-prev').click(function (e) {
                    e.preventDefault();
                    ctaSlider.trigger('prev.owl.carousel');
                });
            }

            if(navigation === 'paging') {
                dotsHolder = ctaSlider.parent().children('.edgtf-cta-dots'),
                numberOfSlides = ctaSlider.find('.owl-item:not(.cloned)').length;

                for(var i = 0; i < numberOfSlides; i++){
                    dotsHTML += '<div class="edgtf-cta-dot';
                    if(i === 0) {
                        dotsHTML += ' active';
                    }
                    dotsHTML += '"><span></span></div>';
                }

                dotsHolder.html(dotsHTML);

                // Go to specific item
                ctaSlider.parent().find('.edgtf-cta-dot').click(function (e) {
                    e.preventDefault();
                    newIndex = ctaSlider.parent().find('.edgtf-cta-dot').index($(this));
                    ctaSlider.trigger('to.owl.carousel', newIndex);
                });

                owl.on('changed.owl.carousel', function(event) {
                    currentItem = event.page.index + 1;

                    dotsHolder.children().removeClass('active');
                    dotsHolder.children(':nth-child('+currentItem+')').addClass('active');
                });

            }

            ctaSlider.css('visibility', 'visible');

        };

        return {
            init: function() {
                if(callToActionSlider.length) {
                    callToActionSlider.each(function() {
                        callToActionSliderInit($(this));
                    });
                }
            }
        };
    };

    /**
     * Slider object that initializes whole slider functionality
     * @type {Function}
     */
    var edgtfSlider = edgtf.modules.shortcodes.edgtfSlider = function() {

        //all sliders on the page
        var sliders = $('.edgtf-slider .carousel');
        //image regex used to extract img source
        var imageRegex = /url\(["']?([^'")]+)['"]?\)/;

        /*** Functionality for translating image in slide - START ***/

        var matrixArray = { zoom_center : '1.2, 0, 0, 1.2, 0, 0', zoom_top_left: '1.2, 0, 0, 1.2, -150, -150', zoom_top_right : '1.2, 0, 0, 1.2, 150, -150', zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150', zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'};

        // regular expression for parsing out the matrix components from the matrix string
        var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

        // parses a matrix string of the form "matrix(n1,n2,n3,n4,n5,n6)" and
        // returns an array with the matrix components
        var parseMatrix = function (val) {
            return val.match(matrixRE)[0].substr(1).
                split(",").map(function (s) {
                    return parseFloat(s);
                });
        };

        // transform css property names with vendor prefixes;
        // the plugin will check for values in the order the names are listed here and return as soon as there
        // is a value; so listing the W3 std name for the transform results in that being used if its available
        var transformPropNames = [
            "transform",
            "-webkit-transform"
        ];

        var getTransformMatrix = function (el) {
            // iterate through the css3 identifiers till we hit one that yields a value
            var matrix = null;
            transformPropNames.some(function (prop) {
                matrix = el.css(prop);
                return (matrix !== null && matrix !== "");
            });

            // if "none" then we supplant it with an identity matrix so that our parsing code below doesn't break
            matrix = (!matrix || matrix === "none") ?
                "matrix(1,0,0,1,0,0)" : matrix;
            return parseMatrix(matrix);
        };

        // set the given matrix transform on the element; note that we apply the css transforms in reverse order of how its given
        // in "transformPropName" to ensure that the std compliant prop name shows up last
        var setTransformMatrix = function (el, matrix) {
            var m = "matrix(" + matrix.join(",") + ")";
            for (var i = transformPropNames.length - 1; i >= 0; --i) {
                el.css(transformPropNames[i], m + ' rotate(0.01deg)');
            }
        };

        // interpolates a value between a range given a percent
        var interpolate = function (from, to, percent) {
            return from + ((to - from) * (percent / 100));
        };

        $.fn.transformAnimate = function (opt) {
            // extend the options passed in by caller
            var options = {
                transform: "matrix(1,0,0,1,0,0)"
            };
            $.extend(options, opt);

            // initialize our custom property on the element to track animation progress
            this.css("percentAnim", 0);

            // supplant "options.step" if it exists with our own routine
            var sourceTransform = getTransformMatrix(this);
            var targetTransform = parseMatrix(options.transform);
            options.step = function (percentAnim, fx) {
                // compute the interpolated transform matrix for the current animation progress
                var $this = $(this);
                var matrix = sourceTransform.map(function (c, i) {
                    return interpolate(c, targetTransform[i],
                        percentAnim);
                });

                // apply the new matrix
                setTransformMatrix($this, matrix);

                // invoke caller's version of "step" if one was supplied;
                if (opt.step) {
                    opt.step.apply(this, [matrix, fx]);
                }
            };

            // animate!
            return this.stop().animate({ percentAnim: 100 }, options);
        };

        /*** Functionality for translating image in slide - END ***/


        /**
         * Calculate heights for slider holder and slide item, depending on window width, but only if slider is set to be responsive
         * @param slider, current slider
         * @param defaultHeight, default height of slider, set in shortcode
         * @param responsive_breakpoint_set, breakpoints set for slider responsiveness
         * @param reset, boolean for reseting heights
         */
        var setSliderHeight = function(slider, defaultHeight, responsive_breakpoint_set, reset) {
            var sliderHeight = defaultHeight;
            if(!reset) {
                if(edgtf.windowWidth > responsive_breakpoint_set[0]) {
                    sliderHeight = defaultHeight;
                } else if(edgtf.windowWidth > responsive_breakpoint_set[1]) {
                    sliderHeight = defaultHeight * 0.7;
                } else if(edgtf.windowWidth > responsive_breakpoint_set[2]) {
                    sliderHeight = defaultHeight * 0.6;
                } else if(edgtf.windowWidth > responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.55;
                } else if(edgtf.windowWidth <= responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.45;
                }
            }

            slider.css({'height': (sliderHeight) + 'px'});
            slider.find('.edgtf-slider-preloader').css({'height': (sliderHeight) + 'px'});
            slider.find('.edgtf-slider-preloader .edgtf-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (sliderHeight) + 'px'});
            if(edgtfPerPageVars.vars.edgtfStickyScrollAmount === 0) {
                edgtf.modules.header.stickyAppearAmount = sliderHeight; //set sticky header appear amount if slider there is no amount entered on page itself
            }
        };

        /**
         * Calculate heights for slider holder and slide item, depending on window size, but only if slider is set to be full height
         * @param slider, current slider
         */
        var setSliderFullHeight = function(slider) {
            var mobileHeaderHeight = edgtf.windowWidth < 1000 ? edgtfGlobalVars.vars.edgtfMobileHeaderHeight + $('.edgtf-top-bar').height() : 0;
            slider.css({'height': (edgtf.windowHeight - mobileHeaderHeight) + 'px'});
            slider.find('.edgtf-slider-preloader').css({'height': (edgtf.windowHeight - mobileHeaderHeight) + 'px'});
            slider.find('.edgt-slider-preloader .edgtf-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (edgtf.windowHeight - mobileHeaderHeight) + 'px'});
            if(edgtfPerPageVars.vars.edgtfStickyScrollAmount === 0) {
                edgtf.modules.header.stickyAppearAmount = edgtf.windowHeight; //set sticky header appear amount if slider there is no amount entered on page itself
            }
        };

        var setElementsResponsiveness = function(slider) {
            // Basic text styles responsiveness
            slider
            .find('.edgtf-slide-element-text-small, .edgtf-slide-element-text-normal, .edgtf-slide-element-text-large, .edgtf-slide-element-text-extra-large')
            .each(function() {
                var element = $(this);
                if (typeof element.data('default-font-size') === 'undefined') { element.data('default-font-size', parseInt(element.css('font-size'),10)); }
                if (typeof element.data('default-line-height') === 'undefined') { element.data('default-line-height', parseInt(element.css('line-height'),10)); }
                if (typeof element.data('default-letter-spacing') === 'undefined') { element.data('default-letter-spacing', parseInt(element.css('letter-spacing'),10)); }
            }); 
            // Advanced text styles responsiveness
            slider.find('.edgtf-slide-element-responsive-text').each(function() {
                if (typeof $(this).data('default-font-size') === 'undefined') { $(this).data('default-font-size', parseInt($(this).css('font-size'),10)); }
                if (typeof $(this).data('default-line-height') === 'undefined') { $(this).data('default-line-height', parseInt($(this).css('line-height'),10)); }
                if (typeof $(this).data('default-letter-spacing') === 'undefined') { $(this).data('default-letter-spacing', parseInt($(this).css('letter-spacing'),10)); }
            });  
            // Button responsiveness
            slider.find('.edgtf-slide-element-responsive-button').each(function() {
                if (typeof $(this).data('default-font-size') === 'undefined') { $(this).data('default-font-size', parseInt($(this).find('a').css('font-size'),10)); }
                if (typeof $(this).data('default-line-height') === 'undefined') { $(this).data('default-line-height', parseInt($(this).find('a').css('line-height'),10)); }
                if (typeof $(this).data('default-letter-spacing') === 'undefined') { $(this).data('default-letter-spacing', parseInt($(this).find('a').css('letter-spacing'),10)); }
                if (typeof $(this).data('default-padding-top') === 'undefined') { $(this).data('default-padding-top', parseInt($(this).find('a').css('padding-top'),10)); }
                if (typeof $(this).data('default-padding-bottom') === 'undefined') { $(this).data('default-padding-bottom', parseInt($(this).find('a').css('padding-bottom'),10)); }
                if (typeof $(this).data('default-padding-left') === 'undefined') { $(this).data('default-padding-left', parseInt($(this).find('a').css('padding-left'),10)); }
                if (typeof $(this).data('default-padding-right') === 'undefined') { $(this).data('default-padding-right', parseInt($(this).find('a').css('padding-right'),10)); }
            }); 
            // Margins for non-custom layouts
            slider.find('.edgtf-slide-element').each(function() {
                var element = $(this);
                if (typeof element.data('default-margin-top') === 'undefined') { element.data('default-margin-top', parseInt(element.css('margin-top'),10)); }
                if (typeof element.data('default-margin-bottom') === 'undefined') { element.data('default-margin-bottom', parseInt(element.css('margin-bottom'),10)); }
                if (typeof element.data('default-margin-left') === 'undefined') { element.data('default-margin-left', parseInt(element.css('margin-left'),10)); }
                if (typeof element.data('default-margin-right') === 'undefined') { element.data('default-margin-right', parseInt(element.css('margin-right'),10)); }
            }); 
            adjustElementsSizes(slider);
        };

        var adjustElementsSizes = function(slider) {
            var boundaries = {
                // These values must match those in map.php (for slider), slider.php and edgt.layout.inc
                mobile: 600,
                tabletp: 800,
                tabletl: 1024,
                laptop: 1440
            };
            slider.find('.edgtf-slider-elements-container').each(function() {
                var container = $(this);
                var target = container.filter('.edgtf-custom-elements').add(container.not('.edgtf-custom-elements').find('.edgtf-slider-elements-holder-frame')).not('.edgtf-grid');
                if (target.length) {
                    if (boundaries.mobile >= edgtf.windowWidth && container.attr('data-width-mobile').length) {
                        target.css('width', container.data('width-mobile') + '%');
                    }
                    else if (boundaries.tabletp >= edgtf.windowWidth && container.attr('data-width-tablet-p').length) {
                        target.css('width', container.data('width-tablet-p') + '%');
                    }
                    else if (boundaries.tabletl >= edgtf.windowWidth && container.attr('data-width-tablet-l').length) {
                        target.css('width', container.data('width-tablet-l') + '%');
                    }
                    else if (boundaries.laptop >= edgtf.windowWidth && container.attr('data-width-laptop').length) {
                        target.css('width', container.data('width-laptop') + '%');
                    }
                    else if (container.attr('data-width-desktop').length){
                        target.css('width', container.data('width-desktop') + '%');
                    }
                }
            });
            slider.find('.item').each(function() {
                var slide = $(this);
                var def_w = slide.find('.edgtf-slider-elements-holder-frame').data('default-width');
                var elements = slide.find('.edgtf-slide-element');

                // Adjusting margins for all elements
                elements.each(function() {
                    var element = $(this);
                    var def_m_top = element.data('default-margin-top'),
                        def_m_bot = element.data('default-margin-bottom'),
                        def_m_l = element.data('default-margin-left'),
                        def_m_r = element.data('default-margin-right'),
                        scale_data = (typeof element.data('resp-scale') !== 'undefined') ? element.data('resp-scale') : undefined,
                        factor;

                    if (boundaries.mobile >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.mobile);
                    }
                    else if (boundaries.tabletp >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletp);
                    }
                    else if (boundaries.tabletl >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletl);
                    }
                    else if (boundaries.laptop >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.laptop);
                    }
                    else {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.desktop);
                    }

                    element.css({
                        'margin-top': Math.round(factor * def_m_top )+ 'px',
                        'margin-bottom': Math.round(factor * def_m_bot )+ 'px',
                        'margin-left': Math.round(factor * def_m_l )+ 'px',
                        'margin-right': Math.round(factor * def_m_r) + 'px'
                    });
                });
                
                // Adjusting responsiveness
                elements
                .filter('.edgtf-slide-element-responsive-text, .edgtf-slide-element-responsive-button, .edgtf-slide-element-responsive-image')
                .add(elements.find('a.edgtf-slide-element-responsive-text, span.edgtf-slide-element-responsive-text'))
                .each(function() {
                    var element = $(this);
                    var scale_data = (typeof element.data('resp-scale') !== 'undefined') ? element.data('resp-scale') : undefined,
                        left_data = (typeof element.data('resp-left') !== 'undefined') ? element.data('resp-left') : undefined,
                        top_data = (typeof element.data('resp-top') !== 'undefined') ? element.data('resp-top') : undefined;
                    var factor, new_left, new_top;

                    if (boundaries.mobile >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.mobile);
                        new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.mobile !== '' ? left_data.mobile+'%' : element.data('left')+'%');
                        new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.mobile !== '' ? top_data.mobile+'%' : element.data('top')+'%');
                    }
                    else if (boundaries.tabletp >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletp);
                        new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.tabletp !== '' ? left_data.tabletp+'%' : element.data('left')+'%');
                        new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.tabletp !== '' ? top_data.tabletp+'%' : element.data('top')+'%');
                    }
                    else if (boundaries.tabletl >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletl);
                        new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.tabletl !== '' ? left_data.tabletl+'%' : element.data('left')+'%');
                        new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.tabletl !== '' ? top_data.tabletl+'%' : element.data('top')+'%');
                    }
                    else if (boundaries.laptop >= edgtf.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.laptop);
                        new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.laptop !== '' ? left_data.laptop+'%' : element.data('left')+'%');
                        new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.laptop !== '' ? top_data.laptop+'%' : element.data('top')+'%');
                    }
                    else {
                        factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.desktop);
                        new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.desktop !== '' ? left_data.desktop+'%' : element.data('left')+'%');
                        new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.desktop !== '' ? top_data.desktop+'%' : element.data('top')+'%');
                    }

                    if (!factor) {
                        element.hide();
                    }
                    else {
                        element.show();

                        var def_font_size,
                            def_line_h,
                            def_let_spac,
                            def_pad_top,
                            def_pad_bottom,
                            def_pad_left,
                            def_pad_right;

                        if (element.is('.edgtf-slide-element-responsive-button')) {
                            def_font_size = element.data('default-font-size');
                            def_line_h = element.data('default-line-height');
                            def_let_spac = element.data('default-letter-spacing');
                            def_pad_top = element.data('default-padding-top');
                            def_pad_bottom = element.data('default-padding-bottom');
                            def_pad_left = element.data('default-padding-left');
                            def_pad_right = element.data('default-padding-right');

                            element.css({
                                'left': new_left,
                                'top': new_top
                            })
                            .find('.edgtf-btn').css({
                                'font-size': Math.round(factor * def_font_size) + 'px',
                                'line-height': Math.round(factor * def_line_h) + 'px',
                                'letter-spacing': Math.round(factor * def_let_spac) + 'px',
                                'padding-left': Math.round(factor * def_pad_left) + 'px',
                                'padding-right': Math.round(factor * def_pad_right) + 'px',
                                'padding-top': Math.round(factor * def_pad_top) + 'px',
                                'padding-bottom': Math.round(factor * def_pad_bottom) + 'px'
                            });
                        }
                        else if (element.is('.edgtf-slide-element-responsive-image')) {
                            if (factor != edgtf.windowWidth / def_w) { // if custom factor has been set for this screen width
                                var up_w = element.data('upload-width'),
                                    up_h = element.data('upload-height');

                                element.filter('.custom-image').css({
                                    'left': new_left,
                                    'top': new_top
                                })
                                .add(element.not('.custom-image').find('img'))
                                .css({
                                    'width': Math.round(factor * up_w) + 'px',
                                    'height': Math.round(factor * up_h) + 'px'
                                });
                            }
                            else {
                                var w = element.data('width');

                                element.filter('.custom-image').css({
                                    'left': new_left,
                                    'top': new_top
                                })
                                .add(element.not('.custom-image').find('img'))
                                .css({
                                    'width': w + '%',
                                    'height': ''
                                });
                            }
                        }
                        else {
                            def_font_size = element.data('default-font-size');
                            def_line_h = element.data('default-line-height');
                            def_let_spac = element.data('default-letter-spacing');

                            element.css({
                                'left': new_left,
                                'top': new_top,
                                'font-size': Math.round(factor * def_font_size) + 'px',
                                'line-height': Math.round(factor * def_line_h) + 'px',
                                'letter-spacing': Math.round(factor * def_let_spac) + 'px' 
                            });
                        }
                    }
                }); 
            });
            var nav = slider.find('.carousel-indicators');
            slider.find('.edgtf-slide-element-section-link').css('bottom', nav.length ? parseInt(nav.css('bottom'),10) + nav.outerHeight() + 10 + 'px' : '20px');
        };

        var checkButtonsAlignment = function(slider) {
            slider.find('.item').each(function() {
                var inline_buttons = $(this).find('.edgtf-slide-element-button-inline');
                inline_buttons.css('display', 'inline-block').wrapAll('<div class="edgtf-slide-elements-buttons-wrapper" style="text-align: ' + inline_buttons.eq(0).css('text-align') + ';"/>');
            });
        };

        /**
         * Set heights for slider and elemnts depending on slider settings (full height, responsive height od set height)
         * @param slider, current slider
         */
        var setHeights =  function(slider) {

            var responsiveBreakpointSet = [1600,1200,900,650,500,320];
            var defaultHeight;

            setElementsResponsiveness(slider);

            if(slider.hasClass('edgtf-full-screen')){

                setSliderFullHeight(slider);

                $(window).resize(function() {
                    setSliderFullHeight(slider);
                    adjustElementsSizes(slider);
                });

            }else if(slider.hasClass('edgtf-responsive-height')){

                defaultHeight = slider.data('height');
                setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);

                $(window).resize(function() {
                    setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                    adjustElementsSizes(slider);
                });

            }else {
                defaultHeight = slider.data('height');

                slider.find('.edgtf-slider-preloader').css({'height': (slider.height()) + 'px'});
                slider.find('.edgtf-slider-preloader .edgtf-ajax-loader').css({'display': 'block'});

                edgtf.windowWidth < 1000 ? setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false) : setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);

                $(window).resize(function() {
                    if(edgtf.windowWidth < 1000){
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                    }else{
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);
                    }
                    adjustElementsSizes(slider);
                });
            }
        };

        /**
         * Set prev/next numbers on navigation arrows
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         */
        var setPrevNextNumbers = function(slider, currentItem, totalItemCount) {
            if(currentItem == 1){
                slider.find('.left.carousel-control .prev').html(totalItemCount);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            }else if(currentItem == totalItemCount){
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(1);
            }else{
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            }
        };

        /**
         * Set video background size
         * @param slider, current slider
         */
        var initVideoBackgroundSize = function(slider){
            var min_w = 1500; // minimum video width allowed
            var video_width_original = 1920;  // original video dimensions
            var video_height_original = 1080;
            var vid_ratio = 1920/1080;

            slider.find('.item .edgtf-video .edgtf-video-wrap').each(function(){

                var slideWidth = edgtf.windowWidth;
                var slideHeight = $(this).closest('.carousel').height();

                $(this).width(slideWidth);

                min_w = vid_ratio * (slideHeight+20);
                $(this).height(slideHeight);

                var scale_h = slideWidth / video_width_original;
                var scale_v = (slideHeight - edgtfGlobalVars.vars.edgtfMenuAreaHeight) / video_height_original;
                var scale =  scale_v;
                if (scale_h > scale_v)
                    scale =  scale_h;
                if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

                $(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
                $(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
                $(this).scrollLeft(($(this).find('video').width() - slideWidth) / 2);
                $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - slideHeight) / 2);
                $(this).scrollTop(($(this).find('video').height() - slideHeight) / 2);
            });
        };

        /**
         * Init video background
         * @param slider, current slider
         */
        var initVideoBackground = function(slider) {
            $('.item .edgtf-video-wrap .edgtf-video-element').mediaelementplayer({
                enableKeyboard: false,
                iPadUseNativeControls: false,
                pauseOtherPlayers: false,
                // force iPhone's native controls
                iPhoneUseNativeControls: false,
                // force Android's native controls
                AndroidUseNativeControls: false
            });

            initVideoBackgroundSize(slider);
            $(window).resize(function() {
                initVideoBackgroundSize(slider);
            });

            //mobile check
            if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
                $('.edgtf-slider .edgtf-mobile-video-image').show();
                $('.edgtf-slider .edgtf-video-wrap').remove();
            }
        };

        var initPeek = function(slider) {
            if (slider.hasClass('edgtf-slide-peek')) {

                var navArrowHover = function(arrow, entered) {
                    var dir = arrow.is('.left') ? 'left' : 'right';
                    var targ_peeker = peekers.filter('.'+dir);
                    if (entered) {
                        arrow.addClass('hovered');
                        var targ_item = (items.index(items.filter('.active')) + (dir=='left' ? -1 : 1) + items.length) % items.length;
                        targ_peeker.find('.edgtf-slider-peeker-inner').css({
                            'background-image': items.eq(targ_item).find('.edgtf-image, .edgtf-mobile-video-image').css('background-image'),
                            'width': itemWidth + 'px'
                        });
                        targ_peeker.addClass('shown');
                    }
                    else {
                        arrow.removeClass('hovered');
                        peekers.removeClass('shown');
                    }
                };

                var navBulletHover = function(bullet, entered) {
                    if (entered) {
                        bullet.addClass('hovered');

                        var targ_item = bullet.data('slide-to');
                        var cur_item = items.index(items.filter('.active'));
                        if (cur_item != targ_item) {
                            var dir = (targ_item < cur_item) ? 'left' : 'right';
                            var targ_peeker = peekers.filter('.'+dir);
                            targ_peeker.find('.edgtf-slider-peeker-inner').css({
                                'background-image': items.eq(targ_item).find('.edgtf-image, .edgtf-mobile-video-image').css('background-image'),
                                'width': itemWidth + 'px'
                            });
                            targ_peeker.addClass('shown');
                        }
                    }
                    else {
                        bullet.removeClass('hovered');
                        peekers.removeClass('shown');
                    }
                };

                var handleResize = function() {
                    itemWidth = items.filter('.active').width();
                    itemWidth += (itemWidth % 2) ? 1 : 0; // To make it even
                    items.children('.edgtf-image, .edgtf-video').css({
                        'position': 'absolute',
                        'width': itemWidth + 'px',
                        'height': '110%',
                        'left': '50%',
                        'transform': 'translateX(-50%)'
                    });
                };

                var items = slider.find('.item');
                var itemWidth;
                handleResize();
                $(window).resize(handleResize);

                slider.find('.carousel-inner').append('<div class="edgtf-slider-peeker left"><div class="edgtf-slider-peeker-inner"></div></div><div class="edgtf-slider-peeker right"><div class="edgtf-slider-peeker-inner"></div></div>');
                var peekers = slider.find('.edgtf-slider-peeker');
                var nav_arrows = slider.find('.carousel-control');
                var nav_bullets = slider.find('.carousel-indicators > li');

                nav_arrows
                .hover(
                    function() {
                        navArrowHover($(this), true);
                    },
                    function() {
                        navArrowHover($(this), false);
                    }
                );

                nav_bullets
                .hover(
                    function() {
                        navBulletHover($(this), true);
                    },
                    function() {
                        navBulletHover($(this), false);
                    }
                );

                slider.on('slide.bs.carousel', function() {
                    setTimeout(function() {
                        peekers.addClass('edgtf-slide-peek-in-progress').removeClass('shown');
                    }, 500);
                });

                slider.on('slid.bs.carousel', function() {
                    nav_arrows.filter('.hovered').each(function() {
                        navArrowHover($(this), true);
                    });
                    setTimeout(function() {
                        nav_bullets.filter('.hovered').each(function() {
                            navBulletHover($(this), true);
                        });
                    }, 200);
                    peekers.removeClass('edgtf-slide-peek-in-progress');
                });
            }
        };

        var updateNavigationThumbs = function(slider) {
            if (slider.hasClass('edgtf-slider-thumbs')) {
                var src, prev_image, next_image;
                var all_items_count = slider.find('.item').length;
                var curr_item = slider.find('.item').index($('.item.active')[0]) + 1;
                setPrevNextNumbers(slider, curr_item, all_items_count);

                // prev thumb
                if(slider.find('.item.active').prev('.item').length){
                    if(slider.find('.item.active').prev('div').find('.edgtf-image').length){
                        src = imageRegex.exec(slider.find('.active').prev('div').find('.edgtf-image').attr('style'));
                        prev_image = new Image();
                        prev_image.src = src[1];
                        //prev_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    }else{
                        prev_image = slider.find('.active').prev('div').find('> .edgtf-video').clone();
                        prev_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
                        prev_image.find('.edgtf-video-wrap').width(150).height(84);
                        prev_image.find('.mejs-container').width(150).height(84);
                        prev_image.find('video').width(150).height(84);
                    }
                    slider.find('.left.carousel-control .img .old').fadeOut(300,function(){
                        $(this).remove();
                    });
                    slider.find('.left.carousel-control .img').append(prev_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');

                }else{
                    if(slider.find('.carousel-inner .item:last-child .edgtf-image').length){
                        src = imageRegex.exec(slider.find('.carousel-inner .item:last-child .edgtf-image').attr('style'));
                        prev_image = new Image();
                        prev_image.src = src[1];
                        //prev_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    }else{
                        prev_image = slider.find('.carousel-inner .item:last-child > .edgtf-video').clone();
                        prev_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
                        prev_image.find('.edgtf-video-wrap').width(150).height(84);
                        prev_image.find('.mejs-container').width(150).height(84);
                        prev_image.find('video').width(150).height(84);
                    }
                    slider.find('.left.carousel-control .img .old').fadeOut(300,function(){
                        $(this).remove();
                    });
                    slider.find('.left.carousel-control .img').append(prev_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');
                }

                // next thumb
                if(slider.find('.active').next('div.item').length){
                    if(slider.find('.active').next('div').find('.edgtf-image').length){
                        src = imageRegex.exec(slider.find('.active').next('div').find('.edgtf-image').attr('style'));
                        next_image = new Image();
                        next_image.src = src[1];
                        //next_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    }else{
                        next_image = slider.find('.active').next('div').find('> .edgtf-video').clone();
                        next_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
                        next_image.find('.edgtf-video-wrap').width(150).height(84);
                        next_image.find('.mejs-container').width(150).height(84);
                        next_image.find('video').width(150).height(84);
                    }

                    slider.find('.right.carousel-control .img .old').fadeOut(300,function(){
                        $(this).remove();
                    });
                    slider.find('.right.carousel-control .img').append(next_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');

                }else{
                    if(slider.find('.carousel-inner .item:first-child .edgtf-image').length){
                        src = imageRegex.exec(slider.find('.carousel-inner .item:first-child .edgtf-image').attr('style'));
                        next_image = new Image();
                        next_image.src = src[1];
                        //next_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    }else{
                        next_image = slider.find('.carousel-inner .item:first-child > .edgtf-video').clone();
                        next_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
                        next_image.find('.edgtf-video-wrap').width(150).height(84);
                        next_image.find('.mejs-container').width(150).height(84);
                        next_image.find('video').width(150).height(84);
                    }
                    slider.find('.right.carousel-control .img .old').fadeOut(300,function(){
                        $(this).remove();
                    });
                    slider.find('.right.carousel-control .img').append(next_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');
                }
            }
        };

        /**
         * initiate slider
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         * @param slideAnimationTimeout, timeout for slide change
         */
        var initiateSlider = function(slider, totalItemCount, slideAnimationTimeout) {

            //set active class on first item
            slider.find('.carousel-inner .item:first-child').addClass('active');
            //check for header style
            edgtfCheckSliderForHeaderStyle($('.carousel .active'), slider.hasClass('edgtf-header-effect'));
            // setting numbers on carousel controls
            if(slider.hasClass('edgtf-slider-numbers')) {
                setPrevNextNumbers(slider, 1, totalItemCount);
            }
            // set video background if there is video slide
            if(slider.find('.item video').length){
                //initVideoBackgroundSize(slider);
                initVideoBackground(slider);
            }

            // update thumbs
            updateNavigationThumbs(slider);

            // initiate peek
            initPeek(slider);

            // enable link hover color for slide elements with links
            slider.find('.edgtf-slide-element-wrapper-link')
            .mouseenter(function() {
                $(this).removeClass('inheriting');
            })
            .mouseleave(function() {
                $(this).addClass('inheriting');
            })
            ;

            //init slider
            if(slider.hasClass('edgtf-auto-start')){
                slider.carousel({
                    interval: slideAnimationTimeout,
                    pause: false
                });

                //pause slider when hover slider button
                slider.find('.slide_buttons_holder .qbutton')
                    .mouseenter(function() {
                        slider.carousel('pause');
                    })
                    .mouseleave(function() {
                        slider.carousel('cycle');
                    });
            } else {
                slider.carousel({
                    interval: 0,
                    pause: false
                });
            }

            $(window).scroll(function() {
                if(slider.hasClass('edgtf-full-screen') && edgtf.scroll > edgtf.windowHeight && edgtf.windowWidth > 1000){
                    slider.carousel('pause');
                }else if(!slider.hasClass('edgtf-full-screen') && edgtf.scroll > slider.height() && edgtf.windowWidth > 1000){
                    slider.carousel('pause');
                }else{
                    slider.carousel('cycle');
                }
            });


            //initiate image animation
            if($('.carousel-inner .item:first-child').hasClass('edgtf-animate-image') && edgtf.windowWidth > 1000){
                slider.find('.carousel-inner .item.edgtf-animate-image:first-child .edgtf-image').transformAnimate({
                    transform: "matrix("+matrixArray[$('.carousel-inner .item:first-child').data('edgtf_animate_image')]+")",
                    duration: 30000
                });
            }
        };

        return {
            init: function() {
                if(sliders.length) {
                    sliders.each(function() {
                        var $this = $(this);
                        var slideAnimationTimeout = $this.data('slide_animation_timeout');
                        var totalItemCount = $this.find('.item').length;
                        var src;
                        var backImg;

                        checkButtonsAlignment($this);

                        setHeights($this);

                        /*** wait until first video or image is loaded and than initiate slider - start ***/
                        if(edgtf.htmlEl.hasClass('touch')){
                            if($this.find('.item:first-child .edgtf-mobile-video-image').length > 0){
                                src = imageRegex.exec($this.find('.item:first-child .edgtf-mobile-video-image').attr('style'));
                            }else{
                                src = imageRegex.exec($this.find('.item:first-child .edgtf-image').attr('style'));
                            }
                            if(src) {
                                backImg = new Image();
                                backImg.src = src[1];
                                $(backImg).load(function(){
                                    $('.edgtf-slider-preloader').fadeOut(500);
                                    initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                });
                            }
                        } else {
                            if($this.find('.item:first-child video').length > 0){
                                $this.find('.item:first-child video').eq(0).one('loadeddata',function(){
                                    $('.edgtf-slider-preloader').fadeOut(500);
                                    initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                });
                            }else{
                                src = imageRegex.exec($this.find('.item:first-child .edgtf-image').attr('style'));
                                if (src) {
                                    backImg = new Image();
                                    backImg.src = src[1];
                                    $(backImg).load(function(){
                                        $('.edgtf-slider-preloader').fadeOut(500);
                                        initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                    });
                                }
                            }
                        }
                        /*** wait until first video or image is loaded and than initiate slider - end ***/

                        /* before slide transition - start */
                        $this.on('slide.bs.carousel', function () {
                            $this.addClass('edgtf-in-progress');
                            $this.find('.active .edgtf-slider-elements-holder-frame, .active .edgtf-slide-element-section-link').fadeTo(250,0);
                        });
                        /* before slide transition - end */

                        /* after slide transition - start */
                        $this.on('slid.bs.carousel', function () {
                            $this.removeClass('edgtf-in-progress');
                            $this.find('.active .edgtf-slider-elements-holder-frame, .active .edgtf-slide-element-section-link').fadeTo(0,1);

                            // setting numbers on carousel controls
                            if($this.hasClass('edgtf-slider-numbers')) {
                                var currentItem = $('.item').index($('.item.active')[0]) + 1;
                                setPrevNextNumbers($this, currentItem, totalItemCount);
                            }

                            // initiate image animation on active slide and reset all others
                            $('.item.edgtf-animate-image .edgtf-image').stop().css({'transform':'', '-webkit-transform':''});
                            if($('.item.active').hasClass('edgtf-animate-image') && edgtf.windowWidth > 1000){
                                $('.item.edgtf-animate-image.active .edgtf-image').transformAnimate({
                                    transform: "matrix("+matrixArray[$('.item.edgtf-animate-image.active').data('edgtf_animate_image')]+")",
                                    duration: 30000
                                });
                            }

                            // setting thumbnails on navigation controls
                            if($this.hasClass('edgtf-slider-thumbs')) {
                                updateNavigationThumbs($this);
                            }
                        });
                        /* after slide transition - end */

                        /* swipe functionality - start */
                        $this.swipe( {
                            swipeLeft: function(){ $this.carousel('next'); },
                            swipeRight: function(){ $this.carousel('prev'); },
                            threshold:20
                        });
                        /* swipe functionality - end */

                    });

                    //adding parallax functionality on slider
                    if($('.no-touch .carousel').length){
                        var skrollr_slider = skrollr.init({
                            smoothScrolling: false,
                            forceHeight: false,
                            easing: { //easing used for parallax sections initialized as well
                                customEase: function(p) {
                                  return 5.295*(p*p*p*p*p) - 18.5325*(p*p*p*p) + 26.08*(p*p*p) - 18.59*(p*p) + 6.7475*p;
                                }
                            }
                        });
                        skrollr_slider.refresh();
                    }

                    $(window).scroll(function(){
                        //set control class for slider in order to change header style
                        if($('.edgtf-slider .carousel').height() < edgtf.scroll){
                            $('.edgtf-slider .carousel').addClass('edgtf-disable-slider-header-style-changing');
                        }else{
                            $('.edgtf-slider .carousel').removeClass('edgtf-disable-slider-header-style-changing');
                            edgtfCheckSliderForHeaderStyle($('.edgtf-slider .carousel .active'),$('.edgtf-slider .carousel').hasClass('edgtf-header-effect'));
                        }

                        //hide slider when it is out of viewport
                        if($('.edgtf-slider .carousel').hasClass('edgtf-full-screen') && edgtf.scroll > edgtf.windowHeight && edgtf.windowWidth > 1000){
                            $('.edgtf-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                        }else if(!$('.edgtf-slider .carousel').hasClass('edgtf-full-screen') && edgtf.scroll > $('.edgtf-slider .carousel').height() && edgtf.windowWidth > 1000){
                            $('.edgtf-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                        }else{
                            $('.edgtf-slider .carousel').find('.carousel-inner, .carousel-indicators').show();
                        }
                    });
                }
            }
        };
    };

    /**
     * Check if slide effect on header style changing
     * @param slide, current slide
     * @param headerEffect, flag if slide
     */
    function edgtfCheckSliderForHeaderStyle(slide, headerEffect) {

        if($('.edgtf-slider .carousel').not('.edgtf-disable-slider-header-style-changing').length > 0) {

            var slideHeaderStyle = "";
            if (slide.hasClass('light')) { slideHeaderStyle = 'edgtf-light-header'; }
            if (slide.hasClass('dark')) { slideHeaderStyle = 'edgtf-dark-header'; }

            if (slideHeaderStyle !== "") {
                if (headerEffect) {
                    edgtf.body.removeClass('edgtf-dark-header edgtf-light-header').addClass(slideHeaderStyle);
                }
            } else {
                if (headerEffect) {
                    edgtf.body.removeClass('edgtf-dark-header edgtf-light-header').addClass(edgtf.defaultHeaderStyle);
                }

            }
        }
    }
    
    /**
     * Button object that initializes icon list with animation
     * @type {Function}
     */
    var edgtfInitIconList = edgtf.modules.shortcodes.edgtfInitIconList = function() {
        var iconList = $('.edgtf-animate-list');

        /**
         * Initializes icon list animation
         * @param list current slider
         */
        var iconListInit = function(list) {
            setTimeout(function(){
                list.appear(function(){
                    list.addClass('edgtf-appeared');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            },30);
        };

        return {
            init: function() {
                if(iconList.length) {
                    iconList.each(function() {
                        iconListInit($(this));
                    });
                }
            }
        };
    };

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function edgtfInitVideo() {

        var videoHolders = $('.edgtf-video-holder');

        if (videoHolders.length) {

            videoHolders.each(function () {
                $(this).css('opacity','1');
            });
        }
    }

    /*
     **  Init sticky sidebar widget
     */
    function edgtfStickySidebarWidget(){

        var sswHolder = $('.edgtf-widget-sticky-sidebar');
        var headerHeightOffset = 0;
        var widgetTopOffset = 0;
        var widgetTopPosition = 0;
        var sidebarHeight = 0;
        var sidebarWidth = 0;
        var objectsCollection = [];

        function addObjectItems() {
            if (sswHolder.length){
                sswHolder.each(function(){
                    var thisSswHolder = $(this);
                    widgetTopOffset = thisSswHolder.offset().top;
                    widgetTopPosition = thisSswHolder.position().top;

                    if (thisSswHolder.parents('aside.edgtf-sidebar').length) {
                        sidebarHeight = thisSswHolder.parents('aside.edgtf-sidebar').outerHeight();
                    } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                        sidebarHeight = thisSswHolder.parents('.wpb_widgetised_column').outerHeight();
                    }

                    if (thisSswHolder.parents('aside.edgtf-sidebar').length) {
                        sidebarWidth = thisSswHolder.parents('aside.edgtf-sidebar').width();
                    } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                        sidebarWidth = thisSswHolder.parents('.wpb_widgetised_column').width();
                    }

                    objectsCollection.push({'object': thisSswHolder, 'offset': widgetTopOffset, 'position': widgetTopPosition, 'height': sidebarHeight, 'width': sidebarWidth});
                });
            }
        }

        function initStickySidebarWidget() {

            if (objectsCollection.length){
                $.each(objectsCollection, function(i){

                    var thisSswHolder = objectsCollection[i]['object'];
                    var thisWidgetTopOffset = objectsCollection[i]['offset'];
                    var thisWidgetTopPosition = objectsCollection[i]['position'];
                    var thisSidebarHeight = objectsCollection[i]['height'];
                    var thisSidebarWidth = objectsCollection[i]['width'];

                    if (edgtf.body.hasClass('edgtf-fixed-on-scroll')) {
                        headerHeightOffset = 42;
                        if ($('.edgtf-fixed-wrapper').hasClass('edgtf-fixed')) {
                            headerHeightOffset = $('.edgtf-fixed-wrapper.edgtf-fixed').height();
                        }
                    } else {
                        headerHeightOffset = $('.edgtf-page-header').height();
                    }

                    if (edgtf.windowWidth > 1024) {

                        var widgetBottomMargin = 40;
                        var sidebarPosition = -(thisWidgetTopPosition - headerHeightOffset - 10);
                        var stickySidebarHeight = thisSidebarHeight - thisWidgetTopPosition - widgetBottomMargin;
                        var stickySidebarRowHolderHeight = 0;
                        if (thisSswHolder.parents('aside.edgtf-sidebar').length) {
                            if(thisSswHolder.parents('.edgtf-content-has-sidebar').children('.edgtf-content-right-from-sidebar').length) {
                                stickySidebarRowHolderHeight = thisSswHolder.parents('.edgtf-content-has-sidebar').children('.edgtf-content-right-from-sidebar').outerHeight();
                            } else {
                                stickySidebarRowHolderHeight = thisSswHolder.parents('.edgtf-content-has-sidebar').children('.edgtf-content-left-from-sidebar').outerHeight();
                            }
                        } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                            stickySidebarRowHolderHeight = thisSswHolder.parents('.vc_row').height();
                        }

                        //move sidebar up when hits the end of section row
                        var rowSectionEndInViewport = thisWidgetTopOffset - headerHeightOffset - thisWidgetTopPosition - edgtfGlobalVars.vars.edgtfTopBarHeight + stickySidebarRowHolderHeight;

                        if ((edgtf.scroll >= thisWidgetTopOffset - headerHeightOffset) && thisSidebarHeight < stickySidebarRowHolderHeight) {
                            if (thisSswHolder.parents('aside.edgtf-sidebar').length) {
                                if(thisSswHolder.parents('aside.edgtf-sidebar').hasClass('edgtf-sticky-sidebar-appeared')) {
                                    thisSswHolder.parents('aside.edgtf-sidebar.edgtf-sticky-sidebar-appeared').css({'top': sidebarPosition+'px'});
                                } else {
                                    thisSswHolder.parents('aside.edgtf-sidebar').addClass('edgtf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px', 'width': thisSidebarWidth, 'margin-top': '-10px'}).animate({'margin-top': '0'}, 200);
                                }
                            } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                                if(thisSswHolder.parents('.wpb_widgetised_column').hasClass('edgtf-sticky-sidebar-appeared')) {
                                    thisSswHolder.parents('.wpb_widgetised_column.edgtf-sticky-sidebar-appeared').css({'top': sidebarPosition+'px'});
                                } else {
                                    thisSswHolder.parents('.wpb_widgetised_column').addClass('edgtf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px', 'width': thisSidebarWidth, 'margin-top': '-10px'}).animate({'margin-top': '0'}, 200);
                                }
                            }

                            if (edgtf.scroll + stickySidebarHeight >= rowSectionEndInViewport) {
                                if (thisSswHolder.parents('aside.edgtf-sidebar').length) {

                                    thisSswHolder.parents('aside.edgtf-sidebar.edgtf-sticky-sidebar-appeared').css({'position': 'absolute', 'top': stickySidebarRowHolderHeight-stickySidebarHeight+sidebarPosition-widgetBottomMargin-headerHeightOffset+'px'});

                                } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {

                                    thisSswHolder.parents('.wpb_widgetised_column.edgtf-sticky-sidebar-appeared').css({'position': 'absolute', 'top': stickySidebarRowHolderHeight-stickySidebarHeight+sidebarPosition-widgetBottomMargin-headerHeightOffset+'px'});
                                }
                            } else {
                                if (thisSswHolder.parents('aside.edgtf-sidebar').length) {

                                    thisSswHolder.parents('aside.edgtf-sidebar.edgtf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px'});

                                } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {

                                    thisSswHolder.parents('.wpb_widgetised_column.edgtf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px'});
                                }
                            }
                        } else {

                            if (thisSswHolder.parents('aside.edgtf-sidebar').length) {
                                thisSswHolder.parents('aside.edgtf-sidebar').removeClass('edgtf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                            } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                                thisSswHolder.parents('.wpb_widgetised_column').removeClass('edgtf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                            }
                        }
                    } else {
                        if (thisSswHolder.parents('aside.edgtf-sidebar').length) {
                            thisSswHolder.parents('aside.edgtf-sidebar').removeClass('edgtf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                        } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                            thisSswHolder.parents('.wpb_widgetised_column').removeClass('edgtf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                        }
                    }
                });
            }
        }

        return {
            init: function() {
                addObjectItems();

                initStickySidebarWidget();

                $(window).scroll(function(){
                    initStickySidebarWidget();
                });
            },
            reInit: initStickySidebarWidget
        };
    }

    /*
    **  Init gallery block shortcodes functionality
    */
    function edgtfInitGalleryBlocks() {
        var item = $('.edgtf-gb-one-holder');

        if(item.length && edgtf.windowWidth > 1024) {
            item.each(function() {
                var thisItem = $(this);
                thisItem.css({'opacity': '1'});

                var thisListItem = thisItem.find('.edgtf-gb-item');

                var minHeight = Math.max.apply(null, thisListItem.map(function(){
                    return $(this).height();
                }).get());

                thisListItem.children('.edgtf-gb-item-inner').css('min-height', minHeight);
            });
        }
    }

    /*
    ** Init Gallery Block Masonry Layout
    */
    function edgtfInitGalleryBlocksMasonry() {

        var container = $('.edgtf-gbm-holder .edgtf-gbm-inner');
        
        if(container.length) {

            container.waitForImages(function() {
                container.isotope({
                    itemSelector: '.edgtf-gbm-item',
                    resizable: false,
                    masonry: {
                        columnWidth: '.edgtf-gbm-grid-sizer',
                        gutter: '.edgtf-gbm-grid-gutter'
                    }
                });
                container.css('opacity', 1);
            });
        }
    }

    /*
    ** Init Product List Shortcode Layout
    */
    function edgtfInitProductListShortcode() {

        var container = $('.edgtf-product-list-holder .edgtf-product-list');
        
        if(container.length) {

            container.waitForImages(function() {
                container.isotope({
                    itemSelector: '.edgtf-pli',
                    resizable: false,
                    masonry: {
                        columnWidth: '.edgtf-product-list-sizer',
                        gutter: '.edgtf-product-list-gutter'
                    }
                });
                container.css('opacity', 1);
            });
        }
    }

    /*
    ** Parallax Sections shortcode
    */
    function edgtfParallaxSections() {
        var parallaxSections = $('.edgtf-parallax-sections');
        if (parallaxSections.length) {
            parallaxSections.each(function(){
                var currentParallaxSections = $(this),
                    parallaxSection = currentParallaxSections.find('>div'),
                    basicParallaxSection = currentParallaxSections.find('.edgtf-parallax-section-basic'),
                    advancedParallaxSection = currentParallaxSections.find('.edgtf-parallax-section-advanced');

                    //basic type setup
                    if (basicParallaxSection.length) {
                        basicParallaxSection.each(function(){
                            var thisSection = $(this);
                            if (!thisSection.hasClass('edgtf-section-height-set')) {
                                thisSection.css('height',Math.round(edgtf.windowHeight * 0.85));
                            }
                        });
                    }

                    //additional type setup
                    if (advancedParallaxSection.length) {
                        advancedParallaxSection.each(function(){

                            var thisSection = $(this);

                            if (!thisSection.hasClass('edgtf-section-height-set')) {
                                thisSection.css('height',edgtf.windowHeight);
                            }

                            //prevent unintentional transform
                            $(window).scroll(function(){
                                resetParallaxPositions();
                            });

                            thisSection.appear(function(){
                                setTimeout(function(){
                                    thisSection.find('.edgtf-additional-image-holder').addClass('edgtf-appeared');
                                },30);
                            },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

                            if (thisSection.hasClass('edgtf-additional-images-scroll-animation')) {
                                var lastScrollTop = 0,
                                    additionalImageHolder = thisSection.find('.edgtf-additional-image-holder');
                                $(window).scroll(function(){
                                    var st = $(this).scrollTop();
                                       if (st > lastScrollTop){
                                               thisSection.find('.edgtf-additional-image-holder').removeClass('edgtf-appeared');
                                       } else {
                                          thisSection.find('.edgtf-additional-image-holder').addClass('edgtf-appeared');
                                       }
                                       lastScrollTop = st;
                                       //safari calcs fix
                                       if (edgtf.body.hasClass('edgtf-safari')) {
                                            lastScrollTop = Math.abs(lastScrollTop); 
                                       }
                                });
                            }

                            if (thisSection.hasClass('edgtf-section-responsive-height-set')) {
                                var hiDpiLaptopHeight = thisSection.data('hidpi-laptop-height'),
                                    mDpiLaptopHeight = thisSection.data('mdpi-laptop-height'),
                                    tabletHeight = thisSection.data('tablet-height');

                                if (edgtf.windowWidth <= 1440 && edgtf.windowWidth > 1280 && hiDpiLaptopHeight !== '' ) {
                                    thisSection.css('height' , hiDpiLaptopHeight);
                                }

                                if (edgtf.windowWidth <= 1280 && edgtf.windowWidth > 1024 && mDpiLaptopHeight !== '' ) {
                                    thisSection.css('height' , mDpiLaptopHeight);
                                }

                                if (edgtf.windowWidth <= 1024 && edgtf.windowWidth > 768 && tabletHeight !== '') {
                                    thisSection.css('height' , tabletHeight);
                                }
                            }

                        });
                    }

                    parallaxSection.each(function(){
                        var thisSection = $(this);
                        thisSection.waitForImages(function(){
                            thisSection.css({'visibility':'visible','opacity':'1'});
                        })
                    });
            }); 
        }
        if (edgtf.windowWidth >= 1024 && !$('html').hasClass('touch')) {
            var skrollrParallax = skrollr.init({
                forceHeight: false,
                smoothScrolling: false,
                easing: {
                    customEase: function(p) {
                      return 5.295*(p*p*p*p*p) - 18.5325*(p*p*p*p) + 26.08*(p*p*p) - 18.59*(p*p) + 6.7475*p;
                    }
                }
            });
            skrollrParallax.refresh();
            $(window).focus(function(){
                skrollrParallax.refresh(); //reinit due to miscalculations happening off window focus
                resetParallaxPositions(); //prevent unintentional transform
            });
        } 
    }

    /*
    * Reset parallax positions
    */
    function resetParallaxPositions() {
        var st = $(window).scrollTop(),   
        thisSection = $('.edgtf-parallax-section-advanced'),
        elements = $('.edgtf-parallax-hero-image-holder, .edgtf-parallax-info-section');
        if (thisSection.length) {
            if (st == thisSection.offset().top) {
                elements.addClass('edgtf-reset');
            } else {
                elements.removeClass('edgtf-reset');
            }
        }
    }

})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    edgtf.modules.blog = blog;

    blog.edgtfInitAudioPlayer = edgtfInitAudioPlayer;
    blog.edgtfInitBlogMasonry = edgtfInitBlogMasonry;
    blog.edgtfInitShortcodeBlogMasonry = edgtfInitShortcodeBlogMasonry;
    blog.edgtfInitBlogMasonryLoadMore = edgtfInitBlogMasonryLoadMore;
    blog.edgtfInitBlogLoadMore = edgtfInitBlogLoadMore;
    blog.edgtfInitBlogSlider = edgtfInitBlogSlider;

    blog.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blog.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blog.edgtfOnWindowResize = edgtfOnWindowResize;
    blog.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitAudioPlayer();
        edgtfInitBlogMasonry();
        edgtfInitShortcodeBlogMasonry();
        edgtfInitBlogMasonryLoadMore();
        edgtfInitBlogLoadMore();
        edgtfInitBlogSlider();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfInitBlogMasonry();
        edgtfInitShortcodeBlogMasonry();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
        
    }

    /*
    ** Init audio player for Blog list and single pages
    */
    function edgtfInitAudioPlayer() {

        var players = $('audio.edgtf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /*
    ** Init Blog Masonry Layout
    */
    function edgtfInitBlogMasonry() {

        if($('.edgtf-blog-holder.edgtf-blog-type-masonry').length) {

            var container = $('.edgtf-blog-holder.edgtf-blog-type-masonry');

            container.waitForImages(function() {
                container.isotope({
                    itemSelector: 'article',
                    resizable: false,
                    masonry: {
                        columnWidth: '.edgtf-blog-masonry-grid-sizer',
                        gutter: '.edgtf-blog-masonry-grid-gutter'
                    }
                });
                container.css('opacity', 1);
            });
        }
    }

    /*
    ** Init Shortcode Blog List Masonry Layout
    */
    function edgtfInitShortcodeBlogMasonry() {

        if($('.edgtf-blog-list-holder.edgtf-masonry').length) {

            var container = $('.edgtf-blog-list-holder.edgtf-masonry');

            container.waitForImages(function() {
                container.isotope({
                    itemSelector: 'li',
                    resizable: false,
                    masonry: {
                        columnWidth: '.edgtf-blog-masonry-grid-sizer',
                        gutter: '.edgtf-blog-masonry-grid-gutter'
                    }
                });
                container.children('.edgtf-blog-list').css('opacity', 1);
            });
        }
    }

    /*
    ** Init Blog Masonry Load More Functionality
    */
    function edgtfInitBlogMasonryLoadMore() {

        if($('.edgtf-blog-holder.edgtf-blog-type-masonry').length) {

            var container = $('.edgtf-blog-holder.edgtf-blog-type-masonry');

            if(container.hasClass('edgtf-masonry-pagination-infinite-scroll')) {
                container.infinitescroll({
                        navSelector: '.edgtf-blog-infinite-scroll-button',
                        nextSelector: '.edgtf-blog-infinite-scroll-button a',
                        itemSelector: 'article',
                        loading: {
                            finishedMsg: edgtfGlobalVars.vars.edgtfFinishedMessage,
                            msgText: edgtfGlobalVars.vars.edgtfMessage
                        }
                    },
                    function(newElements) {
                        container.append(newElements).isotope('appended', $(newElements));
                        edgtf.modules.blog.edgtfInitAudioPlayer();
                        edgtf.modules.common.edgtfOwlSlider();
                        edgtf.modules.common.edgtfFluidVideo();
                        setTimeout(function() {
                            container.isotope('layout');
                        }, 600);
                    }
                );
            } else if(container.hasClass('edgtf-masonry-pagination-load-more')) {
                var i = 1;
                $('.edgtf-blog-load-more-button a').on('click', function(e) {
                    e.preventDefault();

                    var button = $(this);

                    var link = button.attr('href');
                    var content = '.edgtf-masonry-pagination-load-more';
                    var anchor = '.edgtf-blog-load-more-button a';
                    var nextHref = $(anchor).attr('href');
                    $.get(link + '', function(data) {
                        var newContent = $(content, data).wrapInner('').html();
                        nextHref = $(anchor, data).attr('href');
                        container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        edgtf.modules.blog.edgtfInitAudioPlayer();
                        edgtf.modules.common.edgtfOwlSlider();
                        edgtf.modules.common.edgtfFluidVideo();
                        setTimeout(function() {
                            $('.edgtf-masonry-pagination-load-more').isotope('layout');
                        }, 600);
                        if(button.parent().data('rel') > i) {
                            button.attr('href', nextHref); // Change the next URL
                        } else {
                            button.parent().remove();
                        }
                    });
                    i++;
                });
            }
        }
    }

    /*
    ** Init Blog Load More Functionality
    */
    function edgtfInitBlogLoadMore(){
        var blogHolder = $('.edgtf-blog-holder.edgtf-blog-load-more:not(.edgtf-blog-type-masonry)');
        
        if(blogHolder.length){
            blogHolder.each(function(){
                var thisBlogHolder = $(this);
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisBlogHolder.find('.edgtf-load-more-ajax-pagination .edgtf-btn');
                maxNumPages =  thisBlogHolder.data('max-pages');                
                
                loadMoreButton.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var loadMoreDatta = getBlogLoadMoreData(thisBlogHolder);
                    nextPage = loadMoreDatta.nextPage;
                    if(nextPage <= maxNumPages){
                        var ajaxData = setBlogLoadMoreAjaxData(loadMoreDatta);

                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: edgtCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisBlogHolder.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml =  response.html;
                                thisBlogHolder.waitForImages(function(){    
                                    thisBlogHolder.find('article:last').after(responseHtml); // Append the new content 

                                    setTimeout(function() {               
                                        edgtfInitAudioPlayer();
                                        edgtf.modules.common.edgtfOwlSlider();
                                        edgtf.modules.common.edgtfFluidVideo();
                                    },400);
                                });
                            }
                        });
                    }
                    
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
            });
        }
    }

    function getBlogLoadMoreData(container){
        
        var returnValue = {};
        
        returnValue.nextPage = '';
        returnValue.number = '';
        returnValue.category = '';
        returnValue.blogType = '';
        returnValue.archiveCategory = '';
        returnValue.archiveAuthor = '';
        returnValue.archiveTag = '';
        returnValue.archiveDay = '';
        returnValue.archiveMonth = '';
        returnValue.archiveYear = '';
        
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('post-number') !== 'undefined' && container.data('post-number') !== false) {                    
            returnValue.number = container.data('post-number');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('blog-type') !== 'undefined' && container.data('blog-type') !== false) {                    
            returnValue.blogType = container.data('blog-type');
        }
        if (typeof container.data('archive-category') !== 'undefined' && container.data('archive-category') !== false) {                    
            returnValue.archiveCategory = container.data('archive-category');
        }
        if (typeof container.data('archive-author') !== 'undefined' && container.data('archive-author') !== false) {                    
            returnValue.archiveAuthor = container.data('archive-author');
        }
        if (typeof container.data('archive-tag') !== 'undefined' && container.data('archive-tag') !== false) {                    
            returnValue.archiveTag = container.data('archive-tag');
        }
        if (typeof container.data('archive-day') !== 'undefined' && container.data('archive-day') !== false) {                    
            returnValue.archiveDay = container.data('archive-day');
        }
        if (typeof container.data('archive-month') !== 'undefined' && container.data('archive-month') !== false) {                    
            returnValue.archiveMonth = container.data('archive-month');
        }
        if (typeof container.data('archive-year') !== 'undefined' && container.data('archive-year') !== false) {                    
            returnValue.archiveYear = container.data('archive-year');
        }
        
        return returnValue;
    }
    
    function setBlogLoadMoreAjaxData(container){
        var returnValue = {
            action: 'conall_edge_blog_load_more',
            nextPage: container.nextPage,
            number: container.number,
            category: container.category,
            blogType: container.blogType,
            archiveCategory: container.archiveCategory,
            archiveAuthor: container.archiveAuthor,
            archiveTag: container.archiveTag,
            archiveDay: container.archiveDay,
            archiveMonth: container.archiveMonth,
            archiveYear: container.archiveYear
        };
        
        return returnValue;
    }

    /**
     * Init Blog Slider
     */
    function edgtfInitBlogSlider() {

        var sliderHolders = $('.edgtf-blog-slider-holder'),
            blogSlider,
            numberOfItems,
            pagination,
            navigation;

        if (sliderHolders.length) {
            sliderHolders.each(function(){
                blogSlider = $(this).children('.edgtf-blog-slider');
                numberOfItems = blogSlider.data('items');
                pagination = blogSlider.data('pagination') == 'yes';
                navigation = blogSlider.data('navigation') == 'yes';

                //Responsive breakpoints
                var items = numberOfItems;

                var responsiveItems1 = 3;
                var responsiveItems2 = 2;
                var responsiveItems3 = 1;

                if (items < 3) {
                    responsiveItems1 = items;
                }

                if (items < 2) {
                    responsiveItems2 = items;
                }

                blogSlider.owlCarousel({
                    autoplay:true,
                    autoplayTimeout:5000,
                    itemsCustom: items,
                    dots: pagination,
                    dotsEach: true,
                    loop:true,
                    nav: navigation,
                    smartSpeed: 800,
                    navText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-icon-linea-icon icon-arrows-slim-left"></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-icon-linea-icon icon-arrows-slim-right"></span></span>'
                    ],
                    responsive:{
                        1201:{
                            items: items
                        },
                        769:{
                            items: responsiveItems1
                        },
                        481:{
                            items: responsiveItems2
                        },
                        0:{
                            items: responsiveItems3
                        }
                    }
                });

            });
        }

        setTimeout(function(){
            sliderHolders.addClass('edgtf-appeared');
        },300);

    }

})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    edgtf.modules.portfolio = portfolio;

    portfolio.edgtfOnDocumentReady = edgtfOnDocumentReady;
    portfolio.edgtfOnWindowLoad = edgtfOnWindowLoad;
    portfolio.edgtfOnWindowResize = edgtfOnWindowResize;
    portfolio.edgtfOnWindowScroll = edgtfOnWindowScroll;
    portfolio.edgtfInitPortfolioListMasonry = edgtfInitPortfolioListMasonry;
    portfolio.edgtfInitPortfolioListPinterest = edgtfInitPortfolioListPinterest;
    portfolio.edgtfInitPortfolio = edgtfInitPortfolio;
    portfolio.edgtfInitPortfolioMasonryFilter = edgtfInitPortfolioMasonryFilter;
    portfolio.edgtfInitPortfolioSlider = edgtfInitPortfolioSlider;
    portfolio.edgtfInitPortfolioLoadMore = edgtfInitPortfolioLoadMore;
    portfolio.edgtfPortfolioInfoFromBottomHeight = edgtfPortfolioInfoFromBottomHeight;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitPortfolioListMasonry();
        edgtfInitPortfolioListPinterest();
        edgtfInitPortfolio();
        edgtfInitPortfolioMasonryFilter();
        edgtfInitPortfolioSlider();
        edgtfInitPortfolioLoadMore();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
        edgtfPortfolioSingleFollow().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfInitPortfolioListMasonry();
        edgtfInitPortfolioListPinterest();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {

    }

    var edgtfPortfolioSingleFollow = function() {

        var info = $('.edgtf-follow-portfolio-info .small-images.edgtf-portfolio-single-holder .edgtf-portfolio-info-holder, .edgtf-follow-portfolio-info .small-slider.edgtf-portfolio-single-holder .edgtf-portfolio-info-holder');

        if (info.length) {
            var infoHolder = info.parent(),
                infoHolderOffset = infoHolder.offset().top,
                infoHolderHeight = infoHolder.height(),
                mediaHolder = $('.edgtf-portfolio-media'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .edgtf-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(edgtf.scroll > infoHolderOffset) {
                        var marginTop = edgtf.scroll - infoHolderOffset + edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight + 20; //20 px is for styling, spacing between header and info holder
                        // if scroll is initially positioned below mediaHolderHeight
                        if(marginTop + infoHolderHeight > mediaHolderHeight){
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(edgtf.scroll > infoHolderOffset) {

                        if(edgtf.scroll + headerHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar + infoHolderHeight + 70 < infoHolderOffset + mediaHolderHeight) {    //70 to prevent mispositioning

                            //Calculate header height if header appears
                            if ($('.header-appear, .edgtf-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .edgtf-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (edgtf.scroll - infoHolderOffset + edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                            });
                            //Reset header height
                            headerHeight = 0;
                        }
                        else{
                            info.stop().animate({
                                marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {

            init : function() {

                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });
            }
        };
    };



    /**
     * Initializes portfolio list
     */
    function edgtfInitPortfolio(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-standard, .edgtf-portfolio-list-holder-outer.edgtf-ptf-gallery, .edgtf-portfolio-list-holder-outer.edgtf-ptf-showcase');
        if(portList.length){            
            portList.each(function(){
                var thisPortList = $(this);
                thisPortList.appear(function(){
                    edgtfInitPortMixItUp(thisPortList);
                });
            });
        }
    }
    /**
     * Initializes mixItUp function for specific container
     */
    function edgtfInitPortMixItUp(container){
        var filterClass = '',
            layoutChanger = container.find('.edgtf-layout-changer'),
            loadMore = container.find('.edgtf-ptf-list-paging');


        if(container.hasClass('edgtf-ptf-has-filter')){
            filterClass = container.find('.edgtf-portfolio-filter-holder-inner ul li').data('class');
            filterClass = '.'+filterClass;
        }
        
        var holderInner = container.find('.edgtf-portfolio-list-holder');
        holderInner.mixItUp({
            callbacks: {
                onMixLoad: function(){
                    holderInner.find('article').css('visibility','visible');
                    loadMore.animate({opacity:1},300,'easeOutSine'); //add opacity to load more button
                    edgtfPortfolioInfoFromBottomHeight();
                },
                onMixStart: function(){ 
                    holderInner.find('article').css('visibility','visible');

                },
                onMixBusy: function(){
                    holderInner.find('article').css('visibility','visible');

                },
                onMixEnd: function() {
                    loadMore.animate({opacity:1},300,'easeOutSine'); //add opacity to load more button
                    setTimeout(function(){
                        edgtf.modules.shortcodes.edgtfParallaxSections();

                            var item = holderInner.find('.edgtf-portfolio-link > .edgtf-shuffle'); /* only for portfolio showcase */
                            item.each(function(){
                                var thisItem = $(this);
                                thisItem.css('width',thisItem.width());
                            });
                            item.chaffle({
                                speed: 25,
                                time: 100
                            });
                    },1000);
                } 
            },           
            selectors: {
                filter: filterClass
            },
            animation: {
                effects: 'fade',
                duration: 300,
                easing: 'cubic-bezier(0.38, 0.76, .3, 0.87)',
            }
            
        });

        loadMore.find('a').click(function(){
            $(this).stop().closest('.edgtf-ptf-list-paging').animate({opacity:0},200,'easeOutSine');
        });

        //layout changer
        if(layoutChanger.length) {
            var portfolioListHolderOuter = holderInner.closest('.edgtf-portfolio-list-holder-outer'),
                dataColumns = portfolioListHolderOuter.attr('data-columns'),
                dataClass = '',
                newDataClass = '';

            layoutChanger.find('.edgtf-original-layout .edgtf-cube').addClass('active');

             //layout changer logic
            if(dataColumns === '1') { dataClass = 'edgtf-ptf-one-column';}
            if(dataColumns === '2') { dataClass = 'edgtf-ptf-two-columns'; newDataClass = 'edgtf-ptf-one-column';}
            if(dataColumns === '3') { dataClass = 'edgtf-ptf-three-columns'; newDataClass = 'edgtf-ptf-two-columns';}
            if(dataColumns === '4') { dataClass = 'edgtf-ptf-four-columns'; newDataClass = 'edgtf-ptf-three-columns';}
            if(dataColumns === '5') { dataClass = 'edgtf-ptf-five-columns'; newDataClass = 'edgtf-ptf-four-columns';}
            if(dataColumns === '6') { dataClass = 'edgtf-ptf-six-columns'; newDataClass = 'edgtf-ptf-four-columns';}
            //original -> changed layout
            layoutChanger.find('.edgtf-two-columns a').click(function(){
                if(!holderInner.hasClass('edgtf-layout-changed')) {
                    //toggle active classes
                    $(this).closest('.edgtf-layout-changer').find('.edgtf-cube').removeClass('active');
                    $(this).siblings('.edgtf-cube').addClass('active');
                    //change layout
                    holderInner.mixItUp('changeLayout', {
                        containerClass: 'edgtf-layout-changed'
                    }, function(state){
                        var articles = holderInner.find('article');
                        loadMore.fadeOut();
                        articles.each(function(i){
                            $(this).delay(i*80).animate({opacity:0},200, 'easeOutSine');
                        });
                        holderInner.delay(articles.length*80).animate({opacity:0},200, 'easeOutSine', function() {
                            portfolioListHolderOuter.removeClass(dataClass).addClass(newDataClass);
                            articles.css({'opacity':1});
                            holderInner.delay(100).animate({opacity:1},300,'easeOutCubic', function() {
                                    loadMore.fadeIn(200);
                                }
                            );
                            
                        });
                    });
                }
            });
            //changed layout -> original layout
            layoutChanger.find('.edgtf-original-layout a').click(function(){
                if(holderInner.hasClass('edgtf-layout-changed')) {
                    //toggle active classes
                    $(this).closest('.edgtf-layout-changer').find('.edgtf-cube').removeClass('active');
                    $(this).siblings('.edgtf-cube').addClass('active');
                    //change layout
                    holderInner.mixItUp('changeLayout', {
                        containerClass: 'edgtf-layout-original'
                    }, function(state){
                        var articles = holderInner.find('article');
                        loadMore.fadeOut();
                        articles.each(function(i){
                            $(this).delay(i*80).animate({opacity:0},200, 'easeOutSine');
                        });
                        holderInner.delay(articles.length*80).animate({opacity:0},200, 'easeOutSine', function(){
                            portfolioListHolderOuter.removeClass(newDataClass).addClass(dataClass);
                            articles.css({'opacity':1});
                            holderInner.delay(100).animate({opacity:1},300,'easeOutCubic', function() {
                                    loadMore.fadeIn(200);
                                }
                            );
                        });
                    });
                }
            });
        }

    }
     /*
    **  Init portfolio list masonry type
    */
    function edgtfInitPortfolioListMasonry(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-masonry');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.edgtf-portfolio-list-holder');
                var size = thisPortList.find('.edgtf-portfolio-list-masonry-grid-sizer').width() / 1.33; /* landscape proportion */
                edgtfResizeMasonry(size,thisPortList);
                edgtfInitMasonry(thisPortList);
                edgtfPortfolioInfoFromBottomHeight();
            });
        }
    }
    
    function edgtfInitMasonry(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.edgtf-portfolio-item',
            masonry: {
                columnWidth: '.edgtf-portfolio-list-masonry-grid-sizer'
            }
        });
    }
    
    function edgtfResizeMasonry(size,container){
        
        var defaultMasonryItem = container.find('.edgtf-default-masonry-item');
        var largeWidthMasonryItem = container.find('.edgtf-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.edgtf-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.edgtf-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2*size));

        if(edgtf.windowWidth > 600){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeWidthMasonryItem.css('height', size);
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size/2));

        }
    }
    /**
     * Initializes portfolio pinterest 
     */
    function edgtfInitPortfolioListPinterest(){
        
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-pinterest, .edgtf-portfolio-list-holder-outer.edgtf-ptf-masonry-with-space');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.edgtf-portfolio-list-holder');
                thisPortList.waitForImages(function() {
                    edgtfInitPinterest(thisPortList);
                });
            });
            
        }
    }
    
    function edgtfInitPinterest(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.edgtf-portfolio-item',
            masonry: {
                gutter: '.edgtf-portfolio-list-pinterest-grid-gutter',
                columnWidth: '.edgtf-portfolio-list-pinterest-grid-sizer'
            }
        });
        
    }
    /**
     * Initializes portfolio masonry filter
     */
    function edgtfInitPortfolioMasonryFilter(){
        
        var filterHolder = $('.edgtf-portfolio-filter-holder.edgtf-masonry-filter');
        
        if(filterHolder.length){
            filterHolder.each(function(){
               
                var thisFilterHolder = $(this);
                
                var portfolioIsotopeAnimation = null;
                
                var filter = thisFilterHolder.find('ul li').data('class');
                
                thisFilterHolder.find('.filter:first').addClass('current');
                
                thisFilterHolder.find('.filter').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(portfolioIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    portfolioIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s'); 
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.siblings('.edgtf-portfolio-list-holder-outer').find('.edgtf-portfolio-list-holder').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });
                
            });
        }
    }


    /*
    * Set info from bottom height
    */
    function edgtfPortfolioInfoFromBottomHeight() {
        var ptfList = $('.edgtf-portfolio-list-holder-outer.edgtf-info-from-bottom');
        if(ptfList.length) {
            ptfList.each(function(){              
                var thisList = $(this);
                thisList.find('article').each(function(){
                    var thisArticle = $(this),
                        textOverlay = thisArticle.find('.edgtf-item-text-overlay');

                        edgtfSetHeight(textOverlay);

                        $(window).resize(function() {
                            edgtfSetHeight(textOverlay);
                        }); 
                        
                });
            });
        }

        function edgtfSetHeight(textOverlay) {
            if(textOverlay.height() > 75) { 
                //75px default height -> content in two rows
                textOverlay.addClass('edgtf-display-block');
            } else {
                textOverlay.removeClass('edgtf-display-block');
            }
        }

    }


    /**
     * Initializes portfolio slider
     */
    
    function edgtfInitPortfolioSlider(){
        var portSlider = $('.edgtf-portfolio-list-holder-outer.edgtf-portfolio-slider-holder');

        if(portSlider.length){
            portSlider.each(function(){
                var thisPortSlider = $(this);
                var sliderWrapper = thisPortSlider.children('.edgtf-portfolio-list-holder');
                var numberOfItems = thisPortSlider.data('items');
                var numberOfItemsMobile = 2;
                var numberOfItemsTablet = 3;

                sliderWrapper.owlCarousel({                    
                    autoPlay: 5000,
                    responsive:{
                        0:{
                            items:1,
                        },
                        600:{
                            items:numberOfItemsMobile,
                        },
                        768:{
                            items:numberOfItemsTablet,
                        },
                        1000:{
                            items:numberOfItems,
                        }
                    },
                    pagination: true,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    nav: false,
                    mouseDrag:true,
                    touchDrag: true,
                    smartSpeed: 600,
                    onInitialized: function() {
                        edgtfPortfSliderAppear();
                    }
                });

                function edgtfPortfSliderAppear() {
                    thisPortSlider.waitForImages(function(){
                        thisPortSlider.addClass('edgtf-appeared');
                    });
                }

            });
        }
    }
    /**
     * Initializes portfolio load more function
     */
    function edgtfInitPortfolioLoadMore(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-load-more');
        if(portList.length){
            portList.each(function(){
                
                var thisPortList = $(this);
                var thisPortListInner = thisPortList.find('.edgtf-portfolio-list-holder');
                var nextPage; 
                var maxNumPages;
                var loadMoreButton = thisPortList.find('.edgtf-ptf-list-load-more a');
                
                if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {  
                    maxNumPages = thisPortList.data('max-num-pages');
                }
                
                loadMoreButton.on('click', function (e) {  
                    var loadMoreDatta = edgtfGetPortfolioAjaxData(thisPortList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation(); 
                    if(nextPage <= maxNumPages){
                        var ajaxData = edgtfSetPortfolioAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: edgtCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisPortList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = edgtfConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with
                                thisPortList.waitForImages(function(){    
                                    setTimeout(function() {
                                        if(thisPortList.hasClass('edgtf-ptf-masonry') || thisPortList.hasClass('edgtf-ptf-pinterest') || thisPortList.hasClass('edgtf-ptf-masonry-with-space')){
                                            thisPortListInner.isotope().append( responseHtml ).isotope( 'appended', responseHtml ).isotope('reloadItems');
                                        } else {
                                            thisPortListInner.mixItUp('append',responseHtml);
                                        }
                                    },400);                                    
                                });                           
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
                
            });
        }
    }


    function edgtfConvertHTML ( html ) {
        var newHtml = $.trim( html ),
                $html = $(newHtml ),
                $empty = $();

        $html.each(function ( index, value ) {
            if ( value.nodeType === 1) {
                $empty = $empty.add ( this );
            }
        });

        return $empty;
    }

    /**
     * Initializes portfolio load more data params
     * @param portfolio list container with defined data params
     * return array
     */
    function edgtfGetPortfolioAjaxData(container){
        var returnValue = {};
        
        returnValue.type = '';
        returnValue.columns = '';
        returnValue.gridSize = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.imageSize = '';
        returnValue.filter = '';
        returnValue.filterOrderBy = '';
        returnValue.category = '';
        returnValue.selectedProjectes = '';
        returnValue.showLoadMore = '';
        returnValue.titleTag = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        
        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('data-gallery-hover-type') !== 'undefined' && container.data('data-gallery-hover-type') !== false) {                    
            returnValue.galleryHoverType = container.data('data-gallery-hover-type');
        }
        if (typeof container.data('data-standard-hover-type') !== 'undefined' && container.data('data-standard-hover-type') !== false) {                    
            returnValue.standardHoverType = container.data('data-standard-hover-type');
        }
        if (typeof container.data('space') !== 'undefined' && container.data('space') !== false) {                    
            returnValue.space = container.data('space');
        }
        if (typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {                    
            returnValue.gridSize = container.data('grid-size');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {                    
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {                    
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {                    
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {                    
            returnValue.number = container.data('number');
        }
        if (typeof container.data('image-size') !== 'undefined' && container.data('image-size') !== false) {                    
            returnValue.imageSize = container.data('image-size');
        }
        if (typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {                    
            returnValue.filter = container.data('filter');
        }
        if (typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {                    
            returnValue.filterOrderBy = container.data('filter-order-by');
        }
        if (typeof container.data('change-layout') !== 'undefined' && container.data('change-layout') !== false) {                    
            returnValue.changeLayout = container.data('change-layout');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {                    
            returnValue.selectedProjectes = container.data('selected-projects');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {                    
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {                    
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {                    
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {                    
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        return returnValue;
    }
     /**
     * Sets portfolio load more data params for ajax function
     * @param portfolio list container with defined data params
     * return array
     */
    function edgtfSetPortfolioAjaxData(container){
        var returnValue = {
            action: 'edgt_core_portfolio_ajax_load_more',
            type: container.type,
            space: container.space,
            galleryHoverType: container.galleryHoverType,
            standardHoverType: container.standardHoverType,
            columns: container.columns,
            gridSize: container.gridSize,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            imageSize: container.imageSize,
            filter: container.filter,
            filterOrderBy: container.filterOrderBy,
            changeLayout: container.changeLayout,
            category: container.category,
            selectedProjectes: container.selectedProjectes,
            showLoadMore: container.showLoadMore,
            titleTag: container.titleTag,
            nextPage: container.nextPage
        };
        return returnValue;
    }


})(jQuery);
(function($) {
    'use strict';

    var woocommerce = {};
    edgtf.modules.woocommerce = woocommerce;

    woocommerce.edgtfInitQuantityButtons = edgtfInitQuantityButtons;
    woocommerce.edgtfInitSelect2 = edgtfInitSelect2;
    woocommerce.edgtfWooCommerceStickySidebar = edgtfWooCommerceStickySidebar;

    woocommerce.edgtfOnDocumentReady = edgtfOnDocumentReady;
    woocommerce.edgtfOnWindowLoad = edgtfOnWindowLoad;
    woocommerce.edgtfOnWindowResize = edgtfOnWindowResize;
    woocommerce.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitQuantityButtons();
        edgtfInitSelect2();
        edgtfInitPaginationFunctionality();

        $('.woocommerce-tabs ul.tabs>li a').on('click', function(){
            if($(this).parents('.summary').hasClass('edgtf-sticky-sidebar-appeared')){
                $(this).parents('.summary').removeClass('edgtf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                setTimeout(function(){
                    edgtfWooCommerceStickySidebar().init();
                }, 100);
            }
        });
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
        edgtfWooCommerceStickySidebar().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {

    }
    
    function edgtfInitQuantityButtons() {

        $(document).on( 'click', '.edgtf-quantity-minus, .edgtf-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.edgtf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('edgtf-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            inputField.trigger( 'change' );
        });
    }

    function edgtfInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();
        }
    }

    function edgtfInitPaginationFunctionality() {

        var pagHolder = $('.woocommerce-pagination');

        if (pagHolder.length) {
            pagHolder.find('> ul > li').each(function(){
                var thisItem = $(this);

                if(thisItem.children('a').hasClass('prev')){
                    thisItem.addClass('prev-arrow');
                }
                if(thisItem.children('a').hasClass('next')){
                    thisItem.addClass('next-arrow');
                }    
            });
        }
    }

    /*
     **  Init woocommerce sticky sidebar logic
     */
    function edgtfWooCommerceStickySidebar(){

        var sswHolder = $('.edgtf-single-product-summary');
        var headerHeightOffset = 0;
        var widgetTopOffset = 0;
        var widgetTopPosition = 0;
        var sidebarHeight = 0;
        var sidebarWidth = 0;
        var objectsCollection = [];

        function addObjectItems() {
            if (sswHolder.length){
                sswHolder.each(function(){
                    var thisSswHolder = $(this);
                    widgetTopOffset = thisSswHolder.offset().top;
                    widgetTopPosition = thisSswHolder.position().top;
                    sidebarHeight = thisSswHolder.children('.summary').outerHeight();
                    sidebarWidth = thisSswHolder.width();

                    objectsCollection.push({'object': thisSswHolder, 'offset': widgetTopOffset, 'position': widgetTopPosition, 'height': sidebarHeight, 'width': sidebarWidth});
                });
            }
        }

        function initStickySidebarWidget() {

            if (objectsCollection.length && edgtf.body.hasClass('edgtf-woo-sticky-holder-enabled')){
                $.each(objectsCollection, function(i){

                    var thisSswHolder = objectsCollection[i]['object'];
                    var thisWidgetTopOffset = objectsCollection[i]['offset'];
                    var thisWidgetTopPosition = objectsCollection[i]['position'];
                    var thisSidebarHeight = objectsCollection[i]['height'];
                    var thisSidebarWidth = objectsCollection[i]['width'];

                    if (edgtf.body.hasClass('edgtf-fixed-on-scroll')) {
                        headerHeightOffset = 42;
                        if ($('.edgtf-fixed-wrapper').hasClass('edgtf-fixed')) {
                            headerHeightOffset = $('.edgtf-fixed-wrapper.edgtf-fixed').height();
                        }
                    } else {
                        headerHeightOffset = $('.edgtf-page-header').height();
                    }

                    if (edgtf.windowWidth > 1024) {

                        var sidebarPosition = -(thisWidgetTopPosition - headerHeightOffset - 10);
                        var stickySidebarHeight = thisSidebarHeight - thisWidgetTopPosition;
                        var stickySidebarRowHolderHeight = thisSswHolder.parent().children('.images').outerHeight();

                        //move sidebar up when hits the end of section row
                        var rowSectionEndInViewport = thisWidgetTopOffset - headerHeightOffset - thisWidgetTopPosition - edgtfGlobalVars.vars.edgtfTopBarHeight + stickySidebarRowHolderHeight;

                        if ((edgtf.scroll >= thisWidgetTopOffset - headerHeightOffset) && thisSidebarHeight < stickySidebarRowHolderHeight) {
                            if(thisSswHolder.children('.summary').hasClass('edgtf-sticky-sidebar-appeared')) {
                                thisSswHolder.children('.summary.edgtf-sticky-sidebar-appeared').css({'top': sidebarPosition+'px'});
                            } else {
                                thisSswHolder.children('.summary').addClass('edgtf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px', 'width': thisSidebarWidth, 'margin-top': '-10px'}).animate({'margin-top': '0'}, 200);
                            }

                            if (edgtf.scroll + stickySidebarHeight >= rowSectionEndInViewport) {
                                thisSswHolder.children('.summary.edgtf-sticky-sidebar-appeared').css({'position': 'absolute', 'top': stickySidebarRowHolderHeight-stickySidebarHeight+sidebarPosition-headerHeightOffset+'px'});
                            } else {
                                thisSswHolder.children('.summary.edgtf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px'});
                            }
                        } else {
                            thisSswHolder.children('.summary').removeClass('edgtf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                        }
                    } else {
                        thisSswHolder.children('.summary').removeClass('edgtf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                    }
                });
            }
        }

        return {
            init: function() {
                addObjectItems();

                initStickySidebarWidget();

                $(window).scroll(function(){
                    initStickySidebarWidget();
                });
            },
            reInit: initStickySidebarWidget
        };
    }

})(jQuery);