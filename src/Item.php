<?php

namespace App;

final class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name    = $name;
        $this->sell_in = $sell_in;        
        $this->quality = $quality > 0 ? $quality : 0;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
    public function getSellIn(){
        return $this->sell_in;
    }
    public function getQuality(){
        if($this->quality > 50)
            return 50;
        return $this->quality;
    }
}
