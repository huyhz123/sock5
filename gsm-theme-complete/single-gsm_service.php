<?php get_header(); ?>

<main class="site-content">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <div class="grid grid-2">
                <div>
                    <div class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                            <div class="service-image">📱</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <div class="card">
                        <h1><?php the_title(); ?></h1>

                        <div class="service-price">
                            <?php echo gsm_format_price(get_post_meta(get_the_ID(), 'price', true)); ?>
                        </div>

                        <div class="service-delivery">
                            ⏱️ Delivery: <?php echo esc_html(get_post_meta(get_the_ID(), 'delivery_time', true) ?: '1-24 hours'); ?>
                        </div>

                        <div class="service-description">
                            <?php the_content(); ?>
                        </div>

                        <?php if (is_user_logged_in()) : ?>
                            <form id="order-form" class="order-form">
                                <div class="form-group">
                                    <label class="form-label required">IMEI Number</label>
                                    <input type="text" name="imei" class="form-control" required pattern="[0-9]{15}" placeholder="Enter 15-digit IMEI">
                                    <span class="form-text">Enter your device IMEI number (15 digits)</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Model (Optional)</label>
                                    <input type="text" name="model" class="form-control" placeholder="e.g., iPhone 14 Pro">
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    🛒 Place Order - <?php echo gsm_format_price(get_post_meta(get_the_ID(), 'price', true)); ?>
                                </button>
                            </form>

                            <script>
                            document.getElementById('order-form').addEventListener('submit', function(e) {
                                e.preventDefault();

                                const formData = new FormData(this);
                                formData.append('action', 'gsm_create_order');
                                formData.append('service_id', '<?php echo get_the_ID(); ?>');
                                formData.append('nonce', gsmAjax.nonce);

                                fetch(gsmAjax.ajaxurl, {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('Order created successfully! Order ID: ' + data.data.order_id);
                                        location.href = '<?php echo home_url('/account/orders'); ?>';
                                    } else {
                                        alert('Error: ' + data.data);
                                    }
                                })
                                .catch(err => alert('Error: ' + err));
                            });
                            </script>
                        <?php else : ?>
                            <div class="alert alert-info">
                                <p><strong>Please login to place an order</strong></p>
                                <a href="<?php echo wp_login_url(get_permalink()); ?>" class="btn btn-primary">Login</a>
                                <a href="<?php echo wp_registration_url(); ?>" class="btn btn-secondary">Register</a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="card">
                        <h3>Service Features</h3>
                        <ul>
                            <li>✓ Fast delivery</li>
                            <li>✓ 100% safe and secure</li>
                            <li>✓ Money-back guarantee</li>
                            <li>✓ 24/7 support</li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
