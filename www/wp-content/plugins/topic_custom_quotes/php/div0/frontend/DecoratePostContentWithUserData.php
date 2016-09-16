<?php

class DecoratePostContentWithUserData {
    public function __construct(){
        $current_user = wp_get_current_user();
        //$user = new User($current_user->ID,$current_user->display_name);

        $userData = array('id'=>$current_user->ID, 'name'=>$current_user->display_name);

        echo 'userData: '.json_decode($userData);

        echo '<div id="currentUserIdContainer" style="display: none;">'.json_encode($userData).'</div>';
    }
} 