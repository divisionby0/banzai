<?php
/*
Plugin Name: Topic Custom Quotes
Plugin URI: http://none
Description: plugin description
Version: 1.0
Author: divisionby0
Author URI: http://none/
License: none
*/

include_once('php/Plugin.php');
include_once('php/div0/admin/quotes/Quote.php');

include_once('php/div0/admin/quotes/CreateNotesDBTable.php');
include_once('php/div0/admin/quotes/CreateQuotesDBTable.php');

include_once('php/div0/admin/quotes/GetQuotes.php');
include_once('php/div0/admin/quotes/CreateQuote.php');
include_once('php/div0/admin/quotes/InitQuoteAdmin.php');

include_once('php/div0/admin/quotes/view/table/CustomizeQuotesAdminTable.php');
include_once('php/div0/admin/quotes/view/table/RemoveQuickEditContextMenuButton.php');
include_once('php/div0/admin/quotes/collection/QuoteStatesIterator.php');
include_once('php/div0/admin/quotes/collection/QuoteStates.php');
include_once('php/div0/admin/quotes/QuoteState.php');
include_once('php/div0/quote/SaveQuote.php');
include_once('php/div0/admin/quotes/save/AdminSaveQuote.php');

include_once('php/div0/utils/Logger.php');
include_once('php/div0/utils/WPUtils.php');

// frontend
include_once('php/div0/frontend/IncludeFrontendScripts.php');
include_once('php/div0/frontend/user/User.php');
include_once('php/div0/frontend/QuoteInputView.php');
include_once('php/div0/frontend/DecoratePostContentWithNewQuoteInput.php');
include_once('php/div0/frontend/DecoratePostContentWithUserAndPostData.php');

// views
include_once('php/div0/views/StatesComboBox.php');
include_once('php/div0/views/QuoteContentView.php');
include_once('php/div0/views/QuoteAuthorView.php');
include_once('php/div0/views/Input.php');

global $quotes_db_version;
$quotes_db_version = "1.0";

createQuoteStates();
$isFrontend = !is_admin();
$currentPostType = WPUtils::getCurrentPostType();

if($isFrontend){
    add_action( 'wp', 'onSiteFrontendLoad' );
}
else{
    initQuotesAdmin();
    $quoteStates = createQuoteStates();
    register_activation_hook( __FILE__, 'my_plugin_create_db' );
}

function initQuoteSaver(){
    new QuoteSaver();
}

function initQuotesAdmin() {
    new InitQuoteAdmin();
}

function my_plugin_create_db(){
    new CreateNotesDBTable();
    new CreateQuotesDBTable();
}

function createQuoteStates(){
    $quoteStates = QuoteStates::getInstance();
    $moderatingQuoteState = new QuoteState(0,'moderating');
    $normalQuoteState = new QuoteState(1,'normal');
    $needReworkQuoteState = new QuoteState(2,'need rework');

    $quoteStates->add($moderatingQuoteState->getId(), $moderatingQuoteState->getState());
    $quoteStates->add($normalQuoteState->getId(), $normalQuoteState->getState());
    $quoteStates->add($needReworkQuoteState->getId(), $needReworkQuoteState->getState());

    return $quoteStates;
}

function onSiteFrontendLoad(){
    echo '<h1>Site loaded. Post type='.get_post_type().'</h1>';
    new IncludeFrontendScripts();
    new DecoratePostContentWithNewQuoteInput();
    new DecoratePostContentWithUserAndPostData();
}


//ajax calls this function

function save_note_callback() {

    global $wpdb;
    $sentenceId = $_POST['sentenceId'];
    $quoteId = $_POST['sentenceId'];
    $quoteNote = $_POST['quoteNote'];
    $authorId = $_POST['authorId'];
    $authorName = $_POST['authorName'];

}

function save_quote_callback() {
    global $wpdb;

    $quote = $_POST['quote'];

    $sentenceId = $_POST['sentenceId'];
    $quoteNote = $_POST['quoteNote'];
    $quoteParentPostId = $_POST['quoteParentPostId'];
    $authorId = $_POST['authorId'];
    $authorName = $_POST['authorName'];

    // save quote

    // save note
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
