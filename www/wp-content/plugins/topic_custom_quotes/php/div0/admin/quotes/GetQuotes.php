<?php

class GetQuotes
{
    public function __construct()
    {
    }

    public function execute()
    {
        global $wpdb;
        $results = $wpdb->get_results( 'SELECT note, author, authorName, state, (SELECT post_content FROM wp_posts WHERE id=post) AS postContent FROM `wp_topic_custom_quotes`', ARRAY_A );

        return $results;
    }
}