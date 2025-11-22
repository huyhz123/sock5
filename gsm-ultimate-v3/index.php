<?php
/**
 * Main blog listing template
 */

get_header();

$lang = gsm_get_current_language();
?>

<section class="blog-section" style="padding-top: 60px;">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <h1 class="section-title">
                <?php
                if (is_home()) {
                    echo gsm_t('blog');
                } elseif (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    the_author();
                } elseif (is_day()) {
                    the_time('F j, Y');
                } elseif (is_month()) {
                    the_time('F Y');
                } elseif (is_year()) {
                    the_time('Y');
                } else {
                    echo gsm_t('blog');
                }
                ?>
            </h1>

            <?php if (is_home()) : ?>
                <p class="section-subtitle">
                    <?php
                    if ($lang === 'en') echo 'Latest news, guides and updates';
                    elseif ($lang === 'zh') echo '最新新闻、指南和更新';
                    else echo 'Tin tức, hướng dẫn và cập nhật mới nhất';
                    ?>
                </p>
            <?php elseif (is_category() || is_tag()) : ?>
                <p class="section-subtitle">
                    <?php echo term_description(); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Blog Grid -->
        <div class="blog-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article <?php post_class('blog-card'); ?>>
                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('gsm-blog-thumb', array('class' => 'blog-image')); ?>
                            </a>
                        <?php else : ?>
                            <div class="blog-image">
                                <i class="far fa-newspaper" style="font-size: 80px; color: var(--color-gray-light);"></i>
                            </div>
                        <?php endif; ?>

                        <div class="blog-content">
                            <!-- Blog Meta -->
                            <div class="blog-meta">
                                <span>
                                    <i class="far fa-calendar"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                <span>
                                    <i class="far fa-user"></i>
                                    <?php the_author(); ?>
                                </span>
                                <?php if (get_comments_number()) : ?>
                                    <span>
                                        <i class="far fa-comments"></i>
                                        <?php comments_number('0', '1', '%'); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Blog Title -->
                            <h2 class="blog-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <!-- Blog Excerpt -->
                            <p class="blog-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                            </p>

                            <!-- Category Tags -->
                            <?php
                            $categories = get_the_category();
                            if ($categories) :
                                ?>
                                <div style="margin-bottom: var(--spacing-sm);">
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="product-category" style="display: inline-block; margin-right: 8px; font-size: 13px;">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Read More Button -->
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                                <?php echo gsm_t('read_more'); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile;

                // Pagination
                ?>
                <div style="grid-column: 1 / -1; margin-top: var(--spacing-xl);">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-arrow-left"></i> ' . ($lang === 'en' ? 'Previous' : ($lang === 'zh' ? '上一页' : 'Trước')),
                        'next_text' => ($lang === 'en' ? 'Next' : ($lang === 'zh' ? '下一页' : 'Sau')) . ' <i class="fas fa-arrow-right"></i>',
                        'class' => 'pagination',
                    ));
                    ?>
                </div>
            <?php
            else :
                ?>
                <div class="card" style="grid-column: 1 / -1; text-align: center; padding: var(--spacing-xxl);">
                    <div style="font-size: 80px; margin-bottom: var(--spacing-lg); opacity: 0.3;">
                        <i class="far fa-folder-open"></i>
                    </div>
                    <h2 style="color: var(--color-black); margin-bottom: var(--spacing-sm);">
                        <?php
                        if ($lang === 'en') echo 'No posts found';
                        elseif ($lang === 'zh') echo '未找到文章';
                        else echo 'Không tìm thấy bài viết';
                        ?>
                    </h2>
                    <p style="color: var(--color-gray-light); margin-bottom: var(--spacing-lg);">
                        <?php
                        if ($lang === 'en') echo 'Sorry, no posts match your criteria.';
                        elseif ($lang === 'zh') echo '抱歉，没有符合您要求的文章。';
                        else echo 'Rất tiếc, không có bài viết phù hợp.';
                        ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-home"></i>
                        <?php
                        if ($lang === 'en') echo 'Back to Home';
                        elseif ($lang === 'zh') echo '返回首页';
                        else echo 'Về trang chủ';
                        ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
/* Pagination styling */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: var(--spacing-xs);
    flex-wrap: wrap;
}

.pagination .page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    height: 44px;
    padding: 0 var(--spacing-sm);
    background: var(--color-white);
    border: var(--border-width) solid var(--border-color);
    border-radius: var(--border-radius-sm);
    color: var(--color-gray-dark);
    font-weight: 600;
    transition: var(--transition-fast);
    text-decoration: none;
}

.pagination .page-numbers:hover {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: var(--color-black);
    transform: translateY(-2px);
}

.pagination .page-numbers.current {
    background: var(--gradient-primary);
    border-color: var(--color-primary);
    color: var(--color-black);
    box-shadow: var(--shadow-md);
}

.pagination .page-numbers.dots {
    border: none;
    background: transparent;
}
</style>

<?php get_footer(); ?>
