<?php

namespace App;

final class Item {

    public $name;
    public $sell_in;// precio
    public $quality;
    public $antiquity;
    public $legend = array();
    public $olds = array();

    function __construct($name, $sell_in, $quality) {
        $this->name    = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality > 50?50:$quality;
        $this->antiquity = 0;
        array_push($this->legend, "Sulfuras");
        array_push($this->olds, "Old Brie");
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}, {$this->antiquity}";
    }
    /*
    1. Todos los artículos tienen un valor SellIn que indica la 
        cantidad de días que tenemos para vender el artículo.
    */
    public function getSellIn(){
        return $this->sell_in;
    }
    // 2. Todos los artículos tienen un valor de calidad que 
    // indica lo valioso que es el artículo
    public function getQuality(){
        return $this->quality;
    }
    // 3. Al final de cada día, nuestro sistema 
    // reduce ambos valores para cada artículo.
    public function reduceSell(){
        $this->sell_in = $sell_in - 1;        
        return $this->sell_in; 
    }
    // 5. La calidad de un artículo nunca es negativa
    // "Brie envejecido" en realidad aumenta en calidad cuanto más viejo se hace
    public function reduceQuality(){
        $this->antiquity = $antiquity +1;
        if(!in_array($olds, $this->name)){   
            if($this->quality > 0)
                $this->quality = $quality - 1;
        }else{
            $this->quality = $quality +1;
        }
        return $this->quality; 
    }
    // 4. Una vez que la fecha de vencimiento ha pasado, la calidad 
    // se degrada el doble de rápido
    public function outDate(){
        $this->reduceSell();
        $this->reduceQuality();
        return $this->sell_in;
    }
    // 6. La calidad de un artículo nunca supera los 50
    // "Sulfuras", siendo un artículo legendario, nunca tiene que 
    // ser vendido o disminuye en calidad
    public function sell(){
        if(!in_array($this->legend, $this->name)){
            return "SELL";
        }
        return "LEGEND";
    }
    /*
    7. Los "pases detrás del escenario", como el queso brie envejecido, 
        aumentan en calidad a medida que se acerca el valor de SellIn; 
        La calidad aumenta en 2 cuando hay 10 días o menos y en 3 cuando hay 5 días o menos, 
        pero la calidad cae a 0 después del concierto
    
    */

}

