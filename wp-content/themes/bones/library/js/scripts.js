/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
 */
 
var $ = jQuery.noConflict();

function updateViewportDimensions() {
	var w = window,
		d = document,
		e = d.documentElement,
		g = d.getElementsByTagName('body')[0],
		x = w.innerWidth || e.clientWidth || g.clientWidth,
		y = w.innerHeight || e.clientHeight || g.clientHeight;
	return {
		width: x,
		height: y
	};
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
 */
var waitForFinalEvent = (function() {
	var timers = {};
	return function(callback, ms, uniqueId) {
		if (!uniqueId) {
			uniqueId = "Don't call this twice without a uniqueId";
		}
		if (timers[uniqueId]) {
			clearTimeout(timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;

if (typeof is_home === "undefined") var is_home = $('body').hasClass('home');
if (typeof is_page_49 === "undefined") var is_page_49 = $('body').hasClass('page-id-49');
if (typeof is_inspiration === "undefined") var is_inspiration = $('body').hasClass('post-type-archive-reflection');

var moved = false;
function moveSubscription() {
	viewport = updateViewportDimensions();
	// if we're less than 768, and the box is visible, move it
	if (viewport.width < 1030 && (is_home || is_page_49) && !moved) {
		$('#right').insertAfter('#author-grid');
		moved = true;
	} else if (moved && viewport.width >= 1030){
		$('#right').insertBefore('#author-clear');
		moved = false;
	}
}
moveSubscription();
/*
 * Put all your regular jQuery in here.
 */
jQuery(document).ready(function($) {
	moveSubscription();
	// If front page, init masonry
	if (is_home) {
		viewport = updateViewportDimensions();
		// if we're above or equal to 768 fire this off
		if (viewport.width >= 768) {
			// On home page and window sized to 768 width or more.
			$container = $('#main-reflections');
			$container.masonry({    
				itemSelector: 'article',
				percentPosition: true
			}).imagesLoaded(function(){
				$container.masonry('reloadItems');   
				$container.masonry('layout');
			});
			$(window).resize(function () {
				//$('#main-reflections').masonry('reloadItems');
			});

		} 
	}
	// If participant-page, init masonry
	if (is_page_49){
		viewport = updateViewportDimensions();
		// if we're above or equal to 768 fire this off
		/*if (viewport.width >= 768) {
			// On home page and window sized to 768 width or more.
			$container = $('#author-grid');
			$container.masonry({    
				itemSelector: '.author-box',
				percentPosition: true,
				gutter: '.gutter',
			}).imagesLoaded(function(){
				$container.masonry('reloadItems');   
				$container.masonry('layout');
			});
			$(window).resize(function () {
				
				//$('#author-grid').masonry('reloadItems');
			});
		} */
	}
	// If inspiration archive, init masonry
	if (is_inspiration){
		viewport = updateViewportDimensions();
		// if we're above or equal to 768 fire this off
		if (viewport.width >= 768) {
			// On home page and window sized to 768 width or more.
			$container = $('#main');
			$container.masonry({    
				itemSelector: 'article',
				percentPosition: true,
				gutter: '.archive-spacer'
			}).imagesLoaded(function(){
				$container.masonry('reloadItems');   
				$container.masonry('layout');
			});
			$(window).resize(function () {
				//$('#main').masonry('reloadItems');
			});

		}
	}
	// Reposition subscription-box if mobile/iPad
	$(window).resize(function () {
		moveSubscription();
	});
	/*$('.newsletter-email').focus(function(){
		if ($('.newsletter-email').val() === "Your e-mail"){
			$('.newsletter-email').val("");
		}
	});
	$('.newsletter-email').blur(function(){
		if ($('.newsletter-email').val().length === 0){
			$('.newsletter-email').val("Your e-mail");
		}
	});*/
	
}); /* end of as page load scripts */