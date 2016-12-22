var QuoteTextDuplicationIdRequest = function(){
    var $ = jQuery.noConflict();

    return{
        execute:function(quoteText){
            var dataQuoteText = {
                action: 'get_quote_text_duplication_id',
                quoteText:quoteText
            };

            $.post(ajaxurl, dataQuoteText, function(response) {
                EventBus.dispatch(QUOTE_DUPLICATION_RESULT, response);
            });
        }
    }

}
