
(function($){

 "use strict"; // Start of use strict

 var Shopaholic = {


 	carousel: function() {

 		$(".carousel.slide, #banner-slider-02").carousel({
 			interval: 4000,
 			cycle: true
 		}); 


 		$('.top-sell-slider').carousel({
 			interval: 3500,
 			cycle: true
 		});

 		$('#banner-slider').carousel({
 			interval: 5000,
 			cycle: true
 		}); 
 	}, 


 	/*-------- Rating -------- */

 	rating: function() {

 		$('.rating-tooltip-manual').rating({});

 	},


 	/*-------- Magnific PopUp -------- */

 	magnificPopup: function() {
 		$('.fancybox').magnificPopup({
 			type: 'image',
 			gallery:{
 				enabled:true
 			}
 		});

 		$('.iframe').magnificPopup({
 			disableOn: 700,
 			type: 'iframe',
 			mainClass: 'mfp-fade',
 			removalDelay: 160,
 			preloader: false,

 			fixedContentPos: false
 		});

 	},


 	counterUp: function() {
 		try { 
 			(function($) {

 				$('.counter').counterUp({
 					delay: 100,
 					time: 3000
 				});

 			})(jQuery);
			} catch(e) {  //We can also throw from try block and catch it here
				// No Error Show
			}

		},


		countDown: function() {
			try { 
				(function($) {

					jQuery("#time_countdown1").countDown({

						targetDate: {
							'day':    10,
							'month':  10,
							'year':   2017,
							'hour':   11,
							'min':    0,
							'sec':    0
						},
						omitWeeks: true

					});

				})(jQuery);
			} catch(e) {  //We can also throw from try block and catch it here
				// No Error Show
			} 


		},


		fullpage: function() {
			try { 
				(function($) {

					$('#fullpage').fullpage({
						navigation: true,
						navigationPosition: 'right'
					});

				})(jQuery);
			} catch(e) {  //We can also throw from try block and catch it here
				// No Error Show
			}

		},


		matchHeight: function() {
			
			try { 
				(function($) {
					
					$('.features-08 .item, .blog-08 .col-md-4, .products .item, .features-03 .col-md-4 .item, .collection-top .col-sm-6, .blog-posts.grid .col-sm-6, .blog-posts.grid .col-md-4 article').matchHeight({ 
						property: 'min-height' 
					});

				})(jQuery);
			} catch(e) {  //We can also throw from try block and catch it here
				// No Error Show
			}

		},


		progressBar: function(){

			$('.progressbar').appear(function() {
				$('.progress .progress-bar').progressbar({
					transition_delay: 500,
					refresh_speed: 10,
				});
			});

		},


		/* -------- Slick Carousels --------- */


		slick: function() {

			$('.featured-slider, .trending-slider-02, .team-slider, .related-slider, .trending-slider-03').slick({
				autoplay: true,
				dots: false,
				infinite: true,
				speed: 300,
				dots: false,
				slidesToShow: 4,
				adaptiveHeight: true,
				responsive: [{
					breakpoint: 1170,
					settings: {
						slidesToShow: 3
					}

				}, {

					breakpoint: 800,
					settings: {
						slidesToShow: 2
					}

				}, {

					breakpoint: 480,
					settings: {
						slidesToShow: 1
					}

				}]
			});



			$('.trending-slider, .top-rated-slider').slick({
				autoplay: true,
				dots: false,
				infinite: true,
				speed: 300,
				slidesToShow: 2,
				adaptiveHeight: true,
				responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						infinite: true
					}

				}, {

					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						dots: true
					}
				}]
			});


			/* -------- Trending Slider 08 --------- */

			$('.trending-slider-08').slick({
				autoplay: true,
				dots: false,
				infinite: true,
				speed: 300,
				slidesToShow: 3,
				adaptiveHeight: true,
				responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						infinite: true
					}

				}, {

					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						dots: true
					}
				}]
			});

		},


		/* ---------- Owl Carousels ---------- */

		owlCarousel: function() {
			try { 
				(function($) {

					$('.featured-slider-07').owlCarousel({
						center: true,
						items:2,
						loop:true,
						margin:20,
						navigation: true,
						responsive:{
							1024:{
								items:2
							},
							640:{
								items:1
							},
							0:{
								items:1
							}
						}
					});

				})(jQuery);
			} catch(e) {  //We can also throw from try block and catch it here
				//e.preventDefault();
			} 
		},

		owlCarousel: function() {
			try { 
				(function($) {
					$(".blog-posts .masonry-posts").vgrid({
						easing: "easeOutQuint",
						time: 500,
						delay: 20,
						responsive: true,
						fadeIn: {
							time: 300,
							delay: 50
						}
					});
				})(jQuery);
			} catch(e) {  //We can also throw from try block and catch it here
				//e.preventDefault();
			} 
		},


		isotope: function() {

			/* -------- Isotop Filters --------- */

			/* ---- Featured Items ---- */

			var $featuredItems = $('.featured-sorting, .grid-2column, .grid-2column-02, .grid-3column, .grid-3column-02, .grid-4column, .grid-4column-02, .list-view');
			$featuredItems.isotope({
				itemSelector: '.item',
				layoutMode: 'fitRows',
				transitionDuration: '0.6s'
			});

			var $featuredItems = $('.featured-sorting, .grid-2column, .grid-2column-02, .grid-3column, .grid-3column-02, .grid-4column, .grid-4column-02, .list-view');
			$featuredItems.imagesLoaded().progress( function() {
				$featuredItems.isotope('layout');
			});  


			$('.filter a').click(function() {
				$('.filter .active').removeClass('active');
				$(this).addClass('active');

				var selector = $(this).attr('data-filter');
				$featuredItems.isotope({
					filter: selector,
					animationOptions: {
						duration: 600,
						easing: 'linear',
						queue: false
					}
				});
				return false;

			});


			/* ---- Portfolio Masonry ---- */

			var $PortfolioItems = $('.masonry-3column, .masonry-3column-02');
			$PortfolioItems.isotope({
				itemSelector: '.item',
				layoutMode: 'masonry',
				transitionDuration: '0.6s',
				percentPosition: true

			});

			var $PortfolioItems = $('.masonry-3column, .masonry-3column-02');
			$PortfolioItems.imagesLoaded().progress( function() {
				$PortfolioItems.isotope('layout');
			});  


			$('.filter a').click(function() {
				$('.filter .active').removeClass('active');
				$(this).addClass('active');

				var selector = $(this).attr('data-filter');
				$PortfolioItems.isotope({
					filter: selector,
					animationOptions: {
						duration: 600,
						easing: 'linear',
						queue: false
					}
				});
				return false;

			});


		}


	};



	$(document).ready(function() {

		$( '.search-icon' ).on( 'click', function() {
			$(this).parent().toggleClass('active');
		});

		$( '.search-form .close' ).on( 'click', function() {
			$(this).parent().removeClass('active');
		});


		// Background Img

		$(".background-bg").css('background-image', function () {
			var bg = ('url(' + $(this).data("image-src") + ')');
			return bg;
		});

		$(".carts .btn").on("click", function() {
			$(this).toggleClass("on");
		});


		Shopaholic.carousel();
		Shopaholic.rating();
		Shopaholic.magnificPopup();
		Shopaholic.slick();
		Shopaholic.owlCarousel();
		Shopaholic.progressBar();
		Shopaholic.counterUp();
		Shopaholic.countDown();
		Shopaholic.isotope();
		Shopaholic.fullpage();
		Shopaholic.matchHeight();
		Shopaholic.matchHeight();

	});




	jQuery(window).on('scroll', function () {
		'use strict';

		if (jQuery(window).scrollTop() > 50) {
			jQuery('.navbar-fixed-top').addClass('is-sticky');
		}
		else {
			jQuery('.navbar-fixed-top').removeClass('is-sticky');
		}


		if (jQuery(this).scrollTop() > 100) {
			jQuery('#scroll-to-top').fadeIn('slow');
		} else {
			jQuery('#scroll-to-top').fadeOut('slow');
		}

	});


	jQuery('#scroll-to-top').on("click", function() {
		'use strict';

		jQuery("html,body").animate({ scrollTop: 0 }, 1500);
		return false;
	});


	
})(jQuery);




