
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
