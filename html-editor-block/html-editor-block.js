/**
 * HTML Editor Block JavaScript
 * Handles tab switching and live preview generation
 */

(function() {
	'use strict';

	/**
	 * Initialize HTML Editor Block
	 * @param {HTMLElement} block - The block element
	 */
	function initHtmlEditorBlock(block) {
		const blockId = block.id;
		const tabButtons = block.querySelectorAll('.html-editor-block__tab-button');
		const tabContents = block.querySelectorAll('.html-editor-block__tab-content');
		const previewIframe = block.querySelector('.html-editor-block__preview-iframe');
		const dataScript = document.querySelector(`script[data-html-editor-data="${blockId}"]`);

		// Tab switching functionality
		tabButtons.forEach(function(button) {
			button.addEventListener('click', function() {
				const targetTab = this.getAttribute('data-tab');

				// Remove active class from all buttons and contents
				tabButtons.forEach(function(btn) {
					btn.classList.remove('active');
				});
				tabContents.forEach(function(content) {
					content.classList.remove('active');
				});

				// Add active class to clicked button and corresponding content
				this.classList.add('active');
				const targetContent = block.querySelector(`[data-tab-content="${targetTab}"]`);
				if (targetContent) {
					targetContent.classList.add('active');
				}

				// If preview tab is activated, generate the preview
				if (targetTab === 'preview' && previewIframe && dataScript) {
					generatePreview(previewIframe, dataScript);
				}
			});
		});

		// Generate initial preview if preview tab exists
		if (previewIframe && dataScript) {
			// Generate preview immediately if preview tab is active
			const previewTab = block.querySelector('[data-tab-content="preview"]');
			if (previewTab && previewTab.classList.contains('active')) {
				generatePreview(previewIframe, dataScript);
			}
		}
	}

	/**
	 * Generate live preview in iframe
	 * @param {HTMLIFrameElement} iframe - The preview iframe
	 * @param {HTMLScriptElement} dataScript - Script containing the code data
	 */
	function generatePreview(iframe, dataScript) {
		try {
			// Parse the JSON data
			const data = JSON.parse(dataScript.textContent);
			const html = data.html || '';
			const css = data.css || '';
			const js = data.js || '';

			// Create the preview HTML document
			const previewDoc = `
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body {
			padding: 20px;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
			line-height: 1.6;
		}
		${css}
	</style>
</head>
<body>
	${html}
	<script>
		(function() {
			try {
				${js}
			} catch (error) {
				console.error('Preview JavaScript error:', error);
			}
		})();
	</script>
</body>
</html>`;

			// Write to iframe
			const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
			iframeDoc.open();
			iframeDoc.write(previewDoc);
			iframeDoc.close();

			// Mark preview as loaded
			const previewWrapper = iframe.closest('.html-editor-block__preview-wrapper');
			if (previewWrapper) {
				previewWrapper.classList.add('loaded');
			}

		} catch (error) {
			console.error('Error generating preview:', error);

			// Show error in iframe
			const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
			iframeDoc.open();
			iframeDoc.write(`
<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
			margin: 0;
			font-family: sans-serif;
			color: #c00;
			padding: 20px;
			text-align: center;
		}
	</style>
</head>
<body>
	<div>
		<h3>Preview Error</h3>
		<p>Unable to generate preview. Please check your code for errors.</p>
	</div>
</body>
</html>`);
			iframeDoc.close();
		}
	}

	/**
	 * Initialize all HTML Editor blocks on the page
	 */
	function initAllBlocks() {
		const blocks = document.querySelectorAll('.html-editor-block');
		blocks.forEach(function(block) {
			// Check if already initialized
			if (!block.hasAttribute('data-initialized')) {
				initHtmlEditorBlock(block);
				block.setAttribute('data-initialized', 'true');
			}
		});
	}

	// Initialize on DOM ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initAllBlocks);
	} else {
		initAllBlocks();
	}

	// Re-initialize when new blocks are added (for block editor)
	if (typeof wp !== 'undefined' && wp.data && wp.data.subscribe) {
		let previousBlockCount = 0;

		wp.data.subscribe(function() {
			const blocks = document.querySelectorAll('.html-editor-block');
			if (blocks.length !== previousBlockCount) {
				previousBlockCount = blocks.length;
				// Small delay to ensure DOM is ready
				setTimeout(initAllBlocks, 100);
			}
		});
	}

	// Also listen for ACF changes in the editor
	if (typeof acf !== 'undefined') {
		acf.addAction('render_block_preview', function() {
			setTimeout(initAllBlocks, 100);
		});
	}

	// Expose initialization function globally for manual use if needed
	window.initHtmlEditorBlock = initHtmlEditorBlock;
	window.initAllHtmlEditorBlocks = initAllBlocks;

})();
