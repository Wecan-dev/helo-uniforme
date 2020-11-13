/* Table of Contents
--------------------------------------------------------------------------------------
*/
(function( window, WITHEMES, $) {
"use strict";
    
    
// cache element to hold reusable elements
WITHEMES.cache = {
    $document : {},
    $window   : {}
}

// Create cross browser requestAnimationFrame method:
window.requestAnimationFrame = window.requestAnimationFrame
|| window.mozRequestAnimationFrame
|| window.webkitRequestAnimationFrame
|| window.msRequestAnimationFrame
|| function(f){setTimeout(f, 1000/60)}

/**
 * Init functions
 *
 * @since 1.0
 */
WITHEMES.init = function() {

    /**
     * cache elements for faster access
     *
     * @since 1.3
     */
    WITHEMES.cache.$document = $(document);
    WITHEMES.cache.$window = $(window);

    WITHEMES.cache.$document.ready(function() {

        WITHEMES.reInit();

    });

}

/* reInit
--------------------------------------------------------------------------------------------- */
WITHEMES.reInit = function() {
    
    WITHEMES.fitvids();
    WITHEMES.niceselect();
    WITHEMES.added_to_cart();
    WITHEMES.sticky();
    WITHEMES.tipsy();
    WITHEMES.flexslider();
    WITHEMES.topbar_search();
    WITHEMES.superfish();
    WITHEMES.mega();
    WITHEMES.scrollup();
    WITHEMES.offcanvas();
    WITHEMES.waypoint();
    WITHEMES.lightbox();
    WITHEMES.scrollTo();
    WITHEMES.imagebox_masonry();
    WITHEMES.gmap();
    WITHEMES.quickview();
    WITHEMES.wishlist();
    WITHEMES.woocommerce_quantity();
    WITHEMES.pinterest();
}

/* Mobile Check
--------------------------------------------------------------------------------------------- */
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

/* Fitvids
--------------------------------------------------------------------------------------------- */
WITHEMES.fitvids = function(){
	if ( !$().fitVids ) {
        return;
    }

    $('.entry-content, .media-container').fitVids();
    
}; // fitvids
    
/* Scrollup button
 * @since 2.3
--------------------------------------------------------------------------------------------- */
WITHEMES.scrollup = function() {

    WITHEMES.cache.$window.scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#scrollup').addClass('shown');
        } else {
            $('#scrollup').removeClass('shown');
        }
    }); 

    $('#scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600 , 'easeOutExpo');
        return false;
    });

}

/* Nice Select
 * @since 2.3
--------------------------------------------------------------------------------------------- */
WITHEMES.niceselect = function() {

    // setup nice select for other select elements
    $( '.woocommerce-ordering select, form.cart .variations select' ).each(function() {

        // ignore this of WooCommerce
        if ( $( this ).is( '#rating, #billing_country, #billing_state' ) ) return;

        var select = $( this ),
            val = select.find( 'option[value="' + select.val() + '"]' ).text();
        if ( select.parent( '.wi-nice-select' ).length ) return;

        select
        .wrap( '<div class="wi-nice-select" />' )
        .after( '<a href="#">' + val + '</a>' )

    });

    $( '.wi-nice-select' ).each(function() {

        var _this = $( this )

        _this.find( 'select' ).on( 'change', function() {

            var select = $( this )

            _this.find( 'a' ).text( select.find( 'option[value="' + select.val() + '"]' ).text() );

        });

    });
    
}

/* Added to cart event
 * @since 2.3
--------------------------------------------------------------------------------------------- */
WITHEMES.added_to_cart = function() {

    function cart_offcavnas_show() {
            
        $( '#cart-offcanvas' ).addClass( 'showing' );
        $( 'body' ).addClass( 'offcanvas-cart-showing' );

        /*
        // hide after 8s
        setTimeout(function() {
            cart_offcavnas_hide();
        }, 8000 );
        */
    }

    function cart_offcavnas_hide() {

        $( '#cart-offcanvas' ).removeClass( 'showing' );
        $( 'body' ).removeClass( 'offcanvas-cart-showing' );

    }

    $( document.body ).on( 'added_to_cart', function( fragments, cart_hash, btn ){

        cart_offcavnas_show();

    });

    $( '.cart-offcanvas-close' ).click(function( e ) {

        e.preventDefault();
        cart_offcavnas_hide();

    });

    $( document ).on( 'click', function( e ) {

        var target = $( e.target );
        if ( ! target.is( '#cart-offcanvas' ) && ! target.closest( '#cart-offcanvas' ).length ) {
            cart_offcavnas_hide();
        }

    });
    
}

