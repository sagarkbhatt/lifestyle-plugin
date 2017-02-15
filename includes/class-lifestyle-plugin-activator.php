<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.sagar.rtcamp.info
 * @since      1.0.0
 *
 * @package    Lifestyle_Plugin
 * @subpackage Lifestyle_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lifestyle_Plugin
 * @subpackage Lifestyle_Plugin/includes
 * @author     Sagar <sagar.bhatt@rtcamp.info>
 */
class Lifestyle_Plugin_Activator {


		/**
		 * Short Description. (use period)
		 *
		 * Long Description.
		 *
		 * @since    1.0.0
		 */

	public static function activate() {
		global $wpdb;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $wpdb->prefix . Lifestyle_Plugin::$table_name . '(
				`meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
				`slider_id` bigint(20) NOT NULL DEFAULT 0,
				`meta_key` varchar(255) DEFAULT NULL,
				`meta_value` longtext,
				PRIMARY KEY (`meta_id`),
				KEY `slider_id` (`slider_id`),
				KEY `meta_key` (`meta_key`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}


}
