(function($) {
    "use strict";

    var araviraApp = {
        /* ---------------------------------------------
         Preloader
         --------------------------------------------- */
        preloader: function() {
            var $window = $(window);
            $window.on("load", function() {
                var $body = $("body"),
                    $preloader = $(".preloader");
                $body.imagesLoaded(function() {
                    $preloader.delay(400).slideUp("slow", function() {
                        var $this = $(this);
                        $this.remove();
                    });
                });
            });
        },
        /* ---------------------------------------------
        Header Search
        --------------------------------------------- */
        header_search: function() {
            var $searchSelector = $(".header-top .search-area .fa"),
                $searchArea = $(".header-top .search-area .header-search"),
                $document = $(document);
            $searchSelector.on("click", function(event) {
                event.stopPropagation();
                var $this = $(this);
                $this.next().slideToggle();
            });
            $document.on("click", function(e) {
                if (!$searchArea.is(e.target) && $searchArea.has(e.target).length === 0) {
                    $searchArea.slideUp();
                }
            });
        },
        /* ---------------------------------------------
         Menu
         --------------------------------------------- */
        menu: function() {
            var $combinedmenu = $(".navigation .navbar-nav.mainmenu").clone();
            $combinedmenu.appendTo("#mobile-main-nav #main-mobile-container");

            var $submenu = $(".mainmenu li").has(".sub-menu"),
                $submenuSelector = $(".sub-menu"),
                $mobileNavSelector = $("#main-mobile-container .main-navigation"),
                $mobileNavOverlay = $(".mobile-menu-main .menucontent.overlaybg, .mobile-menu-main .slideLeft"),
                $mobileMenuContent = $(".mobile-menu-main .menucontent"),
                $mobileNavBar = $("#navtoggole-main"),
                $mobileNav = $(".menu-mobile"),
                $menuWrap = $(".menu-list");

            if ($submenu) {
                var $hasSubmenuIcon = $("<span class='fa fa-angle-down'></span>");
                $submenuSelector.prev().append($hasSubmenuIcon);
            }

            // Main Navigation Mobile
            // --------------------------------            
            $mobileNavSelector.addClass("slideLeft");

            var menuopen_main = function() {
                    $mobileNavOverlay.removeClass("menuclose").addClass("menuopen");
                },
                menuclose_main = function() {
                    $mobileNavOverlay.removeClass("menuopen").addClass("menuclose");
                };

            $mobileNavBar.on("click", function() {
                if ($mobileMenuContent.hasClass("menuopen")) {
                    $(menuclose_main);
                } else {
                    $(menuopen_main);
                }
            });
            $mobileMenuContent.on("click", function() {
                if ($mobileMenuContent.hasClass("menuopen")) {
                    $(menuclose_main);
                }
            });

            // Sub Menu
            // -------------------------------- 
            var $mobileExtendBtn = $("<span class='menu-click'><i class='menu-arrow fa fa-plus'></i></span>");
            $submenu.prepend($mobileExtendBtn);

            $mobileNav.on("click", function() {
                $menuWrap.slideToggle("slow");
            });
            var $mobileSubMenuOpen = $(".menu-click");
            $mobileSubMenuOpen.on("click", function() {
                var $this = $(this);
                $this.siblings(".sub-menu").slideToggle("slow");
                $this.children(".menu-arrow").toggleClass("menu-extend");
            });

            // For Last menu
            // --------------------------------
            var $fullMenuElement = $(".navigation .mainmenu li");
            $fullMenuElement.on("mouseenter mouseleave", function(e) {
                var $this = $(this);
                if ($("ul", $this).length) {
                    var elm = $("ul:first", $this),
                        off = elm.offset(),
                        l = off.left,
                        w = elm.width(),
                        docW = $(".header-bottom > .container").width(),
                        isEntirelyVisible = (l + w <= docW);
                    if (!isEntirelyVisible) {
                        $this.addClass("right-side-menu");
                    } else {
                        $this.removeClass("right-side-menu");
                    }
                }
            });
        },

        /* ---------------------------------------------
        Magnifying Pop-up
        --------------------------------------------- */
        popup_window: function() {
            var $popUpVideo = $(".video-popup-btn"),
                $popUpImage = $(".image-popup-btn");
            $popUpVideo.magnificPopup({
                disableOn: 700,
                type: "iframe",
                mainClass: "mfp-fade",
                preloader: false,
                removalDelay: 300,
                fixedContentPos: false
            });
            $popUpImage.magnificPopup({
                type: "image",
                mainClass: "mfp-fade"
            });
        },
        /* ---------------------------------------------
         Coming Soon
         --------------------------------------------- */
        coming_soon: function() {
            var $coundDown = $("#countdown");
            $coundDown.syotimer({
                year: 2018,
                month: 5,
                day: 9,
                hour: 20,
                minute: 30
            });
        },

        /* ---------------------------------------------
        Main Slider
        --------------------------------------------- */
        main_slider: function() {
            var $mainSlider = $("#js-main-slider");
            if ($mainSlider.length) {
                $mainSlider.pogoSlider({
                    autoplay: true,
                    autoplayTimeout: 5000,
                    displayProgess: true,
                    preserveTargetSize: true,
                    targetWidth: 1000,
                    targetHeight: 400,
                    responsive: true
                }).data("plugin_pogoSlider");
            }
        },
        /* ---------------------------------------------
        Calendar
        --------------------------------------------- */
        calendar: function() {
            var $calender = $("input.calendar");
            $calender.pignoseCalendar({
                toggle: true,
                buttons: true
            });
        },
        /* ---------------------------------------------
        Count To
        --------------------------------------------- */
        countto: function() {
            var $funfactCount = $(".count-data");
            $funfactCount.countTo();
        },
        /* ---------------------------------------------
         Home Version Grid Masonry
         --------------------------------------------- */
        grid_masonry: function() {
            var $container = $(".masonry-layout");
            $container.imagesLoaded(function() {
                $container.masonry({
                    itemSelector: ".grid"
                });
            });
        },
        /* ---------------------------------------------
         Home Version Grid Masonry
         --------------------------------------------- */
        dining_scrol: function() {
            var $menuScrollBar = $(".menu-item-list");
            $menuScrollBar.mCustomScrollbar({
                axis: "y",
                theme: "dark",
                scrollInertia: 500
            });
        },
        /* ---------------------------------------------
         Aravira Facility
         --------------------------------------------- */
        aravira_facility: function() {
            var $ourFacilitySelector = $("#aravira-facility"),
                $item = 1;
            $ourFacilitySelector.owlCarousel({
                center: false,
                items: $item,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                singleItem: true,
                loop: true,
                margin: 7,
                nav: true,
                dots: false,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
            });
        },

        /* ---------------------------------------------
         Aravira Hospitality
         --------------------------------------------- */
        aravira_hospitality: function() {
            var $ourHospitality = $(".aravira-hospitality");
            $ourHospitality.owlCarousel({
                center: false,
                items: 4,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                singleItem: true,
                loop: true,
                margin: 30,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    500: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    800: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    },
                    1400: {
                        items: 4
                    }
                }
            });
            $ourHospitality.each(function() {
                var $this = $(this),
                    $next_element = $this.next().find(".next"),
                    $previous_element = $this.next().find(".prev");

                $next_element.on("click", function() {
                    $this.trigger("next.owl.carousel");
                });
                $previous_element.on("click", function() {
                    // With optional speed parameter
                    // Parameters has to be in square bracket '[]'
                    $this.trigger("prev.owl.carousel", [300]);
                });
            });
        },
		
		
        /* ---------------------------------------------
         Aravira Single Room
         --------------------------------------------- */
        aravira_single_room: function() {
            //room single gallery
            var $sync1 = $(".room-thumb-full"),
                $sync2 = $(".room-thumb-list"),
                duration = 300;
            $sync1
                .owlCarousel({
                    rtl: false,
                    items: 1,
                    margin: 10,
                    nav: false,
                    owl2row: "true",
                    owl2rowTarget: "item"
                })
                .on("changed.owl.carousel", function(e) {
                    var syncedPosition = syncPosition(e.item.index);
                    if (syncedPosition !== "stayStill") {
                        $sync2.trigger("to.owl.carousel", [syncedPosition, duration, true]);
                    }
                });
            $sync2
                .owlCarousel({
                    rtl: false,
                    margin: 10,
                    items: 4,
                    nav: true,
                    center: false,
                    dots: false,
                    navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
                    responsive: {
                        0: {
                            items: 2
                        },
                        500: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        800: {
                            items: 4
                        },
                        1000: {
                            items: 4
                        },
                        1200: {
                            items: 4
                        },
                        1400: {
                            items: 4
                        },
                    }
                })
                .on("initialized.owl.carousel", function() {
                    addClassCurrent(0);
                })
                .on("click", ".owl-item", function() {
                    $sync1.trigger("to.owl.carousel", [$(this).index(), duration, true]);

                });

            function addClassCurrent(index) {
                $sync2
                    .find(".owl-item.active")
                    .removeClass("current")
                    .eq(index)
                    .addClass("current");
            }
            addClassCurrent(0);

            function syncPosition(index) {
                addClassCurrent(index);
                var itemsNo = $sync2.find(".owl-item").length;
                var visibleItemsNo = $sync2.find(".owl-item.active").length;

                if (itemsNo === visibleItemsNo) {
                    return "stayStill";
                }
                var visibleCurrentIndex = $sync2.find(".owl-item.active").index($sync2.find(".owl-item.current"));
                if (visibleCurrentIndex === 0 && index !== 0) {
                    return index - 1;
                }
                if (visibleCurrentIndex === (visibleItemsNo - 1) && index !== (itemsNo - 1)) {
                    return index - visibleItemsNo + 2;
                }
                return "stayStill";
            }
        },

        /* ---------------------------------------------
         Page Gallery
         --------------------------------------------- */
        page_gallery: function() {
            var $otherPageCarousel = $(".page-gallery-carousel"),
                $item = 4;
            $otherPageCarousel.owlCarousel({
                center: false,
                items: $item,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                singleItem: true,
                loop: true,
                margin: 0,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 2
                    },
                    500: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    800: {
                        items: 4
                    },
                    1000: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                    1400: {
                        items: 5
                    },
                }
            });
        },

        /* ---------------------------------------------
        Customer Reviews
         --------------------------------------------- */
        customer_reviews: function() {
            var $customerReview = $(".customer-reviews"),
                $item = 2;
            $customerReview.owlCarousel({
                center: false,
                items: $item,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                singleItem: true,
                loop: true,
                margin: 30,
                nav: false,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    500: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    800: {
                        items: 2
                    },
                    1000: {
                        items: 2
                    },
                    1200: {
                        items: 2
                    },
                    1400: {
                        items: 2
                    },
                }
            });
        },

        /* ---------------------------------------------
        Gallery Photo
        --------------------------------------------- */
        gallery_photo: function() {
            var $isotopGallery = $(".gallery-item-content");
            $isotopGallery.each(function() {
                var $this = $(this);
                $this.imagesLoaded(function() { 
                    $this.isotope({
                        filter: '*',
                        animationOptions: {
                            duration: 1000,
                            easing: 'linear',
                            queue: false,
                        }
                    });
                });

                var $filterMenu = $this.prev().find(".gallery-filter-menu li a");
                $filterMenu.on("click", function() {
                    var $thisItem = $(this),
                        $selector = $thisItem.attr("data-filter");
                    $this.isotope({
                        filter: $selector,
                        animationOptions: {
                            duration: 1000,
                            easing: 'linear',
                            queue: false,
                        }
                    });
                    $thisItem.parents("ul").find("li").removeClass("current-tab");
                    $thisItem.parent().addClass("current-tab");
                    return false;
                });
            });
        },
        /* ---------------------------------------------
         Images Gallery
         --------------------------------------------- */
        gallery: function() {
            var $tiledGallery = $("#gallery");
            $tiledGallery.unitegallery({
                tiles_type: "compact",
                tile_overlay_opacity: 0.45,
                theme_gallery_padding: 25
            });
        },

        /* ---------------------------------------------
         Mail Chip
         --------------------------------------------- */
        mailchip: function() {
            var $mailChip = $("#newsletter-form");
            if ($mailChip.length) {
                $mailChip.formchimp();
            }
        },

        /* ---------------------------------------------
         Widget Mobile fix
         --------------------------------------------- */
        widget_mobile: function() {
            var $window = $(window);
            var $windowWidth = $(window).width();
            var prevW = window.innerWidth || $windowWidth;
            
            function debouncer(func, timeout) {
                var timeoutID, timeout = timeout || 500;
                return function () {
                    var scope = this,
                        args = arguments;
                    clearTimeout(timeoutID);
                    timeoutID = setTimeout(function () {
                        func.apply(scope, Array.prototype.slice.call(args));
                    }, timeout);
                }
            }
            function resized() {
                var $getWidgetTitle = $('.widget .widget-title');
                var $getWidgetTitleContent;
                var $detectWindow = $(window).width();

                if ($detectWindow <= 991) {
                    $getWidgetTitleContent = $getWidgetTitle.parent().nextAll().hide();
                    $getWidgetTitle.addClass('expand-margin');
                    $getWidgetTitle.on('click', function(e) {
                        e.stopImmediatePropagation();

                        var $self = $(this);
                        $self.toggleClass('expand');
                        $self.parent().nextAll().slideToggle();
                        return false;
                    });
                } else {
                    $getWidgetTitleContent = $getWidgetTitle.parent().nextAll().show();
                    $getWidgetTitle.removeClass('expand-margin');
                };
            }
            resized();

            $window.resize(debouncer(function (e) {
                var $resizeWindowWidth = $(window).width();
                var currentW = window.innerWidth || $resizeWindowWidth;
                if (currentW != prevW) {
                    resized();
                }
                prevW = window.innerWidth || $resizeWindowWidth;
            }));

            //Mobile Responsive
            var $mobileExtend = $(".extend-btn .extend-icon");
            $mobileExtend.on("click", function(e) {
                e.preventDefault();
                var $this = $(this);
                $this.parent().prev().toggleClass("mobile-extend");
                $this.parent().toggleClass("extend-btn");
                $this.toggleClass("up");
            });
        },

        /* ---------------------------------------------
         Instagram Image
         --------------------------------------------- */
        instafeed: function() {
            var $instaFeed = $("#instafeed");
            if ($instaFeed.length > 0) {
                var userFeed = new Instafeed({
                    limit: 6,
                    get: "user", // Get your Instagram Photo. Use - 'user' or 'tagged'
                    //tagName: 'awesome', // Use your tag, unmarked this if get photo with tag
                    userId: 2070535567, //Your user ID
                    accessToken: "2070535567.a49315a.7e681503c94f4daeb5dbd8e7d594512e", //Your Access token on Instagram
                    resolution: "thumbnail",
                    template: "<div class='list'><a target='_blank' href='{{link}}'><img src='{{image}}' /></a></div>"
                });
                userFeed.run();
            }
        },

        /* ---------------------------------------------
         Maps
        --------------------------------------------- */
        maps: function() {
            var $mapSelector = $("#gmaps");
            if ($mapSelector.length) {
                var map;
                map = new GMaps({
                    el: "#gmaps",
                    lat: 43.04446,
                    lng: -76.130791,
                    scrollwheel: false,
                    zoom: 10,
                    zoomControl: true,
                    panControl: false,
                    streetViewControl: false,
                    mapTypeControl: false,
                    overviewMapControl: false,
                    clickable: false
                });
                var $mapSelectorImage = "images/map-icon.png";
                map.addMarker({
                    lat: 43.04446,
                    lng: -76.130791,
                    icon: $mapSelectorImage,
                    animation: google.maps.Animation.DROP,
                    verticalAlign: "bottom",
                    horizontalAlign: "center"
                });
                var styles = [{
                    stylers: [{
                        hue: "#BBE5C1"
                    }, {
                        saturation: -45
                    }]
                }, {
                    featureType: "landscape",
                    elementType: "geometry",
                    stylers: [{
                        hue: "#FEFACD"
                    }, {
                        saturation: 50
                    }, {
                        lightness: -10
                    }]
                }, {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{
                        hue: "#0090E5"
                    }, {
                        lightness: -35
                    }, {
                        visibility: "simplified"
                    }]
                }, {
                    featureType: "road",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off"
                    }]
                }];
                map.setOptions({
                    styles: styles
                });
            }
        },

        /* ---------------------------------------------
         Scroll Top
         --------------------------------------------- */
        scroll_top: function scrolltop() {
            var $bodyElement = $("body"),
                $window = $(window),
                $scrollHtml = $("<a href='#top' id='scroll-top' class='topbutton btn-hide'><span class='glyphicon glyphicon-menu-up'></span></a>");

            $bodyElement.append($scrollHtml);

            var $scrolltop = $("#scroll-top");
            $window.on("scroll", function() {
                if ($(this).scrollTop() > $(this).height()) {
                    $scrolltop
                        .addClass("btn-show")
                        .removeClass("btn-hide");
                } else {
                    $scrolltop
                        .addClass("btn-hide")
                        .removeClass("btn-show");
                }
            });

            var $selectorAnchor = $("a[href='#top']");
            $selectorAnchor.on("click", function() {
                $("html, body").animate({
                    scrollTop: 0
                }, "normal");
                return false;
            });
        },

        /* ---------------------------------------------
         function initializ
         --------------------------------------------- */
        initializ: function() {
            araviraApp.preloader();
            araviraApp.header_search();
            araviraApp.menu();
            araviraApp.popup_window();
            araviraApp.coming_soon();
            araviraApp.main_slider();
            araviraApp.calendar();
            araviraApp.countto();
            araviraApp.grid_masonry();
            araviraApp.dining_scrol();
            araviraApp.aravira_facility();
            araviraApp.aravira_hospitality();
            araviraApp.aravira_single_room();
            araviraApp.page_gallery();
            araviraApp.customer_reviews();
            araviraApp.gallery_photo();
            araviraApp.gallery();
            araviraApp.mailchip();
            araviraApp.widget_mobile();
            araviraApp.instafeed();
            araviraApp.maps();
            araviraApp.scroll_top();
        }
    };

    /* ---------------------------------------------
     Document ready function
     --------------------------------------------- */
    $(function() {
        araviraApp.initializ();
    });
})(jQuery);