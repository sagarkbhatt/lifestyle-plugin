<?php
/**
 * Adds required js & css
 */
function ga_enqueue_script() {
	wp_enqueue_style( 'gallery-metabox', LIFESTYLE_HOME_URL . '/assets/gallery/css/gallery-metabox.css' );
	wp_enqueue_script( 'gallery-metabox', LIFESTYLE_HOME_URL . '/assets/gallery/js/gallery-metabox.js', array( 'jquery' ) );
}
add_action( 'admin_enqueue_scripts', 'ga_enqueue_script' );
function add_ga_meta_box( $post ) {
	$type = array( 'slider' );
	if ( in_array( $post, $type ) ) {
		add_meta_box(
			'ga_meta_box',
			'Gallery',
			'gallery_meta_callback',
			$post
		);
	}
}
add_action( 'add_meta_boxes', 'add_ga_meta_box' );

function gallery_meta_callback( $post ) {
	wp_nonce_field( 'gallery_nonce', 'gallery_meta_nonce' );
	$ids = maybe_unserialize( get_slider_meta( $post->ID, 'bl_gallery_id', true ) );
	?>
	<table class="form-table" id="gallery-metabox">
		<tr>
			<td>
			<a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Add image(s)</a>

			<ul id="gallery-metabox-list">
			<?php
			if ( $ids ) :
				foreach ( $ids as $key => $value ) :
					$image = wp_get_attachment_image_src( $value );
			?>

			<li>
			<input type="hidden" name="bl_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
			<img class="image-preview" src="<?php echo $image[0]; ?>">
			<a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
			<small><a class="remove-image" href="#">Remove image</a></small>
			</li>

		<?php
		    endforeach;
		endif;
		?>
		</ul>

	  </td></tr>
	</table>
<?php
}

function ga_save_meta( $post_id ) {
	if ( ! isset( $_POST['gallery_meta_nonce'] ) || ! wp_verify_nonce( $_POST['gallery_meta_nonce'], 'gallery_nonce' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['bl_gallery_id'] ) ) {
		update_slider_meta( $post_id, 'bl_gallery_id', $_POST['bl_gallery_id'] );
		//print_r( $_POST['bl_gallery_id'] );
	} else {
		delete_slider_meta( $post_id, 'bl_gallery_id' );
	}

}
add_action( 'save_post','ga_save_meta' );

