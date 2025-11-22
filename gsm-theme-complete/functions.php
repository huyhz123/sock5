<?php
/**
 * GSM Services Complete - All-in-One WordPress Theme
 * All features implemented in single file for easy deployment
 *
 * @package GSM_Services_Complete
 * @version 2.0.0
 */

if (!defined('ABSPATH')) exit;

define('GSM_VERSION', '2.0.0');
define('GSM_PATH', get_template_directory());
define('GSM_URL', get_template_directory_uri());

// ============================================
// THEME SETUP
// ============================================

function gsm_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'gsm-complete'),
        'footer' => __('Footer Menu', 'gsm-complete'),
    ));

    add_image_size('gsm-service', 400, 300, true);
    load_theme_textdomain('gsm-complete', GSM_PATH . '/languages');
}
add_action('after_setup_theme', 'gsm_theme_setup');

function gsm_enqueue_scripts() {
    wp_enqueue_style('gsm-style', get_stylesheet_uri(), array(), GSM_VERSION);
    wp_enqueue_script('gsm-main', GSM_URL . '/assets/js/main.js', array('jquery'), GSM_VERSION, true);

    wp_localize_script('gsm-main', 'gsmAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('gsm-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'gsm_enqueue_scripts');

function gsm_admin_scripts() {
    wp_enqueue_style('gsm-admin', GSM_URL . '/assets/css/admin.css', array(), GSM_VERSION);
    wp_enqueue_script('gsm-admin', GSM_URL . '/assets/js/admin.js', array('jquery'), GSM_VERSION, true);
}
add_action('admin_enqueue_scripts', 'gsm_admin_scripts');

// ============================================
// SECURITY HEADERS
// ============================================

function gsm_security_headers() {
    if (!is_admin()) {
        header('X-Frame-Options: DENY');
        header('X-Content-Type-Options: nosniff');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        if (is_ssl()) {
            header('Strict-Transport-Security: max-age=31536000');
        }
    }
}
add_action('send_headers', 'gsm_security_headers');

remove_action('wp_head', 'wp_generator');
add_filter('xmlrpc_enabled', '__return_false');

// ============================================
// TOTP/2FA IMPLEMENTATION
// ============================================

class GSM_TOTP {
    private $secret;
    private $period = 30;
    private $digits = 6;

    public function __construct($secret = null) {
        $this->secret = $secret ?: $this->generateSecret();
    }

    public function generateSecret($length = 16) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';
        for ($i = 0; $i < $length; $i++) {
            $secret .= $chars[random_int(0, 31)];
        }
        return $secret;
    }

    public function getSecret() {
        return $this->secret;
    }

    public function getCode($timestamp = null) {
        $timestamp = $timestamp ?: time();
        $time = pack('N*', 0) . pack('N*', floor($timestamp / $this->period));
        $secretKey = $this->base32Decode($this->secret);
        $hash = hash_hmac('sha1', $time, $secretKey, true);
        $offset = ord($hash[strlen($hash) - 1]) & 0x0F;

        $code = (
            ((ord($hash[$offset]) & 0x7F) << 24) |
            ((ord($hash[$offset + 1]) & 0xFF) << 16) |
            ((ord($hash[$offset + 2]) & 0xFF) << 8) |
            (ord($hash[$offset + 3]) & 0xFF)
        ) % pow(10, $this->digits);

        return str_pad($code, $this->digits, '0', STR_PAD_LEFT);
    }

    public function verifyCode($code, $discrepancy = 1) {
        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            if ($this->getCode(time() + ($i * $this->period)) === $code) {
                return true;
            }
        }
        return false;
    }

    public function getQRCodeUrl($issuer, $account) {
        $uri = 'otpauth://totp/' . rawurlencode($issuer . ':' . $account) . '?secret=' . $this->secret . '&issuer=' . rawurlencode($issuer);
        return 'https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=' . urlencode($uri);
    }

    private function base32Decode($data) {
        $data = strtoupper($data);
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $binary = '';

        for ($i = 0; $i < strlen($data); $i++) {
            if ($data[$i] === '=') continue;
            $pos = strpos($chars, $data[$i]);
            if ($pos === false) continue;
            $binary .= str_pad(decbin($pos), 5, '0', STR_PAD_LEFT);
        }

        $result = '';
        for ($i = 0; $i < strlen($binary); $i += 8) {
            $chunk = substr($binary, $i, 8);
            if (strlen($chunk) === 8) {
                $result .= chr(bindec($chunk));
            }
        }
        return $result;
    }

    public static function generateBackupCodes($count = 10) {
        $codes = array();
        for ($i = 0; $i < $count; $i++) {
            $code = sprintf('%04d-%04d-%04d-%04d',
                random_int(0, 9999), random_int(0, 9999),
                random_int(0, 9999), random_int(0, 9999)
            );
            $codes[] = $code;
        }
        return $codes;
    }
}

