<?php

class Post_Slider {

	function __construct() {
		add_action( 'init',array( $this, 'custom_post_slider' ), 10 );
	}

	//Creats custom post type

	function custom_post_slider() {
		$labels = array(
			'name' 			=> _x( 'Slides', 'images', 'blank-theme' ),
			'singular_name' => _x( 'Slide', 'image', 'blank-theme' ),
			'add_new' 		=> __( 'Add to slider', 'blank-theme' ),
			'add_new_item'	=> __( 'Add post to slider', 'blank-theme' ),
			'edit_itme' 	=> __( 'Edit slide', 'blank-theme' ),
			'new_item' 		=> __( 'New slide', 'blank-theme' ),
			'all_item' 		=> __( 'All slide', 'blank-theme' ),
			'view_item' 	=> __( 'View slide', 'blank-theme' ),
			'search_item'	=> __( 'Search slide', 'blank-theme' ),
			'menu_name'		=> 'Post Slider',
		);
		$args = array(
			'labels'		=> $labels,
			'description'	=> 'Photo slider will be displayed in widget',
			'public'		=> true,
			'supports'		=> array( 'title', 'thumbnail', 'excerpt' ),
			'has_archive'	=> true,
		);
		register_post_type( 'slider', $args );
	}

}
new Post_Slider();
