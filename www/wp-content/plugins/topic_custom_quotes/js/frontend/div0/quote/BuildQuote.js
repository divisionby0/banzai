var BuildQuote = function(){

    return{
        execute:function(_quoteText, _noteText, _user, _parentPostId){
            var quote = new Quote();
            quote.create(_quoteText, _noteText, _user, _parentPostId);
            return quote;
        }
    }
};
