<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://enesnet.de
 * @since             1.0.0
 * @package           Caldav_List
 *
 * @wordpress-plugin
 * Plugin Name:       caldavlist
 * Plugin URI:        https://enesnet.de
 * Description:       Display events from a caldav-Server in wordpress.
 * Version:           1.1.4
 * Author:            Oliver Enes
 * Author URI:        https://enesnet.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       caldavlist
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CALDAV_LIST_VERSION', '1.1.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-caldav-list-activator.php
 */
function activate_caldav_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-caldav-list-activator.php';
	Caldav_List_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-caldav-list-deactivator.php
 */
function deactivate_caldav_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-caldav-list-deactivator.php';
	Caldav_List_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_caldav_list' );
register_deactivation_hook( __FILE__, 'deactivate_caldav_list' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-caldav-list.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_caldav_list() {

	$plugin = new Caldav_List();
	$plugin->run();

}
run_caldav_list();
