var TooltipButton = function(){
    var button;
    var $;

    function getButton(){
        return $('.tooltip');
    }

    function addListener(){
        button.on('click',function(){
            EventBus.dispatch(CREATE_QUOTE_REQUEST);
        });
    }
    function removeListener(){
        button.off('click');
    }

    return{
        init:function(){
            $ = jQuery.noConflict();
            button = getButton();
            addListener();
        },
        destroy:function(){
            removeListener();
        }
    }
};
