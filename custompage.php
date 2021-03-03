<?php /* Template Name: Custom Page */

get_header(); ?>

	<div id="primary" class="front_page featured-content content-area">
		<main id="main" class="site-main">

            <div id="title">WE ARE <b>TRIGGERED PAIN.TZ</b></div>
            <div id="news">
                <?php echo do_shortcode('[masterslider alias="ms-2"]'); ?>
            </div>

            <div id="intro">
                <div id="arrow-container">
                    <div id="arrow-pulse"></div>
                    <div id="arrow-inner">
                        <div id="arrow-border"><a href="#tp-slider-home">↡</a></div>
                        <p></p>
                    </div>
                </div>
            </div>



			<?php get_template_part( 'template-parts/content', 'single' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
wp_enqueue_style( 'custom-page-css', get_theme_file_uri( 'custom_page.css' ) );
//get_sidebar();
get_footer();

