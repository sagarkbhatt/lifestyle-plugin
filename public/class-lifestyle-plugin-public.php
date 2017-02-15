<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.sagar.rtcamp.info
 * @since      1.0.0
 *
 * @package    Lifestyle_Plugin
 * @subpackage Lifestyle_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lifestyle_Plugin
 * @subpackage Lifestyle_Plugin/public
 * @author     Sagar <sagar.bhatt@rtcamp.info>
 */
class Lifestyle_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Lifestyle_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lifestyle_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lifestyle-plugin-public.css', array(), $this->version, 'all' );

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
		 * defined in Lifestyle_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lifestyle_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->plugin_name . '-nav', plugin_dir_url( __FILE__ ) . 'js/vendor/navigation.js', array( 'jquery' ), $this->version, true );
		wp_register_script( $this->plugin_name . '-mm', plugin_dir_url( __FILE__ ) . 'js/vendor/jquery.mmenu.min.all.js', array( 'jquery' ),$this->version, true );
		wp_register_script( $this->plugin_name . '-slick', plugin_dir_url( __FILE__ ) . 'js/vendor/slick.js', array( 'jquery' ), $this->version, true );
		wp_register_script( $this->plugin_name . '-main', plugin_dir_url( __FILE__ ) . 'js/lifestyle-plugin-public.js', array( 'jquery', $this->plugin_name . '-nav', $this->plugin_name . '-mm', $this->plugin_name . '-slick' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-main' );
		wp_localize_script( $this->plugin_name . '-main', 'ajax_url', admin_url( 'admin-ajax.php' ) );
		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lifestyle-plugin-public.js', array( 'jquery' ), $this->version, false );

	}

}
