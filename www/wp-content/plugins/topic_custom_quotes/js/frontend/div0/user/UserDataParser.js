var UserDataParser = function(){
    return{
        parse:function(userDataJson){
            var userData = JSON.parse(userDataJson);
            var user = new User();
            user.construct(userData.id, userData.name);
            return user;
        }
    }
}
