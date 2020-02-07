<?php
namespace EmpireArtist\ReferralForm\Subscribers;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use EmpireArtist\ReferralForm\Interfaces\HasActions;

class RestReferralLinks implements HasActions {
	/**
	 * @see HasActions
	 */
	public function get_actions() {
		return [
			'rest_api_init' => [ 'register_routes', 10, 0 ],
		];
	}

	/**
	 * Register REST API routes.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			'empire-artist/referral-form',
			'/referral-links',
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'get' ],
				'args'     => [
					'email_address' => [
						'type'     => 'string',
						'required' => true,
					],
				],
			]
		);
	}

	/**
	 * Get a referral link.
	 *
	 * @param WP_REST_Request Request object.
	 */
	public function get( WP_REST_Request $request ) {
		$email_address = $request->get_param( 'email_address' );

		return $this->get_referral_link_by_email( $email_address );
	}

	/**
	 * Find a referral link based on a provided email address.
	 *
	 * @param string $email_address An email address.
	 * @return string|WP_Error A referral link URL on success, or WP_Error on failure.
	 */
	private function get_referral_link_by_email( string $email_address ) {
		$user = get_user_by( 'email', $email_address );

		if ( ! $user ) {
			return new WP_Error(
				'empire_artist_referral_form_email_not_found',
				 __( 'No referrer found with that email address.', 'empire-artist-referral-form' ),
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
}