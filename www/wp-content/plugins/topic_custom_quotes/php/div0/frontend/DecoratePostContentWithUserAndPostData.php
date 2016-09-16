<?php

class DecoratePostContentWithUserAndPostData {
    public function __construct(){
        $current_user = wp_get_current_user();
        $userData = array('id'=>$current_user->ID, 'name'=>$current_user->display_name);
        $postId = get_the_ID();
        echo '<div id="currentUserIdContainer" style="display: none;">'.json_encode($userData).'</div>';
        echo '<div id="currentPostIdContainer" style="display: none;">'.$postId.'</div>';
    }
} 