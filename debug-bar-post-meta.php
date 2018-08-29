<?php
/**
 * Debug Bar Post Meta
 *
 * @package debug-bar-post-meta
 */

/*
Plugin Name: Debug Bar Post Meta
Plugin URI: http://wordpress.org/extend/plugins/debug-bar-template-trace/
Description: Displays all of the post meta for a post.
Author: whyisjake
Version: 0.5.5
Author URI: http://www.jakespurlock.com/
 */

// Add the panel.
add_action( 'debug_bar_panels', 'debug_bar_post_meta' );

/**
 * Add post meta to the debug bar.
 *
 * @param  array $panels - All debug bar panels.
 * @return array
 */
function debug_bar_post_meta( $panels ) {
	require_once 'class-debug-bar-post-meta.php';
	$panels[] = new Debug_Bar_Post_Meta();
	return $panels;
}