/**
 * WooCommerce Quick View
 *
 * @since 2.3
 */
WITHEMES.quickview = function() {
    
    if ( ! $().magnificPopup ) return;

    function show_preview( product, content ) {

        $( '#quick-view' )
        .html( content )
        .show()
        .find( '.woocommerce-product-gallery' ).each( function() {

            // reInit gallery
            if ( $().wc_product_gallery ) {
                $( this ).wc_product_gallery();
            }
        });

        // reInit niceselect
        WITHEMES.niceselect();

        // the show the popup
        $.magnificPopup.open({
            items: {
                src: $( '#quick-view' ),
                type: 'inline'
            },
            callbacks: {
                close: function() {
                    product.removeClass( 'preview-loading' );
                },
            },
        });

    }

    $( '.quickview-btn' ).click(function( e ) {

        e.preventDefault();
        var a = $( this ),
            product = a.closest( '.product' ),
            id = a.data( 'id' );

        product.addClass( 'preview-loading' );

        if ( product.data( 'preview' ) ) {

            show_preview( product, product.data( 'preview' ) )

        } else {

            $.post(
                // the url
                WITHEMES.ajaxurl,

                // the data
                {
                    action: 'product_preview',
                    nonce: WITHEMES.preview_nonce,
                    id: id,
                },
                function( response ) {
                    
                    if ( response ) {
                        
                        product.data( 'preview', response );
                        show_preview( product, response );

                    }

                }
            );   

        }

    });

}
    
/* Styled Google Map
 * @since 2.3
--------------------------------------------------------------------------------------------- */
WITHEMES.gmap = function() {
    
    var load_map = function( ele ) {
            
        // check if google exists
        if ( typeof( google ) ==='undefined' ) {
            console.error( 'Google API is not available.' );
            return;
        }

        var $this = ele;
        // check the ID
        var id = $this.attr('id');
        if ( ! id ) {
            id = 'gmap-' + Math.floor((Math.random() * 100) + 1);
            $this.attr('id',id);
        }

        var defaultOptions = {
            map_type: 'ROADMAP',
            lat: '40.678178',
            lng: '-73.944158',
            zoom: 16,
            scrollwheel: false,
            marker_image : null,
            style : 'subtle-grayscale',
        },
            args = $this.data( 'options' ),
            options = $.extend( defaultOptions, args );

        if ( ! options.lat || ! options.lng )
            return;

        if ( options.zoom ) options.zoom = parseInt( options.zoom );

        if ( 'SATELLITE' != options.map_type && 'HYBRID' != options.map_type && 'TERRAIN' != options.map_type ) {
            options.map_type = 'ROADMAP';
        }

        // variables
        var map_pos = new google.maps.LatLng( options.lat, options.lng ),
            map_args = $this.data( 'map_args' );

        map_args = $.extend({
            mapTypeId	:	google.maps.MapTypeId[options.map_type],
            center		:	map_pos,
            zoom		:	options.zoom,
            scrollwheel	:	options.scrollwheel,

            zoomControl : false,
            mapTypeControl : false,
            scaleControl : false,
            streetViewControl : false,
            rotateControl : false,
            fullscreenControl : false,
        }, map_args ); // map_args

        // map styles
        var map_styles = {};
        //http://snazzymaps.com/style/15/subtle-grayscale
        map_styles['light'] = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];

        map_styles[ 'dark' ] = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]

        map_styles[ 'light-grey-blue' ] = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#dde6e8"},{"visibility":"on"}]}]

        if ( 'none' != options.style ) {
            if ( 'undefined' !== typeof map_styles[ options.style ] ) {
                map_args['styles'] = map_styles[ options.style ];
            }
        }

        var gmap = new google.maps.Map(document.getElementById(id), map_args);

        google.maps.event.addListenerOnce( gmap, 'tilesloaded', function() {

            // set marker
            var marker_args = {
                position: map_pos,
                map: gmap,
                visible: false,
                infoWindowIndex : 1,
                optimized: false,
                };

            if ( options.marker_image ) {
                var marker_img = new google.maps.MarkerImage( 
                    options.marker_image, 
                    null,
                    null,
                    null,
                    null
                );
                marker_args[ 'icon' ] = options.marker_image;
            }

            var marker = new google.maps.Marker( marker_args );

            setTimeout(function(){
                marker.setAnimation(google.maps.Animation.BOUNCE);
                marker.setOptions({ visible: true });
                setTimeout(function(){marker.setAnimation(null);},500);
            }, 200 );

        }); // tilesLoaded

    } // load_map function

    $( '.wi-gmap' ).each(function() {

        var $this = $( this );

        $this.bind( 'inview', function(event, isInView, visiblePartX, visiblePartY) {

            if (isInView) {

                setTimeout(function() {

                    if ( !$this.data( 'loaded' ) ) {

                        $this.data( 'loaded',true );
                        load_map( $this );

                    }

                }, 300 );

            } // inview

        });

    });

}
    
