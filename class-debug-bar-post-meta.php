<?php

class Debug_Bar_Post_Meta extends Debug_Bar_Panel {
	function init() {
		$this->title( __( 'Post Meta', 'debug-bar' ) );
	}

	function render() {
		$output = "<div id='template-trace'>";
		$output .= "<h3>Post Meta</h3>";
		$metas = get_post_meta( get_the_ID() );
		$output .= '<table>';
		foreach ( $metas as $key => $values ) {
			$output .= '<tr>';
			$output .= '<td>' . $key . '</td>';
			$vals = '';
			foreach ( $values as $value ) {
				if ( ( is_serialized( $value ) )  !== false ) {
					$vals .= print_r( unserialize( $value ), true );
				} else {
					$vals .= print_r( $value, true ) . "\n";
				}

			}
			$output .= '<td><pre><code>' . esc_attr ( $vals ) . '</code></pre></td>';
			$output .= '</tr>';
		}
		$output .= '</table>';
		$output .= "</div>";
		echo $output;
	}
}

?>
