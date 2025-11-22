<?php
/**
 * GSM Pro Ultimate Theme Functions
 *
 * Features:
 * - 3 Languages: English, Vietnamese, Chinese
 * - 3 Currencies: USD, VND, CNY
 * - 4 Product Types: Services, Accounts, Phones, Parts
 * - Complete Customizer Integration
 * - SEO Optimized
 * - Performance Optimized
 *
 * Contact: +84386355255 | Telegram: @hzgsm
 */

// Security
if (!defined('ABSPATH')) exit;

// Theme Constants
define('GSM_VERSION', '2.0.0');
define('GSM_HOTLINE', '+84386355255');
define('GSM_TELEGRAM', '@hzgsm');

/**
 * Theme Setup
 */
function gsm_ultimate_setup() {
    // Language support
    load_theme_textdomain('gsm-pro-ultimate', get_template_directory() . '/languages');

    // Theme supports
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('automatic-feed-links');

    // Register menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'gsm-pro-ultimate'),
        'footer' => esc_html__('Footer Menu', 'gsm-pro-ultimate'),
    ));

    // Image sizes
    add_image_size('gsm-product-thumb', 400, 400, true);
    add_image_size('gsm-blog-thumb', 800, 500, true);
}
add_action('after_setup_theme', 'gsm_ultimate_setup');

/**
 * Enqueue Scripts and Styles
 */
function gsm_ultimate_scripts() {
    // Main CSS
    wp_enqueue_style('gsm-style', get_stylesheet_uri(), array(), GSM_VERSION);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Main JS
    wp_enqueue_script('gsm-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), GSM_VERSION, true);

    // Localize script
    wp_localize_script('gsm-main', 'gsmData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('gsm_nonce'),
        'language' => gsm_get_current_language(),
        'currency' => gsm_get_current_currency(),
        'hotline' => get_theme_mod('gsm_hotline', GSM_HOTLINE),
        'telegram' => get_theme_mod('gsm_telegram', GSM_TELEGRAM),
    ));
}
add_action('wp_enqueue_scripts', 'gsm_ultimate_scripts');

/**
 * Multi-Language System
 */
class GSM_Multi_Language {
    private static $languages = array(
        'en' => 'English',
        'vi' => 'Tiếng Việt',
        'zh' => '中文',
    );

    public static function init() {
        add_action('init', array(__CLASS__, 'set_language'));
    }

    public static function set_language() {
        if (isset($_GET['lang']) && array_key_exists($_GET['lang'], self::$languages)) {
            setcookie('gsm_language', sanitize_key($_GET['lang']), time() + (86400 * 365), '/');
            $_COOKIE['gsm_language'] = sanitize_key($_GET['lang']);
        }
    }

    public static function get_current_language() {
        if (isset($_COOKIE['gsm_language']) && array_key_exists($_COOKIE['gsm_language'], self::$languages)) {
            return sanitize_key($_COOKIE['gsm_language']);
        }
        return 'vi'; // Default Vietnamese
    }

    public static function get_languages() {
        return self::$languages;
    }

    public static function translate($key, $lang = null) {
        $lang = $lang ?: self::get_current_language();
        $translations = self::get_translations();
        return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $key;
    }

