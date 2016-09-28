var BuildQuote = function(){

    return{
        execute:function(_sentenceId, _noteText, _user, _parentPostId){
            var quote = new Quote();
            quote.create(_sentenceId, _noteText, _user, _parentPostId);
            return quote;
        }
    }
};