// ============================================
// DATABASE TABLES
// ============================================

function gsm_create_tables() {
    global $wpdb;
    $charset = $wpdb->get_charset_collate();

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // 2FA Secrets
    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}gsm_2fa_secrets (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        secret varchar(32) NOT NULL,
        enabled tinyint(1) DEFAULT 0,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY user_id (user_id)
    ) $charset;";
    dbDelta($sql);

    // Backup Codes
    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}gsm_backup_codes (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        code_hash varchar(64) NOT NULL,
        used tinyint(1) DEFAULT 0,
        used_at datetime DEFAULT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY user_id (user_id)
    ) $charset;";
    dbDelta($sql);

    // Audit Logs
    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}gsm_audit_logs (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) DEFAULT NULL,
        action varchar(100) NOT NULL,
        details text,
        ip_address varchar(45) NOT NULL,
        user_agent varchar(255),
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY user_id (user_id),
        KEY created_at (created_at)
    ) $charset;";
    dbDelta($sql);

    // Wallet Transactions
    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}gsm_wallet_transactions (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        amount decimal(10,2) NOT NULL,
        type varchar(20) NOT NULL,
        description text,
        reference_id bigint(20) DEFAULT NULL,
        balance_before decimal(10,2) NOT NULL,
        balance_after decimal(10,2) NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY user_id (user_id)
    ) $charset;";
    dbDelta($sql);

    // Notification Queue
    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}gsm_notifications (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        type varchar(20) NOT NULL,
        recipient varchar(255) NOT NULL,
        message text NOT NULL,
        metadata text,
        status varchar(20) DEFAULT 'pending',
        retry_count int(11) DEFAULT 0,
        last_error text,
        sent_at datetime DEFAULT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY status (status)
    ) $charset;";
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'gsm_create_tables');

// ============================================
// CUSTOM POST TYPES
// ============================================

