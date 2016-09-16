<?php

class QuoteAdminMetaBox {
    private $states;
    private $quoteStateComboBoxView;
    private $quote;

    public function __construct(){
        $this->states = QuoteStates::getInstance();
    }

    public function show($quoteData){
        $this->createQuote($quoteData->ID);

        $this->viewQuote();
        $this->viewQuoteAuthor();

        $this->createStatesComboBox();
        $this->showStatesComboBox($this->quote->getState());
    }

    private function createQuote($quoteId){
        $quoteCreation = new CreateQuote();
        $this->quote = $quoteCreation->execute($quoteId);
    }

    private function viewQuote(){
        new QuoteContentView($this->quote->getText());
    }
    private function viewQuoteAuthor(){
        new QuoteAuthorView($this->quote->getAuthor());
    }

    private function createStatesComboBox(){
        $this->quoteStateComboBoxView = new StatesComboBox();
    }
    private function showStatesComboBox($quoteState){
        echo $this->quoteStateComboBoxView->show($this->states, $quoteState, 'quoteStateCombo');
    }
} 