/* Imagebox Masonry
 * Automatically find imageboxes & set them in masonry mode
 * @since 2.3
--------------------------------------------------------------------------------------------- */    
WITHEMES.imagebox_masonry = function() {
    
    if ( ! $().masonry ) return;
    
    $( '.wpb_wrapper' ).each(function(){
        
        var $this = $( this );
        
        if ( $this.find( '.imagebox-grid-item' ).length > 1 ) {
            
            $this
            .append( '<div class="grid-sizer" />' )
            .addClass( 'imagebox_masonry_wrapper' );
            
            $this.imagesLoaded(function(){
                $this.masonry({

                    itemSelector: '.imagebox-grid-item',
                    columnWidth : '.grid-sizer',
                });
            });
            
        }
    
    });
    
}
    
/* Scroll To
 * @since 2.3
--------------------------------------------------------------------------------------------- */
WITHEMES.scrollTo = function() {
    
    if ( ! $().scrollTo ) return;
    
    if ( ! WITHEMES.scroll ) {
        WITHEMES.scroll = {
            speed: 600,
            hash: 'false',
            easing: 'easeInOutExpo',
        }
    }

    // Calculate estimated sticky header height
    // sticky header height = container height + padding
    var noHash = window.location.pathname + window.location.search,
        duration = parseInt( WITHEMES.scroll.speed ),
        hash = ( 'true' === WITHEMES.scroll.hash ),
        easing = WITHEMES.scroll.easing,
        offset;

    if ( window.matchMedia( '(max-width:767px)' ).matches ) {

        offset = {
            top: 0,
            left: 0,
        }

    } else {

        offset = {
            top: -( $( '#wpadminbar' ).outerHeight() + 56 /* 58 is header height */ ),
            left: 0,
        }

    }

    // validate duration value
    if ( duration > 10000 || duration < 100 || isNaN( duration ) ) duration = 600;

    // Scroll to section if hash exists
    WITHEMES.cache.$window.load(function() {

        if( window.location.hash ) {

            setTimeout ( function () {

                $.scrollTo(
                    window.location.hash,
                    duration,
                    { 
                        easing: easing,
                        offset: offset,
                        axis:'y'
                    }
                );

            }, 400 );

        }

    });

    // Button Click
    $( '.wi-btn[href*="#"], .woocommerce-review-link' ).click(function( e ) {

        var a = $( this ),
            href = a.attr( 'href' ),
            target = '#' + href.substring(href.indexOf('#')+1);

        if ( target == '#' ) return;

        var testA = document.createElement('a');
            testA.href = href;

        // This is external link
        // Let it redirects
        if ( testA.pathname !== noHash && '' != testA.pathname ) {
            return;
        }

        e.preventDefault();

        // scroll to
        $.scrollTo( target, duration, {
            easing: easing,
            offset: offset,
            axis:'y'
        });

        // Hash
        if ( hash ) {
            if ( '#top' != target ) {
                history.pushState(null, null, target );
            } else {
                history.pushState(null, null, noHash );
            }
        }

    });
    
}    
    
