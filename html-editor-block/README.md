# HTML Editor Block

A CodePen-like HTML/CSS/JS editor with live preview and shortcode support for WordPress.

## Features

- **Tabbed Interface**: Similar to CodePen, with separate tabs for HTML, CSS, JavaScript, and Preview
- **Live Preview**: Real-time rendering of your code in an isolated iframe
- **Shortcode Support**: WordPress shortcodes in HTML are automatically processed
- **Code Display**: Syntax-highlighted code display with dark theme
- **Responsive Design**: Mobile-friendly tabbed interface
- **Customizable Preview Height**: Control the preview area size
- **Custom CSS Classes**: Add custom classes to the block wrapper

## Usage

1. Add the "HTML Editor" block to your post or page
2. Enter your HTML code in the HTML field
3. Add CSS styling in the CSS field (without `<style>` tags)
4. Add JavaScript in the JS field (without `<script>` tags)
5. Toggle "Show Live Preview" to enable/disable the preview mode
6. Set the preview height (e.g., 400px, 50vh)
7. Optionally add custom CSS classes

## Block Fields

- **HTML Code**: Raw HTML input with shortcode support
- **CSS Code**: Styles for your HTML (scoped to the block)
- **JavaScript Code**: Scripts executed in the preview context
- **Show Live Preview**: Toggle to show/hide the preview
- **Preview Height**: Custom height for the preview iframe
- **Custom CSS Class**: Additional classes for styling

## How It Works

### In the Editor
- Displays a tabbed interface showing HTML, CSS, JS, and Preview tabs
- Code is displayed in a dark-themed code viewer
- Preview is rendered in an isolated iframe for safety

### On the Frontend
With preview enabled:
- Shows the same tabbed interface as in the editor
- Users can switch between viewing code and preview

Without preview:
- Renders the HTML directly with inline CSS and JS
- No tabs, just the final output

## Technical Details

### Files
- `block.json` - Block metadata and configuration
- `html-editor-block.php` - Block template with shortcode processing
- `html-editor-block.css` - Tabbed interface and preview styling
- `html-editor-block.js` - Tab switching and iframe preview generation
- `block-data.json` - ACF field group definition
- `extra.php` - Script registration and enqueuing

### Security
- HTML output uses `wp_kses_post()` for basic XSS protection
- CSS is sanitized with `wp_strip_all_tags()`
- JavaScript runs in an isolated iframe context in preview mode
- Frontend JS execution is wrapped in IIFE for scope isolation

### Shortcode Processing
WordPress shortcodes in the HTML field are processed using `do_shortcode()` before rendering, allowing you to use any registered shortcodes within your custom HTML.

## Example Usage

### Simple HTML/CSS Example

**HTML:**
```html
<div class="demo-box">
  <h2>Hello World</h2>
  <p>This is a demo box with custom styling.</p>
</div>
```

**CSS:**
```css
.demo-box {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 30px;
  border-radius: 10px;
  text-align: center;
}

.demo-box h2 {
  margin: 0 0 10px 0;
  font-size: 28px;
}
```

### Interactive JavaScript Example

**HTML:**
```html
<button id="clickMe">Click Me!</button>
<p id="output">Clicks: 0</p>
```

**CSS:**
```css
#clickMe {
  background: #3490dc;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

#clickMe:hover {
  background: #2779bd;
}

#output {
  margin-top: 15px;
  font-weight: bold;
}
```

**JavaScript:**
```javascript
let count = 0;
document.getElementById('clickMe').addEventListener('click', function() {
  count++;
  document.getElementById('output').textContent = 'Clicks: ' + count;
});
```

### Shortcode Example

**HTML:**
```html
<div class="shortcode-demo">
  <h3>Contact Form</h3>
  [contact-form-7 id="123" title="Contact form"]
</div>
```

The shortcode will be processed and rendered automatically.

## Browser Compatibility

- Modern browsers (Chrome, Firefox, Safari, Edge)
- IE11+ (with potential limitations on CSS Grid)

## Notes

- JavaScript runs in an isolated iframe in preview mode for security
- Code is not executed in the editor, only displayed
- Preview is generated on-demand when the Preview tab is clicked
- Changes to code require saving the post to persist
