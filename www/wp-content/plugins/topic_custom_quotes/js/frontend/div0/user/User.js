var User = function(){
    var id;
    var name;

    return{
        construct:function(_id, _name){
            id = _id;
            name = _name;
        },
        getId:function(){
            return id;
        },
        getName:function(){
            return name;
        }
    }
};
