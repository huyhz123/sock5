<?php
/**
 * Comments Template - Modern 2025 Design
 */

if (post_password_required()) {
    return;
}

$lang = gsm_get_current_language();
?>

<div id="comments" class="comments-area" style="margin-top: var(--sp-12);">

    <?php if (have_comments()) : ?>
        <h3 class="comments-title" style="font-size: 28px; margin-bottom: var(--sp-8); display: flex; align-items: center; gap: 12px;">
            <i class="far fa-comments" style="color: var(--color-primary);"></i>
            <?php
            $comments_number = get_comments_number();
            if ($lang === 'en') {
                printf(_n('One Comment', '%1$s Comments', $comments_number, 'gsm-ultimate'), number_format_i18n($comments_number));
            } elseif ($lang === 'zh') {
                printf('%1$s 条评论', number_format_i18n($comments_number));
            } else {
                printf(_n('Một bình luận', '%1$s Bình luận', $comments_number, 'gsm-ultimate'), number_format_i18n($comments_number));
            }
            ?>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ul',
                'short_ping' => true,
                'avatar_size' => 60,
                'callback' => 'gsm_custom_comment',
            ));
            ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="comment-navigation" style="margin-top: var(--sp-8);">
                <div class="nav-links" style="display: flex; justify-content: space-between; gap: var(--sp-6);">
                    <?php
                    if (get_previous_comments_link()) :
                        ?>
                        <div class="nav-previous">
                            <?php previous_comments_link('<i class="fas fa-arrow-left"></i> ' . ($lang === 'en' ? 'Older Comments' : ($lang === 'zh' ? '较旧的评论' : 'Bình luận cũ hơn'))); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if (get_next_comments_link()) :
                        ?>
                        <div class="nav-next">
                            <?php next_comments_link(($lang === 'en' ? 'Newer Comments' : ($lang === 'zh' ? '较新的评论' : 'Bình luận mới hơn')) . ' <i class="fas fa-arrow-right"></i>'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments" style="color: var(--text-light); font-style: italic; padding: var(--sp-8); text-align: center; background: var(--bg); border-radius: var(--r-lg);">
            <?php
            if ($lang === 'en') echo 'Comments are closed.';
            elseif ($lang === 'zh') echo '评论已关闭。';
            else echo 'Bình luận đã đóng.';
            ?>
        </p>
    <?php endif; ?>

    <?php
    // Comment form
    if (comments_open()) :
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');

        $comment_form_args = array(
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title" style="font-size: 28px; margin-bottom: var(--sp-8); display: flex; align-items: center; gap: 12px;"><i class="far fa-edit" style="color: var(--color-primary);"></i>',
            'title_reply_after' => '</h3>',
            'title_reply' => $lang === 'en' ? 'Leave a Comment' : ($lang === 'zh' ? '发表评论' : 'Để lại bình luận'),
            'title_reply_to' => $lang === 'en' ? 'Leave a Reply to %s' : ($lang === 'zh' ? '回复 %s' : 'Trả lời %s'),
            'cancel_reply_link' => $lang === 'en' ? 'Cancel' : ($lang === 'zh' ? '取消' : 'Hủy'),
            'label_submit' => $lang === 'en' ? 'Post Comment' : ($lang === 'zh' ? '发表评论' : 'Gửi bình luận'),
            'submit_button' => '<button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> %4$s</button>',
            'class_form' => 'comment-form',
            'class_submit' => 'btn btn-primary',
            'comment_field' => '<div class="form-group"><label for="comment" class="form-label">' . ($lang === 'en' ? 'Comment' : ($lang === 'zh' ? '评论' : 'Bình luận')) . ($req ? ' <span style="color: var(--color-danger);">*</span>' : '') . '</label><textarea id="comment" name="comment" class="form-control" rows="6" required="required" placeholder="' . ($lang === 'en' ? 'Your comment...' : ($lang === 'zh' ? '您的评论...' : 'Bình luận của bạn...')) . '"></textarea></div>',
            'fields' => array(
                'author' => '<div class="row" style="margin-bottom: var(--sp-6);"><div class="col"><div class="form-group"><label for="author" class="form-label">' . ($lang === 'en' ? 'Name' : ($lang === 'zh' ? '姓名' : 'Tên')) . ($req ? ' <span style="color: var(--color-danger);">*</span>' : '') . '</label><input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required="required"' : '') . ' placeholder="' . ($lang === 'en' ? 'Your name' : ($lang === 'zh' ? '您的姓名' : 'Tên của bạn')) . '" /></div></div>',
                'email' => '<div class="col"><div class="form-group"><label for="email" class="form-label">' . ($lang === 'en' ? 'Email' : ($lang === 'zh' ? '电子邮件' : 'Email')) . ($req ? ' <span style="color: var(--color-danger);">*</span>' : '') . '</label><input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required="required"' : '') . ' placeholder="' . ($lang === 'en' ? 'your@email.com' : ($lang === 'zh' ? '您的邮箱' : 'email@example.com')) . '" /></div></div></div>',
                'url' => '<div class="form-group" style="margin-bottom: var(--sp-6);"><label for="url" class="form-label">' . ($lang === 'en' ? 'Website' : ($lang === 'zh' ? '网站' : 'Website')) . '</label><input id="url" name="url" type="url" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="https://..." /></div>',
            ),
        );

        comment_form($comment_form_args);
    endif;
    ?>

