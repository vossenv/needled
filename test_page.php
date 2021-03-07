<?php /* Template Name: Test Page */
error_log("XXXX");


function writeMsg() {
    echo "Hello world!";
}


function get_players($args = null )
{
    $defaults = array(
        'numberposts' => 5,
        'category' => 0,
        'orderby' => 'date',
        'order' => 'DESC',
        'include' => array(),
        'exclude' => array(),
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'team',
        'suppress_filters' => true,
    );

    $parsed_args = wp_parse_args($args, $defaults);
    if (empty($parsed_args['post_status'])) {
        $parsed_args['post_status'] = ('attachment' === $parsed_args['post_type']) ? 'inherit' : 'publish';
    }
    if (!empty($parsed_args['numberposts']) && empty($parsed_args['posts_per_page'])) {
        $parsed_args['posts_per_page'] = $parsed_args['numberposts'];
    }
    if (!empty($parsed_args['category'])) {
        $parsed_args['cat'] = $parsed_args['category'];
    }
    if (!empty($parsed_args['include'])) {
        $incposts = wp_parse_id_list($parsed_args['include']);
        $parsed_args['posts_per_page'] = count($incposts);  // Only the number of posts included.
        $parsed_args['post__in'] = $incposts;
    } elseif (!empty($parsed_args['exclude'])) {
        $parsed_args['post__not_in'] = wp_parse_id_list($parsed_args['exclude']);
    }

    $parsed_args['ignore_sticky_posts'] = true;
    $parsed_args['no_found_rows'] = true;

    $get_posts = new WP_Query;
    return $get_posts->query($parsed_args);
}


function parse_results( $results )
{



   // $my_query = new WP_Query($parsed_args);
    if ($results->have_posts()) {


        while ($results->have_posts()) : $results->the_post();

            $custom = get_post_custom();
//            foreach($custom as $key => $value) {
//                echo $key.': '.$value.'<br />';
//            }
//            if(isset($custom['name'])) {
//                echo 'Name: '.$custom['name'][0];
//            }
//            echo '<br/>';
//            if(isset($custom['age'])) {
//                echo 'Age: '.$custom['age'][0];
//            }
//            echo '<br/>';
//            if(isset($custom['gender'])) {
//                echo 'Gender: '.$custom['gender'][0];
//            }
//            echo '<br/>';
//            if(isset($custom['marker'])) {
//                echo 'Marker: '.$custom['marker'][0];
//            }
//            echo '<br/>';
//            if(isset($custom['join_date'])) {
////                echo 'Joined: '.date("d/m/Y",$custom['join_date'][0]);
//                $d = $custom['join_date'][0];
//                //echo 'Joined: '.date("d/m/y",$d);
//                echo 'Joined: '.$d;
//            }
//            echo '<br/>';
//DateTime::createFromFormat("Y-m-d", $date);
            $x = get_field('join_date1');

            if(is_null($x)) {
                echo "Null";

            }
            // $dateTime = DateTime::createFromFormat("d/m/Y", $x);



           // $date = new DateTime('2000-01-01');

           // echo $x ->format('Y-m-d H:i:s');
//            $date = new DateTime('2000-01-01');
        //    echo $dateTime ->format('Y-m-d H:i:s');

//            if(isset($custom['picture'])) {
//                echo 'Picture: '.$custom['picture'][0];
//            }

//            $image = get_field('picture');
//            $size = 'full'; // (thumbnail, medium, large, full or custom size)
//            if ($image) {
//                echo $image['url'];
//                //echo wp_get_attachment_image($image, $size);
//            }
            //echo the_field('picture');

           // echo the_permalink();
//            echo the_title();

        endwhile;


    }
}

function build_list(){
    $r = get_players();
    parse_results($r);
}

#$x = get_1posts();
#error_log($x);


get_header(); ?>

    <div id="primary" class="front_page featured-content content-area">
        <main id="main" class="site-main">
            <div id="test-content">
            <?php build_list();?>
            </div>



        </main><!-- #main -->
    </div><!-- #primary -->


<?php
error_log("XXXX");
wp_enqueue_style('custom-page-css', get_theme_file_uri('custom_page.css'));
//get_sidebar();
get_footer();

//
//<?php
//$args = array( 'post_type' => 'movies', 'posts_per_page' => 10 );
//$the_query = new WP_Query( $args );
//?>
<?php //if ( $the_query->have_posts() ) : ?>
<!--    --><?php //while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<!--        <h2>--><?php //the_title(); ?><!--</h2>-->
<!--        <div class="entry-content">-->
<!--            --><?php //the_content(); ?>
<!--        </div>-->
<!--    --><?php //endwhile;
//    wp_reset_postdata(); ?>
<?php //else:  ?>
<!--    <p>--><?php //_e( 'Sorry, no posts matched your criteria.' ); ?><!--</p>-->
<?php //endif; ?>