<?php get_header(); ?>

<section class="services-section" style="padding-top: 60px;">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $price = get_post_meta(get_the_ID(), '_gsm_price', true);
                $delivery_time = get_post_meta(get_the_ID(), '_gsm_delivery_time', true);
                $success_rate = get_post_meta(get_the_ID(), '_gsm_success_rate', true);
                $categories = get_the_terms(get_the_ID(), 'service_category');
                ?>
                <div style="max-width: 1000px; margin: 0 auto;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 40px;">
                        <!-- Service Image/Icon -->
                        <div>
                            <?php if (has_post_thumbnail()) : ?>
                                <div style="border-radius: var(--radius); overflow: hidden; margin-bottom: 20px;">
                                    <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                                </div>
                            <?php else : ?>
                                <div style="background: var(--dark-tertiary); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 80px; text-align: center; font-size: 120px; margin-bottom: 20px;">
                                    <?php
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

                            <!-- Service Info -->
                            <div style="background: var(--dark-tertiary); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 30px;">
                                <h3 style="color: var(--secondary-color); margin-bottom: 20px; font-size: 20px;">Thông Tin Dịch Vụ</h3>

                                <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                                    <div style="color: var(--text-secondary); margin-bottom: 5px;">Giá dịch vụ</div>
                                    <div style="font-size: 32px; font-weight: 700; color: var(--secondary-color);">
                                        <?php echo gsm_format_price($price); ?>
                                    </div>
                                </div>

                                <?php if ($delivery_time) : ?>
                                    <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                                        <div style="color: var(--text-secondary); margin-bottom: 5px;">
                                            <i class="far fa-clock"></i> Thời gian xử lý
                                        </div>
                                        <div style="font-size: 18px; font-weight: 600; color: var(--text-color);">
                                            <?php echo esc_html($delivery_time); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($success_rate) : ?>
                                    <div style="margin-bottom: 20px;">
                                        <div style="color: var(--text-secondary); margin-bottom: 5px;">
                                            <i class="fas fa-check-circle"></i> Tỷ lệ thành công
                                        </div>
                                        <div style="font-size: 18px; font-weight: 600; color: var(--success-color);">
                                            <?php echo esc_html($success_rate); ?>%
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <a href="tel:<?php echo esc_attr(gsm_get_contact('hotline')); ?>" class="btn btn-primary btn-block btn-lg" style="margin-top: 20px;">
                                    <i class="fas fa-phone-alt"></i> Đặt dịch vụ ngay
                                </a>
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div>
                            <h1 class="section-title" style="text-align: left; font-size: 32px; margin-bottom: 15px;">
                                <?php the_title(); ?>
                            </h1>

                            <?php if ($categories && !is_wp_error($categories)) : ?>
                                <div style="margin-bottom: 20px;">
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo esc_url(get_term_link($category)); ?>"
                                           style="display: inline-block; background: var(--secondary-color); color: #000; padding: 6px 15px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-right: 10px;">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="service-content" style="color: var(--text-secondary); line-height: 1.8; font-size: 17px; margin-bottom: 30px;">
                                <?php the_content(); ?>
                            </div>

                            <!-- Features -->
                            <div style="background: var(--dark-tertiary); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 30px; margin-bottom: 30px;">
                                <h3 style="color: var(--secondary-color); margin-bottom: 20px; font-size: 20px;">
                                    <i class="fas fa-star"></i> Đặc Điểm Nổi Bật
                                </h3>
                                <ul style="list-style: none; padding: 0;">
                                    <li style="padding: 10px 0; border-bottom: 1px solid var(--border-color);">
                                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 10px;"></i>
                                        Tỷ lệ thành công cao
                                    </li>
                                    <li style="padding: 10px 0; border-bottom: 1px solid var(--border-color);">
                                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 10px;"></i>
                                        Bảo mật thông tin tuyệt đối
                                    </li>
                                    <li style="padding: 10px 0; border-bottom: 1px solid var(--border-color);">
                                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 10px;"></i>
                                        Hỗ trợ 24/7
                                    </li>
                                    <li style="padding: 10px 0; border-bottom: 1px solid var(--border-color);">
                                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 10px;"></i>
                                        Bảo hành trọn đời
                                    </li>
                                    <li style="padding: 10px 0;">
                                        <i class="fas fa-check" style="color: var(--success-color); margin-right: 10px;"></i>
                                        Giá cả cạnh tranh
                                    </li>
                                </ul>
                            </div>

                            <!-- Contact Methods -->
                            <div style="background: var(--gradient-secondary); border-radius: var(--radius); padding: 30px; color: #000;">
                                <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 700;">Liên Hệ Ngay</h3>
                                <p style="margin-bottom: 20px; font-size: 16px;">Chọn kênh liên hệ phù hợp với bạn:</p>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <a href="tel:<?php echo esc_attr(gsm_get_contact('hotline')); ?>" class="btn btn-secondary">
                                        <i class="fas fa-phone-alt"></i> Hotline
                                    </a>
                                    <a href="https://wa.me/<?php echo str_replace('+', '', gsm_get_contact('whatsapp')); ?>" target="_blank" class="btn btn-secondary">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                    <a href="https://zalo.me/<?php echo str_replace('+', '', gsm_get_contact('zalo')); ?>" target="_blank" class="btn btn-secondary">
                                        <strong>Z</strong> Zalo
                                    </a>
                                    <a href="https://t.me/<?php echo ltrim(gsm_get_contact('telegram'), '@'); ?>" target="_blank" class="btn btn-secondary">
                                        <i class="fab fa-telegram-plane"></i> Telegram
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Services -->
                <div style="margin-top: 60px; padding-top: 40px; border-top: 2px solid var(--border-color);">
                    <h3 class="section-title" style="font-size: 28px; margin-bottom: 30px;">Dịch Vụ Liên Quan</h3>
                    <div class="services-grid">
                        <?php
                        if ($categories && !is_wp_error($categories)) {
                            $category_ids = array();
                            foreach ($categories as $category) {
                                $category_ids[] = $category->term_id;
                            }

                            $related = new WP_Query(array(
                                'post_type' => 'gsm_service',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'service_category',
                                        'field' => 'term_id',
                                        'terms' => $category_ids,
                                    ),
                                ),
                                'post__not_in' => array(get_the_ID()),
                                'posts_per_page' => 3,
                                'orderby' => 'rand',
                            ));

                            if ($related->have_posts()) :
                                while ($related->have_posts()) : $related->the_post();
                                    $rel_price = get_post_meta(get_the_ID(), '_gsm_price', true);
                                    $rel_delivery = get_post_meta(get_the_ID(), '_gsm_delivery_time', true);
                                    ?>
                                    <div class="service-card">
                                        <div class="service-icon">📱</div>
                                        <h4 class="service-title"><?php the_title(); ?></h4>
                                        <p class="service-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                        <div class="service-price"><?php echo gsm_format_price($rel_price); ?></div>
                                        <?php if ($rel_delivery) : ?>
                                            <p style="color: var(--text-secondary); margin-bottom: 20px;">
                                                <i class="far fa-clock"></i> <?php echo esc_html($rel_delivery); ?>
                                            </p>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">Xem chi tiết</a>
                                    </div>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p style="color: var(--text-secondary);">Không có dịch vụ liên quan.</p>';
                            endif;
                        }
                        ?>
                    </div>
                </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>

<style>
@media (max-width: 768px) {
    .services-section > .container > div > div:first-child {
        grid-template-columns: 1fr !important;
    }
}
</style>
