<?php

class Input {
    public function __construct($value, $name){
        echo '<input type="text" name="'.$name.'" value="'.$value.'"/>';
    }
} 