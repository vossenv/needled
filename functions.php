
<?php
/* enqueue script for parent theme stylesheeet */        
function childtheme_parent_styles() {
 
 // enqueue style
 wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );                       
}
add_action( 'wp_enqueue_scripts', 'childtheme_parent_styles');

function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $new_filetypes['zip'] = 'application/zip';
    $new_filetypes['gz'] = 'application/x-gzip';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
    }
add_filter('upload_mimes', 'add_file_types_to_uploads');

function custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the mimes array as below
    $existing_mimes['zip'] = 'application/zip';
    $existing_mimes['gz'] = 'application/x-gzip';
    return $existing_mimes;
}
add_filter('upload_mimes', 'custom_upload_mimes');

function background_block_editor() {
   wp_enqueue_style( 'custom-button-block-style', get_theme_file_uri( 'editor_css.css' ) );
}
add_action( 'enqueue_block_editor_assets', 'background_block_editor', 2);


function load_js() {
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/tp_page.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'load_js', 999);


/*Custom Post type start*/

function cw_post_type_team() {

    $supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        'custom-fields', // custom fields
        'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );

    $labels = array(
        'name' => _x('Team', 'plural'),
        'singular_name' => _x('Team', 'singular'),
        'menu_name' => _x('Team', 'admin menu'),
        'name_admin_bar' => _x('Team', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New Player'),
        'new_item' => __('New Player'),
        'edit_item' => __('Edit Player'),
        'view_item' => __('View Player'),
        'all_items' => __('All Players'),
        'search_items' => __('Search Players'),
        'not_found' => __('No players found.'),
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'team'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('team', $args);
}
add_action('init', 'cw_post_type_team');