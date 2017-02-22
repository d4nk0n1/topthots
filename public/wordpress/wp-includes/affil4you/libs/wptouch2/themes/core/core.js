/*
 * WPtouch 1.9.x -The WPtouch Core JS File
 */

var $wpt = jQuery.noConflict();

if ( ( navigator.platform == 'iPhone' || navigator.platform == 'iPod' ) && typeof orientation != 'undefined' ) { 
	var touchStartOrClick = 'touchstart'; 
} else {
	var touchStartOrClick = 'click'; 
};

/* Try to get out of frames! */
if ( window.top != window.self ) { 
	window.top.location = self.location.href
}

$wpt.fn.wptouch2FadeToggle = function( speed, easing, callback ) { 
	return this.animate( {opacity: 'toggle'}, speed, easing, callback ); 
};

function wptouch2_switch_confirmation( e ) {
	if ( document.cookie && document.cookie.indexOf( 'wptouch2_switch_toggle' ) > -1 ) {
	// just switch
		$wpt( '#switch span' ).removeClass( 'active' );
		$wpt( '.off' ).addClass( 'active' );
		setTimeout('switch_delayer()', 500 ); 
	} else {
	// ask first
	    if ( confirm( "Switch to regular view? \n \n You can switch back again in the footer." ) ) {
		$wpt( '#switch span' ).removeClass( 'active' );
		$wpt( '.off' ).addClass( 'active' );
			setTimeout( 'switch_delayer()', 500 );
			
		} else {
	        e.preventDefault();
	        e.stopImmediatePropagation();
		}
	}
}

if ( $wpt( '#prowl-success' ).length ) {
	setTimeout( function() { $wpt( '#prowl-success' ).fadeOut( 350 ); }, 5250 );
}
if ( $wpt( '#prowl-fail' ).length ) {
	setTimeout( function() { $wpt( '#prowl-fail' ).fadeOut( 350 ); }, 5250 );
}

$wpt(function() {
    var tabContainers = $wpt( '#menu-head > ul' );   
    $wpt( '#tabnav a' ).bind(touchStartOrClick, function () {
        tabContainers.hide().filter( this.hash ).show();
    $wpt( '#tabnav a' ).removeClass( 'selected' );
    $wpt( this ).addClass( 'selected' );
        return false;
    }).filter( ':first' ).trigger( touchStartOrClick );
});

function bnc2_showhide_coms_toggle() {
	$wpt( '#commentlist' ).wptouch2FadeToggle( 350 );
	$wpt( 'img#com-arrow' ).toggleClass( 'com-arrow-down' );
	$wpt( 'h3#com-head' ).toggleClass( 'comhead-open' );
}
	
function doWPtouchReady() {

	$wpt( '#headerbar-menu a' ).bind( touchStartOrClick, function( e ){
		$wpt( '#wptouch2-menu' ).wptouch2FadeToggle( 350 );
		$wpt( '#headerbar-menu a' ).toggleClass( 'open' );
	});

	$wpt( 'a#searchopen, #wptouch2-search-inner a' ).click( function(){	
		$wpt( '#wptouch2-search' ).wptouch2FadeToggle( 350 );
		$wpt( '#s' ).focus();		
	});
	
	$wpt( 'a#prowlopen' ).bind( touchStartOrClick, function( e ){	
		$wpt( '#prowl-message' ).wptouch2FadeToggle( 350 );
	});
	
	$wpt( 'a#wordtwitopen' ).bind( touchStartOrClick, function( e ){	
		$wpt( '#wptouch2-wordtwit' ).wptouch2FadeToggle( 350 );
	});

	$wpt( 'a#gigpressopen' ).bind( touchStartOrClick, function( e ){	
		$wpt( '#wptouch2-gigpress' ).wptouch2FadeToggle( 350 );
	});

	$wpt( 'a#loginopen, #wptouch2-login-inner a' ).bind( touchStartOrClick, function( e ){	
		$wpt( '#wptouch2-login' ).wptouch2FadeToggle(350);
	});
	
	$wpt( 'a#obook' ).bind( touchStartOrClick, function() {
		$wpt( '#bookmark-box' ).wptouch2FadeToggle(350);
	});
	
	$wpt( '.singlentry img, .singlentry .wp-caption' ).each( function() {
		if ( $wpt( this ).width() <= 250 ) {
			$wpt( this ).addClass( 'aligncenter' );
		}
	});
	
	if ( $wpt( '#FollowMeTabLeftSm' ).length ) {
		$wpt( '#FollowMeTabLeftSm' ).remove();
	}
	
	/* add dynamic automatic video resizing via fitVids */

	var videoSelectors = [
		"iframe[src^='http://player.vimeo.com']",
		"iframe[src^='http://www.youtube.com']",
		"iframe[src^='http://www.kickstarter.com']",
		"object",
		"embed",
		"video"
	];
	
	var allVideos = $wpt( '.post' ).find( videoSelectors.join(',') );
	
	$wpt( allVideos ).each( function(){ 
		$wpt( this ).unwrap().addClass( 'wptouch2-videos' ).parentsUntil( '.content', 'div:not(.fluid-width-video-wrapper), span' ).removeAttr( 'width' ).removeAttr( 'height' ).removeAttr( 'style' );
	});

	$wpt( '.post' ).fitVids();
	
	$wpt( '.post-arrow' ).live( touchStartOrClick, function( e ){
		$wpt( this ).toggleClass( 'post-arrow-down' );
		$wpt( this ).parents( '.post' ).find( '.mainentry' ).wptouch2FadeToggle(500);
	});

	$wpt( 'span.off' ).bind( 'click', function(){
		wptouch2_switch_confirmation();
	});
	
}

$wpt( document ).ready( function() { doWPtouchReady(); } );


/*global jQuery */
/*! 
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*
* Modified by BraveNewCode for WPtouch Pro
*/

(function( $ ){

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    }
    
    var div = document.createElement('div'),
        ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];
        
  	div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper *{  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';
                      
    ref.parentNode.insertBefore(div,ref);
    
    if ( options ) { 
      $.extend( settings, options );
    }
    
    return this.each(function(){
      var selectors = [
        "iframe[src^='http://player.vimeo']", 
        "iframe[src^='http://www.youtube']", 
        "iframe[src^='http://www.kickstarter']",
//     "iframe[src^='http://maps.google']",
        "object", 
        "embed",
        "video"
      ];
      
      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }
      
      var $allVideos = $(this).find(selectors.join(','));

      $allVideos.each(function(){
        var $this = $(this);

        if (this.tagName.toLowerCase() == 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; } 
		var height = $this.height(), aspectRatio = height / $this.width();
//		var height = this.tagName.toLowerCase() == 'object' ? $this.attr('height') : $this.height(),

        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  
  }
})( jQuery );