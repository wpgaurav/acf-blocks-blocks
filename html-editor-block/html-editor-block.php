<?php
/**
 * HTML Editor Block Template.
 *
 * A CodePen-like HTML/CSS/JS editor with live preview and shortcode support.
 *
 * @param array $block Block settings and attributes
 * @param string $content Inner HTML (usually empty)
 * @param bool $is_preview True during AJAX preview
 * @param int|string $post_id The post ID
 */

// Retrieve fields
$html_code = get_field( 'acf_html_editor_html_code' );
$css_code = get_field( 'acf_html_editor_css_code' );
$js_code = get_field( 'acf_html_editor_js_code' );
$show_preview = get_field( 'acf_html_editor_show_preview' );
$preview_height = get_field( 'acf_html_editor_preview_height' );
$custom_class = get_field( 'acf_html_editor_custom_class' );

// Generate unique ID for this block instance
$block_id = 'html-editor-' . uniqid();

// Set default preview height if not provided
if ( empty( $preview_height ) ) {
	$preview_height = '400px';
}

// Process shortcodes in HTML
$processed_html = do_shortcode( $html_code );

// In the editor, show the tabbed interface
if ( $is_preview ) {
	?>
	<div class="html-editor-block html-editor-block--editor <?php echo esc_attr( $custom_class ); ?>" id="<?php echo esc_attr( $block_id ); ?>">
		<div class="html-editor-block__tabs">
			<div class="html-editor-block__tab-nav">
				<button class="html-editor-block__tab-button active" data-tab="html">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M5.5 3.5L2 8l3.5 4.5m5-9L14 8l-3.5 4.5M9 2L7 14"/>
					</svg>
					HTML
				</button>
				<button class="html-editor-block__tab-button" data-tab="css">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M2 2h12v12H2V2zm2 2v8h8V4H4z"/>
					</svg>
					CSS
				</button>
				<button class="html-editor-block__tab-button" data-tab="js">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M8 2C4.7 2 2 4.7 2 8s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"/>
					</svg>
					JS
				</button>
				<?php if ( $show_preview ) : ?>
				<button class="html-editor-block__tab-button" data-tab="preview">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M8 3C4.5 3 1.5 5.5 0 8c1.5 2.5 4.5 5 8 5s6.5-2.5 8-5c-1.5-2.5-4.5-5-8-5zm0 8c-1.7 0-3-1.3-3-3s1.3-3 3-3 3 1.3 3 3-1.3 3-3 3zm0-5c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
					</svg>
					Preview
				</button>
				<?php endif; ?>
			</div>

			<div class="html-editor-block__tab-content active" data-tab-content="html">
				<div class="html-editor-block__code-display">
					<pre><code class="language-html"><?php echo esc_html( $html_code ); ?></code></pre>
				</div>
			</div>

			<div class="html-editor-block__tab-content" data-tab-content="css">
				<div class="html-editor-block__code-display">
					<pre><code class="language-css"><?php echo esc_html( $css_code ); ?></code></pre>
				</div>
			</div>

			<div class="html-editor-block__tab-content" data-tab-content="js">
				<div class="html-editor-block__code-display">
					<pre><code class="language-javascript"><?php echo esc_html( $js_code ); ?></code></pre>
				</div>
			</div>

			<?php if ( $show_preview ) : ?>
			<div class="html-editor-block__tab-content" data-tab-content="preview">
				<div class="html-editor-block__preview-wrapper" style="height: <?php echo esc_attr( $preview_height ); ?>;">
					<iframe class="html-editor-block__preview-iframe" data-preview-id="<?php echo esc_attr( $block_id ); ?>"></iframe>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<!-- Store the code for preview generation -->
		<script type="application/json" data-html-editor-data="<?php echo esc_attr( $block_id ); ?>">
		{
			"html": <?php echo wp_json_encode( $processed_html ); ?>,
			"css": <?php echo wp_json_encode( $css_code ); ?>,
			"js": <?php echo wp_json_encode( $js_code ); ?>
		}
		</script>
	</div>
	<?php
} else {
	// On the frontend, render the output directly
	?>
	<div class="html-editor-block html-editor-block--frontend <?php echo esc_attr( $custom_class ); ?>" id="<?php echo esc_attr( $block_id ); ?>">
		<?php if ( $show_preview ) : ?>
		<div class="html-editor-block__tabs">
			<div class="html-editor-block__tab-nav">
				<button class="html-editor-block__tab-button active" data-tab="html">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M5.5 3.5L2 8l3.5 4.5m5-9L14 8l-3.5 4.5M9 2L7 14"/>
					</svg>
					HTML
				</button>
				<button class="html-editor-block__tab-button" data-tab="css">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M2 2h12v12H2V2zm2 2v8h8V4H4z"/>
					</svg>
					CSS
				</button>
				<button class="html-editor-block__tab-button" data-tab="js">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M8 2C4.7 2 2 4.7 2 8s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"/>
					</svg>
					JS
				</button>
				<button class="html-editor-block__tab-button" data-tab="preview">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
						<path d="M8 3C4.5 3 1.5 5.5 0 8c1.5 2.5 4.5 5 8 5s6.5-2.5 8-5c-1.5-2.5-4.5-5-8-5zm0 8c-1.7 0-3-1.3-3-3s1.3-3 3-3 3 1.3 3 3-1.3 3-3 3zm0-5c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
					</svg>
					Preview
				</button>
			</div>

			<div class="html-editor-block__tab-content active" data-tab-content="html">
				<div class="html-editor-block__code-display">
					<pre><code class="language-html"><?php echo esc_html( $html_code ); ?></code></pre>
				</div>
			</div>

			<div class="html-editor-block__tab-content" data-tab-content="css">
				<div class="html-editor-block__code-display">
					<pre><code class="language-css"><?php echo esc_html( $css_code ); ?></code></pre>
				</div>
			</div>

			<div class="html-editor-block__tab-content" data-tab-content="js">
				<div class="html-editor-block__code-display">
					<pre><code class="language-javascript"><?php echo esc_html( $js_code ); ?></code></pre>
				</div>
			</div>

			<div class="html-editor-block__tab-content" data-tab-content="preview">
				<div class="html-editor-block__preview-wrapper" style="height: <?php echo esc_attr( $preview_height ); ?>;">
					<iframe class="html-editor-block__preview-iframe" data-preview-id="<?php echo esc_attr( $block_id ); ?>"></iframe>
				</div>
			</div>

			<!-- Store the code for preview generation -->
			<script type="application/json" data-html-editor-data="<?php echo esc_attr( $block_id ); ?>">
			{
				"html": <?php echo wp_json_encode( $processed_html ); ?>,
				"css": <?php echo wp_json_encode( $css_code ); ?>,
				"js": <?php echo wp_json_encode( $js_code ); ?>
			}
			</script>
		</div>
		<?php else : ?>
		<!-- No preview mode - render directly with inline CSS and JS -->
		<div class="html-editor-block__output">
			<?php if ( ! empty( $css_code ) ) : ?>
			<style>
				#<?php echo esc_attr( $block_id ); ?> .html-editor-block__output {
					<?php echo wp_strip_all_tags( $css_code ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				}
			</style>
			<?php endif; ?>

			<div class="html-editor-block__content">
				<?php
				// Output the processed HTML (shortcodes already processed)
				// Use wp_kses_post for basic safety, but allow most HTML
				echo wp_kses_post( $processed_html );
				?>
			</div>

			<?php if ( ! empty( $js_code ) ) : ?>
			<script>
				(function() {
					<?php echo $js_code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				})();
			</script>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php
}
