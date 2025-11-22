<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <!-- Header Top -->
    <div class="header-top">
        <div class="container">
            <div class="header-contacts">
                <div class="header-contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>Hotline: <?php echo esc_html(gsm_get_contact('hotline')); ?></span>
                </div>
                <div class="header-contact-item">
                    <i class="fab fa-telegram-plane"></i>
                    <span>Telegram: <?php echo esc_html(gsm_get_contact('telegram')); ?></span>
                </div>
                <div class="header-contact-item">
                    <i class="far fa-clock"></i>
                    <span>24/7 Support</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Main -->
    <div class="header-main">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <div class="site-logo">📱</div>
                    <?php endif; ?>
                    <div>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php if (get_bloginfo('description')) : ?>
                            <p class="site-description"><?php bloginfo('description'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <nav class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'nav-menu',
                        'container' => false,
                        'fallback_cb' => 'gsm_default_menu',
                    ));
                    ?>
                    <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</header>

<?php
/**
 * Default Menu Fallback
 */
function gsm_default_menu() {
    echo '<ul class="nav-menu">';
    echo '<li class="current-menu-item"><a href="' . esc_url(home_url('/')) . '">Trang chủ</a></li>';
    echo '<li><a href="' . esc_url(home_url('/services')) . '">Dịch vụ</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog')) . '">Blog</a></li>';
    echo '<li><a href="' . esc_url(home_url('/lien-he')) . '">Liên hệ</a></li>';
    echo '</ul>';
}
?>
