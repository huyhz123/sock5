<?php
/**
 * GSM Services Pro Theme Functions
 *
 * Contact Information:
 * - Hotline: +84386355255
 * - WhatsApp: +84386355255
 * - Zalo: +84386355255
 * - Telegram: @hzgsm
 */

// Security: Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme Constants
define('GSM_THEME_VERSION', '1.0.0');
define('GSM_HOTLINE', '+84386355255');
define('GSM_TELEGRAM', '@hzgsm');

/**
 * Theme Setup
 */
function gsm_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'gsm-services-pro'),
        'footer' => __('Footer Menu', 'gsm-services-pro'),
    ));

    // Add image sizes
    add_image_size('gsm-service-thumb', 400, 300, true);
    add_image_size('gsm-blog-thumb', 800, 500, true);
}
add_action('after_setup_theme', 'gsm_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function gsm_enqueue_scripts() {
    // Main stylesheet
    wp_enqueue_style('gsm-style', get_stylesheet_uri(), array(), GSM_THEME_VERSION);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Main JavaScript
    wp_enqueue_script('gsm-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), GSM_THEME_VERSION, true);

    // Localize script
    wp_localize_script('gsm-main', 'gsmData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('gsm_nonce'),
        'hotline' => GSM_HOTLINE,
        'telegram' => GSM_TELEGRAM,
    ));
}
add_action('wp_enqueue_scripts', 'gsm_enqueue_scripts');

/**
 * Register Custom Post Type: Services
 */
function gsm_register_service_post_type() {
    $labels = array(
        'name' => 'Services',
        'singular_name' => 'Service',
        'menu_name' => 'GSM Services',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Service',
        'edit_item' => 'Edit Service',
        'new_item' => 'New Service',
        'view_item' => 'View Service',
        'search_items' => 'Search Services',
        'not_found' => 'No services found',
        'not_found_in_trash' => 'No services found in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-smartphone',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'services'),
        'show_in_rest' => true,
    );

    register_post_type('gsm_service', $args);
}
add_action('init', 'gsm_register_service_post_type');

/**
 * Register Service Categories
 */
function gsm_register_service_taxonomy() {
    $labels = array(
        'name' => 'Service Categories',
        'singular_name' => 'Service Category',
        'search_items' => 'Search Categories',
        'all_items' => 'All Categories',
        'edit_item' => 'Edit Category',
        'update_item' => 'Update Category',
        'add_new_item' => 'Add New Category',
        'new_item_name' => 'New Category Name',
        'menu_name' => 'Categories',
    );

    register_taxonomy('service_category', 'gsm_service', array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'service-category'),
    ));
}
add_action('init', 'gsm_register_service_taxonomy');

/**
 * Add Service Meta Boxes
 */
