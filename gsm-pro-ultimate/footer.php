<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <!-- About Widget -->
            <div class="footer-widget">
                <h3><?php echo gsm_t('about'); ?></h3>
                <p style="color: var(--color-gray-lighter); line-height: 1.6;">
                    <?php
                    $lang = gsm_get_current_language();
                    if ($lang === 'en') {
                        echo 'Professional GSM services including unlocking, IMEI services, accounts, phones, and parts. Quality guaranteed.';
                    } elseif ($lang === 'zh') {
                        echo '专业的GSM服务，包括解锁、IMEI服务、账户、手机和配件。质量保证。';
                    } else {
                        echo 'Dịch vụ GSM chuyên nghiệp bao gồm unlock, IMEI, tài khoản, điện thoại và linh kiện. Chất lượng đảm bảo.';
                    }
                    ?>
                </p>
            </div>

            <!-- Quick Links -->
            <div class="footer-widget">
                <h3><?php echo gsm_t('Quick Links'); ?></h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo gsm_t('home'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services')); ?>"><?php echo gsm_t('services'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/accounts')); ?>"><?php echo gsm_t('accounts'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/phones')); ?>"><?php echo gsm_t('phones'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/parts')); ?>"><?php echo gsm_t('parts'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>"><?php echo gsm_t('blog'); ?></a></li>
                </ul>
            </div>

            <!-- Product Categories -->
            <div class="footer-widget">
                <h3><?php echo gsm_t('categories'); ?></h3>
                <ul>
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => array('gsm_service_category', 'gsm_account_category', 'gsm_phone_category', 'gsm_part_category'),
                        'hide_empty' => false,
                        'number' => 6,
                    ));
                    if ($categories && !is_wp_error($categories)) :
                        foreach ($categories as $category) :
                            ?>
                            <li><a href="<?php echo esc_url(get_term_link($category)); ?>"><?php echo esc_html($category->name); ?></a></li>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-widget">
                <h3><?php echo gsm_t('contact'); ?></h3>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 12px;">
                        <i class="fas fa-phone-alt" style="color: var(--color-primary); margin-right: 8px;"></i>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>">
                            <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>
                        </a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <i class="fab fa-whatsapp" style="color: var(--color-primary); margin-right: 8px;"></i>
                        <a href="https://wa.me/<?php echo str_replace('+', '', get_theme_mod('gsm_whatsapp', GSM_HOTLINE)); ?>" target="_blank">
                            WhatsApp
                        </a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <strong style="color: var(--color-primary); margin-right: 8px;">Z</strong>
                        <a href="https://zalo.me/<?php echo str_replace('+', '', get_theme_mod('gsm_zalo', GSM_HOTLINE)); ?>" target="_blank">
                            Zalo
                        </a>
                    </li>
                    <li>
                        <i class="fab fa-telegram-plane" style="color: var(--color-primary); margin-right: 8px;"></i>
                        <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank">
                            <?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php
                if ($lang === 'en') {
                    echo 'All rights reserved.';
                } elseif ($lang === 'zh') {
                    echo '版权所有。';
                } else {
                    echo 'Bản quyền thuộc về chúng tôi.';
                }
                ?>
            </p>
            <p style="margin-top: 10px; font-size: 14px;">
                <?php echo gsm_t('contact'); ?>:
                <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" style="color: var(--color-primary);">
                    <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>
                </a> |
                <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" style="color: var(--color-primary);">
                    <?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?>
                </a>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