function gsm_register_post_types() {
    // Services
    register_post_type('gsm_service', array(
        'labels' => array(
            'name' => 'Services',
            'singular_name' => 'Service',
            'add_new_item' => 'Add New Service',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-smartphone',
        'rewrite' => array('slug' => 'services'),
    ));

    // Orders
    register_post_type('gsm_order', array(
        'labels' => array(
            'name' => 'Orders',
            'singular_name' => 'Order',
        ),
        'public' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title'),
    ));

    // Tickets
    register_post_type('gsm_ticket', array(
        'labels' => array(
            'name' => 'Tickets',
            'singular_name' => 'Ticket',
        ),
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => array('title', 'editor'),
    ));

    // Service Categories
    register_taxonomy('service_category', 'gsm_service', array(
        'labels' => array(
            'name' => 'Service Categories',
            'singular_name' => 'Category',
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'gsm_register_post_types');

// ============================================
// CUSTOM ROLES
// ============================================

function gsm_add_roles() {
    add_role('dealer', 'Dealer', array(
        'read' => true,
        'view_services' => true,
        'create_orders' => true,
    ));

    add_role('partner', 'Partner', array(
        'read' => true,
        'view_services' => true,
        'create_orders' => true,
        'view_commissions' => true,
    ));
}
add_action('after_switch_theme', 'gsm_add_roles');

// ============================================
// PAYMENT FUNCTIONS
// ============================================

function gsm_process_stripe_payment($amount, $token, $description) {
    $stripe_secret = get_option('gsm_stripe_secret_key');
    if (!$stripe_secret) return false;

    $ch = curl_init('https://api.stripe.com/v1/charges');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'amount' => $amount * 100,
        'currency' => 'usd',
        'source' => $token,
        'description' => $description,
    )));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $stripe_secret,
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode === 200 ? json_decode($response, true) : false;
}

function gsm_get_user_balance($user_id = null) {
    $user_id = $user_id ?: get_current_user_id();
    return (float) get_user_meta($user_id, 'gsm_wallet_balance', true);
}

function gsm_update_user_balance($user_id, $amount, $type, $description, $ref_id = null) {
    global $wpdb;

    $balance_before = gsm_get_user_balance($user_id);
    $balance_after = $balance_before + $amount;

    if ($balance_after < 0) return false;

    $wpdb->insert($wpdb->prefix . 'gsm_wallet_transactions', array(
        'user_id' => $user_id,
        'amount' => $amount,
        'type' => $type,
        'description' => $description,
        'reference_id' => $ref_id,
        'balance_before' => $balance_before,
        'balance_after' => $balance_after,
    ));

    update_user_meta($user_id, 'gsm_wallet_balance', $balance_after);
    return true;
}

// ============================================
// NOTIFICATION FUNCTIONS
// ============================================

function gsm_send_telegram($message, $chat_id = null) {
    $token = get_option('gsm_telegram_token');
    $chat_id = $chat_id ?: get_option('gsm_telegram_chat_id');

    if (!$token || !$chat_id) return false;

    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'HTML',
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    return $response ? json_decode($response, true) : false;
}

function gsm_queue_notification($type, $recipient, $message, $metadata = array()) {
    global $wpdb;

    $wpdb->insert($wpdb->prefix . 'gsm_notifications', array(
        'type' => $type,
        'recipient' => $recipient,
        'message' => $message,
        'metadata' => json_encode($metadata),
        'status' => 'pending',
    ));
}

function gsm_process_notifications() {
    global $wpdb;

    $notifications = $wpdb->get_results("
        SELECT * FROM {$wpdb->prefix}gsm_notifications
        WHERE status = 'pending' AND retry_count < 3
        LIMIT 10
    ");

    foreach ($notifications as $notif) {
        $success = false;

        if ($notif->type === 'telegram') {
            $success = gsm_send_telegram($notif->message, $notif->recipient);
        }

        if ($success) {
            $wpdb->update($wpdb->prefix . 'gsm_notifications',
                array('status' => 'sent', 'sent_at' => current_time('mysql')),
                array('id' => $notif->id)
            );
        } else {
            $wpdb->update($wpdb->prefix . 'gsm_notifications',
                array('retry_count' => $notif->retry_count + 1),
                array('id' => $notif->id)
            );
        }
    }
}

// Cron for notifications
if (!wp_next_scheduled('gsm_process_notifications_cron')) {
    wp_schedule_event(time(), 'hourly', 'gsm_process_notifications_cron');
}
add_action('gsm_process_notifications_cron', 'gsm_process_notifications');

// ============================================
// RATE LIMITING & LOGIN SECURITY
// ============================================

function gsm_check_login_attempts($user, $username) {
    $key = 'gsm_login_' . md5($username . $_SERVER['REMOTE_ADDR']);
    $attempts = get_transient($key);

    if ($attempts && $attempts >= 5) {
        return new WP_Error('too_many_attempts',
            __('Too many failed attempts. Try again in 15 minutes.', 'gsm-complete'));
    }

    return $user;
}
add_filter('authenticate', 'gsm_check_login_attempts', 30, 2);

function gsm_record_failed_login($username) {
    $key = 'gsm_login_' . md5($username . $_SERVER['REMOTE_ADDR']);
    $attempts = get_transient($key) ?: 0;
    set_transient($key, $attempts + 1, 15 * MINUTE_IN_SECONDS);
}
add_action('wp_login_failed', 'gsm_record_failed_login');

function gsm_clear_login_attempts($user_login) {
    $key = 'gsm_login_' . md5($user_login . $_SERVER['REMOTE_ADDR']);
    delete_transient($key);
}
add_action('wp_login', 'gsm_clear_login_attempts');

// ============================================
// 2FA USER PROFILE INTEGRATION
// ============================================

function gsm_user_2fa_fields($user) {
    global $wpdb;

    $secret_data = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}gsm_2fa_secrets WHERE user_id = %d",
        $user->ID
    ));

    ?>
    <h2><?php _e('Two-Factor Authentication', 'gsm-complete'); ?></h2>
    <table class="form-table">
        <tr>
            <th><?php _e('2FA Status', 'gsm-complete'); ?></th>
            <td>
                <?php if ($secret_data && $secret_data->enabled): ?>
                    <span class="badge badge-success">✓ Enabled</span>
                    <p>
                        <button type="button" class="button" onclick="if(confirm('Disable 2FA?')) { document.getElementById('gsm_disable_2fa').value='1'; this.form.submit(); }">
                            <?php _e('Disable 2FA', 'gsm-complete'); ?>
                        </button>
                        <input type="hidden" name="gsm_disable_2fa" id="gsm_disable_2fa" value="">
                    </p>
                <?php else: ?>
                    <span class="badge badge-warning">⚠ Disabled</span>
                    <p>
                        <button type="button" class="button button-primary" id="gsm-setup-2fa">
                            <?php _e('Setup 2FA', 'gsm-complete'); ?>
                        </button>
                    </p>
                    <div id="gsm-2fa-setup" style="display:none; margin-top:15px;">
                        <?php
                        $totp = new GSM_TOTP();
                        $secret = $totp->getSecret();
                        $qr_url = $totp->getQRCodeUrl(get_bloginfo('name'), $user->user_login);
                        ?>
                        <p><strong><?php _e('Scan this QR code with your authenticator app:', 'gsm-complete'); ?></strong></p>
                        <img src="<?php echo esc_url($qr_url); ?>" alt="QR Code">
                        <p><strong><?php _e('Or enter this secret manually:', 'gsm-complete'); ?></strong></p>
                        <code style="font-size:16px; padding:5px 10px; background:#f0f0f0;"><?php echo esc_html($secret); ?></code>

                        <p style="margin-top:15px;">
                            <strong><?php _e('Backup Codes (save these!):', 'gsm-complete'); ?></strong>
                        </p>
                        <?php
                        $backup_codes = GSM_TOTP::generateBackupCodes(10);
                        echo '<textarea readonly style="width:100%; height:150px; font-family:monospace;">';
                        foreach ($backup_codes as $code) {
                            echo $code . "\n";
                        }
                        echo '</textarea>';
                        ?>

                        <p>
                            <label>
                                <?php _e('Enter verification code to enable:', 'gsm-complete'); ?>
                                <input type="text" name="gsm_2fa_code" maxlength="6" pattern="[0-9]{6}">
                            </label>
                        </p>

                        <input type="hidden" name="gsm_2fa_secret" value="<?php echo esc_attr($secret); ?>">
                        <input type="hidden" name="gsm_backup_codes" value="<?php echo esc_attr(json_encode($backup_codes)); ?>">
                    </div>

                    <script>
                    document.getElementById('gsm-setup-2fa').addEventListener('click', function() {
                        document.getElementById('gsm-2fa-setup').style.display = 'block';
                        this.style.display = 'none';
                    });
                    </script>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'gsm_user_2fa_fields');
