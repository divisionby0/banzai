<?php

class AdminSaveQuote extends SaveQuote{

    private $prevQuoteState;

    public function __construct($quoteId, $quote){
        $this->quoteId = $quoteId;
        $isQuotePostType = $quote->post_type == Quote::$postType;

        if($isQuotePostType){
            $this->getQuoteState();
            $this->saveQuoteState();
        }
        else{
            echo '<br/>NOT QUOTE post type. current type is "'.$quote->post_type.'"  type to save='.Quote::$postType;
            return;
        }
    }

    private function getQuoteState(){
        // TODO validate to save only changed data
        $this->quoteState = $_POST['quoteStateCombo'];
    }
    private function saveQuoteState(){
        update_post_meta( $this->quoteId, Quote::$stateMetaKey, $this->quoteState );
    }
} 