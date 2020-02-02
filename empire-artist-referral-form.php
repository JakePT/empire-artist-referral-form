<?php
/**
 * Plugin Name: Empire Artist Referral Form
 * Plugin URI:  https://empire-artist.com
 * Description: A WordPress plugin that provides a form for redirecting users to their referrer's unique link, based on their email address.
 * Author:      Jacob Peattie
 */
namespace EmpireArtist\ReferralForm;

defined( 'ABSPATH' ) || exit;

require __DIR__ . '/autoload.php';
require __DIR__ . '/functions.php';

global $empire_artist_referral_form;

$empire_artist_referral_form = new Plugin;
$empire_artist_referral_form->run();

register_activation_hook( __FILE__, [ $empire_artist_referral_form, 'activate' ] );
register_deactivation_hook( __FILE__, [ $empire_artist_referral_form, 'deactivate' ] );