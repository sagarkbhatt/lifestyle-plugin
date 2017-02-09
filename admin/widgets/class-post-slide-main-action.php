<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 9/2/17
	 * Time: 6:35 PM
	 */
class Post_Slide_Main_Action {
	function __construct() {
		add_action( 'main_slider', array( $this, 'main_slider_callback' ) );
	}
	function main_slider_callback() {
		$post = get_theme_mod( 'slidertext','' );
		if ( $post ) {
			$images = get_post_meta( $post, 'bl_gallery_id', true );
			if ( ! empty( $images ) ) {
				echo '<div class="large-12 small-12 column">';
				echo '<section class="slider-for">';
				foreach ( $images as $image ) {
					$url = wp_get_attachment_url( $image, 'full' );
					echo '<div>';
					echo '<img src="' . esc_url( $url ) . '" class="header-post-slider"/>';
					echo '</div>';
				}

				echo '</section>';
				echo '</div>';

				echo '<div class="large-12 small-12 column">';
				echo '<section class="slider-nav">';
				foreach ( $images as $image ) {
					$url = wp_get_attachment_url( $image, 'full' );
					echo '<div>';
					echo '<img src="' . esc_url( $url ) . '" class="header-post-slider"/>';
					echo '</div>';
				}

			    echo '</section>';
				echo '</div>';
			}
		}
	}//end of function
}
new Post_Slide_Main_Action();
