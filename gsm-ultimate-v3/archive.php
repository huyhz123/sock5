<?php
/**
 * Archive template for product types (services, accounts, phones, parts)
 */

get_header();

$lang = gsm_get_current_language();
$post_type = get_post_type();
?>

<section class="products-section" style="padding-top: 60px;">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <h1 class="section-title">
                <?php
                if (is_post_type_archive('gsm_service')) {
                    echo gsm_t('services');
                } elseif (is_post_type_archive('gsm_account')) {
                    echo gsm_t('accounts');
                } elseif (is_post_type_archive('gsm_phone')) {
                    echo gsm_t('phones');
                } elseif (is_post_type_archive('gsm_part')) {
                    echo gsm_t('parts');
                } else {
                    post_type_archive_title();
                }
                ?>
            </h1>

            <p class="section-subtitle">
                <?php
                if (is_post_type_archive()) {
                    $post_type_obj = get_post_type_object($post_type);
                    if ($post_type_obj && $post_type_obj->description) {
                        echo esc_html($post_type_obj->description);
                    } else {
                        if ($lang === 'en') echo 'Browse our collection of products and services';
                        elseif ($lang === 'zh') echo '浏览我们的产品和服务系列';
                        else echo 'Duyệt qua bộ sưu tập sản phẩm và dịch vụ của chúng tôi';
                    }
                }
                ?>
            </p>
        </div>

        <!-- Category Filter (if has categories) -->
        <?php
        $taxonomy = $post_type . '_category';
        if (taxonomy_exists($taxonomy)) {
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
            ));

            if ($terms && !is_wp_error($terms)) :
                ?>
                <div class="section-filters">
                    <button class="filter-btn active" data-filter="all">
                        <?php
                        if ($lang === 'en') echo 'All';
                        elseif ($lang === 'zh') echo '全部';
                        else echo 'Tất cả';
                        ?>
                    </button>
                    <?php foreach ($terms as $term) : ?>
                        <button class="filter-btn" data-filter="<?php echo esc_attr($term->slug); ?>">
                            <?php echo esc_html($term->name); ?>
                            <span style="opacity: 0.7;">(<?php echo $term->count; ?>)</span>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif;
        }
        ?>

        <!-- Products Grid -->
        <div class="products-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $price = get_post_meta(get_the_ID(), '_gsm_price', true);
                    $price_old = get_post_meta(get_the_ID(), '_gsm_price_old', true);
                    $stock = get_post_meta(get_the_ID(), '_gsm_stock', true);

                    $product_terms = get_the_terms(get_the_ID(), $taxonomy);
                    $term_slug = '';
                    if ($product_terms && !is_wp_error($product_terms)) {
                        $term_slug = $product_terms[0]->slug;
                    }
                    ?>
                    <article <?php post_class('product-card'); ?> data-category="<?php echo esc_attr($term_slug); ?>">
                        <?php if ($price_old && $price_old > $price) : ?>
                            <span class="product-badge">
                                <?php
                                $discount = round((($price_old - $price) / $price_old) * 100);
                                echo '-' . $discount . '%';
                                ?>
                            </span>
                        <?php endif; ?>

                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('gsm-product-thumb'); ?>
                                <?php else : ?>
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 80px;">
                                        <?php
                                        $icons = array(
                                            'gsm_service' => '🔧',
                                            'gsm_account' => '👤',
                                            'gsm_phone' => '📱',
                                            'gsm_part' => '⚙️',
                                        );
                                        echo $icons[get_post_type()];
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-content">
                            <?php if ($product_terms && !is_wp_error($product_terms)) : ?>
                                <div class="product-category">
                                    <?php echo esc_html($product_terms[0]->name); ?>
                                </div>
                            <?php endif; ?>

                            <h3 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <p class="product-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>

                            <div class="product-meta">
                                <div class="product-price">
                                    <?php echo gsm_format_price($price); ?>
                                    <?php if ($price_old && $price_old > $price) : ?>
                                        <span class="product-price-old"><?php echo gsm_format_price($price_old); ?></span>
                                    <?php endif; ?>
                                </div>

                                <?php if ($stock) : ?>
                                    <span class="product-stock <?php echo esc_attr($stock); ?>">
                                        <?php echo gsm_t($stock); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                                <i class="fas fa-shopping-cart"></i>
                                <?php echo gsm_t('buy_now'); ?>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile;

                // Pagination
                ?>
                <div style="grid-column: 1 / -1; margin-top: var(--spacing-xl);">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-arrow-left"></i> ' . ($lang === 'en' ? 'Previous' : ($lang === 'zh' ? '上一页' : 'Trước')),
                        'next_text' => ($lang === 'en' ? 'Next' : ($lang === 'zh' ? '下一页' : 'Sau')) . ' <i class="fas fa-arrow-right"></i>',
                    ));
                    ?>
                </div>
            <?php
            else :
                ?>
                <div class="card" style="grid-column: 1 / -1; text-align: center; padding: var(--spacing-xxl);">
                    <div style="font-size: 80px; margin-bottom: var(--spacing-lg); opacity: 0.3;">
                        <i class="far fa-folder-open"></i>
                    </div>
                    <h2 style="color: var(--color-black); margin-bottom: var(--spacing-sm);">
                        <?php
                        if ($lang === 'en') echo 'No products found';
                        elseif ($lang === 'zh') echo '未找到产品';
                        else echo 'Không tìm thấy sản phẩm';
                        ?>
                    </h2>
                    <p style="color: var(--color-gray-light); margin-bottom: var(--spacing-lg);">
                        <?php
                        if ($lang === 'en') echo 'Sorry, no products match your criteria.';
                        elseif ($lang === 'zh') echo '抱歉，没有符合您要求的产品。';
                        else echo 'Rất tiếc, không có sản phẩm phù hợp.';
                        ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-home"></i>
                        <?php
                        if ($lang === 'en') echo 'Back to Home';
                        elseif ($lang === 'zh') echo '返回首页';
                        else echo 'Về trang chủ';
                        ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
