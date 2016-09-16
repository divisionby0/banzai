<?php

class Quote {
    public static $postType = 'quote';
    public static $stateMetaKey = 'state';
    public static $parentPostMetaKey = 'parentPostId';
    public static $selectionStartMetaKey = 'selectionStart';
    public static $selectionLengthMetaKey = 'selectionLength';

    private $id;
    private $parentPostId;
    private $selectionStart;
    private $selectionLength;
    private $state;
    private $text;
    private $author;

    public function __construct($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function getParentPostId(){
        return $this->parentPostId;
    }
    public function setParentPostId($parentPostId){
        $this->parentPostId = $parentPostId;
    }
    public function getSelectionStart(){
        return $this->selectionStart;
    }
    public function setSelectionStart($selectionStart){
        $this->selectionStart = $selectionStart;
    }
    public function getSelectionLength(){
        return $this->selectionLength;
    }
    public function setSelectionLength($selectionLength){
        $this->selectionLength = $selectionLength;
    }
    public function getState(){
        return $this->state;
    }
    public function setState($state){
        $this->state = $state;
    }

    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text = $text;
    }

    public function getAuthor(){
        return $this->author;
    }
    public function setAuthor($author){
        $this->author = $author;
    }
} 