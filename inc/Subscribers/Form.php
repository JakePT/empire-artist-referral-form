<?php
namespace EmpireArtist\ReferralForm\Subscribers;

use EmpireArtist\ReferralForm\Interfaces\HasActions;
use EmpireArtist\ReferralForm\Interfaces\HasShortcodes;
use function EmpireArtist\ReferralForm\get_plugin_file_uri;
use function EmpireArtist\ReferralForm\get_plugin_file_path;

class Form implements HasActions, HasShortcodes {
	/**
	 * @see HasActions
	 */
	public function get_actions() {
		return [
			'empire_artist_referral_form' => [ 'form', 10, 0 ],
			'wp_enqueue_scripts'          => [ 'register_assets', 10, 0 ],
		];
	}

	/**
	 * @see HasShortcodes
	 */
	public function get_shortcodes() {
		return [
			'empire_artist_referral_form' => 'shortcode',
		];
	}

	/**
	 * Register assets.
	 */
	public function register_assets() {
		wp_register_script(
			'empire-artist-referral-form',
			get_plugin_file_uri( 'assets/js/form.js' ),
			[ 'jquery' ],
			filemtime( get_plugin_file_path( 'assets/js/form.js' ) ),
			true
		);

		wp_localize_script(
			'empire-artist-referral-form',
			'empireArtistReferralFormConfig',
			[
				'apiUrl'       => rest_url( 'empire-artist/referral-form/referral-links' ),
				'genericError' => __( 'Oops! It looks like something went wrong. Please try again.', 'empire-artist-referral-form' ),
			]
		);
	}

	/**
	 * Display the form.
	 */
	public function form() {
		wp_enqueue_script( 'empire-artist-referral-form' );

		require get_plugin_file_path( 'templates/form.php' );
	}

	/**
	 * Shortcode.
	 */
	public function shortcode() {
		ob_start();

		do_action( 'empire_artist_referral_form' );

		return ob_get_clean();
	}
}