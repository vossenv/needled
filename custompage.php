<?php /* Template Name: PageWithoutSidebar */ ?>
<?php get_header(); ?>
    <div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_title(); ?>
            <div id="div1">
              Content brought in by admin
            </div>
            <div id="div2">
              Content brought in by admin
            </div>
            <div id="div3">
              Content brought in by admin
            </div>
            <?php the_content(); /*This code prints the content*/ ?> 
        <?php endwhile; endif; ?>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>