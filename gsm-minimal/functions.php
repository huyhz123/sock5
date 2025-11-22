<?php
/**
 * GSM Services - Clean Version
 * Functions and definitions
 */

// Theme Constants
define('GSM_VERSION', '1.0.0');

/**
 * Theme Setup
 */
function gsm_clean_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'gsm_clean_setup');

/**
 * Enqueue scripts and styles
 */
function gsm_clean_scripts() {
    wp_enqueue_style('gsm-clean-style', get_stylesheet_uri(), array(), GSM_VERSION);
}
add_action('wp_enqueue_scripts', 'gsm_clean_scripts');

/**
 * WooCommerce: Remove default wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * WooCommerce: Add custom wrappers
 */
function gsm_clean_woocommerce_wrapper_start() {
    echo '<div class="container"><main class="site-content">';
}
add_action('woocommerce_before_main_content', 'gsm_clean_woocommerce_wrapper_start', 10);

function gsm_clean_woocommerce_wrapper_end() {
    echo '</main></div>';
}
add_action('woocommerce_after_main_content', 'gsm_clean_woocommerce_wrapper_end', 10);

/**
 * WooCommerce: Disable sidebar
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
