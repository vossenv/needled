<?php /* Template Name: Custom Page */

get_header(); ?>

	<div id="primary" class="front_page featured-content content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
wp_enqueue_style( 'custom-page-css', get_theme_file_uri( 'custom_page.css' ) );
wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/test.js', array( 'jquery' ),'',true );
//get_sidebar();
get_footer();

