jQuery.noConflict();
jQuery(document).ready(function($) {
	/*-----------------------------------------------------------------------------------*/
	/*	Menu
	/*-----------------------------------------------------------------------------------*/
	$('.menu > li:first-child').addClass('first-item');
	$('.menu > li:last-child').addClass('last-item');
	
	$('.sub-menu li:first-child').addClass('first-item');
	$('.sub-menu li:last-child').addClass('last-item');
	
	$('#agera_footer li:first-child').addClass('first');
	$('#agera_footer li:last-child').addClass('last');
		
	$("ul.sub-menu").parents().addClass('parent_menu_item');
	
	// main menu functions
	$(".menu ul").css({display: "none"}); 

	$("ul.sub-menu li").hover(function() {
		$(this).find('ul.sub-menu').css('left', $(this).width() + 40);
	});	
	
	/* Setup Bar for the current active menu item */
	var $this = $('#mpc-nav li.current-menu-item'),
		offset;

	$('#mpc-nav > li').addClass('top-menu');

	if($this.closest('ul').hasClass('sub-menu')) { 
		$this = $this.closest('li.top-menu');
	}
	
	
	if($this.length > 0) {
		offset = $this.offset();
		$('#mpc-header .nav-bar').css({
			'left' : offset.left - 5,
			'width' : $this.find('a').width() + 10
		});
	}
	
	
	
	$("#mpc-nav > li").hover(function() {
		var $this = $(this);
			navBar = $('#mpc-header .nav-bar'),
			offset = $this.offset(),
			dropWidth = $this.find('ul:first').width() + 2,
			itemWidth = $this.find('a').width();
			
		$this.find('ul:first').css({
			visibility: "visible",
			display: "none",
			'margin-left' : - (dropWidth - itemWidth) * 0.5 
		}).stop().slideDown('normal', function() {
			$(this).css({
				'overflow': 'visible'
			});
		});
		
		if(navBar.css('left') == '-100px') {
			navBar.css({
				'opacity' : 0,
				'left' : $(window).width() * 0.5
			})
		}
		navBar.stop().animate({
			'width' : ($this.find('ul:first').length > 0) ? dropWidth : itemWidth + 10,
			'left' : ($this.find('ul:first').length > 0) ? offset.left - ((dropWidth - itemWidth) * 0.5) : offset.left - 5,
			'opacity': 1
		}, 500, 'easeOutExpo');

		
	}, function() {
		$(this).find('ul:first').stop().slideUp();
		
		var $this = $('#mpc-nav li.current-menu-item'),
		offset;

		if($this.closest('ul').hasClass('sub-menu')) { 
			$this = $this.closest('li.top-menu');
		}
		
		if($this.length > 0) {
			offset = $this.offset();
			$('#mpc-header .nav-bar').stop().animate({
				'left' : offset.left - 5,
				'width' : $this.find('a').width() + 10
			}, 700, 'easeOutExpo');
		} else {
			$('#mpc-header .nav-bar').stop().animate({ 'opacity' : 0 });
		}
	});
	
	$("#mpc-nav .sub-menu > li").hover(function() {
			
		$(this).find('ul:first').css({
			visibility: "visible",
			display: "none"
		}).stop().fadeIn();
		
	}, function() {
		$(this).find('ul:first').stop().fadeOut();
	});
	
	/*-----------------------------------------------------------------------------------*/
	/*	Decoration line animation
	/*-----------------------------------------------------------------------------------*/
	
	$('.mpc-icon-column').hover( function() {
		var $this = $(this);
		$this.stop().animate( { 'backgroundColor': '#f9f9f9' }, 500, 'easeOutExpo');
		$this.find('.gentle-deco-line').stop().animate( { 'bottom': '40' }, 500, 'easeOutExpo'); 
	}, function() {
		var $this = $(this);
		$this.find('.gentle-deco-line').stop().animate( { 'bottom': '38' }, 500, 'easeOutExpo');
		$this.stop().animate( { 'backgroundColor': '#ffffff' }, 500, 'easeOutExpo');
	});
	
	/* Recent portfolio item hover */
	$('.gentle-recent-portflio').hover( function() {
		var $this = $(this);
		$this.stop().animate( { 'backgroundColor': '#f9f9f9' }, 500, 'easeOutExpo');
		$this.find('.gentle-deco-line').stop().animate( { 'bottom': '-9' }, 500, 'easeOutExpo'); 
	}, function() {
		var $this = $(this);
		$this.find('.gentle-deco-line').stop().animate( { 'bottom': '-12' }, 500, 'easeOutExpo');
		$this.stop().animate( { 'backgroundColor': '#ffffff' }, 500, 'easeOutExpo');
	});
	
	/* recent posts hover */
	$('.gentle-recent-post').hover( function() {
		var $this = $(this);
		$this.stop().animate( { 'backgroundColor': '#f9f9f9' }, 500, 'easeOutExpo');
		$this.find('.gentle-deco-line').stop().animate( { 'bottom': '0' }, 500, 'easeOutExpo'); 
		$this.find('.recent-post-thumb.active').stop().animate( { 'margin-left': '10'}, 500, 'easeOutExpo'); 
	}, function() {
		var $this = $(this);
		$this.find('.gentle-deco-line').stop().animate( { 'bottom': '-2' }, 500, 'easeOutExpo');
		$this.stop().animate( { 'backgroundColor': '#ffffff' }, 500, 'easeOutExpo');
		$this.find('.recent-post-thumb.active').stop().animate( { 'margin-left': '0'}, 500, 'easeOutExpo'); 
	});

	/* blog hover */
	$('#mpc-page-content.blog div.post').live('mouseenter', function() {
		var $this = $(this),
			$parent = $this.parents('.blog');

		$this.animate( { 'opacity' : 1 }, 1000, 'easeOutExpo');
		if(!$parent.hasClass('blog2') && !$parent.hasClass('blog3') && !$parent.hasClass('blog4') && !$parent.hasClass('blog5')) {
			$this.find('.gentle-deco-line').stop().animate( { 'bottom': '0' }, 500, 'easeOutExpo'); 
		} else {
			$this.find('.gentle-deco-line').stop().animate( { 'bottom': '0' }, 500, 'easeOutExpo'); 
		}
	}) 

	$('#mpc-page-content.blog div.post').live('mouseleave',function() {
		var $this = $(this),
			$parent = $this.parents('.blog');

		if(!$parent.hasClass('blog2') && !$parent.hasClass('blog3') && !$parent.hasClass('blog4') && !$parent.hasClass('blog5')) {
			$this.find('.gentle-deco-line').stop().animate( { 'bottom': '-2' }, 500, 'easeOutExpo');
		} else {
			$this.find('.gentle-deco-line').stop().animate( { 'bottom': '-2' }, 500, 'easeOutExpo');
		}
	});


	$('.quick-flickr-item').hover(function(){
		$(this).stop().animate( { 'opacity' : '1'}, 500, 'easeOutExpo');
	}, function() {
		$(this).stop().animate( { 'opacity' : '0.7'}, 500, 'easeOutExpo');
	});

	$('.gentle-social-icon').hover(function(){
		$(this).stop().animate( { 'opacity' : '1' }, 500, 'easeOutExpo');
	}, function() {
		$(this).stop().animate( { 'opacity' : '0.5'}, 500, 'easeOutExpo');
	});


	$('#mpc-page-content.blog .mpc-read-more').live('mouseenter', function() {
		var $this = $(this);
		$this.find('span.plus-white').stop().animate({ 'top' : -15 }, 500, 'easeOutExpo');
		$this.find('span.plus-hover').stop().animate({ 'top' : -4 }, 500, 'easeOutExpo');
	});

	$('#mpc-page-content.blog .mpc-read-more').live('mouseleave', function() {
		var $this = $(this);
		$this.find('span.plus-white').stop().animate({ 'top' : -4 }, 500, 'easeOutExpo');
		$this.find('span.plus-hover').stop().animate({ 'top' : 11 }, 500, 'easeOutExpo');
	});

	/* show blog */
	if($('#mpc-page-wrap').hasClass('full') && $('#mpc-page-content').hasClass('blog')){
		$('#mpc-page-wrap.full #mpc-page-content.blog').animate({ 'opacity' : '1' }, 1, 'easeOutExpo');
	}

	/* blog image hover  */
	$('#mpc-page-content.blog div.post .mpc-post-thumbnail').live('mouseenter', function() {
		var $this = $(this);
		$this.find('.mpc-gentle-post-hover').stop().animate({ 'opacity' : 0.75}, 500, 'easeOutExpo');
		$this.find('.mpc-fancybox').stop().animate({ 'top' : '50%', 'opacity' : 1}, 500, 'easeOutExpo');
		$this.find('.mpc-gentle-post-link').stop().animate({ 'top' : '50%', 'opacity' : 1}, 500, 'easeOutExpo');
	});
	$('#mpc-page-content.blog div.post .mpc-post-thumbnail').live('mouseleave', function() {
		var $this = $(this);
		$this.find('.mpc-gentle-post-hover').stop().animate({ 'opacity' : 0}, 500, 'easeOutExpo');
		$this.find('.mpc-fancybox').stop().animate({ 'top' : '0%', 'opacity' : 0}, 500, 'easeOutExpo');
		$this.find('.mpc-gentle-post-link').stop().animate({ 'top' : '100%', 'opacity' : 0}, 500, 'easeOutExpo');
	});

	/* blog post fix */
	if($('article.post .mpc-post-thumbnail').width() + 200 < $('article.post').width() && $('article.post .mpc-post-thumbnail .flexslider').length < 1 && $('article.post .mpc-post-thumbnail').width() > 1){
		$('article.post .mpc-post-thumbnail').css({
			'float' : 'left',
			'margin-right' : '30px',
			'margin-bottom' : '20px'
		})
	} else if($('article.post .mpc-post-thumbnail').width() < 1) {
		$('article.post .mpc-post-thumbnail').css({ 'display' : 'none' });
		$('article.post small').css({
			'display' : 'inline-block',
			'margin-bottom' : '-20px'
		});
	}

	/* Portfolio categories hover */
	$('.mpc-portfolio-categories ul li').hover(function() {
		var $this = $(this);
		$this.children('.mpc-gentle-deco').stop().animate( { 'bottom': '-3' }, 500, 'easeOutExpo');
	}, function() {
		var $this = $(this);
		if(!$this.hasClass('active'))
			$this.children('.mpc-gentle-deco').stop().animate( { 'bottom': '-5' }, 500, 'easeOutExpo');
	});

	$('.mpc-portfolio-categories ul li').on('click', function() {
		var $this = $(this);
		$this.siblings().removeClass('active')
			 	.children('.mpc-gentle-deco').stop().animate( { 'bottom': '-5' }, 500, 'easeOutExpo');
		$this.addClass('active');
		var selector = '.' + $(this).data('link');

  		$('#mpc-page-content').isotope({ filter: selector });
  		return false;
	})

	/*-----------------------------------------------------------------------------------*/
	/*	Post Share
	/*-----------------------------------------------------------------------------------*/

	$('#mpc-page-content.gentle-single-page article.post .mpc-genlte-post-share-wrap').hover(function(){
		var	$this = $(this);
		$this.find('.zilla-share').stop().animate({'left' : '50px'}, 1000, 'easeOutExpo');
	}, function() {
		var	$this = $(this);
		$this.find('.zilla-share').stop().animate({'left' : '-600px'}, 1000, 'easeOutExpo');
	});

	/*-----------------------------------------------------------------------------------*/
	/*	FancyBox
	/*-----------------------------------------------------------------------------------*/

	$("a.mpc-fancybox").live('click', function() {
		$this = $(this);
		/* Lighbox Image */
		if($this.hasClass('mpc-image')) {
			$.fancybox({
				'padding' : 0,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href
			});
		/* Lighbox YouTube Video */
		} else if($this.hasClass('mpc-youtube-video')){
			$.fancybox({
				'padding' : 0,
				'autoScale'		: true,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
				'wmode'				: 'transparent',
				'allowfullscreen'	: 'true'
				}
			});
		/* Lighbox Vimeo Video */
		} else if($this.hasClass('mpc-vimeo-video')){
			$.fancybox({
				'padding' : 0,
				'autoScale'		: false,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
				'type'			: 'swf',
				'swf'			: {
				'wmode'				: 'black',
				'allowfullscreen'	: 'true'
				}
			});
		/* Lighbox iFrame */
		} else if($this.hasClass('mpc-iframe')){
			$.fancybox({
				'padding'			 : 0,
				'width'				: '75%',
				'height'			: '75%',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'title'				: this.title,
				'href'				: this.href,
				'type'				: 'iframe'
			});
		/* Lighbox SWF */
		} else if($this.hasClass('mpc-swf')){
			$.fancybox({
				'padding' 			: 0,
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'title'				: this.title,
				'href'				: this.href,
				'type'				: 'swf'
			});
		}

		return false;
	});

	/*-----------------------------------------------------------------------------------*/
	/*	Resize Window
	/*-----------------------------------------------------------------------------------*/

	// init
	
	$(window).resize(function(){
		window_resize();
	});

	function window_resize() {
		/* Menu decor */
		var $menuCurrent = $('#mpc-nav li.current-menu-item'),
		offset;

		if($menuCurrent.closest('ul').hasClass('sub-menu')) { 
			$menuCurrent = $menuCurrent.closest('li.top-menu');
		}
		
		offset = $menuCurrent.offset();

		if($menuCurrent.length > 0) {
			$('#mpc-header .nav-bar').css({
				'left' : offset.left - 5,
				'width' : $this.find('a').width() + 10
			});
		}

		video_resize(false);

		var mpcIconColumns = $('.mpc-icon-columns');
		mpcIconColumns.height('auto');
		mpcIconColumns.height(mpcIconColumns.height()+20);
		
		if($(window).width() < 960 || Modernizr.touch) {
			var clipWidth = $('.jcarousel-clip > #gentle_latest_portfolio ').parent().width();
			var num = Math.floor(clipWidth / 215);
			var margin = (clipWidth - 215 * num) / (num + 1);

			$('#gentle_latest_portfolio li')
				.css('margin-right', margin)
				.first()
					.css('margin-left', margin);

			$('#gentle_latest_posts_jcarousel > li:not(:eq(0))').hide();

			$('#gentle_latest_posts_jcarousel .gentle-recent-post .recent-post-thumb').removeClass('active');

			$('#gentle_latest_posts_jcarousel > li:eq(0)')
				.css('width', clipWidth)
				.find('.gentle-post-excerpt')
					.css('width', clipWidth - 120);

			$('.jcarousel-prev, .jcarousel-next').hide();

			$('#gentle-aside .widget').css({
				'margin-right': 30,
				'float': 'left'
			});

			$('#gentle_footer').css('margin-top', 40);
			$('#gentle-aside > ul').css('margin-top', 15);

		} else {
			$('#gentle_latest_portfolio li').css({ 
	        	'margin-right' : '',
	        	'margin-left' : 'auto' 
	        });

			$('#gentle_latest_posts_jcarousel > li').show();

			$('#gentle_latest_posts_jcarousel .gentle-recent-post .recent-post-thumb').addClass('active');

			$('#gentle_latest_posts_jcarousel > li:eq(0)')
				.css('width', '')
				.find('.gentle-post-excerpt')
					.css('width', '');

			$('.jcarousel-prev, .jcarousel-next').show();

			$('#gentle-aside .widget').css({
				'margin-right': 0,
				'float': 'none'
			});

			$('#gentle-aside > ul').css('margin-top', 45);
			$('#gentle_footer').css('margin-top', 0);
		}
	}

	function video_resize($trigger) {
		/* Resize Video */
		$('#mpc-page-content .post .mpc-post-thumbnail iframe, #mpc-page-content .post .mpc-post-thumbnail object').each(function() {
			var	$this = $(this),
				ratio = $this.height() / $this.width(),
				src = $this.attr('src') == undefined ? $this.attr('data') : $this.attr('src'),
				parent = $this.parents('#mpc-page-content');
			
			if(src.search("maps.google") == -1) {	
				var width = $this.parents('.mpc-post-thumbnail').width();
				
				$this.css({
					'width': width,
					'height': ratio * width
				});
			}
		});
		
		if($trigger) {
			$(window).trigger('resize');
		}
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Responsive Menu
	/*-----------------------------------------------------------------------------------*/

	// Create the dropdown base
	$('<select id="mpc-nav-select"/>').appendTo('#mpc-header');
	
	// Populate dropdown with menu items
	$('#mpc-nav a').each(function() {
	 var el = $(this);
	 $('<option />', {
	     'value'   : el.attr('href'),
	     'text'    : el.text()
	 }).appendTo('#mpc-nav-select');
	});	
	
	$('#mpc-nav-select').find('option').each( function(){
		var $this = $(this);
		if($(location).attr('href') == $this.val()){
			$this.attr('selected', 'selected');
		}
	});
	
	$("#mpc-nav-select").change(function() {
		window.location = $(this).find("option:selected").val();
	});

	/*-----------------------------------------------------------------------------------*/
	/*	Fix
	/*-----------------------------------------------------------------------------------*/	
	var thumb = $('#mpc-page-content.gentle-single-post .post .mpc-post-thumbnail, #mpc-page-content.gentle-single-page article.post .mpc-post-thumbnail');
	if(thumb.find(' > div').hasClass('flexslider')) 
		thumb.css( { 'width' : '100%' });

	$(window).load(function() {
		var mpcIconColumns = $('.mpc-icon-columns');
		mpcIconColumns.height(mpcIconColumns.height()+20);
		mpcIconColumns.find('.gentle-deco-line').show();
		video_resize(true);
	});
});
	
	