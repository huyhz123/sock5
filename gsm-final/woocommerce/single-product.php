<?php
/**
 * WooCommerce Single Product Template
 *
 * This template overrides WooCommerce default single product template
 * Customized for GSM Ultimate Theme v3.5
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content
 */
do_action('woocommerce_before_main_content');

?>

<?php while (have_posts()) : the_post(); ?>

    <?php wc_get_template_part('content', 'single-product'); ?>

<?php endwhile; ?>

<?php
/**
 * Hook: woocommerce_after_main_content
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar
 */
do_action('woocommerce_sidebar');

get_footer('shop');
