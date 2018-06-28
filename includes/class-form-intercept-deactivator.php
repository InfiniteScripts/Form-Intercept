<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.infinitescripts.com/form-intercept
 * @since      1.0.0
 *
 * @package    form_intercept
 * @subpackage form_intercept/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    form_intercept
 * @subpackage form_intercept/includes
 * @author     Kevin Greene <kevin@infinitescripts.com>
 */
class form_intercept_deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;

		//We need to remove the database table we added
		$table_name = $wpdb->prefix . 'form_intercept';
    	$wpdb->query( "DROP TABLE IF EXISTS $table_name" );
    
	}

}
