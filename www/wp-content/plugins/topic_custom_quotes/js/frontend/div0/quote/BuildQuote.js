var BuildQuote = function(){

    return{
        execute:function(_text, _sentenceId, _noteText, _user, _parentPostId){
            var quote = new Quote();
            quote.create(_text, _sentenceId, _noteText, _user, _parentPostId);
            return quote;
        }
    }
};
