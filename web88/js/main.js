! function(a) {
    "use strict";
	
    var b = {
        initialised: !1,
        version: 1.4,
        mobile: !1,
        menuCollapse: !1,
        isFirefox: navigator.userAgent.toLowerCase().indexOf("firefox") > -1,
        navContainerHeight: null,
        container: a(".portfolio-item-container"),
        init: function() {
            if (!this.initialised) {
                this.initialised = !0, this.checkMobile(), this.checkPlaceholder(), this.getNavContainerHeight(), this.menuHover(), this.responsiveMenu(), this.itemHoverAnimation(), this.searchInput(), this.itemSizeFix(), this.filterColorBg(), this.productZoomImage(), this.responsiveVideo(), this.priceSlider(), this.ratings(), this.collapseArrows(), this.owlCarousels(), this.flexsliders(), this.scrollTopAnimation(), this.filterScrollBar(), this.selectBox(), this.bootstrapSwitch(), this.tooltip(), this.popover(), this.progressBars(), this.prettyPhoto(), this.flickerFeed(), this.parallax(), this.twitterFeed();
                var a = this;
                "function" == typeof imagesLoaded && imagesLoaded(a.container, function() {
                    a.calculateWidth(), a.isotopeActivate(), a.isotopeFilter()
                })
            }
        },
        checkMobile: function() {
            this.mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? !0 : !1
        },
        checkPlaceholder: function() {
            a.support.placeholder = function() {
                var a = document.createElement("input");
                return "placeholder" in a
            }(), !a.support.placeholder && a.fn.placeholder && a("input, textarea").placeholder()
        },
        firefoxMenuFix: function() {
            var b = (a(window).width(), a("#header")),
                c = b.hasClass("header6") || b.hasClass("header7"),
                d = a(".menu");
            if (c && this.isFirefox) {
                var e = d.children("li");
                e.each(function() {
                    var b = a(this),
                        c = b.children("ul"),
                        d = b.position().left;
                    c.length && c.css("left", d)
                })
            }
        },
        getNavContainerHeight: function() {
            a(window).width() > 768 && (this.navContainerHeight = a("#main-nav-container").outerHeight())
        },
        fixNavContainerHeight: function() {
            a(window).width() <= 768 && a(".fixed-wrapper").length && a(".fixed-wrapper").css("height", "auto")
        },
        stickyMenu: function() {
            var b = this,
                c = a(window).scrollTop(),
                d = a(window).width(),
                e = a("#header"),
                f = a("#main-nav-container"),
                g = (f.height(), f.offset().top),
                h = e.height() - b.navContainerHeight;
            c >= g && c > h && d > 768 ? (f.closest(".fixed-wrapper").length || f.wrap(function() {
                return '<div class="fixed-wrapper" style="height:' + b.navContainerHeight + 'px"></div>'
            }), f.addClass("fixed")) : f.removeClass("fixed")
        },
        menuHover: function() {
            a.fn.hoverIntent && a("ul.menu").hoverIntent({
                over: function() {
                    a(window).width() > 768 && a(this).addClass("active").children("ul, .mega-menu").fadeIn(200)
                },
                out: function() {
                    a(window).width() > 768 && a(this).removeClass("active").children("ul, .mega-menu").fadeOut(75)
                },
                selector: "li",
                timeout: 145,
                interval: 55
            })
        },
        responsiveMenu: function() {
            var b = a(".menu").clone(!0).removeClass("menu").addClass("responsive-nav"),
                c = a("#responsive-nav");
            c.append(b), c.find("li, .col-2, .col-3, .col-4, .col-5").each(function() {
                var b = a(this);
                b.hasClass("mega-menu-container") && b.removeClass("mega-menu-container"), b.has("ul, .megamenu").prepend('<span class="menu-button"></span>')
            }), a("span.menu-button").on("click", function() {
                var b = a(this);
                b.hasClass("active") ? a(this).removeClass("active").siblings("ul, .mega-menu").slideUp("800") : a(this).addClass("active").siblings("ul, .mega-menu").slideDown("800")
            }), a("#responsive-nav-button").on("click", function() {
                var b = a(this);
                b.hasClass("active") ? a("#responsive-nav").find(".responsive-nav").slideUp(300, function() {
                    b.removeClass("active")
                }) : a("#responsive-nav").find(".responsive-nav").slideDown(300, function() {
                    b.addClass("active")
                })
            })
        },
        itemAnimationIn: function() {
            var b = a(this),
                c = b.find(".icon-cart-text"),
                d = b.width(),
                e = b.find(".ratings-amount"),
                f = b.find(".item-action-inner");
            220 > d && c.animate({
                width: "hide"
            }, 100, function() {
                a(this).closest(".item-add-btn").addClass("icon-cart")
            }), e.animate({
                width: "show"
            }, 300), f.css({
                visibility: "visible",
                overflow: "hidden",
                "padding-left": 10
            }).animate({
                width: 85
            }, 300)
        },
        itemAnimationOut: function() {
            var b = a(this),
                c = b.find(".icon-cart-text"),
                d = b.width(),
                e = b.find(".ratings-amount"),
                f = b.find(".item-action-inner");
            220 > d && c.animate({
                width: "show"
            }, 300).closest(".item-add-btn").removeClass("icon-cart"), e.animate({
                width: "hide"
            }, 300), f.animate({
                width: 0
            }, 300, function() {
                a(this).css("padding-left", 0)
            }).css({
                visibility: "hidden",
                overflow: "hidden"
            })
        },
        itemHoverAnimation: function() {
            var b = this;
            a.fn.hoverIntent ? a(".item-hover").hoverIntent(b.itemAnimationIn, b.itemAnimationOut) : a(".item-hover").on("mouseover", b.itemAnimationIn).on("mouseleave", b.itemAnimationOut)
        },
        itemSizeFix: function() {
            var b = a("#content"),
                c = b.find(".item");
            c.each(function() {
                var b = a(this);
                b.hasClass("item-hover") || b.closest(".carousel-inner").length || (b.width() < 220 ? (b.find(".icon-cart-text").fadeOut(20, function() {
                    a(this).closest(".item-add-btn").addClass("icon-cart")
                }), b.find(".ratings-container.pull-right, .item-price-container.pull-left").css({
                    "float": "none",
                    display: "block",
                    width: "100%"
                }), b.find(".item-price-container.pull-left").css("margin-bottom", 10), b.find(".item-action").css("text-align", "center")) : (b.find(".icon-cart-text").fadeIn(10).closest(".item-add-btn").removeClass("icon-cart"), b.find(".ratings-container.pull-right").css({
                    "float": "right",
                    width: "auto"
                }), b.find(".item-price-container.pull-left").css({
                    "float": "left",
                    width: "auto",
                    "margin-bottom": 0
                }), b.find(".item-action").css("text-align", "left")))
            })
        },
       
	   searchInput: function() {
            var b = !0;
            a("#quick-search").on("click", function(c) {
                var d = a(this),
                    e = d.closest(".quick-search-form"),
                    f = e.find(".form-control"),
                    g = a.trim(f.val());
                if ("" === g) {
                    var h = e.find(":hidden.form-group"),
                        i = e.find(".form-group ");
                    b ? h.animate({
                        width: "show"
                    }, 400, function() {
                        b = !1
                    }) : i.animate({
                        width: "hide"
                    }, 400, function() {
                        b = !0
                    }), c.preventDefault()
                }
            })
        },
        filterColorBg: function() {
            a(".filter-color-box").each(function() {
                var b = a(this),
                    c = b.data("bgcolor");
                b.css("background-color", c)
            })
        },
        twitterFeed: function() {
            a.fn.tweet && a(".twitter_feed").length && (a(".twitter_feed").tweet({
                modpath: "./js/twitter/",
                avatar_size: "",
                count: 4,
                query: "themeforest",
                loading_text: "searching twitter...",
                join_text: "",
                template: "{join}{text}{time}"
            }), a(".twitter_feed.flexslider").flexslider({
                animation: "slide",
                selector: ".tweet_list > li",
                controlNav: !1,
                prevText: "",
                nextText: "",
                animationLoop: !0,
                smoothHeight: !0,
                slideshowSpeed: 5e3
            })), a.fn.tweet && a(".twitter_feed_widget").length && a(".twitter_feed_widget").tweet({
                modpath: "./js/twitter/",
                avatar_size: "",
                count: 2,
                query: "themeforest",
                loading_text: "searching twitter...",
                join_text: "",
                template: "{join}{text}{time}"
            })
        },
        productZoomImage: function() {
            {
                var b = this,
                    c = a("#product-carousel");
                a("#product-image")
            }
            a.fn.elastislide && c.elastislide({
                orientation: "vertical",
                minItems: 4
            }), a.fn.elevateZoom && (a("#product-image").elevateZoom({
                responsive: !0,
                zoomType: b.mobile || a(window).width() < 768 ? "inner" : "lens",
                borderColour: "#d0d0d0",
                cursor: "crosshair",
                borderSize: 2,
                lensSize: 180,
                lensOpacity: 1,
                lensColour: "rgba(255, 255, 255, 0.25)"
            }), a("#product-carousel").find("a").on("mouseover", function(b) {
                var c = a("#product-image").data("elevateZoom"),
                    d = a(this).data("image"),
                    e = a(this).data("zoom-image");
                c.swaptheimage(d, e), b.preventDefault()
            }))
        },
        responsiveVideo: function() {
            a.fn.fitVids && a("body").fitVids()
        },
        priceSlider: function() {
            a.fn.noUiSlider && a("#price-range").noUiSlider({
                range: [0, 99999],
                start: [0, 99999],
                handles: 2,
                connect: !0,
                step: 1,
                serialization: {
                    to: [a("#price-range-low"), a("#price-range-high")],
                    resolution: 1
                }
            })
        },
        ratings: function() {
            a.each(a(".ratings-result"), function() {
                var b = a(this),
                    c = b.closest(".ratings").width(),
                    d = a(this).data("result"),
                    e = c / 100 * d;
                a(this).css("width", e)
            })
        },
        collapseArrows: function() {
            a(".panel-title").on("click", function() {
                var b = a(this),
                    c = b.find("a").attr("href");
                a(c).on("shown.bs.collapse", function() {
                    b.find(".icon-box").html("&minus;")
                }).on("hidden.bs.collapse", function() {
                    b.find(".icon-box").html("&plus;")
                })
            }), a(".accordion-btn").on("click", function() {
                var b = a(this),
                    c = b.data("target");
                a(c).on("shown.bs.collapse", function() {
                    b.addClass("opened")
                }).on("hidden.bs.collapse", function() {
                    b.hasClass("opened") && b.removeClass("opened")
                })
            })
        },
        checkSupport: function(a, b) {
            return a.length && b ? !0 : !1
        },
        owlCarousels: function() {
            var b = this,
                c = a("div.brand-slider.owl-carousel");
            b.checkSupport(c, a.fn.owlCarousel) && c.owlCarousel({
                items: 6,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [979, 4],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 600,
                autoPlay: 1e4,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#brand-slider-prev", "#brand-slider-next"]);
            var d = a(".latest-tab-slider.owl-carousel");
            b.checkSupport(d, a.fn.owlCarousel) && d.owlCarousel({
                items: 4,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 7200,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#latest-tab-slider-prev", "#latest-tab-slider-next"]);
            var e = a(".featured-tab-slider.owl-carousel");
            b.checkSupport(e, a.fn.owlCarousel) && e.owlCarousel({
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 7200,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#featured-tab-slider-prev", "#featured-tab-slider-next"]);
            var f = a(".bestsellers-tab-slider.owl-carousel");
            b.checkSupport(f, a.fn.owlCarousel) && f.owlCarousel({
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 4900,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#bestsellers-tab-slider-prev", "#bestsellers-tab-slider-next"]);
            var g = a(".special-tab-slider.owl-carousel");
            b.checkSupport(g, a.fn.owlCarousel) && g.owlCarousel({
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 6500,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#special-tab-slider-prev", "#special-tab-slider-next"]);
            var h = {
                items: 4,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 7200,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !0,
                autoHeight: !0
            };
            a("#products-tabs-list").find("a").on("shown.bs.tab", function(b) {
                var c = a(b.target).attr("href"),
                    d = a(c).find(".owl-carousel");
                d.length && d.data("owlCarousel").reinit(h)
            });
            var i = a(".latestnews-slider.owl-carousel");
            b.checkSupport(i, a.fn.owlCarousel) && i.owlCarousel({
                items: 2,
                itemsDesktop: [1199, 2],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 860,
                autoPlay: 8e3,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#latestnews-slider-prev", "#latestnews-slider-next"]);
            
			var j = a(".services-slider.owl-carousel");
            b.checkSupport(j, a.fn.owlCarousel) && j.owlCarousel({
                items: 3,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 860,
                autoPlay: 7500,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#services-slider-prev", "#services-slider-next"]);
			
			var j1 = a(".hot-items-slider.owl-carousel");
            b.checkSupport(j1, a.fn.owlCarousel) && j1.owlCarousel({
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 860,
                autoPlay: 7500,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                autoHeight: !0
            }).data("navigationBtns", ["#hot-items-slider-prev", "#hot-items-slider-next"]);
			
            var k = a(".purchased-items-slider.owl-carousel");
            b.checkSupport(k, a.fn.owlCarousel) && k.owlCarousel({
                items: 6,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 8e3,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !1,
                autoHeight: !0
            }).data("navigationBtns", ["#purchased-items-slider-prev", "#purchased-items-slider-next"]);
            var l = a(".similiar-items-slider.owl-carousel");
            b.checkSupport(l, a.fn.owlCarousel) && l.owlCarousel({
                items: 6,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 8e3,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !1,
                autoHeight: !0
            }).data("navigationBtns", ["#similiar-items-slider-prev", "#similiar-items-slider-next"]);
            var m = a(".related-portfolio.owl-carousel");
            b.checkSupport(m, a.fn.owlCarousel) && m.owlCarousel({
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                slideSpeed: 400,
                autoPlay: 8e3,
                stopOnHover: !0,
                navigation: !1,
                pagination: !1,
                responsive: !0,
                mouseDrag: !1,
                autoHeight: !0
            }).data("navigationBtns", ["#related-slider-prev", "#related-slider-next"]), b.checkSupport(a(".owl-carousel"), a.fn.owlCarousel) && a(".owl-carousel").each(function() {
                var b, c, d = a(this),
                    e = d.data("owlCarousel"),
                    f = d.data("navigationBtns");
                if ("undefined" != typeof e && "undefined" != typeof f) {
                    for (var g in f) - 1 == f[g].indexOf("next") ? b = a(f[g]) : c = a(f[g]);
                    b.on("click touchstart", function(a) {
                        e.prev(), a.preventDefault()
                    }), c.on("click touchstart", function(a) {
                        e.next(), a.preventDefault()
                    })
                }
            })
        },
        flexsliders: function() {
            a.fn.flexslider && (a(".category-image-slider.flexslider").flexslider({
                animation: "slide",
                animationLoop: !0,
                prevText: "",
                nextText: "",
                controlNav: !1,
                smoothHeight: !0,
                slideshowSpeed: 6500
            }), a(".latest-posts-slider.flexslider").flexslider({
                animation: "slide",
                selector: ".latest-posts-list > li",
                prevText: "",
                nextText: "",
                controlNav: !1,
                smoothHeight: !0,
                slideshowSpeed: 6e3
            }), a(".recent-posts-slider.flexslider").flexslider({
                animation: "slide",
                selector: ".recent-posts-list > li",
                prevText: "",
                nextText: "",
                controlNav: !1,
                smoothHeight: !0,
                slideshowSpeed: 5500
            }), a(".testimonials-slider.flexslider").flexslider({
                animation: "fade",
                selector: ".testimonials-list > li",
                prevText: "",
                nextText: "",
                controlNav: !1,
                slideshowSpeed: 4800
            }), a(".featured-slider.flexslider").flexslider({
                animation: "slide",
                selector: ".featured-list > li",
                controlNav: !1,
                prevText: "",
                nextText: "",
                smoothHeight: !0,
                slideshowSpeed: 7e3
            }), a(".related-slider.flexslider").flexslider({
                animation: "slide",
                selector: ".related-list > li",
                controlNav: !1,
                prevText: "",
                nextText: "",
                smoothHeight: !0,
                slideshowSpeed: 7e3
            }), a(".banner-slider.flexslider").flexslider({
                animation: "fade",
                selector: ".banner-slider-list > li",
                directionNav: !1,
                controlNav: !0,
                prevText: "",
                nextText: "",
                slideshowSpeed: 6500
            }), a(".about-us-testimonials.flexslider").flexslider({
                animation: "slide",
                controlNav: !0,
                directionNav: !1,
                animationLoop: !0,
                smoothHeight: !0,
                slideshowSpeed: 6e3
            }), a(".single-portfolio-slider.flexslider").flexslider({
                animation: "slide",
                controlNav: !1,
                directionNav: !0,
                animationLoop: !0,
                smoothHeight: !0,
                slideshowSpeed: 6e3
            }), a(".footer-popular-slider.flexslider").flexslider({
                animation: "slide",
                controlNav: !1,
                prevText: "",
                nextText: "",
                smoothHeight: !0,
                slideshowSpeed: 8e3
            }), a(".footer-featured-slider.flexslider").flexslider({
                animation: "slide",
                controlNav: !1,
                prevText: "",
                nextText: "",
                smoothHeight: !0,
                slideshowSpeed: 1e4
            }), a(".footer-specials-slider.flexslider").flexslider({
                animation: "slide",
                controlNav: !1,
                prevText: "",
                nextText: "",
                smoothHeight: !0,
                slideshowSpeed: 9e3
            }))
        },
        scrollTopBtnAppear: function() {
            var b = a(window).scrollTop(),
                c = a("#scroll-top");
            b >= 300 ? c.addClass("fixed") : c.removeClass("fixed")
        },
        scrollTopAnimation: function() {
            a("#scroll-top").on("click", function(b) {
                a("html, body").animate({
                    scrollTop: 0
                }, 1200), b.preventDefault()
            })
        },
        filterScrollBar: function() {
            var b = a(".category-filter-list.jscrollpane"),
                c = function(a) {
                    var b = a.height();
                    b > 300 && (a.css("height", 300), a.jScrollPane({
                        showArrows: !1
                    }))
                };
            a.each(b, function() {
                var b = a(this);
                c(b)
            }), a("#category-filter").find(".collapse").on("shown.bs.collapse", function() {
                var b = a(this).find(".category-filter-list.jscrollpane");
                c(b)
            })
        },
		
        fixfilterScrollBar: function() {
            a(".category-filter-list.jscrollpane").each(function() {
                var b, c = a(this).data("jsp");
                b || (b = setTimeout(function() {
                    c && c.reinitialise(), b = null
                }, 50))
            })
        },
        selectBox: function() {
            a.fn.selectbox && a(".selectbox").selectbox({
                effect: "fade",
                onChange: function() {}
            })
        },
        bootstrapSwitch: function() {
            a.fn.bootstrapSwitch && a(".switch").bootstrapSwitch()
        },
        tooltip: function() {
            a.fn.tooltip && a(".add-tooltip").tooltip()
        },
        popover: function() {
            a.fn.popover && a(".add-popover").popover({
                trigger: "focus"
            })
        },
        progressBars: function() {
            a.fn.appear ? (a(".progress-animate").appear(), a(".progress-animate").on("appear", function() {
                var b = a(this),
                    c = a(this).data("width"),
                    d = b.find(".progress-text");
                b.css({
                    width: c + "%"
                }, 400), d.fadeIn(500)
            })) : a(".progress-animate").each(function() {
                var b = a(this),
                    c = a(this).data("width"),
                    d = b.find(".progress-text");
                b.css({
                    width: c + "%"
                }, 400), d.fadeIn(500)
            })
        },
        scrollAnimations: function() {
            "function" == typeof WOW && new WOW({
                boxClass: "wow",
                animateClass: "animated",
                offset: 0
            }).init()
        },
        prettyPhoto: function() {
            a.fn.prettyPhoto && a("a[data-rel^='prettyPhoto']").prettyPhoto({
                hook: "data-rel",
                animation_speed: "fast",
                slideshow: 6e3,
                autoplay_slideshow: !0,
                show_title: !1,
                deeplinking: !1,
                social_tools: "",
                overlay_gallery: !0,
                theme: "light_square"
            })
        },
        tabMenuHeight: function(b) {
            var c = a(".tab-container.left, .tab-container.right"),
                d = c.find(".tab-pane.active").outerHeight(),
                e = c.find(".nav-tabs");
            d > b ? (e.css("height", d), e.find("li:last-child").find("a").css("border-bottom-color", "#dcdcdc")) : (e.css("height", b), e.find("li:last-child").find("a").css("border-bottom-color", "transparent"))
        },
        flickerFeed: function() {
            a.fn.jflickrfeed && a("ul.flickr-feed-list").jflickrfeed({
                limit: 6,
                qstrings: {
                    id: "52617155@N08"
                },
                itemTemplate: '<li><a data-rel="prettyPhoto[gallery-flickr]" href="{{image}}" title="{{title}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
            }, function() {
                a.fn.prettyPhoto && a("a[data-rel^='prettyPhoto']").prettyPhoto({
                    hook: "data-rel",
                    animation_speed: "fast",
                    slideshow: 6e3,
                    autoplay_slideshow: !0,
                    show_title: !1,
                    deeplinking: !1,
                    social_tools: "",
                    overlay_gallery: !0,
                    theme: "light_square"
                })
            })
        },
        parallax: function() {
            !b.mobile && a.fn.parallax && (a("#page-header").addClass("parallax").parallax("50%", .4), a("#testimonials-section").addClass("parallax").parallax("50%", .4))
        },
        calculateWidth: function() {
            var b, c = a(window).width(),
                d = this.container.width(),
                e = this.container.data("maxcolumn");
            b = c > 1170 ? e ? e : 5 : c > 960 ? e ? e : 4 : c > 768 ? 3 : c > 540 ? 2 : 1;
            var f = this.container.find(".portfolio-item");
            b >= 4 && f.hasClass("wide") ? (this.container.find(".wide").css("width", 2 * Math.floor(d / b)), f.not(".wide").css("width", Math.floor(d / b))) : f.css("width", Math.floor(d / b))
        },
        isotopeActivate: function() {
            if (a.fn.isotope) {
                var b = this.container,
                    c = b.data("layoutmode");
                b.isotope({
                    itemSelector: ".portfolio-item",
                    layoutMode: c ? c : "masonry"
                }).data("isotope")
            }
        },
        isotopeReinit: function() {
            a.fn.isotope && (this.container.isotope("destroy"), this.isotopeActivate())
        },
        isotopeFilter: function() {
            var b = this,
                c = a("#portfolio-filter");
            c.find("a").on("click", function(d) {
                var e = a(this),
                    f = e.attr("data-filter");
                c.find(".active").removeClass("active"), b.container.isotope({
                    filter: f
                }), e.addClass("active"), d.preventDefault()
            })
        }
    };
    b.init(), a(window).on("load", function() {
        b.scrollAnimations()
    }), a(window).on("scroll", function() {
        b.scrollTopBtnAppear(), b.stickyMenu()
    }), a.event.special.debouncedresize ? a(window).on("debouncedresize", function() {
        b.fixfilterScrollBar(), b.stickyMenu(), b.fixNavContainerHeight(), b.calculateWidth(), b.isotopeReinit(), b.firefoxMenuFix(), b.itemSizeFix()
    }) : a(window).on("resize", function() {
        b.fixfilterScrollBar(), b.stickyMenu(), b.fixNavContainerHeight(), b.calculateWidth(), b.isotopeReinit(), b.firefoxMenuFix(), b.itemSizeFix()
    }), a(window).on("resize load", function() {
        var c = a(window).width(),
            d = a(".tab-container.left, .tab-container.right"),
            e = d.find("ul.nav-tabs").outerHeight();
        c > 767 && (b.tabMenuHeight(e), a(".tab-container").find("ul.nav-tabs").find("a").on("shown.bs.tab", function() {
            b.tabMenuHeight(e)
        }))
    })
}(jQuery),
function() {
    "use strict";

    function a() {
        var a = new google.maps.LatLng(51.520068, -.156299),
            b = {
                center: a,
                zoom: 15,
                scrollwheel: !1,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{
                    elementType: "geometry",
                    stylers: [{
                        hue: "#000"
                    }, {
                        weight: 1
                    }, {
                        saturation: -200
                    }, {
                        gamma: .7
                    }, {
                        visibility: "on"
                    }]
                }]
            }, c = new google.maps.Map(document.getElementById("map"), b),
            d = "images/pin.png";
        new google.maps.Marker({
            position: a,
            map: c,
            icon: d,
            animation: google.maps.Animation.DROP,
            title: "Venedor"
        })
    }
    document.getElementById("map") && google.maps.event.addDomListener(window, "load", a)
}(),
function(a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
}(function(a) {
    function b(a) {
        return h.raw ? a : encodeURIComponent(a)
    }

    function c(a) {
        return h.raw ? a : decodeURIComponent(a)
    }

    function d(a) {
        return b(h.json ? JSON.stringify(a) : String(a))
    }

    function e(a) {
        0 === a.indexOf('"') && (a = a.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
        try {
            return a = decodeURIComponent(a.replace(g, " ")), h.json ? JSON.parse(a) : a
        } catch (b) {}
    }

    function f(b, c) {
        var d = h.raw ? b : e(b);
        return a.isFunction(c) ? c(d) : d
    }
    var g = /\+/g,
        h = a.cookie = function(e, g, i) {
            if (void 0 !== g && !a.isFunction(g)) {
                if (i = a.extend({}, h.defaults, i), "number" == typeof i.expires) {
                    var j = i.expires,
                        k = i.expires = new Date;
                    k.setTime(+k + 864e5 * j)
                }
                return document.cookie = [b(e), "=", d(g), i.expires ? "; expires=" + i.expires.toUTCString() : "", i.path ? "; path=" + i.path : "", i.domain ? "; domain=" + i.domain : "", i.secure ? "; secure" : ""].join("")
            }
            for (var l = e ? void 0 : {}, m = document.cookie ? document.cookie.split("; ") : [], n = 0, o = m.length; o > n; n++) {
                var p = m[n].split("="),
                    q = c(p.shift()),
                    r = p.join("=");
                if (e && e === q) {
                    l = f(r, g);
                    break
                }
                e || void 0 === (r = f(r)) || (l[q] = r)
            }
            return l
        };
    h.defaults = {}, a.removeCookie = function(b, c) {
        return void 0 === a.cookie(b) ? !1 : (a.cookie(b, "", a.extend({}, c, {
            expires: -1
        })), !a.cookie(b))
    }
}),
function(a) {
    function b(a) {
        var b, c = "|" + a.replace(" ", "+") + ":400,700,400italic",
            d = i.attr("href"); - 1 == d.indexOf(a) && (b = d + "" + c, i.attr("href", b))
    }
    var c = a("div#option-panel"),
        d = c.outerWidth(),
        e = c.offset().left,
        f = 0 > e ? !1 : !0;
    a("#option-panel-btn").on("click", function() {
        f || (c.animate({
            left: 0
        }, 400, function() {
            f = !0
        }), a(this).removeClass("closed").addClass("opened"))
    }), a("#option-close").on("click", function(b) {
        f && (c.animate({
            left: -d
        }, 400, function() {
            f = !1
        }), a("#option-panel-btn").removeClass("opened").addClass("closed")), b.preventDefault()
    }), a('a[data-toggle="tab"]').on("shown.bs.tab", function(b) {
        var c = a(b.target).data("panel-title");
        a("#option-panel-title").find("span").text(c)
    });
    var g = a("#custom-style");
    if (a("#option-panel-reset").on("click", function(b) {
        "undefined" != typeof a.cookie("layoutMode") && a.removeCookie("layoutMode"), "undefined" != typeof a.cookie("bgPattern") && a.removeCookie("bgPattern"), "undefined" != typeof a.cookie("bgColor") && a.removeCookie("bgColor"), "undefined" != typeof a.cookie("firstColor") && a.removeCookie("firstColor"), "undefined" != typeof a.cookie("firstColor2") && a.removeCookie("firstColor2"), "undefined" != typeof a.cookie("secondColor") && a.removeCookie("secondColor"), "undefined" != typeof a.cookie("thirdColor") && a.removeCookie("thirdColor"), "undefined" != typeof a.cookie("fourthColor") && a.removeCookie("fourthColor"), "undefined" != typeof a.cookie("bgColor") && a.removeCookie("bgColor"), "undefined" != typeof a.cookie("first-font") && a.removeCookie("first-font"), "undefined" != typeof a.cookie("second-font") && a.removeCookie("second-font"), "undefined" != typeof a.cookie("third-font") && a.removeCookie("third-font"), "undefined" != typeof a.cookie("fourth-font") && a.removeCookie("fourth-font"), location.reload(), b.preventDefault()
    }), "undefined" == typeof a.cookie("layoutMode") || a("#wrapper").hasClass("boxed") || a("#wrapper").addClass("boxed"), "undefined" != typeof a.cookie("bgPattern") && a("body").css("background", "url(" + a.cookie("bgPattern") + ") repeat"), "undefined" != typeof a.cookie("bgColor") && a("body").css("background", a.cookie("bgColor")), "undefined" != typeof a.cookie("firstColor") || "undefined" != typeof a.cookie("firstColor2") || "undefined" != typeof a.cookie("secondColor") || "undefined" != typeof a.cookie("thirdColor") || "undefined" != typeof a.cookie("fourthColor")) {
        var h;
        "undefined" != typeof a.cookie("firstColor") && (h += a.cookie("firstColor")), "undefined" != typeof a.cookie("firstColor2") && (h += a.cookie("firstColor2")), "undefined" != typeof a.cookie("secondColor") && (h += a.cookie("secondColor")), "undefined" != typeof a.cookie("thirdColor") && (h += a.cookie("thirdColor")), "undefined" != typeof a.cookie("fourthColor") && (h += a.cookie("fourthColor")), g.text(h)
    }
    a.fn.colpick && (a("#panel-color-picker").colpick({
        flat: !0,
        layout: "hex",
        submit: 0,
        onChange: function(b, c) {
            a("body").css("background", "#" + c)
        }
    }).mouseup(function() {
        if (a.cookie("bgPattern") && a.removeCookie("bgPattern"), a("#wrapper").hasClass("boxed") && a.cookie("layoutMode", "boxed")) {
            var b = a("body").css("background-color");
            a.cookie("bgColor", b)
        } else alert("Please change layout mode to the boxed.")
    }), a(".color-box.first-color").colpick({
        colorScheme: "dark",
        layout: "rgbhex",
        color: "6dbcdb",
        onSubmit: function(b, c, d, e) {
            var f = "a, #header-top #top-links li > a:hover, #header-top .header-link a, #inner-header .header-box a:hover,#inner-header .header-box i,#main-nav-container #main-nav .menu li:hover > a, #main-nav-container #main-nav .menu li > ul li > ul li:hover > a,#main-nav-container #main-nav .menu li .mega-menu .mega-menu-list li,#main-nav-container #main-nav .menu li .mega-menu .mega-menu-title:hover,#main-nav-container #main-nav .menu li .mega-menu .mega-menu-list li:hover > a,#main-nav-container #main-nav #responsive-nav ul li a:hover, #main-nav-container #main-nav #responsive-nav ul li .mega-menu .mega-menu-list li,#main-nav-container #main-nav #responsive-nav ul li .mega-menu .mega-menu-title:hover,#main-nav-container #main-nav #responsive-nav ul li .mega-menu .mega-menu-list li:hover > a,.menu-button:hover, .dropdown-cart .dropdown-cart-product-list .edit-item:hover,.dropdown-cart .dropdown-cart-product-list .delete-item:hover, .dropdown-cart-total li,.dropdown-cart-total li  .sub-price, .item-name a:hover, #category-breadcrumb .breadcrumb a:hover,.input-group-addon, .portfolio-item > figure > figcaption > .like-button:hover,.portfolio-item h2 a:hover, .portfolio-item p a:hover, .portfolio-meta-list li a:hover,.featured-slider .featured-product h5 a:hover,.related-slider .related-product h5 a:hover,.category-filter-list li a:hover, .article h2 a:hover,.article .article-content-container a:hover,.sidebar .widget .panel a:hover, .sidebar .widget .tags-list li a:hover,.rate-this:hover, .no-content-comment h2, .services-box h3 a:hover { color: #" + c + ";}",
                h = "#responsive-nav-button:hover #responsive-nav-button-icon,#responsive-nav-button.active  #responsive-nav-button-icon, .tab-style-1 li a:hover,.tab-style-1 li.active a, .new-rect, .item-add-btn:hover, .item-add-btn:focus, .item-add-btn:active, .item-add-btn.active,.banner-slider .flex-control-paging li a.flex-active, #breadcrumb-container, .input-desc-box .icon-box,.portfolio-item > figure > figcaption > .zoom-button, .portfolio-item > figure > figcaption > .link-button,.category-image-slider-container .new-rect, .select-dropdown:hover .dropdown-toggle, .select-dropdown .dropdown-menu > li > a:hover, .noUi-connect, .noUi-handle, .pagination > li > a:hover,.pagination > li > span:hover, .pagination > li > a:focus,.pagination > li > span:focus,.icon-button, .custom-quantity-input .quantity-btn:hover, .close-button:hover, #scroll-top,.btn-custom,.btn-custom-2:hover,.btn-custom-2:focus,.btn-custom-2:active,.btn-custom-2.active,.open .dropdown-toggle.btn-custom-2,.btn-custom-3:hover, .btn-custom-3:focus, .btn-custom-3:active,.btn-custom-3.active,.open .dropdown-toggle.btn-custom-3,#option-panel .colorbox-list li .first-color span, .progress-bar-custom, .small-bottom-border,.sequence-pagination li.current { background-color : #" + c + ";}";
            h += ".tab-style-1 li a:hover, .tab-style-1 li.active a, #main-nav-container #main-nav ul li .mega-menu,.portfolio-item > figure > figcaption > .zoom-button, .portfolio-item > figure > figcaption > .link-button, .select-dropdown:hover .dropdown-toggle, .pagination > li > a:hover,.pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus,.sidebar .widget .panel a:hover .icon-box, .icon-button, .custom-quantity-input .quantity-btn:hover,.close-button:hover, #scroll-top, .item-add-btn:hover, .item-add-btn:focus, .btn-custom-2:hover,.btn-custom-2:focus, .btn-custom-3:hover,.btn-custom-3:focus { border-color : #" + c + ";}", f += "#header-top, #main-nav-container #main-nav .menu li ul, #main-nav-container #main-nav .menu li ul li ul,#main-nav-container #main-nav .menu li .mega-menu { border-top-color : #" + c + ";}", h += ".title { border-left-color : #" + c + ";}";
            var i = g.text();
            g.text(i + " " + f + " " + h), a.cookie("firstColor", f), a.cookie("firstColor2", h), a(e).find("span").css("background-color", "#" + c), a(e).colpickHide()
        }
    }), a(".color-box.second-color").colpick({
        colorScheme: "dark",
        layout: "rgbhex",
        color: "fd5c48",
        onSubmit: function(b, c, d, e) {
            var f = "a:hover,#footer a:hover,#footer .links li    { color: #" + c + ";}";
            f += '.carousel-btn:hover, #option-panel .colorbox-list li .second-color span,.flexnavdefault .flex-direction-nav a:hover,.flexslider:hover .flex-next:hover,.flexslider:hover .flex-prev:hover,.btn-custom:hover,.btn-custom:focus,.btn-custom:active,.btn-custom.active,.open .dropdown-toggle.btn-custom,#scroll-top:hover,#footer #twitterfeed-container, .accordion-btn:hover,.accordion-btn.active,.icon-button:hover,.icon-button:focus,.icon-button:active,.icon-button.active,.product-extra .icon-button:hover, .elastislide-wrapper nav span:hover, .sidebarslider .flex-direction-nav a:hover, #header .dropdown-menu > li > a:hover, #header .dropdown-menu > li > a:focus, .custom-checkbox  input[type="checkbox"]:checked + .checbox-container,#portfolio-filter li a:hover,#portfolio-filter li a.active,.category-toolbar .icon-button:hover,.category-toolbar .icon-button:focus,.category-toolbar .icon-button:active,.category-toolbar .icon-button.active, .portfolio-btn:hover, .sequence-next:hover, .sequence-prev:hover  { background-color : #' + c + ";}", f += '.carousel-btn:hover, .flexnavdefault .flex-direction-nav a:hover,.flexslider:hover .flex-next:hover,.flexslider:hover .flex-prev:hover,#scroll-top:hover,.accordion-btn:hover,.accordion-btn.active,.icon-button:hover,.icon-button:focus,.icon-button:active,.icon-button.active,.elastislide-wrapper nav span:hover, .sidebarslider .flex-direction-nav a:hover,.custom-checkbox  input[type="checkbox"]:checked + .checbox-container,.category-toolbar .icon-button:hover,.category-toolbar .icon-button:focus,.category-toolbar .icon-button:active,.category-toolbar .icon-button.active, .portfolio-btn:hover,.sequence-next:hover, .sequence-prev:hover { border-color : #' + c + ";}", f += "#main-nav-container #main-nav #responsive-nav ul, #quick-access .dropdown-cart .dropdown-cart-menu { border-top-color : #" + c + ";}";
            var h = g.text();
            g.text(h + " " + f), a.cookie("secondColor", f), a(e).find("span").css("background-color", "#" + c), a(e).colpickHide()
        }
    }), a(".color-box.third-color").colpick({
        colorScheme: "dark",
        layout: "rgbhex",
        color: "d51a03",
        onSubmit: function(b, c, d, e) {
            var f = ".discount-rect, .category-image-slider-container .discount-rect,#option-panel .colorbox-list li .third-color span { background-color : #" + c + ";}",
                h = g.text();
            g.text(h + " " + f), a.cookie("thirdColor", f), a(e).find("span").css("background-color", "#" + c), a(e).colpickHide()
        }
    }), a(".color-box.fourth-color").colpick({
        colorScheme: "dark",
        layout: "rgbhex",
        color: "fd5c48",
        onSubmit: function(b, c, d, e) {
            var f = ".dropdown-cart  .dropdown-cart-product-list  .dropdown-cart-details .item-price  { color: #" + c + ";}";
            f += "#option-panel .colorbox-list li .fourth-color span, #option-panel-title, .contact-details-list .contact-details-icon, .item-price-container, .contact-details-list .contact-details-icon { background-color : #" + c + ";}", f += "#option-panel-tabs-container li.active a:after { border-top-color : #" + c + ";}";
            var h = g.text();
            g.text(h + " " + f), a.cookie("fourthColor", f), a(e).find("span").css("background-color", "#" + c), a(e).colpickHide()
        }
    })), a(".layout-style-list").find("li").on("click", function() {
        var b = a(this),
            c = b.data("layout");
        "boxed" === c ? (a("#wrapper").addClass("boxed"), a.cookie("layoutMode", "boxed")) : (a.removeCookie("layoutMode"), a("#wrapper").hasClass("boxed") && a("#wrapper").removeClass("boxed"))
    }), a("#body-background-pattern").find("img").on("click", function() {
        var b = a(this);
        if (a("#wrapper").hasClass("boxed") && a.cookie("layoutMode", "boxed")) {
            var c = b.attr("src");
            a("body").css("background", "url(" + c + ") repeat"), a.cookie("bgColor", c), a.cookie("bgPattern", c)
        } else alert("Please change layout mode to the boxed.")
    });
    var i = a("#googlefont");
    "undefined" != typeof a.cookie("first-font") && (b(a.cookie("first-font")), a("body, #footer-bottom ,#option-panel-reset").css("font-family", a.cookie("first-font"))), "undefined" != typeof a.cookie("second-font") && (b(a.cookie("second-font")), a("h1,h2,h3,h4,h5,h6, #category-breadcrumb, #breadcrumb-container, #category-header.category-banner .category-title  h1, #category-header.category-banner .category-title  h2, .sidebar h3, .checkout-title, #footer h3").css("font-family", a.cookie("second-font"))), "undefined" != typeof a.cookie("third-font") && (b(a.cookie("third-font")), a("#main-nav-container #main-nav .menu li a, #main-nav-container #main-nav #responsive-nav ul li, .menu-button, #responsive-nav-button, .dropdown-cart-total li, .title-desc, .tab-style-1 li a, .new-rect, .discount-rect, .item-name, #portfolio-filter li a, .portfolio-item h2, #category-header.category-header-slider .category-title h1, #category-header.category-header-slider .category-title h2, .category-image-slider-container .new-rect, .category-image-slider-container .discount-rect, .featured-slider .featured-product h5, .related-slider .related-product h5, .article .article-meta-date, .article h2, .sidebar .widget .panel-title, .sidebar .widget .latest-posts-list h4, .sidebar .widget .testimonials-list li .testimonial-details header, .sidebar .widget .testimonials-list li  figure > figcaption, .comments h3, .product .product-name, .table .table-title, .total-table, .checkout-table .checkout-table-title, .checkout-table .checkout-table-price, .checkout-table .checkout-total-title, .checkout-table .checkout-total-price ").css("font-family", a.cookie("third-font"))), "undefined" != typeof a.cookie("fourth-font") && (b(a.cookie("fourth-font")), a("#main-nav-container #main-nav .menu li .mega-menu .mega-menu-title, #main-nav-container #main-nav #responsive-nav ul li ul li, #main-nav-container #main-nav #responsive-nav ul li .mega-menu .mega-menu-title, .item-price-container, .item-price-special, #category-header .category-title-price, .featured-slider .featured-product .featured-price,.related-slider .related-product .related-price, .category-filter-list li a, .comments .comments-list li .comment .comment-details .comment-title, .tab-container.left .nav-tabs > li, .tab-container.right .nav-tabs > li, .accordion-title, #footer, #option-panel-title, #option-panel .accordion-title, #option-panel .colorbox-list li > p, #option-panel  .layout-style-list li p").css("font-family", a.cookie("fourth-font"))), a("#first-font").on("change", function() {
        var c = a(this).val();
        "undefined" != typeof c && ("Arial" !== c && b(c), a("body, #footer-bottom ,#option-panel-reset").css("font-family", c), a.cookie("first-font", c))
    }), a("#second-font").on("change", function() {
        var c = a(this).val();
        "undefined" != typeof c && (b(c), a("h1,h2,h3,h4,h5,h6, #category-breadcrumb, #breadcrumb-container, #category-header.category-banner .category-title  h1, #category-header.category-banner .category-title  h2, .sidebar h3, .checkout-title, #footer h3").css("font-family", c), a.cookie("second-font", c))
    }), a("#third-font").on("change", function() {
        var c = a(this).val();
        "undefined" != typeof c && (b(c), a("#main-nav-container #main-nav .menu li a, #main-nav-container #main-nav #responsive-nav ul li, .menu-button, #responsive-nav-button, .dropdown-cart-total li, .title-desc, .tab-style-1 li a, .new-rect, .discount-rect, .item-name, #portfolio-filter li a, .portfolio-item h2, #category-header.category-header-slider .category-title h1, #category-header.category-header-slider .category-title h2, .category-image-slider-container .new-rect, .category-image-slider-container .discount-rect, .featured-slider .featured-product h5, .related-slider .related-product h5, .article .article-meta-date, .article h2, .sidebar .widget .panel-title, .sidebar .widget .latest-posts-list h4, .sidebar .widget .testimonials-list li .testimonial-details header, .sidebar .widget .testimonials-list li  figure > figcaption, .comments h3, .product .product-name, .table .table-title, .total-table, .checkout-table .checkout-table-title, .checkout-table .checkout-table-price, .checkout-table .checkout-total-title, .checkout-table .checkout-total-price ").css("font-family", c), a.cookie("third-font", c))
    }), a("#fourth-font").on("change", function() {
        var c = a(this).val();
        "undefined" != typeof c && (b(c), a("#main-nav-container #main-nav .menu li .mega-menu .mega-menu-title, #main-nav-container #main-nav #responsive-nav ul li ul li, #main-nav-container #main-nav #responsive-nav ul li .mega-menu .mega-menu-title, .item-price-container, .item-price-special, #category-header .category-title-price, .featured-slider .featured-product .featured-price,.related-slider .related-product .related-price, .category-filter-list li a, .comments .comments-list li .comment .comment-details .comment-title, .tab-container.left .nav-tabs > li, .tab-container.right .nav-tabs > li, .accordion-title, #footer, #option-panel-title, #option-panel .accordion-title, #option-panel .colorbox-list li > p, #option-panel  .layout-style-list li p").css("font-family", c), a.cookie("fourth-font", c))
    })
}(jQuery);


