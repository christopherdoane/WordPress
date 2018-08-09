<?php
/* Kudos goes to joseph-dickson.com */

add_action( 'wp_enqueue_scripts_new', 'twentyseventeen_privacy_enqueue_styles' );
function twentyseventeen_privacy_enqueue_styles() {
        wp_enqueue_style( 'twentyseventeen-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'twentyseventeen-privacy-style', get_stylesheet_directory_uri() . '/style.css' );
}
/* 
 * Remove Google Fonts from being imported from Google:
 * This will remove Franklin Libre and any other Google fonts
 * imported from the partent theme.
 * https://codex.wordpress.org/Function_Reference/wp_dequeue_style
 */

add_action( 'wp_print_styles', 'remove_google_fonts', 2 );
function remove_google_fonts() {
   wp_dequeue_style( 'twentyseventeen-fonts' );
}
/* 
 * A child theme's functions.php runs before the parent.
 * To remove a filter you have to run it later during init
 */
function remove_google_fonts_preconnect() {
    remove_filter('wp_resource_hints', 'twentyseventeen_resource_hints');
}
add_filter('init', 'remove_google_fonts_preconnect');


/* 
 * Disable prefetch of Google Fonts API and s.w.org
 * Remove call to WordPress.org for Emoji support
 */
remove_action( 'wp_head', 'wp_resource_hints', 3 );

/* 
 *Remove Parent Theme's editor style that imports the Google Fonts API
 */
add_action( 'admin_init', 'my_remove_parent_styles' );
function my_remove_parent_styles() {
        remove_editor_styles();
}
?>
