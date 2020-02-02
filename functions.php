<?php
namespace EmpireArtist\ReferralForm;

defined( 'ABSPATH' ) || exit;

use WP_Error;

/**
 * Get URL to a plugin file.
 *
 * @return string The URL to a file in the plugin.
 */
function get_plugin_file_uri( $path ) {
	return plugin_dir_url( __FILE__ ) . $path;
}

/**
 * Get path to a plugin file.
 *
 * @return string The full path to a file in the plugin.
 */
function get_plugin_file_path( $path ) {
	return plugin_dir_path( __FILE__ ) . $path;
}

/**
 * Find a referral link based on a provided email address.
 *
 * @param string $email_address An email address.
 * @return string|WP_Error A referral link URL on success, or WP_Error on failure.
 */
function get_referral_link_by_email( string $email_address ) {
	$user = get_user_by( 'email', $email_address );

	if ( ! $user ) {
		return new WP_Error(
			'empire_artist_referral_form_email_not_found',
			 __( 'No referrer found with that email address', 'empire-artist-referral-form' ),
 			[ 'status' => 400 ]
		);
	}

	$base_url = get_option( 'rs_static_generate_link' );

	if ( ! $base_url ) {
		return new WP_Error(
			'empire_artist_referral_form_no_base_url',
			 __( 'No referral link found.', 'empire-artist-referral-form' ),
 			[ 'status' => 400 ]
		);
	}

	/**
	 * Generate referral link. Method based on code in SUMO Reward Points 24.3.
	 */
	$refer_by_username = ( '1' === get_option( 'rs_generate_referral_link_based_on_user' ) );
	$ip_restricted     = ( 'yes' === get_option( 'rs_restrict_referral_points_for_same_ip' ) );

	$query_args = [
		'ref' => $refer_by_username ? $user->user_login : $user->ID,
	];

	if ( $ip_restricted ) {
		$query_args['ip']  = base64_encode( get_referrer_ip_address() );
	}

	return add_query_arg( $query_args , $base_url ) ;
}