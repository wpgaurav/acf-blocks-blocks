<?php
/**
 * Product Block Template.
 *
 * Fields:
 *  - pl_block_rank (text)
 *  - pl_block_icon (image)
 *  - pl_block_product_name (text)
 *  - pl_block_description (wysiwyg)
 *  - pl_block_pricing (repeater) with subfields:
 *       • pl_block_pricing_title (text)
 *       • pl_block_pricing_amount (text)
 *  - pl_block_coupons (repeater) with subfields:
 *       • pl_block_coupon_code (text)
 *       • pl_block_coupon_offer (text)
 *  - pl_block_buttons (repeater) with subfields:
 *       • pl_block_button_text (text)
 *       • pl_block_button_url (url)
 *       • pl_block_button_rel (text)
 *       • pl_block_button_class (text)
 */

$rank         = get_field('pl_block_rank');
$icon         = get_field('pl_block_icon');
$product_name = get_field('pl_block_product_name');
$description  = get_field('pl_block_description');
$pricing      = get_field('pl_block_pricing');
$coupons      = get_field('pl_block_coupons');
$buttons      = get_field('pl_block_buttons');
?>

<div class="pl-block">
  <!-- Top Row: Rank, Icon, Product Name (3 columns using Flex) -->
  <div class="pl-block-header">
    <div class="pl-block-column pl-block-rank">
      <?php if ( $rank ): ?>
        <div class="pl-block-rank-text"><?php echo esc_html($rank); ?></div>
      <?php endif; ?>
    </div>
    <div class="pl-block-column pl-block-icon">
      <?php if ( $icon ): ?>
        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" style="width:64px; height:auto;"/>
      <?php endif; ?>
    </div>
    <div class="pl-block-column pl-block-name">
      <?php if ( $product_name ): ?>
        <p class="small-title"><?php echo esc_html($product_name); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Description (Full Width) -->
  <div class="pl-block-description">
    <?php if ( $description ): ?>
      <?php echo $description; ?>
    <?php endif; ?>
  </div>

  <!-- Pricing and Coupons (2 columns: half-half) -->
  <div class="pl-block-info">
    <div class="pl-block-pricing">
      <?php if ( $pricing ): ?>
        <h3>Pricing</h3>
        <ul>
          <?php foreach ( $pricing as $price_item ): ?>
            <li>
              <strong><?php echo esc_html($price_item['pl_block_pricing_title']); ?>:</strong>
              <?php echo esc_html($price_item['pl_block_pricing_amount']); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
    <div class="pl-block-coupons">
      <?php if ( $coupons ): ?>
        <h3>Coupons</h3>
        <ul>
          <?php foreach ( $coupons as $coupon_item ): ?>
            <li>
              <span class="pl-coupon-code"><?php echo esc_html($coupon_item['pl_block_coupon_code']); ?></span>
              <?php if ( !empty($coupon_item['pl_block_coupon_offer']) ): ?>
                <span class="pl-coupon-offer"> - <?php echo esc_html($coupon_item['pl_block_coupon_offer']); ?></span>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>

  <!-- Offer Buttons (Stacked inline-blocks) -->
  <div class="pl-block-buttons">
    <?php if ( $buttons ): ?>
      <?php foreach ( $buttons as $button ): ?>
        <?php
          $btn_text  = $button['pl_block_button_text'];
          $btn_url   = $button['pl_block_button_url'];
          $btn_rel   = $button['pl_block_button_rel'];
          $btn_class = $button['pl_block_button_class'];
          $rel_attr  = $btn_rel ? ' rel="' . esc_attr($btn_rel) . '"' : '';
        ?>
        <a href="<?php echo esc_url($btn_url); ?>"<?php echo $rel_attr; ?> class="pl-block-button <?php echo esc_attr($btn_class); ?>">
          <?php echo esc_html($btn_text); ?>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>