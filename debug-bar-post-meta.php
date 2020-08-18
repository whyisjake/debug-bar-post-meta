<?php
/**
 * Debug Bar Post Meta
 *
 * Add debug information from post meta to the Debug Bar
 *
 * @package Debug_Bar_Post_Meta
 * @version 0.5.7
 */

/*
Plugin Name: Debug Bar Post Meta
Plugin URI: http://wordpress.org/extend/plugins/debug-bar-template-trace/
Description: Displays all of the post meta for a post.
Author: whyisjake
Version: 0.5.7
Author URI: http://www.jakespurlock.com/
*/


add_action( 'debug_bar_panels', 'debug_bar_post_meta' );

/**
 * Add Debug Bar Post Meta to the Debug Bar
 *
 * @param string $panels Each WordPress panel.
 */
function debug_bar_post_meta( $panels ) {
	require_once 'class-debug-bar-post-meta.php';
	$panels[] = new Debug_Bar_Post_Meta();
	return $panels;
}
