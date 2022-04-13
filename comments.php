<?php

/**
 * WPPack Comments Template
 *
 * @package WPPack
 * @since  1.0.1
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
  return;

?>

<div id="wppack_comments" class="comments-area mt:lg">
  <?php

  $uid = get_current_user_id();

  //reset
  add_filter('comment_form_logged_in', function ($logged_in_as, $commenter, $user_identity) {
    return;
  }, 10, 3);
  add_filter("comment_form_defaults", function ($defaults) {
    $defaults['title_reply_before'] = "";
    $defaults['title_reply_after'] = "";
    $defaults['title_reply'] = "";
    return $defaults;
  });

  function form()
  { ?>
    <div id="respond"></div>
    <div class="write_comment">

      <div class="header" flex="">
        <figure>
          <img class="border:circle" width="40" height="40" src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>">
        </figure>

        <div class="info_text ml:sm">
          <h3 class="">Yorum yaz</h3>
          <p class="reset">Bir yorum yaz</p>
        </div>
      </div>

      <div class="comment-form-comment"><textarea rows="5" class="" id="comment" name="comment" aria-required="true" placeholder="Ne düşünüyorsun.."></textarea></div>
    <?php }


  $comments_args = array(
    'label_submit' => __('Gönder', 'textdomain'),
    'comment_notes_after' => '',
    'submit_button' => '<input class="uk-button uk-button-small" name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    'submit_field' => '<div class="uk-margin-small-top form-submit">%1$s %2$s</div></div>',
    'comment_field' => form(),
  );
  comment_form($comments_args);

  // loop
  if (have_comments()) : ?>
      <div class="loop">

        <!-- title -->
        <strong class="comments-title my:md flex">
          <?php echo get_comments_number(); ?> yorum
        </strong>

        <!-- fn -->
        <?php
        function wppack_comment($comment, $args, $depth)
        {
          $args['avatar_size'] = 40;

          if ('div' === $args['style']) :
            $tag       = 'div';
            $add_below = 'comment';
          else :
            $tag       = 'li';
            $add_below = 'div-comment';
          endif; ?>

          <li <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>">

            <!-- comment head -->
            <div class="comment-head comment-author vcard" flex="ai:center">
              <?php if ($args['avatar_size'] != 0) : ?>
                <figure class="commenter_figure">
                  <?php echo get_avatar($comment, $args['avatar_size']); ?>
                </figure>
              <?php endif; ?>
              <div class="comment-meta commentmetadata ml:sm" flex="fd:col">
                <?php printf(__('<cite class="fn commenter_name">%s</cite>'), get_comment_author_link()); ?>

                <!-- date -->
                <a class="comment-date" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                  <?php echo get_comment_date();/* get_comment_time() */ ?>
                </a>
              </div>
            </div>
            <!-- comment head end-->

            <?php if ($comment->comment_approved == '0') : ?>
              <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em><br />
            <?php endif; ?>


            <div class="comment-body">
              <?php comment_text(); ?>
            </div>

            <div class="comment-footer flex">
              <div class="reply">
                <?php comment_reply_link(
                  array_merge(
                    $args,
                    array(
                      'add_below' => $add_below,
                      'depth'     => $depth,
                      'max_depth' => $args['max_depth']
                    )
                  )
                ); ?>
              </div>
              <?php edit_comment_link(__('(Edit)'), '  ', ''); ?>
            </div>
            <!-- comment footer end -->
          </li>
        <?php } ?>
        <!-- fn end -->

        <ul class="commentlist reset">
          <?php wp_list_comments('type=comment&callback=wppack_comment'); ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
          <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e('Comment navigation', 'twentythirteen'); ?></h1>
            <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'twentythirteen')); ?></div>
            <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentythirteen')); ?></div>
          </nav><!-- .comment-navigation -->
        <?php endif; ?>

        <?php if (!comments_open() && get_comments_number()) : ?>
          <p class="no-comments"><?php _e('Comments are closed.', 'twentythirteen'); ?></p>
        <?php endif; ?>

      </div>
    <?php endif; ?>


    </div>