<?php
namespace EmpireArtist\ReferralForm;

defined( 'ABSPATH' ) || exit;

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