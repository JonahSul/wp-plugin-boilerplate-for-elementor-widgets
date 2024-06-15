<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://thats.ninja
 * @since      1.0.0
 *
 * @package    Ninja_Road_Report
 * @subpackage Ninja_Road_Report/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ninja_Road_Report
 * @subpackage Ninja_Road_Report/public
 * @author     Jonah Sullivan <jonah@thats.ninja>
 */
class Ninja_Road_Report_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Ninja_Road_Report    The ID of this plugin.
	 */
	private $Ninja_Road_Report;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $Ninja_Road_Report       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Ninja_Road_Report, $version ) {

		$this->Ninja_Road_Report = $Ninja_Road_Report;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ninja_Road_Report_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ninja_Road_Report_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Ninja_Road_Report, plugin_dir_url( __FILE__ ) . 'css/ninja-road-report-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ninja_Road_Report_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ninja_Road_Report_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Ninja_Road_Report, plugin_dir_url( __FILE__ ) . 'js/ninja-road-report-public.js', array( 'jquery' ), $this->version, false );

	}

}
