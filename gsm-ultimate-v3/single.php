<?php
/**
 * Single blog post template
 */

get_header();

$lang = gsm_get_current_language();
?>

<section class="blog-section" style="padding-top: 40px;">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>

            <!-- Breadcrumb -->
            <div style="margin-bottom: var(--spacing-md); font-size: var(--font-size-sm); color: var(--color-gray-light);">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo gsm_t('home'); ?></a>
                <span> / </span>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo gsm_t('blog'); ?></a>
                <span> / </span>
                <span><?php the_title(); ?></span>
            </div>

            <article <?php post_class(''); ?> style="max-width: 900px; margin: 0 auto;">

                <!-- Article Header -->
                <header class="card" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                    <h1 style="font-size: clamp(28px, 5vw, 42px); margin-bottom: var(--spacing-md); line-height: 1.3; color: var(--color-black);">
                        <?php the_title(); ?>
                    </h1>

                    <div class="blog-meta" style="display: flex; gap: var(--spacing-md); flex-wrap: wrap; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <?php echo get_avatar(get_the_author_meta('ID'), 50, '', '', array('style' => 'border-radius: 50%; border: 2px solid var(--color-primary);')); ?>
                            <div>
                                <strong style="display: block; color: var(--color-black); margin-bottom: 4px;">
                                    <?php the_author(); ?>
                                </strong>
                                <time datetime="<?php echo get_the_date('c'); ?>" style="font-size: var(--font-size-sm); color: var(--color-gray-light);">
                                    <i class="far fa-calendar"></i>
                                    <?php echo get_the_date(); ?>
                                </time>
                            </div>
                        </div>

                        <?php if (get_comments_number()) : ?>
                            <span style="display: flex; align-items: center; gap: 6px; color: var(--color-gray-light);">
                                <i class="far fa-comments"></i>
                                <?php comments_number('0', '1', '%'); ?>
                                <?php
                                if ($lang === 'en') echo 'Comments';
                                elseif ($lang === 'zh') echo '条评论';
                                else echo 'Bình luận';
                                ?>
                            </span>
                        <?php endif; ?>

                        <span style="display: flex; align-items: center; gap: 6px; color: var(--color-gray-light);">
                            <i class="far fa-clock"></i>
                            <?php
                            $reading_time = ceil(str_word_count(strip_tags(get_the_content())) / 200);
                            echo $reading_time;
                            if ($lang === 'en') echo ' min read';
                            elseif ($lang === 'zh') echo ' 分钟阅读';
                            else echo ' phút đọc';
                            ?>
                        </span>
                    </div>

                    <!-- Categories -->
                    <?php
                    $categories = get_the_category();
                    if ($categories) :
                        ?>
                        <div style="margin-top: var(--spacing-md); display: flex; gap: 8px; flex-wrap: wrap;">
                            <?php foreach ($categories as $category) : ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="product-category">
                                    <i class="fas fa-folder"></i>
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="card" style="margin-bottom: var(--spacing-lg); overflow: hidden;">
                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; display: block;')); ?>
                    </div>
                <?php endif; ?>

                <!-- Article Content -->
                <div class="card" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                    <div class="blog-content" style="color: var(--color-gray-dark); line-height: 1.8; font-size: 18px;">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links" style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: var(--border-width) solid var(--border-color);">',
                            'after' => '</div>',
                            'link_before' => '<span class="page-number">',
                            'link_after' => '</span>',
                        ));
                        ?>
                    </div>
                </div>

                <!-- Tags -->
                <?php if (get_the_tags()) : ?>
                    <div class="card" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                        <strong style="color: var(--color-black); margin-right: var(--spacing-sm); display: flex; align-items: center; gap: 8px; margin-bottom: var(--spacing-sm);">
                            <i class="fas fa-tags"></i>
                            <?php
                            if ($lang === 'en') echo 'Tags:';
                            elseif ($lang === 'zh') echo '标签：';
                            else echo 'Tags:';
                            ?>
                        </strong>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <?php
                            $tags = get_the_tags();
                            foreach ($tags as $tag) :
                                ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: var(--color-background); color: var(--color-gray-dark); border-radius: var(--border-radius-md); font-size: var(--font-size-sm); font-weight: 600; transition: var(--transition-fast);">
                                    <i class="fas fa-tag"></i>
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Post Navigation -->
                <div class="card" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-md);">
                        <div>
                            <?php
                            $prev_post = get_previous_post();
                            if ($prev_post) :
                                ?>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="btn btn-secondary btn-block" style="text-align: left;">
                                    <i class="fas fa-arrow-left"></i>
                                    <div style="margin-top: 4px;">
                                        <small style="display: block; opacity: 0.7; font-size: 12px;">
                                            <?php
                                            if ($lang === 'en') echo 'Previous Post';
                                            elseif ($lang === 'zh') echo '上一篇';
                                            else echo 'Bài trước';
                                            ?>
                                        </small>
                                        <?php echo wp_trim_words(get_the_title($prev_post), 6); ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div>
                            <?php
                            $next_post = get_next_post();
                            if ($next_post) :
                                ?>
                                <a href="<?php echo get_permalink($next_post); ?>" class="btn btn-secondary btn-block" style="text-align: right;">
                                    <i class="fas fa-arrow-right"></i>
                                    <div style="margin-top: 4px;">
                                        <small style="display: block; opacity: 0.7; font-size: 12px;">
                                            <?php
                                            if ($lang === 'en') echo 'Next Post';
                                            elseif ($lang === 'zh') echo '下一篇';
                                            else echo 'Bài sau';
                                            ?>
                                        </small>
                                        <?php echo wp_trim_words(get_the_title($next_post), 6); ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Author Bio -->
                <?php
                $author_bio = get_the_author_meta('description');
                if ($author_bio) :
                    ?>
                    <div class="card card-glass" style="padding: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                        <div style="display: flex; gap: var(--spacing-md); align-items: flex-start;">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('style' => 'border-radius: 50%; border: 3px solid var(--color-primary);')); ?>
                            <div style="flex: 1;">
                                <h3 style="margin-bottom: var(--spacing-xs); font-size: 20px;">
                                    <?php
                                    if ($lang === 'en') echo 'About';
                                    elseif ($lang === 'zh') echo '关于';
                                    else echo 'Về tác giả';
                                    ?>
                                    <?php the_author(); ?>
                                </h3>
                                <p style="color: var(--color-gray); line-height: 1.7; margin-bottom: var(--spacing-sm);">
                                    <?php echo esc_html($author_bio); ?>
                                </p>
                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="btn btn-sm btn-outline">
                                    <?php
                                    if ($lang === 'en') echo 'View all posts';
                                    elseif ($lang === 'zh') echo '查看所有文章';
                                    else echo 'Xem tất cả bài viết';
                                    ?>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Comments -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>

            </article>

            <!-- Related Posts -->
            <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-xl); border-top: 2px solid var(--border-color);">
                <h3 class="section-title" style="font-size: 32px; margin-bottom: var(--spacing-lg);">
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
                                        <div class="blog-image"><i class="far fa-newspaper" style="font-size: 80px; color: var(--color-gray-light);"></i></div>
                                    <?php endif; ?>

                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                        </div>

                                        <h4 class="blog-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>

                                        <p class="blog-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                        </p>

                                        <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                                            <?php echo gsm_t('read_more'); ?> <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p style="color: var(--color-gray-light); grid-column: 1 / -1; text-align: center;">';
                            if ($lang === 'en') echo 'No related posts.';
                            elseif ($lang === 'zh') echo '没有相关文章。';
                            else echo 'Không có bài viết liên quan.';
                            echo '</p>';
                        endif;
                    }
                    ?>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
