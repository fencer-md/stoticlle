/**
Core script to handle the entire theme and core functions
**/
var Layout = function () {

    var layoutImgPath = Metronic.getAssetsPath() + 'admin/layout/img/';

    var layoutCssPath = Metronic.getAssetsPath() + 'admin/layout/css/';

    //* BEGIN:CORE HANDLERS *//
    // this function handles responsive layout on screen size resize or mobile device rotate.

    // Set proper height for sidebar and content. The content and sidebar height must be synced always.
    var handleSidebarAndContentHeight = function () {
        var content = $('.page-content');
        var sidebar = $('.page-sidebar');
        var body = $('body');
        var height;

        if (body.hasClass("page-footer-fixed") === true && body.hasClass("page-sidebar-fixed") === false) {
            var available_height = Metronic.getViewPort().height - $('.page-footer').outerHeight() - $('.page-header').outerHeight();
            if (content.height() < available_height) {
                content.attr('style', 'min-height:' + available_height + 'px');
            }
        } else {
            if (body.hasClass('page-sidebar-fixed')) {
                height = _calculateFixedSidebarViewportHeight();
                if (body.hasClass('page-footer-fixed') === false) {
                    height = height - $('.page-footer').outerHeight();
                }
            } else {
                var headerHeight = $('.page-header').outerHeight();
                var footerHeight = $('.page-footer').outerHeight();

                if (Metronic.getViewPort().width < 992) {
                    height = Metronic.getViewPort().height - headerHeight - footerHeight;
                } else {
                    height = sidebar.height() + 20;
                }

                if ((height + headerHeight + footerHeight) <= Metronic.getViewPort().height) {
                    height = Metronic.getViewPort().height - headerHeight - footerHeight;
                }
            }
            content.attr('style', 'min-height:' + height + 'px');
        }
    };

    // Handle sidebar menu
    var handleSidebarMenu = function () {
        jQuery('.page-sidebar').on('click', 'li > a', function (e) {

            if (Metronic.getViewPort().width >= 992 && $(this).parents('.page-sidebar-menu-hover-submenu').size() === 1) { // exit of hover sidebar menu
                return;
            }

            if ($(this).next().hasClass('sub-menu') === false) {
                if (Metronic.getViewPort().width < 992 && $('.page-sidebar').hasClass("in")) { // close the menu on mobile view while laoding a page 
                    $('.page-header .responsive-toggler').click();
                }
                return;
            }

            if ($(this).next().hasClass('sub-menu always-open')) {
                return;
            }

            var parent = $(this).parent().parent();
            var the = $(this);
            var menu = $('.page-sidebar-menu');
            var sub = jQuery(this).next();

            var autoScroll = menu.data("auto-scroll");
            var slideSpeed = parseInt(menu.data("slide-speed"));

            parent.children('li.open').children('a').children('.arrow').removeClass('open');
            parent.children('li.open').children('.sub-menu:not(.always-open)').slideUp(slideSpeed);
            parent.children('li.open').removeClass('open');

            var slideOffeset = -200;

            if (sub.is(":visible")) {
                jQuery('.arrow', jQuery(this)).removeClass("open");
                jQuery(this).parent().removeClass("open");
                sub.slideUp(slideSpeed, function () {
                    if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
                        if ($('body').hasClass('page-sidebar-fixed')) {
                            menu.slimScroll({
                                'scrollTo': (the.position()).top
                            });
                        } else {
                            Metronic.scrollTo(the, slideOffeset);
                        }
                    }
                    handleSidebarAndContentHeight();
                });
            } else {
                jQuery('.arrow', jQuery(this)).addClass("open");
                jQuery(this).parent().addClass("open");
                sub.slideDown(slideSpeed, function () {
                    if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
                        if ($('body').hasClass('page-sidebar-fixed')) {
                            menu.slimScroll({
                                'scrollTo': (the.position()).top
                            });
                        } else {
                            Metronic.scrollTo(the, slideOffeset);
                        }
                    }
                    handleSidebarAndContentHeight();
                });
            }

            e.preventDefault();
        });

        // handle ajax links within sidebar menu
        jQuery('.page-sidebar').on('click', ' li > a.ajaxify', function (e) {
            e.preventDefault();
            Metronic.scrollTop();

            var url = $(this).attr("href");
            var menuContainer = jQuery('.page-sidebar ul');
            var pageContent = $('.page-content');
            var pageContentBody = $('.page-content .page-content-body');

            menuContainer.children('li.active').removeClass('active');
            menuContainer.children('arrow.open').removeClass('open');

            $(this).parents('li').each(function () {
                $(this).addClass('active');
                $(this).children('a > span.arrow').addClass('open');
            });
            $(this).parents('li').addClass('active');

            if (Metronic.getViewPort().width < 992 && $('.page-sidebar').hasClass("in")) { // close the menu on mobile view while laoding a page 
                $('.page-header .responsive-toggler').click();
            }

            Metronic.startPageLoading();

            var the = $(this);

            $.ajax({
                type: "GET",
                cache: false,
                url: url,
                dataType: "html",
                success: function (res) {

                    if (the.parents('li.open').size() === 0) {
                        $('.page-sidebar-menu > li.open > a').click();
                    }

                    Metronic.stopPageLoading();
                    pageContentBody.html(res);
                    Layout.fixContentHeight(); // fix content height
                    Metronic.initAjax(); // initialize core stuff
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Metronic.stopPageLoading();
                    pageContentBody.html('<h4>Could not load the requested content.</h4>');
                }
            });
        });

        // handle ajax link within main content
        jQuery('.page-content').on('click', '.ajaxify', function (e) {
            e.preventDefault();
            Metronic.scrollTop();

            var url = $(this).attr("href");
            var pageContent = $('.page-content');
            var pageContentBody = $('.page-content .page-content-body');

            Metronic.startPageLoading();

            if (Metronic.getViewPort().width < 992 && $('.page-sidebar').hasClass("in")) { // close the menu on mobile view while laoding a page 
                $('.page-header .responsive-toggler').click();
            }

            $.ajax({
                type: "GET",
                cache: false,
                url: url,
                dataType: "html",
                success: function (res) {
                    Metronic.stopPageLoading();
                    pageContentBody.html(res);
                    Layout.fixContentHeight(); // fix content height
                    Metronic.initAjax(); // initialize core stuff
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    pageContentBody.html('<h4>Could not load the requested content.</h4>');
                    Metronic.stopPageLoading();
                }
            });
        });
    };

    // Helper function to calculate sidebar height for fixed sidebar layout.
    var _calculateFixedSidebarViewportHeight = function () {
        var sidebarHeight = Metronic.getViewPort().height - $('.page-header').outerHeight();
        if ($('body').hasClass("page-footer-fixed")) {
            sidebarHeight = sidebarHeight - $('.page-footer').outerHeight();
        }

        return sidebarHeight;
    };

    // Handles fixed sidebar
    var handleFixedSidebar = function () {
        var menu = $('.page-sidebar-menu');

        Metronic.destroySlimScroll(menu);

        if ($('.page-sidebar-fixed').size() === 0) {
            handleSidebarAndContentHeight();
            return;
        }

        if (Metronic.getViewPort().width >= 992) {
            menu.attr("data-height", _calculateFixedSidebarViewportHeight());
            Metronic.initSlimScroll(menu);
            handleSidebarAndContentHeight();
        }
    };

    // Handles sidebar toggler to close/hide the sidebar.
    var handleFixedSidebarHoverEffect = function () {
        var body = $('body');
        if (body.hasClass('page-sidebar-fixed')) {
            $('.page-sidebar-menu').on('mouseenter', function () {
                if (body.hasClass('page-sidebar-closed')) {
                    $(this).removeClass('page-sidebar-menu-closed');
                }
            }).on('mouseleave', function () {
                if (body.hasClass('page-sidebar-closed')) {
                    $(this).addClass('page-sidebar-menu-closed');
                }
            });
        }
    };

    // Hanles sidebar toggler
    var handleSidebarToggler = function () {
        var body = $('body');
        if ($.cookie && $.cookie('sidebar_closed') === '1' && Metronic.getViewPort().width >= 992) {
            $('body').addClass('page-sidebar-closed');
            $('.page-sidebar-menu').addClass('page-sidebar-menu-closed');
        }

        // handle sidebar show/hide
        $('.page-sidebar, .page-header').on('click', '.sidebar-toggler', function (e) {
            var sidebar = $('.page-sidebar');
            var sidebarMenu = $('.page-sidebar-menu');
            $(".sidebar-search", sidebar).removeClass("open");

            if (body.hasClass("page-sidebar-closed")) {
                body.removeClass("page-sidebar-closed");
                sidebarMenu.removeClass("page-sidebar-menu-closed");
                if ($.cookie) {
                    $.cookie('sidebar_closed', '0');
                }
            } else {
                body.addClass("page-sidebar-closed");
                sidebarMenu.addClass("page-sidebar-menu-closed");
                if (body.hasClass("page-sidebar-fixed")) {
                    sidebarMenu.trigger("mouseleave");
                }
                if ($.cookie) {
                    $.cookie('sidebar_closed', '1');
                }
            }

            $(window).trigger('resize');
        });

        handleFixedSidebarHoverEffect();

        // handle the search bar close
        $('.page-sidebar').on('click', '.sidebar-search .remove', function (e) {
            e.preventDefault();
            $('.sidebar-search').removeClass("open");
        });

        // handle the search query submit on enter press
        $('.page-sidebar .sidebar-search').on('keypress', 'input.form-control', function (e) {
            if (e.which == 13) {
                $('.sidebar-search').submit();
                return false; //<---- Add this line
            }
        });

        // handle the search submit(for sidebar search and responsive mode of the header search)
        $('.sidebar-search .submit').on('click', function (e) {
            e.preventDefault();
            if ($('body').hasClass("page-sidebar-closed")) {
                if ($('.sidebar-search').hasClass('open') === false) {
                    if ($('.page-sidebar-fixed').size() === 1) {
                        $('.page-sidebar .sidebar-toggler').click(); //trigger sidebar toggle button
                    }
                    $('.sidebar-search').addClass("open");
                } else {
                    $('.sidebar-search').submit();
                }
            } else {
                $('.sidebar-search').submit();
            }
        });

        // handle close on body click
        if ($('.sidebar-search').size() !== 0) {
            $('.sidebar-search .input-group').on('click', function(e){
                e.stopPropagation();
            });

            $('body').on('click', function() {
                if ($('.sidebar-search').hasClass('open')) {
                    $('.sidebar-search').removeClass("open");
                }
            });
        }
    };

    // Handles the horizontal menu
    var handleHorizontalMenu = function () {
        //handle tab click
        $('.page-header').on('click', '.hor-menu a[data-toggle="tab"]', function (e) {
            e.preventDefault();
            var nav = $(".hor-menu .nav");
            var active_link = nav.find('li.current');
            $('li.active', active_link).removeClass("active");
            $('.selected', active_link).remove();
            var new_link = $(this).parents('li').last();
            new_link.addClass("current");
            new_link.find("a:first").append('<span class="selected"></span>');
        });

        // handle search box expand/collapse        
        $('.page-header').on('click', '.search-form', function (e) {
            $(this).addClass("open");
            $(this).find('.form-control').focus();

            $('.page-header .search-form .form-control').on('blur', function (e) {
                $(this).closest('.search-form').removeClass("open");
                $(this).unbind("blur");
            });
        });

        // handle hor menu search form on enter press
        $('.page-header').on('keypress', '.hor-menu .search-form .form-control', function (e) {
            if (e.which == 13) {
                $(this).closest('.search-form').submit();
                return false;
            }
        });

        // handle header search button click
        $('.page-header').on('mousedown', '.search-form.open .submit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.search-form').submit();
        });

        $(document).on('click', '.mega-menu-dropdown .dropdown-menu', function (e) {
            e.stopPropagation();
        });
    };

    // Handles Bootstrap Tabs.
    var handleTabs = function () {
        // fix content height on tab click
        $('body').on('shown.bs.tab', 'a[data-toggle="tab"]', function () {
            handleSidebarAndContentHeight();
        });
    };

    // Handles the go to top button at the footer
    var handleGoTop = function () {
        var offset = 300;
        var duration = 500;

        if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {  // ios supported
            $(window).bind("touchend touchcancel touchleave", function(e){
               if ($(this).scrollTop() > offset) {
                    $('.scroll-to-top').fadeIn(duration);
                } else {
                    $('.scroll-to-top').fadeOut(duration);
                }
            });
        } else {  // general 
            $(window).scroll(function() {
                if ($(this).scrollTop() > offset) {
                    $('.scroll-to-top').fadeIn(duration);
                } else {
                    $('.scroll-to-top').fadeOut(duration);
                }
            });
        }
        
        $('.scroll-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, duration);
            return false;
        });
    };

    // Hanlde 100% height elements(block, portlet, etc)
    var handle100HeightContent = function () {

        var target = $('.full-height-content');
        var height;

        height = Metronic.getViewPort().height -
            $('.page-header').outerHeight(true) -
            $('.page-footer').outerHeight(true) -
            $('.page-title').outerHeight(true) -
            $('.page-bar').outerHeight(true);

        if (target.hasClass('portlet')) {
            var portletBody = target.find('.portlet-body');
            
            if (Metronic.getViewPort().width < 992) {
                Metronic.destroySlimScroll(portletBody.find('.full-height-content-body')); // destroy slimscroll 
                return;
            }

            height = height -
                target.find('.portlet-title').outerHeight(true) -
                parseInt(target.find('.portlet-body').css('padding-top')) -
                parseInt(target.find('.portlet-body').css('padding-bottom')) - 2;

            if (target.hasClass("full-height-content-scrollable")) {
                height = height - 35;
                portletBody.find('.full-height-content-body').css('height', height);
                Metronic.initSlimScroll(portletBody.find('.full-height-content-body'));
            } else {
                portletBody.css('min-height', height);
            }
        } else {
            if (Metronic.getViewPort().width < 992) {
                Metronic.destroySlimScroll(target.find('.full-height-content-body')); // destroy slimscroll 
                return;
            }

            if (target.hasClass("full-height-content-scrollable")) {
                height = height - 35;
                target.find('.full-height-content-body').css('height', height);
                Metronic.initSlimScroll(target.find('.full-height-content-body'));
            } else {
                target.css('min-height', height);
            }
        }
    };

    //* END:CORE HANDLERS *//

    return {

        //main function to initiate the theme
        init: function () {
            //IMPORTANT!!!: Do not modify the core handlers call order.

            //layout handlers
            handleFixedSidebar(); // handles fixed sidebar menu
            handleSidebarMenu(); // handles main menu
            handleHorizontalMenu(); // handles horizontal menu
            handleSidebarToggler(); // handles sidebar hide/show
            handle100HeightContent(); // handles 100% height elements(block, portlet, etc)            
            handleGoTop(); //handles scroll to top functionality in the footer
            handleTabs(); // handle bootstrah tabs

            // reinitialize the layout on window resize
            Metronic.addResizeHandler(handleSidebarAndContentHeight); // recalculate sidebar & content height on window resize
            Metronic.addResizeHandler(handleFixedSidebar); // reinitialize fixed sidebar on window resize
            Metronic.addResizeHandler(handle100HeightContent); // reinitialize content height on window resize 
        },

        //public function to fix the sidebar and content height accordingly
        fixContentHeight: function () {
            handleSidebarAndContentHeight();
        },

        initFixedSidebarHoverEffect: function() {
            handleFixedSidebarHoverEffect();
        },

        initFixedSidebar: function() {
            handleFixedSidebar();
        },

        getLayoutImgPath: function () {
            return layoutImgPath;
        },

        getLayoutCssPath: function () {
            return layoutCssPath;
        }
    };

}();
$(document).ready(function(){
/*admin equalizing height */
	var leftHeight = $(".center-big-width .help").outerHeight();
	var rightHeight = $(".center-big-width .portlet.box.blue").outerHeight();
	if ( leftHeight < rightHeight ) {
		$(".center-big-width .help").outerHeight(rightHeight);
	} else {
		$(".center-big-width .portlet.box.blue").outerHeight(leftHeight);
	}
	$(".dashboard-sidebar-menu-button").on("click",function() {
    $(this).toggleClass("active");
	  $(".sidebar-menu-top").toggleClass("active");
	});
/* authenticated user menu slide*/		
	if ( window.matchMedia('(max-width: 767px)').matches ) {
		$('section.videos').after( $('.site-information') );
		var frontH = $(".front-page-wrapper").height();
		$(".dashboard-user-sliding-menu").on("click",function() {
			$(".sidebar-menu-button").removeClass("active");
			$(".sidebar-menu").removeClass("active");
			if ( $(".dashboard-user-slide-menu").hasClass("active") ) {
				$(".dashboard-user-slide-menu").removeAttr("style");	
			}
			$(".dashboard-user-slide-menu").toggleClass("active");
			$(".dashboard-user-slide-menu.active").height(frontH);
		});		
	} else {
		$(".dashboard-user-sliding-menu").on("click",function() {
			$(".sidebar-menu-button").removeClass("active");
			$(".sidebar-menu").removeClass("active");
			$(".dashboard-user-slide-menu").toggleClass("active");
		});	
	};	
	$(window).resize(function() {
		var windowW = $(window).width();
		if ( windowW < 768 ) {
			var frontH = $(".front-page-wrapper").height();
			$(".dashboard-user-slide-menu").height(frontH);
			$(".dashboard-user-sliding-menu").on("click",function() {
				$(".dashboard-user-slide-menu").height(frontH);
			});
		} else {
			$(".dashboard-user-slide-menu.active").removeAttr("style");
			$(".dashboard-user-sliding-menu").on("click",function() {
				$(".dashboard-user-slide-menu").removeAttr("style");
			});
		};
	});

/* front page phone login slide */
	if ( window.matchMedia('(max-width: 767px)').matches ) {
		$(".user-slide-menu > i.fa-user").on("click",function() {
			var anotherHeight = $(".front-page-wrapper").height();
			$(this).toggleClass("active");
			$(".sidebar-menu-button").removeClass("active");
			$(".sidebar-menu.active").removeClass("active");
			$("#login-register").toggleClass("active");
			$("#login-register").height(anotherHeight);
		});
		$('section.videos').after( $('.site-information') );
	}
	$(window).resize(function() {
		var windowW = $(window).width();
		if ( windowW < 768 || windowW > 991 ) {
			$("#login-register").height("auto");
			$(".login-specific-button").hide();
			$(".register-specific-button").hide();
		}
		if ( windowW < 768 ) {
			$(".login-specific-button").hide();
			$(".register-specific-button").hide();
			$(".user-slide-menu > i.fa-user").on("click",function() {
				var anotherHeight = $(".front-page-wrapper").height();
				$(this).toggleClass("active");
				$(".sidebar-menu-button").removeClass("active");
				$(".sidebar-menu.active").removeClass("active");
				$("#login-register").toggleClass("active");
				$("#login-register").height(anotherHeight);
			});
		};
	});
/* front page column text height adjust */
	if ( window.matchMedia('(min-width: 768px)').matches ) {
		var aboutH = $("section.columns .about .text").height();
		var howH = $("section.columns .how .text").height();
		if ( aboutH > howH ) {
			$("section.columns .how .text").height(aboutH);
		} else {
			$("section.columns .about .text").height(howH);
		}
	}
	$(window).resize(function() {
		var windowW = $(window).width();
		if ( windowW > 767 ) {
			$(".dashboard-user-slide-menu.active").removeAttr("style");
			$("section.columns .about .text").removeAttr("style");
			$("section.columns .how .text").removeAttr("style");
			var aboutH = $("section.columns .about .text").height();
			var howH = $("section.columns .how .text").height();
			if ( aboutH > howH ) {
				$("section.columns .how .text").height(aboutH);
			} else {
				$("section.columns .about .text").height(howH);
			}
		} else {
			$("section.columns .about .text").removeAttr("style");
			$("section.columns .how .text").removeAttr("style");
		}
	});

/* miscelenious*/	
	$(".center-big-width").parent().addClass("bg-image");	
		/* $('.nice-select').selectize(); */
	

    // Refresh session each minute.
    setInterval(function(){
        $.get('/session/ping');
    }, 60000);
/* end misceleniuios */
/* Dashboard */
	if ( window.matchMedia('(max-width: 991px)').matches ) {
		$(".dashboard.dashboard-sidebar-menu-button").on("click",function() {
			$(".dashboard-user-slide-menu.active").removeClass("active");
		});
		$(".dashboard.dashboard-user-sliding-menu").on("click",function() {
			$(".dashboard.dashboard-sidebar-menu-button.active").removeClass("active");
			$(".sidebar-menu-top.active").removeClass("active");
		});
	};
	$(window).resize(function() {
		var windowW = $(window).width();
		if ( windowW < 992 ) {
			$(".dashboard.dashboard-sidebar-menu-button").on("click",function() {
				$(".dashboard-user-slide-menu.active").removeClass("active");
			});
			$(".dashboard.dashboard-user-sliding-menu").on("click",function() {
				$(".dashboard.dashboard-sidebar-menu-button.active").removeClass("active");
				$(".sidebar-menu-top.active").removeClass("active");
			});
		}
	});
	
	if ( window.matchMedia('(min-width: 992px)').matches ) {
		var usernameW = $(".dashboard-user-sliding-menu").outerWidth()-5; 
		$(".dashboard-user-slide-menu.user").css("right",usernameW);
		$(".dashboard-user-sliding-menu").on("click",function() {
			$(".dashboard-user-slide-menu.user").css("right",usernameW);
			/*added for front page*/
			$(".dashboard-user-slide-menu").css("right",usernameW);
		});
	}
	$(window).resize(function() {
		var windowW = $(window).width();
		if ( windowW > 991 ) {
			var usernameW = $(".dashboard-user-sliding-menu").outerWidth()-5;
			$(".dashboard-user-sliding-menu").on("click",function() {
				$(".dashboard-user-slide-menu.user").css("right",usernameW);
				/*added for front page*/
				$(".dashboard-user-slide-menu").css("right",usernameW);
			});
			$(".dashboard-user-slide-menu.user").css("right",usernameW);
			$(".dashboard-user-slide-menu.user.active").css("right",usernameW);
			/*added for front page*/
			$(".dashboard-user-slide-menu").css("right",usernameW);
			$(".dashboard-user-slide-menu.active").css("right",usernameW);
		} else {
			$(".dashboard-user-slide-menu.user").removeAttr("style");
			$(".dashboard-user-slide-menu.user.active").removeAttr("style");
			/*added for front page*/
			$(".dashboard-user-slide-menu").removeAttr("style");
			$(".dashboard-user-slide-menu.active").removeAttr("style");
		};
	});
});

$(document).ready(function(){
    // Announcements scroller.
    $('.announcements').on('mousewheel', function(e, delta) {
        e.preventDefault();
        val = this.scrollLeft - (delta * 200);
        $(this).stop().animate({scrollLeft:val},500);
    });
    $('.scroll-button-right').click(function(e){
        e.preventDefault();
        var target = $(this).parent().find('.announcements');
        target.stop().animate({scrollLeft: target[0].scrollLeft + 200}, 500);
    });
    $('.scroll-button-left').click(function(e){
        e.preventDefault();
        var target = $(this).parent().find('.announcements');
        target.stop().animate({scrollLeft: target[0].scrollLeft - 200}, 500);
    });
});
