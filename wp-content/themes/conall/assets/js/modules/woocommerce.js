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