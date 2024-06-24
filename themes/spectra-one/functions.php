<?php
/**
 * Functions and definitions
 *
 * @package Spectra One
 * @author Brainstorm Force
 * @since 0.0.1
 */

declare( strict_types=1 );

namespace Swt;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

const SWT_VER  = '1.1.2';
const SWT_SLUG = 'spectra-one';
const SWT_NAME = 'Spectra One';
const SWT_PFX  = 'swt';
const SWT_LOC  = 'spectraOne';
const SWT_NS   = __NAMESPACE__ . '\\';
const SWT_DS   = DIRECTORY_SEPARATOR;
const SWT_DIR  = __DIR__ . SWT_DS;

/**
 * Setup base spectra one functions
 */
require_once SWT_DIR . 'inc/utilities/all.php';
require_once SWT_DIR . 'inc/theme-options.php';
require_once SWT_DIR . 'inc/theme-updater.php';
require_once SWT_DIR . 'inc/scripts.php';
require_once SWT_DIR . 'inc/blocks/all.php';
require_once SWT_DIR . 'inc/compatibility/all.php';
require_once SWT_DIR . 'inc/extensions/all.php';
require_once SWT_DIR . 'inc/block-styles/all.php';

/**
 * Admin functions
 */

require_once SWT_DIR . 'inc/admin/welcome-notice.php';
require_once SWT_DIR . 'inc/admin/settings.php';

// Language Switcher

function custom_polylang_langswitcher() {
	$output = '';
	if ( function_exists( 'pll_the_languages' ) ) {
		$args   = [
		'show_flags' => 1,
        'hide_if_empty' => 0,
		'show_names' => 0,
		'echo' => 0,
		'dropdown' => 2,
		'flag' => 0,
			];
		$output = '<ul class="polylang_langswitcher">'.pll_the_languages( $args ). '</ul>';
	}

	return $output;
}

function custom_polylang_langswitcher2() {
	$output = '';
	if ( function_exists( 'pll_the_languages' ) ) {
		$args   = [
		'show_flags' => 1,
        'hide_if_empty' => 0,
		'show_names' => 1,
		'echo'       => 0,
		'dropdown' => 1,
			];
		$output = '<ul class="mobile_langswitcher">'.pll_the_languages($args). '</ul>';
	}

	return $output;
}


add_shortcode( 'polylang_langswitcher', 'Swt\\custom_polylang_langswitcher' );


add_shortcode( 'mobile_langswitcher', 'Swt\\custom_polylang_langswitcher2' );



