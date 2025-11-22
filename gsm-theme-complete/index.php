<?php get_header(); ?>

<main class="site-content">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="grid grid-3">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-meta">
                                <span><?php echo get_the_date(); ?></span>
                                <span><?php the_author(); ?></span>
                            </div>
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <div class="card">
                <h2>No posts found</h2>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
