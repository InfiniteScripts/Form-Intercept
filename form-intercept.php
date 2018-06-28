<?php

/**
 * @link       http://www.infinitescripts.com/form-intercept
 * @since      1.0.0
 *
 * @package    form_intercept
 *
 *
 * Plugin Name:       Form Intercept
 * Plugin URI:        http://www.infinitescripts.com/form-intercept/
 * Description:       Adds tracking funcationality for your users. Tracks login times, IP addresses and addresses.
 * Version:           1.0.0
 * Author:            Kevin Greene
 * Author URI:        http://www.infinitescripts.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       form-intercept
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-form-intercept-activator.php
 */
function activate_form_intercept() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-form-intercept-activator.php';
	form_intercept_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-form-intercept-deactivator.php
 */
function deactivate_form_intercept() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-form-intercept-deactivator.php';
	form_intercept_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_form_intercept' );
register_deactivation_hook( __FILE__, 'deactivate_form_intercept' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-form-intercept.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_form_intercept() {

	$plugin = new form_intercept();
	$plugin->run();

}
run_form_intercept();
