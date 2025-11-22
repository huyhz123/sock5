<?php
/**
 * GSM Ultimate v3.1 - Functions
 *
 * Features:
 * - Bright Modern UI (2025 Design)
 * - WordPress i18n Multi-language (EN, VI, ZH)
 * - Multi-currency (USD, VND, CNY)
 * - 4 Product Types (Services, Accounts, Phones, Parts)
 * - IMEI API Integration (GSMTOOL, DHRU)
 * - Auto Cache Clear System
 * - Optimized Language System
 *
 * Contact: +84386355255 | @hzgsm
 */

// Theme Constants
define('GSM_VERSION', '3.1.0');
define('GSM_HOTLINE', '+84386355255');
define('GSM_TELEGRAM', '@hzgsm');
define('GSM_THEME_DIR', get_template_directory());
define('GSM_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function gsm_ultimate_setup() {
    // Enable translation with proper WordPress i18n
    load_theme_textdomain('gsm-ultimate', GSM_THEME_DIR . '/languages');

    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');

    // Image sizes
    add_image_size('gsm-product-thumb', 400, 400, true);
    add_image_size('gsm-blog-thumb', 600, 400, true);
    add_image_size('gsm-hero-banner', 1920, 800, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'gsm-ultimate'),
        'footer' => esc_html__('Footer Menu', 'gsm-ultimate'),
    ));
}
add_action('after_setup_theme', 'gsm_ultimate_setup');

/**
 * Enqueue Scripts and Styles
 */
