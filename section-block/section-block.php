<?php
/**
 * Section Block Template.
 *
 * @param   array  $block     The block settings and attributes.
 * @param   string $content   The inner blocks content. <InnerBlocks templateLock="false" />
 * @param   bool   $is_preview True during AJAX preview.
 * @param   int    $post_id   The post ID where the block is rendered.
 */

// Get ACF fields.
$html_tag    = get_field('acf_section_html_tag') ?: 'section';
$custom_tag  = get_field('acf_section_custom_tag');
$custom_class = get_field('acf_section_custom_class');

// Determine the final HTML tag.
$tag = ($html_tag === 'custom' && !empty($custom_tag)) ? $custom_tag : $html_tag;
?>
<<?php echo esc_attr($tag); ?><?php if ($custom_class): ?> class="<?php echo esc_attr($custom_class); ?>"<?php endif; ?>>
    <InnerBlocks templateLock="false" />
</<?php echo esc_attr($tag); ?>>
