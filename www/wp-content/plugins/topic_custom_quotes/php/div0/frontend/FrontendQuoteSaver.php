<?php
global $wpdb;
$sentenceId = $_POST['sentenceId'];
$quoteNote = $_POST['quoteNote'];
$quoteParentPostId = $_POST['quoteParentPostId'];
$authorId = $_POST['authorId'];
$authorName = $_POST['authorName'];

if(isset($sentenceId) && isset($quoteNote) && isset($quoteParentPostId) && isset($authorId) && isset($authorName)){
    $query = "INSERT INTO wp_topic_custom_quotes (note, author, authorName, post, sentenceId) VALUES ($quoteNote, $authorId, $authorName, $quoteParentPostId, $sentenceId)";
    $wpdb->query($query);

    echo 'saved ok';
}
else{
    echo 'save quote error - data not set';
}