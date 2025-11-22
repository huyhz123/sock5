<?php get_header(); ?>

<section class="blog-section" style="padding-top: 60px;">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article class="single-post" style="max-width: 900px; margin: 0 auto;">
                    <header class="post-header" style="margin-bottom: 30px;">
                        <h1 class="section-title" style="text-align: left; margin-bottom: 20px;">
                            <?php the_title(); ?>
                        </h1>

                        <div class="blog-meta" style="display: flex; gap: 20px; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 2px solid var(--border-color);">
                            <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                            <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                            <?php if (get_comments_number()) : ?>
                                <span><i class="far fa-comments"></i> <?php comments_number('0 bình luận', '1 bình luận', '% bình luận'); ?></span>
                            <?php endif; ?>
                            <span><i class="far fa-eye"></i> <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: '0'; ?> lượt xem</span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail" style="margin-bottom: 30px; border-radius: var(--radius); overflow: hidden;">
                            <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content" style="color: var(--text-secondary); line-height: 1.8; font-size: 17px;">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links" style="margin-top: 30px; padding-top: 30px; border-top: 1px solid var(--border-color);">',
                            'after' => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (get_the_tags()) : ?>
                        <div class="post-tags" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--border-color);">
                            <strong style="color: var(--text-color); margin-right: 10px;"><i class="fas fa-tags"></i> Tags:</strong>
                            <?php the_tags('', ', ', ''); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-navigation" style="margin-top: 40px; padding-top: 30px; border-top: 2px solid var(--border-color); display: flex; justify-content: space-between; gap: 20px;">
                        <div>
                            <?php
                            $prev_post = get_previous_post();
                            if ($prev_post) :
                                ?>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Bài trước
                                </a>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php
                            $next_post = get_next_post();
                            if ($next_post) :
                                ?>
                                <a href="<?php echo get_permalink($next_post); ?>" class="btn btn-secondary">
                                    Bài sau <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php
                    // Comments
                    if (comments_open() || get_comments_number()) :
                        ?>
                        <div class="comments-area" style="margin-top: 60px; padding-top: 40px; border-top: 2px solid var(--border-color);">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </article>

                <!-- Related Posts -->
                <div class="related-posts" style="margin-top: 60px; padding-top: 40px; border-top: 2px solid var(--border-color);">
                    <h3 class="section-title" style="font-size: 28px; margin-bottom: 30px;">Bài Viết Liên Quan</h3>
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
                                            <img src="<?php the_post_thumbnail_url('gsm-blog-thumb'); ?>" alt="<?php the_title(); ?>" class="blog-image">
                                        <?php else : ?>
                                            <div class="blog-image" style="display: flex; align-items: center; justify-content: center; font-size: 48px;">📱</div>
                                        <?php endif; ?>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                            </div>
                                            <h4 class="blog-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Đọc thêm</a>
                                        </div>
                                    </article>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p style="color: var(--text-secondary);">Không có bài viết liên quan.</p>';
                            endif;
                        }
                        ?>
                    </div>
                </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
