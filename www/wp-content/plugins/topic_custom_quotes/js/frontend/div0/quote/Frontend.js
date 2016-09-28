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


    function removeAllStyleAttributes(){
        $('*[style]').attr('style', '');
    }

    function addTooltip(){
        tooltipElement.appendTo(selectedSentence);
        selectedSentence.addClass('selectedSentence');
        var sentenceHeight = selectedSentence.height();
        tooltipElement.css({left: 100});
        tooltipElement.css({top: elementPositionY - 500});
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
        tooltipButton.destroy();
        tooltipButton = null;
    }

    function removeTooltipHtmlCode(text){
        var tooltipHtmlCodePosition = text.indexOf(tooltipHtml);
        if(tooltipHtmlCodePosition > 0){
            text = text.substring(0, tooltipHtmlCodePosition);
        }
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
        EventBus.addEventListener(SAVE_QUOTE_REQUEST, saveQuoteRequestHandler);
    }

    function saveQuoteRequestHandler(event){
        var noteText = event.data.note;
        buildQuote(noteText, currentUser, currentPostId);
        var saveQuote = new SaveQuote();
        saveQuote.execute(quote);
    }

    function buildQuote(noteText, currentUser,currentPostId ){
        var quoteBuilder = new BuildQuote();
        quote = quoteBuilder.execute(selectedSentenceId, noteText, currentUser,currentPostId);
    }

    return{
        init:function(){
            addListeners();
            createQuoteInputView();
            currentUser = getCurrentUser();
            currentPostId = getPostId();

            sentences = $("span.sentence");
            removeAllStyleAttributes();
            quoteTextContainer = $('.quoteText');

            sentences.each(function( index ) {
                $(this).click(function(event){

                    var sentence = $(this).html();
                    removeTooltipHtmlCode(sentence);

                    if(selectedSentence){
                        removeTooltip();
                    }

                    selectedSentence = $(this);
                    selectedSentenceId = selectedSentence.attr('id');
                    getElementPosition();
                    addTooltip();

                    quoteInputView.setQuoteHtml(sentence);
                });
            });
        }
    }
};
