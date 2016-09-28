var SaveNote = function(){

    var $ = jQuery.noConflict();

    return{
        execute:function(quoteId, dataNote){
            dataNote.quoteId = quoteId;

            $.post(ajaxurl, dataNote, function(response) {
                EventBus.dispatch(QUOTE_NOTE_SAVE_RESULT, response);
            });
        }
    }
}
