<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://thats.ninja
 * @since      1.0.0
 *
 * @package    Ninja_Road_Report
 * @subpackage Ninja_Road_Report/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ninja_Road_Report
 * @subpackage Ninja_Road_Report/includes
 * @author     Jonah Sullivan <jonah@thats.ninja>
 */
class Ninja_Road_Report_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ninja-road-report',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
