<?php

function dlog($text)
{
    $myfile = fopen("log.txt", "a") or die("Unable to open file!");
    fwrite($myfile, $text);
    fwrite($myfile, "\n");
    fclose($myfile);
}

function query_players($args = null)
{
    $defaults = array(
        'numberposts' => 0,
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

function parse_players($results)
{
    $players = array();
    $allow = array("text", "textarea", "number", "range",
        "email", "image", "date_picker", "date_time_picker",
        "time_picker", "select", "checkbox");

    foreach ($results as &$p) {

        $player = array();
        $fields = get_field_objects($p->ID);
        foreach ($fields as $f) {
            if (!in_array($f['type'], $allow)) {
                continue;
            }

            if ($f['name'] == 'department') {
                $pos = array_search($f['value'], array_keys($f['choices']));
                $player[$f['label']] = trim($pos . '-' . $f['value']);
                continue;
            }

            if ($f['name'] == 'picture_front' || $f['name'] == 'picture_back') {
                $player[$f['label']] = $f['value']["url"];
            } else {
                $player[$f['label']] = trim($f['value']);
            }
        }
        $players[] = $player;
    }

    return $players;
}


function get_players()
{
    $player_list = parse_players(query_players());
    usort($player_list, function ($a, $b) {
        $x = $a['Ordering'];
        $y = $b['Ordering'];
        $x = $x <= 0 ? 1000 : $x;
        $y = $y <= 0 ? 1000 : $y;
        return $x > $y ? 1 : -1;
    });
    return $player_list;
}

function players_by_dept()
{
    $all_players = get_players();
    $dept_sorted = array();

    foreach ($all_players as &$p) {
        $pieces = explode("-", $p['Department']);
        $order = $pieces[0];
        $dept = $pieces[1];
        $p['Department'] = $dept;
        if (!array_key_exists($order, $dept_sorted)) {
            $dept_sorted[$order] = array(
                'department' => $dept,
                'players' => array()
            );
        }
        $dept_sorted[$order]['players'][] = $p;
    }

    ksort($dept_sorted);
    return $dept_sorted;
}