<?php
/**
 * General page template
 */

get_header();

$lang = gsm_get_current_language();
?>

<section class="products-section" style="padding-top: 60px;">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>

            <article <?php post_class(); ?> style="max-width: 900px; margin: 0 auto;">
                <!-- Page Title -->
                <header class="section-header">
                    <h1 class="section-title"><?php the_title(); ?></h1>
                </header>

                <!-- Page Content -->
                <div class="card" style="padding: var(--spacing-xl);">
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="margin-bottom: var(--spacing-lg);">
                            <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: var(--border-radius-md);')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="page-content" style="color: var(--color-gray-dark); line-height: 1.8; font-size: 17px;">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links" style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: var(--border-width) solid var(--border-color);">',
                            'after' => '</div>',
                        ));
                        ?>
                    </div>
                </div>

                <!-- Comments (if enabled) -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
            </article>

        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
