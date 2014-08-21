<?php

  get_header();  ?>

  <main>

    <div class="wrapper">

      <div class="conteudo-blog">
        <?php if (have_posts()): ?>
          <ol id="posts">
            <?php while (have_posts()) : the_post(); ?>

              <li class="postWrapper" id="post-<?php the_ID(); ?>">

                <h2 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                <span class="data"><?php the_date(); ?> - Categorias: <?php the_category(', '); ?> - <?php comments_popup_link(__('Comentário (0)'), __('Comentário (1)'), __('Comentários (%)')); ?></span>
                <!--<small><?php the_date(); ?> by <?php the_author(); ?></small>-->

                <div class="post"><?php the_content(__('(more...)')); ?></div>

              </li>

              <?php comments_template(); // Get wp-comments.php template ?>

            <?php endwhile; ?>

          </ol>

        <?php else: ?>

          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

        <?php endif; ?>

        <?php if (will_paginate()): ?>

          <ul id="pagination">
            <li class="previous"><?php posts_nav_link('','','&laquo; Previous Entries') ?></li>
            <li class="future"><?php posts_nav_link('','Next Entries &raquo;','') ?></li>
          </ul>

        <?php endif; ?>
      </div>
      <div class="sidebar-blog">
        <div id="secondaryContent">
          <?php get_sidebar(); ?>
        </div>
      </div>

    </div>
    <?php get_footer(); ?>

  </main>

</body>
</html>

