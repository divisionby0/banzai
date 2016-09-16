<?php

class InitQuotesPostType {
    public function __construct(){

        $labels = array(
            'name' => 'Quote',
            'singular_name' => 'Quote',
            'menu_name' => 'Quotes',
            'all_items' => 'All quotes',
            'add_new' => 'Add quote',
            'add_new_item' => 'Add new quote',
            'edit_item' => 'Edit quote',
            'view_item' => 'View quote',
            'search_items' => 'Find quote',
            'not_found' =>  'Quote not found',
            'not_found_in_trash' => 'Quote not found in trash',
            'parent_item_colon' => '??????'
        );


        $args = array(
            'labels' => $labels,
            'singular_label' => __('Quote'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'quotes'),
            'supports' => array('author', 'comments')
        );
        register_post_type(Quote::$postType , $args );
    }
} 