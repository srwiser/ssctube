(function($) 
{ 
	// Facebook works, even with ads blocker.
	// toggle if facebook api loaded.
	$('.wpvq-facebook-yesscript').hide();

	// fbAsyncInit already exists ?
    if (typeof window.fbAsyncInit === 'function') 
    {
		if (window.fbAsyncInit.hasRun === true) {
            wpvq_social_init();
            if(wpvq_js_debug) { console.log('solo run!'); }
        } else {
            var oldCB = window.fbAsyncInit;
            window.fbAsyncInit = function () {
                if (typeof oldCB === 'function') {
                    oldCB();
                    if(wpvq_js_debug) { console.log('old CB runs!'); }
                }
                wpvq_social_init(); // do something
                if(wpvq_js_debug) { console.log('inherit!'); }
            };
        }
    }

    // no fbAsyncInit function.
    else
    {
    	window.fbAsyncInit = function() {
    		wpvq_social_init(); // do something
            if(wpvq_js_debug) { console.log('uniq fbAsyncInit!'); }
    	}
    }

	// Share button with SDK.
	function wpvq_social_init() 
	{
		if (wpvq_API_already_loaded == 'false') { // not boolean, because wp_localize_script stringify booleans.
			FB.init({
				appId      : wpvq_facebookAppID, // App ID
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
			});
		}

		if(typeof(FB) === "object" && FB._apiKey === null) {   
			if(wpvq_js_debug) { console.log('need to load manually FB.init!'); }
		}

		if(wpvq_js_debug) { console.log('wp social init'); }

		// Use real facebook api button.
		$('.wpvq-facebook-yesscript').show();
		$('.wpvq-facebook-noscript').hide();

		// Trigger on FB Real Share Button
	    $('.wpvq-facebook-share-button').click(function(e) 
		{
			// Add HTML because .text() absolutely needs it. Stupid.
			// Desc : strip html + blank line
			wpvq_facebook_description = $('<p>'+wpvq_facebook_description+'</p>').text();
			wpvq_facebook_description = wpvq_facebook_description.replace(/[\n\r]/g, '');

			// Title : strip html + blank line
			wpvq_facebook_caption = $('<p>'+wpvq_facebook_caption+'</p>').text();
			wpvq_facebook_caption = wpvq_facebook_caption.replace(/[\n\r]/g, '');

			FB.ui({
			    method: 'feed',
			    link: wpvq_facebookLink,
			    name: wpvq_facebook_caption,
			    caption: wpvq_facebookLink,
			    description: wpvq_facebook_description,
			    picture: wpvq_facebook_picture
			}, function (response) {
				if (wpvq_forceFacebookShare == 'true') {
				    if (response === null || typeof response === 'undefined') {
				    	// nothing.
				    } else {
				    	$('#wpvq-forceToShare-before-results').hide();
				        if (askEmail || askNickname) {
				        	$('#wpvq-ask-before-results').show();
				        } else {
				        	$('#wpvq-general-results').show();
				        }
				    }
				}
			});

			e.preventDefault();
		});
	}

})(jQuery);