/* Flexslider
--------------------------------------------------------------------------------------------- */
WITHEMES.flexslider = function(){
    if ( ! $().flexslider ) {
        return;
    }
    
    WITHEMES.cache.$window.load(function(){
        $('.wi-flexslider').each(function(){
            var $this = $(this),
                slider = $this.find( '.flexslider' ),
                defaultOptions = {
                    animation: 'fade',
                    direction: 'horizontal',
                    slideshow: false,                //Boolean: Animate slider automatically
                    slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                    animationSpeed: 900,
                    
                    prevText : '<i class="fa fa-angle-left"></i>',
                    nextText : '<i class="fa fa-angle-right"></i>',
                    
                    controlNav : false,
                    directionNav : true,
                    
                    multipleKeyboard : true,
                    smoothHeight : true,
                },
                args = $this.data( 'options' ),
                options = $.extend( defaultOptions, args );
            
            slider.flexslider( options );
            
        });
    }); // window load
}

/* Topbar Search
--------------------------------------------------------------------------------------------- */
WITHEMES.topbar_search = function() {
    $('#topbar_search .mobile_submit').on('click', function(){
        $('#mobile_search').slideToggle('fast',function(){ $('#mobile_search').find('.s').focus(); });
        return false;
    });
}

/* Tipsy
--------------------------------------------------------------------------------------------- */
WITHEMES.tipsy = function() {
    if ( !$().tipsy ) {
        return;
    }
    
    $('.has-tip').tipsy({
        fade	:	true,
		gravity	: 	's',
		opacity	:	'.9',
        live: true,
    });
    
    $('#wi-topbar .social-list ul a').tipsy({
        fade	:	false,
		gravity	: 	'n',
		opacity	:	'.9',
    });
    
    $( '.yith-wcwl-add-button:not(.hide) a' ).tipsy({
        gravity: 's',
        opacity: 1,
        live: true,
        title: function() {
            return this.textContent; 
        }
    });
    
}

/* Mobile Nav
--------------------------------------------------------------------------------------------- */
WITHEMES.mobilenav = function() {
    if ( !$().slicknav ) {
        return;
    }
    
    $('#wi-mainnav div.menu').slicknav({
        allowParentLinks : true,
        prependTo : '#mobilemenu',
    });
    
}

/* Sticky
--------------------------------------------------------------------------------------------- */
WITHEMES.sticky = function() {
    
    var init = debounce( function() {
        
        if ( ! window.matchMedia( '(min-width:940px)' ).matches ) {
            return;
        }
    
        var header = $('#wi-mainnav'),
            header_top = header.length ? header.offset().top : 0,
            header_h = header.outerHeight(),
            delay_distance = 120;

        function sticky() {

            if ( !header.length ) {
                return;
            }

            if ( WITHEMES.cache.$window.scrollTop() > header_top + header_h + delay_distance ) {
                header.addClass('before-sticky is-sticky');
            } else if ( WITHEMES.cache.$window.scrollTop() > header_top + header_h ) {
                header.removeClass('is-sticky');
                header.addClass('before-sticky');
            } else {
                header.removeClass('is-sticky before-sticky');
            }

        }

        sticky();
        WITHEMES.cache.$window.scroll(sticky);
        
    }, 100 );
    
    init();
    
    WITHEMES.cache.$window.resize( init );
    
}

/* Superfish
--------------------------------------------------------------------------------------------- */
WITHEMES.superfish = function(){
    if ( !$().superfish ) {
        return;
    }
    $( '#wi-mainnav div.menu, #menu-topbar' ).superfish({
        delay : 500,
        speed : 0,
    });
}

/* Mega Menu Column
--------------------------------------------------------------------------------------------- */
WITHEMES.mega = function() {

    $( '#wi-mainnav div.menu' ).find( '>ul >li.mega' ).each(function() {
        
        var li = $( this );
        
        var col = $( this ).find( '>ul>li' ).length;
        $( this ).addClass( 'column-' + col );
        
        
        li.find( '.image-item' ).each(function() {
            
            var img = $( this ).find( 'img' );
            if ( ! img.length ) return;

            var src = img.first().attr( 'src' );

            $( this ).css({
                'background-image': 'url("' +  src + '")'
            })
            .find( 'img' ).remove()

        });
        
        
    });
    
}

