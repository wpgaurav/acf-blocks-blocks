<?php
/**
 * Dynamically load all ACF block registration files
 */
function load_acf_blocks() {
    // Check if ACF Pro is active
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // Get the blocks directory path
    $blocks_dir = get_stylesheet_directory() . '/blocks/';
    
    // Get all subdirectories in the blocks directory
    $block_folders = array_filter(glob($blocks_dir . '*'), 'is_dir');
    
    // Loop through each block folder
    foreach ($block_folders as $block_folder) {
        $block_file = $block_folder . '/block.php';
        
        // If a block.php file exists in this folder, include it
        if (file_exists($block_file)) {
            require_once $block_file;
        }
    }
}
add_action('acf/init', 'load_acf_blocks', 5);
