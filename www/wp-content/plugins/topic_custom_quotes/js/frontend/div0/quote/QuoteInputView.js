var QuoteInputView = function(){

    var createQuoteButton;
    var quoteTextContainer;
    var quoteNoteInput;
    var container;
    var $;
    var quote;
    var note;

    function getContainer(){
        container = $('.quoteInputElement');
    }
    function getButton(){
        createQuoteButton = $('#createQuoteButton');
    }
    function addButtonListener(){
        createQuoteButton.on('click', function(){
            getNote();
            EventBus.dispatch(SAVE_QUOTE_REQUEST, {quote:quote, note:note});
        });
    }

    function removeButtonListener(){
        createQuoteButton.off('click');
    }

    function getNote(){
        note = quoteNoteInput.val();
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
        quote = text;
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
            console.log('QuoteInputView');
            $ = jQuery.noConflict();
            getContainer();
            getButton();
            addButtonListener();
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
