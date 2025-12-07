<?php
/**
 * HTML Editor Block - Extra functionality
 * Registers scripts and additional functionality for the HTML Editor block
 */

if ( ! function_exists( 'md_html_editor_register_assets' ) ) {
	/**
	 * Register HTML Editor Block scripts
	 */
	function md_html_editor_register_assets() {
		$dir = trailingslashit( get_stylesheet_directory() ) . 'blocks/html-editor-block/';
		$uri = trailingslashit( get_stylesheet_directory_uri() ) . 'blocks/html-editor-block/';

		// Register and enqueue the block JavaScript
		if ( file_exists( $dir . 'html-editor-block.js' ) ) {
			wp_register_script(
				'md-html-editor-block',
				$uri . 'html-editor-block.js',
				array(),
				filemtime( $dir . 'html-editor-block.js' ),
				true
			);

			// Enqueue the script on both frontend and backend
			wp_enqueue_script( 'md-html-editor-block' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'md_html_editor_register_assets' );
	add_action( 'enqueue_block_editor_assets', 'md_html_editor_register_assets' );
}
