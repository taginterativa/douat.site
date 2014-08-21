<?php

  /**
  *@desc A single blog post See page.php is for a page layout.
  */

  get_header();
  ?>
  <main>

    <div class="wrapper">

      <div class="conteudo-blog">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

          <div class="postWrapper" id="post-<?php the_ID(); ?>">

            <h1 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <span class="data"><?php the_date(); ?> - Categorias: <?php the_category(', '); ?></span>

            <div class="post"><?php the_content(__('(more...)')); ?></div>

          </div>

      	<?php

        comments_template();

        endwhile; else: ?>

      		<p>Sorry, no posts matched your criteria.</p>

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



