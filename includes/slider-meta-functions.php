<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 15/2/17
	 * Time: 3:00 PM
	 */
function add_slider_meta( $id, $key, $val ) {
	return add_metadata( 'slider', $id, $key, $val );
}
function update_slider_meta( $id, $key, $val ) {
	return update_metadata( 'slider', $id, $key, $val );
}
function delete_slider_meta( $id, $key, $val ) {
	return delete_metadata( 'slider', $id, $key, $val );
}
function get_slider_meta( $id, $key, $val ) {
	return get_metadata( 'slider', $id, $key, $val );
}
add_action( 'plugins_loaded', 'register_table', 11 );
function register_table() {
		global $wpdb;
		$wpdb->slidermeta = $wpdb->prefix . Lifestyle_Plugin::$table_name;
}

