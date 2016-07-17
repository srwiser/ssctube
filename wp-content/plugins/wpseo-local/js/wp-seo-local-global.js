jQuery(document).ready(function($) {
	$('#use_multiple_locations').click( function() {
		if( $(this).is(':checked') ) {
			$('#use_multiple_locations').attr('disabled', true);
			$('#show-single-location').slideUp( function() {
				$('#show-multiple-locations').slideDown();
				$('#show-opening-hours').slideUp( function() {
					$('#use_multiple_locations').removeAttr('disabled');
				});
			});
		}
		else {
			$('#use_multiple_locations').attr('disabled', true);
			$('#show-multiple-locations').slideUp( function() {
				$('#show-single-location').slideDown();
				$('#show-opening-hours').slideDown(  function() {
					$('#use_multiple_locations').removeAttr('disabled');
				});
			});
		}
	});

	$('#hide_opening_hours').click( function() {
		if( $(this).is(':checked') ) {
			$('#hide-opening-hours').slideUp();
		}
		else {
			$('#hide-opening-hours').slideDown();
		}
	});
	$('#multiple_opening_hours, #wpseo_multiple_opening_hours').click( function() {
		if( $(this).is(':checked') ) {
			$('.opening-hours .opening-hour-second').slideDown();
		}
		else {
			$('.opening-hours .opening-hour-second').slideUp();
		}
	});

	$('.widget-content').on('click', '#wpseo-checkbox-multiple-locations-wrapper input[type=checkbox]', function() {
		wpseo_show_all_locations_selectbox( $(this) );
	});

	// Show locations metabox before WP SEO metabox
	if ( $('#wpseo_locations').length > 0 && $('#wpseo_meta').length > 0 ) {
		$('#wpseo_locations').insertBefore( $('#wpseo_meta') );
	}

    $('.openinghours_from').change( function() {
    	var to_id = $(this).attr('id').replace('_from','_to_wrapper');
    	var second_id = $(this).attr('id').replace('_from','_second');

        if ( $(this).val() == 'closed' ) {
            $( '#' + to_id ).css('display','none');
            $( '#' + second_id ).css('display','none');
        }
        else {
            $( '#' + to_id ).css('display','inline');
            $( '#' + second_id ).css('display','block');
        }
    }).change();
    $('.openinghours_from_second').change( function() {
    	var to_id = $(this).attr('id').replace('_from','_to_wrapper');

        if ( $(this).val() == 'closed' ) {
            $( '#' + to_id ).css('display','none');
        }
        else {
            $( '#' + to_id ).css('display','inline');
        }
    }).change();
	$('.openinghours_to').change( function() {
		var from_id = $(this).attr('id').replace('_to','_from');
		var to_id = $(this).attr('id').replace('_to','_to_wrapper');
		if ( $(this).val() == 'closed' ) {
			$( '#' + to_id ).css('display','none');
			$( '#' + from_id ).val( 'closed' );
		}
	});
	$('.openinghours_to_second').change( function() {
		var from_id = $(this).attr('id').replace('_to','_from');
		var to_id = $(this).attr('id').replace('_to','_to_wrapper');
		if ( $(this).val() == 'closed' ) {
			$( '#' + to_id ).css('display','none');
			$( '#' + from_id ).val( 'closed' );
		}
	});

    if ($('.set_custom_images').length > 0) {
        if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            $('.wrap').on('click', '.set_custom_images', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.attr('data-id');
                wp.media.editor.send.attachment = function(props, attachment) {
                	$('#' + id).attr( 'src', attachment.url );
					$('.wpseo-local-custom-marker-wrapper .wpseo-local-hide-button').show();
                	$('#hidden_' + id ).attr( 'value', attachment.id );
                };
                wp.media.editor.open(button);
                return false;
            });
        }
    }

    $('.remove_custom_image').on('click', function(e) {
		e.preventDefault();

		var id = $(this).attr('data-id');
    	$('#' + id ).attr( 'src', '' ).hide();
    	$('#hidden_' + id ).attr( 'value', '' );
		$('.wpseo-local-custom-marker-wrapper .wpseo-local-hide-button').hide();
    });

    // Copy location data
    $('#wpseo_copy_from_location').change( function() {
    	var location_id = $(this).val();
    	
    	if( location_id == '' ) 
    		return;

    	$.post( wpseo_local_data.ajaxurl, {
    		location_id: location_id,
    		security: wpseo_local_data.sec_nonce,
    		action: 'wpseo_copy_location'
    	}, function( result ) {
    		if(result.charAt(result.length - 1) == 0) {
				result = result.slice(0, -1);
			}
			else if(result.substring(result.length - 2) == "-1") {
				result = result.slice(0, -2);
			}

			var data = $.parseJSON( result );
			if( data.success == 'true' || data.success == true ) {

				for( var i in data.location ) {
					var value = data.location[ i ];

					if( value != null && value != '' && typeof value != 'undefined' ) {
						if( i == 'is_postal_address' || i == 'multiple_opening_hours' ) {
							if( value == '1' ) {
								$('#wpseo_' + i).attr('checked', 'checked');
								$('.opening-hours .opening-hour-second').slideDown();
							}
						}
						else if ( i.indexOf('opening_hours') > -1 ) {
							$('#' + i).val( value );
						}
						else {
							$('#wpseo_' + i).val( value );
						}
					}
				}
			}
    	});
    });
});

function wpseo_show_all_locations_selectbox(obj) {
	$ = jQuery;

	$obj = $(obj);
	var parent = $obj.parents('.widget-inside');
	var $locationsWrapper = $('#wpseo-locations-wrapper', parent);

	if( $obj.is(':checked') ) {
		$locationsWrapper.slideUp();
	}
	else {
		$locationsWrapper.slideDown();
	}
}
