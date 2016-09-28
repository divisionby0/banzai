var SaveQuote = function(){

    var $ = jQuery.noConflict();

    return{
        execute:function(quote){
            var pluginUrlContainer = $('#pluginUrlContainer');
            var pluginUrl = pluginUrlContainer.text();

            var data = {
                action: 'save_quote',
                sentenceId:quote.getSentenceId(),
                quoteNote: quote.getNote(),
                quoteParentPostId: quote.getParentPostId(),
                authorId: quote.getAuthor().getId(),
                authorName:quote.getAuthor().getName()
            };

            // call function from plugin TopicCustomQuotes.php
            $.post(ajaxurl, data, function(response) {
                console.log('Got this from the server: ' + response);
            });
        }
    }
};
