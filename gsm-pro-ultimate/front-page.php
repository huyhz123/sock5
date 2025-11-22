<?php get_header(); ?>

<!-- Professional Hero Banner -->
<section class="hero-banner">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">
                <?php echo esc_html(get_theme_mod('gsm_banner_title', 'Professional GSM Services')); ?>
            </h1>
            <p class="hero-subtitle">
                <?php echo esc_html(get_theme_mod('gsm_banner_subtitle', 'Unlock, IMEI, Accounts, Phones & Parts')); ?>
            </p>

            <div class="hero-features">
                <div class="hero-feature">
                    <i class="fas fa-check-circle"></i> <?php
                    $lang = gsm_get_current_language();
                    if ($lang === 'en') echo '100% Success Rate';
                    elseif ($lang === 'zh') echo '100%成功率';
                    else echo '100% Thành công';
                    ?>
                </div>
                <div class="hero-feature">
                    <i class="fas fa-shield-alt"></i> <?php
                    if ($lang === 'en') echo 'Secure & Safe';
                    elseif ($lang === 'zh') echo '安全可靠';
                    else echo 'An toàn & Bảo mật';
                    ?>
                </div>
                <div class="hero-feature">
                    <i class="fas fa-headset"></i> <?php
                    if ($lang === 'en') echo '24/7 Support';
                    elseif ($lang === 'zh') echo '24/7支持';
                    else echo 'Hỗ trợ 24/7';
                    ?>
                </div>
            </div>

            <div class="hero-buttons">
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-tools"></i> <?php echo gsm_t('services'); ?>
                </a>
                <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-secondary btn-lg">
                    <i class="fas fa-phone-alt"></i> <?php echo gsm_t('call_now'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="products-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo gsm_t('services'); ?></h2>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Professional unlocking and IMEI services';
                elseif ($lang === 'zh') echo '专业解锁和IMEI服务';
                else echo 'Dịch vụ unlock và IMEI chuyên nghiệp';
                ?>
            </p>
        </div>

        <div class="products-grid">
            <?php
            $services = new WP_Query(array(
                'post_type' => 'gsm_service',
                'posts_per_page' => 4,
            ));

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    get_template_part('template-parts/product', 'card');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo esc_url(get_post_type_archive_link('gsm_service')); ?>" class="btn btn-secondary btn-lg">
                <?php echo gsm_t('view_details'); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Accounts Section -->
<section class="products-section" style="background: var(--color-white);">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo gsm_t('accounts'); ?></h2>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Premium gaming and social accounts';
                elseif ($lang === 'zh') echo '优质游戏和社交账户';
                else echo 'Tài khoản gaming và mạng xã hội cao cấp';
                ?>
            </p>
        </div>

        <div class="products-grid">
            <?php
            $accounts = new WP_Query(array(
                'post_type' => 'gsm_account',
                'posts_per_page' => 4,
            ));

            if ($accounts->have_posts()) :
                while ($accounts->have_posts()) : $accounts->the_post();
                    get_template_part('template-parts/product', 'card');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo esc_url(get_post_type_archive_link('gsm_account')); ?>" class="btn btn-secondary btn-lg">
                <?php echo gsm_t('view_details'); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Phones Section -->
<section class="products-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo gsm_t('phones'); ?></h2>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'New and pre-owned smartphones';
                elseif ($lang === 'zh') echo '全新和二手智能手机';
                else echo 'Điện thoại mới và cũ';
                ?>
            </p>
        </div>

        <div class="products-grid">
            <?php
            $phones = new WP_Query(array(
                'post_type' => 'gsm_phone',
                'posts_per_page' => 4,
            ));

            if ($phones->have_posts()) :
                while ($phones->have_posts()) : $phones->the_post();
                    get_template_part('template-parts/product', 'card');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo esc_url(get_post_type_archive_link('gsm_phone')); ?>" class="btn btn-secondary btn-lg">
                <?php echo gsm_t('view_details'); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Parts Section -->
<section class="products-section" style="background: var(--color-white);">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo gsm_t('parts'); ?></h2>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Original and high-quality replacement parts';
                elseif ($lang === 'zh') echo '原装和高品质替换配件';
                else echo 'Linh kiện chính hãng và chất lượng cao';
                ?>
            </p>
        </div>

        <div class="products-grid">
            <?php
            $parts = new WP_Query(array(
                'post_type' => 'gsm_part',
                'posts_per_page' => 4,
            ));

            if ($parts->have_posts()) :
                while ($parts->have_posts()) : $parts->the_post();
                    get_template_part('template-parts/product', 'card');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo esc_url(get_post_type_archive_link('gsm_part')); ?>" class="btn btn-secondary btn-lg">
                <?php echo gsm_t('view_details'); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo gsm_t('latest_posts'); ?></h2>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Latest news and guides';
                elseif ($lang === 'zh') echo '最新新闻和指南';
                else echo 'Tin tức và hướng dẫn mới nhất';
                ?>
            </p>
        </div>

        <div class="blog-grid">
            <?php
            $blog_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
            ));

            if ($blog_posts->have_posts()) :
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

                            <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>

                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                                <?php echo gsm_t('read_more'); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="hero-banner" style="padding: 60px 0;">
    <div class="container">
        <div class="hero-content">
            <h2 class="hero-title" style="font-size: 36px;">
                <?php
                if ($lang === 'en') echo 'Need Help?';
                elseif ($lang === 'zh') echo '需要帮助？';
                else echo 'Cần Hỗ Trợ?';
                ?>
            </h2>
            <p class="hero-subtitle">
                <?php
                if ($lang === 'en') echo 'Contact us via phone, WhatsApp, Zalo or Telegram';
                elseif ($lang === 'zh') echo '通过电话、WhatsApp、Zalo或Telegram联系我们';
                else echo 'Liên hệ qua điện thoại, WhatsApp, Zalo hoặc Telegram';
                ?>
            </p>
            <div class="hero-buttons">
                <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-phone-alt"></i> <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>
                </a>
                <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" class="btn btn-secondary btn-lg">
                    <i class="fab fa-telegram-plane"></i> <?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
