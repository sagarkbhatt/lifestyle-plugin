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
			$images = get_slider_meta( $post, 'bl_gallery_id', true );
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
		$post = null;
		$a = shortcode_atts( array(
			'id' => null,
			'slug' => null,
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

		if ( ! empty( $post ) ) {
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
						echo '<a href="#TB_inline?width=600&height=550&inlineId=' . get_the_ID() . '" class="thickbox custom-thickbox" data-post_id="' . get_the_ID() . '"><img src= "' . $url . '" class="inline-image" /></a>';
						//echo '<div clas="div-thickbox" data-post_id="' . get_the_ID() . '" ><a href=#TB_inline?width=600&height=550&inlineId=' . get_the_ID() . '" class="thickbox custom-thickbox" data-post_id="' . get_the_ID() . '"><img src= "' . $url . '" class="inline-image" /></a></div>';
					}
				}
				echo '</div>';
			}
		}
		return ob_get_clean();
	}
	function display_post_main_slider( $post ) {
		$images = get_slider_meta( $post, 'bl_gallery_id', true );
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
		$images = get_slider_meta( $post, 'bl_gallery_id', true );
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

add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue( $hook ) {

	if ( 'index.php' != $hook ) {
		// Only applies to dashboard panel
		return;
	}

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value

}

add_action( 'wp_ajax_add_thick_image', 'lf_ajax_thick_image' );
add_action( 'wp_ajax_nopriv_add_thick_image', 'lf_ajax_thick_image' );

function lf_ajax_thick_image() {
	$images = get_slider_meta( $_POST['data'], 'bl_gallery_id', true );
	ob_start();
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
	$temp = ob_get_clean();
	echo $temp;
	wp_die();
}
