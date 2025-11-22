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

            <!-- Header Actions: Search, Cart, Mobile Toggle -->
            <div class="header-actions">
                <!-- Search Toggle -->
                <button class="search-toggle" aria-label="<?php esc_attr_e('Search', 'gsm-ultimate'); ?>">
                    <i class="fas fa-search"></i>
                </button>

                <?php
                // WooCommerce cart icon
                if (function_exists('gsm_woocommerce_cart_link')) {
                    gsm_woocommerce_cart_link();
                }
                ?>

                <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle menu', 'gsm-ultimate'); ?>">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="search-overlay">
        <div class="search-overlay-content">
            <button class="search-close" aria-label="<?php esc_attr_e('Close search', 'gsm-ultimate'); ?>">
                <i class="fas fa-times"></i>
            </button>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search"
                       class="search-field"
                       placeholder="<?php esc_attr_e('Search products, services...', 'gsm-ultimate'); ?>"
                       value="<?php echo get_search_query(); ?>"
                       name="s"
                       autocomplete="off">
                <button type="submit" class="search-submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
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
        <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_service')); ?>"><?php echo gsm_t('services'); ?></a></li>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_account')); ?>"><?php echo gsm_t('accounts'); ?></a></li>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_phone')); ?>"><?php echo gsm_t('phones'); ?></a></li>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('gsm_part')); ?>"><?php echo gsm_t('parts'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>"><?php echo gsm_t('blog'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php echo gsm_t('contact'); ?></a></li>
    </ul>
    <?php
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search Toggle
    const searchToggle = document.querySelector('.search-toggle');
    const searchOverlay = document.querySelector('.search-overlay');
    const searchClose = document.querySelector('.search-close');
    const searchField = document.querySelector('.search-field');

    if (searchToggle && searchOverlay) {
        // Open search
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            searchOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (searchField) {
                setTimeout(() => searchField.focus(), 300);
            }
        });

        // Close search
        if (searchClose) {
            searchClose.addEventListener('click', function() {
                searchOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        // Close on overlay click
        searchOverlay.addEventListener('click', function(e) {
            if (e.target === searchOverlay) {
                searchOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                searchOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNavigation = document.querySelector('.main-navigation');

    if (mobileMenuToggle && mainNavigation) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            mainNavigation.classList.toggle('active');
            this.querySelector('i').classList.toggle('fa-bars');
            this.querySelector('i').classList.toggle('fa-times');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuToggle.contains(e.target) && !mainNavigation.contains(e.target)) {
                mainNavigation.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                if (icon) {
                    icon.classList.add('fa-bars');
                    icon.classList.remove('fa-times');
                }
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1023) {
                mainNavigation.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                if (icon) {
                    icon.classList.add('fa-bars');
                    icon.classList.remove('fa-times');
                }
            }
        });
    }
});
</script>