/* Off Canvas Menu
--------------------------------------------------------------------------------------------- */
WITHEMES.offcanvas = function() {
    
    var hamburger = $( '#hamburger' ),
        offcanvas = $( '#offcanvas' );
    
    var offcanvas_dismiss = debounce(function( e ) {
        
        e.preventDefault();
        $( 'html' ).removeClass( 'offcanvas-open' );
        
    }, 100 );
    
    WITHEMES.cache.$document.on( 'click touchstart', '#hamburger', function( e ) {
    
        e.preventDefault();
        $( 'html' ).toggleClass( 'offcanvas-open' );
    
    });
    
    $( '#offcanvas-overlay' ).on( 'click touchstart', offcanvas_dismiss );
    
    WITHEMES.cache.$window.resize(offcanvas_dismiss);
    
    // Submenu Click
    $( '#mobilenav li, #mobile-topbarnav li' ).click(function( e ) {
    
        var li = $( this ),
            a = li.find( '> a ' ),
            href = a.attr( 'href' ),
            target = $( e.target ),
            ul = li.find( '> ul' ),
            
            condition1 = ( ! target.is( ul ) && ! target.closest( ul ).length ),
            condition2 = ( ( ! target.is( a ) && ! target.closest( a ).length ) || ( ! href || '#' == href ) );
        
        if (  condition1 && condition2 ) {
            
            e.preventDefault();
            ul.slideToggle( 300, 'easeOutCubic' );
            
        }
    
    });

}

/* Waypoint
--------------------------------------------------------------------------------------------- */
WITHEMES.waypoint = function() {
    if ( ! $().withemes_waypoint )
        return;
    
    $( '.animation_element' ).each(function() {
        
        var $this = $( this ),
            delay = parseInt( $this.data( 'delay' ) );
        
        $this.withemes_waypoint(function(){
            
            setTimeout(function(){
                
                $this.addClass( 'running' );
            
            }, 100 + delay );
        
        }, { offset: '85%' });
    
    });
}

/* ilightbox
 * @since 1.3
 * @depricated since 2.0
--------------------------------------------------------------------------------------------- */
WITHEMES.ilightbox = function() {
    
    // iLightbox required
    if ( ! $().iLightBox ) return;

    $( '.wi-lightbox-gallery, .woocommerce div.product div.images' ).each(function() {

        var $this = $( this ),
            items = $this.is( '.woocommerce div.product div.images' ) ? 'a' : 'a.lightbox-link';
        $this.find( items ).iLightBox({

            path: 'horizontal',
            controls : {
                arrows : false,
            },
            overlay : {
                opacity : .95,
            },
            styles : {
                nextOffsetX: 150,
                nextScale: 0.94,
                prevOffsetX: 150,
                prevScale: 0.94,
            },
            effects : {
                repositionSpeed : 600,
                switchSpeed : 600,
            },
            skin: 'metro-white-skin',
            infinite: true,
            social: {
              buttons: {
                facebook: true,
                twitter: true,
                googleplus: true,
              }
            }

        });

    });
    
}

/**
 * Magnific Popup
 *
 * @since 2.3, we no longer use magnific popup for lightbox
 * instead, we use default WooCommerce lightbox
 */
WITHEMES.lightbox = function() {

    if ( ! $().magnificPopup ) {
        return;
    }

    $( '.open-lightbox' ).magnificPopup({
        type: 'image',
    });
    
    $( '.open-video-lightbox' ).magnificPopup({
        type: 'iframe',
    });

    $( '.wi-lightbox-gallery' ).each(function() {

        var gallery = $( this ),
            delegate = 'a.lightbox-link';

        var defaultOptions = {
                type : 'image',
                delegate : delegate,
                removalDelay : 400,
                gallery: {
                    enabled:true,
                    arrowMarkup : '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"><i class="fa fa-angle-%dir%"></i></button>',
                },
                closeBtnInside : true,
                closeMarkup : '<button title="%title%" type="button" class="mfp-close"><i class="fa fa-close"></i></button>',

                callbacks: {

                    open: function() {

                        return;
                        $.magnificPopup.instance.next = function() {
                            var self = this;
                            self.wrap.removeClass( 'mfp-image-loaded' );
                            setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);
                        }
                        $.magnificPopup.instance.prev = function() {
                            var self = this;
                            self.wrap.removeClass( 'mfp-image-loaded' );
                            setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);
                        }

                    },

                    imageLoadComplete: function() {	
                        var self = this;
                        setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
                    },

                }

            },
            args = gallery.data( 'options' ),
            options = $.extend( defaultOptions, args );

        gallery.magnificPopup( options );

    });

}

