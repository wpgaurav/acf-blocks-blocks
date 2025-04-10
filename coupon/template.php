<?php
/**
 * Coupon Block Template.
 *
 * @param array $block The block settings and attributes.
 */

// Get ACF fields
$code = get_field('coupon_code');
$discount = get_field('coupon_discount');
$description = get_field('coupon_description');
$expiry = get_field('coupon_expiry');
$terms = get_field('coupon_terms');
$bgColor = get_field('coupon_bgColor');
$bgColorClass = get_field('coupon_bgColorClass');
$borderColor = get_field('coupon_borderColor');
$textColor = get_field('coupon_textColor');
$textColorClass = get_field('coupon_textColorClass');
$buttonText = get_field('coupon_buttonText');
$url = get_field('coupon_url');
$align = $block['align'] ?? '';
$className = $block['className'] ?? '';
$customClass = get_field('coupon_custom_class');
$codeCustomClass = get_field('coupon_code_custom_class');
$discountCustomClass = get_field('coupon_discount_custom_class');
$buttonCustomClass = get_field('coupon_button_custom_class');

// Process values
$bg_color = empty($bgColorClass) && !empty($bgColor) ? 'background-color: ' . esc_attr($bgColor) . '; ' : '';
$border_color = !empty($borderColor) ? 'border-color: ' . esc_attr($borderColor) . ';' : '';
$has_textColor = !empty($textColor) && empty($textColorClass) ? true : false;
$style = $has_textColor || $bgColor || $borderColor ? ' style="' . $bg_color . $border_color . ($has_textColor ? ' color: ' . esc_attr($textColor) . ';' : '') . '"' : '';
$href = !empty($url) ? $url : '#';

// Current date for expiry comparison
$current_date = current_time('Y-m-d');
$is_expired = false;
if (!empty($expiry)) {
    $expiry_date = date('Y-m-d', strtotime($expiry));
    $is_expired = $current_date > $expiry_date;
}

// Format classes
$classes = array();
$classes[] = 'coupon';
$classes[] = 'mt-double';
$classes[] = 'mb-double';
$classes[] = 'block-mid';
$classes[] = !empty($align) ? "align{$align}" : '';
$classes[] = !empty($bgColorClass) ? $bgColorClass : '';
$classes[] = !empty($textColorClass) ? $textColorClass : '';
if (!empty($className))
    $classes[] = $className;
if (!empty($customClass))
    $classes[] = esc_attr($customClass);
if ($is_expired)
    $classes[] = 'coupon-expired';
$classes = join(' ', $classes);

// Button classes
$button_classes = array();
$button_classes[] = 'coupon-button';
$button_classes[] = 'button';
if (!empty($buttonCustomClass))
    $button_classes[] = esc_attr($buttonCustomClass);
$button_classes = join(' ', $button_classes);

// Set default button text if empty
if (empty($buttonText)) {
    $buttonText = 'Use Coupon';
}
?>

<div class="<?php echo esc_attr($classes); ?>"<?php echo $style; ?>>
    <div class="coupon-container">
        <div class="coupon-content">
            <?php if ($discount) : ?>
                <div class="coupon-discount <?php echo !empty($discountCustomClass) ? esc_attr($discountCustomClass) : ''; ?>">
                    <?php echo esc_html($discount); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($code) : ?>
                <div class="coupon-code-container">
                    <code class="coupon-code <?php echo !empty($codeCustomClass) ? esc_attr($codeCustomClass) : ''; ?>"><?php echo esc_html($code); ?></code>
                    <button type="button" class="coupon-copy" data-clipboard-text="<?php echo esc_attr($code); ?>" aria-label="Copy coupon code">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    </button>
                </div>
            <?php endif; ?>
            
            <?php if ($description) : ?>
                <div class="coupon-description">
                    <?php echo wpautop($description); ?>
                </div>
            <?php endif; ?>
            
            <div class="coupon-details">
                <?php if ($expiry) : ?>
                    <div class="coupon-expiry">
                        <?php if ($is_expired) : ?>
                            <span class="expired">Expired: <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($expiry))); ?></span>
                        <?php else : ?>
                            <span>Valid until: <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($expiry))); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($terms) : ?>
                    <div class="coupon-terms">
                        <details>
                            <summary>Terms & Conditions</summary>
                            <div class="terms-content">
                                <?php echo wpautop($terms); ?>
                            </div>
                        </details>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="coupon-action">
            <a href="<?php echo esc_url($href); ?>" class="<?php echo esc_attr($button_classes); ?>"<?php echo $is_expired ? ' disabled' : ''; ?>>
                <?php echo esc_html($buttonText); ?>
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize clipboard functionality
    var couponCopyButtons = document.querySelectorAll('.coupon-copy');
    
    couponCopyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var code = this.getAttribute('data-clipboard-text');
            navigator.clipboard.writeText(code).then(function() {
                // Visual feedback
                button.classList.add('copied');
                
                // Reset after 2 seconds
                setTimeout(function() {
                    button.classList.remove('copied');
                }, 2000);
            });
        });
    });
});
</script>

<style>
.coupon {
    border: 1px dashed #e0e0e0;
    border-radius: 8px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.coupon::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: -8px;
    width: 16px;
    background: repeating-linear-gradient(
        #fff,
        #fff 4px,
        transparent 4px,
        transparent 8px
    );
    transform: translateX(-50%);
}

.coupon::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    right: -8px;
    width: 16px;
    background: repeating-linear-gradient(
        #fff,
        #fff 4px,
        transparent 4px,
        transparent 8px
    );
    transform: translateX(50%);
}

.coupon-container {
    display: flex;
    flex-direction: column;
    padding: 24px;
    height: 100%;
}

.coupon-content {
    display: flex;
    flex-direction: column;
    gap: 16px;
    flex: 1;
}

.coupon-discount {
    font-size: 1.8em;
    font-weight: bold;
    color: #333;
    line-height: 1.2;
}

.coupon-code-container {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.coupon-code {
    font-size: 1.2em;
    padding: 8px 12px;
    background: rgba(0,0,0,0.04);
    border-radius: 4px;
    letter-spacing: 0.1em;
    font-family: monospace;
    border: 1px solid rgba(0,0,0,0.1);
}

.coupon-copy {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.coupon-copy:hover {
    background-color: rgba(0,0,0,0.05);
    color: #333;
}

.coupon-copy.copied {
    color: #4CAF50;
}

.coupon-description {
    margin-bottom: 8px;
}

.coupon-details {
    font-size: 0.9em;
    color: #666;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.coupon-expiry {
    display: flex;
    align-items: center;
}

.coupon-expiry .expired {
    color: #F44336;
}

.coupon-terms summary {
    cursor: pointer;
    color: #555;
    font-weight: 500;
}

.coupon-terms .terms-content {
    font-size: 0.95em;
    padding: 8px 0;
    color: #666;
}

.coupon-action {
    margin-top: 20px;
}

.coupon-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    border-radius: 4px;
    text-decoration: none;
    width: 100%;
    transition: background-color 0.3s;
}

.coupon-button:hover {
    background-color: #3d8b40;
}

.coupon-expired .coupon-button {
    background-color: #9e9e9e;
    cursor: not-allowed;
}

@media (min-width: 768px) {
    .coupon-container {
        flex-direction: row;
        align-items: center;
    }
    
    .coupon-content {
        flex: 1;
        margin-right: 20px;
    }
    
    .coupon-action {
        width: 200px;
        margin-top: 0;
    }
}
</style>