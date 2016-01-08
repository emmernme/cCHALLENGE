/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
 *//*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
 */function updateViewportDimensions(){var e=window,t=document,n=t.documentElement,r=t.getElementsByTagName("body")[0],i=e.innerWidth||n.clientWidth||r.clientWidth,s=e.innerHeight||n.clientHeight||r.clientHeight;return{width:i,height:s}}function loadGravatars(){viewport=updateViewportDimensions();viewport.width>=768&&jQuery(".comment img[data-gravatar]").each(function(){jQuery(this).attr("src",jQuery(this).attr("data-gravatar"))})}var $=jQuery.noConflict(),viewport=updateViewportDimensions(),waitForFinalEvent=function(){var e={};return function(t,n,r){r||(r="Don't call this twice without a uniqueId");e[r]&&clearTimeout(e[r]);e[r]=setTimeout(t,n)}}(),timeToWaitForLast=100;if(typeof is_home=="undefined")var is_home=$("body").hasClass("home");if(typeof is_page_49=="undefined")var is_page_49=$("body").hasClass("page-id-49");$(window).resize(function(){is_home&&waitForFinalEvent(function(){viewport=updateViewportDimensions();viewport.width>=768?console.log("On home page and window sized to 768 width or more."):console.log("Not on home page, or window sized to less than 768.")},timeToWaitForLast,"onResize")});jQuery(document).ready(function(e){loadGravatars();is_home&&waitForFinalEvent(function(){viewport=updateViewportDimensions();if(viewport.width>=768)var e=new Masonry("#main-reflections",{itemSelector:"article",percentPosition:!0})},timeToWaitForLast,"init-masonry");is_page_49&&waitForFinalEvent(function(){viewport=updateViewportDimensions();if(viewport.width>=768)var e=new Masonry("#author-grid",{itemSelector:".author-box",percentPosition:!0,gutter:10})},timeToWaitForLast,"init-masonry")});