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
		add_shortcode( 'main_slider', array( $this, 'main_slider_shortcode_callback' ) );
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
	function main_slider_shortcode_callback( $atts, $content, $tag ) {
		ob_start();
		$post = '';
		$a = shortcode_atts( array(
			'id' => '',
			'slug' => '',
		), $atts );
		if ( isset( $a['id'] ) ) {
			$post = $a['id'];
		}
		if ( isset( $a['slug'] ) ) {
			$page = get_page_by_path( $a['slug'], OBJECT, 'slider' );
			if ( isset( $page->ID ) ) {
				$post = $page->ID;
			}
		}

		if ( $post ) {
			$this->display_post_main_slider( $post );

		} else {
			//Code for when no arguement is passed to shortcode
			//show all slider
			add_thickbox();
			$args = array(
				'post_type'     => 'slider',
				'post_per_page' => -1,
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				echo '<div class="thick-container">';
				while ( $query->have_posts() ) {
					$query->the_post();
					if ( has_post_thumbnail() ) {
						echo '<div id="' . get_the_ID() . '" style="display:none">';
						$this->display_post_main_slider_single( get_the_ID() );
						echo '</div>';
						$url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' );
						echo '<a href="#TB_inline?width=600&height=550&inlineId=' . get_the_ID() . '" class="thickbox custom-thickbox"><img src= "' . $url . '" class="inline-image" /></a>';
					}
				}
				echo '</div>';
			}
		}
		return ob_get_clean();
	}
	function display_post_main_slider( $post ) {
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

	function display_post_main_slider_single( $post ) {
		$images = get_post_meta( $post, 'bl_gallery_id', true );
		if ( ! empty( $images ) ) {

			echo '<section class="single-item">';
			foreach ( $images as $image ) {
				$url = wp_get_attachment_url( $image, 'full' );
				echo '<div>';
				echo '<img src="' . esc_url( $url ) . '" class="thick-image"/>';
				echo '</div>';
			}
			echo '</section>';


		} else {
			echo '<p>No images are available</p>';
		}
	}
}
new Post_Slide_Main_Action();