</div>

<?php
/**
 * Custom comment callback for modern design
 */
function gsm_custom_comment($comment, $args, $depth) {
    $lang = gsm_get_current_language();
    ?>
    <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
        <article class="comment-body" style="display: flex; gap: var(--sp-6); padding: var(--sp-8); background: var(--color-white); border: 1px solid var(--border); border-radius: var(--r-lg); margin-bottom: var(--sp-6); transition: var(--transition);">

            <!-- Comment Avatar -->
            <div class="comment-avatar" style="flex-shrink: 0;">
                <?php echo get_avatar($comment, 60, '', '', array('class' => 'avatar', 'style' => 'border-radius: 50%; border: 3px solid var(--color-primary);')); ?>
            </div>

            <!-- Comment Content -->
            <div class="comment-content-wrap" style="flex: 1; min-width: 0;">
                <!-- Comment Meta -->
                <div class="comment-meta" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: var(--sp-3); margin-bottom: var(--sp-3);">
                    <div>
                        <strong class="comment-author-name" style="font-size: 17px; color: var(--color-black); display: block; margin-bottom: 4px;">
                            <?php echo get_comment_author_link(); ?>
                        </strong>
                        <time class="comment-date" datetime="<?php comment_time('c'); ?>" style="font-size: var(--text-sm); color: var(--text-light); display: flex; align-items: center; gap: 6px;">
                            <i class="far fa-clock"></i>
                            <?php
                            printf(
                                '%1$s at %2$s',
                                get_comment_date(),
                                get_comment_time()
                            );
                            ?>
                        </time>
                    </div>

                    <?php if (comments_open()) : ?>
                        <div class="comment-reply">
                            <?php
                            comment_reply_link(array_merge($args, array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'before' => '',
                                'after' => '',
                                'reply_text' => '<i class="fas fa-reply"></i> ' . ($lang === 'en' ? 'Reply' : ($lang === 'zh' ? '回复' : 'Trả lời')),
                                'class' => 'btn btn-sm btn-outline',
                            )));
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Comment Text -->
                <?php if ($comment->comment_approved == '0') : ?>
                    <p style="color: var(--color-warning); font-style: italic; margin-bottom: var(--sp-3); padding: var(--sp-3); background: rgba(255, 152, 0, 0.1); border-radius: var(--r-sm);">
                        <i class="fas fa-info-circle"></i>
                        <?php
                        if ($lang === 'en') echo 'Your comment is awaiting moderation.';
                        elseif ($lang === 'zh') echo '您的评论正在等待审核。';
                        else echo 'Bình luận của bạn đang chờ phê duyệt.';
                        ?>
                    </p>
                <?php endif; ?>

                <div class="comment-text" style="color: var(--text); line-height: 1.7; font-size: 16px;">
                    <?php comment_text(); ?>
                </div>

                <!-- Edit Link -->
                <?php
                edit_comment_link(
                    '<i class="fas fa-edit"></i> ' . ($lang === 'en' ? 'Edit' : ($lang === 'zh' ? '编辑' : 'Sửa')),
                    '<div class="edit-link" style="margin-top: var(--sp-3); font-size: var(--text-sm);">',
                    '</div>'
                );
                ?>
            </div>
        </article>

        <?php
        // Children comments will be added by WordPress
}
?>

<style>
/* Comment form styling */
.comment-form {
    background: var(--color-white);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    padding: var(--sp-8);
    margin-top: var(--sp-12);
}

.comment-list {
    list-style: none;
    padding: 0;
    margin: 0 0 var(--sp-12) 0;
}

.comment-list .children {
    list-style: none;
    margin-left: var(--sp-12);
    margin-top: var(--sp-6);
    padding-left: 0;
}

.comment-body:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.comment-reply-link {
    font-size: var(--text-sm) !important;
    padding: 6px 14px !important;
}

/* Responsive */
@media (max-width: 768px) {
    .comment-list .children {
        margin-left: var(--sp-6);
    }

    .comment-body {
        flex-direction: column;
    }

    .comment-avatar {
        text-align: center;
    }
}
</style>
