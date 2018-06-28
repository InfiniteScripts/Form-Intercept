<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.infinitescripts.com
 * @since      1.0.0
 *
 * @package    form_intercept
 * @subpackage form_intercept/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    form_intercept
 * @subpackage form_intercept/admin
 * @author     Kevin Greene <kevin@infinitescripts.com>
 */
class form_intercept_admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $form_intercept   The ID of this plugin.
	 */
	private $form_intercept = "Form Intercept";

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version = "1.0.0";

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $form_intercept       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $form_intercept, $version ) {

		$this->form_intercept = $form_intercept;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function form_intercept_admin_enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in form_intercept_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The form_intercept_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->form_intercept, plugin_dir_url( __FILE__ ) . 'css/form-intercept-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function form_intercept_admin_enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in form_intercept_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The form_intercept_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->form_intercept, plugin_dir_url( __FILE__ ) . 'js/form-intercept-admin.js', array( 'jquery' ), $this->version, false );

	}

}
