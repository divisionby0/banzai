var Quote = function(){
    var quoteText;
    var noteText;
    var author;
    var parentPostId;

    return{
        create:function(_quoteText, _noteText, _author, _parentPostId){
            quoteText = _quoteText;
            noteText = _noteText;
            author = _author;
            parentPostId = _parentPostId;
        },
        getQuoteText:function(){
            return quoteText;
        },
        getNote:function(){
            return noteText;
        },
        getAuthor:function(){
            return author;
        },
        getParentPostId:function(){
            return parentPostId;
        }
    }
};
