<?php
namespace EmpireArtist\ReferralForm;

use EmpireArtist\ReferralForm\Interfaces\HasActions;
use EmpireArtist\ReferralForm\Interfaces\HasFilters;
use EmpireArtist\ReferralForm\Interfaces\HasShortcodes;
use EmpireArtist\ReferralForm\Subscribers\Form;
use EmpireArtist\ReferralForm\Subscribers\RestReferralLinks;

class Plugin {
	private $subscribers;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->subscribers = [
			'form'                => new Form(),
			'rest_referral_links' => new RestReferralLinks(),
		];
	}

	/**
	 * Register actions, filters and shortcodes for all dependencies.
	 *
	 * @return void
	 */
	public function run() {
		foreach ( $this->subscribers as $subscriber ) {
			if ( $subscriber instanceof HasActions ) {
				$this->subscribe_actions( $subscriber );
			}

			if ( $subscriber instanceof HasFilters ) {
				$this->subscribe_filters( $subscriber );
			}

			if ( $subscriber instanceof HasShortcodes ) {
				$this->subscribe_shortcodes( $subscriber );
			}
		}
	}

	/**
	 * Register actions for dependencies.
	 *
	 * @return void
	 */
	public function subscribe_actions( HasActions $subscriber ) {
		foreach ( $subscriber->get_actions() as $action => $args ) {
			add_action( $action, [ $subscriber, $args[0] ], $args[1], $args[2] );
		}
	}

	/**
	 * Register filters for dependencies.
	 *
	 * @return void
	 */
	public function subscribe_filters( HasFilters $subscriber ) {
		foreach ( $subscriber->get_filters() as $filter => $args ) {
			add_filter( $filter, [ $subscriber, $args[0] ], $args[1], $args[2] );
		}
	}

	/**
	 * Register shortcodes for dependencies.
	 *
	 * @return void
	 */
	public function subscribe_shortcodes( HasShortcodes $subscriber ) {
		foreach ( $subscriber->get_shortcodes() as $tag => $method ) {
			add_shortcode( $tag, [ $subscriber, $method ] );
		}
	}

	/**
	 * Peform actions on plugin activation.
	 *
	 * @return void
	 */
	public function activate() {

	}

	/**
	 * Peform actions on plugin deactivation.
	 *
	 * @return void
	 */
	public function deactivate() {

	}
}