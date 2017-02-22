/*
 * WPtouch 1.9.x -The WPtouch Admin Javascript File
 * Last Updated: July 30th, 2012
 */ 
var wptouch2SpinnerCount = 1;
var wpQuery = jQuery;

function wptouch2SpinnerDone() {
	wptouch2SpinnerCount = wptouch2SpinnerCount - 1;
	if ( wptouch2SpinnerCount == 0 ) {
		jQuery('img.ajax-load').fadeOut( 1000 );
	}	
}

jQuery( document ).ready( function() {
	setTimeout(function() { jQuery( '#wptouch2updated' ).fadeOut(330); }, 3000);

	jQuery('#header-text-color, #header-background-color, #header-border-color, #link-color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) { jQuery(el).val(hex); jQuery(el).ColorPickerHide(); },
		onBeforeShow: function () { jQuery(this).ColorPickerSetColor( jQuery(this).attr('value') ); }
	});

	jQuery("a.fancylink").fancybox({
		'padding':	10, 'zoomSpeedIn': 250, 'zoomSpeedOut': 250, 'zoomOpacity': true, 'overlayShow': false, 'frameHeight': 320, 'frameWidth': 450, 'hideOnContentClick': true
	});
	
	wptouch2AjaxTimeout = 5000;
	
	// uncomment below to simulate a failure
	// wptouch2BlogUrl = 'http://somefakeurlasdf.com';
	jQuery.ajax( {
		'url': wptouch2BlogUrl + '?wptouch2-ajax=news',
		'success': function(data) { 
			jQuery( '#wptouch2-news-content' ).hide().html( data ).fadeIn(); 
			wptouch2SpinnerDone();
		},
		'timeout': wptouch2AjaxTimeout,
		'error': function() {
			jQuery( '#wptouch2-news-content' ).hide().html( '<ul><li class="ajax-error">Unable to load the news feed</li></ul>' ).fadeIn();
			wptouch2SpinnerDone();
		},
		'dataType': 'html'
	});
	
	jQuery(function(){
		var tabindex = 1;
		jQuery('input,select').each(function() {
			if (this.type != "hidden") {
				var $input = jQuery(this);
				$input.attr("tabindex", tabindex);
				tabindex++;
			}
		});
	});
	
	wpQuery( document ).ready( function() {
		if ( wpQuery( '#advertising-options' ).length ) {
			wptouch2HandleAdvertising();
			
			wpQuery( '#ad_service' ).change( function() { wptouch2HandleAdvertising() } );
		}
	});
});

function wptouch2HandleAdvertising() {
	var selectValue = wpQuery( '#ad_service' ).attr( 'value' );
	if ( selectValue == 'none' ) {
		wpQuery( '#google-adsense' ).hide();
	} else if ( selectValue == 'adsense' ) {
		wpQuery( '#google-adsense' ).fadeIn( 250 );
	} 
}