add_action('edit_user_profile', 'gsm_user_2fa_fields');

function gsm_save_user_2fa($user_id) {
    global $wpdb;

    if (isset($_POST['gsm_disable_2fa']) && $_POST['gsm_disable_2fa'] === '1') {
        $wpdb->delete($wpdb->prefix . 'gsm_2fa_secrets', array('user_id' => $user_id));
        $wpdb->delete($wpdb->prefix . 'gsm_backup_codes', array('user_id' => $user_id));
        return;
    }

    if (isset($_POST['gsm_2fa_code']) && isset($_POST['gsm_2fa_secret'])) {
        $code = sanitize_text_field($_POST['gsm_2fa_code']);
        $secret = sanitize_text_field($_POST['gsm_2fa_secret']);

        $totp = new GSM_TOTP($secret);

        if ($totp->verifyCode($code)) {
            // Save secret
            $wpdb->replace($wpdb->prefix . 'gsm_2fa_secrets', array(
                'user_id' => $user_id,
                'secret' => $secret,
                'enabled' => 1,
            ));

            // Save backup codes
            if (isset($_POST['gsm_backup_codes'])) {
                $codes = json_decode(stripslashes($_POST['gsm_backup_codes']), true);
                foreach ($codes as $code) {
                    $wpdb->insert($wpdb->prefix . 'gsm_backup_codes', array(
                        'user_id' => $user_id,
                        'code_hash' => hash('sha256', $code),
                    ));
                }
            }
        }
    }
}
add_action('personal_options_update', 'gsm_save_user_2fa');
add_action('edit_user_profile_update', 'gsm_save_user_2fa');

