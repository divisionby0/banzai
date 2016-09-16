<?php
/**
 * Plugin Name: TinyMCE Custom Class
 * Plugin URI: http://sitepoint.com
 * Version: 1.0
 * Author: Tim Carr
 * Author URI: http://www.n7studios.co.uk
 * Description: TinyMCE Plugin to wrap selected text in a custom CSS class, within the Visual Editor
 * License: GPL2
 */

function setup_tinymce_plugin(){
    // Check if the logged in WordPress User can edit Posts or Pages
    // If not, don't register our TinyMCE plugin
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        return;
    }

    // Check if the logged in WordPress User has the Visual Editor enabled
    // If not, don't register our TinyMCE plugin
    if ( get_user_option( 'rich_editing' ) !== 'true' ) {
        return;
    }

    // Setup some filters
    add_filter( 'mce_external_plugins', 'add_tinymce_plugin' );
    add_filter( 'mce_buttons', 'add_tinymce_toolbar_buttons' );
}

function admin_scripts_css() {
    echo '<h1>added styles</h1>';
    wp_enqueue_style( 'tinymce-custom-class', plugins_url( 'tinymce-custom-class.css', __FILE__ ) );
}

function add_tinymce_plugin($plugin_array){
    $plugin_array['addSentenceButton'] = plugin_dir_url( __FILE__ ) . 'addSentenceButtonPlugin.js';
    $plugin_array['removeSentencesButton'] = plugin_dir_url( __FILE__ ) . 'removeSentenceButtonPlugin.js';
    return $plugin_array;
}
function add_tinymce_toolbar_buttons($buttons){
    array_push( $buttons, 'addSentenceButton' );
    array_push( $buttons, 'removeSentencesButton' );
    return $buttons;
}


if ( is_admin() ) {
    add_action( 'init', 'setup_tinymce_plugin');
    add_action( 'admin_enqueue_scripts', 'admin_scripts_css' );
}