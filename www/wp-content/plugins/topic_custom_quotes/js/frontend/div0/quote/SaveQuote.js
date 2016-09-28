var SaveQuote = function(){

    var $ = jQuery.noConflict();

    function parseSaveQuoteResult(resultData){
        var resultObject = JSON.parse(resultData);
        return resultObject;
    }
    
    return{
        execute:function(quote){
            var pluginUrlContainer = $('#pluginUrlContainer');
            var pluginUrl = pluginUrlContainer.text();

            var dataQuote = {
                action: 'save_quote',
                quote:quote.getText(),
                sentenceId:quote.getSentenceId(),
                quoteParentPostId: quote.getParentPostId(),
            };

            var dataNote = {
                action: 'save_quote_note',
                quoteId: -1,
                quoteNote: quote.getNote(),
                authorId: quote.getAuthor().getId(),
                authorName:quote.getAuthor().getName()
            };

            // call function from plugin TopicCustomQuotes.php
            $.post(ajaxurl, dataQuote, function(response) {
                var result = parseSaveQuoteResult(response);
                var status = result.status;
                if(status == 'saved'){
                    EventBus.dispatch(QUOTE_SAVE_COMPLETE, result);
                }
                else{
                    EventBus.dispatch(QUOTE_SAVE_ERROR);
                }
            });
        }
    }
};
