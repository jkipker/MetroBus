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