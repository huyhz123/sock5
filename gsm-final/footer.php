<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <!-- Column 1: About Website -->
            <div class="footer-widget">
                <h3>
                    <?php
                    $lang = gsm_get_current_language();
                    if ($lang === 'en') echo 'About ' . get_bloginfo('name');
                    elseif ($lang === 'zh') echo '关于 ' . get_bloginfo('name');
                    else echo 'Về ' . get_bloginfo('name');
                    ?>
                </h3>

                <!-- Site Name (auto-detected, replaces logo) -->
                <div class="footer-site-name">
                    <?php bloginfo('name'); ?>
                </div>

                <p class="footer-description">
                    <?php
                    if ($lang === 'en') {
                        echo 'We provide professional components and repair services for reliable mobile devices in TP.HCM. With over 10 years of experience, we are committed to bringing the best service to customers.';
                    } elseif ($lang === 'zh') {
                        echo '我们提供专业的配件和维修服务，为TP.HCM的可靠移动设备提供服务。凭借10多年的经验，我们致力于为客户带来最好的服务。';
                    } else {
                        echo 'Chuyên cung cấp linh kiện và dịch vụ sửa chữa điện thoại uy tín tại TP.HCM. Với hơn 10 năm kinh nghiệm, chúng tôi tự hào mang đến dịch vụ tốt nhất cho khách hàng.';
                    }
                    ?>
                </p>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="footer-widget">
                <h3>
                    <?php
                    if ($lang === 'en') echo 'Quick Links';
                    elseif ($lang === 'zh') echo '快速链接';
                    else echo 'Liên kết nhanh';
                    ?>
                </h3>
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if ($lang === 'en') echo 'About Us';
                        elseif ($lang === 'zh') echo '关于我们';
                        else echo 'Về chúng tôi';
                        ?>
                    </a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_service')); ?>">
                        <?php
                        if ($lang === 'en') echo 'Repair Services';
                        elseif ($lang === 'zh') echo '维修服务';
                        else echo 'Dịch vụ sửa chữa';
                        ?>
                    </a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_part')); ?>">
                        <?php
                        if ($lang === 'en') echo 'Genuine Parts';
                        elseif ($lang === 'zh') echo '正品配件';
                        else echo 'Linh kiện chính hãng';
                        ?>
                    </a></li>
                    <li><a href="<?php echo esc_url(home_url('/warranty-policy')); ?>">
                        <?php
                        if ($lang === 'en') echo 'Warranty Policy';
                        elseif ($lang === 'zh') echo '保修政策';
                        else echo 'Chính sách bảo hành';
                        ?>
                    </a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                        <?php
                        if ($lang === 'en') echo 'News & Tips';
                        elseif ($lang === 'zh') echo '新闻与技巧';
                        else echo 'Tin tức & Thủ thuật';
                        ?>
                    </a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">
                        <?php echo gsm_t('contact'); ?>
                    </a></li>
                </ul>
            </div>

            <!-- Column 3: Featured Services -->
            <div class="footer-widget">
                <h3>
                    <?php
                    if ($lang === 'en') echo 'Featured Services';
                    elseif ($lang === 'zh') echo '特色服务';
                    else echo 'Dịch vụ nổi bật';
                    ?>
                </h3>
                <ul class="footer-menu">
                    <li><i class="fas fa-check"></i>
                        <?php
                        if ($lang === 'en') echo 'Genuine iPhone Battery Replacement';
                        elseif ($lang === 'zh') echo '正品iPhone电池更换';
                        else echo 'Thay pin iPhone chính hãng';
                        ?>
                    </li>
                    <li><i class="fas fa-check"></i>
                        <?php
                        if ($lang === 'en') echo 'Phone Screen Repair';
                        elseif ($lang === 'zh') echo '手机屏幕维修';
                        else echo 'Ép kính điện thoại';
                        ?>
                    </li>
                    <li><i class="fas fa-check"></i>
                        <?php
                        if ($lang === 'en') echo 'Samsung Screen Replacement';
                        elseif ($lang === 'zh') echo '三星屏幕更换';
                        else echo 'Thay màn hình Samsung';
                        ?>
                    </li>
                    <li><i class="fas fa-check"></i>
                        <?php
                        if ($lang === 'en') echo 'Mainboard Repair';
                        elseif ($lang === 'zh') echo '主板维修';
                        else echo 'Sửa chữa main board';
                        ?>
                    </li>
                    <li><i class="fas fa-check"></i>
                        <?php
                        if ($lang === 'en') echo 'iCloud Unlock';
                        elseif ($lang === 'zh') echo 'iCloud解锁';
                        else echo 'Unlock iCloud';
                        ?>
                    </li>
                    <li><i class="fas fa-check"></i>
                        <?php
                        if ($lang === 'en') echo 'Android ROM Flash';
                        elseif ($lang === 'zh') echo 'Android ROM刷机';
                        else echo 'Nạp ROM Android';
                        ?>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact Info -->
            <div class="footer-widget">
                <h3>
                    <?php
                    if ($lang === 'en') echo 'Contact Information';
                    elseif ($lang === 'zh') echo '联系信息';
                    else echo 'Thông tin liên hệ';
                    ?>
                </h3>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>
                                <?php
                                if ($lang === 'en') echo 'Address:';
                                elseif ($lang === 'zh') echo '地址：';
                                else echo 'Địa chỉ:';
                                ?>
                            </strong>
                            <p>
                                <?php
                                echo get_theme_mod('gsm_address', '436B/65 Đường 3/2, Phường 12, Quận 10, TP.HCM');
                                ?>
                            </p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <strong>Hotline:</strong>
                            <p><a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>">
                                <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>
                            </a></p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email:</strong>
                            <p><a href="mailto:<?php echo esc_attr(get_theme_mod('gsm_email', 'info@' . str_replace(' ', '', strtolower(get_bloginfo('name'))) . '.com')); ?>">
                                <?php echo esc_html(get_theme_mod('gsm_email', 'info@' . str_replace(' ', '', strtolower(get_bloginfo('name'))) . '.com')); ?>
                            </a></p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>
                                <?php
                                if ($lang === 'en') echo 'Working Hours:';
                                elseif ($lang === 'zh') echo '工作时间：';
                                else echo 'Giờ làm việc:';
                                ?>
                            </strong>
                            <p>
                                <?php
                                if ($lang === 'en') echo 'Mon - Sun: 8:00 - 21:00';
                                elseif ($lang === 'zh') echo '周一 - 周日: 8:00 - 21:00';
                                else echo 'Thứ 2 - Chủ nhật: 8:00 - 21:00';
                                ?>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="footer-social">
            <a href="<?php echo esc_url(get_theme_mod('gsm_facebook', 'https://facebook.com')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="<?php echo esc_url(get_theme_mod('gsm_messenger', 'https://m.me')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon messenger">
                <i class="fab fa-facebook-messenger"></i>
            </a>
            <a href="<?php echo esc_url(get_theme_mod('gsm_youtube', 'https://youtube.com')); ?>" target="_blank" rel="noopener noreferrer" class="social-icon youtube">
                <i class="fab fa-youtube"></i>
            </a>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p>
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php
                if ($lang === 'en') echo 'All rights reserved.';
                elseif ($lang === 'zh') echo '版权所有。';
                else echo 'Tất cả quyền được bảo lưu.';
                ?>
            </p>
        </div>
    </div>
</footer>

<!-- Floating Contact Buttons -->
<div class="floating-contact">
    <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="floating-btn phone" title="<?php esc_attr_e('Call us', 'gsm-ultimate'); ?>">
        <i class="fas fa-phone-alt"></i>
    </a>
    <a href="https://wa.me/<?php echo str_replace('+', '', get_theme_mod('gsm_whatsapp', GSM_HOTLINE)); ?>" target="_blank" class="floating-btn whatsapp" title="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="https://zalo.me/<?php echo str_replace('+', '', get_theme_mod('gsm_zalo', GSM_HOTLINE)); ?>" target="_blank" class="floating-btn zalo" title="Zalo">
        <strong>Z</strong>
    </a>
    <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" class="floating-btn telegram" title="Telegram">
        <i class="fab fa-telegram-plane"></i>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