function gsm_add_service_meta_boxes() {
    add_meta_box(
        'gsm_service_details',
        'Service Details',
        'gsm_service_details_callback',
        'gsm_service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'gsm_add_service_meta_boxes');

/**
 * Service Details Meta Box Callback
 */
function gsm_service_details_callback($post) {
    wp_nonce_field('gsm_service_details_nonce', 'gsm_service_details_nonce_field');

    $price = get_post_meta($post->ID, '_gsm_price', true);
    $delivery_time = get_post_meta($post->ID, '_gsm_delivery_time', true);
    $success_rate = get_post_meta($post->ID, '_gsm_success_rate', true);

    ?>
    <p>
        <label><strong>Price (VND):</strong></label><br>
        <input type="text" name="gsm_price" value="<?php echo esc_attr($price); ?>" style="width: 100%; padding: 8px;">
    </p>
    <p>
        <label><strong>Delivery Time:</strong></label><br>
        <input type="text" name="gsm_delivery_time" value="<?php echo esc_attr($delivery_time); ?>" placeholder="e.g., 1-24 hours" style="width: 100%; padding: 8px;">
    </p>
    <p>
        <label><strong>Success Rate (%):</strong></label><br>
        <input type="number" name="gsm_success_rate" value="<?php echo esc_attr($success_rate); ?>" min="0" max="100" style="width: 100%; padding: 8px;">
    </p>
    <?php
}

/**
 * Save Service Meta Data
 */
function gsm_save_service_meta($post_id) {
    if (!isset($_POST['gsm_service_details_nonce_field']) ||
        !wp_verify_nonce($_POST['gsm_service_details_nonce_field'], 'gsm_service_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['gsm_price'])) {
        update_post_meta($post_id, '_gsm_price', sanitize_text_field($_POST['gsm_price']));
    }

    if (isset($_POST['gsm_delivery_time'])) {
        update_post_meta($post_id, '_gsm_delivery_time', sanitize_text_field($_POST['gsm_delivery_time']));
    }

    if (isset($_POST['gsm_success_rate'])) {
        update_post_meta($post_id, '_gsm_success_rate', intval($_POST['gsm_success_rate']));
    }
}
add_action('save_post_gsm_service', 'gsm_save_service_meta');

/**
 * Format Price
 */
function gsm_format_price($price) {
    if (empty($price)) return 'Liên hệ';
    return number_format($price, 0, ',', '.') . ' VNĐ';
}

/**
 * Create Sample Content on Theme Activation
 */
function gsm_create_sample_content() {
    if (get_option('gsm_sample_content_created')) {
        return;
    }

    // Create Service Categories
    $categories = array(
        'iPhone Unlock' => 'Dịch vụ mở mạng iPhone các dòng',
        'Samsung Unlock' => 'Dịch vụ mở mạng Samsung các dòng',
        'IMEI Services' => 'Dịch vụ kiểm tra và sửa IMEI',
        'iCloud Services' => 'Dịch vụ iCloud, Apple ID',
    );

    foreach ($categories as $cat_name => $cat_desc) {
        if (!term_exists($cat_name, 'service_category')) {
            wp_insert_term($cat_name, 'service_category', array('description' => $cat_desc));
        }
    }

    // Sample Services
    $services = array(
        array(
            'title' => 'iPhone 15 Pro Max Network Unlock',
            'content' => 'Dịch vụ mở mạng iPhone 15 Pro Max nhanh chóng, an toàn. Bảo hành trọn đời, hỗ trợ 24/7. Thời gian xử lý chỉ từ 1-3 ngày làm việc.',
            'price' => '2500000',
            'delivery_time' => '1-3 ngày',
            'success_rate' => '99',
            'category' => 'iPhone Unlock',
        ),
        array(
            'title' => 'iPhone 14 Pro Carrier Unlock',
            'content' => 'Mở khóa mạng iPhone 14 Pro tất cả các nhà mạng AT&T, T-Mobile, Verizon, Sprint. Giá tốt nhất thị trường, uy tín lâu năm.',
            'price' => '1800000',
            'delivery_time' => '2-5 ngày',
            'success_rate' => '98',
            'category' => 'iPhone Unlock',
        ),
        array(
            'title' => 'Samsung S24 Ultra Network Unlock',
            'content' => 'Dịch vụ unlock Samsung Galaxy S24 Ultra mọi nhà mạng. Hỗ trợ unlock mã code, không cần box, 100% thành công.',
            'price' => '800000',
            'delivery_time' => '1-2 ngày',
            'success_rate' => '100',
            'category' => 'Samsung Unlock',
        ),
        array(
            'title' => 'IMEI Check & Blacklist Removal',
            'content' => 'Kiểm tra IMEI chi tiết, xóa blacklist, bad ESN. Hỗ trợ tất cả các dòng máy iPhone, Samsung, Xiaomi, Oppo...',
            'price' => '500000',
            'delivery_time' => '1-7 ngày',
            'success_rate' => '95',
            'category' => 'IMEI Services',
        ),
        array(
            'title' => 'iCloud Unlock Premium',
            'content' => 'Mở khóa iCloud iPhone, iPad nhanh chóng. Hỗ trợ iOS mới nhất. Bảo mật tuyệt đối, không mất dữ liệu.',
            'price' => '3000000',
            'delivery_time' => '3-7 ngày',
            'success_rate' => '90',
            'category' => 'iCloud Services',
        ),
        array(
            'title' => 'iPhone 13 Network Unlock',
            'content' => 'Mở mạng iPhone 13 tất cả phiên bản. Giá rẻ, uy tín, bảo hành lâu dài. Hỗ trợ tư vấn miễn phí.',
            'price' => '1500000',
            'delivery_time' => '2-4 ngày',
            'success_rate' => '99',
            'category' => 'iPhone Unlock',
        ),
    );

    foreach ($services as $service_data) {
        $category = get_term_by('name', $service_data['category'], 'service_category');

        $post_id = wp_insert_post(array(
            'post_title' => $service_data['title'],
            'post_content' => $service_data['content'],
            'post_status' => 'publish',
            'post_type' => 'gsm_service',
            'post_author' => 1,
        ));

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_gsm_price', $service_data['price']);
            update_post_meta($post_id, '_gsm_delivery_time', $service_data['delivery_time']);
            update_post_meta($post_id, '_gsm_success_rate', $service_data['success_rate']);

            if ($category) {
                wp_set_object_terms($post_id, $category->term_id, 'service_category');
            }
        }
    }

    // Sample Blog Posts
    $posts = array(
        array(
            'title' => 'Hướng dẫn kiểm tra IMEI iPhone chính xác nhất 2024',
            'content' => 'IMEI là mã định danh duy nhất của mỗi thiết bị di động. Việc kiểm tra IMEI iPhone giúp bạn xác định nguồn gốc, tình trạng máy. Trong bài viết này, chúng tôi sẽ hướng dẫn chi tiết cách kiểm tra IMEI iPhone chính xác nhất...',
        ),
        array(
            'title' => 'So sánh các phương pháp unlock iPhone hiện nay',
            'content' => 'Unlock iPhone là gì? Có những phương pháp unlock nào? Phương pháp nào an toàn và hiệu quả nhất? Bài viết này sẽ phân tích chi tiết từng phương pháp unlock iPhone phổ biến hiện nay...',
        ),
        array(
            'title' => '5 điều cần biết trước khi mua iPhone Lock',
            'content' => 'iPhone Lock giá rẻ hơn iPhone quốc tế nhưng có nhiều hạn chế. Trước khi quyết định mua iPhone Lock, bạn cần nắm rõ những thông tin quan trọng để tránh rủi ro và chọn được máy phù hợp...',
        ),
        array(
            'title' => 'Cách phân biệt iPhone chính hãng và hàng nhái',
            'content' => 'Làm thế nào để nhận biết iPhone thật hay fake? Có những dấu hiệu nào để phân biệt? Bài viết này cung cấp cẩm nang đầy đủ nhất giúp bạn tránh mua phải iPhone nhái, hàng dựng...',
        ),
    );

    foreach ($posts as $post_data) {
        wp_insert_post(array(
            'post_title' => $post_data['title'],
            'post_content' => $post_data['content'],
            'post_status' => 'publish',
            'post_type' => 'post',
            'post_author' => 1,
        ));
    }

    // Create sample pages
    $pages = array(
        array(
            'title' => 'Giới thiệu',
            'content' => '<h2>Về GSM Services</h2><p>Chúng tôi là đơn vị hàng đầu cung cấp dịch vụ unlock iPhone, Samsung và các thiết bị di động tại Việt Nam. Với hơn 10 năm kinh nghiệm, chúng tôi cam kết mang đến dịch vụ chất lượng cao nhất.</p><h3>Tại sao chọn chúng tôi?</h3><ul><li>✅ Tỷ lệ thành công cao nhất thị trường</li><li>✅ Giá cả cạnh tranh, minh bạch</li><li>✅ Bảo mật thông tin tuyệt đối</li><li>✅ Hỗ trợ 24/7</li><li>✅ Bảo hành trọn đời</li></ul>',
        ),
        array(
            'title' => 'Liên hệ',
            'content' => '<h2>Thông tin liên hệ</h2><p><strong>Hotline:</strong> ' . GSM_HOTLINE . '</p><p><strong>WhatsApp:</strong> ' . GSM_HOTLINE . '</p><p><strong>Zalo:</strong> ' . GSM_HOTLINE . '</p><p><strong>Telegram:</strong> ' . GSM_TELEGRAM . '</p><p>Chúng tôi luôn sẵn sàng hỗ trợ bạn 24/7. Đừng ngại liên hệ để được tư vấn miễn phí!</p>',
        ),
    );

    foreach ($pages as $page_data) {
        wp_insert_post(array(
            'post_title' => $page_data['title'],
            'post_content' => $page_data['content'],
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
        ));
    }

    update_option('gsm_sample_content_created', true);
}
add_action('after_switch_theme', 'gsm_create_sample_content');

/**
 * Customizer Settings
 */
function gsm_customize_register($wp_customize) {
    // Contact Section
    $wp_customize->add_section('gsm_contact_section', array(
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
        'section' => 'gsm_contact_section',
        'type' => 'text',
    ));

    // Telegram
    $wp_customize->add_setting('gsm_telegram', array(
        'default' => GSM_TELEGRAM,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('gsm_telegram', array(
        'label' => 'Telegram Username',
        'section' => 'gsm_contact_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'gsm_customize_register');

/**
 * Get Contact Info
 */
function gsm_get_contact($type = 'hotline') {
    switch ($type) {
        case 'hotline':
        case 'whatsapp':
        case 'zalo':
            return get_theme_mod('gsm_hotline', GSM_HOTLINE);
        case 'telegram':
            return get_theme_mod('gsm_telegram', GSM_TELEGRAM);
        default:
            return '';
    }
}

/**
 * Floating Contact Buttons
 */
function gsm_floating_contacts() {
    $hotline = gsm_get_contact('hotline');
    $telegram = gsm_get_contact('telegram');
    ?>
    <div class="floating-contacts">
        <a href="https://wa.me/<?php echo str_replace('+', '', $hotline); ?>"
           class="floating-btn whatsapp"
           target="_blank"
           title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://zalo.me/<?php echo str_replace('+', '', $hotline); ?>"
           class="floating-btn zalo"
           target="_blank"
           title="Zalo">
            <span style="font-weight: bold; font-size: 20px;">Z</span>
        </a>
        <a href="https://t.me/<?php echo ltrim($telegram, '@'); ?>"
           class="floating-btn telegram"
           target="_blank"
           title="Telegram">
            <i class="fab fa-telegram-plane"></i>
        </a>
        <a href="tel:<?php echo $hotline; ?>"
           class="floating-btn phone"
           title="Call Now">
            <i class="fas fa-phone-alt"></i>
        </a>
    </div>
    <?php
}
add_action('wp_footer', 'gsm_floating_contacts');
