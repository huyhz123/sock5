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
    <!-- Header Top - Contact & Switchers -->
    <div class="header-top">
        <div class="container">
            <div class="header-contact">
                <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>">
                    <i class="fas fa-phone-alt"></i>
                    <?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>
                </a>
                <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank">
                    <i class="fab fa-telegram-plane"></i>
                    <?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?>
                </a>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('gsm_email', 'contact@hzgsm.com')); ?>">
                    <i class="far fa-envelope"></i>
                    <?php echo esc_html(get_theme_mod('gsm_email', 'contact@hzgsm.com')); ?>
                </a>
            </div>

            <div class="header-switchers">
                <!-- Language Switcher -->
                <div class="lang-switcher">
                    <?php
                    $current_lang = gsm_get_current_language();
                    $languages = array(
                        'en' => 'EN',
                        'vi' => 'VI',
                        'zh' => '中',
                    );

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
                    $currencies = GSM_Multi_Currency::get_all_currencies();

                    foreach ($currencies as $code => $data) :
                        $active = $current_currency === $code ? ' active' : '';
                        ?>
                        <button class="currency-btn<?php echo $active; ?>" data-currency="<?php echo esc_attr($code); ?>">
                            <?php echo esc_html($data['symbol']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Main - Logo & Navigation -->
    <div class="header-main">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <?php echo esc_html(get_theme_mod('gsm_logo_text', 'Hz')); ?>
            </a>

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => 'gsm_default_menu',
                ));
                ?>
            </nav>

            <button class="mobile-menu-toggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<?php
/**
 * Default menu if no menu is set
 */
function gsm_default_menu() {
    ?>
    <ul class="nav-menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="active"><?php echo gsm_t('home'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/services/')); ?>"><?php echo gsm_t('services'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/accounts/')); ?>"><?php echo gsm_t('accounts'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/phones/')); ?>"><?php echo gsm_t('phones'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/parts/')); ?>"><?php echo gsm_t('parts'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>"><?php echo gsm_t('blog'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php echo gsm_t('contact'); ?></a></li>
    </ul>
    <?php
}
?>
