<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <!-- About Widget -->
            <div class="footer-widget">
                <h3><?php echo gsm_t('about'); ?></h3>
                <p>
                    <?php
                    $lang = gsm_get_current_language();
                    if ($lang === 'en') {
                        echo 'Professional GSM services - IMEI unlock, phone repair, accounts & more. Contact us 24/7.';
                    } elseif ($lang === 'zh') {
                        echo '专业GSM服务 - IMEI解锁、手机维修、账户等。24/7联系我们。';
                    } else {
                        echo 'Dịch vụ GSM chuyên nghiệp - Mở khóa IMEI, sửa chữa điện thoại, tài khoản & nhiều hơn nữa. Liên hệ 24/7.';
                    }
                    ?>
                </p>
                <div class="footer-logo" style="font-size: 48px; font-weight: 900; background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-top: var(--spacing-sm);">
                    <?php echo esc_html(get_theme_mod('gsm_logo_text', 'Hz')); ?>
                </div>
            </div>

            <!-- Quick Links Widget -->
            <div class="footer-widget">
                <h3><?php echo gsm_t('services'); ?></h3>
                <ul>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_service')); ?>"><?php echo gsm_t('services'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_account')); ?>"><?php echo gsm_t('accounts'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_phone')); ?>"><?php echo gsm_t('phones'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_part')); ?>"><?php echo gsm_t('parts'); ?></a></li>
                </ul>
            </div>

            <!-- Contact Widget -->
            <div class="footer-widget">
                <h3><?php echo gsm_t('contact'); ?></h3>
                <ul>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>">
                            <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>
                        </a>
                    </li>
                    <li>
                        <i class="fab fa-telegram-plane"></i>
                        <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank">
                            <?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?>
                        </a>
                    </li>
                    <li>
                        <i class="far fa-envelope"></i>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('gsm_email', 'contact@hzgsm.com')); ?>">
                            <?php echo esc_html(get_theme_mod('gsm_email', 'contact@hzgsm.com')); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Social Media Widget -->
            <div class="footer-widget">
                <h3>
                    <?php
                    $lang = gsm_get_current_language();
                    if ($lang === 'en') echo 'Connect With Us';
                    elseif ($lang === 'zh') echo '联系我们';
                    else echo 'Kết Nối';
                    ?>
                </h3>
                <ul>
                    <li>
                        <a href="https://wa.me/<?php echo str_replace('+', '', get_theme_mod('gsm_whatsapp', GSM_HOTLINE)); ?>" target="_blank">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </li>
                    <li>
                        <a href="https://zalo.me/<?php echo str_replace('+', '', get_theme_mod('gsm_zalo', GSM_HOTLINE)); ?>" target="_blank">
                            <strong>Z</strong> Zalo
                        </a>
                    </li>
                    <li>
                        <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank">
                            <i class="fab fa-telegram-plane"></i> Telegram
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php
                $lang = gsm_get_current_language();
                if ($lang === 'en') echo 'All rights reserved.';
                elseif ($lang === 'zh') echo '版权所有。';
                else echo 'Tất cả quyền được bảo lưu.';
                ?>
                |
                <?php
                if ($lang === 'en') echo 'Contact:';
                elseif ($lang === 'zh') echo '联系：';
                else echo 'Liên hệ:';
                ?>
                <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?> | <?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?>
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
