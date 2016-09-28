var SaveQuoteResult = function(){
    var status;
    var savedId;
    
    return{
        create:function(_status, _savedId){
            status = _status;
            savedId = _savedId;
        },
        getStatus:function(){
            return status;
        },
        getSavedId:function(){
            return savedId;
        }
    }
}