/* WooCommerce Quantity Buttons
 * @since 1.3
 * @modified in 2.3
--------------------------------------------------------------------------------------------- */
WITHEMES.woocommerce_quantity = function() {

    /* We don't need this while in 2.3, we use template
    * Quantity buttons
    $( 'div.quantity:not(.buttons-added), td.quantity:not(.buttons-added)' )
    .addClass( 'buttons-added' )
    .append( '<input type="button" value="+" class="plus" />' )
    .prepend( '<input type="button" value="-" class="minus" />' );
    */

    // Set min value
    $( 'input.qty:not(.product-quantity input.qty)' ).each ( function() {
        var qty = $( this ),
            min = parseFloat( qty.attr( 'min' ) );
        if ( min && min > 0 && parseFloat( qty.val() ) < min ) {
            qty.val( min );
        }
    });

    // Handle click event
    WITHEMES.cache.$document.on( 'click', '.plus, .minus', function() {

            // Get values
        var qty = $( this ).closest( '.quantity' ).find( '.qty' ),
            currentQty = parseFloat( qty.val() ),
            max = parseFloat( qty.attr( 'max' ) ),
            min = parseFloat( qty.attr( 'min' ) ),
            step = qty.attr( 'step' );

        // Format values
        if ( !currentQty || currentQty === '' || currentQty === 'NaN' ) currentQty = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {

            if ( max && ( max == currentQty || currentQty > max ) ) {
                qty.val( max );
            } else {
                qty.val( currentQty + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentQty || currentQty < min ) ) {
                qty.val( min );
            } else if ( currentQty > 0 ) {
                qty.val( currentQty - parseFloat( step ) );
            }

        }

        // Trigger change event
        qty.trigger( 'change' );

    });

}

/**
 * Wishlist concerning functions
 * https://support.yithemes.com/hc/en-us/articles/115001372967-Wishlist-How-to-count-number-of-products-wishlist-in-ajax
 * @since 2.3
--------------------------------------------------------------------------------------------- */
WITHEMES.wishlist = function() {
    
    if ( typeof( yith_wcwl_l10n ) === 'undefined' || typeof( yith_wcwl_l10n.ajax_url ) === 'undefined' ) return;

    var $header_wish_list = $( '.header-wishlist' );
    if ( ! $header_wish_list.length ) return;

    $( 'body' ).on( 'added_to_wishlist removed_from_wishlist', function() {

        $.ajax({
            url: yith_wcwl_l10n.ajax_url,
            data: {
                action: 'withemes_update_wishlist_count'
            },
            dataType: 'json',
            success: function( data ){
                $header_wish_list.find( '.item-counter' ).html( data.count );
            },
            beforeSend: function(){

            },
            complete: function(){

            }
        })

    });


}

/**
 * Pinterest Widget
 * @since 2.4
--------------------------------------------------------------------------------------------- */
WITHEMES.pinterest = function() {

    if ( ! $().masonry ) return;

    var run = debounce( function() {

        $( '.wi-pin-list' ).each(function() {

            var $this = $( this );

            $this.imagesLoaded( function() {

                $this
                .addClass( 'loaded' )
                .masonry({

                    itemSelector: '.pin-item',
                    columnWidth: '.grid-sizer',

                });

            });

        });


    }, 100 );

    WITHEMES.cache.$window.load(function() {

        run();

    });

    WITHEMES.cache.$window.resize( run );

}
 
/**
 * Finally, call the init
 */
WITHEMES.init();
    
})( window, WITHEMES, jQuery );	// EOF