    private static function get_translations() {
        return array(
            'en' => array(
                'home' => 'Home',
                'services' => 'Services',
                'accounts' => 'Accounts',
                'phones' => 'Phones',
                'parts' => 'Parts',
                'blog' => 'Blog',
                'contact' => 'Contact',
                'about' => 'About',
                'buy_now' => 'Buy Now',
                'view_details' => 'View Details',
                'add_to_cart' => 'Add to Cart',
                'call_now' => 'Call Now',
                'all_products' => 'All Products',
                'latest_posts' => 'Latest Posts',
                'read_more' => 'Read More',
                'search' => 'Search',
                'price' => 'Price',
                'in_stock' => 'In Stock',
                'out_of_stock' => 'Out of Stock',
            ),
            'vi' => array(
                'home' => 'Trang chủ',
                'services' => 'Dịch vụ',
                'accounts' => 'Tài khoản',
                'phones' => 'Điện thoại',
                'parts' => 'Linh kiện',
                'blog' => 'Blog',
                'contact' => 'Liên hệ',
                'about' => 'Giới thiệu',
                'buy_now' => 'Mua ngay',
                'view_details' => 'Xem chi tiết',
                'add_to_cart' => 'Thêm vào giỏ',
                'call_now' => 'Gọi ngay',
                'all_products' => 'Tất cả sản phẩm',
                'latest_posts' => 'Bài viết mới',
                'read_more' => 'Đọc thêm',
                'search' => 'Tìm kiếm',
                'price' => 'Giá',
                'in_stock' => 'Còn hàng',
                'out_of_stock' => 'Hết hàng',
            ),
            'zh' => array(
                'home' => '首页',
                'services' => '服务',
                'accounts' => '账户',
                'phones' => '手机',
                'parts' => '配件',
                'blog' => '博客',
                'contact' => '联系',
                'about' => '关于',
                'buy_now' => '立即购买',
                'view_details' => '查看详情',
                'add_to_cart' => '加入购物车',
                'call_now' => '立即致电',
                'all_products' => '所有产品',
                'latest_posts' => '最新文章',
                'read_more' => '阅读更多',
                'search' => '搜索',
                'price' => '价格',
                'in_stock' => '有货',
                'out_of_stock' => '缺货',
            ),
        );
    }
}
GSM_Multi_Language::init();

function gsm_get_current_language() {
    return GSM_Multi_Language::get_current_language();
}

function gsm_t($key) {
    return GSM_Multi_Language::translate($key);
}

/**
 * Multi-Currency System
 */
class GSM_Multi_Currency {
    private static $currencies = array(
        'USD' => array('symbol' => '$', 'rate' => 1, 'decimals' => 2),
        'VND' => array('symbol' => '₫', 'rate' => 24000, 'decimals' => 0),
        'CNY' => array('symbol' => '¥', 'rate' => 7.2, 'decimals' => 2),
    );

    public static function init() {
        add_action('init', array(__CLASS__, 'set_currency'));
    }

    public static function set_currency() {
        if (isset($_GET['currency']) && array_key_exists($_GET['currency'], self::$currencies)) {
            setcookie('gsm_currency', sanitize_key($_GET['currency']), time() + (86400 * 365), '/');
            $_COOKIE['gsm_currency'] = sanitize_key($_GET['currency']);
        }
    }

    public static function get_current_currency() {
        if (isset($_COOKIE['gsm_currency']) && array_key_exists($_COOKIE['gsm_currency'], self::$currencies)) {
            return sanitize_key($_COOKIE['gsm_currency']);
        }
        return 'VND'; // Default VND
    }

    public static function get_currencies() {
        return self::$currencies;
    }

    public static function convert($amount, $from = 'USD', $to = null) {
        $to = $to ?: self::get_current_currency();

        if ($from === $to) {
            return $amount;
        }

        // Convert to USD first
        $usd_amount = $amount / self::$currencies[$from]['rate'];

        // Convert to target currency
        return $usd_amount * self::$currencies[$to]['rate'];
    }

    public static function format($amount, $currency = null) {
        $currency = $currency ?: self::get_current_currency();
        $info = self::$currencies[$currency];

        $formatted = number_format($amount, $info['decimals'], '.', ',');

        if ($currency === 'VND') {
            return $formatted . ' ' . $info['symbol'];
        } else {
            return $info['symbol'] . $formatted;
        }
    }
}
GSM_Multi_Currency::init();

function gsm_get_current_currency() {
    return GSM_Multi_Currency::get_current_currency();
}

function gsm_format_price($price, $original_currency = 'USD') {
    $converted = GSM_Multi_Currency::convert($price, $original_currency);
    return GSM_Multi_Currency::format($converted);
}

