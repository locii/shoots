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
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',$(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();

	
	$(".toggle-menu").click(function() {
		$(this).next('ul').slideToggle('fast');
	});
	
	
	$("#offcanvas a").each(function(){
	
		var linkdest = $(this).attr("href");
		
		
		if(linkdest == "#accordion") {
			$(this).parent().addClass('accordion-trigger').parent().addClass('accordion');
		}
	});
	
	$(".accordion ul").hide();
	
	$('.accordion-trigger a').click(function() {
		$(this).toggleClass('open').next('ul').slideToggle();
	});
	
	
	
	
}); /* end of as page load scripts */


window.getComputedStyle||(window.getComputedStyle=function(t,e){return this.el=t,this.getPropertyValue=function(e){var o=/(\-([a-z]){1})/g;return"float"==e&&(e="styleFloat"),o.test(e)&&(e=e.replace(o,function(){return arguments[2].toUpperCase()})),t.currentStyle[e]?t.currentStyle[e]:null},this}),jQuery(document).ready(function(t){var e=t(window).width();e>=768&&t(".comment img[data-gravatar]").each(function(){t(this).attr("src",t(this).attr("data-gravatar"))}),t(".toggle-menu").click(function(){t(this).next("ul").slideToggle("fast")}),t("a").click(function(){})}),function(t){function e(){r.setAttribute("content",d),c=!0}function o(){r.setAttribute("content",l),c=!1}function n(n){u=n.accelerationIncludingGravity,f=Math.abs(u.x),h=Math.abs(u.y),s=Math.abs(u.z),!t.orientation&&(f>7||(s>6&&8>h||8>s&&h>6)&&f>5)?c&&o():c||e()}if(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1){var i=t.document;if(i.querySelector){var r=i.querySelector("meta[name=viewport]"),a=r&&r.getAttribute("content"),l=a+",maximum-scale=1",d=a+",maximum-scale=10",c=!0,f,h,s,u;r&&(t.addEventListener("orientationchange",e,!1),t.addEventListener("devicemotion",n,!1))}}}(this),function(t){t.fn.lazyload=function(e){var o={threshold:0,failurelimit:0,event:"scroll",effect:"show",container:window};e&&t.extend(o,e);var n=this;return"scroll"==o.event&&t(o.container).bind("scroll",function(e){var i=0;n.each(function(){if(t.belowthefold(this,o)||t.rightoffold(this,o)){if(i++>o.failurelimit)return!1}else t(this).trigger("appear")});var r=t.grep(n,function(t){return!t.loaded});n=t(r)}),this.each(function(){var e=this;t(e).attr("original",t(e).attr("src")),"scroll"!=o.event||t.belowthefold(e,o)||t.rightoffold(e,o)?(o.placeholder?t(e).attr("src",o.placeholder):t(e).removeAttr("src"),e.loaded=!1):e.loaded=!0,t(e).one("appear",function(){this.loaded||t("<img />").bind("load",function(){t(e).hide().attr("src",t(e).attr("original"))[o.effect](o.effectspeed),e.loaded=!0}).attr("src",t(e).attr("original"))}),"scroll"!=o.event&&t(e).bind(o.event,function(o){e.loaded||t(e).trigger("appear")})})},t.belowthefold=function(e,o){if(void 0===o.container||o.container===window)var n=t(window).height()+t(window).scrollTop();else var n=t(o.container).offset().top+t(o.container).height();return n<=t(e).offset().top-o.threshold},t.rightoffold=function(e,o){if(void 0===o.container||o.container===window)var n=t(window).width()+t(window).scrollLeft();else var n=t(o.container).offset().left+t(o.container).width();return n<=t(e).offset().left-o.threshold},t.extend(t.expr[":"],{"below-the-fold":"$.belowthefold(a, {threshold : 0, container: window})","above-the-fold":"!$.belowthefold(a, {threshold : 0, container: window})","right-of-fold":"$.rightoffold(a, {threshold : 0, container: window})","left-of-fold":"!$.rightoffold(a, {threshold : 0, container: window})"})}(jQuery);