<?php /* Template Name: Front Page */

require get_stylesheet_directory() . '/php/teams.php';
function get_player_row($name, $val)

{
    echo "<tr><td class='field_name'>" . $name . "</td><td>" . $val . "</td></tr>";
}

get_header(); ?>

    <div id="primary" class="front_page featured-content content-area">
        <main id="main" class="site-main">

            <div id="title">WE ARE <b>TRIGGERED PAIN.TZ</b></div>


            <div id="arrow-container">
                <div id="arrow-pulse"></div>
                <div id="arrow-inner">
                    <a href="#tp-slider-home">
                        <img id="arrow-img" src=<?php echo get_theme_file_uri("img/arrow.svg") ?>>
                    </a>
                </div>
            </div>

            <div id="news">
                <?php echo do_shortcode('[masterslider alias="ms-2"]'); ?>
            </div>
            <div id="news-mobile">
                <?php echo do_shortcode('[masterslider alias="ms-2-2"]'); ?>
            </div>

            <div id="tp-slider-home"></div>
            <div id="triggeredpaintz" class="trans_row">
                <h2>Who we are</h2>

                <hr>

                <h3>TRIGGEREDPAIN.TZ</h3>
                <div>Liga- und Szenario Paintball Team aus Mittel- und Ostthürringen.
                    <h4>Was macht uns aus?</h4>
                    Unser Team wurde 2020, aus dem Hobby heraus Paintball zu spielen, gegründet.
                    <h4>Was spielen wir?</h4>
                    TRIGGEREDPAIN.tz ist ein Liga- und Szenario Paintball Team.

                </div>
            </div>
            <div id="teams" class="trans_row">
                <span class="section-title">TP.tz Team</span><br/>
                <?php
                $players = get_players();
                foreach ($players as &$p) {
                    $img_f = is_null($p->picture_front) ?
                        get_theme_file_uri('/img/team_anon_small.jpg') : $p->picture_front;
                    $img_b = is_null($p->picture_back) ?
                        get_theme_file_uri('/img/team_anon_small.jpg') : $p->picture_back;

                    echo "<div class='player'>";
                    echo '
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front player-img" style="background-image: url(' . $img_f . ')">
                              
                            </div>
                            <div class="flip-card-back player-img" style="background-image: url(' . $img_b . ')">';
                    echo "<div id='ptable'><table class='field_names'>";
                    get_player_row("Name:", $p->name);
                    get_player_row("Join Date:", $p->join_date);
                    get_player_row("Marker:", $p->marker);
                    get_player_row("Gender:", $p->gender);
                    get_player_row("Birthday:", $p->birth_date);
                    get_player_row("Age:", $p->age);
                    get_player_row("Position", $p->position);
                    echo "</table></div>";
                    echo '</div>
                        </div>
                    </div>
                ';
                    echo "</div>";
                }
                ?>

            </div>


            <!--            <section id="teams">-->
            <!--                <h2>TP.tz Teams</h2>-->
            <!--                <hr/>-->
            <!--                <div>-->
            <!--                    <details>-->
            <!--                        <summary><img src="/" alt=""/></summary>-->
            <!--                        <p>-->
            <!--                            <span>Besonderes:</span> nichts<br/>-->
            <!--                            <span>Dabei seit:</span> zu lange<br/>-->
            <!--                            <span>Markierer:</span> Planet Ecplise CS2, Special Edition Hulk, irgendetwas<br/>-->
            <!--                        </p>-->
            <!--                    </details>-->
            <!--                </div>-->
            <!--            </section>-->

            <div id="paintball" class="trans_row section-title">
                Paintball
            </div>
            <div id="social" class="trans_row section-title">
                Social
            </div>
            <div id="events" class="trans_row section-title">
                Events
            </div>
            <div id="contact" class="trans_row section-title">
                Contact
            </div>

            <?php get_template_part('template-parts/content', 'single'); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
wp_enqueue_style('custom-page-css', get_theme_file_uri('css/front_page.css'));
//get_sidebar();
get_footer();

