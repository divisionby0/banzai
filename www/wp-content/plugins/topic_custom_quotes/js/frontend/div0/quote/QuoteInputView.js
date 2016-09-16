var QuoteInputView = function(){

    var createQuoteButton;
    var quoteTextContainer;
    var quoteNoteInput;
    var container;
    var $;

    function getContainer(){
        container = $('.quoteInputElement');
    }
    function getButton(){
        createQuoteButton = $('#createQuoteButton');
    }

    function getQuoteNoteInput(){
        quoteNoteInput = $('#quoteNoteText');
    }

    function getQuoteTextContainer(){
        quoteTextContainer = $('#quoteTextContainer');
    }

    function hide(){
        container.hide();
    }
    function show(){
        container.show();
    }

    function onQuoteChanged(text){
        quoteTextContainer.html(text);
    }

    function createQuoteRequestHandler(){
        console.log('Create quote request');
    }

    function addListeners(){
        EventBus.addEventListener(CREATE_QUOTE_REQUEST, createQuoteRequestHandler);
    }
    function removeListeners(){
        EventBus.removeEventListener(CREATE_QUOTE_REQUEST, createQuoteRequestHandler);
    }

    return{
        init:function(){
            $ = jQuery.noConflict();
            getContainer();
            getButton();
            getQuoteNoteInput();
            getQuoteTextContainer();
            addListeners();
            show();
        },
        setQuoteHtml:function(text){
            onQuoteChanged(text);
        }
    }
};
