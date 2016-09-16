<?php

class QuoteInputView {
    public function __construct(){

    }

    public function getHtml(){
        return '<div class="quoteInputElement">
        <div class="quoteInputElementHeader">МНЕНИЯ И ОБСУЖДЕНИЯ</div>
        <div>Напишите что думаете по этому поводу</div>
        <div class="quoteText" id="quoteTextContainer"></div>
        <textarea id="quoteNoteText" placeholder="впишите свое мнение..."></textarea>
        <button id="createQuoteButton">Готово</button>
    </div>';
    }
} 