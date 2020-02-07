/* global empireArtistReferralFormConfig, jQuery */

var empireArtistReferralForm = ( function( $ ) {
	var config    = window.empireArtistReferralFormConfig;
	var $form     = $( '.empire-artist-referral-form__form' );
	var $submit   = $( '.empire-artist-referral-form__submit' );
	var $messages = $( '.empire-artist-referral-form__messages' );

	/**
	 * Look up an email and redirect to the returned referral link.
	 */
	var lookupReferralLink = function( event ) {
		event.preventDefault();

		$.ajax(
			{
				url: config.apiUrl,
				method: 'GET',
				data: {
					email_address: event.target.email_address.value,
				},

				/**
				 * On submission, clear previous messages and disable the form.
				 */
				beforeSend: function() {
					$submit.prop( 'disabled', true );
					resetMessages();
				},

				/**
				 * On success, redirect to the referral link.
				 */
				success: function( data ) {
					window.location.replace( data );
				},

				/**
				 * On failure display an error message.
				 */
				error: function( xhr, textStatus ) {
					if ( xhr.responseJSON.hasOwnProperty( 'message' ) ) {
						addMessage( xhr.responseJSON.message );
					} else {
						addMessage( config.genericError );
					}
				},

				/**
				 * When finished, re-enabled the form.
				 */
				complete: function() {
					$submit.prop( 'disabled', false );
				}
			}
		);
	};

	/**
	 * Reset messages.
	 */
	var resetMessages = function() {
		$messages.empty();
	};

	/**
	 * Add message.
	 */
	var addMessage = function( message ) {
		var $message = $( '<p></p>' ).text( message );

		$messages.append( $message );
	}

	/**
	 * Bind events.
	 */
	var init = function() {
		$submit.prop( 'disabled', false );
		$form.on( 'submit', lookupReferralLink );
	};

	return init;
}( jQuery ) );

document.addEventListener( 'DOMContentLoaded', empireArtistReferralForm );