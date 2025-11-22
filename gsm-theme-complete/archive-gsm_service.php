<?php get_header(); ?>

<main class="site-content">
    <div class="container">
        <div class="card">
            <h1>🛍️ Our Services</h1>
            <p>Browse our complete range of GSM services</p>
        </div>

        <?php if (have_posts()) : ?>
            <div class="grid grid-3">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="service-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="service-image">
                                <?php the_post_thumbnail('gsm-service'); ?>
                            </div>
                        <?php else : ?>
                            <div class="service-image">📱</div>
                        <?php endif; ?>

                        <div class="service-content">
                            <h3 class="service-title"><?php the_title(); ?></h3>

                            <div class="service-price">
                                <?php echo gsm_format_price(get_post_meta(get_the_ID(), 'price', true)); ?>
                            </div>

                            <div class="service-delivery">
                                ⏱️ <?php echo esc_html(get_post_meta(get_the_ID(), 'delivery_time', true) ?: '1-24 hours'); ?>
                            </div>

                            <?php the_excerpt(); ?>

                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                                View Details →
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <div class="card">
                <p>No services available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