/**
 * Register Product Types
 */
function gsm_register_product_types() {
    $product_types = array(
        'gsm_service' => array(
            'name' => 'Services',
            'singular' => 'Service',
            'icon' => 'dashicons-admin-tools',
            'slug' => 'services',
        ),
        'gsm_account' => array(
            'name' => 'Accounts',
            'singular' => 'Account',
            'icon' => 'dashicons-admin-users',
            'slug' => 'accounts',
        ),
        'gsm_phone' => array(
            'name' => 'Phones',
            'singular' => 'Phone',
            'icon' => 'dashicons-smartphone',
            'slug' => 'phones',
        ),
        'gsm_part' => array(
            'name' => 'Parts',
            'singular' => 'Part',
            'icon' => 'dashicons-admin-settings',
            'slug' => 'parts',
        ),
    );

    foreach ($product_types as $post_type => $config) {
        $labels = array(
            'name' => $config['name'],
            'singular_name' => $config['singular'],
            'menu_name' => $config['name'],
            'add_new' => 'Add New',
            'add_new_item' => 'Add New ' . $config['singular'],
            'edit_item' => 'Edit ' . $config['singular'],
            'new_item' => 'New ' . $config['singular'],
            'view_item' => 'View ' . $config['singular'],
            'search_items' => 'Search ' . $config['name'],
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'menu_icon' => $config['icon'],
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
            'rewrite' => array('slug' => $config['slug']),
            'show_in_rest' => true,
        );

        register_post_type($post_type, $args);

        // Register taxonomy for each product type
        register_taxonomy(
            $post_type . '_category',
            $post_type,
            array(
                'label' => $config['singular'] . ' Categories',
                'hierarchical' => true,
                'show_in_rest' => true,
                'rewrite' => array('slug' => $config['slug'] . '-category'),
            )
        );
    }
}
add_action('init', 'gsm_register_product_types');

/**
 * Add Product Meta Boxes
 */
