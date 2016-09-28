var Quote = function(){
    var text;
    var sentenceId;
    var noteText;
    var author;
    var parentPostId;

    return{
        create:function(_text, _sentenceId, _noteText, _author, _parentPostId){
            text = _text;
            sentenceId = _sentenceId;
            noteText = _noteText;
            author = _author;
            parentPostId = _parentPostId;
        },
        getText:function(){
            return text;
        },
        getSentenceId:function(){
            return sentenceId;
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
