<?php
/**
 * Homepage Template with 2025 Style Hero Banner
 */

get_header();

$lang = gsm_get_current_language();
?>

<!-- Hero Banner - 2025 Style -->
<section class="hero-banner">
    <div class="hero-background">
        <?php
        $hero_video = get_theme_mod('gsm_hero_video');
        if ($hero_video) :
            ?>
            <video autoplay muted loop playsinline>
                <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <div id="particles-js"></div>
    </div>

    <div class="hero-content">
        <div class="hero-logo animate-fadeInUp">
            <?php echo esc_html(get_theme_mod('gsm_logo_text', 'Hz')); ?>
        </div>

        <h1 class="hero-title">
            <?php
            $hero_title = get_theme_mod('gsm_hero_title');
            if ($hero_title) {
                echo esc_html($hero_title);
            } else {
                if ($lang === 'en') {
                    echo 'Professional GSM Services';
                } elseif ($lang === 'zh') {
                    echo '专业GSM服务';
                } else {
                    echo 'Dịch Vụ GSM Chuyên Nghiệp';
                }
            }
            ?>
        </h1>

        <p class="hero-subtitle">
            <?php
            $hero_subtitle = get_theme_mod('gsm_hero_subtitle');
            if ($hero_subtitle) {
                echo esc_html($hero_subtitle);
            } else {
                if ($lang === 'en') {
                    echo 'IMEI unlock, phone repair, accounts & more - Available 24/7';
                } elseif ($lang === 'zh') {
                    echo 'IMEI解锁、手机维修、账户等 - 24/7服务';
                } else {
                    echo 'Mở khóa IMEI, sửa chữa điện thoại, tài khoản & nhiều hơn - Hỗ trợ 24/7';
                }
            }
            ?>
        </p>

        <div class="hero-buttons">
            <a href="#services" class="btn btn-primary btn-lg">
                <i class="fas fa-rocket"></i>
                <?php
                if ($lang === 'en') echo 'Get Started';
                elseif ($lang === 'zh') echo '开始使用';
                else echo 'Bắt đầu';
                ?>
            </a>
            <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-glass btn-lg">
                <i class="fas fa-phone-alt"></i>
                <?php
                if ($lang === 'en') echo 'Contact Now';
                elseif ($lang === 'zh') echo '立即联系';
                else echo 'Liên hệ ngay';
                ?>
            </a>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-number">10K+</div>
                <div class="hero-stat-label">
                    <?php
                    if ($lang === 'en') echo 'Customers';
                    elseif ($lang === 'zh') echo '客户';
                    else echo 'Khách hàng';
                    ?>
                </div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">99%</div>
                <div class="hero-stat-label">
                    <?php
                    if ($lang === 'en') echo 'Success Rate';
                    elseif ($lang === 'zh') echo '成功率';
                    else echo 'Tỷ lệ thành công';
                    ?>
                </div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">24/7</div>
                <div class="hero-stat-label">
                    <?php
                    if ($lang === 'en') echo 'Support';
                    elseif ($lang === 'zh') echo '支持';
                    else echo 'Hỗ trợ';
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="products-section" id="services">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                <?php echo gsm_t('services'); ?>
            </h2>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Professional GSM services for all your needs';
                elseif ($lang === 'zh') echo '满足您所有需求的专业GSM服务';
                else echo 'Dịch vụ GSM chuyên nghiệp cho mọi nhu cầu của bạn';
                ?>
            </p>
        </div>

        <div class="section-filters">
            <button class="filter-btn active" data-filter="all">
                <?php
                if ($lang === 'en') echo 'All Services';
                elseif ($lang === 'zh') echo '所有服务';
                else echo 'Tất cả';
                ?>
            </button>
            <button class="filter-btn" data-filter="services">
                <?php echo gsm_t('services'); ?>
            </button>
            <button class="filter-btn" data-filter="accounts">
                <?php echo gsm_t('accounts'); ?>
            </button>
            <button class="filter-btn" data-filter="phones">
                <?php echo gsm_t('phones'); ?>
            </button>
            <button class="filter-btn" data-filter="parts">
                <?php echo gsm_t('parts'); ?>
            </button>
        </div>

        <div class="products-grid">
            <?php
            // Get all product types
            $product_types = array('gsm_service', 'gsm_account', 'gsm_phone', 'gsm_part');
            $all_products = array();

            foreach ($product_types as $type) {
                $products = new WP_Query(array(
                    'post_type' => $type,
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                while ($products->have_posts()) {
                    $products->the_post();
                    $all_products[] = get_post();
                }
                wp_reset_postdata();
            }

            // Display products
            foreach ($all_products as $product) {
                setup_postdata($product);
                $post_type = get_post_type($product);
                $category_slug = str_replace('gsm_', '', $post_type);

                $price = get_post_meta($product->ID, '_gsm_price', true);
                $price_old = get_post_meta($product->ID, '_gsm_price_old', true);
                $stock = get_post_meta($product->ID, '_gsm_stock', true);
                ?>
                <article class="product-card" data-category="<?php echo esc_attr($category_slug); ?>">
                    <?php if ($price_old && $price_old > $price) : ?>
                        <span class="product-badge">
                            <?php
                            $discount = round((($price_old - $price) / $price_old) * 100);
                            echo '-' . $discount . '%';
                            ?>
                        </span>
                    <?php endif; ?>

                    <div class="product-image">
                        <?php if (has_post_thumbnail($product->ID)) : ?>
                            <?php echo get_the_post_thumbnail($product->ID, 'gsm-product-thumb'); ?>
                        <?php else : ?>
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 80px;">
                                <?php
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

                    <div class="product-content">
                        <div class="product-category">
                            <?php echo esc_html(ucfirst($category_slug)); ?>
                        </div>

                        <h3 class="product-title">
                            <a href="<?php echo get_permalink($product->ID); ?>">
                                <?php echo get_the_title($product->ID); ?>
                            </a>
                        </h3>

                        <p class="product-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt($product), 15); ?>
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

                        <a href="<?php echo get_permalink($product->ID); ?>" class="btn btn-primary btn-block">
                            <i class="fas fa-shopping-cart"></i>
                            <?php echo gsm_t('buy_now'); ?>
                        </a>
                    </div>
                </article>
                <?php
            }
            wp_reset_postdata();

            // If no products
            if (empty($all_products)) :
                ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <h3 style="color: var(--color-gray-light);">
                        <?php
                        if ($lang === 'en') echo 'No products available';
                        elseif ($lang === 'zh') echo '暂无产品';
                        else echo 'Chưa có sản phẩm';
                        ?>
                    </h3>
                </div>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-top: var(--spacing-lg);">
            <a href="<?php echo esc_url(get_post_type_archive_link('gsm_service')); ?>" class="btn btn-outline btn-lg">
                <?php echo gsm_t('view_all'); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="products-section" style="background: var(--color-white);">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                <?php
                if ($lang === 'en') echo 'Why Choose Us';
                elseif ($lang === 'zh') echo '为什么选择我们';
                else echo 'Tại Sao Chọn Chúng Tôi';
                ?>
            </h2>
        </div>

        <div class="grid grid-4">
            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center;">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">⚡</div>
                <h3 style="margin-bottom: var(--spacing-sm);">
                    <?php
                    if ($lang === 'en') echo 'Fast Service';
                    elseif ($lang === 'zh') echo '快速服务';
                    else echo 'Dịch vụ nhanh';
                    ?>
                </h3>
                <p style="color: var(--color-gray);">
                    <?php
                    if ($lang === 'en') echo 'Quick turnaround time for all services';
                    elseif ($lang === 'zh') echo '所有服务快速周转';
                    else echo 'Thời gian xử lý nhanh chóng';
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center;">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">🔒</div>
                <h3 style="margin-bottom: var(--spacing-sm);">
                    <?php
                    if ($lang === 'en') echo 'Secure & Safe';
                    elseif ($lang === 'zh') echo '安全可靠';
                    else echo 'An toàn bảo mật';
                    ?>
                </h3>
                <p style="color: var(--color-gray);">
                    <?php
                    if ($lang === 'en') echo 'Your data is always protected';
                    elseif ($lang === 'zh') echo '您的数据始终受到保护';
                    else echo 'Dữ liệu của bạn luôn được bảo vệ';
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center;">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">💰</div>
                <h3 style="margin-bottom: var(--spacing-sm);">
                    <?php
                    if ($lang === 'en') echo 'Best Prices';
                    elseif ($lang === 'zh') echo '最优价格';
                    else echo 'Giá tốt nhất';
                    ?>
                </h3>
                <p style="color: var(--color-gray);">
                    <?php
                    if ($lang === 'en') echo 'Competitive pricing guaranteed';
                    elseif ($lang === 'zh') echo '保证有竞争力的价格';
                    else echo 'Đảm bảo giá cạnh tranh';
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center;">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">🌟</div>
                <h3 style="margin-bottom: var(--spacing-sm);">24/7</h3>
                <p style="color: var(--color-gray);">
                    <?php
                    if ($lang === 'en') echo 'Round the clock support';
                    elseif ($lang === 'zh') echo '全天候支持';
                    else echo 'Hỗ trợ 24/7';
                    ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Blog Posts -->
<?php
$blog_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
));

if ($blog_posts->have_posts()) :
    ?>
    <section class="blog-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    <?php
                    if ($lang === 'en') echo 'Latest News';
                    elseif ($lang === 'zh') echo '最新消息';
                    else echo 'Tin Tức Mới Nhất';
                    ?>
                </h2>
            </div>

            <div class="blog-grid">
                <?php
                while ($blog_posts->have_posts()) : $blog_posts->the_post();
                    ?>
                    <article class="blog-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('gsm-blog-thumb', array('class' => 'blog-image')); ?>
                        <?php else : ?>
                            <div class="blog-image">📰</div>
                        <?php endif; ?>

                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                            </div>

                            <h3 class="blog-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <p class="blog-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                                <?php echo gsm_t('read_more'); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
