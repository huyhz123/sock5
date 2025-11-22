<?php get_header(); ?>

<section class="services-section" style="padding-top: 60px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">
                <?php
                if (is_tax('service_category')) {
                    single_term_title();
                } else {
                    echo 'Tất Cả Dịch Vụ';
                }
                ?>
            </h1>
            <p class="section-subtitle">
                <?php
                if (is_tax('service_category')) {
                    echo term_description();
                } else {
                    echo 'Các dịch vụ unlock điện thoại chuyên nghiệp';
                }
                ?>
            </p>
        </div>

        <!-- Filter by Category -->
        <div class="service-filters" style="margin-bottom: 40px; text-align: center;">
            <a href="<?php echo esc_url(get_post_type_archive_link('gsm_service')); ?>"
               class="btn btn-sm <?php echo !is_tax() ? 'btn-primary' : 'btn-secondary'; ?>"
               style="margin: 5px;">
                Tất cả
            </a>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'service_category',
                'hide_empty' => true,
            ));

            foreach ($categories as $category) :
                $is_active = is_tax('service_category', $category->slug);
                ?>
                <a href="<?php echo esc_url(get_term_link($category)); ?>"
                   class="btn btn-sm <?php echo $is_active ? 'btn-primary' : 'btn-secondary'; ?>"
                   style="margin: 5px;">
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="services-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $price = get_post_meta(get_the_ID(), '_gsm_price', true);
                    $delivery_time = get_post_meta(get_the_ID(), '_gsm_delivery_time', true);
                    $success_rate = get_post_meta(get_the_ID(), '_gsm_success_rate', true);
                    ?>
                    <div class="service-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div style="margin-bottom: 20px; border-radius: var(--radius); overflow: hidden;">
                                <?php the_post_thumbnail('gsm-service-thumb', array('style' => 'width: 100%; height: auto;')); ?>
                            </div>
                        <?php else : ?>
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
                        <?php endif; ?>

                        <h3 class="service-title"><?php the_title(); ?></h3>

                        <p class="service-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>

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

                // Pagination
                ?>
                <div style="grid-column: 1 / -1; margin-top: 40px; text-align: center;">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-arrow-left"></i> Trước',
                        'next_text' => 'Sau <i class="fas fa-arrow-right"></i>',
                    ));
                    ?>
                </div>
            <?php
            else :
                ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <h2 style="color: var(--text-color); margin-bottom: 15px;">Chưa có dịch vụ nào</h2>
                    <p style="color: var(--text-secondary); margin-bottom: 30px;">
                        Rất tiếc, chúng tôi chưa có dịch vụ trong danh mục này.
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i> Về trang chủ
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="hero-section" style="padding: 60px 0;">
    <div class="container">
        <div class="hero-content">
            <h2 class="hero-title" style="font-size: 32px;">Cần Tư Vấn Dịch Vụ?</h2>
            <p class="hero-subtitle">Liên hệ ngay với chúng tôi để được hỗ trợ</p>
            <div class="hero-buttons">
                <a href="tel:<?php echo esc_attr(gsm_get_contact('hotline')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-phone-alt"></i> Gọi ngay
                </a>
                <a href="https://t.me/<?php echo ltrim(gsm_get_contact('telegram'), '@'); ?>" target="_blank" class="btn btn-secondary btn-lg">
                    <i class="fab fa-telegram-plane"></i> Telegram
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
