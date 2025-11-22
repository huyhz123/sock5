<?php
/**
 * Template for displaying single product (all types)
 * Used for: gsm_service, gsm_account, gsm_phone, gsm_part
 */

get_header();

$lang = gsm_get_current_language();
$price = get_post_meta(get_the_ID(), '_gsm_price', true);
$price_old = get_post_meta(get_the_ID(), '_gsm_price_old', true);
$stock = get_post_meta(get_the_ID(), '_gsm_stock', true);
$sku = get_post_meta(get_the_ID(), '_gsm_sku', true);
$warranty = get_post_meta(get_the_ID(), '_gsm_warranty', true);
?>

<section class="products-section" style="padding-top: 60px;">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
            ?>
            <div class="row" style="gap: 40px;">
                <!-- Product Image -->
                <div class="col" style="flex: 0 0 45%;">
                    <div style="background: var(--color-background); padding: 40px; text-align: center; margin-bottom: 20px; border: var(--border-width) solid var(--border-color);">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('style' => 'max-width: 100%; height: auto;')); ?>
                        <?php else : ?>
                            <div style="font-size: 120px;">
                                <?php
                                $post_type = get_post_type();
                                $icons = array(
                                    'gsm_service' => '🔧',
                                    'gsm_account' => '👤',
                                    'gsm_phone' => '📱',
                                    'gsm_part' => '⚙️',
                                );
                                echo isset($icons[$post_type]) ? $icons[$post_type] : '📦';
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Details Box -->
                    <div style="background: var(--color-white); border: var(--border-width) solid var(--border-color); padding: 30px;">
                        <h3 style="color: var(--color-primary); margin-bottom: 20px; font-size: 20px; text-transform: uppercase;">
                            <?php
                            if ($lang === 'en') echo 'Product Details';
                            elseif ($lang === 'zh') echo '产品详情';
                            else echo 'Thông Tin Sản Phẩm';
                            ?>
                        </h3>

                        <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: var(--border-width) solid var(--border-color);">
                            <div style="color: var(--color-gray-light); margin-bottom: 5px; font-size: 14px;">
                                <?php echo gsm_t('price'); ?>
                            </div>
                            <div style="font-size: 32px; font-weight: 700; color: var(--color-primary);">
                                <?php echo gsm_format_price($price); ?>
                            </div>
                            <?php if ($price_old && $price_old > $price) : ?>
                                <div style="text-decoration: line-through; color: var(--color-gray-lighter); margin-top: 5px;">
                                    <?php echo gsm_format_price($price_old); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($stock) : ?>
                            <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: var(--border-width) solid var(--border-color);">
                                <div style="color: var(--color-gray-light); margin-bottom: 5px; font-size: 14px;">
                                    <?php
                                    if ($lang === 'en') echo 'Stock Status';
                                    elseif ($lang === 'zh') echo '库存状态';
                                    else echo 'Trạng thái';
                                    ?>
                                </div>
                                <div style="font-size: 18px; font-weight: 600; color: <?php echo $stock === 'in_stock' ? 'var(--color-success)' : 'var(--color-danger)'; ?>;">
                                    <?php echo gsm_t($stock); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($sku) : ?>
                            <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: var(--border-width) solid var(--border-color);">
                                <div style="color: var(--color-gray-light); margin-bottom: 5px; font-size: 14px;">SKU</div>
                                <div style="font-size: 16px; color: var(--color-black);"><?php echo esc_html($sku); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($warranty) : ?>
                            <div style="margin-bottom: 20px;">
                                <div style="color: var(--color-gray-light); margin-bottom: 5px; font-size: 14px;">
                                    <i class="fas fa-shield-alt"></i>
                                    <?php
                                    if ($lang === 'en') echo 'Warranty';
                                    elseif ($lang === 'zh') echo '保修';
                                    else echo 'Bảo hành';
                                    ?>
                                </div>
                                <div style="font-size: 16px; font-weight: 600; color: var(--color-success);">
                                    <?php echo esc_html($warranty); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-primary btn-block btn-lg" style="margin-top: 20px;">
                            <i class="fas fa-phone-alt"></i> <?php echo gsm_t('buy_now'); ?>
                        </a>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col">
                    <h1 style="font-size: 32px; margin-bottom: 15px; color: var(--color-black);">
                        <?php the_title(); ?>
                    </h1>

                    <?php
                    $taxonomy = get_post_type() . '_category';
                    $terms = get_the_terms(get_the_ID(), $taxonomy);
                    if ($terms && !is_wp_error($terms)) :
                        ?>
                        <div style="margin-bottom: 20px;">
                            <?php foreach ($terms as $term) : ?>
                                <a href="<?php echo esc_url(get_term_link($term)); ?>" style="display: inline-block; background: var(--color-primary); color: var(--color-black); padding: 6px 15px; font-size: 14px; font-weight: 600; margin-right: 10px;">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div style="color: var(--color-gray-dark); line-height: 1.8; font-size: 17px; margin-bottom: 30px;">
                        <?php the_content(); ?>
                    </div>

                    <!-- Features -->
                    <div style="background: var(--color-background); border-left: 3px solid var(--color-primary); padding: 30px; margin-bottom: 30px;">
                        <h3 style="color: var(--color-black); margin-bottom: 20px; font-size: 20px;">
                            <i class="fas fa-star"></i>
                            <?php
                            if ($lang === 'en') echo 'Key Features';
                            elseif ($lang === 'zh') echo '主要特点';
                            else echo 'Đặc Điểm Nổi Bật';
                            ?>
                        </h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 10px 0; border-bottom: var(--border-width) solid var(--border-color);">
                                <i class="fas fa-check" style="color: var(--color-success); margin-right: 10px;"></i>
                                <?php
                                if ($lang === 'en') echo 'High quality guaranteed';
                                elseif ($lang === 'zh') echo '质量保证';
                                else echo 'Chất lượng đảm bảo';
                                ?>
                            </li>
                            <li style="padding: 10px 0; border-bottom: var(--border-width) solid var(--border-color);">
                                <i class="fas fa-check" style="color: var(--color-success); margin-right: 10px;"></i>
                                <?php
                                if ($lang === 'en') echo 'Fast delivery';
                                elseif ($lang === 'zh') echo '快速交货';
                                else echo 'Giao hàng nhanh';
                                ?>
                            </li>
                            <li style="padding: 10px 0; border-bottom: var(--border-width) solid var(--border-color);">
                                <i class="fas fa-check" style="color: var(--color-success); margin-right: 10px;"></i>
                                <?php
                                if ($lang === 'en') echo '24/7 Support';
                                elseif ($lang === 'zh') echo '24/7支持';
                                else echo 'Hỗ trợ 24/7';
                                ?>
                            </li>
                            <li style="padding: 10px 0;">
                                <i class="fas fa-check" style="color: var(--color-success); margin-right: 10px;"></i>
                                <?php
                                if ($lang === 'en') echo 'Competitive pricing';
                                elseif ($lang === 'zh') echo '价格优惠';
                                else echo 'Giá cả cạnh tranh';
                                ?>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Methods -->
                    <div style="background: var(--gradient-primary); padding: 30px;">
                        <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 700; color: var(--color-white);">
                            <?php
                            if ($lang === 'en') echo 'Contact Now';
                            elseif ($lang === 'zh') echo '立即联系';
                            else echo 'Liên Hệ Ngay';
                            ?>
                        </h3>
                        <p style="margin-bottom: 20px; font-size: 16px; color: var(--color-white);">
                            <?php
                            if ($lang === 'en') echo 'Choose your preferred contact method:';
                            elseif ($lang === 'zh') echo '选择您喜欢的联系方式：';
                            else echo 'Chọn kênh liên hệ phù hợp:';
                            ?>
                        </p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-secondary">
                                <i class="fas fa-phone-alt"></i> <?php
                                if ($lang === 'en') echo 'Phone';
                                elseif ($lang === 'zh') echo '电话';
                                else echo 'Điện thoại';
                                ?>
                            </a>
                            <a href="https://wa.me/<?php echo str_replace('+', '', get_theme_mod('gsm_whatsapp', GSM_HOTLINE)); ?>" target="_blank" class="btn btn-secondary">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="https://zalo.me/<?php echo str_replace('+', '', get_theme_mod('gsm_zalo', GSM_HOTLINE)); ?>" target="_blank" class="btn btn-secondary">
                                <strong>Z</strong> Zalo
                            </a>
                            <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" class="btn btn-secondary">
                                <i class="fab fa-telegram-plane"></i> Telegram
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div style="margin-top: 60px;">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

            <!-- Related Products -->
            <div style="margin-top: 60px; padding-top: 40px; border-top: 2px solid var(--border-color);">
                <h3 class="section-title" style="font-size: 28px; margin-bottom: 30px;">
                    <?php
                    if ($lang === 'en') echo 'Related Products';
                    elseif ($lang === 'zh') echo '相关产品';
                    else echo 'Sản Phẩm Liên Quan';
                    ?>
                </h3>
                <div class="products-grid">
                    <?php
                    if ($terms && !is_wp_error($terms)) {
                        $term_ids = array();
                        foreach ($terms as $term) {
                            $term_ids[] = $term->term_id;
                        }

                        $related = new WP_Query(array(
                            'post_type' => get_post_type(),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field' => 'term_id',
                                    'terms' => $term_ids,
                                ),
                            ),
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 4,
                            'orderby' => 'rand',
                        ));

                        if ($related->have_posts()) :
                            while ($related->have_posts()) : $related->the_post();
                                get_template_part('template-parts/product', 'card');
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p style="color: var(--color-gray-light);">';
                            if ($lang === 'en') echo 'No related products.';
                            elseif ($lang === 'zh') echo '没有相关产品。';
                            else echo 'Không có sản phẩm liên quan.';
                            echo '</p>';
                        endif;
                    }
                    ?>
                </div>
            </div>
        <?php
        endwhile;
        ?>
    </div>
</section>

<?php get_footer(); ?>
