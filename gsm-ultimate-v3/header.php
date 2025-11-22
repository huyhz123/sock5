<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <!-- Header Top - Contact & Switchers -->
    <div class="header-top">
        <div class="container">
            <!-- Contact Info -->
            <div class="header-contact">
                <a href="tel:<?php echo esc_attr(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?>">
                    <i class="fas fa-phone-alt"></i>
                    <span><?php echo esc_html(get_theme_mod('gsm_hotline', GSM_HOTLINE)); ?></span>
                </a>
                <a href="https://t.me/<?php echo ltrim(get_theme_mod('gsm_telegram', GSM_TELEGRAM), '@'); ?>" target="_blank">
                    <i class="fab fa-telegram-plane"></i>
                    <span><?php echo esc_html(get_theme_mod('gsm_telegram', GSM_TELEGRAM)); ?></span>
                </a>
            </div>

            <!-- Language & Currency Switchers -->
            <div class="header-switchers">
                <!-- Language Switcher -->
                <div class="lang-switcher">
                    <?php
                    $current_lang = gsm_get_current_language();
                    $languages = array('vi' => 'VI', 'en' => 'EN', 'zh' => '中');
                    foreach ($languages as $code => $label) :
                        $active = ($code === $current_lang) ? ' active' : '';
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
                    $currencies = gsm_get_currencies();
                    foreach ($currencies as $code => $data) :
                        $active = ($code === $current_currency) ? ' active' : '';
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

            <div class="header-actions">
                <!-- Search Toggle -->
                <button class="search-toggle" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>

                <?php
                // WooCommerce cart icon
                if (function_exists('gsm_woocommerce_cart_link')) {
                    gsm_woocommerce_cart_link();
                }
                ?>

                <button class="mobile-menu-toggle" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="search-overlay">
        <div class="search-overlay-content">
            <button class="search-close" aria-label="Close search">
                <i class="fas fa-times"></i>
            </button>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Tìm kiếm...', 'placeholder', 'gsm-ultimate'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" class="search-submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>

<script>
// Search toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchToggle = document.querySelector('.search-toggle');
    const searchOverlay = document.querySelector('.search-overlay');
    const searchClose = document.querySelector('.search-close');
    const searchField = document.querySelector('.search-field');

    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function() {
            searchOverlay.classList.add('active');
            setTimeout(() => searchField && searchField.focus(), 300);
        });

        searchClose.addEventListener('click', function() {
            searchOverlay.classList.remove('active');
        });

        searchOverlay.addEventListener('click', function(e) {
            if (e.target === searchOverlay) {
                searchOverlay.classList.remove('active');
            }
        });

        // ESC key to close
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                searchOverlay.classList.remove('active');
            }
        });
    }
});
</script>

<?php
/**
 * Default menu fallback
 */
function gsm_default_menu() {
    ?>
    <ul class="nav-menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'gsm-ultimate'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/shop')); ?>"><?php _e('Sản phẩm', 'gsm-ultimate'); ?></a></li>
    </ul>
    <?php
}
