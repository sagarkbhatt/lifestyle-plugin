<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 10/2/17
	 * Time: 12:23 PM
	 */

/*
 * Adds Social_Icon class
 */
class Class_Social_Icon extends WP_Widget {
	function __construct() {
		parent::__construct(
			'social_icon',
			esc_html( 'Social icon', 'blank-theme' ),
			array( 'description' => 'Shows social icons' )
		);
	}
	/*
	 * Function to display back end
	 * tw for twitter , fb for facebook ,tu for tumbler
	 */
	public function form( $instance ) {
		$social_tw = ! empty( $instance['tw'] ) ? $instance['tw'] : '';
		$social_tu = ! empty( $instance['tu'] ) ? $instance['tu'] : '';
		$social_fb = ! empty( $instance['fb'] ) ? $instance['fb'] : '';
		$social_gp = ! empty( $instance['gp'] ) ? $instance['gp'] : '';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'tw' ) ) . '">' . esc_attr( 'Twitter Link: ', 'blank-theme' ) . '</label>';
		echo '<input type="text" id="' . esc_attr( $this->get_field_id( 'tw' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tw' ) ) . '" value="' . $social_tw . '" class="widefat"/></p>';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'tu' ) ) . '">' . esc_attr( 'Tumbler Link: ', 'blank-theme' ) . '</label>';
		echo '<input type="text" id="' . esc_attr( $this->get_field_id( 'tu' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tu' ) ) . '" value="' . $social_tu . '" class="widefat"/></p>';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'fb' ) ) . '">' . esc_attr( 'Facebook Link: ', 'blank-theme' ) . '</label>';
		echo '<input type="text" id="' . esc_attr( $this->get_field_id( 'fb' ) ) . '" name="' . esc_attr( $this->get_field_name( 'fb' ) ) . '" value="' . $social_fb . '" class="widefat"/></p>';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'gp' ) ) . '">' . esc_attr( 'Google+ Link: ', 'blank-theme' ) . '</label>';
		echo '<input type="text" id="' . esc_attr( $this->get_field_id( 'gp' ) ) . '" name="' . esc_attr( $this->get_field_name( 'gp' ) ) . '" value="' . $social_gp . '" class="widefat"/></p>';
	}
	/*
	 * Function to display front end
	 *
	 */
	public function widget( $args, $instance ) {
		 echo $args['before_widget'];
		 echo '<p class = "cs-widget-title" >SOCIAL MEDIA</p>';
		 echo '<div class="line"></div>';
		 echo '<div class="icon-boarder widget-icon">';
		 echo '<a href="' . $instance['tw'] . '"><i class="fa icon-twitter"></i></a>';
		 echo '<a href="' . $instance['fb'] . '"><i class="fa icon-facebook"></i></a>';
		 echo '<a href="' . $instance['tu'] . '"><i class="fa icon-tumblr"></i></a>';
		 echo '<a href="' . $instance['gp'] . '"><i class="fa icon-gplus"></i></a>';
		 echo '</div>';
		 echo $args['after_widget'];
	}
	/*
	 * Function to update data
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['tw'] = ( ! empty( $new_instance['tw'] ) ) ? $new_instance['tw'] : '';
		$instance['tu'] = ( ! empty( $new_instance['tu'] ) ) ? $new_instance['tu'] : '';
		$instance['fb'] = ( ! empty( $new_instance['fb'] ) ) ? $new_instance['fb'] : '';
		$instance['gp'] = ( ! empty( $new_instance['gp'] ) ) ? $new_instance['gp'] : '';
		return $instance;
	}
}
// register social_icon widget
function register_social_icon_widget() {
	register_widget( 'Class_Social_Icon' );
}
add_action( 'widgets_init', 'register_social_icon_widget' );

function font_style_add() {
	wp_enqueue_style( 'fontello',LIFESTYLE_HOME_URL . '/assets/fontello/css/fontello.css' );
}
add_action( 'wp_enqueue_scripts','font_style_add' );
