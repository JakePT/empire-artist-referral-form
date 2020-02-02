<?php
namespace EmpireArtist\ReferralForm\Subscribers;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use EmpireArtist\ReferralForm\Interfaces\HasActions;
use function EmpireArtist\ReferralForm\get_referral_link_by_email;

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

		return get_referral_link_by_email( $email_address );
	}
}