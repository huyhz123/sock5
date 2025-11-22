<?php
/**
 * Main blog listing template
 */

get_header();

$lang = gsm_get_current_language();
?>

<section class="blog-section" style="padding-top: 60px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">
                <?php
                if (is_home()) {
                    echo gsm_t('blog');
                } else {
                    the_archive_title();
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
            <?php endif; ?>
        </div>

        <div class="blog-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article class="blog-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('gsm-blog-thumb', array('class' => 'blog-image')); ?>
                        <?php else : ?>
                            <div class="blog-image">📰</div>
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
                                <?php echo gsm_t('read_more'); ?> <i class="fas fa-arrow-right"></i>
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
                        'prev_text' => '<i class="fas fa-arrow-left"></i> ' . ($lang === 'en' ? 'Previous' : ($lang === 'zh' ? '上一页' : 'Trước')),
                        'next_text' => ($lang === 'en' ? 'Next' : ($lang === 'zh' ? '下一页' : 'Sau')) . ' <i class="fas fa-arrow-right"></i>',
                    ));
                    ?>
                </div>
            <?php
            else :
                ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <h2 style="color: var(--color-black); margin-bottom: 15px;">
                        <?php
                        if ($lang === 'en') echo 'No posts found';
                        elseif ($lang === 'zh') echo '未找到文章';
                        else echo 'Không tìm thấy bài viết';
                        ?>
                    </h2>
                    <p style="color: var(--color-gray-light); margin-bottom: 30px;">
                        <?php
                        if ($lang === 'en') echo 'Sorry, no posts match your criteria.';
                        elseif ($lang === 'zh') echo '抱歉，没有符合您要求的文章。';
                        else echo 'Rất tiếc, không có bài viết phù hợp.';
                        ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
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

<?php get_footer(); ?>
