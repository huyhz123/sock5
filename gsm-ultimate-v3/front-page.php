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

<!-- WooCommerce Products Section -->
<section class="products-section" id="products">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                <?php
                if ($lang === 'en') echo 'Our Products';
                elseif ($lang === 'zh') echo '我们的产品';
                else echo 'Sản Phẩm Của Chúng Tôi';
                ?>
            </h2>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Browse our wide selection of phones, services, and accessories';
                elseif ($lang === 'zh') echo '浏览我们广泛的手机、服务和配件选择';
                else echo 'Khám phá các sản phẩm điện thoại, dịch vụ và phụ kiện';
                ?>
            </p>
        </div>

        <?php
        // Display WooCommerce Product Categories
        if (class_exists('WooCommerce')) :
            $product_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'exclude' => array(get_option('default_product_cat')), // Exclude "Uncategorized"
            ));

            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                ?>
                <div class="section-filters">
                    <button class="filter-btn active" data-category="*">
                        <?php
                        if ($lang === 'en') echo 'All Products';
                        elseif ($lang === 'zh') echo '所有产品';
                        else echo 'Tất cả';
                        ?>
                    </button>
                    <?php foreach ($product_categories as $category) : ?>
                        <button class="filter-btn" data-category=".cat-<?php echo esc_attr($category->slug); ?>">
                            <?php echo esc_html($category->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="products-grid">
                <?php
                // Get WooCommerce products
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 12,
                    'orderby' => 'date',
                    'order' => 'DESC',
                );

                $products = new WP_Query($args);

                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        global $product;

                        // Get product categories
                        $terms = get_the_terms(get_the_ID(), 'product_cat');
                        $cat_classes = '';
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                $cat_classes .= ' cat-' . $term->slug;
                            }
                        }
                        ?>
                        <article class="product-card<?php echo esc_attr($cat_classes); ?>">
                            <?php if ($product->is_on_sale()) : ?>
                                <span class="product-badge">
                                    <?php
                                    $percentage = 0;
                                    if ($product->get_regular_price() && $product->get_sale_price()) {
                                        $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
                                    }
                                    echo $percentage > 0 ? '-' . $percentage . '%' : esc_html__('Sale', 'gsm-ultimate');
                                    ?>
                                </span>
                            <?php endif; ?>

                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('woocommerce_thumbnail'); ?>
                                    <?php else : ?>
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 80px;">📦</div>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="product-content">
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'product_cat');
                                if ($categories && !is_wp_error($categories)) :
                                    $category = array_shift($categories);
                                    ?>
                                    <div class="product-category">
                                        <?php echo esc_html($category->name); ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="product-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <p class="product-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </p>

                                <div class="product-meta">
                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>

                                    <?php if ($product->is_in_stock()) : ?>
                                        <span class="product-stock in-stock">
                                            <?php
                                            if ($lang === 'en') echo 'In Stock';
                                            elseif ($lang === 'zh') echo '有货';
                                            else echo 'Còn hàng';
                                            ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="product-stock out-of-stock">
                                            <?php
                                            if ($lang === 'en') echo 'Out of Stock';
                                            elseif ($lang === 'zh') echo '缺货';
                                            else echo 'Hết hàng';
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                       class="btn btn-primary btn-block add_to_cart_button ajax_add_to_cart"
                                       data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                       data-quantity="1">
                                        <i class="fas fa-shopping-cart"></i>
                                        <?php echo esc_html($product->add_to_cart_text()); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-block">
                                        <i class="fas fa-eye"></i>
                                        <?php
                                        if ($lang === 'en') echo 'View Details';
                                        elseif ($lang === 'zh') echo '查看详情';
                                        else echo 'Xem chi tiết';
                                        ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                        <div style="font-size: 80px; margin-bottom: var(--sp-4);">📦</div>
                        <h3 style="color: var(--gray-500); margin-bottom: var(--sp-2);">
                            <?php
                            if ($lang === 'en') echo 'No products available';
                            elseif ($lang === 'zh') echo '暂无产品';
                            else echo 'Chưa có sản phẩm';
                            ?>
                        </h3>
                        <p style="color: var(--gray-400);">
                            <?php
                            if ($lang === 'en') echo 'Please check back later for new products!';
                            elseif ($lang === 'zh') echo '请稍后查看新产品！';
                            else echo 'Vui lòng quay lại sau để xem sản phẩm mới!';
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <div style="text-align: center; margin-top: var(--sp-8);">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-outline btn-lg">
                    <?php
                    if ($lang === 'en') echo 'View All Products';
                    elseif ($lang === 'zh') echo '查看所有产品';
                    else echo 'Xem tất cả sản phẩm';
                    ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        <?php else : ?>
            <div style="text-align: center; padding: 60px 20px;">
                <p style="color: var(--gray-500);">
                    <?php
                    if ($lang === 'en') echo 'WooCommerce is not installed. Please install WooCommerce to display products.';
                    elseif ($lang === 'zh') echo '未安装WooCommerce。请安装WooCommerce以显示产品。';
                    else echo 'WooCommerce chưa được cài đặt. Vui lòng cài WooCommerce để hiển thị sản phẩm.';
                    ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Features Section -->
