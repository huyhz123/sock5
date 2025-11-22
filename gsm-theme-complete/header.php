<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-top">
        <div class="container">
            <div class="header-contact">
                <a href="mailto:support@gsmservices.com">📧 support@gsmservices.com</a>
                <a href="tel:+1234567890">📞 +1 (234) 567-890</a>
            </div>
            <?php if (is_user_logged_in()) : ?>
                <div class="user-info">
                    <span>👤 <?php echo wp_get_current_user()->display_name; ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="header-main">
        <div class="container">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo home_url(); ?>" class="site-title"><?php bloginfo('name'); ?></a>
                <?php endif; ?>
            </div>

            <button class="mobile-menu-toggle">☰</button>

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'fallback_cb' => false,
                ));
                ?>

                <div class="user-menu">
                    <?php if (is_user_logged_in()) : ?>
                        <span class="user-balance">
                            💰 <?php echo gsm_format_price(gsm_get_user_balance()); ?>
                        </span>
                        <a href="<?php echo home_url('/account'); ?>" class="btn btn-sm">My Account</a>
                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-sm btn-secondary">Logout</a>
                    <?php else : ?>
                        <a href="<?php echo wp_login_url(); ?>" class="btn btn-sm">Login</a>
                        <a href="<?php echo wp_registration_url(); ?>" class="btn btn-sm btn-primary">Register</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>
</header>

<?php
// Display flash messages
if (isset($_GET['msg'])) {
    $msg_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'info';
    $message = sanitize_text_field($_GET['msg']);
    echo '<div class="container"><div class="alert alert-' . esc_attr($msg_type) . '">' . esc_html($message) . '</div></div>';
}
?>
