<?php
/**
 * Single blog post template
 */

get_header();

$lang = gsm_get_current_language();
?>

<section class="blog-section" style="padding-top: 60px;">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
            ?>
            <article style="max-width: 900px; margin: 0 auto;">
                <header style="margin-bottom: 30px;">
                    <h1 class="section-title" style="text-align: left; margin-bottom: 20px;">
                        <?php the_title(); ?>
                    </h1>

                    <div class="blog-meta" style="display: flex; gap: 20px; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 2px solid var(--border-color);">
                        <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                        <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                        <?php if (get_comments_number()) : ?>
                            <span><i class="far fa-comments"></i> <?php comments_number('0', '1', '%'); ?></span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom: 30px; border: var(--border-width) solid var(--border-color);">
                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                    </div>
                <?php endif; ?>

                <div style="color: var(--color-gray-dark); line-height: 1.8; font-size: 17px; margin-bottom: 40px;">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div style="margin-top: 30px; padding-top: 30px; border-top: var(--border-width) solid var(--border-color);">',
                        'after' => '</div>',
                    ));
                    ?>
                </div>

                <?php if (get_the_tags()) : ?>
                    <div style="margin-top: 40px; padding-top: 30px; border-top: var(--border-width) solid var(--border-color);">
                        <strong style="color: var(--color-black); margin-right: 10px;"><i class="fas fa-tags"></i>
                            <?php
                            if ($lang === 'en') echo 'Tags:';
                            elseif ($lang === 'zh') echo '标签：';
                            else echo 'Tags:';
                            ?>
                        </strong>
                        <?php the_tags('', ', ', ''); ?>
                    </div>
                <?php endif; ?>

                <div style="margin-top: 40px; padding-top: 30px; border-top: 2px solid var(--border-color); display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
                    <div>
                        <?php
                        $prev_post = get_previous_post();
                        if ($prev_post) :
                            ?>
                            <a href="<?php echo get_permalink($prev_post); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                <?php
                                if ($lang === 'en') echo 'Previous';
                                elseif ($lang === 'zh') echo '上一篇';
                                else echo 'Bài trước';
                                ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php
                        $next_post = get_next_post();
                        if ($next_post) :
                            ?>
                            <a href="<?php echo get_permalink($next_post); ?>" class="btn btn-secondary">
                                <?php
                                if ($lang === 'en') echo 'Next';
                                elseif ($lang === 'zh') echo '下一篇';
                                else echo 'Bài sau';
                                ?>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (comments_open() || get_comments_number()) : ?>
                    <div style="margin-top: 60px; padding-top: 40px; border-top: 2px solid var(--border-color);">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </article>

            <!-- Related Posts -->
            <div style="margin-top: 60px; padding-top: 40px; border-top: 2px solid var(--border-color);">
                <h3 class="section-title" style="font-size: 28px; margin-bottom: 30px;">
                    <?php
                    if ($lang === 'en') echo 'Related Posts';
                    elseif ($lang === 'zh') echo '相关文章';
                    else echo 'Bài Viết Liên Quan';
                    ?>
                </h3>
                <div class="blog-grid">
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $category) {
                            $category_ids[] = $category->term_id;
                        }

                        $related = new WP_Query(array(
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 3,
                            'orderby' => 'rand',
                        ));

                        if ($related->have_posts()) :
                            while ($related->have_posts()) : $related->the_post();
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
                                        </div>
                                        <h4 class="blog-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php echo gsm_t('read_more'); ?></a>
                                    </div>
                                </article>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p style="color: var(--color-gray-light);">';
                            if ($lang === 'en') echo 'No related posts.';
                            elseif ($lang === 'zh') echo '没有相关文章。';
                            else echo 'Không có bài viết liên quan.';
                            echo '</p>';
                        endif;
                    }
                    ?>
                </div>
            </div>
        <?php
        endwhile;
        ?>
    </div>
</section>

<?php get_footer(); ?>
