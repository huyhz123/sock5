<footer class="site-footer">
    <div class="container">
        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <div class="footer-widgets">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </div>
        <?php endif; ?>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            <p class="security-badge">
                🔒 Secured with Enterprise-Grade Security | 2FA Enabled | OWASP Compliant
            </p>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'container' => 'nav',
                'container_class' => 'footer-nav',
                'fallback_cb' => false,
            ));
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
// Mobile menu toggle
document.querySelector('.mobile-menu-toggle')?.addEventListener('click', function() {
    document.querySelector('.main-navigation').classList.toggle('active');
});
</script>

</body>
</html>
