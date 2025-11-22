<?php get_header(); ?>

<section class="products-section" style="padding-top: 60px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">
                <?php
                $post_type = get_post_type();
                $lang = gsm_get_current_language();

                if (is_tax()) {
                    single_term_title();
                } elseif ($post_type === 'gsm_service') {
                    echo gsm_t('services');
                } elseif ($post_type === 'gsm_account') {
                    echo gsm_t('accounts');
                } elseif ($post_type === 'gsm_phone') {
                    echo gsm_t('phones');
                } elseif ($post_type === 'gsm_part') {
                    echo gsm_t('parts');
                } else {
                    echo gsm_t('all_products');
                }
                ?>
            </h1>
            <?php if (is_tax()) : ?>
                <p class="section-subtitle"><?php echo term_description(); ?></p>
            <?php endif; ?>
        </div>

        <!-- Product Filters -->
        <?php if (!is_tax()) : ?>
            <div class="product-filters">
                <button class="filter-btn<?php echo !isset($_GET['filter']) ? ' active' : ''; ?>" data-filter="all">
                    <?php echo gsm_t('all_products'); ?>
                </button>
                <?php
                $taxonomy = $post_type . '_category';
                $categories = get_terms(array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => true,
                ));

                if ($categories && !is_wp_error($categories)) :
                    foreach ($categories as $category) :
                        $active = isset($_GET['filter']) && $_GET['filter'] === $category->slug ? ' active' : '';
                        ?>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="filter-btn<?php echo $active; ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        <?php endif; ?>

        <!-- Products Grid -->
        <div class="products-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    get_template_part('template-parts/product', 'card');
                endwhile;

                // Pagination
                ?>
                <div style="grid-column: 1 / -1; margin-top: 40px; text-align: center;">
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
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <h2 style="color: var(--color-black); margin-bottom: 15px;">
                        <?php
                        if ($lang === 'en') echo 'No products found';
                        elseif ($lang === 'zh') echo '未找到产品';
                        else echo 'Không tìm thấy sản phẩm';
                        ?>
                    </h2>
                    <p style="color: var(--color-gray-light); margin-bottom: 30px;">
                        <?php
                        if ($lang === 'en') echo 'Sorry, no products match your criteria.';
                        elseif ($lang === 'zh') echo '抱歉，没有符合您要求的产品。';
                        else echo 'Rất tiếc, không có sản phẩm phù hợp.';
                        ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
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

<!-- Contact CTA -->
<section class="hero-banner" style="padding: 60px 0;">
    <div class="container">
        <div class="hero-content">
            <h2 class="hero-title" style="font-size: 32px;">
                <?php
                if ($lang === 'en') echo 'Need Consultation?';
                elseif ($lang === 'zh') echo '需要咨询？';
                else echo 'Cần Tư Vấn?';
                ?>
            </h2>
            <p class="hero-subtitle">
                <?php
                if ($lang === 'en') echo 'Contact us now for best support';
                elseif ($lang === 'zh') echo '立即联系我们获得最佳支持';
                else echo 'Liên hệ ngay để được hỗ trợ tốt nhất';
                ?>
            </p>
            <div class="hero-buttons">
                <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-phone-alt"></i> <?php echo gsm_t('call_now'); ?>
                </a>
                <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" class="btn btn-secondary btn-lg">
                    <i class="fab fa-telegram-plane"></i> Telegram
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
