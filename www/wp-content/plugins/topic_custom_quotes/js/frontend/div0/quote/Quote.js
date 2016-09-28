var Quote = function(){
    var sentenceId;
    var noteText;
    var author;
    var parentPostId;

    return{
        create:function(_sentenceId, _noteText, _author, _parentPostId){
            sentenceId = _sentenceId;
            noteText = _noteText;
            author = _author;
            parentPostId = _parentPostId;
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
