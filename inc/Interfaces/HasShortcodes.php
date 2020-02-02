<?php
namespace EmpireArtist\ReferralForm\Interfaces;

interface HasShortcodes {
	/**
	 * Return the list of filters this class subscribes to.
	 *
	 * @return array Array indexed by the shortcode tags, where each item is an
	 *               array containing the class method callback.
	 */
	public function get_shortcodes();
}
