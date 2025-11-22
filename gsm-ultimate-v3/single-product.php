<?php
/**
 * Single Product Template - Modern 2025 Design
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

<section class="products-section" style="padding-top: 40px;">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>

            <!-- Breadcrumb -->
            <div style="margin-bottom: var(--spacing-md); font-size: var(--font-size-sm); color: var(--color-gray-light);">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo gsm_t('home'); ?></a>
                <span> / </span>
                <a href="<?php echo esc_url(get_post_type_archive_link(get_post_type())); ?>">
                    <?php echo ucfirst(str_replace('gsm_', '', get_post_type())); ?>
                </a>
                <span> / </span>
                <span><?php the_title(); ?></span>
            </div>

            <div class="row" style="gap: var(--spacing-xl); align-items: flex-start;">

                <!-- Product Gallery Column -->
                <div class="col" style="flex: 0 0 45%; max-width: 600px;">
                    <!-- Main Product Image -->
                    <div class="card" style="padding: var(--spacing-lg); text-align: center; margin-bottom: var(--spacing-md);">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('style' => 'max-width: 100%; height: auto; border-radius: var(--border-radius-md);')); ?>
                        <?php else : ?>
                            <div style="font-size: 150px; padding: var(--spacing-xl); background: var(--color-background); border-radius: var(--border-radius-md);">
                                <?php
                                $post_type = get_post_type();
                                $icons = array(
                                    'gsm_service' => '🔧',
                                    'gsm_account' => '👤',
                                    'gsm_phone' => '📱',
                                    'gsm_part' => '⚙️',
                                );
                                echo $icons[$post_type];
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Features Card -->
                    <div class="card card-glass" style="padding: var(--spacing-lg);">
                        <h3 style="color: var(--color-black); margin-bottom: var(--spacing-md); font-size: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-star" style="color: var(--color-primary);"></i>
                            <?php
                            if ($lang === 'en') echo 'Key Features';
                            elseif ($lang === 'zh') echo '主要特点';
                            else echo 'Đặc Điểm Nổi Bật';
                            ?>
                        </h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 12px 0; border-bottom: var(--border-width) solid var(--border-color); display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-check-circle" style="color: var(--color-success); font-size: 18px;"></i>
                                <span>
                                    <?php
                                    if ($lang === 'en') echo 'High quality guaranteed';
                                    elseif ($lang === 'zh') echo '质量保证';
                                    else echo 'Chất lượng đảm bảo';
                                    ?>
                                </span>
                            </li>
                            <li style="padding: 12px 0; border-bottom: var(--border-width) solid var(--border-color); display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-check-circle" style="color: var(--color-success); font-size: 18px;"></i>
                                <span>
                                    <?php
                                    if ($lang === 'en') echo 'Fast delivery';
                                    elseif ($lang === 'zh') echo '快速交货';
                                    else echo 'Giao hàng nhanh';
                                    ?>
                                </span>
                            </li>
                            <li style="padding: 12px 0; border-bottom: var(--border-width) solid var(--border-color); display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-check-circle" style="color: var(--color-success); font-size: 18px;"></i>
                                <span>24/7 Support</span>
                            </li>
                            <li style="padding: 12px 0; display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-check-circle" style="color: var(--color-success); font-size: 18px;"></i>
                                <span>
                                    <?php
                                    if ($lang === 'en') echo 'Money back guarantee';
                                    elseif ($lang === 'zh') echo '退款保证';
                                    else echo 'Hoàn tiền nếu không hài lòng';
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Product Info Column -->
                <div class="col" style="flex: 1;">
                    <!-- Product Title & Category -->
                    <div style="margin-bottom: var(--spacing-md);">
                        <?php
                        $taxonomy = get_post_type() . '_category';
                        $terms = get_the_terms(get_the_ID(), $taxonomy);
                        if ($terms && !is_wp_error($terms)) :
                            foreach ($terms as $term) :
                                ?>
                                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="product-category" style="display: inline-block; margin-bottom: var(--spacing-sm);">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            <?php endforeach;
                        endif;
                        ?>

                        <h1 style="font-size: clamp(28px, 4vw, 42px); margin-bottom: var(--spacing-sm); color: var(--color-black); line-height: 1.3;">
                            <?php the_title(); ?>
                        </h1>

                        <?php if ($sku) : ?>
                            <div style="color: var(--color-gray-light); font-size: var(--font-size-sm); margin-bottom: var(--spacing-md);">
                                SKU: <strong style="color: var(--color-gray);"><?php echo esc_html($sku); ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Price Card - Glassmorphism -->
                    <div class="card" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-md); background: var(--gradient-primary); color: var(--color-black);">
                        <div style="display: flex; justify-content: space-between; align-items: center; gap: var(--spacing-md); flex-wrap: wrap;">
                            <div>
                                <div style="font-size: 14px; opacity: 0.8; margin-bottom: 5px; font-weight: 600;">
                                    <?php echo gsm_t('price'); ?>:
                                </div>
                                <div style="font-size: 42px; font-weight: 900; line-height: 1;">
                                    <?php echo gsm_format_price($price); ?>
                                </div>
                                <?php if ($price_old && $price_old > $price) : ?>
                                    <div style="font-size: 20px; text-decoration: line-through; opacity: 0.7; margin-top: 5px;">
                                        <?php echo gsm_format_price($price_old); ?>
                                    </div>
                                    <div style="margin-top: 5px; font-weight: 700; font-size: 18px;">
                                        <?php
                                        $discount = round((($price_old - $price) / $price_old) * 100);
                                        if ($lang === 'en') echo 'Save ' . $discount . '%';
                                        elseif ($lang === 'zh') echo '节省 ' . $discount . '%';
                                        else echo 'Tiết kiệm ' . $discount . '%';
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($stock) : ?>
                                <div class="product-stock <?php echo esc_attr($stock); ?>" style="padding: 12px 24px; border-radius: var(--border-radius-md); font-size: 18px;">
                                    <?php echo gsm_t($stock); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Additional Info Grid -->
                    <?php if ($warranty) : ?>
                        <div class="card" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-md);">
                            <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
                                <div style="width: 50px; height: 50px; background: var(--gradient-primary); border-radius: var(--border-radius-md); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <div style="font-size: var(--font-size-sm); color: var(--color-gray-light); margin-bottom: 4px;">
                                        <?php
                                        if ($lang === 'en') echo 'Warranty';
                                        elseif ($lang === 'zh') echo '保修';
                                        else echo 'Bảo hành';
                                        ?>
                                    </div>
                                    <div style="font-size: 20px; font-weight: 700; color: var(--color-success);">
                                        <?php echo esc_html($warranty); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Buy Now Button -->
                    <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-primary btn-block btn-lg" style="margin-bottom: var(--spacing-md); font-size: 20px; padding: 20px;">
                        <i class="fas fa-shopping-cart"></i> <?php echo gsm_t('buy_now'); ?>
                    </a>

                    <!-- Contact Methods Grid -->
                    <div class="card card-glass" style="padding: var(--spacing-lg); border: 2px solid var(--color-primary);">
                        <h3 style="margin-bottom: var(--spacing-md); font-size: 18px; font-weight: 700; color: var(--color-black);">
                            <?php
                            if ($lang === 'en') echo 'Contact Now';
                            elseif ($lang === 'zh') echo '立即联系';
                            else echo 'Liên Hệ Ngay';
                            ?>
                        </h3>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                            <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-outline">
                                <i class="fas fa-phone-alt"></i>
                                <?php
                                if ($lang === 'en') echo 'Phone';
                                elseif ($lang === 'zh') echo '电话';
                                else echo 'Điện thoại';
                                ?>
                            </a>
                            <a href="https://wa.me/<?php echo str_replace('+', '', get_theme_mod('gsm_whatsapp', GSM_HOTLINE)); ?>" target="_blank" class="btn btn-outline">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="https://zalo.me/<?php echo str_replace('+', '', get_theme_mod('gsm_zalo', GSM_HOTLINE)); ?>" target="_blank" class="btn btn-outline">
                                <strong>Z</strong> Zalo
                            </a>
                            <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" class="btn btn-outline">
                                <i class="fab fa-telegram-plane"></i> Telegram
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description Tabs -->
            <div class="card" style="margin-top: var(--spacing-xl); padding: var(--spacing-lg);">
                <h2 style="margin-bottom: var(--spacing-md); padding-bottom: var(--spacing-md); border-bottom: 3px solid var(--color-primary);">
                    <?php
                    if ($lang === 'en') echo 'Product Description';
                    elseif ($lang === 'zh') echo '产品描述';
                    else echo 'Mô Tả Sản Phẩm';
                    ?>
                </h2>
                <div style="color: var(--color-gray-dark); line-height: 1.8; font-size: 17px;">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Comments Section - Modern Design -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div style="margin-top: var(--spacing-xl);">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

            <!-- Related Products -->
            <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-xl); border-top: 2px solid var(--border-color);">
                <h3 class="section-title" style="font-size: 32px; margin-bottom: var(--spacing-lg);">
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
                                $rel_price = get_post_meta(get_the_ID(), '_gsm_price', true);
                                $rel_stock = get_post_meta(get_the_ID(), '_gsm_stock', true);
                                ?>
                                <article class="product-card">
                                    <div class="product-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('gsm-product-thumb'); ?>
                                        <?php else : ?>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 80px;">
                                                <?php echo $icons[get_post_type()]; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <div class="product-meta">
                                            <div class="product-price"><?php echo gsm_format_price($rel_price); ?></div>
                                            <?php if ($rel_stock) : ?>
                                                <span class="product-stock <?php echo esc_attr($rel_stock); ?>">
                                                    <?php echo gsm_t($rel_stock); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                                            <?php echo gsm_t('buy_now'); ?>
                                        </a>
                                    </div>
                                </article>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p style="color: var(--color-gray-light); grid-column: 1 / -1; text-align: center;">';
                            if ($lang === 'en') echo 'No related products.';
                            elseif ($lang === 'zh') echo '没有相关产品。';
                            else echo 'Không có sản phẩm liên quan.';
                            echo '</p>';
                        endif;
                    }
                    ?>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