<section class="products-section" style="background:var(--bg);">
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
            <div class="card card-neu" style="padding:var(--sp-8);text-align:center;">
                <div style="font-size:64px;margin-bottom:var(--sp-4);">⚡</div>
                <h3 style="font-size:var(--text-2xl);font-weight:700;margin-bottom:var(--sp-3);color:var(--black);">
                    <?php
                    if ($lang === 'en') echo 'Fast Service';
                    elseif ($lang === 'zh') echo '快速服务';
                    else echo 'Dịch vụ nhanh';
                    ?>
                </h3>
                <p style="color:var(--text-light);font-size:var(--text-base);line-height:1.6;">
                    <?php
                    if ($lang === 'en') echo 'Quick turnaround time for all services';
                    elseif ($lang === 'zh') echo '所有服务快速周转';
                    else echo 'Thời gian xử lý nhanh chóng';
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding:var(--sp-8);text-align:center;">
                <div style="font-size:64px;margin-bottom:var(--sp-4);">🔒</div>
                <h3 style="font-size:var(--text-2xl);font-weight:700;margin-bottom:var(--sp-3);color:var(--black);">
                    <?php
                    if ($lang === 'en') echo 'Secure & Safe';
                    elseif ($lang === 'zh') echo '安全可靠';
                    else echo 'An toàn bảo mật';
                    ?>
                </h3>
                <p style="color:var(--text-light);font-size:var(--text-base);line-height:1.6;">
                    <?php
                    if ($lang === 'en') echo 'Your data is always protected';
                    elseif ($lang === 'zh') echo '您的数据始终受到保护';
                    else echo 'Dữ liệu của bạn luôn được bảo vệ';
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding:var(--sp-8);text-align:center;">
                <div style="font-size:64px;margin-bottom:var(--sp-4);">💰</div>
                <h3 style="font-size:var(--text-2xl);font-weight:700;margin-bottom:var(--sp-3);color:var(--black);">
                    <?php
                    if ($lang === 'en') echo 'Best Prices';
                    elseif ($lang === 'zh') echo '最优价格';
                    else echo 'Giá tốt nhất';
                    ?>
                </h3>
                <p style="color:var(--text-light);font-size:var(--text-base);line-height:1.6;">
                    <?php
                    if ($lang === 'en') echo 'Competitive pricing guaranteed';
                    elseif ($lang === 'zh') echo '保证有竞争力的价格';
                    else echo 'Đảm bảo giá cạnh tranh';
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding:var(--sp-8);text-align:center;">
                <div style="font-size:64px;margin-bottom:var(--sp-4);">🌟</div>
                <h3 style="font-size:var(--text-2xl);font-weight:700;margin-bottom:var(--sp-3);color:var(--black);">24/7</h3>
                <p style="color:var(--text-light);font-size:var(--text-base);line-height:1.6;">
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
