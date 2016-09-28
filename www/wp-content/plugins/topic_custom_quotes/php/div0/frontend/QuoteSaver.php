<?php

/**
 * Created by PhpStorm.
 * User: ilay
 * Date: 28.09.2016
 * Time: 12:30
 */
class QuoteSaver
{
    public function __construct()
    {
        //ajax
        function save_quote_callback() {
            global $wpdb;

            $sentenceId = $_POST['sentenceId'];
            $quoteNote = $_POST['quoteNote'];
            $quoteParentPostId = $_POST['quoteParentPostId'];
            $authorId = $_POST['authorId'];
            $authorName = $_POST['authorName'];

            if(isset($sentenceId) && isset($quoteNote) && isset($quoteParentPostId) && isset($authorId) && isset($authorName)){

                $wpdb->insert(
                    'wp_topic_custom_quotes',
                    array(
                        'note' => $quoteNote,
                        'author' => $authorId,
                        'authorName' => $authorName,
                        'post' => $quoteParentPostId,
                        'sentenceId' => $sentenceId
                    ),
                    array(
                        '%s',
                        '%d',
                        '%s',
                        '%d',
                        '%d'
                    )
                );
                echo 'saved ok';
            }
            else{
                echo 'save quote error - data not set';
            }
            die(); // this is required to return a proper result
        }

        add_action('wp_ajax_save_quote', 'save_quote_callback');
    }
}