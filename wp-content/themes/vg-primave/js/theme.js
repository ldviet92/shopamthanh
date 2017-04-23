/**
 * @version    1.9
 * @package    VG Primave
 * @author     VinaGecko Team <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */

(function($) {
	"use strict";
	
	jQuery(document).ready(function(){
		
		//Mobile Menu
		var mobileMenuWrapper = jQuery('.mobile-menu-container');
		mobileMenuWrapper.find('.menu-item-has-children').each(function(){
			var linkItem = jQuery(this).find('a').first();
			linkItem.after('<i class="fa fa-plus"></i>');
		});
		
		//hover search header layout 2
		
		//calculate the init height of menu
		var totalMenuLevelFirst = jQuery('.mobile-menu-container > ul.nav-menu > li').length;
		var mobileMenuH = totalMenuLevelFirst*40 + 10; //40 is height of one item, 10 is padding-top + padding-bottom;
		
		jQuery('.mbmenu-toggler').on("click", function(){
			if(mobileMenuWrapper.hasClass('open')) {
				mobileMenuWrapper.removeClass('open');
				mobileMenuWrapper.animate({'height': 0}, 'fast');
			} else {
				mobileMenuWrapper.addClass('open');
				mobileMenuWrapper.animate({'height': mobileMenuH}, 'fast');
			}
		});
		
		//set the height of all li.menu-item-has-children items
		jQuery('.mobile-menu-container li.menu-item-has-children').each(function(){
			jQuery(this).css({'height': 40, 'overflow': 'hidden'});
		});
		
		//process the parent items
		jQuery('.mobile-menu-container li.menu-item-has-children').each(function(){
			var parentLi = jQuery(this);
			var dropdownUl = parentLi.find('ul.sub-menu').first();
			
			parentLi.find('.fa').first().on('click', function(){
				//set height is auto for all parents dropdown
				parentLi.parents('li.menu-item-has-children').css('height', 'auto');
				//set height is auto for menu wrapper
				mobileMenuWrapper.css({'height': 'auto'});
				
				var dropdownUlheight = dropdownUl.outerHeight() + 40;
				
				if(parentLi.hasClass('opensubmenu')) {
					parentLi.removeClass('opensubmenu');
					parentLi.animate({'height': 40}, 'fast', function(){
						//calculate new height of menu wrapper
						mobileMenuH = mobileMenuWrapper.outerHeight();
					});
					parentLi.find('.fa').first().removeClass('fa-minus');
					parentLi.find('.fa').first().addClass('fa-plus');
				} else {
					parentLi.addClass('opensubmenu');
					parentLi.animate({'height': dropdownUlheight}, 'fast', function(){
						//calculate new height of menu wrapper
						mobileMenuH = mobileMenuWrapper.outerHeight();
					});
					parentLi.find('.fa').first().addClass('fa-minus');
					parentLi.find('.fa').first().removeClass('fa-plus');
				}
				
			});
		});
		
		/* thumbnails carousel */
		$('.single-product-image .flex-control-thumbs').owlCarousel({
			items: 				4,
			itemsDesktop: 		[1170,4],
			itemsDesktopSmall: 	[980,3],
			itemsTablet: 		[800,3],
			itemsTabletSmall: 	[650,4],
			itemsMobile: 		[450,4],				
			slideSpeed: 		200,
			paginationSpeed: 	800,
			rewindSpeed: 		1000,				
			autoPlay: 			false,
			stopOnHover: 		false,				
			navigation: 		true,
			scrollPerPage: 		false,
			pagination: 		false,
			paginationNumbers: 	false,
			mouseDrag: 			false,
			touchDrag: 			false,
			navigationText: 	["Prev", "Next"],
			leftOffSet: 		0,
		});
		
		/* Swallow code Mobile Mega Menu */
		
		/* End swallow */
		
		/* For add to card button */
		jQuery('body').append('<div class="atc-notice-wrapper"><div class="atc-notice"></div><div class="close"><i class="fa fa-times-circle"></i></div></div>');
		
		jQuery('.atc-notice-wrapper .close').on("click", function(){
			jQuery('.atc-notice-wrapper').fadeOut();
			jQuery('.atc-notice').html('');
		});
		
		jQuery('body').on('adding_to_cart', function(event, button, data) {
			var ajaxPId = button.attr('data-product_id');
			var ajaxPQty = button.attr('data-quantity');
			
			//get product info by ajax
			jQuery.post(
				ajaxurl, 
				{
					'action': 'primave_get_productinfo',
					'data':   {'pid': ajaxPId,'quantity': ajaxPQty}
				},
				function(response){
					jQuery('.atc-notice').html(response);
				}
			);
		});
		
		jQuery('body').on('added_to_cart', function(event, fragments, cart_hash) {			
			jQuery('.atc-notice-wrapper').fadeIn();
		});
		
		// Countdown
		jQuery('.timer-grid').each(function(){
			var countTime = jQuery(this).attr('data-time');
			
			jQuery(this).countdown(countTime, function(event) {
				jQuery(this).html(
					'<div class="day"><span class="number">'+event.strftime('%D')+' </span>days</div> <div class="hour"><span class="number">'+event.strftime('%H')+'</span>Hours</div><div class="min"><span class="number">'+event.strftime('%M')+'</span> MINUTE</div> <div class="sec"><span class="number">'+event.strftime('%S')+' </span>SECONDS</div>'
				);
			});
			//jQuery(this).countdown('stop');
		});
		
		/* Brands Logo Carousel */
		$(".brands-carousel").owlCarousel({
			items: 				4,
			itemsDesktop: 		[1170,4],
			itemsDesktopSmall: 	[980,3],
			itemsTablet: 		[800,3],
			itemsTabletSmall: 	[650,2],
			itemsMobile: 		[450,1],				
			slideSpeed: 		200,
			paginationSpeed: 	800,
			rewindSpeed: 		1000,				
			autoPlay: 			false,
			stopOnHover: 		false,				
			navigation: 		false,
			scrollPerPage: 		false,
			pagination: 		false,
			paginationNumbers: 	false,
			mouseDrag: 			true,
			touchDrag: 			false,
			navigationText: 	["Prev", "Next"],
			leftOffSet: 		0,
		});
		
		
		/* Image Zoom Function */
		jQuery('.zoom_in_marker').on("click", function(){
			jQuery.fancybox({
				href: 			jQuery('.woocommerce-main-image').attr('href'),
				openEffect: 	'elastic',
				closeEffect: 	'elastic'
			});
		});
		
		
		/* Up Sells - Product carousel on Product Details Page */
		$(".related .shop-products, .upsells .shop-products").owlCarousel({
			items: 				4,
			itemsDesktop: 		[1170,3],
			itemsDesktopSmall: 	[980,3],
			itemsTablet: 		[800,3],
			itemsTabletSmall: 	[650,2],
			itemsMobile: 		[450,1],				
			slideSpeed: 		200,
			paginationSpeed: 	800,
			rewindSpeed: 		1000,				
			autoPlay: 			false,
			stopOnHover: 		false,				
			navigation: 		true,
			scrollPerPage: 		false,
			pagination: 		false,
			paginationNumbers: 	false,
			mouseDrag: 			false,
			touchDrag: 			false,
			navigationText: 	["Prev", "Next"],
			leftOffSet: 		-15,
		});
		
		$(".cross-carousel .shop-products").owlCarousel({
			items: 				4,
			itemsDesktop: 		[1170,3],
			itemsDesktopSmall: 	[980,2],
			itemsTablet: 		[800,2],
			itemsTabletSmall: 	[650,1],
			itemsMobile: 		[450,1],				
			slideSpeed: 		200,
			paginationSpeed: 	800,
			rewindSpeed: 		1000,				
			autoPlay: 			false,
			stopOnHover: 		false,				
			navigation: 		true,
			scrollPerPage: 		false,
			pagination: 		false,
			paginationNumbers: 	false,
			mouseDrag: 			false,
			touchDrag: 			false,
			navigationText: 	["Prev", "Next"],
			leftOffSet: 		-15,
		});
		/* Category Product View Module */
		jQuery('.view-mode').each(function(){
			/* Grid View */
			jQuery(this).find('.grid').on("click", function(event){
				event.preventDefault();
				
				jQuery('#archive-product .view-mode').find('.grid').addClass('active');
				jQuery('#archive-product .view-mode').find('.list').removeClass('active');
				
				jQuery('#archive-product .shop-products').removeClass('list-view');
				jQuery('#archive-product .shop-products').addClass('grid-view');
				
				jQuery('#archive-product .list-col4').removeClass('col-sm-6 col-lg-4 col-xs-12');
				jQuery('#archive-product .list-col8').removeClass('col-sm-6 col-lg-8 col-xs-12');
			});
			
			/* List View */
			jQuery(this).find('.list').on("click", function(event){
				event.preventDefault();
			
				jQuery('#archive-product .view-mode').find('.list').addClass('active');
				jQuery('#archive-product .view-mode').find('.grid').removeClass('active');
				
				jQuery('#archive-product .shop-products').addClass('list-view');
				jQuery('#archive-product .shop-products').removeClass('grid-view');
				
				jQuery('#archive-product .list-col4').addClass('col-sm-6 col-lg-4 col-xs-12');
				jQuery('#archive-product .list-col8').addClass('col-sm-6 col-lg-8 col-xs-12');
			});
		});
		
		/* Sticky Cart, Search */
		stickymenu();
		
		/* Tooltip Block */
		jQuery('.yith-wcwl-add-to-wishlist a, .compare-button a, .add_to_cart_inline a, .vgwc-add-to-cart  a, .quickview, .sharefriend a').each(function(){
			vinageckotip(jQuery(this), 'html');
		});		
		jQuery('.social-icons a').each(function(){
			vinageckotip(jQuery(this), 'title');
		});
		
		$(".lazy").lazy();
		
		/* Quick View Mode */
		jQuery('.product-wrapper').each(function(){
			jQuery(this).on('mouseover click', function(){
				jQuery(this).addClass('hover');
			});
			jQuery(this).on('mouseleave', function(){
				jQuery(this).removeClass('hover');
			});
		});
		
		
		/* Add quickview box */
		jQuery('body').append('<div class="quickview-wrapper"><div class="quick-modal"><span class="closeqv"><i class="fa fa-times"></i></span><div id="quickview-content"></div><div class="clearfix"></div></div></div>');
		
		
		/* Show quickview box */
		jQuery('.quickview').each(function(){
			var quickviewLink 	= jQuery(this);
			var productID 		= quickviewLink.attr('data-quick-id');
			
			quickviewLink.on("click", function(event){
				event.preventDefault();
				
				jQuery('#quickview-content').html('');				
				jQuery('body').addClass('quickview');
				
				window.setTimeout(function(){
					jQuery('.quickview-wrapper').addClass('open');
					jQuery('.quick-modal').addClass('loading');
					
					jQuery.post(
						ajaxurl, 
						{
							'action': 'primave_product_quickview',
							'data':   productID
						}, 
						function(response){
							jQuery('#quickview-content').html(response);
							
							jQuery('.quick-modal').removeClass('loading');
							/* variable product form */
							jQuery('.variations_form').wc_variation_form();
							jQuery('.variations_form .variations select').change();
							
							/* thumbnails carousel */
							jQuery('.quick-thumbnails').owlCarousel({
								items: 				4,
								itemsDesktop: 		[1170,4],
								itemsDesktopSmall: 	[980,3],
								itemsTablet: 		[800,3],
								itemsTabletSmall: 	[650,4],
								itemsMobile: 		[450,4],				
								slideSpeed: 		200,
								paginationSpeed: 	800,
								rewindSpeed: 		1000,				
								autoPlay: 			false,
								stopOnHover: 		false,				
								navigation: 		true,
								scrollPerPage: 		false,
								pagination: 		false,
								paginationNumbers: 	false,
								mouseDrag: 			false,
								touchDrag: 			false,
								navigationText: 	["Prev", "Next"],
								leftOffSet: 		-6,
							});
							
							/* thumbnail click */
							jQuery('.quick-thumbnails a').each(function(){
								var quickThumb = jQuery(this);
								var quickImgSrc = quickThumb.attr('href');
								
								quickThumb.on("click", function(event){
									event.preventDefault();
									
									jQuery('.main-image').find('img').attr('src', quickImgSrc);
								});
							});
							
							/*review link click*/							
							jQuery('.woocommerce-review-link').on("click", function(event){
								event.preventDefault();
								var reviewLink = jQuery('.see-all').attr('href');								
								window.location.href = reviewLink + '#reviews';
							});
											
							$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<button type="button" value="+" class="plus"><span class="fa fa-plus"></span></button>').prepend('<button type="button" value="-" class="minus"><span class="fa fa-minus"></span></button>');
						}
					);
				}, 300);
			});
		});
		
		/* Close quickview box */
		jQuery('.closeqv').on("click", function(event){
			jQuery('.quickview-wrapper').removeClass('open');
			
			window.setTimeout(function(){
				jQuery('body').removeClass('quickview');
			}, 500);
		});
		
		
		/* Fancybox for Product */
		jQuery(".fancybox").fancybox({
			openEffect: 'elastic',
			closeEffect: 'fade',
			beforeShow: function() {
				if(this.title) {
					// New line
					this.title += '<div class="fancybox-social">';
					
					// Add tweet button
					this.title += '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-url="' + this.href + '">Tweet</a> ';
					
					// Add FaceBook like button
					this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe></div>';
				}
			},
			afterShow: function() {
				// Render tweet button
				twttr.widgets.load();
			},
			helpers:  {
				title : {
					type : 'inside'
				},
				overlay : {
					showEarly : false
				}
			}
		});
		
		
		/* Projects Filter with shuffle.js */
		jQuery('.list_projects #projects_list').shuffle({ itemSelector: '.project' });
		
		jQuery('.filter-options .btn').on('click', function() {			
			var filterBtn = jQuery(this),
				isActive = filterBtn.hasClass('active'),
				group = isActive ? 'all' : filterBtn.data('group');

			// Hide current label, show current label in title
			if(!isActive) {
				jQuery('.filter-options .active').removeClass('active');
			}

			filterBtn.toggleClass('active');

			// Filter elements
			jQuery('.list_projects #projects_list').shuffle('shuffle', group);
		});
		
		
		/* Fancybox for single project */
		jQuery(".prfancybox").fancybox({
			openEffect: 	'fade',
			closeEffect: 	'elastic',
			nextEffect: 	'fade',
			prevEffect: 	'fade',
			beforeShow: function() {
				if(this.title) {
					// New line
					this.title += '<div class="fancybox-social">';
					
					// Add tweet button
					this.title += '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-url="' + this.href + '">Tweet</a> ';
					
					// Add FaceBook like button
					this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe></div>';
				}
			},
			afterShow: function() {
				// Render tweet button
				twttr.widgets.load();
			},
			helpers:  {
				title : {
					type : 'inside'
				},
				overlay : {
					showEarly : false
				},
				buttons	: {},
				thumbs	: {
					width	: 100,
					height	: 100
				}
			}
		});
		
		/*  [ Page loader]
		- - - - - - - - - - - - - - - - - - - - */
		setTimeout(function() {
			$( 'body' ).addClass( 'loaded' );
			setTimeout(function () {
				$('#pageloader').remove();
			}, 1500);
		}, 1500);
		
		//show newsletter popup
		jQuery('.newsletterpopup .close-popup').click(function(){
			vinageckoHideNLPopup();
		});
		jQuery('.popupshadow').click(function(){
			vinageckoHideNLPopup();
		});
		
		/*  [ Remove p empty tag of page builder ]
		- - - - - - - - - - - - - - - - - - - - */
		$('p').each(function() {
			var $this = $(this);
				if($this.html().replace(/\s|&nbsp;/g, '').length == 0) {
				$this.remove();
			}
		});
		
		//Fix Mini Cart Safari
		jQuery('.mini_cart_inner').on("hover", function(){
			var minicart = jQuery('.mcart-border');
			$(".lazy").lazy();
			if(minicart.hasClass('active')){
				minicart.removeClass('active');
				minicart.css('visibility', 'hidden');
			}else{
				minicart.addClass('active');
				minicart.css('visibility', 'visible');
			}
		});
		
	});

	/*To Top*/
	$(".to-top").hide();
	
	/* fade in #back-top */
	$(function() {
		$(window).scroll(function() {
			if($(this).scrollTop() > 100) {
				$('.to-top').fadeIn();
			} else {
				$('.to-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('.to-top').on("click", function() {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
	$('.vgwc-wrapper.owl-carousel').parent().addClass('vg-carousel');
	
	if($('.main-container').find('#full-container')) {
		$('#full-container').parent().removeClass('container');
	}
	//Category Products
	
	$.fn.extend({  
         accordion: function() {       
            return this.each(function() {
            	
            	var $jqul = $(this);
            	
				if($jqul.data('accordiated'))
					return false;
													
				$.each($jqul.find('ul, li>div'), function(){
					$(this).data('accordiated', true);
					$(this).hide();
				});
				
				$.each($jqul.find('span.head'), function(){
					$(this).click(function(e){
						activate(this);
						return void(0);
					});
				});
				
				var active = (location.hash)?$(this).find('a[href=' + location.hash + ']')[0]:'';

				if(active){
					activate(active, 'toggle');
					$(active).parents().show();
				}
				
				function activate(el,effect){
					$(el).parent('li').toggleClass('active').siblings().removeClass('active').children('ul, div').slideUp('fast');
					$(el).siblings('ul, div')[(effect || 'slideToggle')]((!effect)?'fast':null);
				}
				
            });
        } 
    }); 
	
	$('#menu-menu-category li a').wrapInner( "<span class='cat-title'></span>");
	$("ul#menu-menu-category li.menu-item-has-children ").each(function(){
        $(this).append('<span class="head"><a href="javascript:void(0)"></a></span>');
    });
	
	$('ul#menu-menu-category').accordion();
	
	$("ul#menu-menu-category li.active").each(function(){
		$(this).children().next("ul").css('display', 'block');
	});
	
	//Mega Menu Category Home
	$('.widget_mega_main_sidebar_menu.menu-product-category .wpb_wrapper .mega_main_menu').removeClass('dropdowns_trigger-click');
	$('.widget_mega_main_sidebar_menu.menu-product-category .wpb_wrapper .mega_main_menu').removeClass('dropdowns_trigger-hover');
	$(".widget_mega_main_sidebar_menu.menu-product-category .wpb_wrapper .mega_main_menu .menu_holder .menu_inner ul.mega_main_menu_ul li.menu-item-has-children ").each(function(){
        $(this).append('<span class="head"><a href="javascript:void(0)"></a></span>');
    });
	$('.widget_mega_main_sidebar_menu.menu-product-category .wpb_wrapper .mega_main_menu .menu_holder .menu_inner ul.mega_main_menu_ul').accordion();
	
	$(".widget_mega_main_sidebar_menu.menu-product-category .wpb_wrapper .mega_main_menu .menu_holder .menu_inner ul.mega_main_menu_ul li.current-menu-item").each(function(){
		$(this).children().next("ul").css('display', 'block');
	});
})(jQuery);


/* Get Param value */
function vinageckogetParameterByName(name, string) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(string);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


/* Remove item from mini cart by ajax */
function vinageckoMiniCartRemove(url, itemid) {
	jQuery('.mcart-border').addClass('loading');
	jQuery('.cart-form').addClass('loading');
	
	jQuery.get(url, function(data,status){
		if(status=='success'){
			//update mini cart info
			jQuery.post(
				ajaxurl,
				{
					'action': 'primave_get_cartinfo'
				}, 
				function(response){
					var cartinfo = response.split("|");
					var itemAmount = cartinfo[0];
					var cartTotal = cartinfo[1];
					var orderTotal = cartinfo[2];
					var cartQuantity = cartinfo[3];
					
					jQuery('.mcart-number').html(cartQuantity);
					jQuery('.cart-quantity').html(itemAmount);
					jQuery('.item-cart .amount').html(cartTotal);
					jQuery('.total .amount').html(cartTotal);
					
					jQuery('.cart-subtotal .amount').html(cartTotal);
					jQuery('.order-total .amount').html(orderTotal);
				}
			);
			//remove item line from mini cart & cart page
			jQuery('#mcitem-' + itemid).animate({'height': '0', 'margin-bottom': '0', 'padding-bottom': '0', 'padding-top': '0'});
			setTimeout(function(){
				jQuery('#mcitem-' + itemid).remove();
				jQuery('#lcitem-' + itemid).remove();
			}, 1000);
			
			jQuery('.mcart-border').removeClass('loading');
			jQuery('.cart-form').removeClass('loading');
		}
	});
}


/* Tools Tip */
function vinageckotip(element, content) {
	if(content=='html'){
		var tipText = element.html();
	} else {
		var tipText = element.attr('title');
	}
	element.on('mouseover', function(){
		if(jQuery('.vinageckotip').length == 0) {
			element.before('<span class="vinageckotip">'+tipText+'</span>');
			
			var tipWidth = jQuery('.vinageckotip').outerWidth();
			var tipPush = -(tipWidth/2 - element.outerWidth()/2);
			jQuery('.vinageckotip').css('margin-left', tipPush);
		}
	});
	element.on('mouseleave', function(){
		jQuery('.vinageckotip').remove();
	});
}

function stickymenu(){
	var vina_width 		= jQuery(window).width();
	var vina_top 		= jQuery('.top-bar');
	var vina_top1 		= jQuery('.header');
	var vina_header 	= jQuery('.top-wrapper-fixed');
	var vina_wrapper 	= jQuery('.wrapper');
	var top_height 		= vina_top.height();
	var top_height1 	= vina_top1.height();
	var header_height 	= vina_header.height();
	jQuery(window).scroll(function() {
		if(vina_width > 1024){
			var NextScroll = jQuery(this).scrollTop();
			if (NextScroll >= (top_height + top_height1)) {
				vina_header.addClass('fixed');
				vina_wrapper.css('padding-top', header_height);
			}
			else {	
				vina_header.removeClass('fixed');
				vina_wrapper.css('padding-top', 0);
			}
		}
		else {
			vina_header.removeClass('fixed');
			vina_header.addClass('relative');
		}
	});
	jQuery(window).resize(function(event) {
		if(jQuery(window).width() < 1024){
			vina_header.removeClass('fixed');
			vina_header.addClass('relative');
		}
	});
}

/* Change Product Quantity */
jQuery(function($) {
	// Quantity buttons
	$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<button type="button" value="+" class="plus"><span class="fa fa-plus"></span></button>').prepend('<button type="button" value="-" class="minus"><span class="fa fa-minus"></span></button>');
	
	$(document).on('click', '.plus, .minus', function() {
		// Get values
		var $qty		= $(this).closest('.quantity').find('.qty'),
			currentVal	= parseFloat($qty.val()),
			max			= '',
			min			= 1,
			step		= 1;

		// Format values
		if(! currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
		if(max === '' || max === 'NaN') max = '';
		if(min === '' || min === 'NaN') min = 0;
		if(step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

		// Change the value
		if($(this).is('.plus')) {
			if(max &&(max == currentVal || currentVal > max)) {
				$qty.val(max);
			} else {
				$qty.val(currentVal + parseFloat(step));
			}
		} else {
			if(min &&(min == currentVal || currentVal < min)) {
				$qty.val(min);
			} else if(currentVal > 0) {
				$qty.val(currentVal - parseFloat(step));
			}
		}

		// Trigger change event
		$qty.trigger('change');
	});
});
function vinageckoShowNLPopup() {
	jQuery('.newsletterpopup').fadeIn();
	jQuery('.popupshadow').fadeIn();
}
function vinageckoHideNLPopup(){
	jQuery('.newsletterpopup').fadeOut();
	jQuery('.popupshadow').fadeOut();
}
