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