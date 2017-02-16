<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 16/2/17
	 * Time: 5:39 PM
	 */
function get_currency_rate( $atts ) {
	$args = shortcode_atts( array(
		'rate' => 'INR',
	), $atts );
	ob_start();

	$body = get_transient( 'currency_api' );
	if ( false == $body ) {
		$url = 'http://api.fixer.io/latest';
		$response = wp_remote_get( $url );
		if ( is_wp_error( $response ) ) {
			return false;
		}
		$body = wp_remote_retrieve_body( $response );
		set_transient( 'currency_api', $body, 60 * 2 );
	}
	$data = json_decode( $body );
	if ( ! empty( $data ) ) {
		$rate = $data->rates;

		echo $args['rate'] . ': ' . $rate->{$args['rate']};

	}
	echo ob_get_clean();
}
add_shortcode( 'currency_rate','get_currency_rate' );
