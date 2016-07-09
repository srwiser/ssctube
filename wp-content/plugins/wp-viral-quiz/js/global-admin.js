(function($) 
{ 
	$(document).ready(function() 
	{

		$('a.wpvq-menu-anchor').click(function(e) {
			e.preventDefault();
			var anchor = $(this).attr('data-anchor');
			$('html, body').animate( { scrollTop: $('a[name='+anchor+']').offset().top - 40}, 750 );	
		});

		var editor = new Behave({
		    textarea: document.getElementById('wpvq_textarea_custom_css')
		});

		/**
		 * Disable Facebook API input if :
		 * 	- "Please no api" is checked 
		 * 		or/and 
		 * 	- "Already use API" is checked
		 */

		$('#wpvq_checkbox_facebook_no_api').click(function() {
			if ($(this).attr('checked')) {
				$('#wpvq_text_field_facebook_appid').prop('disabled', true);
				php_vars.wpvq_noNeedApi = true;
			} else {
				if (!php_vars.wpvq_apiAlreadyLoaded) {
					$('#wpvq_text_field_facebook_appid').prop('disabled', false);
				}
				php_vars.wpvq_noNeedApi = false;
			}
		});

		$('#wpvq_checkbox_facebook_already_api').click(function() {
			if ($(this).attr('checked')) {
				$('#wpvq_text_field_facebook_appid').prop('disabled', true);
				php_vars.wpvq_apiAlreadyLoaded = true;
			} else {
				if (!php_vars.wpvq_noNeedApi) {
					$('#wpvq_text_field_facebook_appid').prop('disabled', false);
				}
				php_vars.wpvq_apiAlreadyLoaded = false;
			}
		});

		$('#wpvq_input_progressbar_color').wpColorPicker();

	});

	// -- 
	
})(jQuery);