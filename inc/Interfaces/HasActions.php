<?php
namespace EmpireArtist\ReferralForm\Interfaces;

interface HasActions {
	/**
	 * Return the list of actions this class subscribes to.
	 *
	 * @return array Array indexed by the hook names, where each item is an
	 *               array containing the class method callback, priority, and
	 *               number of accepted arguments.
	 */
	public function get_actions();
}
