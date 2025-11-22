<?php
/**
 * Template part for displaying product card
 */

$price = get_post_meta(get_the_ID(), '_gsm_price', true);
$price_old = get_post_meta(get_the_ID(), '_gsm_price_old', true);
$stock = get_post_meta(get_the_ID(), '_gsm_stock', true);
$warranty = get_post_meta(get_the_ID(), '_gsm_warranty', true);
?>

<div class="product-card">
    <div class="product-image">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('gsm-product-thumb'); ?>
        <?php else : ?>
            <?php
            // Icon based on post type
            $post_type = get_post_type();
            $icons = array(
                'gsm_service' => '🔧',
                'gsm_account' => '👤',
                'gsm_phone' => '📱',
                'gsm_part' => '⚙️',
            );
            echo isset($icons[$post_type]) ? $icons[$post_type] : '📦';
            ?>
        <?php endif; ?>

        <?php if ($stock === 'in_stock') : ?>
            <span class="product-badge"><?php echo gsm_t('in_stock'); ?></span>
        <?php endif; ?>
    </div>

    <div class="product-content">
        <div class="product-category">
            <?php
            $taxonomy = get_post_type() . '_category';
            $terms = get_the_terms(get_the_ID(), $taxonomy);
            if ($terms && !is_wp_error($terms)) {
                echo esc_html($terms[0]->name);
            }
            ?>
        </div>

        <h3 class="product-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="product-description">
            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
        </p>

        <?php if ($warranty) : ?>
            <div class="product-meta">
                <span class="meta-item">
                    <i class="fas fa-shield-alt"></i> <?php echo esc_html($warranty); ?>
                </span>
            </div>
        <?php endif; ?>

        <div class="product-price">
            <?php echo gsm_format_price($price); ?>
            <?php if ($price_old && $price_old > $price) : ?>
                <span class="price-old"><?php echo gsm_format_price($price_old); ?></span>
            <?php endif; ?>
        </div>

        <div class="product-actions">
            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                <?php echo gsm_t('view_details'); ?>
            </a>
            <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-success">
                <i class="fas fa-phone-alt"></i>
            </a>
        </div>
    </div>
</div>
