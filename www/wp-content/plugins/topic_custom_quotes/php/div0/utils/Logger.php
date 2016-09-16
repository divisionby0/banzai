<?php

class Logger {
    public static function logMessage($text){
        echo '<p style="font-size: 11px">'.$text.'</p>';
    }
    public static function logError($error){
        echo '<p style="color: red; font-size: 11px">'.$error.'</p>';
    }
} 