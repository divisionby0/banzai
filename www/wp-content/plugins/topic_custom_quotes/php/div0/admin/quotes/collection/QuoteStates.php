<?php


class QuoteStates {
    private $collection = array();

    private static $_instance = null;

    protected function __clone() {
    }

    public static function getInstance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function add($key, $value){
        $this->collection[$key] = $value;
    }
    public function get($key){
        return $this->collection[$key];
    }

    public function size(){
        return sizeof($this->collection);
    }

    public function getIterator(){
        return new QuoteStatesIterator($this->collection);
    }
} 