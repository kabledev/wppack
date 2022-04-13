<?php

/**
 * WPPack  Full Post Template
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @author <sivankanat@gmail.com>
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post:full'); ?>>

  <div class="post-image box box-16:9 mb:md">
    <div class="box-inner" style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>); background-size:cover;background-repeat:no-repeat;">
      <span class="post-cat" flex="ai:center">
        <?php /* the_category(',', true)  */ ?>
      </span>
    </div>

  </div>

  <header class="post-header">
    <h1 class="post-title"><?php the_title() ?></h1>

    <div class="post-meta mb:md" flex="">
      <span class="item post-date text:italic mr:md color:font-faded" flex="ai:center">
        <i class="ri-time-line icon mr:xs"></i>
        <?php echo get_the_date('d M Y') ?></span>

      <span class="item post-author post-date mr:sm color:font-faded" flex="ai:center">
        <i class="ri-user-line icon mr:xs"></i>
        <?php echo get_the_author() ?></span>
    </div>
  </header><!-- .post-header -->


  <div class="post-content">
    <?php
    the_content();
    ?>
  </div><!-- .post-content -->

  <footer class="post-footer my:lg">
    <div class="post-tags">
      <?php $tags = get_the_tags();
      if ($tags) : ?>
        <ul flex="fw:wrap">
          <?php foreach ($tags as $tag) : ?>
            <li><a href="<?php echo get_term_link($tag->term_id) ?>"><?php echo $tag->name ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </footer><!-- .post-footer -->

</article><!-- #post-<?php the_ID(); ?> -->