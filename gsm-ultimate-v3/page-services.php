<?php
/**
 * Template Name: Services Page
 * Description: Dedicated template for showcasing all GSM services
 */

get_header();

$lang = gsm_get_current_language();
?>

<section class="products-section" style="padding-top: 60px;">
    <div class="container">
        <!-- Page Header -->
        <div class="section-header">
            <h1 class="section-title">
                <?php
                if ($lang === 'en') echo 'Our Services';
                elseif ($lang === 'zh') echo '我们的服务';
                else echo 'Dịch Vụ Của Chúng Tôi';
                ?>
            </h1>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Professional GSM services at competitive prices';
                elseif ($lang === 'zh') echo '专业的GSM服务，价格实惠';
                else echo 'Dịch vụ GSM chuyên nghiệp với giá cạnh tranh';
                ?>
            </p>
        </div>

        <!-- Service Categories -->
        <div class="grid grid-4" style="margin-bottom: var(--spacing-xl);">
            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center; cursor: pointer;" onclick="location.href='<?php echo esc_url(get_post_type_archive_link('gsm_service')); ?>'">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">🔧</div>
                <h3 style="margin-bottom: var(--spacing-sm);">
                    <?php echo gsm_t('services'); ?>
                </h3>
                <p style="color: var(--color-gray); font-size: 14px;">
                    <?php
                    $count = wp_count_posts('gsm_service');
                    echo $count->publish . ' ' . ($lang === 'en' ? 'services' : ($lang === 'zh' ? '项服务' : 'dịch vụ'));
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center; cursor: pointer;" onclick="location.href='<?php echo esc_url(get_post_type_archive_link('gsm_account')); ?>'">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">👤</div>
                <h3 style="margin-bottom: var(--spacing-sm);">
                    <?php echo gsm_t('accounts'); ?>
                </h3>
                <p style="color: var(--color-gray); font-size: 14px;">
                    <?php
                    $count = wp_count_posts('gsm_account');
                    echo $count->publish . ' ' . ($lang === 'en' ? 'accounts' : ($lang === 'zh' ? '个账户' : 'tài khoản'));
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center; cursor: pointer;" onclick="location.href='<?php echo esc_url(get_post_type_archive_link('gsm_phone')); ?>'">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">📱</div>
                <h3 style="margin-bottom: var(--spacing-sm);">
                    <?php echo gsm_t('phones'); ?>
                </h3>
                <p style="color: var(--color-gray); font-size: 14px;">
                    <?php
                    $count = wp_count_posts('gsm_phone');
                    echo $count->publish . ' ' . ($lang === 'en' ? 'phones' : ($lang === 'zh' ? '部手机' : 'điện thoại'));
                    ?>
                </p>
            </div>

            <div class="card card-neu" style="padding: var(--spacing-lg); text-align: center; cursor: pointer;" onclick="location.href='<?php echo esc_url(get_post_type_archive_link('gsm_part')); ?>'">
                <div style="font-size: 48px; margin-bottom: var(--spacing-sm);">⚙️</div>
                <h3 style="margin-bottom: var(--spacing-sm);">
                    <?php echo gsm_t('parts'); ?>
                </h3>
                <p style="color: var(--color-gray); font-size: 14px;">
                    <?php
                    $count = wp_count_posts('gsm_part');
                    echo $count->publish . ' ' . ($lang === 'en' ? 'parts' : ($lang === 'zh' ? '个配件' : 'linh kiện'));
                    ?>
                </p>
            </div>
        </div>

        <!-- Featured Services -->
        <h2 class="section-title" style="font-size: 32px; margin-bottom: var(--spacing-lg); margin-top: var(--spacing-xl);">
            <?php
            if ($lang === 'en') echo 'Featured Services';
            elseif ($lang === 'zh') echo '特色服务';
            else echo 'Dịch Vụ Nổi Bật';
            ?>
        </h2>

        <div class="products-grid">
            <?php
            $services = new WP_Query(array(
                'post_type' => 'gsm_service',
                'posts_per_page' => 9,
                'orderby' => 'date',
                'order' => 'DESC',
            ));

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $price = get_post_meta(get_the_ID(), '_gsm_price', true);
                    $price_old = get_post_meta(get_the_ID(), '_gsm_price_old', true);
                    $stock = get_post_meta(get_the_ID(), '_gsm_stock', true);
                    ?>
                    <article class="product-card">
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
                                        🔧
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-content">
                            <div class="product-category">Service</div>

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
                wp_reset_postdata();
            else :
                ?>
                <p style="grid-column: 1 / -1; text-align: center; color: var(--color-gray-light);">
                    <?php
                    if ($lang === 'en') echo 'No services available yet.';
                    elseif ($lang === 'zh') echo '暂无服务。';
                    else echo 'Chưa có dịch vụ.';
                    ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Why Choose Us -->
        <div class="card" style="margin-top: var(--spacing-xxl); padding: var(--spacing-xl); background: var(--gradient-bright);">
            <h2 style="text-align: center; margin-bottom: var(--spacing-lg); font-size: 36px;">
                <?php
                if ($lang === 'en') echo 'Why Choose Our Services?';
                elseif ($lang === 'zh') echo '为什么选择我们的服务？';
                else echo 'Tại Sao Chọn Dịch Vụ Của Chúng Tôi?';
                ?>
            </h2>

            <div class="grid grid-3">
                <div style="text-align: center; padding: var(--spacing-md);">
                    <div style="font-size: 56px; margin-bottom: var(--spacing-md);">⚡</div>
                    <h3 style="margin-bottom: var(--spacing-sm);">
                        <?php
                        if ($lang === 'en') echo 'Fast Service';
                        elseif ($lang === 'zh') echo '快速服务';
                        else echo 'Dịch Vụ Nhanh';
                        ?>
                    </h3>
                    <p style="color: var(--color-gray);">
                        <?php
                        if ($lang === 'en') echo 'Quick turnaround time';
                        elseif ($lang === 'zh') echo '快速周转时间';
                        else echo 'Thời gian xử lý nhanh';
                        ?>
                    </p>
                </div>

                <div style="text-align: center; padding: var(--spacing-md);">
                    <div style="font-size: 56px; margin-bottom: var(--spacing-md);">✅</div>
                    <h3 style="margin-bottom: var(--spacing-sm);">
                        <?php
                        if ($lang === 'en') echo 'Guaranteed';
                        elseif ($lang === 'zh') echo '保证';
                        else echo 'Đảm Bảo';
                        ?>
                    </h3>
                    <p style="color: var(--color-gray);">
                        <?php
                        if ($lang === 'en') echo '100% success guarantee';
                        elseif ($lang === 'zh') echo '100%成功保证';
                        else echo '100% đảm bảo thành công';
                        ?>
                    </p>
                </div>

                <div style="text-align: center; padding: var(--spacing-md);">
                    <div style="font-size: 56px; margin-bottom: var(--spacing-md);">💰</div>
                    <h3 style="margin-bottom: var(--spacing-sm);">
                        <?php
                        if ($lang === 'en') echo 'Best Price';
                        elseif ($lang === 'zh') echo '最优价格';
                        else echo 'Giá Tốt Nhất';
                        ?>
                    </h3>
                    <p style="color: var(--color-gray);">
                        <?php
                        if ($lang === 'en') echo 'Competitive pricing';
                        elseif ($lang === 'zh') echo '有竞争力的价格';
                        else echo 'Giá cạnh tranh';
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <?php while (have_posts()) : the_post(); ?>
            <?php if (get_the_content()) : ?>
                <div class="card" style="padding: var(--spacing-xl); margin-top: var(--spacing-xl);">
                    <div class="page-content" style="color: var(--color-gray-dark); line-height: 1.8;">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>

    </div>
</section>

<?php get_footer(); ?>