// ============================================
// ADMIN MENU & SETTINGS
// ============================================

function gsm_admin_menu() {
    add_menu_page(
        'GSM Settings',
        'GSM Settings',
        'manage_options',
        'gsm-settings',
        'gsm_settings_page',
        'dashicons-admin-generic',
        30
    );

    add_submenu_page(
        'gsm-settings',
        'General Settings',
        'General',
        'manage_options',
        'gsm-settings',
        'gsm_settings_page'
    );

    add_submenu_page(
        'gsm-settings',
        'Payment Gateways',
        'Payments',
        'manage_options',
        'gsm-payments',
        'gsm_payments_page'
    );

    add_submenu_page(
        'gsm-settings',
        'Notifications',
        'Notifications',
        'manage_options',
        'gsm-notifications',
        'gsm_notifications_page'
    );

    add_submenu_page(
        'gsm-settings',
        'Audit Logs',
        'Audit Logs',
        'manage_options',
        'gsm-audit',
        'gsm_audit_page'
    );
}
add_action('admin_menu', 'gsm_admin_menu');

function gsm_settings_page() {
    if (isset($_POST['gsm_save_settings'])) {
        check_admin_referer('gsm_settings');

        update_option('gsm_currency_symbol', sanitize_text_field($_POST['currency_symbol']));
        update_option('gsm_min_deposit', floatval($_POST['min_deposit']));
        update_option('gsm_commission_rate', intval($_POST['commission_rate']));

        echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
    }

    $currency = get_option('gsm_currency_symbol', '$');
    $min_deposit = get_option('gsm_min_deposit', 10);
    $commission = get_option('gsm_commission_rate', 10);
    ?>
    <div class="wrap">
        <h1>GSM General Settings</h1>
        <form method="post">
            <?php wp_nonce_field('gsm_settings'); ?>

            <table class="form-table">
                <tr>
                    <th>Currency Symbol</th>
                    <td><input type="text" name="currency_symbol" value="<?php echo esc_attr($currency); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th>Minimum Deposit</th>
                    <td><input type="number" name="min_deposit" value="<?php echo esc_attr($min_deposit); ?>" step="0.01" class="regular-text"></td>
                </tr>
                <tr>
                    <th>Commission Rate (%)</th>
                    <td><input type="number" name="commission_rate" value="<?php echo esc_attr($commission); ?>" min="0" max="100" class="regular-text"></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" name="gsm_save_settings" class="button button-primary" value="Save Settings">
            </p>
        </form>
    </div>
    <?php
}

