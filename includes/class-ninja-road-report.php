<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://thats.ninja
 * @since      1.0.0
 *
 * @package    Ninja_Road_Report
 * @subpackage Ninja_Road_Report/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ninja_Road_Report
 * @subpackage Ninja_Road_Report/includes
 * @author     Jonah Sullivan <jonah@thats.ninja>
 */
class Ninja_Road_Report {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ninja_Road_Report_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $Ninja_Road_Report    The string used to uniquely identify this plugin.
	 */
	protected $Ninja_Road_Report;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'Ninja_Road_Report_VERSION' ) ) {
			$this->version = Ninja_Road_Report_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->Ninja_Road_Report = 'ninja-road-report';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		$this->define_elementor_widgets_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ninja_Road_Report_Loader. Orchestrates the hooks of the plugin.
	 * - Ninja_Road_Report_i18n. Defines internationalization functionality.
	 * - Ninja_Road_Report_Admin. Defines all hooks for the admin area.
	 * - Ninja_Road_Report_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ninja-road-report-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ninja-road-report-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ninja-road-report-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ninja-road-report-public.php';

		/**
		 * The class responsible for defining all actions that occur in the front side of our widgets.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'elementor-widgets/class-ninja-road-report-elementor-widgets.php';

		$this->loader = new Ninja_Road_Report_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ninja_Road_Report_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ninja_Road_Report_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

    /**
     * Load the required wigdets...
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_elementor_widgets_dependencies() {        
        // The class responsible for the Simple Menu
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'elementor-widgets/class-simple-menu.php'; 
        
        // ...
    }

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ninja_Road_Report_Admin( $this->get_Ninja_Road_Report(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ninja_Road_Report_Public( $this->get_Ninja_Road_Report(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }
    
    /**
     * Register all of the hooks related to the Elementor widgets
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     * @return   bool
     */
    private function define_elementor_widgets_hooks() {
        
        $plugin_elementor_widgets = new Ninja_Road_Report_Elementor_Widgets( $this->get_Ninja_Road_Report(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_elementor_widgets, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_elementor_widgets, 'enqueue_scripts' );
        
    }

    /**
     * Register all of the widgets related to Elementor
     * @since    1.0.0
     * @access   public
     */
    public function register_elementor_widgets() {
        $this->load_elementor_widgets_dependencies();
        Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Simple_Menu() );
        
        // ...
    }


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_Ninja_Road_Report() {
		return $this->Ninja_Road_Report;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ninja_Road_Report_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
