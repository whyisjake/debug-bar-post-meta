<?php

class Debug_Bar_Post_Meta extends Debug_Bar_Panel {
	function init() {
		$this->title( __( 'Post Meta', 'debug-bar' ) );
		$this->enqueue();
	}

	function render() {
		global $wp_query;

		if( !empty( $wp_query->posts ) ){ 
		// get post meta form all posts
			$output = "<div class='template-trace' id='debug-bar-post-meta'>";
			foreach( $wp_query->posts as $single_post ){
				$output .= "<h3 style=''>".$single_post->post_title."</h3>";
				$metas = get_post_meta( $single_post->ID );
				$output .= '<table>';
				foreach ( $metas as $key => $values ) {
					$output .= '<tr>';
					$output .= '<td>' . $key . '</td>';
					$vals='';
					foreach ( $values as $value ):
						if ( ( is_serialized( $value ) )  !== false ) {
							$vals .= print_r( unserialize( $value ), true );
						} else {
						$vals .= print_r( $value, true );
					}
					endforeach;

					$output .= '<td><pre><code>' . esc_attr( $vals ) . '</code></pre></td>';
					$output .= '</tr>';
				}
				$output .= '</table>';	
			}
			$output .= "</div>";
		}else{
			$output = "Their are no post/page meta for this url";
		}
		echo $output;
	}


	function enqueue() {
		wp_enqueue_style('debug-bar-post-meta-css',plugins_url('css/debug-bar-post-meta.css',__FILE__));
	}
}

?>