function gsm_add_product_meta_boxes() {
    $post_types = array('gsm_service', 'gsm_account', 'gsm_phone', 'gsm_part');

    foreach ($post_types as $post_type) {
        add_meta_box(
            'gsm_product_details',
            'Product Details',
            'gsm_product_details_callback',
            $post_type,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'gsm_add_product_meta_boxes');

function gsm_product_details_callback($post) {
    wp_nonce_field('gsm_product_details', 'gsm_product_nonce');

    $price = get_post_meta($post->ID, '_gsm_price', true);
    $price_old = get_post_meta($post->ID, '_gsm_price_old', true);
    $stock = get_post_meta($post->ID, '_gsm_stock', true);
    $sku = get_post_meta($post->ID, '_gsm_sku', true);
    $warranty = get_post_meta($post->ID, '_gsm_warranty', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="gsm_price">Price (USD)</label></th>
            <td><input type="number" step="0.01" id="gsm_price" name="gsm_price" value="<?php echo esc_attr($price); ?>" class="regular-text" required></td>
        </tr>
        <tr>
            <th><label for="gsm_price_old">Old Price (USD)</label></th>
            <td><input type="number" step="0.01" id="gsm_price_old" name="gsm_price_old" value="<?php echo esc_attr($price_old); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="gsm_stock">Stock Status</label></th>
            <td>
                <select id="gsm_stock" name="gsm_stock">
                    <option value="in_stock" <?php selected($stock, 'in_stock'); ?>>In Stock</option>
                    <option value="out_of_stock" <?php selected($stock, 'out_of_stock'); ?>>Out of Stock</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="gsm_sku">SKU</label></th>
            <td><input type="text" id="gsm_sku" name="gsm_sku" value="<?php echo esc_attr($sku); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="gsm_warranty">Warranty</label></th>
            <td><input type="text" id="gsm_warranty" name="gsm_warranty" value="<?php echo esc_attr($warranty); ?>" class="regular-text" placeholder="e.g., 12 months"></td>
        </tr>
    </table>
    <?php
}

function gsm_save_product_meta($post_id) {
    if (!isset($_POST['gsm_product_nonce']) || !wp_verify_nonce($_POST['gsm_product_nonce'], 'gsm_product_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('gsm_price', 'gsm_price_old', 'gsm_stock', 'gsm_sku', 'gsm_warranty');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'gsm_save_product_meta');

/**
 * Theme Customizer - Complete Integration
 */
function gsm_customize_register($wp_customize) {

    // ==== GENERAL SETTINGS ====
    $wp_customize->add_section('gsm_general', array(
        'title' => 'General Settings',
        'priority' => 20,
    ));

    // Site Tagline
    $wp_customize->add_setting('gsm_tagline', array(
        'default' => 'Professional GSM Services',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_tagline', array(
        'label' => 'Site Tagline',
        'section' => 'gsm_general',
        'type' => 'text',
    ));

    // ==== CONTACT INFORMATION ====
    $wp_customize->add_section('gsm_contact', array(
        'title' => 'Contact Information',
        'priority' => 30,
    ));

    // Hotline
    $wp_customize->add_setting('gsm_hotline', array(
        'default' => GSM_HOTLINE,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_hotline', array(
        'label' => 'Hotline',
        'section' => 'gsm_contact',
        'type' => 'text',
    ));

    // WhatsApp
    $wp_customize->add_setting('gsm_whatsapp', array(
        'default' => GSM_HOTLINE,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_whatsapp', array(
        'label' => 'WhatsApp',
        'section' => 'gsm_contact',
        'type' => 'text',
    ));

    // Zalo
    $wp_customize->add_setting('gsm_zalo', array(
        'default' => GSM_HOTLINE,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_zalo', array(
        'label' => 'Zalo',
        'section' => 'gsm_contact',
        'type' => 'text',
    ));

    // Telegram
    $wp_customize->add_setting('gsm_telegram', array(
        'default' => GSM_TELEGRAM,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_telegram', array(
        'label' => 'Telegram Username',
        'section' => 'gsm_contact',
        'type' => 'text',
    ));

    // ==== BANNER SETTINGS ====
    $wp_customize->add_section('gsm_banner', array(
        'title' => 'Banner Settings',
        'priority' => 40,
    ));

    // Banner Title
    $wp_customize->add_setting('gsm_banner_title', array(
        'default' => 'Professional GSM Services',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_banner_title', array(
        'label' => 'Banner Title',
        'section' => 'gsm_banner',
        'type' => 'text',
    ));

    // Banner Subtitle
    $wp_customize->add_setting('gsm_banner_subtitle', array(
        'default' => 'Unlock, IMEI, Accounts, Phones & Parts',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('gsm_banner_subtitle', array(
        'label' => 'Banner Subtitle',
        'section' => 'gsm_banner',
        'type' => 'textarea',
    ));

    // ==== SEO SETTINGS ====
    $wp_customize->add_section('gsm_seo', array(
        'title' => 'SEO Settings',
        'priority' => 50,
    ));

    // Meta Description
    $wp_customize->add_setting('gsm_meta_description', array(
        'default' => 'Professional GSM services including unlock, IMEI services, accounts, phones and parts. Contact: ' . GSM_HOTLINE,
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('gsm_meta_description', array(
        'label' => 'Meta Description',
        'section' => 'gsm_seo',
        'type' => 'textarea',
    ));

    // Meta Keywords
    $wp_customize->add_setting('gsm_meta_keywords', array(
        'default' => 'GSM, unlock, IMEI, iPhone, Samsung, accounts, phones, parts',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_meta_keywords', array(
        'label' => 'Meta Keywords',
        'section' => 'gsm_seo',
        'type' => 'text',
    ));

    // ==== LANGUAGE SETTINGS ====
    $wp_customize->add_section('gsm_language', array(
        'title' => 'Language Settings',
        'priority' => 60,
    ));

    // Default Language
    $wp_customize->add_setting('gsm_default_language', array(
        'default' => 'vi',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_default_language', array(
        'label' => 'Default Language',
        'section' => 'gsm_language',
        'type' => 'select',
        'choices' => array(
            'en' => 'English',
            'vi' => 'Tiếng Việt',
            'zh' => '中文',
        ),
    ));

    // ==== CURRENCY SETTINGS ====
    $wp_customize->add_section('gsm_currency', array(
        'title' => 'Currency Settings',
        'priority' => 70,
    ));

    // Default Currency
    $wp_customize->add_setting('gsm_default_currency', array(
        'default' => 'VND',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('gsm_default_currency', array(
        'label' => 'Default Currency',
        'section' => 'gsm_currency',
        'type' => 'select',
        'choices' => array(
            'USD' => 'USD ($)',
            'VND' => 'VND (₫)',
            'CNY' => 'CNY (¥)',
        ),
    ));
}
add_action('customize_register', 'gsm_customize_register');

/**
 * Add SEO Meta Tags
 */
function gsm_add_seo_meta() {
    $description = get_theme_mod('gsm_meta_description', '');
    $keywords = get_theme_mod('gsm_meta_keywords', '');

    if ($description) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
    if ($keywords) {
        echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
    }

    // Open Graph
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url(home_url('/')) . '">' . "\n";
}
add_action('wp_head', 'gsm_add_seo_meta');

/**
 * Create Sample Content
 */
function gsm_create_ultimate_sample_content() {
    if (get_option('gsm_ultimate_sample_created')) return;

    // Create categories for each product type
    $categories = array(
        'gsm_service' => array('iPhone Unlock', 'Samsung Unlock', 'IMEI Services'),
        'gsm_account' => array('Gaming Accounts', 'Social Accounts', 'Premium Accounts'),
        'gsm_phone' => array('iPhone', 'Samsung', 'Xiaomi'),
        'gsm_part' => array('Screens', 'Batteries', 'Cases'),
    );

    foreach ($categories as $post_type => $cats) {
        foreach ($cats as $cat_name) {
            wp_insert_term($cat_name, $post_type . '_category');
        }
    }

    // Sample products
    $sample_products = array(
        // Services
        array(
            'type' => 'gsm_service',
            'title' => 'iPhone 15 Pro Max Unlock',
            'content' => 'Professional iPhone 15 Pro Max network unlock service. Fast, safe, and reliable. Lifetime warranty included.',
            'price' => 99,
            'category' => 'iPhone Unlock',
        ),
        array(
            'type' => 'gsm_service',
            'title' => 'Samsung S24 Ultra Unlock',
            'content' => 'Complete Samsung S24 Ultra network unlock. Supports all carriers. 100% success rate.',
            'price' => 49,
            'category' => 'Samsung Unlock',
        ),
        // Accounts
        array(
            'type' => 'gsm_account',
            'title' => 'Premium Spotify Account - 12 Months',
            'content' => 'Premium Spotify account with 12 months warranty. Private account, no sharing.',
            'price' => 15,
            'category' => 'Premium Accounts',
        ),
        array(
            'type' => 'gsm_account',
            'title' => 'Netflix Premium 4K - 1 Month',
            'content' => 'Netflix Premium 4K account. Ultra HD quality. Works worldwide.',
            'price' => 5,
            'category' => 'Premium Accounts',
        ),
        // Phones
        array(
            'type' => 'gsm_phone',
            'title' => 'iPhone 14 Pro 256GB - Like New',
            'content' => 'iPhone 14 Pro 256GB in excellent condition. Battery health 95%. Includes original box and accessories.',
            'price' => 799,
            'category' => 'iPhone',
        ),
        array(
            'type' => 'gsm_phone',
            'title' => 'Samsung Galaxy S23 128GB',
            'content' => 'Brand new Samsung Galaxy S23 128GB. International version, unlocked.',
            'price' => 599,
            'category' => 'Samsung',
        ),
        // Parts
        array(
            'type' => 'gsm_part',
            'title' => 'iPhone 13 OLED Screen Assembly',
            'content' => 'Original quality OLED screen for iPhone 13. Includes tools and installation guide.',
            'price' => 89,
            'category' => 'Screens',
        ),
        array(
            'type' => 'gsm_part',
            'title' => 'Samsung S21 Battery',
            'content' => 'High capacity battery for Samsung S21. 4000mAh. 6 months warranty.',
            'price' => 25,
            'category' => 'Batteries',
        ),
    );

    foreach ($sample_products as $product) {
        $category = get_term_by('name', $product['category'], $product['type'] . '_category');

        $post_id = wp_insert_post(array(
            'post_title' => $product['title'],
            'post_content' => $product['content'],
            'post_status' => 'publish',
            'post_type' => $product['type'],
        ));

        if ($post_id) {
            update_post_meta($post_id, '_gsm_price', $product['price']);
            update_post_meta($post_id, '_gsm_stock', 'in_stock');
            update_post_meta($post_id, '_gsm_sku', 'GSM-' . strtoupper(substr(md5($product['title']), 0, 8)));
            update_post_meta($post_id, '_gsm_warranty', '12 months');

            if ($category) {
                wp_set_object_terms($post_id, $category->term_id, $product['type'] . '_category');
            }
        }
    }

    // Sample blog posts
    $sample_posts = array(
        array(
            'title' => 'How to Check iPhone IMEI - Complete Guide 2024',
            'content' => 'Learn how to check your iPhone IMEI number using multiple methods. IMEI is the unique identifier for your device...',
        ),
        array(
            'title' => 'Best Gaming Accounts to Buy in 2024',
            'content' => 'Looking for premium gaming accounts? Here are the best options available in the market...',
        ),
        array(
            'title' => 'iPhone vs Samsung: Which Phone to Buy?',
            'content' => 'Comprehensive comparison between iPhone and Samsung smartphones. Features, prices, and more...',
        ),
    );

    foreach ($sample_posts as $post) {
        wp_insert_post(array(
            'post_title' => $post['title'],
            'post_content' => $post['content'],
            'post_status' => 'publish',
            'post_type' => 'post',
        ));
    }

    update_option('gsm_ultimate_sample_created', true);
}
add_action('after_switch_theme', 'gsm_create_ultimate_sample_content');

/**
 * Floating Contact Buttons
 */
function gsm_floating_contacts() {
    $hotline = get_theme_mod('gsm_hotline', GSM_HOTLINE);
    $whatsapp = get_theme_mod('gsm_whatsapp', GSM_HOTLINE);
    $zalo = get_theme_mod('gsm_zalo', GSM_HOTLINE);
    $telegram = get_theme_mod('gsm_telegram', GSM_TELEGRAM);
    ?>
    <div class="floating-contacts">
        <a href="https://wa.me/<?php echo str_replace('+', '', $whatsapp); ?>" class="floating-btn whatsapp" target="_blank" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://zalo.me/<?php echo str_replace('+', '', $zalo); ?>" class="floating-btn zalo" target="_blank" title="Zalo">
            <strong style="font-size: 18px;">Z</strong>
        </a>
        <a href="https://t.me/<?php echo ltrim($telegram, '@'); ?>" class="floating-btn telegram" target="_blank" title="Telegram">
            <i class="fab fa-telegram-plane"></i>
        </a>
        <a href="tel:<?php echo $hotline; ?>" class="floating-btn phone" title="<?php echo esc_attr($hotline); ?>">
            <i class="fas fa-phone-alt"></i>
        </a>
    </div>
    <?php
}
add_action('wp_footer', 'gsm_floating_contacts');
