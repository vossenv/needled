<?php /* Template Name: Test Page */
error_log("XXXX");


function writeMsg()
{
    echo "Hello world!";
}

function get_players($args = null)
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


class Player
{
    public $name;
    public $join_date;
    public $marker;
    public $gender;
    public $birth_date;
    public $position;
    public $ordering;
    public $picture_front;
    public $picture_back;
    public $age;


    /**
     * Player constructor.
     * @param $name
     * @param $join_date
     * @param $marker
     * @param $gender
     * @param $birth_date
     * @param $position
     * @param $ordering
     * @param $picture_front
     * @param $picture_back
     */
    public function __construct($name,
                                $join_date,
                                $marker,
                                $gender,
                                $birth_date,
                                $position,
                                $ordering,
                                $picture_front,
                                $picture_back
    )
    {
        $this->name = $name;
        $this->join_date = $join_date;
        $this->marker = $marker;
        $this->gender = $gender;
        $this->birth_date = $birth_date;
        $this->position = $position;
        $this->ordering = (int)$ordering;
        $this->picture_front = $picture_front;
        $this->picture_back = $picture_back;
        $this->age = $this->to_age($this->to_date($birth_date))->format('%Y');
    }

    function to_date($string)
    {
        return DateTime::createFromFormat("d/m/Y", $string);
    }

    function to_age($start_date)
    {
        $now = new DateTime();
        return date_diff($start_date, $now);
    }

}


function parse_players($results)
{
    $players = array();
    foreach ($results as &$player) {
        $id = $player->ID;
        $p = new Player(
            get_field('name', $id),
            get_field('join_date', $id),
            get_field('marker', $id),
            get_field('gender', $id),
            get_field('birth_date', $id),
            get_field('position', $id),
            get_field('ordering', $id),
            get_field('picture_front', $id)["url"],
            get_field('picture_back', $id)["url"]
        );
        $players[] = $p;
    }
    return $players;
}


function build_list()
{
    $r = get_players();
    $q = parse_players($r);

    foreach ($q as &$p) {
        echo $p->age . "<br/>";
    }
}


get_header(); ?>

    <div id="primary" class="front_page featured-content content-area">
        <main id="main" class="site-main">
            <div id="test-content">
                <?php build_list(); ?>
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