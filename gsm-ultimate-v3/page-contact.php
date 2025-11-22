<?php
/**
 * Template Name: Contact Page
 */

get_header();

$lang = gsm_get_current_language();
?>

<section class="products-section" style="padding-top: 60px;">
    <div class="container">
        <!-- Page Header -->
        <div class="section-header">
            <h1 class="section-title"><?php the_title(); ?></h1>
            <p class="section-subtitle">
                <?php
                if ($lang === 'en') echo 'Get in touch with us 24/7';
                elseif ($lang === 'zh') echo '24/7联系我们';
                else echo 'Liên hệ với chúng tôi 24/7';
                ?>
            </p>
        </div>

        <div class="row" style="gap: var(--spacing-xl); align-items: flex-start;">

            <!-- Contact Information -->
            <div class="col" style="flex: 0 0 40%;">
                <!-- Contact Methods -->
                <div class="card" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-md);">
                    <h3 style="font-size: 24px; margin-bottom: var(--spacing-md); display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-phone-alt" style="color: var(--color-primary);"></i>
                        <?php
                        if ($lang === 'en') echo 'Contact Information';
                        elseif ($lang === 'zh') echo '联系信息';
                        else echo 'Thông Tin Liên Hệ';
                        ?>
                    </h3>

                    <div style="margin-bottom: var(--spacing-lg);">
                        <div style="display: flex; align-items: center; gap: var(--spacing-md); padding: var(--spacing-md); background: var(--color-background); border-radius: var(--border-radius-md); margin-bottom: var(--spacing-md);">
                            <div style="width: 50px; height: 50px; background: var(--gradient-primary); border-radius: var(--border-radius-md); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <div style="font-size: var(--font-size-sm); color: var(--color-gray-light); margin-bottom: 4px;">Hotline</div>
                                <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" style="font-size: 18px; font-weight: 700; color: var(--color-black);">
                                    <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>
                                </a>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: var(--spacing-md); padding: var(--spacing-md); background: var(--color-background); border-radius: var(--border-radius-md); margin-bottom: var(--spacing-md);">
                            <div style="width: 50px; height: 50px; background: var(--gradient-primary); border-radius: var(--border-radius-md); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div>
                                <div style="font-size: var(--font-size-sm); color: var(--color-gray-light); margin-bottom: 4px;">Email</div>
                                <a href="mailto:<?php echo esc_attr(get_theme_mod('gsm_email', 'contact@hzgsm.com')); ?>" style="font-size: 18px; font-weight: 700; color: var(--color-black);">
                                    <?php echo esc_html(get_theme_mod('gsm_email', 'contact@hzgsm.com')); ?>
                                </a>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: var(--spacing-md); padding: var(--spacing-md); background: var(--color-background); border-radius: var(--border-radius-md);">
                            <div style="width: 50px; height: 50px; background: var(--gradient-primary); border-radius: var(--border-radius-md); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                <i class="fab fa-telegram-plane"></i>
                            </div>
                            <div>
                                <div style="font-size: var(--font-size-sm); color: var(--color-gray-light); margin-bottom: 4px;">Telegram</div>
                                <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" style="font-size: 18px; font-weight: 700; color: var(--color-black);">
                                    <?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="card card-glass" style="padding: var(--spacing-lg);">
                    <h3 style="font-size: 20px; margin-bottom: var(--spacing-md);">
                        <?php
                        if ($lang === 'en') echo 'Connect With Us';
                        elseif ($lang === 'zh') echo '联系我们';
                        else echo 'Kết Nối Với Chúng Tôi';
                        ?>
                    </h3>

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                        <a href="https://wa.me/<?php echo str_replace('+', '', get_theme_mod('gsm_whatsapp', GSM_HOTLINE)); ?>" target="_blank" class="btn btn-outline btn-block">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://zalo.me/<?php echo str_replace('+', '', get_theme_mod('gsm_zalo', GSM_HOTLINE)); ?>" target="_blank" class="btn btn-outline btn-block">
                            <strong>Z</strong> Zalo
                        </a>
                        <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank" class="btn btn-outline btn-block">
                            <i class="fab fa-telegram-plane"></i> Telegram
                        </a>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>" class="btn btn-outline btn-block">
                            <i class="fas fa-phone-alt"></i>
                            <?php
                            if ($lang === 'en') echo 'Call';
                            elseif ($lang === 'zh') echo '呼叫';
                            else echo 'Gọi';
                            ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col">
                <div class="card" style="padding: var(--spacing-xl);">
                    <h3 style="font-size: 24px; margin-bottom: var(--spacing-md); display: flex; align-items: center; gap: 10px;">
                        <i class="far fa-edit" style="color: var(--color-primary);"></i>
                        <?php
                        if ($lang === 'en') echo 'Send us a message';
                        elseif ($lang === 'zh') echo '给我们留言';
                        else echo 'Gửi tin nhắn cho chúng tôi';
                        ?>
                    </h3>

                    <form action="<?php echo admin_url('admin-post.php'); ?>" method="POST" class="contact-form">
                        <input type="hidden" name="action" value="gsm_contact_form">
                        <?php wp_nonce_field('gsm_contact_form', 'gsm_contact_nonce'); ?>

                        <div class="row" style="margin-bottom: var(--spacing-md);">
                            <div class="col">
                                <div class="form-group">
                                    <label for="contact_name" class="form-label">
                                        <?php
                                        if ($lang === 'en') echo 'Name';
                                        elseif ($lang === 'zh') echo '姓名';
                                        else echo 'Họ tên';
                                        ?>
                                        <span style="color: var(--color-danger);">*</span>
                                    </label>
                                    <input type="text" id="contact_name" name="contact_name" class="form-control" required placeholder="<?php
                                    if ($lang === 'en') echo 'Your name';
                                    elseif ($lang === 'zh') echo '您的姓名';
                                    else echo 'Tên của bạn';
                                    ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="contact_email" class="form-label">
                                        Email <span style="color: var(--color-danger);">*</span>
                                    </label>
                                    <input type="email" id="contact_email" name="contact_email" class="form-control" required placeholder="your@email.com">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: var(--spacing-md);">
                            <label for="contact_phone" class="form-label">
                                <?php
                                if ($lang === 'en') echo 'Phone';
                                elseif ($lang === 'zh') echo '电话';
                                else echo 'Điện thoại';
                                ?>
                            </label>
                            <input type="tel" id="contact_phone" name="contact_phone" class="form-control" placeholder="+84...">
                        </div>

                        <div class="form-group" style="margin-bottom: var(--spacing-md);">
                            <label for="contact_subject" class="form-label">
                                <?php
                                if ($lang === 'en') echo 'Subject';
                                elseif ($lang === 'zh') echo '主题';
                                else echo 'Chủ đề';
                                ?>
                                <span style="color: var(--color-danger);">*</span>
                            </label>
                            <input type="text" id="contact_subject" name="contact_subject" class="form-control" required placeholder="<?php
                            if ($lang === 'en') echo 'How can we help?';
                            elseif ($lang === 'zh') echo '我们能帮什么忙？';
                            else echo 'Chúng tôi có thể giúp gì?';
                            ?>">
                        </div>

                        <div class="form-group" style="margin-bottom: var(--spacing-lg);">
                            <label for="contact_message" class="form-label">
                                <?php
                                if ($lang === 'en') echo 'Message';
                                elseif ($lang === 'zh') echo '留言';
                                else echo 'Tin nhắn';
                                ?>
                                <span style="color: var(--color-danger);">*</span>
                            </label>
                            <textarea id="contact_message" name="contact_message" class="form-control" rows="6" required placeholder="<?php
                            if ($lang === 'en') echo 'Your message...';
                            elseif ($lang === 'zh') echo '您的留言...';
                            else echo 'Nội dung tin nhắn...';
                            ?>"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-paper-plane"></i>
                            <?php
                            if ($lang === 'en') echo 'Send Message';
                            elseif ($lang === 'zh') echo '发送消息';
                            else echo 'Gửi tin nhắn';
                            ?>
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Page Content (if any) -->
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
