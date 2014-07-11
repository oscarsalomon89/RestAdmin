<?php
class ItemOrder extends Eloquent{
   
  protected $table = 'item_order';


    public function order()
    {
        return $this->hasOne('Order');
    }

  public function item()
    {
        return $this->hasOne('Item');
    }
}