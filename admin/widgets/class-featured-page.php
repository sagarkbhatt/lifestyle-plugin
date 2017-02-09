<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 9/2/17
	 * Time: 4:00 PM
	 */

/**
 * Adds Featured_Page class
 */

class Class_Featured_Page extends WP_Widget {

	/**
	 * Register widget with wordpress
	 */
	function __construct() {
		parent::__construct(
			'featured_page',
			esc_html( 'Featured page','blank-theme' ),
			array( 'description' => 'Shows page summary' )
		);
	}
	/**
	 * Back end form
	 */
	public function form( $instance ) {
		$pageid = ! empty( $instance['pageid'] ) ? $instance['pageid'] : '';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'pageid' ) ) . '"> ' . esc_attr( 'Select Page:', 'blank-theme' ) . '</label>';
		//echo '<input class="" id="' . esc_attr( $this->get_field_id( 'pageid' ) ) . '"  name="' . esc_attr( $this->get_field_name( 'pageid' ) ) . '"type="text" value="' . esc_attr( $pageid ) . '" />';
		echo '<select class="widefat" id="' . esc_attr( $this->get_field_id( 'pageid' ) ) . '"  name="' . esc_attr( $this->get_field_name( 'pageid' ) ) . '"></p>';
		$args_wp = array(
		'post_type' => 'page',
		'post_per_page' => -1,
		);
		$custom_query = new WP_Query( $args_wp );
		if ( $custom_query-> have_posts() ) {
			while ( $custom_query-> have_posts() ) {
				$custom_query->the_post();
				echo '<option value="' . get_the_id() . '"' . selected( $pageid, get_the_id() ) . '>' . get_the_title() . '</option>';
			}
		}
		wp_reset_postdata();
		echo '</select>';
	}
	/**
	 * front end display of widget
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$instance['pageid'] = ! empty( $instance['pageid'] ) ? $instance['pageid'] : '';
		$args_wp = array(
		'post_type' => 'page',
		'page_id' => $instance['pageid'],
		);
		$custom_query = new WP_Query( $args_wp );
		if ( $custom_query-> have_posts() ) {
			while ( $custom_query-> have_posts() ) {
				$custom_query-> the_post();
				echo '<p class="footer-title">' . strtoupper( get_the_title() ) . '</p>';
				echo '<div class="line"></div>';
				$url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' );
				echo '<p class="footer-text">' . wp_html_excerpt( get_the_content(), 80, '&hellip;' ) . '</p>';
				if ( has_post_thumbnail() ) {
					echo '<img src= "' . $url . '" class="cs-widget-img" />';
				}
				echo '<a href="' . get_the_permalink() . '" class="cs-widget-btn">Continue Reading on ' . get_the_title() . '</a>';
			}
		}
		wp_reset_postdata();

		echo $args['after_widget'];

	}
	/**
	 * Update form
	 *
	 * @$new_instance string gives modified value
	 *
	 * @$old_instance string gives prev value
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['pageid'] = ( ! empty( $new_instance['pageid'] ) ) ? $new_instance['pageid'] : '';
		return $instance;
	}

}
// register featured widget
function register_featured_widget() {
	register_widget( 'Class_Featured_Page' );
}
add_action( 'widgets_init', 'register_featured_widget' );
