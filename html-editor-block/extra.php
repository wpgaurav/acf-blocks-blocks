<?php
/**
 * HTML Editor Block - Extra functionality
 * Registers scripts and additional functionality for the HTML Editor block
 */

/**
 * Register HTML Editor Block scripts
 */
function md_html_editor_register_assets() {
	$block_path = plugin_dir_path( __FILE__ );
	$block_url = plugin_dir_url( __FILE__ );

	// Register the block JavaScript
	wp_register_script(
		'md-html-editor-block',
		$block_url . 'html-editor-block.js',
		array(),
		filemtime( $block_path . 'html-editor-block.js' ),
		true
	);

	// Enqueue the script on both frontend and backend
	wp_enqueue_script( 'md-html-editor-block' );
}
add_action( 'wp_enqueue_scripts', 'md_html_editor_register_assets' );
add_action( 'enqueue_block_editor_assets', 'md_html_editor_register_assets' );
