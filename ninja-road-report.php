<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://thats.ninja
 * @since             1.0.0
 * @package           Ninja_Road_Report
 *
 * @wordpress-plugin
 * Plugin Name:       Ninja Road Report
 * Plugin URI:        https://thats.ninja/
 * Description:       Leverages the OpenWeather commercial API overlaid on Google Maps to provide traffic reports along a specified route.
 * Version:           1.0.0
 * Author:            ThatsNinja
 * Author URI:        https://thats.ninja
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ninja-road-report
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
define( 'Ninja_Road_Report_VERSION', '1.0.0' );

/**
 * Missing Elementor notice
 */
function admin_notice_missing_main_plugin()	{
	$message = sprintf(
		esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ninja-road-report' ),
		'<strong>' . esc_html__( 'Elementor Ninja_Road_Report', 'ninja-road-report' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'ninja-road-report' ) . '</strong>'
	);

	printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ninja-road-report-activator.php
 */
function activate_Ninja_Road_Report() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ninja-road-report-activator.php';
	Ninja_Road_Report_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ninja-road-report-deactivator.php
 */
function deactivate_Ninja_Road_Report() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ninja-road-report-deactivator.php';
	Ninja_Road_Report_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Ninja_Road_Report' );
register_deactivation_hook( __FILE__, 'deactivate_Ninja_Road_Report' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ninja-road-report.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

$plugin = new Ninja_Road_Report();
$plugin->run();

/**
 * Get the list of active plugin...
 * ...then check if Elementor is active, and register my widgets
 */
$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins'));

if (in_array( 'elementor/elementor.php', $active_plugins ) ) {
	
	add_action( 'init', function() use ($plugin) {
			$plugin->register_elementor_widgets();
	});

} else {
	add_action( 'admin_notices', 'admin_notice_missing_main_plugin');								
}