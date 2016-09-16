<?php

class QuoteStatesIterator {
    private $collection;
    private $index = -1;


    public function __construct($collection){
        $this->collection = $collection;
    }

    public function hasNext(){
        $nextIndex = $this->index + 1;
        return $nextIndex < sizeof($this->collection);
    }

    public function next(){
        $this->index += 1;
        return $this->collection[$this->index];
    }
    public function getCurrentIndex(){
        return $this->index;
    }

    public function size(){
        return sizeof($this->collection);
    }
} 