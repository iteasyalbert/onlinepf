jQuery(document).ready(function($){
	$.fn.my_cycle_slideshow = function(args){
		my_defaults = { effect:'fade' }
		my_settings = $.extend({}, my_defaults, args);
	
		return this.each(function(){
			var container = $(this),
			items     = $("li",container);
			if(items.length > 1) {
				container.cycle({
					fx		:   my_settings.effect
					,next	:   '.next2'
					,prev	:   '.prev2' 
				});
			}
		});
	}//End of My Cycle plugin	
	
	if( $("div.single-gallery-image-container").length > 0){
		if( $("div.single-gallery-image-container > div.slideshow_container > ul.slideshow li").length > 1){
				$x = $("div.single-gallery-image-container > div.slideshow_container > ul.slideshow").attr("data-transition");
				console.log($x);
				$("div.single-gallery-image-container > div.slideshow_container > ul.slideshow").my_cycle_slideshow({effect:$x});

		}
	}

	//Resize 
	$(window).resize(function(){
		if($("ul.slideshow").length){
			$("ul.slideshow").cycle('destroy');
			$("ul.slideshow").each(function(){
				var container = $(this),
					effects = $(this).attr("data-transition"),
					items     = $("li",container);
					if(items.length > 1) {
						container.cycle({
							fx		:   effects
							,next	:   '.next2'
							,prev	:   '.prev2'
							,width :$(".gallery-image-container").width()
							,height:$(".gallery-image-container").height()
						});
					}
			});
		}
	});
	//Resize End	

	//Accordion Shortcode function definiation
	$.fn.my_accordion = function(options) {
		var defaults = 	{
			heading	: 'a.item',
			content	: '.holder'
		};
		
		var options = $.extend(defaults, options);
		return this.each(function(){
			var container 		= $(this),
				heading   		= $(options.heading, container),
				open_item_index = (container.attr("data-open-index") == "undefined" ) ? "1" : container.attr("data-open-index"),
				allContent 		= $(options.content, container);
				
				allContent.hide();
				
				heading.each(function(index){
					thisHeading = $(this),
					thisContent = thisHeading.next(options.content),
					i 			= isFinite(open_item_index) ? (open_item_index-1): '0';
					
					if( index == i) { 
						thisHeading.addClass("active");
						thisContent.show();
					}
					
					thisHeading.bind("click",function(){
						thisHeading = $(this),
						thisContent = thisHeading.next(options.content);
						if(thisContent.is(':visible')){
							thisContent.slideUp("normal");
							thisHeading.removeClass("active");
						}else{
							if(container.is(".close-all")){
								allContent.slideUp("normal");
								heading.removeClass("active");
							}
							thisContent.slideDown("normal");
							thisHeading.addClass("active");
						}
						return false;
					});
				});
		});
	}// Accordion Shortcode
});
var myCarousel;
jQuery(document).ready(function($){
	
	if($("ul.cat-menu").length){
		var t_container = $("ul.cat-menu"),
            t_items = t_container.find("li"),
            t_anchor = t_items.find("a");
       		t_anchor.click(function(){
            	t_items.find('.active').removeClass('active');
                $(this).find("span.arrow-down").addClass("active");        
       		});
	   
		//For Top slider menu at blog page and single post page
		animatedcollapse.init();	  
		//For Top slider menu at blog page and single post page
		animatedcollapse.addDiv('categories', 'fade=0,speed=400,group=srv,hide=1')
		animatedcollapse.addDiv('archives', 'fade=0,speed=400,group=srv,hide=1')
		animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
			//$: Access to jQuery
			//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
			//state: "block" or "none", depending on state
		}
		
	}
	
	//tpl-catalog
		if($('ul.j-load-all').length){
			var container = $('ul.j-load-all'),
				m_li = container.find("li"),
				m_item = m_li.find("a");
				container.find("a:first").addClass('active');
				m_item.click(function(){
					m_li.find('.active').removeClass('active');
					$(this).addClass("active");
				});
		}
		
		if($('ul.j-default a.active').length == 0){
			$('ul.j-default a:first').addClass('active');
		}
		
		/*$(window).scroll(function(){
			var scroll = $(window).scrollTop();
			
			
			if (scroll > 135){
				$(".menu-sidebar").addClass('fixed');
			} else if(scroll < 50){
				$(".menu-sidebar").removeClass('fixed').css({top: 0});
			}
	
			$('.fixed').css({top: scroll - 100});			
			
		});*/
	//tpl-catalog end
	
	//Menu
	$("div#top-menu ul.menu ul").css({display: "none"}); // Opera Fix
		$("div#top-menu ul.menu li").hover(function(){
			$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(200);
		},function(){
			$(this).find('ul:first').css({visibility: "hidden"});
	});
	//Menuend
	
	// Responsive Menu
	var $mainNav    = $('.menu-main-menu-container').children('ul');
	optionsList = '<option value="" selected>Navigate...</option>';
	
	if($mainNav.size()){
		// Regular nav
		$mainNav.on('mouseenter', 'li', function() {
			var $this    = $(this),
				$subMenu = $this.children('ul');
			if( $subMenu.length ) $this.addClass('hover');
			$subMenu.hide().stop(true, true).fadeIn(200);
		});
		$mainNav.on('mouseleave', 'li', function() {
			$(this).removeClass('hover').children('ul').stop(true, true).fadeOut(50);
		});

		// Responsive nav
		$mainNav.find('li').each(function() {
			var $this   = $(this),
				$anchor = $this.children('a'),
				depth   = $this.parents('ul').length - 1,
				indent  = '',
				text = $anchor.html();
				text = text.replace(/<span>.*<\/span>/g, '');

			if( depth ) {
				while( depth > 0 ) {
					indent += '--';
					depth--;
				}
			}
			
			optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + text + '</option>';
		}).end()
		  .after('<select class="responsive-nav">' + optionsList + '</select>');
	}
	($('.responsive-nav').size())?	$('.responsive-nav').on('change', function() {
			window.location = $(this).val();
		}):null;
	//Responsive menu end	
	
	//Slider
//	if($('#slider').length){
//		
//		if(typeof  global_slider_settings != 'undefined') {
//			$('#slider').nivoSlider(global_slider_settings);
//		}else{
//			$('#slider').nivoSlider();
//		}
//	}//Slider End
	
	//Tooltip
	if($(".tooltip-bottom").length){
		$(".tooltip-bottom").each(function(){ 
			$(this).tipTip({maxWidth: "auto"});
		});
	}

	if($(".tooltip-top").length){		
		$(".tooltip-top").each(function(){
			$(this).tipTip({maxWidth: "auto",defaultPosition: "top"});
		});
	}
	
	if($(".tooltip-left").length){
		$(".tooltip-left").each(function(){
			$(this).tipTip({maxWidth: "auto",defaultPosition: "left"});
		});
	}
		
	if($(".tooltip-right").length){
		$(".tooltip-right").each(function(){
			$(this).tipTip({maxWidth: "auto",defaultPosition: "right"});	
		});
	}
	//Tooltip End
	
	//Accordion shortcode
	$("ul.accordion").my_accordion();
	
	//Tab Short code
	if($(".tabs").length) {

		$(".tabs").each(function(){
			$(this).find("ul.tabnav li:first a:first").addClass("current");
			$(this).find("div.tab-container > div").not(":first").addClass("hide");
			$(this).organicTabs({"speed": 200});
		});
	}

	//Testimonial Carousel
	if($(".testimonial-carousel").length){
		$('ul.testimonial-carousel').jcarousel({ scroll: 1 });
	}
	
	
	//Related Post Carousel
	if($("#mycarousel").length){
		var size;
		$ul = $("#mycarousel ul:first ");
		$li = $("#mycarousel ul:first li");
		
		$.each($li,function(x,y){
			$('.jcarousel-control').append('<a href="#">'+x+'</a>')
		});
	
		function mycarousel_initCallback(carousel) {
		size= carousel.size();
		$('.jcarousel-control a:first').addClass("active");
		
		$('.jcarousel-control a').bind('click', function() {
			//To add & remove active class to ELEMENTS
			$($li).removeClass("active");
			
			//TO add & remove active class to current page element
			$(".jcarousel-control a").removeClass("active");
			
			$(this).addClass("active");

			carousel.scroll($.jcarousel.intval($(this).text()));
			return false;
		});
	
		$('.jcarousel-scroll select').bind('change', function() {
			carousel.options.scroll = $.jcarousel.intval(this.options[this.selectedIndex].value);
			return false;
		});
	
		$('#mycarousel-next').bind('click', function() {
			carousel.next();
			return false;
		});
	
		$('#mycarousel-prev').bind('click', function() {
			carousel.prev();
			return false;
		});
	}
		
	function firstInCallback(a,b,c,d){
		
		//update control buttons per slide
		$('.jcarousel-control a').removeClass("active");
		$('.jcarousel-control a:eq('+(c%size)+')').addClass("active");
		
	}
		//Related Post
		myCarousel = $("#mycarousel").jcarousel({
		   scroll: 1,
		   initCallback: mycarousel_initCallback,
		   auto:3,
		   wrap:'circular',
		   itemFirstInCallback:{
			   onBeforeAnimation: null,
			   onAfterAnimation: firstInCallback
		   }
		});

	}//Related Post Carousel End

$("table").each(function(){
	
	$(this).find('tbody > tr:odd').addClass('odd');
	$(this).find('tbody > tr:even').addClass('even');
	$(this).find("thead tr").removeClass('even');

});


//Placeholder
	$('.placeholder').each(function(){
		$(this).focus(function() {
			  if (this.value == this.title) { 
				 $(this).val("");
			  }
	    }).blur(function() {
			  if (this.value == "") {
				 $(this).val(this.title);
			  }
	   });
	});

});