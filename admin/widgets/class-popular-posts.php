<?php
	/**
	 * Created by PhpStorm.
	 * User: rtcamp
	 * Date: 8/2/17
	 * Time: 5:00 PM
	 */
	/*
	 * Add Popular_Post class
	 */
class Class_Popular_Post extends WP_Widget {

	function __construct() {
		 parent::__construct(
			 'popular_post',
			 esc_html( 'Popular post' ),
			 array( 'description' => 'Shows popular posts' )
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
		echo '<p><label for="' . esc_attr( $this->get_field_id( 'count' ) ) . '" >' . esc_attr( 'Post to display', 'blank-theme' ) . '</label>';
		echo '<input type="text" id="' . esc_attr( $this->get_field_id( 'count' ) ) . '" name="' . esc_attr( $this->get_field_name( 'count' ) ) . '" value="' . $count . '" class="widefat"/></p>';
	}
	/*
	 * Function to display front end
	 */
	public function widget( $args, $instance ) {
		$instance['title']  = ! empty( $instance['title'] ) ? $instance['title'] : ' ';
		$instance['count']  = ! empty( $instance['count'] ) ? $instance['count'] : '';
		echo $args['before_widget'];
		$args_wp = array(
			'post_type' => 'post',
			'post_per_page' => $instance['count'],
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			);
		$custom_query = new WP_Query( $args_wp );

		if ( $custom_query->have_posts() ) {
			echo '<p class="cs-widget-title">' . strtoupper( $instance['title'] ) . '</p>';
			echo '<div class="line"></div>';
			while ( $custom_query-> have_posts() ) {
				$custom_query->the_post();
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' );
					echo '<img src= "' . $url . '" class="cs-widget-img-small" />';
					echo '<a href="' . get_the_permalink() . '"><p class="cs-widget-p">' . get_the_title() . '<p class="cs-widget-ps">' . get_the_date() . '</p></p></a>';
				}
			}
		}
		wp_reset_postdata();
		echo $args['after_widget'];
	}
	/*
	 * update form
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? $new_instance['count'] : '';
		return $instance;
	}
}

// register popular_post widget
function register_popular_post_widget() {
	register_widget( 'Class_Popular_Post' );
}
add_action( 'widgets_init', 'register_popular_post_widget' );

/*
 * Function to count views of post
 */
function count_views( $postid ) {

	$meta_key = 'post_views_count';
	$count    = get_post_meta( $postid, $meta_key, true );
	if ( '' == $count ) {
		$count = 0;
		delete_post_meta( $postid, $meta_key );
		add_post_meta( $postid, $meta_key, '0' );

		return $count;
	} else {
		$count ++;
		update_post_meta( $postid, $meta_key, $count );

		return $count;
	}

}
function get_count_views() {
	if ( is_singular() ) {
		global $post;
		$views = count_views( $post->ID );
	}
}
add_action( 'wp_head', 'get_count_views' );
