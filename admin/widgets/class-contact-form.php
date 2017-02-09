<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 9/2/17
	 * Time: 5:04 PM
	 */

/*
 * Footer widget
 */
class Class_Contact_Form extends WP_Widget {
	function __construct() {
		parent::__construct(
			'contact_form',
			esc_html( 'Contact Form', 'blank-theme' ),
			array( 'description' => 'Shows contact form' )
		);
	}
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ' ';
		$desc = ! empty( $instance['desc'] ) ? $instance['desc'] : ' ';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '" >' . esc_attr( 'Enter title', 'blank-theme' ) . '</label>';
		echo '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . $title . '" /></p>';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'desc' ) ) . '" >' . esc_attr( 'Enter description', 'blank-theme' ) . '</label>';
		echo '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'desc' ) ) . '" name="' . esc_attr( $this->get_field_name( 'desc' ) ) . '" value="' . $desc . '" /></p>';
	}
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo '<p class="footer-title">' . $instance['title'] . '</p>';
		echo '<div class="line"></div>';
		echo '<p class="footer-text">' . $instance['desc'] . '</p>';
		echo '<input type="text" class="cs-widget-text" placeholder="YOUR NAME" />';
		echo '<input type="text" class="cs-widget-text" placeholder="YOUR EMAIL ADDRESS"/>';
		echo '<a href="#" class="cs-widget-btn" >SUBSCRIBED NOW </a>';
		echo $args['after_widget'];
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? $new_instance['desc'] : '';
		return $instance;
	}
}
function register_contact_form() {
	register_widget( 'Class_Contact_Form' );
}
add_action( 'widgets_init', 'register_contact_form' );
