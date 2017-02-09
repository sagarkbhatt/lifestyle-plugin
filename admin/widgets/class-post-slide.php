<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 9/2/17
	 * Time: 2:43 PM
	 */



//Creates Posts_Slide class
class Posts_Slide extends WP_Widget {
	function __construct() {
		parent::__construct(
			'post_slide',
			esc_html__( 'Post slide', 'blank-theme' ),
			array( 'description' => 'Shows post slider in widget' )
		);
	}
	/*
	 * Function to display back-end
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ' ';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : '';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '" >' . esc_attr( 'Enter title', 'blank-theme' ) . '</label>';
		echo '<input type="text" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . $title . '" class="widefat"/></p>';
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'count' ) ) . '" >' . esc_attr( 'No of Slides', 'blank-theme' ) . '</label>';
		echo '<input type="text" id="' . esc_attr( $this->get_field_id( 'count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'count' ) ) . '" value="' . $count . '" class="widefat"/></p>';

	}
	/*
	 * Function to dispay front end
	 */
	public function widget( $args, $instance ) {

		$args_wp = array(
			'post_type'	=> 'slider',
			'post_per_page'	=> $instance['count'],
		);
		$custom_query = new WP_Query( $args_wp );
		if ( $custom_query->have_posts() ) {
			echo $args['before_widget'];
			echo '<p class="cs-widget-title">' . strtoupper( $instance['title'] ) . '</p>';
			echo '<div class="line"></div>';
			echo '<section class="center single-item">';
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' );
					echo '<div>';
					echo '<img src= "' . $url . '" class="cs-widget-post-slider" />';
					echo '</div>';
				}
			}
			echo '</section>';
			wp_reset_postdata();
			echo $args['after_widget'];
		}

	}
	/**
	 * update form
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? $new_instance['count'] : '';
		return $instance;
	}
}
// register photo_slider
function register_photo_slider() {
	register_widget( 'Posts_Slide' );
}
add_action( 'widgets_init', 'register_photo_slider' );
