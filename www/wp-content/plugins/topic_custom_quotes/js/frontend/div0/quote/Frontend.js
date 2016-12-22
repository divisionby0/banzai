// TODO тут хорошо показао создание тултипа https://premium.wpmudev.org/blog/creating-database-tables-for-plugins/?utm_expid=3606929-81.6_x2aktJQ2qbOSnTRGna0w.0&utm_referrer=https%3A%2F%2Fwww.google.com%2F

var Frontend = function(){
    var sentences;
    var $ = jQuery;
    var quoteTextContainer;
    var selectedSentence;
    var elementPositionX;
    var elementPositionY;

    var tooltipHtml = '<div class="tooltip noselect">Цитировать</div>';
    var tooltipElement = $(tooltipHtml);

    var currentUser;
    var currentPostId;
    var tooltipButton;
    var quoteInputView;
    var quote;
    var selectedSentenceId;
    var sentence;

    var ver = "0.0.1";

    function removeAllStyleAttributes(){
        $('*[style]').attr('style', '');
    }

    function addTooltip(){
        tooltipElement.appendTo(selectedSentence);
        selectedSentence.addClass('selectedSentence');
        var sentenceHeight = selectedSentence.height();
        //tooltipElement.css({left: 100});
        createTooltipButton();
    }

    function removeTooltip(){
        tooltipElement.remove();
        selectedSentence.removeClass('selectedSentence');
        removeTooltipButton();
    }

    function createTooltipButton(){
        tooltipButton = new TooltipButton();
        tooltipButton.init();
    }

    function removeTooltipButton(){
        if(tooltipButton){
            tooltipButton.destroy();
            tooltipButton = null;
        }
    }

    function removeTooltipHtmlCode(text){
        var tooltipHtmlCodePosition = text.indexOf(tooltipHtml);

        if(tooltipHtmlCodePosition > 0){
            text = text.substring(0, tooltipHtmlCodePosition);
        }
        return text;
    }
    function getElementPosition(){
        var elementPosition = HtmlElementUtils.getElementPosition(selectedSentence);
        elementPositionY = elementPosition.x;
        elementPositionX = elementPosition.y;
    }
    function getCurrentUser(){
        var userDataJson = $('#currentUserIdContainer').text();
        var userDataParser = new UserDataParser();
        return userDataParser.parse(userDataJson);
    }
    function getPostId(){
        return $('#currentPostIdContainer').text();
    }

    function createQuoteInputView(){
        quoteInputView = new QuoteInputView();
        quoteInputView.init();
    }

    function addListeners(){
        EventBus.addEventListener(CREATE_QUOTE_REQUEST, createQuoteRequestHandler);
        EventBus.addEventListener(SAVE_QUOTE_REQUEST, saveQuoteRequestHandler);
        EventBus.addEventListener(QUOTE_DUPLICATION_RESULT, quoteDuplicationResultHandler);
        EventBus.addEventListener(QUOTE_NOTE_SAVE_RESULT, quoteNoteSaveResultHandler);
        EventBus.addEventListener(QUOTE_SAVE_ERROR, quoteSaveErrorHandler);
        EventBus.addEventListener(QUOTE_SAVE_COMPLETE, quoteSaveCompleteHandler);
    }

    function quoteSaveErrorHandler(event){
        alert(event.data);
    }
    function quoteSaveCompleteHandler(event){
        var result = event.data;
        var savedQuoteId = result.savedQuoteId;
        saveNote(savedQuoteId);
    }

    function createQuoteRequestHandler(event){
        console.log('createQuoteRequestHandler');
        onCreateQuoteRequest();
    }

    function onCreateQuoteRequest(){
        quoteInputView.setQuoteHtml(sentence);
    }

    function quoteNoteSaveResultHandler(event){
        //console.log("quote note save result: "+event.data);

        var result = event.data;
        if(result == 'quote_note_saved'){
            onQuoteNoteSaved();
        }
        else{
            alert('error saving quote note');
        }
    }

    function onQuoteNoteSaved(){
        quoteInputView.clear();
        removeTooltip();
    }

    function quoteDuplicationResultHandler(event){
        var quoteDuplicationIdResponseObject = JSON.parse(event.data);

        console.log("quoteDuplicationIdResponseObject: ");
        console.log(quoteDuplicationIdResponseObject);

        if(quoteDuplicationIdResponseObject){
            var quoteSavedId = quoteDuplicationIdResponseObject.id;

            if(quoteSavedId){
                saveNote(quoteSavedId);
            }
            else{
                saveQuote();
            }
        }
        else{
            saveQuote();
        }
    }

    function saveNote(quoteSavedId){
        var dataNote = {
            action: 'save_quote_note',
            quoteId: quoteSavedId,
            quoteNote: quote.getNote(),
            authorId: quote.getAuthor().getId(),
            authorName:quote.getAuthor().getName()
        };

        var noteSaver = new SaveNote();
        noteSaver.execute(quoteSavedId, dataNote);
    }

    function saveQuote(){
        var saveQuote = new SaveQuote();
        saveQuote.execute(quote);
    }

    function saveQuoteRequestHandler(event){
        var quoteText = event.data.quote;
        var noteText = event.data.note;
        buildQuote(quoteText, noteText, currentUser, currentPostId);

        // TODO create chain of responsibility pattern

        // detect quote text duplication
        var quoteTextDuplicationIdRequest = new QuoteTextDuplicationIdRequest();
        quoteTextDuplicationIdRequest.execute(quoteText);
    }


    function buildQuote(quoteText, noteText, currentUser,currentPostId ){
        var quoteBuilder = new BuildQuote();
        quote = quoteBuilder.execute(quoteText, selectedSentenceId, noteText, currentUser,currentPostId);
    }

    return{
        init:function(){
            console.log("Frontend ver: "+ver);
            addListeners();
            createQuoteInputView();
            currentUser = getCurrentUser();
            currentPostId = getPostId();

            sentences = $("span.sentence");
            removeAllStyleAttributes();
            quoteTextContainer = $('.quoteText');

            sentences.each(function( index ) {
                $(this).click(function(event){

                    //sentence = $(this).html();
                    sentence = $(this).text();

                    sentence = removeTooltipHtmlCode(sentence);

                    if(selectedSentence){
                        removeTooltip();
                    }

                    selectedSentence = $(this);
                    selectedSentenceId = selectedSentence.attr('id');
                    getElementPosition();
                    addTooltip();

                    //quoteInputView.setQuoteHtml(sentence);
                });
            });
        }
    }
};