function gsm_ultimate_enqueue_scripts() {
    // Main stylesheet
    wp_enqueue_style('gsm-ultimate-style', get_stylesheet_uri(), array(), GSM_VERSION);

    // Google Fonts - Inter for headings
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap', array(), null);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // jQuery (WordPress includes it)
    wp_enqueue_script('jquery');

    // Particles.js for hero banner
    wp_enqueue_script('particles-js', 'https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js', array(), '2.0.0', true);

    // Main JavaScript
    wp_enqueue_script('gsm-ultimate-main', GSM_THEME_URI . '/assets/js/main.js', array('jquery'), GSM_VERSION, true);

    // Localize script with data
    wp_localize_script('gsm-ultimate-main', 'gsmData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('gsm-ajax-nonce'),
        'language' => gsm_get_current_language(),
        'currency' => gsm_get_current_currency(),
        'themeUrl' => GSM_THEME_URI,
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'gsm_ultimate_enqueue_scripts');

/**
 * ============================================
 * MULTI-LANGUAGE SYSTEM - WordPress i18n
 * ============================================
 */

/**
 * Get current language from cookie or default
 */
function gsm_get_current_language() {
    $default_lang = 'vi'; // Default language

    if (isset($_COOKIE['gsm_language'])) {
        $lang = sanitize_text_field($_COOKIE['gsm_language']);
        if (in_array($lang, array('en', 'vi', 'zh'))) {
            return $lang;
        }
    }

    return $default_lang;
}

/**
 * Set language cookie via AJAX
 */
function gsm_set_language() {
    check_ajax_referer('gsm-ajax-nonce', 'nonce');

    $lang = isset($_POST['language']) ? sanitize_text_field($_POST['language']) : 'vi';

    if (in_array($lang, array('en', 'vi', 'zh'))) {
        setcookie('gsm_language', $lang, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
        wp_send_json_success(array('language' => $lang));
    }

    wp_send_json_error();
}
add_action('wp_ajax_gsm_set_language', 'gsm_set_language');
add_action('wp_ajax_nopriv_gsm_set_language', 'gsm_set_language');

/**
 * Switch WordPress locale based on selected language
 */
function gsm_switch_locale($locale) {
    $lang = gsm_get_current_language();

    $locale_map = array(
        'en' => 'en_US',
        'vi' => 'vi',
        'zh' => 'zh_CN',
    );

    if (isset($locale_map[$lang])) {
        return $locale_map[$lang];
    }

    return $locale;
}
add_filter('locale', 'gsm_switch_locale');

/**
 * Translation helper function (fallback for untranslated strings)
 */
function gsm_t($key) {
    $translations = array(
        // Navigation
        'home' => array('en' => 'Home', 'vi' => 'Trang chủ', 'zh' => '首页'),
        'services' => array('en' => 'Services', 'vi' => 'Dịch vụ', 'zh' => '服务'),
        'accounts' => array('en' => 'Accounts', 'vi' => 'Tài khoản', 'zh' => '账户'),
        'phones' => array('en' => 'Phones', 'vi' => 'Điện thoại', 'zh' => '手机'),
        'parts' => array('en' => 'Parts', 'vi' => 'Linh kiện', 'zh' => '配件'),
        'blog' => array('en' => 'Blog', 'vi' => 'Tin tức', 'zh' => '博客'),
        'contact' => array('en' => 'Contact', 'vi' => 'Liên hệ', 'zh' => '联系'),
        'about' => array('en' => 'About', 'vi' => 'Giới thiệu', 'zh' => '关于'),

        // Product
        'price' => array('en' => 'Price', 'vi' => 'Giá', 'zh' => '价格'),
        'buy_now' => array('en' => 'Buy Now', 'vi' => 'Mua ngay', 'zh' => '立即购买'),
        'add_to_cart' => array('en' => 'Add to Cart', 'vi' => 'Thêm vào giỏ', 'zh' => '加入购物车'),
        'read_more' => array('en' => 'Read More', 'vi' => 'Xem thêm', 'zh' => '阅读更多'),
        'in_stock' => array('en' => 'In Stock', 'vi' => 'Còn hàng', 'zh' => '有货'),
        'out_of_stock' => array('en' => 'Out of Stock', 'vi' => 'Hết hàng', 'zh' => '缺货'),

        // General
        'search' => array('en' => 'Search', 'vi' => 'Tìm kiếm', 'zh' => '搜索'),
        'view_all' => array('en' => 'View All', 'vi' => 'Xem tất cả', 'zh' => '查看全部'),
    );

    $lang = gsm_get_current_language();

    if (isset($translations[$key][$lang])) {
        return $translations[$key][$lang];
    }

    return $key;
}

/**
 * ============================================
 * MULTI-CURRENCY SYSTEM
 * ============================================
 */

class GSM_Multi_Currency {
    private static $currencies = array(
        'USD' => array(
            'symbol' => '$',
            'name' => 'US Dollar',
            'rate' => 1,
            'decimals' => 2,
            'position' => 'before'
        ),
        'VND' => array(
            'symbol' => '₫',
            'name' => 'Vietnamese Dong',
            'rate' => 24000,
            'decimals' => 0,
            'position' => 'after'
        ),
        'CNY' => array(
            'symbol' => '¥',
            'name' => 'Chinese Yuan',
            'rate' => 7.2,
            'decimals' => 2,
            'position' => 'before'
        ),
    );

    public static function get_current_currency() {
        if (isset($_COOKIE['gsm_currency'])) {
            $currency = sanitize_text_field($_COOKIE['gsm_currency']);
            if (isset(self::$currencies[$currency])) {
                return $currency;
            }
        }
        return 'USD';
    }

    public static function convert($amount, $from = 'USD', $to = null) {
        if ($to === null) {
            $to = self::get_current_currency();
        }

        // Convert to USD first
        $usd_amount = $amount / self::$currencies[$from]['rate'];

        // Then convert to target currency
        return $usd_amount * self::$currencies[$to]['rate'];
    }

    public static function format($amount, $currency = null) {
        if ($currency === null) {
            $currency = self::get_current_currency();
        }

        $curr_data = self::$currencies[$currency];
        $formatted_amount = number_format($amount, $curr_data['decimals'], '.', ',');

        if ($curr_data['position'] === 'before') {
            return $curr_data['symbol'] . $formatted_amount;
        } else {
            return $formatted_amount . $curr_data['symbol'];
        }
    }

    public static function get_all_currencies() {
        return self::$currencies;
    }
}

/**
 * Currency formatting helper
 */
function gsm_format_price($price, $currency = null) {
    return GSM_Multi_Currency::format($price, $currency);
}

/**
 * Currency conversion helper
 */
function gsm_convert_price($amount, $from = 'USD', $to = null) {
    return GSM_Multi_Currency::convert($amount, $from, $to);
}

/**
 * Get current currency
 */
function gsm_get_current_currency() {
    return GSM_Multi_Currency::get_current_currency();
}

/**
 * AJAX: Set currency
 */
function gsm_set_currency() {
    check_ajax_referer('gsm-ajax-nonce', 'nonce');

    $currency = isset($_POST['currency']) ? sanitize_text_field($_POST['currency']) : 'USD';

    if (in_array($currency, array('USD', 'VND', 'CNY'))) {
        setcookie('gsm_currency', $currency, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
        wp_send_json_success(array('currency' => $currency));
    }

    wp_send_json_error();
}
add_action('wp_ajax_gsm_set_currency', 'gsm_set_currency');
add_action('wp_ajax_nopriv_gsm_set_currency', 'gsm_set_currency');

/**
 * ============================================
 * CUSTOM POST TYPES - 4 Product Types
 * ============================================
 */

function gsm_register_product_types() {
    $product_types = array(
        'gsm_service' => array(
            'name' => __('Services', 'gsm-ultimate'),
            'singular' => __('Service', 'gsm-ultimate'),
            'slug' => 'services',
            'icon' => 'dashicons-admin-tools',
        ),
        'gsm_account' => array(
            'name' => __('Accounts', 'gsm-ultimate'),
            'singular' => __('Account', 'gsm-ultimate'),
            'slug' => 'accounts',
            'icon' => 'dashicons-groups',
        ),
        'gsm_phone' => array(
            'name' => __('Phones', 'gsm-ultimate'),
            'singular' => __('Phone', 'gsm-ultimate'),
            'slug' => 'phones',
            'icon' => 'dashicons-smartphone',
        ),
        'gsm_part' => array(
            'name' => __('Parts', 'gsm-ultimate'),
            'singular' => __('Part', 'gsm-ultimate'),
            'slug' => 'parts',
            'icon' => 'dashicons-admin-settings',
        ),
    );

    foreach ($product_types as $type => $data) {
        register_post_type($type, array(
            'labels' => array(
                'name' => $data['name'],
                'singular_name' => $data['singular'],
                'add_new' => sprintf(__('Add New %s', 'gsm-ultimate'), $data['singular']),
                'add_new_item' => sprintf(__('Add New %s', 'gsm-ultimate'), $data['singular']),
                'edit_item' => sprintf(__('Edit %s', 'gsm-ultimate'), $data['singular']),
                'new_item' => sprintf(__('New %s', 'gsm-ultimate'), $data['singular']),
                'view_item' => sprintf(__('View %s', 'gsm-ultimate'), $data['singular']),
                'search_items' => sprintf(__('Search %s', 'gsm-ultimate'), $data['name']),
                'not_found' => sprintf(__('No %s found', 'gsm-ultimate'), strtolower($data['name'])),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => $data['slug']),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
            'menu_icon' => $data['icon'],
            'show_in_rest' => true,
        ));

        // Register taxonomy for this post type
        register_taxonomy($type . '_category', $type, array(
            'labels' => array(
                'name' => sprintf(__('%s Categories', 'gsm-ultimate'), $data['singular']),
                'singular_name' => sprintf(__('%s Category', 'gsm-ultimate'), $data['singular']),
            ),
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => $data['slug'] . '-category'),
        ));
    }
}
add_action('init', 'gsm_register_product_types');

/**
 * Add product meta boxes
 */
function gsm_add_product_meta_boxes() {
    $product_types = array('gsm_service', 'gsm_account', 'gsm_phone', 'gsm_part');

    foreach ($product_types as $type) {
        add_meta_box(
            'gsm_product_details',
            __('Product Details', 'gsm-ultimate'),
            'gsm_product_details_callback',
            $type,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'gsm_add_product_meta_boxes');

/**
 * Product details meta box callback
 */
function gsm_product_details_callback($post) {
    wp_nonce_field('gsm_save_product_meta', 'gsm_product_meta_nonce');

    $price = get_post_meta($post->ID, '_gsm_price', true);
    $price_old = get_post_meta($post->ID, '_gsm_price_old', true);
    $stock = get_post_meta($post->ID, '_gsm_stock', true);
    $sku = get_post_meta($post->ID, '_gsm_sku', true);
    $warranty = get_post_meta($post->ID, '_gsm_warranty', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="gsm_price"><?php _e('Price (USD)', 'gsm-ultimate'); ?></label></th>
            <td><input type="number" step="0.01" id="gsm_price" name="gsm_price" value="<?php echo esc_attr($price); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="gsm_price_old"><?php _e('Old Price (USD)', 'gsm-ultimate'); ?></label></th>
            <td><input type="number" step="0.01" id="gsm_price_old" name="gsm_price_old" value="<?php echo esc_attr($price_old); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="gsm_stock"><?php _e('Stock Status', 'gsm-ultimate'); ?></label></th>
            <td>
                <select id="gsm_stock" name="gsm_stock">
                    <option value="in_stock" <?php selected($stock, 'in_stock'); ?>><?php _e('In Stock', 'gsm-ultimate'); ?></option>
                    <option value="out_of_stock" <?php selected($stock, 'out_of_stock'); ?>><?php _e('Out of Stock', 'gsm-ultimate'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="gsm_sku"><?php _e('SKU', 'gsm-ultimate'); ?></label></th>
            <td><input type="text" id="gsm_sku" name="gsm_sku" value="<?php echo esc_attr($sku); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="gsm_warranty"><?php _e('Warranty', 'gsm-ultimate'); ?></label></th>
            <td><input type="text" id="gsm_warranty" name="gsm_warranty" value="<?php echo esc_attr($warranty); ?>" class="regular-text" placeholder="<?php esc_attr_e('e.g., 12 months', 'gsm-ultimate'); ?>" /></td>
        </tr>
    </table>
    <?php
}

/**
 * Save product meta data
 */
function gsm_save_product_meta($post_id) {
    if (!isset($_POST['gsm_product_meta_nonce']) || !wp_verify_nonce($_POST['gsm_product_meta_nonce'], 'gsm_save_product_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('gsm_price', 'gsm_price_old', 'gsm_stock', 'gsm_sku', 'gsm_warranty');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'gsm_save_product_meta');

/**
 * ============================================
 * IMEI API INTEGRATION
 * ============================================
 */

/**
 * GSMTOOL API Class
 */
class GSM_GSMTOOL_API {
    private $api_key;
    private $api_url = 'https://gsmtool.com/api/';

    public function __construct() {
        $this->api_key = get_option('gsm_gsmtool_api_key', '');
    }

    public function check_imei($imei) {
        if (empty($this->api_key)) {
            return array('error' => __('API key not configured', 'gsm-ultimate'));
        }

        $response = wp_remote_post($this->api_url . 'check', array(
            'body' => array(
                'api_key' => $this->api_key,
                'imei' => $imei,
            ),
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            return array('error' => $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    public function unlock_service($imei, $service_id) {
        if (empty($this->api_key)) {
            return array('error' => __('API key not configured', 'gsm-ultimate'));
        }

        $response = wp_remote_post($this->api_url . 'unlock', array(
            'body' => array(
                'api_key' => $this->api_key,
                'imei' => $imei,
                'service_id' => $service_id,
            ),
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            return array('error' => $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    public function get_balance() {
        if (empty($this->api_key)) {
            return array('error' => __('API key not configured', 'gsm-ultimate'));
        }

        $response = wp_remote_get($this->api_url . 'balance?api_key=' . $this->api_key, array(
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            return array('error' => $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }
}

/**
 * DHRU Fusion API Class
 */
class GSM_DHRU_API {
    private $username;
    private $api_key;
    private $api_url = 'https://www.dhru.com/api/';

    public function __construct() {
        $this->username = get_option('gsm_dhru_username', '');
        $this->api_key = get_option('gsm_dhru_api_key', '');
    }

    public function check_imei($imei, $service_id) {
        if (empty($this->username) || empty($this->api_key)) {
            return array('error' => __('API credentials not configured', 'gsm-ultimate'));
        }

        $response = wp_remote_post($this->api_url, array(
            'body' => array(
                'username' => $this->username,
                'apiaccesskey' => $this->api_key,
                'imei' => $imei,
                'serviceid' => $service_id,
                'format' => 'json',
            ),
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            return array('error' => $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    public function get_balance() {
        if (empty($this->username) || empty($this->api_key)) {
            return array('error' => __('API credentials not configured', 'gsm-ultimate'));
        }

        $response = wp_remote_post($this->api_url, array(
            'body' => array(
                'username' => $this->username,
                'apiaccesskey' => $this->api_key,
                'action' => 'balance',
                'format' => 'json',
            ),
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            return array('error' => $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }
}

/**
 * AJAX: Check IMEI
 */
function gsm_ajax_check_imei() {
    check_ajax_referer('gsm-ajax-nonce', 'nonce');

    $imei = isset($_POST['imei']) ? sanitize_text_field($_POST['imei']) : '';
    $provider = isset($_POST['provider']) ? sanitize_text_field($_POST['provider']) : 'gsmtool';

    if (empty($imei)) {
        wp_send_json_error(array('message' => __('Please enter IMEI', 'gsm-ultimate')));
    }

    if ($provider === 'gsmtool') {
        $api = new GSM_GSMTOOL_API();
        $result = $api->check_imei($imei);
    } else {
        $service_id = isset($_POST['service_id']) ? sanitize_text_field($_POST['service_id']) : '';
        $api = new GSM_DHRU_API();
        $result = $api->check_imei($imei, $service_id);
    }

    if (isset($result['error'])) {
        wp_send_json_error($result);
    }

    wp_send_json_success($result);
}
add_action('wp_ajax_gsm_check_imei', 'gsm_ajax_check_imei');
add_action('wp_ajax_nopriv_gsm_check_imei', 'gsm_ajax_check_imei');

/**
 * ============================================
 * WORDPRESS CUSTOMIZER
 * ============================================
 */

function gsm_customize_register($wp_customize) {
    // Site Identity Section
    $wp_customize->add_section('gsm_site_identity', array(
        'title' => __('Site Identity', 'gsm-ultimate'),
        'priority' => 20,
    ));

    $wp_customize->add_setting('gsm_logo_text', array(
        'default' => 'Hz',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('gsm_logo_text', array(
        'label' => __('Logo Text', 'gsm-ultimate'),
        'section' => 'gsm_site_identity',
        'type' => 'text',
    ));

    // Contact Information Section
    $wp_customize->add_section('gsm_contact', array(
        'title' => __('Contact Information', 'gsm-ultimate'),
        'priority' => 30,
    ));

    $contacts = array(
        'gsm_hotline' => array('label' => __('Hotline', 'gsm-ultimate'), 'default' => GSM_HOTLINE),
        'gsm_whatsapp' => array('label' => __('WhatsApp', 'gsm-ultimate'), 'default' => GSM_HOTLINE),
        'gsm_zalo' => array('label' => __('Zalo', 'gsm-ultimate'), 'default' => GSM_HOTLINE),
        'gsm_telegram' => array('label' => __('Telegram', 'gsm-ultimate'), 'default' => GSM_TELEGRAM),
        'gsm_email' => array('label' => __('Email', 'gsm-ultimate'), 'default' => 'contact@hzgsm.com'),
    );

    foreach ($contacts as $key => $data) {
        $wp_customize->add_setting($key, array(
            'default' => $data['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control($key, array(
            'label' => $data['label'],
            'section' => 'gsm_contact',
            'type' => 'text',
        ));
    }

    // Hero Banner Section
    $wp_customize->add_section('gsm_hero_banner', array(
        'title' => __('Hero Banner', 'gsm-ultimate'),
        'priority' => 40,
    ));

    $hero_fields = array(
        'gsm_hero_title' => array('type' => 'text', 'label' => __('Hero Title', 'gsm-ultimate'), 'default' => __('Professional GSM Services', 'gsm-ultimate')),
        'gsm_hero_subtitle' => array('type' => 'textarea', 'label' => __('Hero Subtitle', 'gsm-ultimate'), 'default' => __('IMEI unlock, phone repair, accounts & more', 'gsm-ultimate')),
        'gsm_hero_video' => array('type' => 'url', 'label' => __('Background Video URL', 'gsm-ultimate'), 'default' => ''),
    );

    foreach ($hero_fields as $key => $data) {
        $wp_customize->add_setting($key, array(
            'default' => $data['default'],
            'sanitize_callback' => $data['type'] === 'url' ? 'esc_url_raw' : 'sanitize_text_field',
        ));

        $wp_customize->add_control($key, array(
            'label' => $data['label'],
            'section' => 'gsm_hero_banner',
            'type' => $data['type'],
        ));
    }

    // API Settings Section
    $wp_customize->add_section('gsm_api_settings', array(
        'title' => __('API Settings', 'gsm-ultimate'),
        'priority' => 50,
    ));

    $api_fields = array(
        'gsm_gsmtool_api_key' => __('GSMTOOL API Key', 'gsm-ultimate'),
        'gsm_dhru_username' => __('DHRU Username', 'gsm-ultimate'),
        'gsm_dhru_api_key' => __('DHRU API Key', 'gsm-ultimate'),
    );

    foreach ($api_fields as $key => $label) {
        $wp_customize->add_setting($key, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control($key, array(
            'label' => $label,
            'section' => 'gsm_api_settings',
            'type' => 'text',
        ));
    }
}
add_action('customize_register', 'gsm_customize_register');

/**
 * ============================================
 * SAMPLE CONTENT CREATION
 * ============================================
 */

function gsm_create_sample_content() {
    if (get_option('gsm_sample_content_created')) {
        return;
    }

    // Sample Services
    $services = array(
        array('title' => 'iPhone IMEI Check', 'price' => 2.99, 'type' => 'gsm_service'),
        array('title' => 'Samsung Unlock', 'price' => 9.99, 'type' => 'gsm_service'),
        array('title' => 'iCloud Removal', 'price' => 29.99, 'type' => 'gsm_service'),
    );

    // Sample Accounts
    $accounts = array(
        array('title' => 'Apple ID Premium', 'price' => 4.99, 'type' => 'gsm_account'),
        array('title' => 'Samsung Account', 'price' => 3.99, 'type' => 'gsm_account'),
    );

    // Sample Phones
    $phones = array(
        array('title' => 'iPhone 14 Pro Max', 'price' => 999.99, 'type' => 'gsm_phone'),
        array('title' => 'Samsung S23 Ultra', 'price' => 899.99, 'type' => 'gsm_phone'),
    );

    // Sample Parts
    $parts = array(
        array('title' => 'iPhone 13 LCD Screen', 'price' => 79.99, 'type' => 'gsm_part'),
        array('title' => 'Samsung S22 Battery', 'price' => 29.99, 'type' => 'gsm_part'),
    );

    $all_samples = array_merge($services, $accounts, $phones, $parts);

    foreach ($all_samples as $sample) {
        $post_id = wp_insert_post(array(
            'post_title' => $sample['title'],
            'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'post_status' => 'publish',
            'post_type' => $sample['type'],
        ));

        if ($post_id) {
            update_post_meta($post_id, '_gsm_price', $sample['price']);
            update_post_meta($post_id, '_gsm_stock', 'in_stock');
            update_post_meta($post_id, '_gsm_sku', 'GSM-' . strtoupper(substr(md5($sample['title']), 0, 6)));
            update_post_meta($post_id, '_gsm_warranty', '12 months');
        }
    }

    // Sample blog posts
    for ($i = 1; $i <= 3; $i++) {
        wp_insert_post(array(
            'post_title' => sprintf(__('Blog Post %d', 'gsm-ultimate'), $i),
            'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
            'post_status' => 'publish',
            'post_type' => 'post',
        ));
    }

    update_option('gsm_sample_content_created', true);
}
add_action('after_switch_theme', 'gsm_create_sample_content');

/**
 * Body classes for language
 */
function gsm_body_classes($classes) {
    $classes[] = 'lang-' . gsm_get_current_language();
    $classes[] = 'currency-' . strtolower(gsm_get_current_currency());
    return $classes;
}
add_filter('body_class', 'gsm_body_classes');

/**
 * ============================================
 * CONTACT FORM HANDLER
 * ============================================
 */

function gsm_handle_contact_form() {
    if (!isset($_POST['gsm_contact_nonce']) || !wp_verify_nonce($_POST['gsm_contact_nonce'], 'gsm_contact_form')) {
        wp_die(__('Security check failed', 'gsm-ultimate'));
    }

    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $phone = sanitize_text_field($_POST['contact_phone']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);

    // Send email to admin
    $to = get_option('admin_email');
    $email_subject = '[' . get_bloginfo('name') . '] ' . $subject;
    $email_message = sprintf(
        "Name: %s\nEmail: %s\nPhone: %s\n\nMessage:\n%s",
        $name,
        $email,
        $phone,
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    $sent = wp_mail($to, $email_subject, $email_message, $headers);

    if ($sent) {
        wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_gsm_contact_form', 'gsm_handle_contact_form');
add_action('admin_post_nopriv_gsm_contact_form', 'gsm_handle_contact_form');

/**
 * ============================================
 * AUTO CACHE CLEAR SYSTEM
 * ============================================
 */

/**
 * Clear all WordPress caches
 */
function gsm_clear_all_caches() {
    // Clear WordPress object cache
    wp_cache_flush();

    // Clear transients
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_site_transient_%'");

    // Clear rewrite rules
    flush_rewrite_rules();

    // Clear WP Super Cache if exists
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }

    // Clear W3 Total Cache if exists
    if (function_exists('w3tc_flush_all')) {
        w3tc_flush_all();
    }

    // Clear WP Rocket cache if exists
    if (function_exists('rocket_clean_domain')) {
        rocket_clean_domain();
    }

    // Clear LiteSpeed Cache if exists
    if (class_exists('LiteSpeed_Cache_API')) {
        LiteSpeed_Cache_API::purge_all();
    }

    // Log cache clear
    error_log('GSM Ultimate: All caches cleared at ' . current_time('mysql'));
}

/**
 * Auto clear cache on theme activation
 */
function gsm_clear_cache_on_activation() {
    gsm_clear_all_caches();

    // Set option to track cache clear
    update_option('gsm_last_cache_clear', current_time('mysql'));

    // Show admin notice
    add_option('gsm_cache_cleared_notice', true);
}
add_action('after_switch_theme', 'gsm_clear_cache_on_activation');

/**
 * Auto clear cache when saving customizer
 */
function gsm_clear_cache_on_customizer_save($wp_customize) {
    gsm_clear_all_caches();
    update_option('gsm_last_cache_clear', current_time('mysql'));
}
add_action('customize_save_after', 'gsm_clear_cache_on_customizer_save');

/**
 * Auto clear cache when publishing/updating posts
 */
function gsm_clear_cache_on_post_save($post_id) {
    // Don't clear cache on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Don't clear cache for revisions
    if (wp_is_post_revision($post_id)) {
        return;
    }

    // Clear cache
    gsm_clear_all_caches();
    update_option('gsm_last_cache_clear', current_time('mysql'));
}
add_action('save_post', 'gsm_clear_cache_on_post_save');
add_action('edit_post', 'gsm_clear_cache_on_post_save');

/**
 * Auto clear cache when updating options
 */
function gsm_clear_cache_on_option_update($option) {
    // Only clear for theme-related options
    if (strpos($option, 'gsm_') === 0 || strpos($option, 'theme_mods_') === 0) {
        gsm_clear_all_caches();
        update_option('gsm_last_cache_clear', current_time('mysql'));
    }
}
add_action('updated_option', 'gsm_clear_cache_on_option_update');

/**
 * Scheduled auto cache clear (daily)
 */
function gsm_schedule_auto_cache_clear() {
    if (!wp_next_scheduled('gsm_daily_cache_clear')) {
        wp_schedule_event(time(), 'daily', 'gsm_daily_cache_clear');
    }
}
add_action('wp', 'gsm_schedule_auto_cache_clear');

function gsm_daily_cache_clear_callback() {
    gsm_clear_all_caches();
    update_option('gsm_last_cache_clear', current_time('mysql'));
}
add_action('gsm_daily_cache_clear', 'gsm_daily_cache_clear_callback');

/**
 * Admin notice for cache clear
 */
function gsm_cache_cleared_admin_notice() {
    if (get_option('gsm_cache_cleared_notice')) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php _e('GSM Ultimate:', 'gsm-ultimate'); ?></strong> <?php _e('All caches have been cleared successfully!', 'gsm-ultimate'); ?></p>
        </div>
        <?php
        delete_option('gsm_cache_cleared_notice');
    }
}
add_action('admin_notices', 'gsm_cache_cleared_admin_notice');

/**
 * Add clear cache button to admin bar
 */
function gsm_admin_bar_cache_clear($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }

    $args = array(
        'id' => 'gsm-clear-cache',
        'title' => '<span class="ab-icon dashicons dashicons-update"></span> ' . __('Clear Cache', 'gsm-ultimate'),
        'href' => wp_nonce_url(admin_url('admin-post.php?action=gsm_clear_cache'), 'gsm_clear_cache'),
        'meta' => array(
            'class' => 'gsm-clear-cache-btn'
        )
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'gsm_admin_bar_cache_clear', 100);

/**
 * Handle manual cache clear from admin bar
 */
function gsm_handle_manual_cache_clear() {
    check_admin_referer('gsm_clear_cache');

    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have permission to perform this action.', 'gsm-ultimate'));
    }

    gsm_clear_all_caches();

    wp_redirect(add_query_arg('cache_cleared', '1', wp_get_referer()));
    exit;
}
add_action('admin_post_gsm_clear_cache', 'gsm_handle_manual_cache_clear');

/**
 * ============================================
 * OPTIMIZED LANGUAGE SYSTEM
 * ============================================
 */

/**
 * Load text domain with priority
 */
function gsm_load_textdomain_improved() {
    $locale = determine_locale();
    $mofile = GSM_THEME_DIR . "/languages/gsm-ultimate-{$locale}.mo";

    // Try to load .mo file
    if (file_exists($mofile)) {
        load_textdomain('gsm-ultimate', $mofile);
    }

    // Fallback to default WordPress i18n
    load_theme_textdomain('gsm-ultimate', GSM_THEME_DIR . '/languages');
}
add_action('after_setup_theme', 'gsm_load_textdomain_improved', 1);

/**
 * Cache translations for performance
 */
function gsm_cache_translations() {
    $locale = get_locale();
    $cache_key = 'gsm_translations_' . $locale;

    $translations = wp_cache_get($cache_key);

    if (false === $translations) {
        // Translations will be loaded by WordPress
        // Cache for 24 hours
        wp_cache_set($cache_key, true, '', DAY_IN_SECONDS);
    }
}
add_action('init', 'gsm_cache_translations');

/**
 * Improved translation function with caching
 */
function gsm_t_cached($key) {
    static $translation_cache = array();

    $lang = gsm_get_current_language();
    $cache_key = $key . '_' . $lang;

    if (isset($translation_cache[$cache_key])) {
        return $translation_cache[$cache_key];
    }

    $translation = gsm_t($key);
    $translation_cache[$cache_key] = $translation;

    return $translation;
}

/**
 * Preload common translations
 */
function gsm_preload_translations() {
    $common_keys = array(
        'home', 'services', 'accounts', 'phones', 'parts', 'blog', 'contact',
        'price', 'buy_now', 'add_to_cart', 'read_more', 'in_stock', 'out_of_stock'
    );

    foreach ($common_keys as $key) {
        gsm_t_cached($key);
    }
}
add_action('wp', 'gsm_preload_translations');

/**
 * Optimize language cookie handling
 */
function gsm_optimize_language_cookie() {
    if (isset($_COOKIE['gsm_language'])) {
        $lang = sanitize_text_field($_COOKIE['gsm_language']);

        // Validate language
        if (!in_array($lang, array('en', 'vi', 'zh'))) {
            // Reset to default if invalid
            setcookie('gsm_language', 'vi', time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true);
        }
    }
}
add_action('init', 'gsm_optimize_language_cookie', 1);
