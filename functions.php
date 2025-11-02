<?php
/**
 * Load ACF blocks from block.json, auto-load per-block extra.php, with legacy PHP fallback.
 *
 * Folder structure (example):
 * /yourtheme/blocks/
 *   accordion-block/
 *     block.json
 *     accordion-block.php
 *     extra.php            <-- optional, autoloaded
 *     accordion.css
 *   legacy-block/
 *     block.php            <-- legacy fallback
 */

if ( ! function_exists( 'load_acf_blocks_from_json' ) ) {
    function load_acf_blocks_from_json() {
        // Require ACF to parse the "acf" keys in block.json (renderTemplate, blockVersion, etc)
        if ( ! class_exists( 'ACF' ) && ! function_exists( 'acf' ) ) {
            return;
        }

        // Allow overriding the blocks directory via filter if needed.
        $blocks_dir = apply_filters(
            'md/acf_blocks_dir',
            trailingslashit( get_stylesheet_directory() ) . 'blocks/'
        );

        if ( ! is_dir( $blocks_dir ) ) {
            return;
        }

        // Get immediate subdirectories
        $block_folders = glob( $blocks_dir . '*', GLOB_ONLYDIR );
        if ( ! $block_folders ) {
            return;
        }

        foreach ( $block_folders as $block_folder ) {
            $block_folder  = trailingslashit( $block_folder );
            $block_json    = $block_folder . 'block.json';
            $legacy_php    = $block_folder . 'block.php';
            $extra_php     = $block_folder . 'extra.php';

            if ( file_exists( $block_json ) && is_readable( $block_json ) ) {
                // Register via block.json metadata (WordPress + ACF handle the rest).
                $result = register_block_type( $block_folder );

                // Optional: basic error logging if registration fails.
                if ( is_wp_error( $result ) ) {
                    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                        error_log( sprintf(
                            '[ACF Blocks] Failed to register block in "%s": %s',
                            $block_folder,
                            $result->get_error_message()
                        ) );
                    }
                    continue; // Skip loading extra.php if registration failed.
                }

                // Autoload per-block extra.php if present — great for hooks, helpers, inline CSS systems, etc.
                if ( file_exists( $extra_php ) && is_readable( $extra_php ) ) {
                    require_once $extra_php;
                }
            } elseif ( file_exists( $legacy_php ) && is_readable( $legacy_php ) ) {
                // Fallback: include legacy PHP registration file.
                require_once $legacy_php;

                // Also autoload extra.php for legacy blocks if available.
                if ( file_exists( $extra_php ) && is_readable( $extra_php ) ) {
                    require_once $extra_php;
                }
            } else {
                // Nothing to load in this folder; optionally log in debug.
                if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                    error_log( sprintf(
                        '[ACF Blocks] Skipped "%s" (no block.json or legacy block.php found).',
                        $block_folder
                    ) );
                }
            }
        }
    }
}

// Use acf/init so ACF is fully loaded before reading "acf" keys from block.json.
add_action( 'acf/init', 'load_acf_blocks_from_json', 5 );