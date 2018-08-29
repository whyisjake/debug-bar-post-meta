<?php
/**
 * Debug Bar Post Meta
 *
 * @package debug-bar-post-meta
 */

/**
 * Debug Bar Post Meta
 */
class Debug_Bar_Post_Meta extends Debug_Bar_Panel {

	/**
	 * Used the for the enqueue method.
	 *
	 * @var string
	 */
	private $version = '0.5.5';

	/**
	 * Kick off the panel.
	 *
	 * @return void
	 */
	public function init() {
		$this->title( 'Post Meta' );
		$this->enqueue();
	}

	/**
	 * Render the panel
	 *
	 * @return void
	 */
	public function render() {
		global $wp_query;

		$screen = get_current_screen();

		// We might not have post a post here, so let's get the GET var, and bring the post in.
		if ( 'edit.php' === $screen->parent_file && null === $wp_query->posts ) {
			$wp_query->posts = ( ! empty( $_GET['post'] ) ) ? [ get_post( intval( $_GET['post'] ) ) ] : 0;
		}

		if ( ! empty( $wp_query->posts ) ) {
			// Get post meta form all posts.
			$output = "<div class='template-trace' id='debug-bar-post-meta'>";
			foreach ( $wp_query->posts as $single_post ) {
				$output .= sprintf( '<h3>%s</h3>', esc_html( $single_post->post_title ) );
				$metas   = get_post_meta( $single_post->ID );
				$output .= '<table>';
				foreach ( $metas as $key => $values ) {
					$output .= '<tr>';
					$output .= '<td>' . $key . '</td>';
					$vals    = '';
					foreach ( $values as $value ) {
						if ( ( is_serialized( $value ) ) !== false ) {
							$vals .= print_r( unserialize( $value ), true );
						} else {
							$vals .= print_r( $value, true );
						}
					};

					$output .= sprintf( '<td><pre><code>%s</code></pre></td>', htmlentities( $vals ) );
					$output .= '</tr>';
				}
				$output .= '</table>';
			}
			$output .= '</div>';
		} else {
			$output = 'There is no post/page meta for this url';
		}
		echo wp_kses_post( $output );
	}

	/**
	 * Enquueueue the css.
	 *
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_style( 'debug-bar-post-meta-css', plugins_url( 'css/debug-bar-post-meta.css', __FILE__ ), [], $this->version );
	}
}
