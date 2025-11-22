<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Dịch Vụ Unlock Điện Thoại Uy Tín #1</h1>
            <p class="hero-subtitle">
                Chuyên unlock iPhone, Samsung - Tỷ lệ thành công cao - Bảo hành trọn đời
            </p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-mobile-alt"></i> Xem dịch vụ
                </a>
                <a href="tel:<?php echo esc_attr(gsm_get_contact('hotline')); ?>" class="btn btn-secondary btn-lg">
                    <i class="fas fa-phone-alt"></i> Gọi ngay: <?php echo esc_html(gsm_get_contact('hotline')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Dịch Vụ Của Chúng Tôi</h2>
            <p class="section-subtitle">Các dịch vụ unlock điện thoại chuyên nghiệp</p>
        </div>

        <div class="services-grid">
            <?php
            $services = new WP_Query(array(
                'post_type' => 'gsm_service',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
            ));

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $price = get_post_meta(get_the_ID(), '_gsm_price', true);
                    $delivery_time = get_post_meta(get_the_ID(), '_gsm_delivery_time', true);
                    $success_rate = get_post_meta(get_the_ID(), '_gsm_success_rate', true);
                    ?>
                    <div class="service-card">
                        <div class="service-icon">
                            <?php
                            $categories = get_the_terms(get_the_ID(), 'service_category');
                            if ($categories && !is_wp_error($categories)) {
                                $cat_name = $categories[0]->name;
                                if (strpos($cat_name, 'iPhone') !== false) echo '🍎';
                                elseif (strpos($cat_name, 'Samsung') !== false) echo '📱';
                                elseif (strpos($cat_name, 'IMEI') !== false) echo '🔍';
                                elseif (strpos($cat_name, 'iCloud') !== false) echo '☁️';
                                else echo '📲';
                            } else {
                                echo '📲';
                            }
                            ?>
                        </div>
                        <h3 class="service-title"><?php the_title(); ?></h3>
                        <p class="service-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        <div class="service-price"><?php echo gsm_format_price($price); ?></div>
                        <?php if ($delivery_time) : ?>
                            <p style="color: var(--text-secondary); margin-bottom: 10px;">
                                <i class="far fa-clock"></i> Thời gian: <?php echo esc_html($delivery_time); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($success_rate) : ?>
                            <p style="color: var(--success-color); margin-bottom: 20px;">
                                <i class="fas fa-check-circle"></i> Tỷ lệ thành công: <?php echo esc_html($success_rate); ?>%
                            </p>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                            Xem chi tiết
                        </a>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p style="color: var(--text-secondary); grid-column: 1 / -1; text-align: center;">
                    Đang cập nhật dịch vụ...
                </p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-secondary btn-lg">
                Xem tất cả dịch vụ <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="services-section" style="background: var(--primary-color);">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Tại Sao Chọn Chúng Tôi?</h2>
            <p class="section-subtitle">Những lý do bạn nên tin tưởng</p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">✅</div>
                <h3 class="service-title">Tỷ Lệ Thành Công Cao</h3>
                <p class="service-description">
                    Tỷ lệ unlock thành công lên đến 98-100% tùy theo từng dòng máy và dịch vụ.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">⚡</div>
                <h3 class="service-title">Xử Lý Nhanh Chóng</h3>
                <p class="service-description">
                    Thời gian xử lý nhanh nhất thị trường, có dịch vụ chỉ từ 1-3 ngày.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">💰</div>
                <h3 class="service-title">Giá Cả Hợp Lý</h3>
                <p class="service-description">
                    Giá cạnh tranh nhất, minh bạch, không phát sinh chi phí ẩn.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">🔒</div>
                <h3 class="service-title">Bảo Mật Tuyệt Đối</h3>
                <p class="service-description">
                    Thông tin khách hàng được bảo mật 100%, cam kết không chia sẻ cho bên thứ ba.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">🛡️</div>
                <h3 class="service-title">Bảo Hành Trọn Đời</h3>
                <p class="service-description">
                    Tất cả dịch vụ unlock đều được bảo hành trọn đời, hỗ trợ miễn phí.
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon">📞</div>
                <h3 class="service-title">Hỗ Trợ 24/7</h3>
                <p class="service-description">
                    Đội ngũ hỗ trợ luôn sẵn sàng 24/7 qua Hotline, Telegram, WhatsApp, Zalo.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Tin Tức & Hướng Dẫn</h2>
            <p class="section-subtitle">Cập nhật kiến thức và tin tức mới nhất</p>
        </div>

        <div class="blog-grid">
            <?php
            $blog_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
            ));

            if ($blog_posts->have_posts()) :
                while ($blog_posts->have_posts()) : $blog_posts->the_post();
                    ?>
                    <article class="blog-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('gsm-blog-thumb'); ?>" alt="<?php the_title(); ?>" class="blog-image">
                        <?php else : ?>
                            <div class="blog-image" style="display: flex; align-items: center; justify-content: center; font-size: 48px;">
                                📱
                            </div>
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
                                Đọc thêm <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p style="color: var(--text-secondary); grid-column: 1 / -1; text-align: center;">
                    Chưa có bài viết nào.
                </p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn btn-secondary btn-lg">
                Xem tất cả bài viết <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <div class="hero-content">
            <h2 class="hero-title" style="font-size: 36px;">Cần Tư Vấn Ngay?</h2>
            <p class="hero-subtitle">
                Liên hệ với chúng tôi qua Hotline, WhatsApp, Zalo hoặc Telegram
            </p>
            <div class="hero-buttons">
                <a href="tel:<?php echo esc_attr(gsm_get_contact('hotline')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-phone-alt"></i> <?php echo esc_html(gsm_get_contact('hotline')); ?>
                </a>
                <a href="https://t.me/<?php echo ltrim(gsm_get_contact('telegram'), '@'); ?>" target="_blank" class="btn btn-secondary btn-lg">
                    <i class="fab fa-telegram-plane"></i> Telegram: <?php echo esc_html(gsm_get_contact('telegram')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
