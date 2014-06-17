<?php
class Item_Order extends Eloquent{
   
public function item(){
      return $this->belongsTo('Item');
   }
public function order(){
      return $this->belongsTo('Order');
   }

}