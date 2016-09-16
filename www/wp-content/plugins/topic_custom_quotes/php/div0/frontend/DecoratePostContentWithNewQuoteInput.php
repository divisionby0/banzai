<?php

class DecoratePostContentWithNewQuoteInput {
    public function __construct(){
        add_filter( 'the_content', 'addContainer');

        function addContainer($content){
            $quoteInputView = new QuoteInputView();
            return $content.$quoteInputView->getHtml();
        }
    }
} 