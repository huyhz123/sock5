<?php get_header(); ?>

<section class="blog-section" style="padding-top: 60px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">
                <?php
                if (is_home()) {
                    echo 'Blog & Tin Tức';
                } else {
                    the_archive_title();
                }
                ?>
            </h1>
            <?php if (is_home()) : ?>
                <p class="section-subtitle">Cập nhật kiến thức và tin tức công nghệ mới nhất</p>
            <?php endif; ?>
        </div>

        <div class="blog-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article class="blog-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('gsm-blog-thumb'); ?>" alt="<?php the_title(); ?>" class="blog-image">
                        <?php else : ?>
                            <div class="blog-image" style="display: flex; align-items: center; justify-content: center; font-size: 48px;">
                                📱
                            </div>
                        <?php endif; ?>

                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                                <?php if (get_comments_number()) : ?>
                                    <span><i class="far fa-comments"></i> <?php comments_number('0', '1', '%'); ?></span>
                                <?php endif; ?>
                            </div>

                            <h2 class="blog-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>

                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                                Đọc thêm <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile;

                // Pagination
                ?>
                <div style="grid-column: 1 / -1; margin-top: 40px; text-align: center;">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-arrow-left"></i> Trước',
                        'next_text' => 'Sau <i class="fas fa-arrow-right"></i>',
                    ));
                    ?>
                </div>
            <?php
            else :
                ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <h2 style="color: var(--text-color); margin-bottom: 15px;">Không tìm thấy bài viết nào</h2>
                    <p style="color: var(--text-secondary); margin-bottom: 30px;">
                        Rất tiếc, chúng tôi không tìm thấy bài viết nào phù hợp.
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i> Về trang chủ
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
