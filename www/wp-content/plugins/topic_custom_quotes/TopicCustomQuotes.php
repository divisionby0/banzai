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

include_once('php/div0/admin/quotes/CreateDBTable.php');

include_once('php/div0/admin/quotes/CreateQuote.php');
include_once('php/div0/admin/quotes/InitQuotesPostType.php');
include_once('php/div0/admin/quotes/InitQuoteAdmin.php');
include_once('php/div0/admin/quotes/QuoteAdminMetaBox.php');
include_once('php/div0/admin/quotes/view/table/CustomizeQuotesAdminTable.php');
include_once('php/div0/admin/quotes/view/table/RemoveQuickEditContextMenuButton.php');
include_once('php/div0/admin/quotes/collection/QuoteStatesIterator.php');
include_once('php/div0/admin/quotes/collection/QuoteStates.php');
include_once('php/div0/admin/quotes/QuoteState.php');
include_once('php/div0/admin/quotes/save/SaveQuote.php');

include_once('php/div0/utils/Logger.php');
include_once('php/div0/utils/WPUtils.php');

// frontend
include_once('php/div0/frontend/IncludeFrontendScripts.php');
include_once('php/div0/frontend/user/User.php');
include_once('php/div0/frontend/QuoteInputView.php');
include_once('php/div0/frontend/DecoratePostContentWithNewQuoteInput.php');
include_once('php/div0/frontend/DecoratePostContentWithUserData.php');

// views
include_once('php/div0/views/StatesComboBox.php');
include_once('php/div0/views/QuoteContentView.php');
include_once('php/div0/views/QuoteAuthorView.php');
include_once('php/div0/views/Input.php');

global $quotes_db_version;
$quotes_db_version = "1.0";

createQuoteStates();
createQuotesPostType();
$isFrontend = !is_admin();
$currentPostType = WPUtils::getCurrentPostType();

if($isFrontend){
    add_action( 'wp', 'onSiteFrontendLoad' );
}
else{
    $quoteStates = createQuoteStates();
    if($currentPostType == Quote::$postType){
        new CustomizeQuotesAdminTable();
    }

    add_action( 'admin_init', 'quote_admin' );
    // save quote
    add_action( 'save_post_quote', 'quote_admin_save', 10, 2 );

    register_activation_hook( __FILE__, 'my_plugin_create_db' );
}

function createQuotesPostType(){
    add_action('init', 'init_quotes_post_type' );
}

// init quotes post type
function init_quotes_post_type() {
    new InitQuotesPostType();
}

function quote_admin() {
    new InitQuoteAdmin();
}

function my_plugin_create_db(){
    new CreateDBTable();
}

function displayQuoteAdminMetaBox($quote) {
    $quoteAdminMetaBox = new QuoteAdminMetaBox();
    $quoteAdminMetaBox->show($quote);
}

function quote_admin_save($quoteId, $quote){
    new SaveQuote($quoteId, $quote);
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
    new DecoratePostContentWithUserData();
}