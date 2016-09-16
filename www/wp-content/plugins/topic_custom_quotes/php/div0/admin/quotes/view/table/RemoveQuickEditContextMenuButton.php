<?php

class RemoveQuickEditContextMenuButton {
    public function __construct(){
        add_filter('post_row_actions',function($actions){
            unset($actions['inline hide-if-no-js']);
            return $actions;
        },10,1);
    }
} 