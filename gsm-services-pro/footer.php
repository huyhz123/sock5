<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <!-- About Widget -->
            <div class="footer-widget">
                <h3>Về chúng tôi</h3>
                <p style="color: var(--text-secondary); line-height: 1.6;">
                    Chuyên cung cấp dịch vụ unlock iPhone, Samsung và các thiết bị di động.
                    Uy tín - Chất lượng - Bảo hành trọn đời.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="footer-widget">
                <h3>Liên kết nhanh</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'fallback_cb' => 'gsm_footer_menu_fallback',
                ));
                ?>
            </div>

            <!-- Services -->
            <div class="footer-widget">
                <h3>Dịch vụ</h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/service-category/iphone-unlock')); ?>">iPhone Unlock</a></li>
                    <li><a href="<?php echo esc_url(home_url('/service-category/samsung-unlock')); ?>">Samsung Unlock</a></li>
                    <li><a href="<?php echo esc_url(home_url('/service-category/imei-services')); ?>">IMEI Services</a></li>
                    <li><a href="<?php echo esc_url(home_url('/service-category/icloud-services')); ?>">iCloud Services</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-widget">
                <h3>Liên hệ</h3>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 12px;">
                        <i class="fas fa-phone-alt" style="color: var(--secondary-color); margin-right: 8px;"></i>
                        <a href="tel:<?php echo esc_attr(gsm_get_contact('hotline')); ?>">
                            <?php echo esc_html(gsm_get_contact('hotline')); ?>
                        </a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <i class="fab fa-whatsapp" style="color: var(--secondary-color); margin-right: 8px;"></i>
                        <a href="https://wa.me/<?php echo str_replace('+', '', gsm_get_contact('whatsapp')); ?>" target="_blank">
                            WhatsApp
                        </a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <i class="fab fa-telegram-plane" style="color: var(--secondary-color); margin-right: 8px;"></i>
                        <a href="https://t.me/<?php echo ltrim(gsm_get_contact('telegram'), '@'); ?>" target="_blank">
                            <?php echo esc_html(gsm_get_contact('telegram')); ?>
                        </a>
                    </li>
                    <li>
                        <span style="font-weight: bold; color: var(--secondary-color); margin-right: 8px;">Z</span>
                        <a href="https://zalo.me/<?php echo str_replace('+', '', gsm_get_contact('zalo')); ?>" target="_blank">
                            Zalo Chat
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 14px;">
                Hotline: <a href="tel:<?php echo esc_attr(gsm_get_contact('hotline')); ?>" style="color: var(--secondary-color);">
                    <?php echo esc_html(gsm_get_contact('hotline')); ?>
                </a> |
                Telegram: <a href="https://t.me/<?php echo ltrim(gsm_get_contact('telegram'), '@'); ?>" target="_blank" style="color: var(--secondary-color);">
                    <?php echo esc_html(gsm_get_contact('telegram')); ?>
                </a>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Footer Menu Fallback
 */
function gsm_footer_menu_fallback() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Trang chủ</a></li>';
    echo '<li><a href="' . esc_url(home_url('/gioi-thieu')) . '">Giới thiệu</a></li>';
    echo '<li><a href="' . esc_url(home_url('/dich-vu')) . '">Dịch vụ</a></li>';
    echo '<li><a href="' . esc_url(home_url('/lien-he')) . '">Liên hệ</a></li>';
    echo '</ul>';
}
?>