function gsm_payments_page() {
    if (isset($_POST['gsm_save_payments'])) {
        check_admin_referer('gsm_payments');

        update_option('gsm_stripe_public_key', sanitize_text_field($_POST['stripe_public']));
        update_option('gsm_stripe_secret_key', sanitize_text_field($_POST['stripe_secret']));
        update_option('gsm_paypal_client_id', sanitize_text_field($_POST['paypal_client']));
        update_option('gsm_paypal_secret', sanitize_text_field($_POST['paypal_secret']));

        echo '<div class="notice notice-success"><p>Payment settings saved!</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Payment Gateway Settings</h1>
        <form method="post">
            <?php wp_nonce_field('gsm_payments'); ?>

            <h2>Stripe</h2>
            <table class="form-table">
                <tr>
                    <th>Publishable Key</th>
                    <td><input type="text" name="stripe_public" value="<?php echo esc_attr(get_option('gsm_stripe_public_key')); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th>Secret Key</th>
                    <td><input type="password" name="stripe_secret" value="<?php echo esc_attr(get_option('gsm_stripe_secret_key')); ?>" class="large-text"></td>
                </tr>
            </table>

            <h2>PayPal</h2>
            <table class="form-table">
                <tr>
                    <th>Client ID</th>
                    <td><input type="text" name="paypal_client" value="<?php echo esc_attr(get_option('gsm_paypal_client_id')); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th>Secret</th>
                    <td><input type="password" name="paypal_secret" value="<?php echo esc_attr(get_option('gsm_paypal_secret')); ?>" class="large-text"></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" name="gsm_save_payments" class="button button-primary" value="Save Payment Settings">
            </p>
        </form>
    </div>
    <?php
}

function gsm_notifications_page() {
    if (isset($_POST['gsm_save_notifications'])) {
        check_admin_referer('gsm_notifications');

        update_option('gsm_telegram_token', sanitize_text_field($_POST['telegram_token']));
        update_option('gsm_telegram_chat_id', sanitize_text_field($_POST['telegram_chat_id']));

        echo '<div class="notice notice-success"><p>Notification settings saved!</p></div>';
    }

    if (isset($_POST['gsm_test_telegram'])) {
        $result = gsm_send_telegram('Test message from GSM Services');
        if ($result) {
            echo '<div class="notice notice-success"><p>Telegram test successful!</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>Telegram test failed!</p></div>';
        }
    }
    ?>
    <div class="wrap">
        <h1>Notification Settings</h1>
        <form method="post">
            <?php wp_nonce_field('gsm_notifications'); ?>

            <h2>Telegram Bot</h2>
            <table class="form-table">
                <tr>
                    <th>Bot Token</th>
                    <td><input type="text" name="telegram_token" value="<?php echo esc_attr(get_option('gsm_telegram_token')); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th>Chat ID</th>
                    <td><input type="text" name="telegram_chat_id" value="<?php echo esc_attr(get_option('gsm_telegram_chat_id')); ?>" class="regular-text"></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" name="gsm_save_notifications" class="button button-primary" value="Save Settings">
                <input type="submit" name="gsm_test_telegram" class="button" value="Test Telegram">
            </p>
        </form>
    </div>
    <?php
}

function gsm_audit_page() {
    global $wpdb;

    $logs = $wpdb->get_results("
        SELECT * FROM {$wpdb->prefix}gsm_audit_logs
        ORDER BY created_at DESC
        LIMIT 100
    ");
    ?>
    <div class="wrap">
        <h1>Audit Logs</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Date/Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>IP Address</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log):
                    $user = get_userdata($log->user_id);
                ?>
                <tr>
                    <td><?php echo esc_html($log->created_at); ?></td>
                    <td><?php echo $user ? esc_html($user->user_login) : 'N/A'; ?></td>
                    <td><?php echo esc_html($log->action); ?></td>
                    <td><?php echo esc_html($log->ip_address); ?></td>
                    <td><?php echo esc_html($log->details); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// ============================================
// HELPER FUNCTIONS
// ============================================

function gsm_format_price($amount) {
    $symbol = get_option('gsm_currency_symbol', '$');
    return $symbol . number_format($amount, 2);
}

function gsm_log_audit($action, $details = '') {
    global $wpdb;

    $wpdb->insert($wpdb->prefix . 'gsm_audit_logs', array(
        'user_id' => get_current_user_id(),
        'action' => $action,
        'details' => $details,
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    ));
}

// ============================================
// AJAX HANDLERS
// ============================================

function gsm_ajax_create_order() {
    check_ajax_referer('gsm-nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error('Not logged in');
    }

    $service_id = intval($_POST['service_id']);
    $imei = sanitize_text_field($_POST['imei']);

    $service = get_post($service_id);
    if (!$service) {
        wp_send_json_error('Invalid service');
    }

    $price = get_post_meta($service_id, 'price', true);
    $user_id = get_current_user_id();

    // Check balance
    if (gsm_get_user_balance($user_id) < $price) {
        wp_send_json_error('Insufficient balance');
    }

    // Create order
    $order_id = wp_insert_post(array(
        'post_type' => 'gsm_order',
        'post_title' => 'Order #' . time(),
        'post_status' => 'publish',
        'post_author' => $user_id,
    ));

    update_post_meta($order_id, 'service_id', $service_id);
    update_post_meta($order_id, 'imei', $imei);
    update_post_meta($order_id, 'price', $price);
    update_post_meta($order_id, 'status', 'pending');

    // Deduct from balance
    gsm_update_user_balance($user_id, -$price, 'order', 'Order #' . $order_id, $order_id);

    // Send notification
    $message = "New Order #" . $order_id . "\nService: " . $service->post_title . "\nPrice: " . gsm_format_price($price);
    gsm_queue_notification('telegram', get_option('gsm_telegram_chat_id'), $message);

    gsm_log_audit('order_created', 'Order ID: ' . $order_id);

    wp_send_json_success(array('order_id' => $order_id));
}
add_action('wp_ajax_gsm_create_order', 'gsm_ajax_create_order');

// ============================================
// WIDGETS
// ============================================

function gsm_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'gsm_widgets_init');
