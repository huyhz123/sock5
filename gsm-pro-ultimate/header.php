<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <!-- Header Top -->
    <div class="header-top">
        <div class="container">
            <div class="header-contacts">
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span><?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?></span>
                </div>
                <div class="contact-item">
                    <i class="fab fa-telegram-plane"></i>
                    <span><?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?></span>
                </div>
                <div class="contact-item">
                    <i class="far fa-clock"></i>
                    <span><?php echo gsm_t('24/7 Support'); ?></span>
                </div>
            </div>

            <div class="header-controls">
                <!-- Language Switcher -->
                <div class="lang-switcher">
                    <?php
                    $current_lang = gsm_get_current_language();
                    $languages = array('en' => 'EN', 'vi' => 'VI', 'zh' => '中');
                    foreach ($languages as $code => $label) :
                        $active = $current_lang === $code ? ' active' : '';
                        ?>
                        <button class="lang-btn<?php echo $active; ?>" data-lang="<?php echo esc_attr($code); ?>">
                            <?php echo esc_html($label); ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Currency Switcher -->
                <div class="currency-switcher">
                    <?php
                    $current_currency = gsm_get_current_currency();
                    $currencies = array('USD' => '$', 'VND' => '₫', 'CNY' => '¥');
                    foreach ($currencies as $code => $symbol) :
                        $active = $current_currency === $code ? ' active' : '';
                        ?>
                        <button class="currency-btn<?php echo $active; ?>" data-currency="<?php echo esc_attr($code); ?>">
                            <?php echo esc_html($symbol); ?>
                        </button>
                    <?php endforeach; ?>
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
                        <?php
                        $tagline = get_theme_mod('gsm_tagline', get_bloginfo('description'));
                        if ($tagline) :
                            ?>
                            <p class="site-description"><?php echo esc_html($tagline); ?></p>
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
    echo '<li class="current-menu-item"><a href="' . esc_url(home_url('/')) . '">' . gsm_t('home') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/services')) . '">' . gsm_t('services') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/accounts')) . '">' . gsm_t('accounts') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/phones')) . '">' . gsm_t('phones') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/parts')) . '">' . gsm_t('parts') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog')) . '">' . gsm_t('blog') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . gsm_t('contact') . '</a></li>';
    echo '</ul>';
}
?>
