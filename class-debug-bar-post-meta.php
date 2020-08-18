<?php
/**
 * Footer
 *
 * Main footer file for the theme.
 *
 * @package Debug_Bar_Post_Meta
 */

/**
 * Debug Bar Post Meta
 *
 * Add information from post meta to the debug bar.
 */
class Debug_Bar_Post_Meta extends Debug_Bar_Panel {

	/**
	 * Kick off the class.
	 */
	public function init() {
		$this->title( 'Post Meta' );
		$this->enqueue();
	}

	/**
	 * Render the panel
	 */
	public function render() {
		global $wp_query;

		if ( ! empty( $wp_query->posts ) ) {

			// Get post meta form all posts.
			$output = "<div class='template-trace' id='debug-bar-post-meta'>";
			foreach ( $wp_query->posts as $single_post ) {
				$output .= "<h3 style=''>" . $single_post->post_title . '</h3>';
				$metas   = get_post_meta( $single_post->ID );
				$output .= '<table>';
				foreach ( $metas as $key => $values ) {
					$output .= '<tr>';
					$output .= '<td>' . $key . '</td>';
					$vals    = '';
					foreach ( $values as $value ) :
						if ( ( is_serialized( $value ) ) !== false ) {
							$vals .= print_r( unserialize( $value ), true ); // phpcs:ignore
						} else {
							$vals .= print_r( $value, true ); // phpcs:ignore
						}
					endforeach;

					$output .= '<td><pre><code>' . esc_attr( $vals ) . '</code></pre></td>';
					$output .= '</tr>';
				}
				$output .= '</table>';
			}
			$output .= '</div>';
		} else {
			$output = 'Their are no post/page meta for this url';
		}
		echo wp_kses_post( $output );
	}


	/**
	 * Add the custom CSS
	 */
	public function enqueue() {
		wp_enqueue_style( 'debug-bar-post-meta-css', plugins_url( 'css/debug-bar-post-meta.css', __FILE__ ), array(), '0.5.7' );
	}
}
