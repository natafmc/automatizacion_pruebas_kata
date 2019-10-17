<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase {
    
    public function testFoo() {
        $items      = [new Item("foo", 0, 0)];
        $gildedRose = new GildedRose($items);        
        $this->assertEquals("foo", $items[0]->name);
    }
    // 1. Todos los artículos tienen un valor SellIn que indica la 
    // cantidad de días que tenemos para vender el artículo.
    
    public function testSellIn(){
        $items      = [new Item("vino", 99, 200)];
        $gildedRose = new GildedRose($items);        
        $this->assertEquals("99", $items[0]->getSellIn());
    }
    // 2. Todos los artículos tienen un valor de calidad que 
    // indica lo valioso que es el artículo
    public function testQualityValue(){
        $items      = [new Item("vino", 99, 200)];
        $gildedRose = new GildedRose($items);        
        $this->assertEquals("50", $items[0]->getQuality());
    }
    // 3. Al final de cada día, nuestro sistema 
    // reduce ambos valores para cada artículo.
    public function testReduceQualityValue(){
        $items      = [new Item("vino", 99, 200)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();        
        $this->assertEquals("50", $items[0]->getQuality());
    }
    public function testReduceSellValue(){
        $items      = [new Item("vino", 99, 200)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();        
        $this->assertEquals("98", $items[0]->getSellIn());
    }

    // 4. Una vez que la fecha de vencimiento ha pasado, la calidad 
    // se degrada el doble de rápido
    public function testOutDate(){
        $items      = [new Item("vino", 0, 200)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();        
        $this->assertEquals("50", $items[0]->getQuality());
    }

    // 5. La calidad de un artículo nunca es negativa    
    public function testQualityNeg(){
        $items      = [new Item("Aged", 20, -1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();        
        $this->assertEquals("0", $items[0]->getQuality());
    }    
    // "Brie envejecido" en realidad aumenta en calidad cuanto más viejo se hace
    public function testQualityNegBrie(){
        $items      = [new Item("Aged Brie", 20, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();        
        $this->assertEquals("21", $items[0]->getQuality());
    }

    // 6. La calidad de un artículo nunca supera los 50
    public function testQualityMore50(){
        $items      = [new Item("Aged Brie", 20, 51)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();        
        $this->assertEquals("50", $items[0]->getQuality());
    }
    // "Sulfuras", siendo un artículo legendario, nunca tiene que 
    // ser vendido o disminuye en calidad
    public function testNoSellSulfura(){
        $items      = [new Item("Sulfuras", 0, 34)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();        
        $this->assertEquals("0", $items[0]->getSellIn());
    }
    // 7. Los "Backstage passes", como el queso brie envejecido, 
    // aumentan en calidad a medida que se acerca el valor de SellIn; 
    public function testBackstage(){
        $items      = [new Item("Backstage passes", 3, 4)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality(); 
        $gildedRose->updateQuality();
        $gildedRose->updateQuality();        
        $this->assertEquals("13", $items[0]->getQuality());
    }
}
