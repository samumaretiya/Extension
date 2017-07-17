require([
        'jquery',
    ], function ($) {
		
		function reset_element(e)
		{
			if($(e.target).closest('.ui-widget').size()==0  )
			{
				$("body").removeClass("minicart-open");
			}
			
		}

		
		function gototop(){
			$(window).scroll(function(){
				if ($(this).scrollTop() > 100) {
					$('.scrollToTop').fadeIn();
				} else {
					$('.scrollToTop').fadeOut();
				}
			});
			
			//Click event to scroll to top
			$('.scrollToTop').click(function(){
				$('html, body').animate({scrollTop : 0},800);
				return false;
			});
		}
		
		$(document).ready(function () {
			
			
			if($(".related-product-carousel").size()>0)
				{
                $(".related-product-carousel").owlCarousel({
     				nav : true,
					dots :false,
					responsive : {
						// breakpoint from 0 up
						0 : {
							items : 1,
						},
						639 : {
							items : 2,
						},
						768 : {
							items : 3,
						},
						// breakpoint from 480 up
						860 : {
							items : 4,
						},
						1080 : {
							items : 5,
						}
					}
                });
				}
			
			setTimeout(function(){
			$('.touch .detailed .items .title').removeClass('active');			
			$('.touch .detailed .content').hide();
				},1000);
			
			
			
			
			
			
			gototop();
			
			$('.home-product-tab-title').click(function(){
				$('.home-product-tab-title').removeClass('active');
				$(this).addClass('active');
				$('.home-product-tab').removeClass('active');
				$('#'+$(this).attr('id')+'-content').addClass('active');
			});
			
			$('.menu-icon-header').click(function(){
				$('html').addClass('nav-open');
			});
			$('.view-sidebar-link').click(function(){
				$('html').toggleClass('sidebar-open');
			});
			$('.close-sidebar-link').click(function(){
				$('html').removeClass('sidebar-open');
			});
			var message_select = $('.messages');	
			if(message_select.size() > 0 ) {
				setTimeout(function(){
					message_select.fadeOut(800);
				},9000);
			}
			
			$('.page.messages').click(function(){
				$('.page.messages').hide();
			});
			
			$('select').uniform();
				
	
			$('select[title="Country"]').change(function(){
					if($(this).closest('ul').find('input[title="State"]').css('display')=='none' || $(this).closest('ul').find('input[title="State/Province"]').css('display')=='none')
					{
						$(this).closest('ul').find('select[title="State"]').closest('.selector').show();
						$(this).closest('ul').find('select[title="State/Province"]').closest('.selector').show();
					}
					else
					{
						$(this).closest('ul').find('select[title="State"]').closest('.selector').hide();
						$(this).closest('ul').find('select[title="State/Province"]').closest('.selector').hide();
					}
			
				});
		$('.breadcrumbs').closest('body').addClass('breadcrumbed-page');
		if($(window).width()>=1025)
		{
			$(".nav-sections").sticky({ topSpacing: 0, className: 'sticky' });
		}else
		{
			$(".header.content").sticky({ topSpacing: 0, className: 'sticky' });
		}
		$('.faq-tab-content-wrapper dt').click(function(){
			$(this).closest('.faqBox').siblings('.faqBox').find('dt').removeClass('active');
			$(this).closest('.faqBox').siblings('.faqBox').find('dd').slideUp();
			$(this).toggleClass('active');
			$(this).closest('.faqBox').find('dd').slideToggle();
		});
		
		$('.footer-menu-handle').click(function(){
			$(this).toggleClass('active');
			$(this).closest('.footer-accordian-title').next().slideToggle();
		});
	
		gototop();
	
		$(".minicart-wrapper a.action").click(function() {
			if(!$('.minicart-wrapper').hasClass('active'))
			{
            	$("body").addClass("minicart-open");
			}
        });
        setTimeout(function() {
            $("#btn-minicart-close, .minicart-wrapper.active").click(function() {
				$("body").removeClass("minicart-open");
            });
            $(".cart-item-qty , .qty, .item-qty, #qty , .input-text qty").keypress(function(e) {
                if (this.value.length == '0' && e.which == 48) {
                    return false;
                }
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        }, 5000);
		
		$('.touch .login-account-icon').click(function(){
			$('.accountwrapper').toggleClass('active');
		});
		if($('html').hasClass('touch'))
		{
			$(document).on('touchend',function(e){
				if($(e.target).closest('.accountwrapper').size()==0)
				{
					$('.accountwrapper').removeClass('active');
				}
			});
		}
		$('.product.data.items > .item.title > .switch').click(function(){
			var $this = $(this);
			if($(window).width()<768)
			{
				setTimeout(function(){
					$('html, body').animate({scrollTop : $this.offset().top-$('.page-header').height()/2},800);
				},500);
			}
		});
		if($('html').hasClass('no-touch'))
	{
		$(document).click(function(e){
			reset_element(e);
		});
	}else
	{
		$(document).on('touchend',function(e){
			reset_element(e);
		});
	}
	});
	$('.save-label-product').insertAfter('.product-info-main .product-info-price .price-box');
	
window.onload = function (e) { 
	globalWidthVar = $(window).width(), globalHeightVar = $(window).height();
	
	if(globalWidthVar < 767){
		
		$('.navigation li').remove('.all-category');
		
		
		$(".navigation > ul > li.level0.parent > a").after('<span class="level0-ico-corner"></span>');
		
		$('.navigation ul li.level0 a.level-top').click(function(e){				
			$(this).closest('li').toggleClass('active');
			$(this).closest('li').find('span.level0-ico-corner').addClass('active');
			$(this).closest('li').siblings().find('ul').slideUp(500,"swing");
			$(this).closest('li').siblings().removeClass('active');
			$(this).closest('li').siblings().find('span.level0-ico-corner').removeClass('active');
			$(this).closest('li').find('ul').slideToggle("slow");		
			e.stopPropagation();
			return false;
		
		}); 
	jQuery.each(jQuery(".navigation > ul > li > a"), function(index, value){
				//jQuery(this).parent().find()				 
				jQuery(this).bind('click touchend', function(e) {
				 	 e.stopPropagation();
					 window.location.href=jQuery(this).attr('href');	 
					 
				});
			});
	jQuery.each(jQuery(".navigation > ul > li > span.level0-ico-corner"), function(index, value){
				//jQuery(this).parent().find()				 
				jQuery(this).bind('click touchend', function(e) {
				//	console.log("eyy"); //jQuery(this).click(function(){	 
					if($(this).closest("li").children("ul").length) {	
						//console.log("eyy234");			 			 
						jQuery(this).parent("li.level0.parent").find("ul.level0.submenu > li").removeClass("active");
						jQuery(this).parent("li").find("ul.level0.submenu > li.level1.parent > ul.level1.submenu").slideUp(500,"swing");
						jQuery(this).parent("li").siblings().find("a").removeClass("ui-state-active");
						jQuery(this).toggleClass("ui-state-active");
						jQuery(this).parent("li").siblings().find(".level0.submenu").slideUp(500,"swing");
						jQuery(this).parent("li").find(".level0.submenu").slideToggle("slow");
						return false;
					}
				});
			});
	
	}
}		

	
});		
			
			